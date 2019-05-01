function join(str, conacatStr) {
  const result = [];
  for (let i = 0; i < str.length; i += 1) {
    if (i < str.length - 1) {
      result.push(str[i] + conacatStr);
    } else {
      result.push(str[i]);
    }
  }
  return result.toString().replace(/,/g, '');
}
join(['1st', '2nd', '3rd', '4th', '5th'], '!');

function repeat(str, num) {
  let result = '';
  for (let i = 0; i < num; i += 1) {
    result += str;
  }
  return result;
}
repeat('RoKo', 2);
