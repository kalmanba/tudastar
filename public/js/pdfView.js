// Configure PDF.js worker
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

let currentPdf = null;

// Auto-load PDF on page load
window.addEventListener('load', function() {
    if (PDF_URL && PDF_URL !== 'https://example.com/your-document.pdf') {
        loadPDF(PDF_URL);
    }
});

// Load PDF function
async function loadPDF(url) {
    try {
        const pdf = await pdfjsLib.getDocument(url).promise;
        currentPdf = pdf;
        await renderAllPages(pdf);
    } catch (error) {
        console.error('Error loading PDF:', error);
        document.getElementById('pdfContainer').innerHTML = '<div style="padding: 20px; color: red;">Error loading PDF: ' + error.message + '</div>';
    }
}

// Render all pages
async function renderAllPages(pdf) {
    const container = document.getElementById('pdfContainer');
    container.innerHTML = '';
    
    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
        try {
            const page = await pdf.getPage(pageNum);
            const pageElement = await renderPage(page, pageNum);
            container.appendChild(pageElement);
        } catch (error) {
            console.error(`Error rendering page ${pageNum}:`, error);
        }
    }
}

// Render single page with text layer
async function renderPage(page, pageNum) {
    const containerWidth = document.getElementById('pdfContainer').clientWidth || window.innerWidth;
    const viewport = page.getViewport({ scale: 1 });
    
    // Calculate scale to fit container width
    const scale = containerWidth / viewport.width;
    const scaledViewport = page.getViewport({ scale: scale });
    
    // Create wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'pdf-page-wrapper';
    wrapper.style.width = '100%';
    wrapper.style.height = scaledViewport.height + 'px';
    
    // Create canvas
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    canvas.height = scaledViewport.height;
    canvas.width = scaledViewport.width;
    canvas.className = 'pdf-page';
    
    // Create text layer div
    const textLayerDiv = document.createElement('div');
    textLayerDiv.className = 'textLayer';
    textLayerDiv.style.width = '100%';
    textLayerDiv.style.height = scaledViewport.height + 'px';
    
    // Render canvas
    const renderContext = {
        canvasContext: context,
        viewport: scaledViewport
    };
    
    await page.render(renderContext).promise;
    
    // Render text layer
    const textContent = await page.getTextContent();
    pdfjsLib.renderTextLayer({
        textContent: textContent,
        container: textLayerDiv,
        viewport: scaledViewport,
        textDivs: []
    });
    
    // Assemble the page
    wrapper.appendChild(canvas);
    wrapper.appendChild(textLayerDiv);
    
    return wrapper;
}

// Handle window resize
let resizeTimeout;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
        if (currentPdf) {
            renderAllPages(currentPdf);
        }
    }, 250);
});