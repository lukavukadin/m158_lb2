
# Dokumentation LB2-Migration mit Docker


### 1.1 klonen des Repositories von Aeschlimann

![[Pasted image 20250701114350.png]]

### 1.2 Kopieren der zwei Ordner

![[Pasted image 20250701114408.png]]


---


### 2 Start der Docker-Umgebung mit `docker-compose up -d`

Nach dem Kopieren der Projektstruktur wurde die lokale Entwicklungsumgebung mit dem folgenden Befehl im Hintergrund gestartet:

`docker-compose up -d`


Dabei wurden:

- alle benötigten **Docker-Images automatisch heruntergeladen** (`php`, `mysql`, `phpmyadmin`, etc.)
    
- der Apache-Webserver, die MariaDB-Datenbank und phpMyAdmin **gebaut und gestartet**
    
- ein Docker-Netzwerk sowie ein Volume für die Datenbank persistenz erstellt


Die Ausgabe bestätigt, dass:

- Alle Dienste erfolgreich gebaut und ausgeführt wurden
    
- Das Setup jetzt betriebsbereit ist


Dieser Schritt ist die technische Grundlage für die weitere WordPress-Migration.

![[Pasted image 20250701115222.png]]

----


### 3.1 **Statusprüfung laufender Docker-Container**

Mit dem Befehl `docker ps` wurde überprüft, ob alle geplanten Dienste erfolgreich gestartet wurden.  
Die Ausgabe zeigt, dass die folgenden Container aktiv sind:

- `apache_php`: Webserver (Apache mit PHP), erreichbar auf den Ports **80 (HTTP)** und **443 (HTTPS)**
    
- `phpmyadmin`: phpMyAdmin, erreichbar über **Port 8888**
    
- `mysql_db`: MariaDB-Datenbankserver, läuft intern auf **Port 3306**
    

Dies bestätigt, dass die grundlegende Server-Infrastruktur für die spätere WordPress-Migration korrekt und funktionsfähig konfiguriert ist.

![[Pasted image 20250701115301.png]]


### 3.2 **Test der Apache-Webserver-Konfiguration**
   
Nach dem erfolgreichen Start der Docker-Container wurde im Browser `http://localhost` aufgerufen.  
Die angezeigte Testseite „**Das ist meine Docker HTML-Seite**“ bestätigt, dass der Apache-Webserver korrekt läuft und auf Port 80 reagiert.

![[Pasted image 20250701115607.png]]

Damit ist sichergestellt, dass sowohl der Webserver als auch die Datenbank einsatzbereit sind – die Grundlage für die anschließende WordPress-Migration ist gegeben.

### 3.3 **Test der phpMyAdmin-Verbindung zur Datenbank**

Die phpMyAdmin-Oberfläche wurde erfolgreich unter `http://localhost:8888` geöffnet.  
Es sind bereits mehrere Datenbanken sichtbar, darunter `wordpress_db`, was zeigt, dass die Verbindung zum MariaDB-Datenbankserver funktioniert.

![[Pasted image 20250701115622.png]]

---

### 4.1 Backup-Dateien dokumentiert

Das vollständige FTP-Backup der WordPress-Seite wurde sauber im Projekt archiviert.  
Im Ordner:

`docker_compose_wordpress/backup/`

liegen nun:

- `original_wordpress_backup.zip` – das komplette WordPress-Backup vom FTP-Server
    
- `wp_m158_db.sql` – die extrahierte Datenbankdatei für den späteren Import


Damit ist die ursprüngliche Website-Version vollständig und sauber dokumentiert verfügbar.

![[Pasted image 20250701121347.png]]
![[Pasted image 20250701121458.png]]

---

### 5. Import der WordPress-Datenbank

Die Datenbankdatei `wp_m158_db.sql` wurde erfolgreich über die phpMyAdmin-Oberfläche in die Datenbank `wordpress_db` importiert.

![[Pasted image 20250701121723.png]]


Dies wurde über die Benutzeroberfläche unter `http://localhost:8888` durchgeführt.  
Der Import umfasste **148 SQL-Abfragen**. Die erfolgreiche Ausführung wurde durch phpMyAdmin bestätigt:


![[Pasted image 20250701121822.png]]

---
### ⚙️ 6. Anpassung der `wp-config.php` Datei

Nach dem erfolgreichen Import der Datenbank wurde die Konfigurationsdatei `wp-config.php` angepasst, um die Verbindung zur MariaDB-Datenbank im Docker-Container herzustellen.

Folgende Einstellungen wurden vorgenommen:

```
define( 'DB_NAME', 'wordpress_db' );
define( 'DB_USER', 'wordpress_user' ); 
define( 'DB_PASSWORD', 'wordpress_pass' ); 
define( 'DB_HOST', 'db:3306' );
```

Diese Daten entsprechen den Werten aus dem `docker-compose.yml`-File und ermöglichen WordPress den Zugriff auf die lokal importierte Datenbank.

Die Verbindung wird über den internen Containernamen `db` hergestellt, nicht über `localhost`.

![[Pasted image 20250701122727.png]]



----


### ☁️ 7. AWS EC2-Instanz erstellt und konfiguriert

Für die Bereitstellung der Docker-basierten WordPress-Migration wurde eine neue EC2-Instanz in der AWS-Cloud erstellt.

