let currentInput = '';
let operator = '';
let firstOperand = '';

function appendNumber(number) {
    currentInput += number;
    document.getElementById('display').value = currentInput;
}

function setOperator(op) {
    if (currentInput === '' && op === '-') {
        currentInput = '-';
    } else if (currentInput !== '' && firstOperand === '') {
        firstOperand = currentInput;
        operator = op;
        currentInput = '';
    }
}

function clearDisplay() {
    currentInput = '';
    operator = '';
    firstOperand = '';
    document.getElementById('display').value = '';
    document.getElementById('display').style.backgroundColor = '#fff';}

function calculate() {
    if (firstOperand !== '' && operator !== '' && currentInput !== '') {
        try {
            const result = eval(`${firstOperand} ${operator} ${currentInput}`);
            document.getElementById('display').value = result;
            currentInput = result;
            operator = '';
            firstOperand = '';

            const display = document.getElementById('display');
            if (result > 0) {
                display.style.backgroundColor = 'lightgreen';
            } else if (result < 0) {
                display.style.backgroundColor = 'lightcoral';
            } else {
                display.style.backgroundColor = 'lightgray';
            }
        } catch (error) {
            document.getElementById('display').value = 'Error';
            document.getElementById('display').style.backgroundColor = 'lightcoral';
        }
    }
}
