      document.addEventListener('DOMContentLoaded', () => {
            fetch('header.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('header').innerHTML = data;
                    // Add event listeners here
                    const bar = document.getElementById('bar');
                    const close = document.getElementById('close');
                    const nav = document.getElementById('navbar');

                    if (bar) {
                        bar.addEventListener('click', () => {
                            if (nav.classList.contains('active')) {
                                nav.classList.remove('active');
                            } else {
                                nav.classList.add('active');
                            }
                        });
                    }

                    if (close) {
                        close.addEventListener('click', () => {
                            nav.classList.remove('active');
                        });
                    }
                })
                .catch(error => console.error('Error fetching header:', error));
        });