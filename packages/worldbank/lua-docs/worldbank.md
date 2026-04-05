# Search indicators by keyword within World Development Indicators (source 2) — Lua API Reference

## worldbank_compare_data

Compare a single economic indicator across multiple countries. Returns the most recent value for each country side-by-side. Use `worldbank_indicators` to find indicator codes..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indicator` | string | yes | World Bank indicator code (e.g.  |
| `countries` | string | yes | Semicolon-separated ISO country codes (e.g.  |
| `date_range` | string | no | Date range filter (e.g.  |

### Example

```lua
local result = app.integrations.worldbank.worldbank_compare_data({
  indicator = ""
  countries = ""
  date_range = ""
})
```

## worldbank_countries

List or search countries from the World Bank. Optional query filters by name. Filter by region (EAS, ECS, LCN, MEA, NAC, SAS, SSF) or income level (HIC, UMC, LMC, LIC)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query — country name or ISO code to filter results. |
| `region` | string | no | Filter by region code: EAS (East Asia), ECS (Europe & Central Asia), LCN (Latin America), MEA (Middle East), NAC (North America), SAS (South Asia), SSF (Sub-Saharan Africa). |
| `income_level` | string | no | Filter by income level: HIC (High), UMC (Upper Middle), LMC (Lower Middle), LIC (Low). |

### Example

```lua
local result = app.integrations.worldbank.worldbank_countries({
  query = ""
  region = ""
  income_level = ""
})
```

## worldbank_country_info

Get detailed information for a specific country by ISO code, including region, income level, lending type, capital city, and coordinates..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `code` | string | yes | ISO country code (e.g.  |

### Example

```lua
local result = app.integrations.worldbank.worldbank_country_info({
  code = ""
})
```

## worldbank_get_data

Fetch economic indicator data for one or more countries from the World Bank. Supports date ranges and most-recent-value mode. Use `worldbank_indicators` to find indicator codes and `worldbank_countries` to find ISO codes..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indicator` | string | yes | World Bank indicator code (e.g.  |
| `countries` | string | no | Semicolon-separated ISO country codes (e.g.  |
| `date_range` | string | no | Date range filter (e.g.  |
| `mrnev` | string | no | Number of most recent non-empty values to return per country (default:  |
| `per_page` | string | no | Number of results per page (default:  |

### Example

```lua
local result = app.integrations.worldbank.worldbank_get_data({
  indicator = ""
  countries = ""
  date_range = ""
})
```

## worldbank_indicators

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search keyword for indicators (e.g.  |

### Example

```lua
local result = app.integrations.worldbank.worldbank_indicators({
  query = ""
})
```

## worldbank_topics

List the 21 World Bank topic categories (e.g., Education, Health, Economy). Optionally provide a topic ID to list indicators in that topic..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_id` | string | no | Topic ID to list indicators for that topic. Omit to see all available topics. |

### Example

```lua
local result = app.integrations.worldbank.worldbank_topics({
  topic_id = ""
})
```
