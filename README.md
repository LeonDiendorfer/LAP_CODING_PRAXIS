# LAP_CODING_PRAXIS
> Ebenso eine englische Variante [hier](https://github.com/SenselessCoding/PDO). War als Backup gedacht falls ich einen Blackout bekomme, durch das üben aber nicht der Fall gewesen :)  <br>
> Auf [diesem Account](https://github.com/SenselessCoding) ist sowohl Praxis als auch das Setup erklärt <br>


> **Die Ausarbeitung der Theorie kann [hier](https://github.com/LeonDiendorfer/LAP_Coding_Theorie) gefunden werden**

- `Git` - Um dieses Projekt und damit die Basis der Praxisprüfung zu klonen zur Not kann man den nötigen Code auch kopieren.
- `XAMPP` - Um den PHP Code auszuführen und die Datenbank zu hosten und zu bearbeiten via phpmyadmin.
- `Fleet` - Um den Code der Webseite zu bearbeiten.

In den ersten Schritten gehen wir die *Installation* gemeinsam durch.   
Abschließend zeigen wir euch wie man eine *Template Seite* erstellt.

---

### Erste Schritte der Datenbank

- `XAMPP` installieren  **(Link im Software Folder)**
- `Apache` und `MySQL` starten <br> ![XAMPP Start Bild](assets/xampp_start.png)
- [PhpMyAdmin öffnen](http://localhost/phpmyadmin)
- DB anlegen (Neu-DB Name eingeben- Anlegen) <br> ![alt text](assets/db_create.png)

- Tabellen laut ER Diagram anlegen

---

### Erstellen einer Tabelle

```sql
CREATE TABLE Orders (
  OrderID int NOT NULL,
  OrderNumber int NOT NULL,
  PersonID int,
  PRIMARY KEY (OrderID),
  FOREIGN KEY (PersonID) REFERENCES Persons(PersonID)
);
```
*`FOREIGN KEY` nur hinzufügen wenn man abhängige Tabellen hat.* <br>
*Erst die Tabellen erstellen die keine `Foreign Keys` haben.*

<br> ![alt text](assets/phpmyadmin_sql.png)
<br> Tabelle wurde erstellt, siehe nächster Screen
<br> ![alt text](assets/myadmin_erstelle_table.png)
<br>

### Befüllen einer Tabelle

```sql
INSERT INTO orders (`OrderID`,`OrderNumber`,`PersonID`) values
(2, 2, 2),
(3, 3, 3);
```

### Select

```sql
SELECT * FROM `orders` WHERE orderid = 1; 
```

### Update

```sql
UPDATE orders SET ordernumber = 420, personid = 69 WHERE OrderID = 1;
```

### Delete row

```sql
DELETE FROM orders WHERE OrderID = 1;
```

### Drop table

```sql
DROP TABLE orders;
```
*`Drop Table` von hinten. Erst die Tabellen droppen die keinen `Foreign Key` in anderen Tabellen haben!*

---
### Erste Schritte der Webseite <br>

1. Jetbrains Toolbox installieren für Website
**(Link im Software Folder)**


2. Fleet installieren <br> ![alt text](assets/toolbox.png)

### Workspace auswählen
<br> ![alt text](assets/workspace.png)

`XAMPP` Folder auswählen.

```
D:\xampp\htdocs
```

Den kompletten htdocs Folder Inhalt löschen.

### Testen

New file `index.php` erstellen.
```php
<?php
phpinfo();

?>
```
Auf localhost sollte es nun in etwa so aussehen:
<br> ![alt text](assets/localhost.png)


### Files erstellen

`index.php` File rüberkopieren(ist im GIT)

`connect.php` file erstellen

*Wichtig dbname auf eigene DB anpassen!*

```php
<?php
$host = "localhost";
$dbname = "titan_holo";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>
```

`insert.php` File erstellen:
```php
<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = $_POST['orderID'];
    $orderNumber = $_POST['orderNumber'];
    $personID = $_POST['personID'];
//    md5($personID = $_POST['personID']); // FÜR HASH FELDER

    try {
        $stmt = $pdo->prepare("INSERT INTO orders (OrderID, OrderNumber, PersonID) VALUES (?, ?, ?)");
        $stmt->execute([$orderID, $orderNumber, $personID]);
        $_SESSION['success'] = 'Data inserted successfully!';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Insertion failed: ' . $e->getMessage();
    }

    header('Location: index.php');
    exit();
}
?>
```

`delete.php` File erstellen:
```php
<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $orderID = $_POST['orderID'];

  try {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE OrderID = ?");
    $stmt->execute([$orderID]);
    $_SESSION['success'] = 'Data deleted successfully!';
  } catch (PDOException $e) {
    $_SESSION['error'] = 'Deletion failed: ' . $e->getMessage();
  }

  header('Location: index.php');
  exit();
}
?>
```
