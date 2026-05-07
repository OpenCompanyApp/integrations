# REST Countries

Namespace: `rest-countries`

Use this integration to retrieve public country reference data from REST
Countries v3.1: names, ISO codes, capitals, regions, currencies, languages,
flags, translations, demonyms, maps, borders, time zones, and independence.

## Authentication

REST Countries v3.1 is public and requires no credentials.

## Tools

- `rest_countries_all`: retrieve all countries with selected fields.
- `rest_countries_name`: search by common or official country name.
- `rest_countries_alpha`: retrieve one country by `cca2`, `ccn3`, `cca3`, or
  `cioc` code.
- `rest_countries_alpha_codes`: retrieve multiple countries by code list.
- `rest_countries_currency`: search by currency code or name.
- `rest_countries_language`: search by language code or name.
- `rest_countries_capital`: search by capital city.
- `rest_countries_region`: filter by region.
- `rest_countries_subregion`: filter by subregion.
- `rest_countries_demonym`: search by demonym.
- `rest_countries_translation`: search by translated country name.
- `rest_countries_independent`: filter by independence status.

## Return Notes

Responses are returned under `data` and keep REST Countries field names intact.
Use `fields` to keep payloads small, for example
`name,cca2,cca3,capital,region,population`. REST Countries currently allows
up to 10 requested fields.

The `all` endpoint requires fields. If omitted, this integration uses:
`name,cca2,cca3,capital,region,subregion,population,flags`.

## Examples

```lua
local countries = tools.rest_countries_all({
  fields = "name,cca2,cca3,capital,region,population"
})

local germany = tools.rest_countries_alpha({
  code = "DEU",
  fields = "name,capital,currencies,languages,flags"
})

local eurozone = tools.rest_countries_currency({
  currency = "eur",
  fields = "name,cca2,currencies"
})
```
