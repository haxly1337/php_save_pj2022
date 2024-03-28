const [date, time] = formatDate(new Date()).split(' ');
console.log(date); // 👉️ 2021-12-31
console.log(time); // 👉️ 09:43

// ✅ Set Date input Value
const dateInput = document.getElementById('date');
dateInput.value = date;

// 👇️️ "2021-12-31"
console.log('dateInput value: ', dateInput.value);

// ✅ Set time input value
const timeInput = document.getElementById('time');
timeInput.value = time;

// 👇️ "09:43"
console.log('timeInput value: ', timeInput.value);

// ✅ Set datetime-local input value
const datetimeLocalInput = document.getElementById('datetime-local');
datetimeLocalInput.value = date + 'T' + time;

// 👇️ "2021-12-31T10:09"
console.log('dateTimeLocalInput value: ', datetimeLocalInput.value);

// 👇️👇️👇️ Format Date as yyyy-mm-dd hh:mm:ss
// 👇️ (Helper functions)
function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date) {
  return (
    [
      date.getFullYear(),
      padTo2Digits(date.getMonth() + 1),
      padTo2Digits(date.getDate()),
    ].join('-') +
    ' ' +
    [
      padTo2Digits(date.getHours()),
      padTo2Digits(date.getMinutes()),
      // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
    ].join(':')
  );
}

// 👇️ 2021-12-31 09:46
formatDate(new Date());

// 👇️ 2025-05-04 05:24
formatDate(new Date('May 04, 2025 05:24:07'));
