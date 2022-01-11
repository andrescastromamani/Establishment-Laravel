document.addEventListener('DOMContentLoaded', () => {
    const lat = -17.3949854;
    const lng = -66.0581133;
    const map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    const marker = L.marker([lat, lng]).addTo(map);
});
