<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_horario_de_onibus() {
    theme_declare_block(
        array(
            'name'        => 'horario-de-onibus',
            'title'       => __( 'Horário de Ônibus', 'bulk' ),
            'description' => __( 'Exibe a programação das linhas de ônibus.', 'bulk' ),
            'icon'        => 'calendar-alt',
            'mode'        => 'edit',
            'supports'    => array(
                'align'  => false,
                'mode'   => false,
                'anchor' => true,
            ),
            'enqueue_assets' => function() {
                // 1. Registra o script base
                wp_register_script( 'urbs-api-config', false, array(), null, true );
                
                // 2. Injeta o objeto global
                wp_localize_script( 'urbs-api-config', 'UrbsAPI', array(
                    'linhasUrl'         => esc_url_raw( rest_url( 'urbs/v1/linhas' ) ),
                    'infoLinhasBaseUrl' => esc_url_raw( rest_url( 'urbs/v1/info-linhas-completas/' ) ),
                    'horariosPontosUrl' => esc_url_raw( rest_url( 'urbs/v1/horarios-pontos' ) ),
                ) );
                
                // 3. Enfileira ele
                wp_enqueue_script( 'urbs-api-config' );
                
                // 4. Choices
                wp_enqueue_script(
                    'choices-js',
                    'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js',
                    array(),
                    '10.2.0',
                    true
                );
                
                // 5. Main script
                wp_enqueue_script(
                    'meu-script',
                    get_stylesheet_directory_uri() . '/js/app.js',
                    array( 'urbs-api-config', 'choices-js' ),
                    '1.0',
                    true
                );
            },
        )
    );
}

add_action( 'theme_declare_block', 'child_theme_block_horario_de_onibus', 20 );

/**
 * Retorna os segundos até a próxima renovação do cache: 02:00 horário de Brasília (GMT-3).
 */
function urbs_seconds_until_next_reset() {
    $tz         = new DateTimeZone( 'America/Sao_Paulo' );
    $now        = new DateTime( 'now', $tz );
    $next_reset = new DateTime( 'today 02:00', $tz );

    if ( $now >= $next_reset ) {
        $next_reset->modify( '+1 day' );
    }

    return $next_reset->getTimestamp() - $now->getTimestamp();
}

function get_horarios_linhas_urbs() {
    $cache_key = 'urbs_linhas_data';
    $linhas = get_transient( $cache_key );

    try {
        if ( false === $linhas ) {
            
            try {
                $url = 'https://scf-horario-onibus-api.dsv.urbs.curitiba.pr.gov.br/api/linhas';
                $response = wp_remote_get( $url, array( 'sslverify' => false ) );
            } catch (Exception $e) {
                error_log( $e->getMessage() );
                return new WP_Error( 'exception', 'Erro ao conectar na API da URBS', array( 'status' => 500 ) );
            }

            if ( is_wp_error( $response ) ) {
                return new WP_Error( 'api_error', 'Erro ao processar dados', array( 'status' => 500 ) );
            }

            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );

            if ( ! isset( $data->data ) ) {
                return new WP_Error( 'invalid_data', 'Dados inválidos da API', array( 'status' => 500 ) );
            }

            $linhas = $data->data;
            set_transient( $cache_key, $linhas, urbs_seconds_until_next_reset() );
        }
    } catch (Exception $e) {
        error_log( $e->getMessage() );
        return new WP_Error( 'exception', 'Erro ao processar dados', array( 'status' => 500 ) );
    }

    return rest_ensure_response( $linhas );
}

function get_info_linhas_completas_urbs( $request ) {
    $codigo_linha = $request->get_param( 'codigo_linha' );
    $cache_key = 'urbs_info_linhas_completas_data' . sanitize_key( $codigo_linha );
    $infoLinhasCompletas = get_transient( $cache_key );

    try {
        if ( false === $infoLinhasCompletas ) {
            
            try {
                $url = 'https://scf-horario-onibus-api.dsv.urbs.curitiba.pr.gov.br/api/info-linhas-completas/' . urlencode( $codigo_linha );
                $response = wp_remote_get( $url, array( 'sslverify' => false ) );
            } catch (Exception $e) {
                error_log( $e->getMessage() );
                return new WP_Error( 'exception', 'Erro ao conectar na API da URBS', array( 'status' => 500 ) );
            }

            if ( is_wp_error( $response ) ) {
                return new WP_Error( 'api_error', 'Erro ao processar dados', array( 'status' => 500 ) );
            }

            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );

            if ( ! isset( $data->data ) ) {
                return new WP_Error( 'invalid_data', 'Dados inválidos da API', array( 'status' => 500 ) );
            }

            $infoLinhasCompletas = $data->data;
            set_transient( $cache_key, $infoLinhasCompletas, urbs_seconds_until_next_reset() );
        }
    } catch (Exception $e) {
        error_log( $e->getMessage() );
        return new WP_Error( 'exception', 'Erro ao processar dados', array( 'status' => 500 ) );
    }

    return rest_ensure_response( $infoLinhasCompletas );
}

function get_horarios_pontos_urbs( $request ) {
    $codigo_linha = $request->get_param( 'codigo_linha' );
    $cache_key = 'urbs_horarios_' . sanitize_key( $codigo_linha );
    $horarios = get_transient( $cache_key );

    try {
        if ( false === $horarios ) {
            
            try {
                $url = 'https://scf-horario-onibus-api.dsv.urbs.curitiba.pr.gov.br/api/horarios-pontos?codigo_linha=' . urlencode( $codigo_linha );
                $response = wp_remote_get( $url, array( 'sslverify' => false ) );
            } catch (Exception $e) {
                error_log( $e->getMessage() );
                return new WP_Error( 'exception', 'Erro ao conectar na API da URBS', array( 'status' => 500 ) );
            }

            if ( is_wp_error( $response ) ) {
                return new WP_Error( 'api_error', 'Erro ao processar dados', array( 'status' => 500 ) );
            }

            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );

            if ( ! isset( $data->data ) ) {
                return new WP_Error( 'invalid_data', 'Dados inválidos da API', array( 'status' => 500 ) );
            }

            $horarios = $data->data;
            set_transient( $cache_key, $horarios, urbs_seconds_until_next_reset() );
        }
    } catch (Exception $e) {
        error_log( $e->getMessage() );
        return new WP_Error( 'exception', 'Erro ao acessar dados', array( 'status' => 500 ) );
    }

    return rest_ensure_response( $horarios );
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'urbs/v1', '/linhas', array(
        'methods' => 'GET',
        'callback' => 'get_horarios_linhas_urbs',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( 'urbs/v1', '/info-linhas-completas/(?P<codigo_linha>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_info_linhas_completas_urbs',
        'permission_callback' => '__return_true',
        'args' => array(
            'codigo_linha' => array(
                'required' => true,
                'validate_callback' => function( $param ) {
                    return ! empty( $param );
                }
            ),
        ),
    ) );

    register_rest_route( 'urbs/v1', '/horarios-pontos', array(
        'methods' => 'GET',
        'callback' => 'get_horarios_pontos_urbs',
        'permission_callback' => '__return_true',
    ) );
});
