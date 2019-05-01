function capitalize(str) {
  const strArr = str.split('');
  const strCode = strArr[0].charCodeAt(0);
  if (strCode >= 97 && strCode <= 122) {
    strArr[0] = String.fromCharCode(strCode - 32);
    return strArr.join('');
  }
  return str;
}

console.log(capitalize('hello'));
