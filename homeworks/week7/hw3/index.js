const display = document.querySelector('.display');
const keyContainer = document.querySelector('.keyContainer');
let hasOperator = false;
// 預設 false 代表還沒按過 operators
let firstValue;
let operators;
let secondValue;

// 進行運算
function operation(n1, oper, n2) {
  let result;
  switch (oper) {
    case '+':
      result = Number(n1) + Number(n2);
      break;
    case '-':
      result = Number(n1) - Number(n2);
      break;
    case '×':
      result = Number(n1) * Number(n2);
      break;
    case '÷':
      result = Number(n1) / Number(n2);
      break;
    default:
      break;
  }
  return result;
}

function keyNum(e) {
  if (e.target.classList.contains('key_items')) {
    // 代入按鍵上的值
    const key = e.target.innerText;
    // 處理鍵入的數值
    switch (key) {
      case '0':
      case '1':
      case '2':
      case '3':
      case '4':
      case '5':
      case '6':
      case '7':
      case '8':
      case '9':
        if (display.textContent === '0') {
          display.textContent = '';
        }
        display.textContent += e.target.innerText;
        break;
      case 'AC':
        display.textContent = '0';
        hasOperator = false;
        break;
      case '.':
        if (display.textContent.includes('.') === false) {
          display.textContent += e.target.innerText;
        }
        break;
      default:
        break;
    }
    // 按下運算子後賦值給 firstValue, operators
    if (e.target.classList.contains('operators') && hasOperator === false) {
      firstValue = display.textContent;
      operators = e.target.innerText;
      hasOperator = true;
      display.textContent = '0';
    } else if (key === '=' && hasOperator === true) {
      secondValue = display.textContent;
      hasOperator = false;
      display.textContent = operation(firstValue, operators, secondValue);
    }
  }
}

keyContainer.addEventListener('click', keyNum, false);
