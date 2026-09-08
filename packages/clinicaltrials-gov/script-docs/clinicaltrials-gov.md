# ClinicalTrials.gov

Namespace: `clinicaltrials-gov`

ClinicalTrials.gov exposes a public REST API v2 for clinical study records, metadata, search areas, enum values, statistics, and data version checks. No credentials are required.

## Search Studies

Use `clinicaltrials_gov_list_studies` for `/studies`.

```ruby
page = app.call("integrations.clinicaltrials-gov.list_studies", {"query.cond" => "lung cancer", "filter.overallStatus" => ["RECRUITING", "NOT_YET_RECRUITING"], fields: ["NCTId", "BriefTitle", "OverallStatus", "HasResults"], sort: ["@relevance"], count_total: true, page_size: 25})
```
For JSON paging, pass the returned `nextPageToken` as `pageToken` with the same query and filter parameters.

Arrays are encoded as pipe-delimited values, matching the API v2 OpenAPI style.

## Fetch One Study

```ruby
study = app.call("integrations.clinicaltrials-gov.fetch_study", nct_id: "NCT00841061", fields: ["ProtocolSection", "ResultsSection"])
```
The `format` parameter can be `json`, `csv`, `json.zip`, `fhir.json`, or `ris` for single-study retrieval. Non-JSON responses are returned as `body`, `content_type`, `status`, and selected pagination headers.

## Metadata And Query Building

Use metadata, search areas, and enums before generating precise queries:

```ruby
fields = app.call("integrations.clinicaltrials-gov.metadata", include_indexed_only: true)
areas = app.call("integrations.clinicaltrials-gov.search_areas")
enums = app.call("integrations.clinicaltrials-gov.enums")
```
The metadata endpoint is the best source for allowed field, piece, and area names used by `fields`, `sort`, and advanced Essie expressions.

## Statistics

```ruby
sizes = app.call("integrations.clinicaltrials-gov.size_stats")
phase_values = app.call("integrations.clinicaltrials-gov.field_values_stats", types: ["ENUM"], fields: ["Phase", "OverallStatus"])
list_sizes = app.call("integrations.clinicaltrials-gov.field_sizes_stats", fields: ["Phase", "Condition"])
```
## Version

```ruby
version = app.call("integrations.clinicaltrials-gov.version")
```
Check `dataTimestamp` before assuming the weekday ClinicalTrials.gov data refresh has completed.
