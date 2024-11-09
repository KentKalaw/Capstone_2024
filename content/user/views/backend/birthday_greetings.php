
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch user's birthday from database
$userBirthday = $birthday;
$today = date("m-d");
$birthdayGreet = date("m-d", strtotime($userBirthday));

// Check if it's user's birthday and modal hasn't been shown yet
if ($today == $birthdayGreet && !isset($_SESSION['birthday_modal_shown'])) {
    // Set the session variable to mark modal as shown
    $_SESSION['birthday_modal_shown'] = true;
    ?>
    <!-- Birthday Modal -->
    <div class="modal fade" id="birthdayModal" tabindex="-1" aria-labelledby="birthdayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: linear-gradient(135deg, #fff8f8, #ffefef); border: none;">
                <div class="modal-body text-center p-5">
                    <h2 class="modal-title mb-4" style="color: #752738; font-weight: bold;">
                        🎉 Happy Birthday! 🎉<br>
                        <?php echo $fname . ' ' . $lname; ?>
                    </h2>
                    <div class="birthday-cake mb-4" style="font-size: 50px;">
                        🎂
                    </div>
                    <p class="birthday-message mb-4" style="font-size: 1.2rem; color: #333;">
                        Wishing you a fantastic birthday filled with joy, laughter, and unforgettable moments! <br> University of Batangas Alumni Association is grateful to have you as part of our community. 🎈
                    </p>
                    <button type="button" class="btn btn-lg px-4 py-2" data-bs-dismiss="modal" 
                            style="background-color: #752738; color: white; border-radius: 25px;">
                        Thank You!
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var birthdayModal = new bootstrap.Modal(document.getElementById('birthdayModal'));
        birthdayModal.show();
        
        // Add confetti effect
        function createConfetti() {
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = ['#752738', '#ffd700', '#ff8c00', '#ff69b4'][Math.floor(Math.random() * 4)];
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = '-10px';
                confetti.style.zIndex = '1060';
                confetti.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
                confetti.style.animation = 'fall ' + (Math.random() * 3 + 2) + 's linear forwards';
                document.body.appendChild(confetti);
            }
        }

        // Add CSS animation for confetti
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(960deg);
                }
            }
        `;
        document.head.appendChild(style);

        createConfetti();

        // Clean up confetti when modal is closed
        document.getElementById('birthdayModal').addEventListener('hidden.bs.modal', function () {
            const confetti = document.querySelectorAll('[style*="animation: fall"]');
            confetti.forEach(c => c.remove());
        });
    });
    </script>
    <?php
}
?>