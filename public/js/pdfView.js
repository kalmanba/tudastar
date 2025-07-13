// Import necessary modules from PDF.js
import { getDocument, GlobalWorkerOptions } from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.min.mjs';

// Set the worker source for PDF.js. This is crucial for it to work.
// Make sure the worker.mjs version matches the pdf.min.mjs version.
GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.worker.min.mjs';

const pdfViewerDiv = document.getElementById('pdf-viewer');
const loadingMessage = document.getElementById('loading-message');

/**
 * Renders a PDF document page by page into canvas elements,
 * ensuring high resolution and continuous scrolling.
 * @param {string} url - The URL of the PDF document.
 */
async function renderPdf(url) {
    try {
        // Hide loading message once rendering starts
        loadingMessage.style.display = 'none';

        // Load the PDF document
        const loadingTask = getDocument(url);
        const pdf = await loadingTask.promise;

        // Get the device pixel ratio for high-DPI screen rendering
        const devicePixelRatio = window.devicePixelRatio || 1;

        // Loop through each page of the PDF
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);

            // Define a base scale. This can be adjusted based on desired quality.
            // A higher base scale results in a larger internal canvas,
            // which is then scaled down by CSS for display, providing sharpness.
            const baseScale = 2.5; // Experiment with 1.5, 2.0, 2.5, 3.0
            
            // Calculate the actual scale for rendering, considering device pixel ratio
            const actualRenderScale = baseScale * devicePixelRatio;

            // Get the viewport with the calculated scale
            const viewport = page.getViewport({ scale: actualRenderScale });

            // Create a canvas element for the current page
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Set the internal dimensions of the canvas to the high-resolution viewport dimensions.
            // These are the actual pixels PDF.js will draw onto.
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // IMPORTANT CHANGE: Removed explicit canvas.style.width/height in JS.
            // Now, the CSS 'width: 100%; height: auto;' will handle the display scaling
            // of the high-resolution canvas, making it responsive.

            pdfViewerDiv.appendChild(canvas); // Append canvas directly to the viewer div

            // Define the rendering context for the page
            const renderContext = {
                canvasContext: context,
                viewport: viewport,
                // Optional: 'print' intent can sometimes improve text rendering quality,
                // but might be slower for large documents. Experiment if needed.
                // intent: 'print' 
            };

            // Render the PDF page onto the canvas
            await page.render(renderContext).promise;
        }
    } catch (error) {
        console.error('Error rendering PDF:', error);
        loadingMessage.innerHTML = `Failed to load PDF: ${error.message}`;
        loadingMessage.style.display = 'flex'; // Show error message
    }
}

// Call the render function when the window loads
window.onload = function() {
    renderPdf(pdfUrl);
};