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

            const linhasSelect = horario.querySelector('select[name="horario-de-onibus-linhas"]');

            linhasData.forEach((linha) => {
                const linhasOption = document.createElement('option');
                linhasOption.value = linha.codigo;
                linhasOption.textContent = linha.linha;
                linhasSelect.appendChild(linhasOption);
            });

            const listaHorarios = horario.querySelector('.horario-de-onibus-lista');
            let horarioData = [];

            const exibirHorarios = (filteredData) => {
                listaHorarios.innerHTML = '';
                filteredData.forEach((todosHorarios) => {
                    const listaItem = document.createElement('li');
                    listaItem.textContent = todosHorarios.horario_tela;
                    listaHorarios.appendChild(listaItem);
                });
            };

            // Horários dos Pontos
            linhasSelect.addEventListener('change', async (linha) => {
                const linhaSelecionada = linha.target.value;

                if (!linhaSelecionada) return;

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
        };

        listaLinhas();

    });

})();