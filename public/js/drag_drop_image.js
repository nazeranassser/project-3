const dropArea = document.getElementById('drop-area');
const fileElem = document.getElementById('fileElem');
const previewContainer = document.getElementById('preview-container');
const previewImage = document.getElementById('preview-image');
const cancelBtn = document.getElementById('cancel-btn');
let selectedFile;

// Highlight the drop area when dragging over
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('dragover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('dragover');
    const files = e.dataTransfer.files;
    handleFiles(files);
});

document.getElementById('browse').addEventListener('click', () => {
    fileElem.click();
});

fileElem.addEventListener('change', () => {
    handleFiles(fileElem.files);
});

function handleFiles(files) {
    if (files.length > 0) {
        selectedFile = files[0];
        previewImage.src = URL.createObjectURL(selectedFile);
        previewContainer.style.display = 'block';
        dropArea.style.display = 'none';
    }
}

cancelBtn.addEventListener('click', () => {
    selectedFile = null;
    previewContainer.style.display = 'none';
    dropArea.style.display = 'block';
    previewImage.src = '';
    fileElem.value = '';

});