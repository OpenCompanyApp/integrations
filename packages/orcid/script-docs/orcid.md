# ORCID

Namespace: `orcid`

ORCID provides researcher identifiers and public profile data. This integration uses the ORCID Public API v3.0 and returns ORCID JSON directly for JSON endpoints. Pass `access_token` when you have a `/read-public` bearer token; current public reads also work without host setup for public data.

## Search

```js
var ids = orcid.search({
  q: 'family-name:Smith AND affiliation-org-name:"University of Oxford"',
  rows: 10,
})

var expanded = orcid.expanded_search({
  q: "spaceman",
  rows: 5,
})
```
Use `orcid_csv_search` for CSV output:

```js
var csv = orcid.csv_search({
  q: "ringgold-org-id:1438",
  fields: [ "orcid", "given-name", "family-name", "current-institution-affiliation-name" ],
})
```
CSV and XML responses are returned as `body`, `status`, and `content_type`.

## Public Records

```js
var record = orcid.record({
  orcid: "0000-0002-1825-0097",
})

var person = orcid.person({
  orcid: "0000-0002-1825-0097",
})
```
Person-section tools include:

- `orcid_personal_details`
- `orcid_address`
- `orcid_keywords`
- `orcid_external_identifiers`
- `orcid_researcher_urls`
- `orcid_other_names`

## Activities

```js
var activities = orcid.activities({ orcid: "0000-0002-1825-0097" })
var works = orcid.works({ orcid: "0000-0002-1825-0097" })
```
Summary tools:

- `orcid_works`
- `orcid_employments`
- `orcid_educations`
- `orcid_qualifications`
- `orcid_invited_positions`
- `orcid_distinctions`
- `orcid_memberships`
- `orcid_services`
- `orcid_fundings`
- `orcid_peer_reviews`

Detail tools use a `put_code` from the corresponding summary:

```js
var work = orcid.work({
  orcid: "0000-0002-1825-0097",
  put_code: 9543020,
})
```
ORCID visibility rules apply. Private or limited-access items will not appear through public reads unless the supplied token permits them.