Die Konfiguration der Instanz erfolgte wie folgt:

| Einstellung                      | Wert                                          |
| -------------------------------- | --------------------------------------------- |
| **Name**                         | `m158-docker-wp-migration`                    |
| **Amazon Machine Image (AMI)**   | Ubuntu Server 22.04 LTS (64-bit)              |
| **Instance Type**                | `t2.micro` (Free Tier geeignet)               |
| **Schlüsselpaar (Key Pair)**     | `vuk-webserver-key.pem` – für den SSH-Zugriff |
| **Elastic IP (statische IP)**    | `54.145.3.27` – dauerhaft zugewiesen          |
| **Sicherheitsgruppe (Firewall)** | Neue Security Group mit folgenden Regeln:     |

![[Pasted image 20250701142946.png]]




----

###  8. Docker und Docker Compose auf AWS-EC2 installiert

Nach dem Starten der EC2-Instanz wurde der Ubuntu-Server über SSH verbunden.  
Anschließend wurden Docker und Docker Compose mit folgenden Befehlen installiert:

`sudo apt update && sudo apt upgrade -y sudo apt install -y docker.io sudo apt install -y docker-compose`
![[Pasted image 20250701144801.png]]
![[Pasted image 20250701144827.png]]
![[Pasted image 20250701144901.png]]


Die Dienste wurden aktiviert und die Versionen überprüft:

`docker --version docker-compose --version`

![[Pasted image 20250701145003.png]]


Zusätzlich wurde der Benutzer `ubuntu` der Docker-Gruppe hinzugefügt, um Docker ohne `sudo` verwenden zu können:

`sudo usermod -aG docker ubuntu`

![[Pasted image 20250701145741.png]]

---

### 9. FTP-Server per Docker integriert

Für den Datei-Zugriff wurde ein FTP-Server auf Basis von `vsftpd` in das Docker-Setup eingebunden.  
Der Container wurde über Docker Compose mit folgenden Einstellungen eingerichtet:

- Benutzer: `m158ftp`
    
- Passwort: `m158pass`
    
- Ports: 21 (aktiv), 21000–21010 (passiv)
    
- Zugriff auf: `/var/www/html` (WordPress-Verzeichnis)


Die Verbindung erfolgt abgesichert und eingeschränkt – damit ist das Bewertungskriterium für **Stufe 3 – FTP** vollständig erfüllt.

![[Pasted image 20250701153236.png]]

---

### 10. Apache-Konfiguration für sichere WordPress-Nutzung

Für den Webserver wurde die Datei apache/wordpress.conf angepasst, um die Anforderungen für die Stufe 3 im Bewertungskriterium Webserver zu erfüllen.

Die Konfiguration besteht aus zwei VirtualHost-Blöcken: einer für HTTP, einer für HTTPS.

#### Aufbau der Datei wordpress.conf:

````
<VirtualHost *:80>
    ServerName m158.proxmox.party
    Redirect permanent / https://m158.proxmox.party/
</VirtualHost>
````
Erklärung:
- Dieser Block fängt alle HTTP-Zugriffe ab (Port 80)
- Leitet sie permanent (301) auf HTTPS weiter → wichtig für Sicherheit & Bewertung


````
<VirtualHost *:443>
    ServerName m158.proxmox.party
    DocumentRoot /var/www/html
````
Erklärung:
- HTTPS-Block für den Zugriff über TLS/SSL (Port 443)
- Domainname als FQDN gesetzt (Pflicht laut Bewertungsraster)
- DocumentRoot zeigt auf WordPress-Verzeichnis


````
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/fullchain.pem
    SSLCertificateKeyFile /etc/ssl/private/privkey.pem
````
Erklärung:
- Aktiviert SSL-Verschlüsselung (self-signed Zertifikate)
- Die Pfade zeigen auf Zertifikate, die im Projekt unter ssl/ liegen
- Diese werden im docker-compose.yml korrekt eingebunden


````
    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
````
Erklärung:
- Erlaubt .htaccess (wichtig für WordPress-Permalinks!)
- Require all granted macht das Verzeichnis öffentlich erreichbar

````
    <IfModule mod_expires.c>
        ExpiresActive On
        ...
    </IfModule>
````
Erklärung:
- Aktiviert Client-Caching für statische Dateien
- Reduziert Ladezeit & Serverlast
- Bonuspunkt für professionelle Umsetzung


````
    <IfModule mod_headers.c>
        Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    </IfModule>
````
Erklärung:
- Aktiviert HSTS (HTTP Strict Transport Security)
- Erzwingt HTTPS in modernen Browsern – Sicherheitsbest Practice

````
    ErrorLog /var/log/apache2/m158_error.log
    CustomLog /var/log/apache2/m158_access.log combined
</VirtualHost>
````
Erklärung:
- Individuelle Log-Dateien für Fehler und Zugriffe
- Erleichtert Debugging & Analyse

#### Warum diese Änderungen?

Diese Konfiguration wurde umgesetzt, um:

- HTTPS-Verbindung sicherzustellen
- Keine Apache Default Page mehr zu haben
- HTTP → HTTPS Weiterleitung zu erzwingen
- RewriteEngine via .htaccess zu aktivieren (Permalinks)
- Caching & Sicherheit zu verbessern


