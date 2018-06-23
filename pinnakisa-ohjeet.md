**Ohjeet pinnakisa-sovelluksen asentamiseen**
---
##### *Muista:*
- config/database.php
- importaa tietokantaan
    - ion_auth.sql, kisa_contests.sql, kisa_participations.sql 
- tee groups tauluun record users

##### *Docker*
- mysql-volume ei ei sammu ellei `docker-compose down -v`
- env/.mysql-env ensin kuntoon
