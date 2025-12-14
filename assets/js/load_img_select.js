document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById('productSelect');
    const preview = document.getElementById('preview');

    if (!select || !preview) return;

    select.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const imgUrl = selected.getAttribute('load-img-select');

        preview.src = imgUrl;
        preview.style.display = "block";
    });
});
