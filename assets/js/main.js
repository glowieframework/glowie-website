// Home animation
let i = 0;
const writerTxt = 'Focus on creating awesome stuff, nothing else';
const writerElem = document.querySelector('#typewriter');
function typewriter() {
    if(i < writerTxt.length) {
        writerElem.innerHTML += writerTxt.charAt(i);
        i++;
        setTimeout(typewriter, 50);
    }
}

// Preloader
window.addEventListener('load', function() {
    document.querySelector('.preloader').classList.add('hide');
    if(writerElem) typewriter();
});

// Mobile menu
document.querySelector('.mobile-menu-button').addEventListener('click', function() {
    document.querySelector('.mobile-menu').classList.toggle('show');
});

// Docs dropdown
const dropdown = document.querySelector('.dropdown-toggle');
if(dropdown) {
    dropdown.addEventListener('click', function() {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
}

// Syntax highlighter
const docs = document.querySelector('section.docs');
if(docs) {
    hljs.highlightAll();

    if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.querySelector('#hljs-dark').removeAttribute('disabled');
        document.querySelector('#hljs-light').setAttribute('disabled', '');
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if(event.matches) {
            document.querySelector('#hljs-dark').removeAttribute('disabled');
            document.querySelector('#hljs-light').setAttribute('disabled', '');
        } else {
            document.querySelector('#hljs-dark').setAttribute('disabled', '');
            document.querySelector('#hljs-light').removeAttribute('disabled');
        }
    })
}