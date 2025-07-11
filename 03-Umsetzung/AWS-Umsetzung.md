# Webserver- und Datenbankbereitstellung auf AWS

---

## VPC-Konfiguration

**Ziel:** Eine eigene isolierte Netzwerkumgebung für die Anwendung.

- **VPC CIDR:** `10.0.0.0/22`

- **Subnets erstellt:**

    - `m158-vuk-subnet-public1-us-east-1a` – für EC2
        
    - `m158-vuk-subnet-private1-us-east-1a` – für RDS
        
    - `m158-vuk-subnet-private2-us-east-1b` – zusätzlicher AZ für RDS

- **Internet Gateway** verbunden

- **Routing-Tabellen** für öffentlich/privat erstellt

![alt text](/img/image_471.png)
![alt text](/img/image_472.png)

---

## EC2-Instanz (Webserver)

- **AMI:** Ubuntu Server 24.04 LTS

- **Instance Type:** t2.micro (Free Tier)

- **Schlüssel:** `vuk-webserver-key.pem`

- **Security Group:**
    
    - Port 22 (SSH) – nur eigene IP
        
    - Port 80 (HTTP)
        
    - Port 443 (HTTPS)


![alt text](/img/image_473.png)
![alt text](/img/image_474.png)

---

## SSH-Verbindung & Apache

**Verbindung:**

```bash
ssh -i ~/.ssh/vuk-webserver-key.pem ubuntu@<EC2-Public-IP>
```

**Installierter Stack:**

```bash
sudo apt update
sudo apt install apache2 php php-mysql unzip mysql-client
```


![alt text](/img/image_475.png)
![alt text](/img/image_476.png)


---

## Website-Funktionstest

- `info.php` erstellt unter `/var/www/html/info.php`

![alt text](/img/image_477.png)


```php
<?php phpinfo(); ?>
```

- **Erreichbar über IP:** http://44.223.105.157

![alt text](/img/image_478.png)

---

## Amazon RDS (MySQL-Datenbank)

- **Engine:** MySQL 8.0.41
    
- **Subnet Group:** `m158-vuk-db-subnet-group` mit 2 privaten Subnets
    
- **Security Group für RDS:** Erlaubt Zugriff von EC2-SG (Port 3306)
    
- **Public Access:** Nein (nur intern über VPC erreichbar)

![alt text](/img/image_479.png)
![alt text](/img/image_480.png)

**Zugriff vom Webserver:**

```bash
mysql -h <RDS-ENDPOINT> -u admin -p
```
![alt text](/img/image_481.png)

---

## Neue Datenbank erstellt

- Datenbank erstellt:

![alt text](/img/image_482.png)
![alt text](/img/image_483.png)

- Wordpress heruntergeladen:
![alt text](/img/image_484.png)


![alt text](/img/image_485.png)


![alt text](/img/image_486.png)



**Wordpress:**
![alt text](image_487.png)



## FTP-Backup via FileZilla & SCP

- **FTP-Adresse:** `m158.geekz.ch`

- **Datei heruntergeladen:** `2025-03-11_09-23-30_F5CZ3MQX01.zip`

- **Transfer zur EC2:**


```bash
scp -i ~/.ssh/vuk-webserver-key.pem ~/Downloads/2025-*.zip ubuntu@<EC2-IP>:/home/ubuntu
```

- **Entpacken:**

```bash
unzip *.zip
sudo cp -r * /var/www/html/
```

![alt text](/img/image_488.png)

---

## SSL-Konfiguration

**Ziel:** HTTPS aktivieren (selbstsigniertes Zertifikat)

**Befehle:**

```bash
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
-keyout /etc/ssl/private/apache-selfsigned.key \
-out /etc/ssl/certs/apache-selfsigned.crt

sudo a2enmod ssl
sudo a2ensite default-ssl.conf
sudo systemctl restart apache2
```

---

## WordPress-Konfiguration & Fehlerbehandlung

- **DB importiert:**
    

```bash
mysql -h <RDS-ENDPOINT> -u admin -p wordpress_db < /home/ubuntu/wp_m158_db.sql
```

- **Login-Probleme behoben:**
    
    - Passwort neu gesetzt via MySQL-Query:
        

```sql
UPDATE VtgnJGv_users
SET user_pass = '$P$BHDJsdAiIINwYMZCTFPmsECM6pnIsK1'
WHERE user_login = 'm158';
```

- Benutzerrechte:
    

```sql
UPDATE VtgnJGv_usermeta
SET meta_value = 'a:1:{s:13:"administrator";b:1;}'
WHERE user_id = 1 AND meta_key = 'wp_capabilities';
```


---

