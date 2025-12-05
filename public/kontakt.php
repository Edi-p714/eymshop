<?php
// Seiten-Titel setzen
$pageTitle = 'Kontakt - EYMShop';

// Header einbinden
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Hauptbereich der Kontaktseite -->
<section class="page-section">
    <div class="container">
        <!-- Seiten-Header mit Titel -->
        <div class="page-header">
            <h1>Kontaktieren Sie uns</h1>
            <p>Wir sind für Sie da und beantworten gerne Ihre Fragen</p>
        </div>

        <!-- Kontakt-Inhalte -->
        <div class="contact-content">
            <!-- Kontaktinformationen -->
            <div class="contact-info-wrapper">
                <h2>Kontaktinformationen</h2>
                
                <!-- Kontakt-Details Grid -->
                <div class="contact-info">
                    <!-- Adresse -->
                    <div class="info-item">
                        <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#e6a8b3">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"/>
                        </svg>
                        <div>
                            <h3>Adresse</h3>
                            <p>Musterstraße 123<br>30159 Hannover<br>Deutschland</p>
                        </div>
                    </div>
                    
                    <!-- Telefon -->
                    <div class="info-item">
                        <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#e6a8b3">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <div>
                            <h3>Telefon</h3>
                            <p>+49 511 123456</p>
                        </div>
                    </div>
                    
                    <!-- E-Mail -->
                    <div class="info-item">
                        <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#e6a8b3">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <div>
                            <h3>E-Mail</h3>
                            <p>info@eymshop.de</p>
                        </div>
                    </div>
                    
                    <!-- Öffnungszeiten -->
                    <div class="info-item">
                        <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#e6a8b3">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <div>
                            <h3>Öffnungszeiten</h3>
                            <p>Mo-Fr: 09:00 - 18:00 Uhr<br>Sa: 10:00 - 14:00 Uhr<br>So: Geschlossen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer einbinden -->
<?php require_once __DIR__ . '/../includes/footer.php'; ?>