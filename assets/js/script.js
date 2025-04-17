const btnCopy = document.querySelector('.btn-copy');
btnCopy.addEventListener('click', () => {
    navigator.clipboard.writeText('composer create-project glowieframework/glowie');
    btnCopy.innerHTML = '<i class="fas fa-check"></i>';
    setTimeout(() => {
        btnCopy.innerHTML = '<i class="far fa-clipboard"></i>';
    }, 2000);
});