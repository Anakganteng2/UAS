function getSurat() {
  const listSurat = document.querySelector(".list-surat");
  listSurat.innerHTML = "<p>Loading...</p>";

  fetch("http://127.0.0.1:8000/api/apiqu")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((response) => {
      if (!response.data || response.data.length === 0) {
        listSurat.innerHTML = "<p>Tidak ada data surat ditemukan.</p>";
        return;
      }

      const surats = response.data
        .map(
          (surat) => `
        <div class="col-sm-4">
          <div class="card mb-4 surat-daftar">
            <div class="daftar-body">
              <h6 class="card-title">${surat.nomorSurat} ${surat.namaLatin}</h6>
              <h3 class="card-subtitle mb-2 text-muted text-end">${surat.namaSurat}</h3>
              <p class="card-text">${surat.arti}</p>
              <div class="card-body text-center">
                <button class="btn btn-primary" onclick="location.href='ayat.html?nomorsurat=${surat.nomorSurat}'">Lihat Ayat</button>
                <button class="btn btn-primary" onclick="location.href='tafsir.html?nomorsurat=${surat.nomorSurat}'">Lihat Tafsir</button>
              </div>
            </div>
          </div>
        </div>
      `
        )
        .join("");

      listSurat.innerHTML = surats;
    })
    .catch((error) => {
      console.error("Error fetching surat:", error);
      listSurat.innerHTML = "<p>Terjadi kesalahan saat memuat data surat.</p>"; // Menampilkan pesan kesalahan
    });
}

getSurat();
