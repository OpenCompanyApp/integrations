# AbuseIPDB

Namespace: `abuseipdb`

Use this integration to query and submit AbuseIPDB API v2 threat-intelligence
data: IP reputation checks, report history, blacklist feeds, CIDR block checks,
single reports, CSV bulk reports, and clearing reports from the configured
account.

## Authentication

All AbuseIPDB API v2 endpoints require an API key. The integration sends it in
the `Key` header, as AbuseIPDB recommends.

## Tools

- `abuseipdb_check`: check one IPv4 or IPv6 address.
- `abuseipdb_reports`: list report history for one IP with pagination.
- `abuseipdb_blacklist`: retrieve JSON blacklist data or plaintext IPs.
- `abuseipdb_report`: submit one abuse report.
- `abuseipdb_check_block`: check a CIDR block.
- `abuseipdb_bulk_report`: submit CSV report content as a multipart upload.
- `abuseipdb_clear_address`: clear this account's reports for one IP.

## Return Notes

JSON endpoints return AbuseIPDB's documented response shape, usually under
`data`. JSON API error responses are flattened into tool errors using the first
`errors[].detail` value when present.

When `abuseipdb_blacklist` is called with `plaintext = true`, the integration
returns both `data`, a parsed list of non-empty IP lines, and `body`, the raw
plaintext response.

## Examples

```js
var check = tools.abuseipdb_check({
  ip_address: "198.51.100.10",
  max_age_in_days: 30,
  verbose: true,
})

var block = tools.abuseipdb_check_block({
  network: "198.51.100.0/24",
  max_age_in_days: 15,
})

var feed = tools.abuseipdb_blacklist({
  confidence_minimum: 90,
  ip_version: 4,
})
```
For write tools, avoid submitting private log data, real customer data, or PII
in comments or CSV content.
