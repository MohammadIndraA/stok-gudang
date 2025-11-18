function initFileMultipleUploader(dropAreaId, inputId, previewId) {
    const dropArea = document.getElementById(dropAreaId);
    const fileInput = document.getElementById(inputId);
    const previewContainer = document.getElementById(previewId);
    let selectedFiles = [];

    if (!dropArea || !fileInput || !previewContainer) return;

    dropArea.addEventListener("click", (e) => {
        if (e.target.tagName !== "BUTTON") fileInput.click();
    });

    ["dragenter", "dragover", "dragleave", "drop"].forEach((event) => {
        dropArea.addEventListener(event, (e) => {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    dropArea.addEventListener("dragenter", () => {
        dropArea.classList.add("border-blue-400", "bg-blue-50");
    });

    dropArea.addEventListener("dragleave", () => {
        dropArea.classList.remove("border-blue-400", "bg-blue-50");
    });

    dropArea.addEventListener("drop", (e) => {
        dropArea.classList.remove("border-blue-400", "bg-blue-50");
        const files = Array.from(e.dataTransfer.files);
        if (files.length) {
            selectedFiles = selectedFiles.concat(files);
            updatePreview();
        }
    });

    fileInput.addEventListener("change", function () {
        const files = Array.from(this.files);
        if (files.length) {
            selectedFiles = selectedFiles.concat(files);
            updatePreview();
        }
    });

    function updatePreview() {
        previewContainer.innerHTML = "";
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const wrapper = document.createElement("div");
                wrapper.className = "relative";

                const removeBtn = document.createElement("button");
                removeBtn.innerHTML = "❌";
                removeBtn.className =
                    "absolute top-1 right-1 bg-white rounded-full text-red-500 text-xs px-2 py-1 shadow z-10";
                removeBtn.addEventListener("click", (ev) => {
                    ev.stopPropagation();
                    selectedFiles.splice(index, 1);
                    updatePreview();
                });

                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "mx-auto rounded-md mb-4";
                    img.style.maxWidth = "200px";
                    img.style.maxHeight = "200px";
                    wrapper.appendChild(img);
                } else if (file.type === "application/pdf") {
                    const iframe = document.createElement("iframe");
                    iframe.src = e.target.result;
                    iframe.className = "w-full h-64 mb-4 border rounded-md";
                    wrapper.appendChild(iframe);
                } else {
                    const msg = document.createElement("p");
                    msg.textContent = `File ${file.name} tidak bisa dipreview.`;
                    msg.className = "text-sm text-gray-500 mb-2";
                    wrapper.appendChild(msg);
                }

                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        const dataTransfer = new DataTransfer();
        selectedFiles.forEach((file) => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }
}

// Optional: hapus file lama (edit mode)
function removeExistingFile(fileId, button) {
    const wrapper = button.closest(".relative");
    if (wrapper) wrapper.remove();

    // Tambahkan hidden input untuk backend jika perlu
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "deleted_files[]";
    input.value = fileId;
    document.querySelector("form").appendChild(input);
}
