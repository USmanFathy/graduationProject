<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Ensure positioning context for overlay */
        }
        .pdf-viewer {
            width: 100%;
            height: 600px;
            border: none;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent; /* Transparent overlay */
            pointer-events: none; /* Allow clicks to go through the overlay */
        }
        .controls {
            margin-top: 10px;
        }
        .page-number {
            margin: 0 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>View PDF</h1>
    <div id="pdf-container"></div>
    <div class="controls">
        <button id="prev-page">Previous Page</button>
        <span class="page-number">Page <span id="page-num"></span> of <span id="page-count"></span></span>
        <button id="next-page">Next Page</button>
    </div>
    <div class="overlay"></div> <!-- Transparent overlay -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
<script>
    const pdfUrl = "{{ $book->attachment_url }}"; // Replace with your PDF URL
    const pdfContainer = document.getElementById('pdf-container');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');
    const pageNumberSpan = document.getElementById('page-num');
    const pageCountSpan = document.getElementById('page-count');
    let currentPage = 1;

    pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
        pageCountSpan.textContent = pdf.numPages;

        renderPage(pdf, currentPage);

        prevPageButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderPage(pdf, currentPage);
            }
        });

        nextPageButton.addEventListener('click', () => {
            if (currentPage < pdf.numPages) {
                currentPage++;
                renderPage(pdf, currentPage);
            }
        });
    });

    function renderPage(pdf, pageNumber) {
        pdf.getPage(pageNumber).then(page => {
            const scale = 1.5;
            const viewport = page.getViewport({ scale });

            const canvas = document.createElement('canvas');
            canvas.style.display = 'block';
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const context = canvas.getContext('2d');
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            // Clear the previous content before rendering the new page
            pdfContainer.innerHTML = '';
            pdfContainer.appendChild(canvas);

            page.render(renderContext).promise.then(() => {
                pageNumberSpan.textContent = pageNumber;
            });
        });
    }
</script>
</body>
</html>
