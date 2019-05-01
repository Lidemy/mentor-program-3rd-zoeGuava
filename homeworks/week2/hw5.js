// function join(str, concatStr) {
//   return concatStr;
// }

// function repeat(str, times) {
//   return times;
// }

// console.log(join('a', '!'));
// console.log(repeat('a', 5));


function join(str, conacatStr) {
  const result = [];
  for (let i = 0; i < str.length; i += 1) {
    if (i < str.length - 1) {
      result.push(str[i] + conacatStr);
    } else {
      result.push(str[i]);
    }
  }
  // result = result.toString()
  return result.toString().replace(/,/g, '');
  // console.log(finalResult)
}
join(['1st', '2nd', '3rd', '4th', '5th'], '!');
