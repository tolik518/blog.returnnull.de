let date   = <HTMLInputElement>document.getElementById("date");

const d = new Date();
date.value = d.toISOString().slice(0, 19).replace('T', ' ');