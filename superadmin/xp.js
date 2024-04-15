$(document).ready(function () {
    handleimg(3);
});

function handleimg(a) {
    const profileImage3 = $('#profdisplay3');
    const input3 = document.getElementById('changep3');

    // Define the loadIntoInput function
    function loadIntoInput(imgSrc) {
        fetch(imgSrc)
            .then(response => response.blob())
            .then(blob => {
                const file = new File([blob], "image.png", { type: "image/png" });
                const fileList = new DataTransfer();
                fileList.items.add(file);
                input3.files = fileList.files;

                // Once file is loaded into input, update profileImage4
            });
    }

 

    // Load the image into the file input field if profdisplay3 has src
    if (profileImage3.attr('src')) {
        loadIntoInput(profileImage3.attr('src'));
    }
}
