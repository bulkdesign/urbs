(() => {
    if (!document.querySelectorAll('.horario-de-onibus').length) {
        return false;
    }

    const horarioWrapper = document.querySelectorAll('.horario-de-onibus');

    horarioWrapper.forEach((horario) => {

        // Linhas
        const listaLinhas = async () => {
            let linhasData = [];

            try {
                const linhasEndpoint = await fetch('/wp-json/urbs/v1/linhas');
                if (!linhasEndpoint.ok) {
                    throw new Error(`HTTP error! status: ${linhasEndpoint.status}`);
                }
                linhasData = await linhasEndpoint.json();
            } catch (error) {
                console.error('Error fetching linhas:', error);
                return;
            }

            // Dropdown das Linhas
            const linhasSelect = horario.querySelector('select[name="horario-de-onibus-linhas"]');

            linhasData.forEach((linha) => {
                const linhasOption = document.createElement('option');
                linhasOption.value = linha.codigo;
                linhasOption.textContent = linha.linha;
                linhasSelect.appendChild(linhasOption);
            });

            // Initialize Choices.js on the linhas select
            const linhasChoices = new Choices(linhasSelect, {
                searchEnabled: true,
                searchPlaceholderValue: 'DIGITE O NOME DE UMA LINHA...',
                noResultsText: 'Nenhuma linha encontrada',
                noChoicesText: 'Nenhuma opção disponível',
                itemSelectText: 'Clique para selecionar',
                shouldSort: false,
                searchFields: ['label'],
                fuseOptions: {
                    threshold: 0.3,
                    distance: 100
                }
            });

            // Elements
            const linhaInfo = horario.querySelector('.horario-de-onibus-linha-info');
            const listaHorarios = horario.querySelector('.horario-de-onibus-lista');
            let horarioData = [];

            // Function to display line info
            const exibirLinhaInfo = async (codigoLinha) => {
                linhaInfo.innerHTML = '<p>Carregando informações...</p>';

                try {
                    const infoLinhasCompletasEndpoint = await fetch(`/wp-json/urbs/v1/info-linhas-completas/${codigoLinha}`);

                    if (!infoLinhasCompletasEndpoint.ok) {
                        throw new Error(`HTTP error! status: ${infoLinhasCompletasEndpoint.status}`);
                    }

                    const infoLinhasCompletas = await infoLinhasCompletasEndpoint.json();

                    linhaInfo.innerHTML = '';

                    if (!infoLinhasCompletas) {
                        linhaInfo.innerHTML = '<p>Nenhuma informação disponível.</p>';
                        return;
                    }

                    // Display main line information
                    const infoContainer = document.createElement('div');
                    infoContainer.className = 'linha-info-detalhes';

                    // Add color indicator
                    if (infoLinhasCompletas.cor) {
                        const linhaCor = infoLinhasCompletas.nome_cor.toLowerCase().replace(' ', '-');
                        linhaInfo.setAttribute('data-linha-cor', linhaCor);
                    }

                    // Line name and code
                    const linhaHeader = document.createElement('h4');
                    linhaHeader.textContent = `${infoLinhasCompletas.nome} - Linha ${infoLinhasCompletas.codigo}`;
                    infoContainer.appendChild(linhaHeader);

                    // Line details
                    const detalhes = [
                        { label: 'Categoria', value: infoLinhasCompletas.categoria_servico },
                        { label: 'Tipo de Linha', value: infoLinhasCompletas.tipo_linha },
                        { label: 'Abrangência', value: infoLinhasCompletas.abrangencia },
                        { label: 'Data de Implantação', value: infoLinhasCompletas.data_implantacao },
                        { label: 'Somente Cartão', value: infoLinhasCompletas.somente_cartao === 'S' ? 'Sim' : 'Não' },
                    ];

                    if (infoLinhasCompletas.observacoes) {
                        detalhes.push({ label: 'Observações', value: infoLinhasCompletas.observacoes });
                    }

                    detalhes.forEach(({ label, value }) => {
                        const detalheItem = document.createElement('p');
                        detalheItem.innerHTML = `<strong>${label}:</strong> ${value}`;
                        infoContainer.appendChild(detalheItem);
                    });

                    linhaInfo.appendChild(infoContainer);

                    // Display bus stops (pontos)
                    if (infoLinhasCompletas.pontos && infoLinhasCompletas.pontos.length > 0) {
                        const pontosHeader = document.createElement('h5');
                        pontosHeader.textContent = 'Pontos de Parada';
                        linhaInfo.appendChild(pontosHeader);

                        const pontosList = document.createElement('ul');
                        pontosList.className = 'linha-pontos-lista';

                        infoLinhasCompletas.pontos.forEach((ponto) => {
                            const pontoItem = document.createElement('li');
                            pontoItem.textContent = ponto.ponto;
                            pontosList.appendChild(pontoItem);
                        });

                        linhaInfo.appendChild(pontosList);
                    }
                } catch (error) {
                    console.error('Error fetching info linhas completas:', error);
                    linhaInfo.innerHTML = '<p>Erro ao carregar informações da linha.</p>';
                }
            };

            // Function to display schedules
            const exibirHorarios = (filteredData) => {
                listaHorarios.innerHTML = '';
                filteredData.forEach((todosHorarios) => {
                    const listaItem = document.createElement('li');
                    listaItem.textContent = todosHorarios.horario_tela;
                    listaHorarios.appendChild(listaItem);
                });
            };

            // Horários dos Pontos - Listen to Choices.js change event
            linhasSelect.addEventListener('change', async (linha) => {
                const linhaSelecionada = linha.target.value;

                if (!linhaSelecionada) return;

                // Fetch line info
                exibirLinhaInfo(linhaSelecionada);

                // Fetch schedules
                try {
                    const horarioPontosEndpoint = await fetch(`/wp-json/urbs/v1/horarios-pontos?codigo_linha=${linhaSelecionada}`);
                    if (!horarioPontosEndpoint.ok) {
                        throw new Error(`HTTP error! status: ${horarioPontosEndpoint.status}`);
                    }
                    horarioData = await horarioPontosEndpoint.json();
                } catch (error) {
                    console.error('Error fetching horarios:', error);
                    return;
                }

                const diaSelect = horario.querySelector('select[name="horario-de-onibus-tipo-dia"]');
                const diaSelecionado = diaSelect.value;

                if (diaSelecionado) {
                    const filteredData = horarioData.filter((item) => item.codigo_tipo_dia === diaSelecionado);
                    exibirHorarios(filteredData);
                } else {
                    exibirHorarios(horarioData);
                }
            });

            // Tipo de Dia
            const diaSelect = horario.querySelector('select[name="horario-de-onibus-tipo-dia"]');

            diaSelect.addEventListener('change', (dia) => {
                const diaSelecionado = dia.target.value;

                if (!horarioData.length) return;

                if (!diaSelecionado) {
                    exibirHorarios(horarioData);
                    return;
                }

                const filteredData = horarioData.filter((item) => item.codigo_tipo_dia === diaSelecionado);
                exibirHorarios(filteredData);
            });

            // Initialize Choices.js on the days select
            const diasChoices = new Choices(diaSelect, {
                searchEnabled: true,
                searchPlaceholderValue: 'Digite para buscar...',
                noResultsText: 'Nenhuma opção encontrada',
                noChoicesText: 'Nenhuma opção disponível',
                itemSelectText: 'Clique para selecionar',
                shouldSort: false,
                searchFields: ['label'],
                classNames: {
                    containerOuter: ['choices', 'dia-choices']
                },
                fuseOptions: {
                    threshold: 0.3,
                    distance: 100
                }
            });

        };

        listaLinhas();        

    });

})();