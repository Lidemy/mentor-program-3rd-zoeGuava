function join(arr, conacatStr) {
  if (arr.length === 0) {
    return '';
  }
  let result = arr[0];
  for (let i = 0; i < arr.length; i += 1) {
    result += conacatStr + arr[i];
  }
  return console.log(result);
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
