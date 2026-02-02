-- ===================
-- DATENBANK ERSTELLEN
-- ===================

CREATE DATABASE IF NOT EXISTS portfolio_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

-- ===================
-- PROJECTS TABELLE
-- ===================

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ===================
-- TEST-DATEN
-- ===================

INSERT INTO projects (title, description, image_path) VALUES
('Portfolio Website', 
 'Eine moderne Portfolio-Website mit MVC-Pattern und CRUD-Operationen. Gebaut mit PHP, MySQL und HTML/CSS. Nutzt PDO für sichere Datenbank-Operationen.',
 '/assets/images/portfolio.jpg'),

('Chat-Anwendung', 
 'Real-time Chat mit WebSocket-Support. Mehrere Benutzer können gleichzeitig kommunizieren. Mit Benachrichtigungen und Nutzer-Management.',
 '/assets/images/chat.jpg'),

('E-Commerce Shop', 
 'Vollständiger Online-Shop mit Warenkorb, Zahlungsintegration und Benutzer-Management. Mobile-optimiert mit responsive Design.',
 '/assets/images/shop.jpg'),

('Aufgaben-Manager', 
 'Produktivitäts-App zum Verwalten von Aufgaben. Mit Kategorien, Prioritäten, Erinnerungen und Deadline-Tracking. Perfekt für Teams.',
 '/assets/images/tasks.jpg'),

('Blog-Plattform', 
 'Modernes Blog-System mit Beiträgen, Kommentaren und Kategorien. WYSIWYG-Editor für Artikel, SEO-Optimierung und Social-Media Integration.',
 '/assets/images/blog.jpg');
