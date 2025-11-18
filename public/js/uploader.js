function initImageUploader(dropAreaId, inputId, previewId) {
    const dropArea = document.getElementById(dropAreaId);
    const fileInput = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (!dropArea || !fileInput || !preview) return;

    dropArea.addEventListener('click', () => fileInput.click());

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
        dropArea.addEventListener(event, e => {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    ['dragenter', 'dragover'].forEach(event => {
        dropArea.classList.add('border-blue-400', 'bg-blue-50');
    });

    ['dragleave', 'drop'].forEach(event => {
        dropArea.classList.remove('border-blue-400', 'bg-blue-50');
    });

    dropArea.addEventListener('drop', e => {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            fileInput.files = e.dataTransfer.files;
            previewImage(file);
        }
    });

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) previewImage(file);
    });

    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
