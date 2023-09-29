document.addEventListener('DOMContentLoaded', () => {
  const calculatorContainer = document.querySelector('.calculator-container');
    calculatorContainer.innerHTML = `
            <div class="calculatorLocation">
                <div class="calculator">
                    <div class="calcResults">
                        <div id="calcResult"></div>
                        <div id="calcExpression"></div>
                    </div>
                    <div class="calcNumbers">
                        <button class="calcButton calcNumber" id="7">7</button>
                        <button class="calcButton calcNumber" id="8">8</button>
                        <button class="calcButton calcNumber" id="9">9</button>
        
                        <button class="calcButton calcNumber" id="4">4</button>
                        <button class="calcButton calcNumber" id="5">5</button>
                        <button class="calcButton calcNumber" id="6">6</button>
        
                        <button class="calcButton calcNumber" id="1">1</button>
                        <button class="calcButton calcNumber" id="2">2</button>
                        <button class="calcButton calcNumber" id="3">3</button>
        
                        <button class="calcButton calcNumber" id="0">0</button>
                        <button class="calcButton calcNumber" id=".">.</button>
                        <button class="calcButton calcEquals" id="=">=</button>
                    </div>
                    <div class="calcOperations">
                        <button class="calcButton calcOperation" id="*">×</button>
                        <button class="calcButton calcOperation" id="/">÷</button>
                        <button class="calcButton calcOperation" id="+">+</button>
                        <button class="calcButton calcOperation" id="-">-</button>
                    </div>
                    <div class="calcClears">
                        <button id="calcClear">AC</button>
                        <button id="calcCe">CE</button>
                    </div>
                </div>
            </div>`;
  const result = document.querySelector('#calcResult'),
    expression = document.querySelector('#calcExpression'),
    num = document.querySelectorAll('.calcNumber:not(.calcEquals)'),
    operation = document.querySelectorAll('.calcOperation'),
    equals = document.querySelector('.calcEquals'),
    clear = document.querySelector('#calcClear'),
    ce = document.querySelector('#calcCe'),
    buttons = document.querySelectorAll(".calcButton");
  let ex = '';
  result.innerHTML = '0';
  function clickN() {
    if (!ex || typeof (ex) === 'number' || ex === '0') {
      expression.innerHTML = this.id;
      ex = this.id;
    } else {
      expression.innerHTML += this.id;
      ex += this.id;
    }
    result.innerHTML = ex.split(/\/|\*|\+|-|=/).pop();
    checkLength(result.innerHTML);
  };
  function clickO() {
    if (!ex) {
      return;
    }
    ex = ex.toString().replace(/=/, '');
    if (ex.match(/\/|\*|\+|-|=/)) {
      ex = eval(ex).toString();
    }
    expression.innerHTML = expression.innerHTML.replace(/=/, '') + this.id;
    ex += this.id;
    result.innerHTML = this.id;
  };
  Array.from(num).forEach(function (element) {
    element.addEventListener('click', clickN);
  });

  Array.from(operation).forEach(function (element) {
    element.addEventListener('click', clickO);
  });
  clear.addEventListener('click', () => {
    result.innerHTML = '';
    expression.innerHTML = '';
    ex = '';
  })
  ce.addEventListener('click', () => {
    if (!expression.innerHTML.match(/=$/)) {
      expression.innerHTML = doCE(expression.innerHTML);
      ex = doCE(ex);
      result.innerHTML = 0;
      function doCE(arg) {
        arg = arg.split(/([\/\*\+\-\=])/g);
        arg.splice(-1, 1);
        return arg.join('');
      }
    }
  })
  equals.addEventListener('click', () => {
    if (!ex) {
      result.innerHTML = '0';
    } else {
      ex = eval(ex);
      expression.innerHTML += '=';
      result.innerHTML = trim12(ex);
    }
  })
  function checkLength(arg) {
    if (arg.toString().length > 10) {
      expression.innerHTML = 'number too long'.toUpperCase();
      result.innerHTML = '0';
      ex = '0';
    }
  }
  function trim12(arg) {
    if (arg.toString().length > 10) {
      ex = parseFloat(arg.toPrecision(12));
      if (ex.toString().length > 10) {
        ex = ex.toExponential(9);
      };
      return ex;
    } else {
      return arg;
    }
  }
  document.addEventListener("keydown", (event) => {
    buttons.forEach((button) => {
      if (button.id === event.key) 
        button.click();
      }
    );
  })
});