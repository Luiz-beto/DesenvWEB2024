const boxes = document.querySelectorAll('.box');
const avaliacaoSelecionada = document.getElementById('avaliacaoSelecionada');
const prosseguirButton = document.getElementById('prosseguir');

let notaSelecionada = null;

boxes.forEach(box => {
    box.addEventListener('click', () => {
        notaSelecionada = box.dataset.valor;

        // Exibir apenas o número da nota selecionada
        avaliacaoSelecionada.textContent = notaSelecionada;

        // Definir a cor da nota selecionada
        if (notaSelecionada <= 3) {
            avaliacaoSelecionada.style.color = 'rgb(255, 0, 0)'; // Vermelho
        } else if (notaSelecionada <= 6) {
            avaliacaoSelecionada.style.color = 'rgb(255, 165, 0)'; // Laranja
        } else {
            avaliacaoSelecionada.style.color = 'rgb(50, 161, 50)'; // Verde
        }

        // Aumentar o tamanho da fonte
        avaliacaoSelecionada.style.fontSize = '3rem';

        prosseguirButton.style.display = 'block';

        // Remover a classe 'selecionada' de todas as caixas
        boxes.forEach(b => b.classList.remove('selecionada'));
        // Adicionar a classe 'selecionada' à caixa clicada
        box.classList.add('selecionada');
    });
    document.getElementById('prosseguir').addEventListener('click', () => {
        window.location.href = 'sugestao.html'; // Substitua pelo nome correto do seu arquivo
    });
    
    
});


    

