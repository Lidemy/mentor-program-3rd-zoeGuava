const request = require('request');
const process = require('process');

if (process.argv[2] === 'list') {
  request.get(
    'https://lidemy-book-store.herokuapp.com/books?_limit=20',
    (error, response, body) => {
      const bookList = JSON.parse(body);
      for (let i = 0; i < 20; i += 1) {
        console.log(`${i + 1} ${bookList[i].name}`);
      }
    },
  );
} else if (process.argv[2] === 'read') {
  request.get(
    `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
    (error, response, body) => {
      const bookList = JSON.parse(body);
      console.log(bookList);
    },
  );
} else if (process.argv[2] === 'delete') {
  request.delete(
    `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
    console.log('delete successful'),
  );
} else if (process.argv[2] === 'create') {
  request.post(
    {
      url: 'https://lidemy-book-store.herokuapp.com/books/',
      form: {
        name: process.argv[3],
      },
    },
    (error, response, body) => {
      const bookList = JSON.parse(body);
      console.log(bookList);
      console.log('create successful');
    },
  );
} else if (process.argv[2] === 'update') {
  request.patch(
    {
      url: `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
      form: {
        name: process.argv[4],
      },
    },
    (error, response, body) => {
      const bookList = JSON.parse(body);
      console.log(bookList);
      console.log('update successful');
    },
  );
} else {
  console.log('You have a wrong command.');
}
