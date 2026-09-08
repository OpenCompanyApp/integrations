# Recruitee Ruby API Reference

Namespace: `app.integrations.recruitee`

Recruitee tools call the company-scoped Core API at `https://api.recruitee.com/c/{company_id}`. The configured company ID may also be a company subdomain. Tool results are the normalized JSON returned by Recruitee; common top-level keys include `offers`, `candidates`, `departments`, `locations`, or a single resource key depending on the endpoint.

## Offers

```ruby
offers = app.integrations.recruitee.list_offers(status: "published", limit: 25)
offer = app.integrations.recruitee.get_offer(id: 12345)
created = app.integrations.recruitee.create_offer(offer: {title: "Support Engineer", kind: "job"})
updated = app.integrations.recruitee.update_offer(id: 12345, offer: {status: "published"})
```
`delete_offer({ id = ... })` permanently deletes the offer in Recruitee.

## Candidates

```ruby
candidates = app.integrations.recruitee.list_candidates(limit: 25)
search = app.integrations.recruitee.search_candidates(limit: 50, page: 1, sort_by: "created_at_desc")
candidate = app.integrations.recruitee.get_candidate(id: 67890)
created = app.integrations.recruitee.create_candidate(candidate: {name: "Example Candidate", emails: ["candidate@example.test"]}, offers: [12345])
```
`update_candidate({ id = ..., candidate = {...} })` wraps the body as `{ candidate = ... }`.

`update_candidate_cv({ id = ..., candidate = {...} })` calls `PATCH /candidates/{id}/update_cv`.

`delete_candidate({ id = ... })` permanently deletes the candidate in Recruitee.

`list_candidate_notes({ id = ... })` returns notes for one candidate.

## Company Metadata

```ruby
departments = app.integrations.recruitee.list_departments()
locations = app.integrations.recruitee.list_locations(scope: "active", view_mode: "brief", limit: 10)
```
`get_current_user()` calls `/users/me` for host deployments that expose it.

## Attachments

```ruby
uploaded = app.integrations.recruitee.upload_attachment(attachment: {remote_file_url: "https://example.test/resume.pdf", candidate_id: 67890})
```
The attachment body is passed as `{ attachment = ... }`.

## Generic Core API Helpers

Use the generic helpers for documented Recruitee endpoints that do not yet have a dedicated wrapper. Paths must be relative to `/c/{company_id}`.

```ruby
result = app.integrations.recruitee.api_get(path: "/locations", params: {limit: 10})
patched = app.integrations.recruitee.api_patch(path: "/offers/12345", body: {offer: {title: "Senior Support Engineer"}})
```
Available helpers:

| Function | Purpose |
|----------|---------|
| `api_get` | GET with optional query params |
| `api_post` | POST with JSON body |
| `api_patch` | PATCH with JSON body |
| `api_delete` | DELETE with optional JSON body |

Absolute URLs are rejected; use a relative path such as `/candidates/67890/notes`.

## Multi-Account Usage

```ruby
app.integrations.recruitee.list_offers(limit: 10)
app.integrations.recruitee.default.list_offers(limit: 10)
app.integrations.recruitee.production.list_offers(limit: 10)
```