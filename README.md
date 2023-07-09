# LAP_CODING_PRAXIS
Ibo Haidars `CRUD Project`: https://gitlab.com/Ismail099/crud_template_project

> **Eine eigene Ausarbeitung mit Doku wird noch folgen.**


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

```MySQL
CREATE TABLE Orders (
OrderID int NOT NULL,
OrderNumber int NOT NULL,
PersonID int,
PRIMARY KEY (OrderID),
FOREIGN KEY (PersonID) REFERENCES Persons(PersonID)
);
```

---

### Erste Schritte der Webseite

1. Jetbrains Toolbox installieren für Website
**(Link im Software Folder)**


2. Fleet installieren <br> ![alt text](assets/toolbox.png)