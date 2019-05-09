// function isPalindromes(str) {
//   console.log(str);
// }

// module.exports = isPalindromes;

function isPalindromes(str) {
  const strArr = str.split('');
  let strRev = [];
  for (let i = strArr.length - 1; i >= 0; i -= 1) {
    strRev += strArr[i];
  }
  return strRev === str;
}

isPalindromes('abcba');

module.exports = isPalindromes;
