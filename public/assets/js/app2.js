let jenisTransaksi = document.querySelector(".jenisTransaksi");
let tipeTransaksi = document.querySelector(".tipeTransaksi");

let fetchData = (e) => {
  let opsiTransaksi = jenisTransaksi.value;

  fetch(`assets/Feature/DatabaseDropdown.php?transaksi=` + opsiTransaksi)
    .then((response) => response.json())
    .then((data) => {
      tipeTransaksi.innerHTML = "";
      let getData = "";
      while ((getData = data.shift())) {
        let opsi = document.createElement("option");
        opsi.textContent = getData;
        opsi.value = getData;
        tipeTransaksi.appendChild(opsi);
      }
    })
    .catch((error) => {
      console.log("error");
    });
};

jenisTransaksi.addEventListener("change", fetchData);

window.addEventListener("load", fetchData);
