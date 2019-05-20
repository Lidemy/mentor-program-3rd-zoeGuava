const request = require('request');

request.get(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10',
  (error, response, body) => {
    const bookList = JSON.parse(body);
    for (let i = 0; i < 10; i += 1) {
      console.log(`${i + 1} ${bookList[i].name}`);
    }
  },
);
