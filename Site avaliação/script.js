// Seleciona os elementos necessários
const containerAvaliacao = document.getElementById('containerAvaliacao');
const avaliacaoSelecionada = document.getElementById('avaliacaoSelecionada');
const prosseguirButton = document.getElementById('prosseguir');

// Gera as caixas de avaliação de 0 a 10
for (let i = 0; i <= 10; i++) {
    const box = document.createElement('div');
    box.classList.add('box', `box-${i}`);
    box.textContent = i;
    box.addEventListener('click', () => {
        selecionarAvaliacao(i);
    });
    containerAvaliacao.appendChild(box);
}

// Função que lida com a seleção de avaliação
function selecionarAvaliacao(avaliacao) {
    // Limpa qualquer texto anterior
    avaliacaoSelecionada.textContent = '';

    // Cria um novo elemento para exibir o número selecionado
    const numeroSelecionado = document.createElement('span');
    numeroSelecionado.textContent = avaliacao; // Define o número selecionado
    numeroSelecionado.style.fontSize = '3rem'; // Aumenta o tamanho do número
    numeroSelecionado.style.fontWeight = 'bold'; // Texto em negrito

    // Define a cor do número selecionado com base na avaliação
    if (avaliacao <= 3) {
        numeroSelecionado.style.color = 'rgb(255, 0, 0)'; // Vermelho para 0-3
    } else if (avaliacao <= 6) {
        numeroSelecionado.style.color = 'rgb(255, 165, 0)'; // Laranja para 4-6
    } else {
        numeroSelecionado.style.color = 'rgb(50, 161, 50)'; // Verde para 7-10
    }

    // Adiciona o número selecionado ao contêiner de avaliação
    avaliacaoSelecionada.appendChild(numeroSelecionado);

    // Exibe o botão de prosseguir após a seleção de uma avaliação
    prosseguirButton.style.display = 'block';
}

// Função para prosseguir após a seleção da avaliação
prosseguirButton.addEventListener('click', () => {
    // Redireciona para a página de sugestão
    window.location.href = 'sugestao.html'; // Crie uma página sugestao.html para o próximo passo
});
