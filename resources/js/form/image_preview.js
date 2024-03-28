const inputImage = document.getElementById('image');
const previewContainer = document.getElementById('preview');
const emptyPlaceholder = 'https://bub.bh/wp-content/uploads/2018/02/image-placeholder.jpg'
const changeImgButton = document.getElementById("change-img-button");
const changeImgContainer = document.getElementById("change-img-container");

let blobURL;
//che quando cambio qualcosa nell'input
inputImage.addEventListener('change', () => {

    if (inputImage.files && inputImage.files[0]) {
        const file = inputImage.files[0];
        blobURL = URL.createObjectURL(file);

        previewContainer.src = blobURL;
    } else {
        previewContainer.src =  emptyPlaceholder

    }
        
})

if (changeImgButton)
{
    changeImgButton.addEventListener("click", () => {
        changeImgContainer.classList.add("d-none");
        inputImage.classList.remove("d-none");
        inputImage.click();
    });
}



//slug 
const slugContainer = document.getElementById("slug");
const titleContainer = document.getElementById("title");


slugContainer.value = titleContainer.value.trim().split(' ').join('-');
titleContainer.addEventListener('blur', () => {
    slugContainer.value = titleContainer.value.trim().split(" ").join("-");
})


//per liberarlo quando esco dalla pagina altrimenti rallenta il programma
window.addEventListener('beforeunload', () => {
    if(blobURL) URL.revokeObjectURL(blobURL);
})


