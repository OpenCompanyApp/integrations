# OpenFIGI

Namespace: `openfigi`

OpenFIGI maps third-party security identifiers to Financial Instrument Global Identifiers (FIGIs). The API works without an API key at lower rate limits. Configure `api_key` when you need higher request limits; it is sent as the `X-OPENFIGI-APIKEY` header.

## Tools

- `openfigi_mapping` maps identifiers such as ticker, ISIN, CUSIP, SEDOL, and Bloomberg IDs to FIGIs.
- `openfigi_mapping_values` lists supported enum values for mapping job fields such as `idType`, `exchCode`, `micCode`, and `currency`.
- `openfigi_search` searches for FIGIs using keywords and optional filters.
- `openfigi_filter` filters instruments using OpenFIGI filter fields. Prefer this for structured discovery workflows.
- `openfigi_schema` returns the current OpenAPI schema from `/schema`.

## Notes For Agents

Mapping jobs require `idType` and `idValue`. Add filters such as `exchCode`, `micCode`, `currency`, `marketSecDes`, `securityType`, or `securityType2` when the identifier is ambiguous.

Search and filter responses may include `next`. Pass that value as `start` with the same filter payload to fetch the next page.

Examples use fake values:

```lua
local mapped = openfigi.mapping({
  jobs = {
    { idType = "TICKER", idValue = "IBM", exchCode = "US" },
    { idType = "ID_ISIN", idValue = "US4592001014" }
  }
})

local id_types = openfigi.mapping_values({
  key = "idType"
})

local results = openfigi.filter({
  query = "IBM",
  exchCode = "US",
  marketSecDes = "Equity"
})
```

OpenFIGI v3 returns `warning` for normal no-match mapping results and `error` for request errors. The integration preserves successful response payloads as returned by the API and only turns HTTP-level failures into tool errors.
