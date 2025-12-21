(() => {
    if (!document.querySelectorAll('.horario-de-onibus').length) return false;

    const horarioWrapper = document.querySelectorAll('.horario-de-onibus');

    horarioWrapper.forEach((horario) => {

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

            linhasSelect.addEventListener('change', async (linha) => {
                const linhaSelecionada = linha.target.value;

                if (!linhaSelecionada) return;

                let horarioData = [];

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

                const listaHorarios = horario.querySelector('.horario-de-onibus-lista');

                listaHorarios.innerHTML = '';

                horarioData.forEach((todosHorarios) => {
                    const listaItem = document.createElement('li');
                    listaItem.textContent = todosHorarios.horario_tela;
                    listaHorarios.appendChild(listaItem);
                });

            });
        };

        listaLinhas();

    });

})();