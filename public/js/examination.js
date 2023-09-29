// const form = document.querySelector('.examination'); // выбираем форму
// const requiredFields = form.querySelectorAll('input[required], textarea[required]'); // выбираем все обязательные поля

// form.addEventListener('submit', (event) => {
//   event.preventDefault(); // отменяем отправку формы

//   let isFormValid = true; // флаг валидности формы

//   requiredFields.forEach((field) => {
//     if (field.value.trim() === '') { // проверяем, что поле не пустое
//       isFormValid = false; // устанавливаем флаг в false, если поле не заполнено
//       field.classList.add('invalid'); // добавляем класс для стилизации поля с ошибкой
//     } else {
//       field.classList.remove('invalid'); // удаляем класс ошибки, если поле заполнено
//     }
//   });

//   if (isFormValid) {
//     form.submit(); // отправляем форму, если все поля заполнены
//   }
// });
