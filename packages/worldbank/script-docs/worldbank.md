# World Bank JavaScript API Reference

Namespace: `app.integrations.worldbank`

This integration uses the public World Bank Indicators API v2. No API key is required. Responses are normalized into compact agent-facing arrays while preserving World Bank IDs and codes.

## Discovery Tools

### Countries

`worldbank_countries({ query?, region?, income_level? })`

Lists countries and filters out aggregate rows. Use `query` for local filtering by country name or ISO code. Use `region` and `income_level` with World Bank codes.

```js
var countries = app.integrations.worldbank.worldbank_countries({
  region: "LCN",
  income_level: "UMC",
})
```
`worldbank_country_info({ code })`

Gets country or aggregate metadata by code.

```js
var brazil = app.integrations.worldbank.worldbank_country_info({
  code: "BR",
})
```
### Regions, Income Levels, Lending Types

`worldbank_regions({ page?, per_page? })`

Lists region and aggregate codes.

`worldbank_income_levels({})`

Lists income-level codes such as `HIC`, `UMC`, `LMC`, and `LIC`.

`worldbank_lending_types({})`

Lists lending-type codes such as `IBD`, `IDX`, `IDB`, and `LNX`.

### Sources and Indicators

`worldbank_sources({ page?, per_page? })`

Lists World Bank data sources. Source `2` is World Development Indicators.

`worldbank_source_indicators({ source_id, page?, per_page? })`

Lists indicator series available in a source.

```js
var source_indicators = app.integrations.worldbank.worldbank_source_indicators({
  source_id: "2",
  per_page: 25,
})
```
`worldbank_indicators({ query? })`

Searches World Development Indicators by keyword. With no query, returns a curated list of common indicator codes.

`worldbank_indicator_info({ indicator })`

Gets detailed metadata for one indicator, including source note, source organization, and topics.

```js
var gdp = app.integrations.worldbank.worldbank_indicator_info({
  indicator: "NY.GDP.MKTP.CD",
})
```
### Topics and Languages

`worldbank_topics({ topic_id? })`

Lists World Bank topics. When `topic_id` is supplied, lists indicators in that topic.

`worldbank_languages({})`

Lists global and local language codes supported by the World Bank API.

## Data Tools

### Single Indicator Data

`worldbank_get_data({ indicator, countries?, date_range?, mrnev?, per_page? })`

Fetches observations for one indicator. `countries` is a semicolon-separated list of country or aggregate codes; defaults to `all`. `date_range` accepts World Bank range syntax such as `2000:2023`. `mrnev` returns most recent non-empty values.

```js
var data = app.integrations.worldbank.worldbank_get_data({
  indicator: "SP.POP.TOTL",
  countries: "US;CN;BR",
  date_range: "2020:2023",
})
```
### Multi-Indicator Data

`worldbank_multi_indicator_data({ indicators, countries?, source?, date_range?, footnote?, per_page? })`

Fetches multiple semicolon-separated indicators from one source. The World Bank V2 API requires a `source` for multiple indicator calls. The API supports up to 60 indicators in one request; this tool enforces that limit before calling upstream.

```js
var data = app.integrations.worldbank.worldbank_multi_indicator_data({
  countries: "CHN;AGO",
  indicators: "SI.POV.DDAY;SP.POP.TOTL",
  source: "2",
  date_range: "2000:2010",
})
```
### Compare Countries

`worldbank_compare_data({ indicator, countries, date_range? })`

Compares one indicator across countries. Without `date_range`, the tool requests the most recent non-empty value per country.

```js
var comparison = app.integrations.worldbank.worldbank_compare_data({
  indicator: "NY.GDP.MKTP.CD",
  countries: "US;CN;DE;JP",
})
```
## Common Indicator Codes

| Code | Meaning |
|------|---------|
| `NY.GDP.MKTP.CD` | GDP, current US dollars |
| `NY.GDP.MKTP.KD.ZG` | GDP growth, annual percent |
| `NY.GDP.PCAP.CD` | GDP per capita, current US dollars |
| `FP.CPI.TOTL.ZG` | Inflation, consumer prices, annual percent |
| `SL.UEM.TOTL.ZS` | Unemployment, percent of labor force |
| `SP.POP.TOTL` | Total population |
| `SP.DYN.LE00.IN` | Life expectancy at birth |
| `SI.POV.GINI` | Gini index |
| `EN.ATM.CO2E.PC` | CO2 emissions per capita |
