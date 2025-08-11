document.addEventListener('DOMContentLoaded', () => {
    // Mobile sidenav menu
    document.querySelector('a.toggle-sidenav').addEventListener('click', event => {
        event.preventDefault();
        document.querySelector('section.menu').classList.toggle('show');
    });

    // Syntax highlighter
    hljs.highlightAll();

    // Light/dark mode initial setting
    if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.querySelector('#theme-dark').removeAttribute('disabled');
        document.querySelector('#theme-light').setAttribute('disabled', '');
    };

    // Light/dark mode automatic change
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if(event.matches) {
            document.querySelector('#theme-dark').removeAttribute('disabled');
            document.querySelector('#theme-light').setAttribute('disabled', '');
        } else {
            document.querySelector('#theme-dark').setAttribute('disabled', '');
            document.querySelector('#theme-light').removeAttribute('disabled');
        }
    });

    // Copy code buttons
    document.querySelectorAll('code.hljs').forEach(el => {
        const a = document.createElement('a');
        const defaultHtml = '<i class="far fa-copy"></i>';
        a.classList.add('btn-copy-code');
        a.innerHTML = defaultHtml;
        a.addEventListener('click', event => {
            event.preventDefault();
            a.innerHTML = '<i class="fas fa-check"></i>';
            navigator.clipboard.writeText(el.innerText);
            setTimeout(() => {
                a.innerHTML = defaultHtml;
            }, 3000);
        });
        el.prepend(a);
    });
});