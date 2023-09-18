
const imageUrls = [
    'images/pic1.jpg',
    'images/pic2.jpg',
    'images/pic3.jpg',
    'images/pic4.jpg',
    'images/pic5.jpg',
    'images/pic6.jpg',
    'images/pic7.jpg',
    'images/pic8.jpg',
    'images/pic9.jpg',
    'images/pic10.jpg',
    'images/pic11.jpg',
];

let currentIndex = 0;

function updateImage() {
    const rotatingImage = document.getElementById('rotating-image');
    rotatingImage.src = imageUrls[currentIndex];
}

function goToPrevious() {
    currentIndex = currentIndex === 0 ? imageUrls.length - 1 : currentIndex - 1;
    updateImage();
}

function goToNext() {
    currentIndex = (currentIndex + 1) % imageUrls.length;
    updateImage();
}

// Automatically rotate images every 5 seconds
setInterval(goToNext, 5000);

// Initial image update
updateImage();





const toggleMenu = () => {
    const menu = document.getElementById("ul");
    menu.style.height = menu.style.height === "0px" ? "auto" : "0px";
};

const closeMenu = () => {
    const menu = document.getElementById("ul");
    menu.style.height = "0px";
};




