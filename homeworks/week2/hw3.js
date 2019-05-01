function reverse(str) {
  const strArr = str.split('');
  const strRev = [];
  for (let i = (strArr.length - 1); i >= 0; i -= 1) {
    strRev.push(strArr[i]);
  }
  return strRev.join('');
  // console.log(str);
}
reverse('12');
