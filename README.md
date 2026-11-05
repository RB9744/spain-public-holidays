# Spain public holidays 2027 (JSON, CSV, ICS)

Official labour holidays of Spain for 2027: the 9 national dates plus the regional dates of the 17 autonomous communities, with the bulletin (BOE, BOA, BOC, BON, DOCM, DOGC...) each one comes from.

Every date was checked against the official publication listed in the `source` field. No scraping of third-party calendars.

Maintained by the team at [SueldoClaro](https://sueldoclaro.es/calendario-laboral-2027/), where the same data powers the per-region calendars, the printable PDFs and the bridge-day (puentes) tables.

## Files

| File | What it is |
|---|---|
| `data/2027/spain-public-holidays-2027.json` | national list + one object per region (ISO 3166-2 codes: ES-MD, ES-CT, ES-AN...) |
| `data/2027/spain-public-holidays-2027.csv` | one row per holiday and region, 214 rows |
| `data/2027/ics/ES-XX.ics` | one iCalendar file per region, ready for Google Calendar, Outlook or Apple Calendar |
| `data/2027/ics/ES.ics` | only the 9 national dates |

## Quick use

Raw JSON:

```
https://raw.githubusercontent.com/RB9744/spain-public-holidays/main/data/2027/spain-public-holidays-2027.json
```

JavaScript:

```js
const r = await fetch('https://raw.githubusercontent.com/RB9744/spain-public-holidays/main/data/2027/spain-public-holidays-2027.json');
const data = await r.json();
const madrid = data.regions['ES-MD'].holidays.map(h => h.date);
// ["2027-01-01","2027-01-06","2027-03-19", ...]
```

Python:

```python
import csv, urllib.request
url = 'https://raw.githubusercontent.com/RB9744/spain-public-holidays/main/data/2027/spain-public-holidays-2027.csv'
rows = list(csv.DictReader(urllib.request.urlopen(url).read().decode('utf-8').splitlines()))
catalonia = [r['date'] for r in rows if r['region_code'] == 'ES-CT']
```

## Schema

```json
{
  "year": 2027,
  "country": "ES",
  "national": [ { "date": "2027-01-01", "weekday": "Friday", "name_es": "Año Nuevo", "name_en": "New Year's Day" } ],
  "regions": {
    "ES-MD": {
      "code": "ES-MD",
      "name": "Comunidad de Madrid",
      "source": { "label": "Decreto 82/2026 ... (BOCM, 1 de octubre de 2026)", "url": "https://..." },
      "holidays": [ { "date": "2027-03-19", "weekday": "Friday", "scope": "regional", "name_es": "San José", "name_en": "Saint Joseph's Day" } ]
    }
  }
}
```

`scope` is `national` (same date everywhere in Spain) or `regional` (chosen by that community). Local holidays (two per municipality) are not in this file; they are published town by town during the autumn and we keep them on the SueldoClaro pages.

## Things worth knowing about 2027

- 1 May and 25 December fall on Saturday and are not moved anywhere.
- 15 August falls on Sunday. Madrid, Aragón, Andalucía, Asturias, Canarias and Castilla y León moved it to Monday 16 August. Extremadura moved it to Monday 11 October. Castilla-La Mancha used the slot for 31 May. Navarra, Cataluña, País Vasco and others did not replace it.
- Navarra lists 13 dates because 3 December (San Francisco Javier) is a local holiday for the whole region.
- Canarias keeps 30 May (Día de Canarias) in its list although it is a Sunday; the islands add one island-specific day each, not included here.
- Ceuta and Melilla are not included yet (their 2027 lists include Eid dates that we have not verified in the BOE text).

## Updates

The regional lists are final. Local holidays are added on the SueldoClaro pages as each bulletin publishes them. If you find a mistake, open an issue with a link to the official bulletin and we will fix it.

## License

Data: [Creative Commons Attribution 4.0](https://creativecommons.org/licenses/by/4.0/). You can use it in any project, including commercial ones, if you credit "SueldoClaro" with a link to https://sueldoclaro.es/.

The underlying facts are public information published in the official gazettes of Spain and its regions.
