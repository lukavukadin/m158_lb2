## Übung Pfade

### Lokal

Folgende Verzeichnisstruktur ist vorhanden:

```
C:\Daten\Bilder
C:\Daten\CSS
C:\Daten\index.html
C:\Daten\Bilder\Blume.jpg
C:\Daten\Bilder\test.html
C:\Daten\CSS\main.css
```

1. Wie ist der absolute Pfad von der Datei "main.css"?
	C:\Daten\CSS\main.css

2. Angenommen, Sie wollen in der "index.html" Datei das Bild "Blume.jpg" einfügen, wie ist der relative Pfad zum Bild?
	..\Bilder\Blume.jpg

3. Sie wollen von der Datei "main.css" auf das Bild "Blume.jpg" zugreifen, wie ist der absolute Pfad?
	C:\Daten\Bilder\Blume.jpg

4. Sie wollen von der Datei "main.css" auf das Bild "Blume.jpg" zugreifen, wie ist der relative Pfad?
	../..\Bilder\Blume.jpg

5. Sie wollen von der Datei "test.html" auf das Bild "Blume.jpg" zugreifen, wie ist der relative Pfad?
    .Blume.jpg


### Im Netz

**Domain:** ihreadresse.ch **Lokaler Root-Pfad:** `/srv/var/www/htdocs` **Document Root:** `/htdocs`

Dateien:

- **Ordner 1** (innerhalb `htdocs`): `wp-content/uploads/2022/5/Dokument.pdf`
- **Ordner 2** (innerhalb `htdocs`): `wp-content/plugins/neon/files/download.php`

1. Wie ist der lokale & absolute Pfad auf `Dokument.pdf`?
	**lokale:** `/srv/var/www/htdocs/wp-content/uploads/2022/5/Dokument.pdf`
    **Absolute:** `https://ihreadresse.ch/wp-content/uploads/2022/5/Dokument.pdf`
    
2. Wie ist der lokale & absolute Pfad auf `download.php`?
    **lokale:** `/srv/var/www/htdocs/wp-content/plugins/neon/files/download.php
    **Absolute:**`https://ihreadresse.ch/wp-content/plugins/neon/files/download.php
    
3. Wie lautet die URL von `Dokument.pdf`?
	`https://ihreadresse.ch/wp-content/uploads/2022/5/Dokument.pdf`
	
4. Wie ist die URL von `download.php`?
	`https://ihreadresse.ch/wp-content/plugins/neon/files/download.php`

5. Sie möchten in der Datei `download.php` einen Link auf das `Dokument.pdf` herstellen. Wie lautet der relative Pfad?
	`../../../uploads/2022/5/Dokument.pdf`
