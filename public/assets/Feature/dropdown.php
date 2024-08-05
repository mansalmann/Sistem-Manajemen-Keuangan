<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <select name="" class="jenisTransaksi" id="">
        <option value="Pemasukan">Pemasukan</option>
        <option value="Pengeluaran">Pengeluaran</option>
    </select>
    <select name="" class="tipeTransaksi" id="">

    </select>
    <script>
        let jenisTransaksi = document.querySelector(".jenisTransaksi");
        let tipeTransaksi = document.querySelector(".tipeTransaksi");

        let fetchData = (e) => {

            let opsiTransaksi = jenisTransaksi.value;

            fetch(`DatabaseDropdown.php?transaksi=` + opsiTransaksi)
                .then(response => response.json())
                .then(data => {

                    tipeTransaksi.innerHTML = "";
                    let getData = "";
                    while (getData = data.shift()) {
                        let opsi = document.createElement("option");
                        opsi.textContent = getData;
                        opsi.value = getData;
                        tipeTransaksi.appendChild(opsi);

                    }

                })
                .catch(error => {
                    console.log("error");
                })
        }

        jenisTransaksi.addEventListener("change", fetchData);

        window.addEventListener("load", fetchData);

    </script>
</body>

</html>