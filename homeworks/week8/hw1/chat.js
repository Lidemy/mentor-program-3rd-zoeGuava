const request = new XMLHttpRequest();
const chatList = document.querySelector('.chatList');

request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    const response = request.responseText;
    const json = JSON.parse(response);
    for (let i = 0; i < json.length; i += 1) {
      const container = document.createElement('div');
      container.classList.add('chatRow');
      container.innerHTML = `
        <div class="chatNum">${i + 1}</div>
        <div class="chatContent">${json[i].content}</div>
      `;
      chatList.appendChild(container);
    }
  } else {
    console.log('error');
  }
};

request.open('GET', 'https://lidemy-book-store.herokuapp.com/posts?_limit=20', true);
request.send();

const btnAdd = document.querySelector('.btn-add');

function btnClick() {
  const request2 = new XMLHttpRequest();
  const contentAdd = document.querySelector('.content-add');
  request2.open('POST', 'https://lidemy-book-store.herokuapp.com/posts', true);
  request2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request2.send(`content=${contentAdd.value}`);
}

btnAdd.addEventListener('click', btnClick(), false);
