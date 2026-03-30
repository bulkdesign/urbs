window.addEventListener('load', () => {
    if (!document.querySelectorAll('.horario-de-onibus').length) {
        return false;
    }

    const horarioWrapper = document.querySelectorAll('.horario-de-onibus');

    horarioWrapper.forEach((horario) => {
        const themeUrl = horario.getAttribute('data-theme-url');
        
        // Variáveis globais do bloco
        let horarioData = [];
        let linhasGlobais = []; // Vai guardar todas as linhas na memória

        // ==========================================
        // 1. Função para desenhar a Grelha de Horários
        // ==========================================
        const exibirHorarios = (dados) => {
            let resultadosContainer = horario.querySelector('.horario-de-onibus-resultados');
            
            if (!resultadosContainer) {
                const oldList = horario.querySelector('.horario-de-onibus-lista');
                resultadosContainer = document.createElement('div');
                resultadosContainer.className = 'horario-de-onibus-resultados';
                if (oldList) {
                    oldList.parentNode.replaceChild(resultadosContainer, oldList);
                } else {
                    horario.querySelector('.horario-de-onibus-content-wrapper').appendChild(resultadosContainer);
                }
            }

            resultadosContainer.innerHTML = ''; 

            if (!dados || dados.length === 0) {
                resultadosContainer.innerHTML = '<p style="color: #666; padding: 15px; text-align: center; background: #f8f9fa; border-radius: 5px;">Nenhum horário encontrado para este dia.</p>';
                return;
            }

            const dadosAgrupados = dados.reduce((acc, item) => {
                if (!acc[item.PONTO]) acc[item.PONTO] = []; 
                acc[item.PONTO].push(item.HORA); 
                return acc;
            }, {});

            for (const [ponto, horariosPonto] of Object.entries(dadosAgrupados)) {
                const titulo = document.createElement('h4');
                titulo.className = 'horario-ponto-titulo';
                titulo.textContent = ponto;
                resultadosContainer.appendChild(titulo);

                const ul = document.createElement('ul');
                ul.className = 'horario-de-onibus-lista';

                horariosPonto.forEach(hora => {
                    const li = document.createElement('li');
                    li.textContent = hora;
                    ul.appendChild(li);
                });

                resultadosContainer.appendChild(ul);
            }
        };

        // ==========================================
        // 2. Lógica para carregar as Linhas (Do JSON Estático!)
        // ==========================================
        const listaLinhas = async () => {
            const linhasSelect = horario.querySelector('select[name="horario-de-onibus-linhas"]');

            try {
                // FETCH TURBINADO: Busca direto do arquivo estático que geramos
                const cacheUrlLinhas = '/wp-content/cache/urbs_horarios/linhas_ativas.json';
                const linhasEndpoint = await fetch(cacheUrlLinhas);
                
                if (!linhasEndpoint.ok) throw new Error(`HTTP error! status: ${linhasEndpoint.status}`);
                linhasGlobais = await linhasEndpoint.json(); // Salva na memória
            } catch (error) {
                console.error('Error fetching linhas estáticas:', error);
                const containerInfo = horario.querySelector('.horario-de-onibus-linha-info') || horario;
                containerInfo.innerHTML = '<p class="erro-api" style="color: #842029; text-align: center;">Não foi possível carregar as linhas no momento.</p>';
                return;
            }

            // Preenche o Select usando as chaves novas (COD e NOME)
            linhasGlobais.forEach((linha) => {
                const linhasOption = document.createElement('option');
                linhasOption.value = linha.COD;
                linhasOption.textContent = `${linha.COD} - ${linha.NOME}`; // Fica mais legal mostrando o código junto!
                linhasSelect.appendChild(linhasOption);
            });

            if (typeof Choices !== 'undefined') {
                new Choices(linhasSelect, {
                    searchEnabled: true,
                    searchPlaceholderValue: 'Digite para buscar...',
                    noResultsText: 'Nenhuma opção encontrada',
                    noChoicesText: 'Nenhuma opção disponível',
                    itemSelectText: 'Clique para selecionar',
                    shouldSort: false
                });
            }
        };

        listaLinhas();

        // ==========================================
        // 3. Evento Principal: Mudança da Linha
        // ==========================================
        const linhasSelect = horario.querySelector('select[name="horario-de-onibus-linhas"]');
        const diaSelect = horario.querySelector('select[name="horario-de-onibus-tipo-dia"]');

        linhasSelect.addEventListener('change', async (e) => {
            const codigoLinha = e.target.value;
            if (!codigoLinha) return;

            const containerInfo = horario.querySelector('.horario-de-onibus-linha-info');
            
            // --- A. RECUPERANDO AS INFORMAÇÕES DA LINHA (Da memória, sem API!) ---
            // Acha a linha selecionada dentro do array que já baixamos
            const infoData = linhasGlobais.find(l => l.COD === codigoLinha);

            if (infoData) {
                if (infoData.NOME_COR) {
                    const linhaCor = infoData.NOME_COR.toLowerCase().replace(/\s+/g, '-');
                    containerInfo.setAttribute('data-linha-cor', linhaCor);
                } else {
                    containerInfo.removeAttribute('data-linha-cor');
                }

                const ehSomenteCartao = infoData.SOMENTE_CARTAO === 'S' ? '💳 Somente Cartão' : '💵 Dinheiro / Cartão';
                const corLinha = infoData.NOME_COR || 'Indefinida';
                const categoria = infoData.CATEGORIA_SERVICO || 'Convencional';
                
                containerInfo.innerHTML = `
                    <div class="linha-info-detalhes">
                        <h3>${infoData.NOME}</h3>
                        <ul>
                            <li><strong>Código:</strong> ${infoData.COD}</li>
                            <li><strong>Categoria:</strong> ${categoria}</li>
                            <li><strong>Cor:</strong> ${corLinha}</li>
                            <li><strong>Pagamento:</strong> ${ehSomenteCartao}</li>
                        </ul>
                    </div>
                `;
            } else {
                containerInfo.innerHTML = '';
                containerInfo.removeAttribute('data-linha-cor');
            }

            // --- B. CARREGANDO OS HORÁRIOS ESTÁTICOS ---
            try {
                const cacheUrl = '/wp-content/cache/urbs_horarios/linha_${codigoLinha}.json';
                
                const response = await fetch(cacheUrl);
                if (!response.ok) throw new Error('Arquivo de cache não encontrado para esta linha.');
                
                horarioData = await response.json();

                const diaSelecionado = diaSelect.value;
                if (diaSelecionado) {
                    const filteredData = horarioData.filter((item) => item.DIA === diaSelecionado);
                    exibirHorarios(filteredData);
                } else {
                    exibirHorarios(horarioData);
                }

            } catch (error) {
                console.error('Erro ao buscar o JSON estático:', error);
                let resultadosContainer = horario.querySelector('.horario-de-onibus-resultados');
                if (resultadosContainer) {
                    resultadosContainer.innerHTML = '<p style="color: #dc3545; padding: 15px; text-align: center; background: #f8d7da; border-radius: 5px;">Os horários desta linha ainda não foram atualizados ou não estão disponíveis.</p>';
                }
            }
        });

        // ==========================================
        // 4. Lógica de Filtrar por Dia
        // ==========================================
        diaSelect.addEventListener('change', (e) => {
            const diaSelecionado = e.target.value;
            if (!horarioData.length) return;

            if (!diaSelecionado) {
                exibirHorarios(horarioData);
                return;
            }

            const filteredData = horarioData.filter((item) => item.DIA === diaSelecionado);
            exibirHorarios(filteredData);
        });

        if (typeof Choices !== 'undefined') {
            new Choices(diaSelect, {
                searchEnabled: true,
                searchPlaceholderValue: 'Digite para buscar...',
                noResultsText: 'Nenhuma opção encontrada',
                noChoicesText: 'Nenhuma opção disponível',
                itemSelectText: 'Clique para selecionar',
                shouldSort: false,
                searchFields: ['label']
            });
        }
    });
});