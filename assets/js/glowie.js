document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('.preloader').classList.add('hide');
});

document.querySelector('.mobile-menu-button').addEventListener('click', function(){
    document.querySelector('.mobile-menu').classList.toggle('show');
});