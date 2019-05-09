// function isPrime(n) {
//   console.log(n);
// }

// module.exports = isPrime;

function isPrime(n) {
  if (n === 1) {
    return true;
  }
  for (let i = 2; i <= n; i += 1) {
    if (n % i === 0 && (i > 1) && (i < n)) {
      return false;
    }
  }
  return true;
}

module.exports = isPrime;
