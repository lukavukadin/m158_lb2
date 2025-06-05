# WordPress Web-App Migration (M158 LB2)

Dieses Repository enthält die Dokumentation und Dateien für die Migration einer WordPress-Webanwendung von einem alten Server auf einen neuen Linux-basierten Webserver.

## Zielsetzung

Die Aufgabe besteht darin, eine bestehende WordPress-Anwendung (https://m158.geekz.ch/) auf einen neuen Server zu migrieren. Dabei sind WordPress-Migrationsplugins nicht erlaubt. Der neue Webserver soll unter Linux betrieben werden und es gibt keine Einschränkungen bezüglich der Wahl der Linux-Distribution, des Webservers oder des Datenbankservers, solange diese für WordPress geeignet sind.

## Struktur des Repositories

Das Repository ist in verschiedene Ordner unterteilt, die die verschiedenen Phasen und Komponenten des Projekts enthalten:

### [01 - Aufgaben](m158_lb2/01%20-%20Aufgaben/)
- [cloud-modelle-analyse.md](01%20-%20Aufgaben/cloud-modelle-analyse.md)
- [mermaidchart.md](01%20-%20Aufgaben/mermaidchart.md)
- [Übung Pfade.md](01%20-%20Aufgaben/Übung%20Pfade.md)

In diesen Dateien wird der Fortschritt und die Dokumentation jeder Woche festgehalten.

### [02 - WordPress](m158_lb2/02%20-%20WordPress/)
- [Backup](02%20-%20WordPress/Backup.md): Enthält das vollständige WordPress-Backup vom alten Server.
- [Application](02%20-%20WordPress/Application.md): Die Dateien der WordPress-Anwendung, die auf den neuen Server migriert werden sollen.
- [Config](02%20-%20WordPress/Config.md): Konfigurationsdateien, die für die Einrichtung des neuen Servers notwendig sind.

### [03 - Diverses](m158_lb2/03%20-%20Diverses/)
- [Vorlage Bewertungsraster](03%20-%20Diverses/Vorlage-Bewertungsraster.md): Eine Excel-Datei zur Bewertung des Projekts.
- [Logins](03%20-%20Diverses/Logins.md): Informationen zu den Zugangsdaten (z. B. FTP-Zugang).
- [Links](03%20-%2Diverses/Links.md): Links zu relevanten Ressourcen oder Dokumentationen.

## Ablauf der Migration

1. **Vorbereitung der Zielumgebung**
   - Auswahl der Linux-Distribution.
   - Installation des Webservers (Apache, Nginx, o.ä.).
   - Installation des Datenbankservers (MySQL/MariaDB).
   - Konfiguration der Umgebung.

2. **Migration der WordPress-Anwendung**
   - Herunterladen des vollständigen Backups der alten WordPress-Installation über FTP.
   - Transfer der Dateien auf den neuen Server.
   - Import der Datenbank in den neuen MySQL-Server.
   - Anpassen der Konfigurationsdateien (z.B. `wp-config.php`), um den neuen Server und die Datenbank zu integrieren.

3. **Testen der Migration**
   - Sicherstellen, dass die WordPress-Seite auf dem neuen Server korrekt funktioniert.
   - Testen der Funktionalität (z. B. Login, Beitrags- und Seitenanzeige).
   - Überprüfen der Performance und Optimierung, falls notwendig.

## Bewertung

Das Projekt wird in fünf Phasen durchgeführt, mit einer Bewertung nach jeder Phase. Jede Phase wird von der Lehrkraft korrigiert, bevor die nächste Phase gestartet wird.

- Die Bewertung erfolgt anhand einer Kompetenzmatrix, die im GIT-Repository dokumentiert wird.
- Es wird empfohlen, das Bewertungsraster regelmäßig zu aktualisieren und die Fortschritte zu dokumentieren.

## FTP-Quellsystem

Zugangsdaten für den FTP-Server des Quellsystems:

- **User**: m158
- **Pass**: Zh42p_z82

Verwenden Sie einen FTP-Client, um sich mit dem Server zu verbinden und das vollständige WordPress-Backup herunterzuladen.

## Wichtige Hinweise

- Kommunikation mit der Lehrkraft im Bezug auf das Projekt sollte über den privaten Teamkanal erfolgen.
- Bei Problemen, die länger als 20 Minuten dauern, sollten Sie sich sofort an die Lehrkraft wenden.

Viel Erfolg bei der Durchführung der WordPress-Migration!
