# Interacțiunea containerelor

# Scopul lucrării

După finalizarea acestei lucrări vom fi capabili să gestionam interacțiunea între mai multe containere.

# Sarcina

Cream o aplicație PHP pe baza a două containere: nginx, php-fpm.

# Efectuarea lucrării

Cream un repozitoriu containers05 și copiem pe computerul nosttru cu ajutorul comenzii git clone URL.

În directorul containers05 cream directorul mounts/site cu ajutorul comenzii mkdir mounts/site(daca ne aflam in directorul containers05,daca nu este necesar sa adaugam intreaga cale). 

În acest director copiem site-ul PHP creat în cadrul cursului Programare PHP.

Cream fișierul .gitignore în rădăcina proiectului și adăugați următoarele linii:

New-Item -Path .gitignore -ItemType File

Dupa creearea fisierului cu ajutorul comenzii de mai sus in PowerShell,intram in editorul(in cazul meu VS Code) si introducem urmatorul continut:

# Ignore files and directories
mounts/site/*

![image](https://github.com/user-attachments/assets/3e092a31-a7ab-4e36-b624-4da9b7fc3a04)

Cream în directorul containers05 fișierul nginx/default.conf cu următorul conținut:

server {
    listen 80;
    server_name _;
    root /var/www/html;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    location ~ \.php$ {
        fastcgi_pass backend:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}

![image](https://github.com/user-attachments/assets/78ec738c-c112-4ec7-b531-52175cb576f1)

# Pornire si testare

Cream rețeaua internal pentru containere.

![image](https://github.com/user-attachments/assets/c08250eb-e59d-4bf9-b049-962bf4873794)

Cream containerul backend cu următoarele proprietăți:

pe baza imaginii php:7.4-fpm;

directorul mounts/site este montat în /var/www/html;

funcționează în rețeaua internal.

tot asta se poate efectua cu urmatoarea comanda 

![image](https://github.com/user-attachments/assets/f5e76f4e-8d11-4dad-88f3-d8a5d014acbe)

insa este nevoie de specificat mounts/site/calea catre proiectul php copiat

la fel si pentru backend cu urmatoarele proprietati :

pe baza imaginii nginx:1.23-alpine;

directorul mounts/site este montat în /var/www/html;

fișierul nginx/default.conf este montat în /etc/nginx/conf.d/default.conf;

portul 80 al containerului este expus pe portul 80 al calculatorului gazdei;

funcționează în rețeaua internal.

![image](https://github.com/user-attachments/assets/0feb5863-df6d-4516-8925-890ef43ae3e7)

# Raspunsuri la intrebari

<Ol>
<li>
  Cum doua containere pot interactiona unul cu celalalt

  <br>Interacțiunea între containere poate fi realizată prin rețea sau sistem de fișiere.
</li>
<li>
  Cum văd containerele unul pe celălalt în cadrul rețelei internal?

  <br>Containerele se pot vedea între ele folosind numele containerelor ca hostname-uri.
</li>


  <li>De ce a fost necesar să se suprascrie configurarea nginx?
    
<br>Ajustarea rădăcinii documentelor (root /var/www/html)

<br>Configurarea procesării PHP să folosească containerul backend

<br>Definirea regulilor de routing pentru fișierele PHP

<br>Specificarea parametrilor FastCGI necesari pentru integrarea cu PHP-FPM

<br>Fără această suprascriere, Nginx nu ar ști cum să proceseze cererile PHP sau unde să găsească serviciul PHP-FPM.
  </li>
</Ol>

# Concluzie 

Această lucrare a evidențiat importanța și ușurința interacțiunii între containere în cadrul unei rețele Docker dedicate. Prin separarea aplicației PHP în două servicii distincte — Nginx pentru partea de server web și PHP-FPM pentru interpretarea codului PHP — am învățat cum se pot conecta și colabora containerele printr-o rețea comună, folosind hostname-uri bazate pe numele containerelor. De asemenea, suprascrierea configurației implicite a serverului Nginx a fost esențială pentru direcționarea corectă a cererilor către serviciul PHP-FPM, iar montarea directoarelor locale în containere a permis rularea eficientă a aplicației. În ansamblu, lucrarea a demonstrat cum utilizarea containerelor Docker contribuie la modularitatea, portabilitatea și scalabilitatea unei aplicații moderne.
