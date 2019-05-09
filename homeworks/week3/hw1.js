// function stars(n) {
//   console.log(n);
// }

// module.exports = stars;

function stars(num) {
  const starsArray = [];
  for (let i = 1; i < num + 1; i += 1) {
    starsArray.push('*'.repeat(i));
  }
  return starsArray;
}
stars(3);

module.exports = stars;
