# spain-holidays

Official public holidays of Spain for 2027: the 9 national dates plus the regional dates of the 17 autonomous communities, each with the official bulletin it was taken from (BOE, BOA, BOC, BON, DOCM, DOGC and so on). Plain JSON, no dependencies, works in Node and in the browser with any bundler.

Every date was checked against the official publication listed in `source`. The data is maintained by the team at [SueldoClaro](https://sueldoclaro.es/calendario-laboral-2027/) and also published as CSV and ICS files in the [spain-public-holidays](https://github.com/RB9744/spain-public-holidays) repository.

## Install

```
npm install spain-holidays
```

## Use

```js
const sh = require('spain-holidays');

sh.national();            // the 9 national dates
sh.holidays('ES-MD');     // all 12 holidays of the Comunidad de Madrid, sorted
sh.holidays('cataluña');  // region names work too
sh.isHoliday('2027-03-19', 'ES-GA');   // { date: '2027-03-19', name_es: 'San José', ... } or null
sh.nextHoliday('ES-AN', '2027-06-01'); // next holiday in Andalucía from 1 June 2027
sh.source('ES-NC');       // { label: 'Resolución 232/2026 ... (BON nº 103 ...)', url: 'https://bon.navarra.es/...' }
sh.regions();             // [{ code: 'ES-AN', name: 'Andalucía' }, ...]
```

Region codes are ISO 3166-2: ES-AN, ES-AR, ES-AS, ES-IB, ES-CN, ES-CB, ES-CL, ES-CM, ES-CT, ES-EX, ES-GA, ES-MD, ES-MC, ES-NC, ES-PV, ES-RI, ES-VC.

Each holiday object: `{ date, weekday, scope, name_es, name_en }`. `scope` is `national` or `regional`.

## What is not included

Local holidays (two per municipality) are published town by town and are not in this package; they are kept on the [SueldoClaro region pages](https://sueldoclaro.es/calendario-laboral-2027/). Ceuta and Melilla are not included yet.

## License

Data under [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/): use it in any project, including commercial ones, with a credit to "SueldoClaro" and a link to https://sueldoclaro.es/. The underlying facts are public information from the official gazettes of Spain and its regions.
