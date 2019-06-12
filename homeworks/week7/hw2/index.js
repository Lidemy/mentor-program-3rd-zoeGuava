const formWrapper = document.querySelector('.formWrapper');
const formContainer = document.querySelectorAll('.formContainer');
const starInput = document.querySelectorAll('.star ~ input');
const inputSelec = document.querySelectorAll('input[type=text]');
const checkBox = document.querySelectorAll('.checkboxContainer input');
const submitBtn = document.querySelector('.submitBtn');

function check() {
  for (let i = 0; i < starInput.length; i += 1) {
    if (starInput[i].value === '') {
      starInput[i].closest('.formContainer').classList.add('unEdit');
    } else {
      starInput[i].closest('.formContainer').classList.remove('unEdit');
    }
  }
}
formWrapper.addEventListener('click', check, false);

function result() {
  check();
  for (let i = 0; i < formContainer.length; i += 1) {
    if (formContainer[i].classList.contains('unEdit')) {
      return;
    }
  }
  alert('成功送出');
  console.log(`電子郵件地址： ${inputSelec[0].value}`);
  console.log(`暱稱： ${inputSelec[1].value}`);
  if (checkBox[0].checked) {
    console.log(`報名類型： ${checkBox[0].nextSibling.data}`);
  } else {
    console.log(`報名類型： ${checkBox[1].nextSibling.data}`);
  }
  console.log(`現在的職業： ${inputSelec[2].value}`);
  console.log(`怎麼知道這個計畫的？ ${inputSelec[3].value}`);
  console.log(`是否有程式相關背景？ ${inputSelec[4].value}`);
  console.log(`其他： ${inputSelec[5].value}`);
}
submitBtn.addEventListener('click', result, false);
