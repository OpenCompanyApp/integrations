# CISA KEV

Namespace: `cisa-kev`

Use this integration to inspect CISA's Known Exploited Vulnerabilities catalog:
the official JSON feed, filtered vulnerability views, CVE lookup, recent
additions, JSON schema, CSV export, and license text.

## Authentication

The CISA KEV catalog assets are public and require no credentials.

## Tools

- `cisa_kev_catalog`: retrieves the full official JSON catalog.
- `cisa_kev_search`: filters catalog entries by `cve_id`, `vendor`, `product`,
  `q`, `cwe`, `known_ransomware_campaign_use`, `date_added_from`,
  `date_added_to`, `due_date_from`, `due_date_to`, `limit`, and `offset`.
- `cisa_kev_get_vulnerability`: retrieves one catalog entry by exact CVE ID.
- `cisa_kev_recent`: lists recent entries sorted by `dateAdded` descending.
- `cisa_kev_schema`: retrieves the official JSON schema.
- `cisa_kev_csv`: retrieves the official CSV export as text.
- `cisa_kev_license`: retrieves the official license text.

## Return Notes

The JSON catalog keeps CISA field names intact, including `cveID`,
`vendorProject`, `product`, `vulnerabilityName`, `dateAdded`,
`shortDescription`, `requiredAction`, `dueDate`,
`knownRansomwareCampaignUse`, `notes`, and `cwes`.

`cisa_kev_search` returns catalog metadata plus `total`, `offset`, `limit`, and
the matching `vulnerabilities` page. Filters are applied client-side over the
official JSON feed.

## Examples

```lua
local recent = tools.cisa_kev_recent({
  since = "2026-05-01",
  limit = 10
})

local microsoft = tools.cisa_kev_search({
  vendor = "Microsoft",
  known_ransomware_campaign_use = "Known",
  limit = 25
})

local entry = tools.cisa_kev_get_vulnerability({
  cve_id = "CVE-2026-0300"
})
```

Use this catalog as exploited-in-the-wild prioritization data. It does not
replace CVSS, EPSS, asset exposure, compensating controls, or vendor advisories.
