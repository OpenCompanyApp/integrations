# NVD

Namespace: `nvd`

Use this integration to search NIST National Vulnerability Database 2.0 data:
CVE records, CVE change-history events, CPE dictionary names, CPE match
criteria, and NVD source metadata.

## Authentication

The NVD APIs are public. An API key is optional and is sent with the official
`apiKey` request header when configured. Use a key for higher rate limits and
more reliable bulk workflows.

## Tools

- `nvd_cves`: search CVE records with official filters such as `cve_id`,
  `keyword_search`, `cpe_name`, `cwe_id`, `cvss_v3_severity`,
  `cvss_v4_severity`, `has_kev`, `no_rejected`, publication dates,
  modification dates, `results_per_page`, and `start_index`.
- `nvd_cve_by_id`: convenience wrapper around `nvd_cves` for one CVE ID.
- `nvd_cve_history`: search CVE change-history events by `cve_id`,
  `event_name`, change date range, and pagination.
- `nvd_cpes`: search CPE dictionary records by `cpe_name_id`,
  `cpe_match_string`, `keyword_search`, `match_criteria_id`,
  modification dates, and pagination.
- `nvd_cpe_by_name_id`: convenience wrapper around `nvd_cpes` for one
  `cpeNameId` UUID.
- `nvd_cpe_match`: search CPE match criteria records by `cve_id`,
  `match_criteria_id`, `match_string_search`, modification dates, and
  pagination.
- `nvd_cpe_match_by_criteria_id`: convenience wrapper around `nvd_cpe_match`
  for one `matchCriteriaId` UUID.
- `nvd_sources`: search data-source metadata by `source_identifier`,
  modification dates, and pagination.
- `nvd_source_by_identifier`: convenience wrapper around `nvd_sources` for one
  source identifier.

## Return Notes

This package keeps NVD response field names intact. CVE searches return NVD
pagination metadata plus a `vulnerabilities` array. CPE searches return
`products`; CPE match searches return `matchStrings`; source searches return
`sources`.

Boolean flags such as `has_kev`, `no_rejected`, and `keyword_exact_match` are
sent as NVD valueless query flags when true and omitted when false.

## Examples

```lua
local kev = tools.nvd_cves({
  has_kev = true,
  no_rejected = true,
  results_per_page = 20
})

local cve = tools.nvd_cve_by_id({
  cve_id = "CVE-2024-12345"
})

local cpe = tools.nvd_cpes({
  keyword_search = "nginx",
  results_per_page = 10
})
```

NVD date filters use the timestamp formats documented by NIST. Keep date-range
windows narrow for agent workflows so pagination stays predictable.
