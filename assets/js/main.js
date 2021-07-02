// Home animation
let i = 0;
let writerTxt = 'Focus on creating awesome stuff, nothing else';
let writerElem = document.querySelector('#typewriter');
function typewriter(){
    if(i < writerTxt.length){
        writerElem.innerHTML += writerTxt.charAt(i);
        i++;
        setTimeout(typewriter, 50);
    }
}

// Preloader
window.addEventListener('load', function(){
    document.querySelector('.preloader').classList.add('hide');
    if(writerElem) typewriter();
});

// Mobile menu
document.querySelector('.mobile-menu-button').addEventListener('click', function(){
    document.querySelector('.mobile-menu').classList.toggle('show');
});

// Docs dropdown
let dropdown = document.querySelector('.dropdown-toggle')
if(dropdown){
    dropdown.addEventListener('click', function() {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
}