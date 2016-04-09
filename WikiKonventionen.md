# Konventionen #

Jedes Projekt sollte seine Konventionen festlegen. So auch dieses Projekt. Ich schlage vor, die Standard - Namenskonventionen wie die üblichen Frameworks ebenfalls zu nutzen.

## Klassen ##

Klassennamen sollten mit Großbuchstaben beginnen und CamelCased sein (Beispiel: KundenVerwaltung.php -> class KundenVerwaltung {). Außerdem sollten die Klassen in Verzeichnissen sortiert und über den Unterstrich abgebildet werden (wie beim ZendFramework).

**Beispiel:**
```
Datei: Data_Kunden_Abgleich.php in Data/Kunden/Abgleich.php
class Data_Kunden_Abgleich
{
...
```

Klassenvariablen sollten je nach Sichtbarkeit folgendes Schema annehmen:
```
public $var;
protected $_var;
private $_var;
```

Klassenkonstanten werden stets mit Großbuchstaben benannt:
```
public $CONSTANT = 'konstante';
```

Ebenso verhält es sich mit Methoden, die je nach Sichtbarkeit folgendes Schema verwenden:
```
public methode() {}
protected _methode() {}
private _methode() {}
```

## Variablen ##
Variablen beginnen immer mit einem Buchstaben und sollten stets aussagend beschrieben werden.

**Beispiel:**
```
$config; // Konfigurationsvariable
$clientObj; // Kunden-Objekt
```

## Kommentare ##
Jede Funktion, Klasse und/oder entscheidene Programmabläufe müssen ausführlich kommentiert werden. Da gSales ausschließlich sowieso in Deutsch benutzt wird, können die Kommentierungen in Deutsch sein. Aber bitte Umlaute nicht ausschreiben (also ae anstelle von ä benutzen).

Insbesondere Klassendateien, Klassenbeschreibungen sowie Methodenbeschreibungen in den Klassen sind obligatorisch!

Die Dokumentation richtet sich nach phpDocumentor, mit dem man im Nachhinein auch eine technische Dokumentation des Projektes erstellen wird.