document.addEventListener('DOMContentLoaded', () => {
    // Copy code button
    const btnCopy = document.querySelector('.btn-copy');
    btnCopy.addEventListener('click', () => {
        navigator.clipboard.writeText('composer create-project glowieframework/glowie');
        btnCopy.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            btnCopy.innerHTML = '<i class="far fa-clipboard"></i>';
        }, 2000);
    });

    // Typewritter
    const writerElem = document.querySelector('.typewritter');
    const writerTxt = writerElem.textContent;
    writerElem.textContent = '';

    let i = 0;

    function write() {
        if(i < writerTxt.length) {
            writerElem.textContent += writerTxt.charAt(i);
            i++;
            setTimeout(write, 50);
        }
    }

    writerElem.style.visibility = 'visible';
    write();
});