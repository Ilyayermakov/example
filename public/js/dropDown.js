function displayCalendar() {
  const time = document.querySelectorAll('.current-time');
  const timeCalendar = document.querySelectorAll('.calendar')
  for (const form of time) {
    form.addEventListener('click', () => {
      if (form.classList.contains('activate')) {
        form.classList.remove('activate');
        document.querySelector('.calendar.activate').classList.remove('activate');
      } else {
        clearActiveClasses();
        form.classList.add('activate');
        document.querySelector('.calendar').classList.add('activate');
      }
    });
  }
  function clearActiveClasses() {
    time.forEach((form) => {
      form.classList.remove('activate');
    });
    timeCalendar.forEach((form) => {
      form.classList.remove('activate');
    });
  }
}
function displayCalculator() {
  const infin = document.querySelectorAll('.calculate-infin')
  const infinCalculator = document.querySelectorAll('.calculator-container')
  for (const form of infin) {
    form.addEventListener('click', () => {
      if (form.classList.contains('activate')) {
        form.classList.remove('activate');
        document.querySelector('.calculator-container.activate').classList.remove('activate');
      } else {
        clearActiveClasses();
        form.classList.add('activate');
        document.querySelector('.calculator-container').classList.add('activate');
      }
    });
  }
  function clearActiveClasses() {
    infin.forEach((form) => {
      form.classList.remove('activate');
    });
    infinCalculator.forEach((form) => {
      form.classList.remove('activate');
    });
  }
}
displayCalendar();
displayCalculator();
