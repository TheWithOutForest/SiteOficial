// scriptagendamento.js

document.getElementById('formAgendamento').addEventListener('submit', function(event) {
    event.preventDefault();

    const ingresso = document.getElementById('ingresso').value;
    const dataInput = document.getElementById('data').value;
    const fazenda = document.querySelector('input[name="fazenda"]:checked').value;
    const mensagemEl = document.getElementById('mensagem');

    const data = new Date(dataInput + 'T00:00:00');
    const hoje = new Date();
    hoje.setHours(0, 0, 0, 0);

    const diaDaSemana = data.getDay();

    if (data < hoje) {
        mensagemEl.textContent = "Não é possível agendar para uma data no passado.";
        mensagemEl.className = "text-danger";
    } else if (diaDaSemana === 0 || diaDaSemana === 6) { // 0 é domingo e 6 é sábado
        window.location.href = "pagamento.html";
    } else {
        mensagemEl.textContent = "Os agendamentos só podem ser feitos aos finais de semana (sábado ou domingo).";
        mensagemEl.className = "text-danger";
    }
});
