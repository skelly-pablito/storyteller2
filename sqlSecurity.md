In un database SQL, è importante salvare i dati sensibili in modo che non siano leggibili da utenti malintenzionati. 
E' buona regola non salvare le password in chiaro, e implementare un metodo di Hashing prima di inserirle nel database.

**Perchè non crittografia?**: Per evitare che il messaggio cifrato sia reversibile. Gli Hash non sono mai reversibili. 
PHP utilizza come algoritmo di hashing BCRYPT.

# Come cifrare una password

In PHP, quando si raccoglie una password, bisogna creare il suo hash tramite la funzione *password_hash()*. Questa funzione restituisce un hash. 

> password_hash($pwd, PASSWORD_DEFAULT); 

Una volta ottenuto l'hash lo si può inserire nel database. 

## Il Prepared Statement

I prepared statement sono query dove i valori variabili sono trattati come placeholder, che si aspettano dei dati non eseguibili. 

> $sql = "INSERT INTO test(value) VALUES(?);"

Per preparare uno statement, si usa la funzione *$mysqli_prepare()*. Questo comando ha l'obbiettivo  di separare il comando vero e proprio dai dati dell'utente, per prevenire attacchi di *SQL Injection*. <br>
Per sosituire i placeholder con i valori effettivi, bisogna usare la funzione *mysqli_stmt_bind_param()*

> mysqli_stmt_bind_param($statement, "s", $dati); 

Il primo valore è la query, mentre l'ultimo aggancia i dati, in ordine, ai vari segnaposto. la "s" è una stringa di formato, che descrive il tipo di ogni dato da inserire:
- i = intero 
- s = stringa 
- d = double
- b = blob (dati binari come file e immagini)

Una volta preparata la query li può eseguire normalmente tramite *mysqli_execute()* sullo statement preparato con i dati. <br> 
Combinare gli hash dei dati con i prepared statement permette una gestione sicura del Database, per evitare accessi non autorizzati ai dati sensibili degli utenti, 



