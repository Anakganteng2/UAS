// Fungsi untuk mendapatkan parameter URL
function getParameterByName(name) {
  const url = window.location.search;
  const params = new URLSearchParams(url);
  return params.get(name);
}

const nomorsurat = getParameterByName("nomorsurat");

function tampilkanSurat() {
  // Fetch judul dan deskripsi surat dari API lokal
  fetch(`http://127.0.0.1:8000/api/apiqu`)
    .then((response) => response.json())
    .then((data) => {
      const surat = data.data.find(surat => surat.nomorSurat == nomorsurat);

      if (surat) {
        //judul halaman
        document.getElementById(
          "title-surat"
        ).textContent = `Surat ${surat.namaLatin}`;

        //judul surat
        document.getElementById("judul-surat").innerHTML = `
            <strong>${surat.namaLatin} - ${surat.namaSurat}</strong>
            <p>Jumlah Ayat: ${surat.jumlahAyat} (${surat.arti})</p>
            <h3>Tempat Turun: ${surat.tempatTurun}</h3>
            <h6>Deskripsi: ${surat.deskripsi}</h6>
          `;
        
        // Fetch isi surat dari API lokal
        fetch(`http://127.0.0.1:8000/api/apiqu/${nomorsurat}`)
          .then((response) => response.json())
          .then((data) => {
            const ayatList = data.data;

            const isiSurat = ayatList
              .map(
                (ayat) => `
              <div class="card mb-3 shadow-sm">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-1">
                              <div class="ayat-number">${ayat.nomorAyat}</div>
                          </div>
                          <div class="col-md-11">
                              <h3 class="text-end mb-2 ayat-arab">${ayat.teksArab}</h3>
                              <p class="ayat-latin">${ayat.teksLatin}</p>
                              <p class="ayat-terjemahan">${ayat.teksIndonesia}</p>
                          </div>
                      </div>
                  </div>
              </div> `
              )
              .join("");

            document.querySelector(".bagian-isi-surat").innerHTML = isiSurat;
          })
          .catch((error) => console.error("Error fetching ayat:", error));
      } else {
        console.error("Surat tidak ditemukan");
      }
    })
    .catch((error) => console.error("Error fetching surat:", error));
}

tampilkanSurat();
