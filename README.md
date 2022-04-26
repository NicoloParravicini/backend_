# backend_rest

Interfaccia di beckend che con le API è in grado di eseguire le richieste http del frontend.

1)Come avviare il progetto:

Per prima cosa è necessario il docker, con il quale si avvia un web server attraverso il seguente comando:

docker run -d -p 8080:80 --name my-apache-php-app -v percorso_assoluto_cartella:/var/www/html zener79/php:7.4-apache

2)Avviare il mysql-server con i dati del DBMS e un volume per l'accesso alla cartella dump

docker run --name my-mysql-server -v percorso_assoluto_cartella/mysqldata:/var/lib/mysql -v percorso_assoluto_cartella/dump:/dump -e MYSQL_ROOT_PASSWORD=my-secret-pw -p 3306:3306 -d mysql:latest

3)Creare la bash per importare il dump

docker exec -it my-mysql-server bash

4)Importare il dump

mysql -u root -p < /dump/create_employee.sql; exit;

API reference

Ecco come funziona:

Visualizza impiegati    => GET /employees?page=${page}&size=${size}

Visualizza un impiegato => GET /employees?id=${id}

Rimuovere un impiegato  => DELETE /employees?id=${id}

Aggiungere un impiegato => POST /

Modificare le informazioni di un impiegato => PUT /employees/${id} 


