# 3 Sprinto darbas

### Užduotis

Sukurti minimalistinę turinio valdymo sistemą (TVS), kuri turėtų administravimo dalį, ir vartotojo puslapį. Administratorius turi galėti patalpinti informaciją į tinklapį (tekstinius puslapius). Vartotojui šie puslapiai turi būti atvaizduojami. Privalo būti meniu.

### Technologijos

- PHP OOP
- Composer
- Doctrine ORM
- MySQL

### Paleidimas

Projekto paleidimui yra reikalinga [AMPPS](https://ampps.com/).

1. Projekta nuklonuoti iš github arba parsisiųsti .zip ir įkelti į reikiamą PHP aplinką, pvz: _C:\Program Files\Ampps\www_
2. Projektui reikalingas [composer](https://getcomposer.org/download/)
3. Esant direktorijoje, panaudojant _composer_ ir CLI suinstaliuoti reikalingus paketus. Pvz: _php ../composer.phar install_
4. Importuoti _database.sql_ į vietinę MySQL duomenų bazę
5. Paleisti komandą _vendor/bin/doctrine orm:schema-tool:update --force --dump-sql_
6. Paleisti naudojant localhost

### Galimybės

- Paprastas vartotojas gali peržiūrėti puslapius
- Yra galimybė prisijungti administratoriui
- Administratorius gali talpinti, trinti ir redaguoti puslapius
- Galima puslapius kurti ir naudojant script'ą _createPage.php_, bet per TVS tai daryti paprasčiau

### TODOS

- [x] Sukurti duomenų bazę
- [x] Sudaryti duomenų bazės struktūrą ir sukurti lenteles
- [x] Sukurti turimų duomenų atvaizdavimą
- [x] Padaryti navigaciją tarp puslapių
- [x] Sukurti administratoriaus prisijungimą
- [x] Padaryti galimybę administratoriui talpinti puslapius
- [x] Atvaizduoti patalpintus puslapius
- [x] Padaryti galimybę administratoriui redaguoti puslapius
- [x] Padaryti galimybę administratoriui trinti puslapius
- [x] Clean up, refactor and prettify

## Author

[**Lukas**](https://github.com/Lukasring)
