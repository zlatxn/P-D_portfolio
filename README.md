## Projekt-Überblick

**TAG 1: Design & HTML/CSS**
- UI/UX Konzept erarbeiten
- Farbschema & Layout planen
- Homepage Code schreiben
- Git-Repository aufsetzen

**TAG 2: Projekte-Seite mit Datenbank**
- Datenbank-Schema designen
- Models & Controller schreiben
- Projekte anzeigen (READ)

**TAG 3: Admin-Bereich (CRUD)**
- Neue Projekte erstellen (CREATE)
- Projekte bearbeiten (UPDATE)
- Projekte löschen (DELETE)
- Finales Testing & Deployment

---

### 1. Konfiguration anpassen

```php
// portfolio/config.php anpassen:
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Euer Password
define('DB_NAME', 'portfolio_db');
```

### 2. Testen

```
http://localhost/portfolio/
→ Sollte die Homepage zeigen
```

---

## Dateistruktur

```
portfolio/
├── index.php                    # Router (Einstiegspunkt)
├── config.php                   # Datenbank-Config
├── setup.sql                    # Datenbank-Setup
│
├── models/
│   └── Project.php             # CRUD-Operationen
│
├── controllers/
│   └── ProjectController.php   # Business-Logik
│
├── views/
│   ├── home.php               # Homepage
│   ├── projects.php           # Projektliste
│   ├── project-detail.php     # Einzelnes Projekt
│   └── admin/
│       ├── dashboard.php      # Admin-Übersicht
│       ├── create.php         # Projekt erstellen
│       └── edit.php           # Projekt bearbeiten
│
├── css/
│   ├── style.css              # Haupt-Styles
│   └── admin.css              # Admin-Styles
│
├── js/
│   └── main.js                # JavaScript
│
├── assets/
│   └── images/                # Projekt-Bilder
│
└── TEMPLATES.md               # HTML-Templates
```

---

## TAG 1: Design & HTML/CSS

### Aufgaben für Teams:

**Phase 1: Design-Konzept**
- [ ] Zielgruppe definieren (Wer schaut die Website an?)
- [ ] Farbschema aussuchen (3 Hauptfarben + Akzent)
- [ ] Layout-Skizze zeichnen
- [ ] Typografie planen
- [ ] Design-Document schreiben

**Phase 2: Homepage coden**
- [ ] HTML in views/home.php schreiben
- [ ] CSS in css/style.css anpassen
- [ ] Eigene Farben & Fonts einbinden
- [ ] Responsive Design machen

**Phase 3: Git & Code-Struktur**
- [ ] GitHub/GitLab Repo erstellen
- [ ] Alle Dateien in Repo pushen
- [ ] Team-Mitglieder hinzufügen
- [ ] Erstes Commit machen

**Phase 4: Polish**
- [ ] Mobile-Test
- [ ] CSS-Animationen
- [ ] Link-Überprüfung
- [ ] Code-Cleanup
- [ ] Final Commit

---

## TAG 2: Projekte-Seite mit Datenbank

### Aufgaben für Teams:

**Phase 1: Datenbank-Design**
```sql
-- Was speichern wir?
CREATE TABLE projects (
    id INT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image_path VARCHAR(255),
    created_at TIMESTAMP
);

-- Warum diese Felder?
-- Warum diese Datentypen?
```

**Phase 2: Datenbank aufsetzen**
- [ ] phpMyAdmin öffnen
- [ ] setup.sql ausführen
- [ ] Test-Daten einfügen
- [ ] Query-Tests machen

**Phase 3: Model schreiben**
- [ ] Project.php öffnen
- [ ] getAll() schreiben
- [ ] getById() schreiben
- [ ] Mit phpMyAdmin testen

**Phase 4: Controller & Views**
- [ ] ProjectController schreiben
- [ ] views/projects.php coden
- [ ] views/project-detail.php coden
- [ ] Links testen
- [ ] CSS anpassen

**Phase 5: Integration & Testing**
- [ ] Homepage Link zu Projekte
- [ ] Projekte-Seite testen
- [ ] Responsive Design
- [ ] Code Review
- [ ] Commit & Push

---

## TAG 3: Admin-Bereich (CRUD)

### Aufgaben für Teams:

**Phase 1: Model erweitern (60 Min)**
- [ ] create() Methode schreiben
- [ ] update() Methode schreiben
- [ ] delete() Methode schreiben
- [ ] Mit phpMyAdmin testen

**Phase 2: Controller erweitern (60 Min)**
- [ ] admin() Methode
- [ ] create() Methode
- [ ] edit() Methode
- [ ] delete() Methode

**Phase 3: Admin Views (90 Min)**
- [ ] views/admin/dashboard.php (Tabelle)
- [ ] views/admin/create.php (Form)
- [ ] views/admin/edit.php (Form)
- [ ] CSS für Admin
- [ ] Links testen

