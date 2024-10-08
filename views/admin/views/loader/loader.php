<div id="loader" class="fade-in">
    <div class="spinner"></div>
    <div class="loader-text">Alumnite</div>
</div>

<style>
    /* Loader styles */
    #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        display: flex;
        flex-direction: column; 
        justify-content: center;
        align-items: center;
        z-index: 9999;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    #loader.fade-in {
        opacity: 1;
        visibility: visible;
    }

    /* Spinner styles */
    .spinner {
        border: 8px solid rgba(255, 255, 255, 0.3); 
        border-top: 8px solid #752738; 
        border-radius: 50%;
        width: 60px; 
        height: 60px; 
        animation: spin 1s linear infinite;
        margin-bottom: 10px; 
    }

    /* Spin animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loader-text {
        font-size: 24px;
        color: #752738; 
        font-weight: bold;
        margin-top: 10px; 
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loader = document.getElementById('loader');
        
        // Fade in
        loader.classList.add('fade-in');
        
        // Fade out after 1.5 seconds
        setTimeout(function () {
            loader.classList.remove('fade-in');
            
            // Remove the loader from the DOM after the fade-out transition
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500); // This should match the transition duration in CSS
        }, 1000);
    });
</script>