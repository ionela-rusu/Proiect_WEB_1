const canvas = document.getElementById('bestsellerCanvas');
if (canvas) {
    const ctx = canvas.getContext('2d');
    canvas.width = 900;
    canvas.height = 420;

    const books = [
        { cat: 'THRILLER', titlu: 'Menajera', autor: 'Freida McFadden', img: 'uploads/menajera.jpeg' },
        { cat: 'PSIHOLOGIE', titlu: 'Cand corpul spune nu. Costul stresului ascuns', autor: 'Gabor Mate', img: 'uploads/cand corpul spune nu.jpg' },
        { cat: 'FILOSOFIE', titlu: 'Meditatii', autor: 'Marcus Aurelius', img: 'uploads/meditatii.png' }
    ];

    function wrapText(context, text, x, y, maxWidth, lineHeight) {
        let words = text.split(' ');
        let line = '';
        let testY = y;

        for (let n = 0; n < words.length; n++) {
            let testLine = line + words[n] + ' ';
            let metrics = context.measureText(testLine);
            let testWidth = metrics.width;
            
            if (testWidth > maxWidth && n > 0) {
                context.fillText(line, x, testY);
                line = words[n] + ' ';
                testY += lineHeight;
            } else {
                line = testLine;
            }
        }
        context.fillText(line, x, testY);
        return testY;
    }

    function drawFinalBanner() {
    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
    gradient.addColorStop(0, 'rgba(193, 170, 234, 0.3)'); 
    gradient.addColorStop(1, 'rgba(157, 73, 160, 0.4)'); 
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = gradient;
    ctx.beginPath();
    ctx.roundRect(0, 0, canvas.width, canvas.height, 30);
    ctx.fill();

    ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
    ctx.shadowBlur = 10;
    ctx.fillStyle = '#FFFFFF'; 
    ctx.font = 'bold 28px "Segoe UI"';
    ctx.textAlign = 'center';
    ctx.fillText('RECOMANDĂRILE LUNII', canvas.width / 2, 55);
    ctx.textAlign = 'start';
    ctx.shadowBlur = 0;

    books.forEach((book, i) => {
        let spacing = canvas.width / 3;
        let startX = (spacing / 2) - 65; 
        let x = startX + (i * spacing);
        let y = 120;

        const img = new Image();
        img.src = book.img;
        img.onload = function() {
            ctx.shadowColor = 'rgba(0, 0, 0, 0.4)';
            ctx.shadowBlur = 15;
            ctx.save();
            ctx.beginPath();
            ctx.roundRect(x, y, 130, 185, 10);
            ctx.clip();
            ctx.drawImage(img, x, y, 130, 185);
            ctx.restore();
            ctx.shadowBlur = 0;

            ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
            ctx.beginPath();
            ctx.roundRect(x, y - 35, 100, 24, 6);
            ctx.fill();
            
            ctx.fillStyle = '#4a1a4d'; 
            ctx.font = 'bold 12px "Segoe UI"';
            ctx.fillText(book.cat, x + 12, y - 19);

            ctx.font = 'bold 15px "Segoe UI"';
            ctx.strokeStyle = 'rgba(0,0,0,0.5)';
            ctx.lineWidth = 4;
            
            let lastY = y + 215;
            ctx.shadowColor = 'rgba(0, 0, 0, 0.8)';
            ctx.shadowBlur = 4;
            ctx.fillStyle = '#FFFFFF';
            lastY = wrapText(ctx, book.titlu, x, y + 215, 135, 18);
            
            ctx.shadowBlur = 2;
            ctx.fillStyle = '#0000007e'; 
            ctx.font = '600 13px "Segoe UI"';
            ctx.fillText(book.autor, x, lastY + 20);
            ctx.shadowBlur = 0;
        };
    });
}

    drawFinalBanner();
}