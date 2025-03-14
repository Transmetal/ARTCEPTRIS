// Pilih semua tombol accordion
const tabButtons = document.querySelectorAll('.tab_button');

tabButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const panel = button.nextElementSibling;
        console.log('Tombol diklik:', button);
        console.log('Panel terkait:', panel);

        if (!panel) {
            console.error('Panel tidak ditemukan untuk tombol:', button);
            return;
        }

        const isActive = button.classList.contains('tab_button-active');

        // Tutup semua panel sebelum membuka yang baru
        tabButtons.forEach((btn) => {
            btn.classList.remove('tab_button-active');
            const targetPanel = btn.nextElementSibling;
            if (targetPanel) {
                targetPanel.style.height = '0px';
                targetPanel.classList.remove('tab_panel-active');
            }
        });

        // Jika tombol tidak aktif, buka panel terkait
        if (!isActive) {
            button.classList.add('tab_button-active');
            const contentHeight = panel.scrollHeight + 20; // Tambahkan padding ekstra
            console.log('Tinggi konten panel:', contentHeight);
            panel.style.height = `${contentHeight}px`;
            panel.classList.add('tab_panel-active');

            // Debugging tambahan
            console.log('Tinggi panel setelah diterapkan:', panel.style.height);
            console.log('Konten panel:', panel.innerHTML);
        }
    });
});