**Phase 4: CRUD Testing (60 Min)**
- [ ] Create: Neues Projekt hinzufügen
- [ ] Read: Projekte anzeigen
- [ ] Update: Projekt bearbeiten
- [ ] Delete: Projekt löschen
- [ ] Error-Handling testen

**Phase 5: Final Polish (60 Min)**
- [ ] Alle Pages responsive
- [ ] Error-Messages anzeigen
- [ ] Success-Messages
- [ ] Code Review
- [ ] Final Commit & Push
- [ ] Präsentation vorbereiten

---

## Was müsst ihr implementieren?

### Tag 1 - Minimum:
```
 Homepage mit:
   - Header mit Navigation
   - Hero-Section
   - Über-mich Section
   - Footer
 Responsive Design
 Eigenständiges Farbschema
 Git-Repo (Wenn gewünscht)
```

### Tag 2 - Minimum:
```
 Datenbank mit projects-Tabelle
 Model: getAll() & getById()
 Controller: index() & show()
 Views: projects.php & project-detail.php
 Projekte anzeigen
```

### Tag 3 - Minimum:
```
 Model: create(), update(), delete()
 Controller: admin(), create(), edit(), delete()
 Views: dashboard.php, create.php, edit.php
 Vollständiges CRUD funktioniert
 Admin-Bereich sieht gut aus
```

---

```css
:root {
    --primary-color: #2563EB;      /* Eure Hauptfarbe */
    --secondary-color: #1F2937;    /* Eure Sekundärfarbe */
    --accent-color: #F59E0B;       /* Akzentfarbe */
}
```

Beispiel-Schemata:
- **Modern**: Blau (#2563EB) + Grau + Orange
- **Professional**: Navy (#001f3f) + Weiß + Gold
- **Creative**: Lila (#8b5cf6) + Rosa + Cyan

---

## Bilder hinzufügen

Bilder in diesen Ordner kopieren:
```
portfolio/assets/images/
```

In Formularen verwenden:
```
/assets/images/mein-projekt.jpg
```

---

## Debugging-Tipps

**Projekt zeigt sich nicht?**
```php
// In index.php hinzufügen:
echo "DEBUG: page = " . $_GET['page'];
var_dump($_GET);
```

**Datenbank-Fehler?**
```php
// In config.php:
if ($db->connect_error) {
    echo "Fehler: " . $db->connect_error;
    die();
}
```

**SQL-Query funktioniert nicht?**
```php
// In phpMyAdmin testen!
SELECT * FROM projects WHERE id = 1;
```

---

## Abschlusspräsentation (Tag 3)

**Jedes Team: 15 Minuten**

1. **Intro** (2 Min)
   - Team vorstellen
   - Was habt ihr gebaut?

2. **Design** (3 Min)
   - Farben & Begründung
   - Layout-Entscheidungen
   - Responsive Design zeigen

3. **Live-Demo** (7 Min)
   - Homepage
   - Projekte-Seite
   - Admin: Projekt erstellen
   - Admin: Projekt bearbeiten
   - Admin: Projekt löschen

4. **Technisch** (2 Min)
   - MVC-Struktur zeigen
   - Code-Beispiel erklären

5. **Feedback** (1 Min)
   - Was war schwierig?
   - Was würdet ihr anders machen?

---

## Bonus-Features (für schnelle Teams)

- Admin-Login
- Kommentare
- Tags/Kategorien

---

## Tipps

**Git Best Practices:**
```bash
# Vor jeder Änderung:
git pull

# Bevor etwas neues implementiert wird evtl. einen Feature-Branch erstellen!

# Nach der Arbeit:
git add .
git commit -m "Beschreibung der Änderung"
git push

# Konflikte vermeiden:
# Nicht an derselben Datei arbeiten!
```

**Kommunikation:**
- Täglich Standup (5 Min)
- Wer macht was heute?
- Was sind Blockers?
- Commit-Messages aussagekräftig

---

## Links & Ressourcen

- **HTML/CSS**: https://www.w3schools.com
- **PHP**: https://www.php.net/manual
- **MySQL**: https://dev.mysql.com
- **Git**: https://git-scm.com/doc

---

## FAQ

**F: Wie speichere ich Bilder in der Datenbank?**
A: Speichere nur den Pfad (z.B. `/assets/images/bild.jpg`), nicht die Datei selbst!

**F: Kann ich eine eigene Datenbank-Struktur verwenden?**
A: Ja! Die setup.sql ist nur ein Template. Passt es an.

**F: Dürfen wir Frameworks wie Bootstrap verwenden?**
A: Ja! Macht es sogar schneller. Aber CSS von Hand zu schreiben ist lehrreicher.

**F: Wie teste ich die CRUD-Operationen?**
A: In phpMyAdmin die Tabelle prüfen, ob Daten wirklich hinzugefügt/geändert/gelöscht wurden.

---

**Viel Erfolg beim Portfolio-Projekt!**
