
        let rotateX = 0;
        let rotateY = 0;
        let rotateSpeedX = 0;
        let rotateSpeedY = 0;
        let dragging = false;
        let previousMouseX;
        let previousMouseY;
        let lastMoveTimestamp;

        const cube = document.getElementById('cube');

        function applyRotation() {
            rotateX += rotateSpeedX;
            rotateY += rotateSpeedY;
            cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            requestAnimationFrame(applyRotation);
        }

        // Initial spin
        rotateSpeedX = 0.5; // Adjust the initial spin speed
        rotateSpeedY = 0.5; // Adjust the initial spin speed

        function startDragging(event) {
            dragging = true;
            rotateSpeedX = 0.5;
            rotateSpeedY = 0.5;
            const { clientX, clientY } = getClientCoordinates(event);
            previousMouseX = clientX;
            previousMouseY = clientY;
            lastMoveTimestamp = Date.now();
            cube.style.cursor = 'grabbing';
        }

        function stopDragging() {
            dragging = false;
            cube.style.cursor = 'grab';
        }

        function handleMove(event) {
            if (!dragging) return;

            const currentTime = Date.now();
            const timeElapsed = currentTime - lastMoveTimestamp;

            const { clientX, clientY } = getClientCoordinates(event);
            const deltaX = clientX - previousMouseX;
            const deltaY = clientY - previousMouseY;

            rotateSpeedX = deltaY / timeElapsed * 5;
            rotateSpeedY = deltaX / timeElapsed * 5;

            rotateX += deltaY * 0.5;
            rotateY += deltaX * 0.5;

            cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

            previousMouseX = clientX;
            previousMouseY = clientY;
            lastMoveTimestamp = currentTime;
        }

        function getClientCoordinates(event) {
            if (event.touches) {
                return {
                    clientX: event.touches[0].clientX,
                    clientY: event.touches[0].clientY
                };
            }
            return {
                clientX: event.clientX,
                clientY: event.clientY
            };
        }

        cube.addEventListener('mousedown', startDragging);
        document.addEventListener('mousemove', handleMove);
        document.addEventListener('mouseup', stopDragging);
        document.addEventListener('mouseleave', stopDragging);

        cube.addEventListener('touchstart', startDragging);
        document.addEventListener('touchmove', handleMove);
        document.addEventListener('touchend', stopDragging);
        document.addEventListener('touchcancel', stopDragging);

        requestAnimationFrame(applyRotation);
  