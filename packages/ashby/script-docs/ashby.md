# Ashby ATS JavaScript API Reference

Namespace: `app.integrations.ashby`

Ashby's public API uses RPC-style POST endpoints such as `/candidate.list` and `/application.info`. This integration exposes first-class tools for common recruiting workflows plus `api_post` for newer or less common endpoints.

Ashby uses cursor pagination and `syncToken` for incremental syncs on many `.list` endpoints. Prefer those fields over offset pagination when the endpoint supports them.

## Raw API

```js
var result = app.integrations.ashby.api_post({
  endpoint: "/candidate.list",
  body: { limit: 100 },
})
```
## Candidates

Tools:

- `list_candidates`
- `search_candidates`
- `get_candidate`
- `create_candidate`
- `update_candidate`
- `create_note`
- `list_candidate_notes`

```js
var page = app.integrations.ashby.list_candidates({
  limit: 100,
  cursor: "opaque-cursor",
})

var matches = app.integrations.ashby.search_candidates({
  email: "person@example.test",
})

var note = app.integrations.ashby.create_note({
  candidateId: "e9ed20fd-d45f-4aad-8a00-a19bfba0083e",
  content: "Screen completed.",
  contentType: "text/plain",
})
```
## Applications

Tools:

- `list_applications`
- `get_application`
- `create_application`
- `update_application`
- `list_criteria_evaluations`

```js
var app = app.integrations.ashby.get_application({
  id: "e9ed20fd-d45f-4aad-8a00-a19bfba0083e",
})

var created = app.integrations.ashby.create_application({
  candidateId: "candidate-id",
  jobId: "job-id",
  sourceId: "source-id",
})
```
## Jobs And Openings

Tools:

- `list_jobs`
- `search_jobs`
- `get_job`
- `create_job`
- `update_job`
- `list_job_postings`
- `get_job_posting`
- `list_openings`
- `create_opening`
- `list_departments`
- `list_locations`
- `list_sources`

```js
var postings = app.integrations.ashby.list_job_postings({
  listedOnly: true,
})

var jobs = app.integrations.ashby.search_jobs({
  requisitionId: "REQ-123",
})
```
Set `listedOnly = true` before using job postings on a public career page, because Ashby's API can return unlisted postings.

## Interviews

Tools:

- `list_interviews`
- `get_interview`
- `list_interview_plans`
- `list_interview_schedules`
- `update_interview_schedule`
- `list_interview_events`

```js
var schedules = app.integrations.ashby.list_interview_schedules({
  applicationId: "application-id",
  limit: 25,
})

var events = app.integrations.ashby.list_interview_events({
  interviewScheduleId: "schedule-id",
})
```
## Offers

Tools:

- `list_offers`
- `get_offer`
- `create_offer`
- `update_offer`
- `approve_offer`

```js
var offers = app.integrations.ashby.list_offers({
  applicationId: "application-id",
})

var approved = app.integrations.ashby.approve_offer({
  offerVersionId: "offer-version-id",
})
```
## Users, Files, Custom Fields, Webhooks, And Assessments

Tools:

- `get_current_user`
- `list_users`
- `get_file`
- `set_custom_field_value`
- `list_webhooks`
- `get_webhook`
- `create_webhook`
- `update_assessment`

```js
var me = app.integrations.ashby.get_current_user({})

var file = app.integrations.ashby.get_file({
  fileId: "file-id",
})

var changed = app.integrations.ashby.set_custom_field_value({
  body: {
    objectType: "Candidate",
    objectId: "candidate-id",
    fieldId: "field-id",
    value: "Example value",
  }
})
```
## Multi-Account Usage

If multiple Ashby accounts are configured, use account-specific namespaces:

```js
app.integrations.ashby.production.list_jobs({})
app.integrations.ashby.staging.list_candidates({ limit: 50 })
```
## Safety Notes

- Ashby API keys are sent using HTTP Basic auth with the key as username and an empty password.
- Candidate, job, opening, offer, webhook, and assessment write tools may require specific Ashby API permissions.
- Use `example.test` and dummy UUIDs in generated examples and tests.
