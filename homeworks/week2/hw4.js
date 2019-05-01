function printFactor(n) {
  for (let i = 1; i <= n; i += 1) {
    if (n % i === 0) {
      return i;
    }
  }
  return false;
}

printFactor(101);
