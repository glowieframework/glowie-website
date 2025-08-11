document.addEventListener('DOMContentLoaded', () => {
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