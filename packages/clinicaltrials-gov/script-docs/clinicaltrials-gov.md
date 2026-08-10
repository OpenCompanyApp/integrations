# ClinicalTrials.gov

Namespace: `clinicaltrials-gov`

ClinicalTrials.gov exposes a public REST API v2 for clinical study records, metadata, search areas, enum values, statistics, and data version checks. No credentials are required.

## Search Studies

Use `clinicaltrials_gov_list_studies` for `/studies`.

```js
var page = clinicaltrials_gov.list_studies({
  ["query.cond"]: "lung cancer",
  ["filter.overallStatus"]: [ "RECRUITING", "NOT_YET_RECRUITING" ],
  fields: [ "NCTId", "BriefTitle", "OverallStatus", "HasResults" ],
  sort: [ "@relevance" ],
  countTotal: true,
  pageSize: 25,
})
```
For JSON paging, pass the returned `nextPageToken` as `pageToken` with the same query and filter parameters.

Arrays are encoded as pipe-delimited values, matching the API v2 OpenAPI style.

## Fetch One Study

```js
var study = clinicaltrials_gov.fetch_study({
  nctId: "NCT00841061",
  fields: [ "ProtocolSection", "ResultsSection" ],
})
```
The `format` parameter can be `json`, `csv`, `json.zip`, `fhir.json`, or `ris` for single-study retrieval. Non-JSON responses are returned as `body`, `content_type`, `status`, and selected pagination headers.

## Metadata And Query Building

Use metadata, search areas, and enums before generating precise queries:

```js
var fields = clinicaltrials_gov.metadata({
  includeIndexedOnly: true,
})

var areas = clinicaltrials_gov.search_areas({})
var enums = clinicaltrials_gov.enums({})
```
The metadata endpoint is the best source for allowed field, piece, and area names used by `fields`, `sort`, and advanced Essie expressions.

## Statistics

```js
var sizes = clinicaltrials_gov.size_stats({})

var phase_values = clinicaltrials_gov.field_values_stats({
  types: [ "ENUM" ],
  fields: [ "Phase", "OverallStatus" ],
})

var list_sizes = clinicaltrials_gov.field_sizes_stats({
  fields: [ "Phase", "Condition" ],
})
```
## Version

```js
var version = clinicaltrials_gov.version({})
```
Check `dataTimestamp` before assuming the weekday ClinicalTrials.gov data refresh has completed.
