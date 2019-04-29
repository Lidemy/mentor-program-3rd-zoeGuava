function printStars(n) {
  if (n >= 1 && n <= 30) {
    let i;
    for (i = 1; i <= n; i += 1) {
      console.log('*');
      // (n >= 1 && (n <= 30)) ? console.log('*') : undefined;
    }
  }
}
printStars(2);
