# Lever

Lever tools are exposed under `app.integrations.lever`. This package covers the public Lever Postings API and the authenticated Lever Data API documented at `https://hire.lever.co/developer/documentation`.

## Coverage

- Public Postings API:
  - `lever_list_postings` - `GET /v0/postings/{site}`
  - `lever_get_posting` - `GET /v0/postings/{site}/{posting_id}`
  - `lever_apply_to_posting` - `POST /v0/postings/{site}/{posting_id}?key={api_key}`
- Authenticated Data API:
  - Opportunities, applications, notes, feedback, files, file actions, resumes, forms, interviews, panels, referrals, offers, contacts
  - Account metadata such as users, stages, archive reasons, disposition stages, sources, tags, audit events
  - Authenticated postings, posting apply forms, posting users, authenticated application submission, diversity surveys
  - Feedback templates, form templates, profile forms
  - Requisitions, requisition fields, requisition field options
  - Uploads, webhooks, EEO response PII
  - Raw safe relative helpers: `lever_data_api_get`, `lever_data_api_post`, `lever_data_api_put`, `lever_data_api_delete`

## Usage Notes

`site` is the Lever site slug from `jobs.lever.co/{site}`. Use the default global Postings API base URL `https://api.lever.co/v0/postings`, or configure `https://api.eu.lever.co/v0/postings` for EU Lever sites.

Listing and detail reads are public for published postings. Application submission and Data API calls require a Lever API key. Configure `data_url = "https://api.lever.co/v1"` or `https://api.eu.lever.co/v1` for EU accounts. Lever Data API keys are permissioned per endpoint; a `403` means the key is valid but lacks access to that resource or confidential data.

List responses are decoded JSON when `mode = "json"` is used. Filtering parameters such as `location`, `commitment`, `team`, and `department` can be arrays; the integration sends repeated query parameters so Lever ORs the values.

## Examples

```js
var postings = app.integrations.lever.lever_list_postings({
  site: "leverdemo",
  mode: "json",
  team: [ "Engineering", "Product" ],
  limit: 10,
})

var posting = app.integrations.lever.lever_get_posting({
  site: "leverdemo",
  posting_id: "posting-id",
})

var application = app.integrations.lever.lever_apply_to_posting({
  site: "leverdemo",
  posting_id: "posting-id",
  body: {
    name: "Ada Lovelace",
    email: "ada@example.test",
    urls: { GitHub: "https://github.com/example" },
    consent: { marketing: true },
  }
})
```
Lever returns `{ ok = true, applicationId = "..." }` for successful applications and `{ ok = false, error = "..." }` with an HTTP error status on failures.

## Data API Examples

List opportunities with pagination and expanded references:

```js
var opportunities = app.integrations.lever.lever_list_data_opportunities({
  limit: 25,
  offset: "next-token-from-previous-response",
  expand: [ "owner", "stage", "applications" ],
})
```
Create an opportunity on behalf of a Lever user:

```js
var opportunity = app.integrations.lever.lever_create_opportunity({
  perform_as: "user-id",
  payload: {
    name: "Ada Lovelace",
    emails: [ "ada@example.test" ],
    headline: "Research engineer",
    sources: [ "sourced" ],
  }
})
```
Move an opportunity to another stage:

```js
var moved = app.integrations.lever.lever_update_opportunity_stage({
  opportunity: "opportunity-id",
  perform_as: "user-id",
  payload: {
    stage: "stage-id",
  }
})
```
Retrieve nested records:

```js
var notes = app.integrations.lever.lever_list_opportunity_notes({
  opportunity: "opportunity-id",
  limit: 100,
})

var resume = app.integrations.lever.lever_download_opportunity_resume({
  opportunity: "opportunity-id",
  resume: "resume-id",
})
```
Use raw helpers for newly released Lever endpoints while keeping the call scoped to the configured Data API host:

```js
var users = app.integrations.lever.lever_data_api_get({
  path: "/users",
  params: {
    limit: 50,
    expand: [ "roles" ],
  }
})
```
Data API list responses usually include `data`, `next`, and `hasNext`. Pass the returned `next` value as `offset` to continue paging. Many endpoints also accept repeated `include` and `expand` parameters; pass arrays when you need multiple values.
