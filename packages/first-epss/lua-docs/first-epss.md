# FIRST EPSS

Namespace: `first-epss`

Use this integration to query FIRST's Exploit Prediction Scoring System (EPSS)
for CVE exploitation probability and percentile rankings. EPSS scores are
published daily and estimate the probability that a CVE will be exploited in the
wild in the next 30 days.

## Authentication

The FIRST EPSS API is public and requires no credentials.

## Tools

- `first_epss_query`: general EPSS API query with official parameters such as
  `cve`, `cves`, `date`, `scope`, `epss_gt`, `percentile_gt`, `order`, `limit`,
  `offset`, and `fields`.
- `first_epss_cve`: score lookup for one CVE, optionally on a date.
- `first_epss_batch`: score lookup for multiple CVEs, optionally on a date.
- `first_epss_time_series`: time-series scores for one CVE. If `date` is set,
  the series runs up to that date.
- `first_epss_top`: top CVEs ordered by descending EPSS probability or
  percentile.
- `first_epss_threshold`: CVEs above an EPSS or percentile threshold.
- `first_epss_historical_csv_url`: returns the official daily CSV gzip URL for
  a historical date without downloading the large file.

## Return Notes

The API returns FIRST's response envelope intact: `status`, `status-code`,
`version`, `access`, `total`, `offset`, `limit`, and `data`. EPSS rows contain
string values for `cve`, `epss`, `percentile`, and `date`.

`epss` is a probability between 0 and 1. `percentile` is the CVE's rank relative
to other CVEs for the same scoring date.

## Examples

```lua
local score = tools.first_epss_cve({
  cve = "CVE-2022-27225"
})

local batch = tools.first_epss_batch({
  cves = {"CVE-2022-27225", "CVE-2022-27223"},
  date = "2022-03-05"
})

local urgent = tools.first_epss_threshold({
  epss_gt = 0.95,
  limit = 100
})
```

Use EPSS alongside asset exposure, CISA KEV, CVSS, vendor guidance, and local
compensating controls. A high EPSS score means likely exploitation, not automatic
business impact.
