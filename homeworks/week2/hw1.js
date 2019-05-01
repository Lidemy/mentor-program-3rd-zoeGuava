function printStars(n) {
  if (n >= 1 && n <= 30) {
    let i;
    for (i = 1; i <= n; i += 1) {
      console.log('*');
    }
  }
}
printStars(2);
