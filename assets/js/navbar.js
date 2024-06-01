document.addEventListener('DOMContentLoaded', () => {
    fetch('header.html')
        .then(response => response.text())
        .then(data => {
            document.querySelector('header').innerHTML = data;
            // Add event listeners here
            const bar = document.getElementById('bar');
            const close = document.getElementById('close');
            const nav = document.getElementById('navbar');

            if (bar) {
                bar.addEventListener('click', () => {
                    nav.classList.add('active');
                });
            }

            if (close) {
                close.addEventListener('click', () => {
                    nav.classList.remove('active');
                });
            }
            
        });
        
});

