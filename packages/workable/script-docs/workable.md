# Workable — JavaScript API Reference

## list_jobs

List jobs from your Workable account with optional state filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by job state: `"published"`, `"draft"`, `"closed"`, or `"archived"`. Omit to list all jobs. |
| `limit` | integer | no | Number of results per page (default: 50, max: 100). |
| `offset` | integer | no | Offset for pagination — pass the value from a previous response to get the next page. |

### Examples

```js
// List all published jobs
var result = app.integrations.workable.list_jobs({
  state: "published",
})

for (const job of (result.jobs)) {
  console.log(job.title + " (" + job.shortcode + ")")
}

// Paginate through all jobs
var offset = 0
do {
  var page = app.integrations.workable.list_jobs({
    limit: 50,
    offset: offset,
  })
  for (const job of (page.jobs || [])) {
    console.log(job.title + " - " + job.state)
  }
  offset = offset + 50
} while (!(page.jobs.length < 50));
```
---

## get_job

Get full details for a specific Workable job by its shortcode.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | The job shortcode identifier (e.g., `"GROVF002"`). |

### Examples

```js
var result = app.integrations.workable.get_job({
  shortcode: "GROVF002",
})

console.log(result.title)
console.log(result.department)
console.log(result.employment_type)
console.log(result.location.city + ", " + result.location.country)
```
---

## create_job

Create a new job posting in Workable.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Job title (e.g., `"Senior Backend Engineer"`). |
| `description` | string | yes | Full job description in HTML or plain text. |
| `department` | string | no | Department name (e.g., `"Engineering"`). |
| `employment_type` | string | no | Employment type: `"full-time"`, `"part-time"`, `"contract"`, `"temporary"`, `"intern"`. |

### Examples

```js
var result = app.integrations.workable.create_job({
  title: "Senior Backend Engineer",
  description: "<p>We are looking for an experienced backend engineer...</p>",
  department: "Engineering",
  employment_type: "full-time",
})

console.log("Created job: " + result.shortcode)
```
---

## list_candidates

List candidates for a specific Workable job, with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | The job shortcode to list candidates for (e.g., `"GROVF002"`). |
| `limit` | integer | no | Number of results per page (default: 50, max: 100). |
| `offset` | integer | no | Offset for pagination — pass the value from a previous response to get the next page. |

### Examples

```js
// List candidates for a job
var result = app.integrations.workable.list_candidates({
  shortcode: "GROVF002",
})

for (const candidate of (result.candidates || [])) {
  console.log(candidate.name + " - Stage: " + candidate.stage)
}

// Paginate through all candidates
var offset = 0
do {
  var page = app.integrations.workable.list_candidates({
    shortcode: "GROVF002",
    limit: 50,
    offset: offset,
  })
  for (const candidate of (page.candidates || [])) {
    console.log(candidate.name + " <" + candidate.email + ">")
  }
  offset = offset + 50
} while (!((page.candidates || {}).length < 50));
```
---

## get_candidate

Get full details for a specific Workable candidate by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The candidate ID (e.g., `"abc123def456"`). |

### Examples

```js
var result = app.integrations.workable.get_candidate({
  id: "abc123def456",
})

console.log(result.name)
console.log(result.email)
console.log(result.stage)
console.log("Applied: " + result.applied_at)
console.log("Phone: " + (result.phone || "N/A"))
```
---

## list_members

List all team members in your Workable account.

### Parameters

This function takes no parameters.

### Examples

```js
var result = app.integrations.workable.list_members()

for (const member of (result.members || [])) {
  console.log(member.name + " - " + member.email + " (" + (member.role || "member") + ")")
}
```
---

## get_current_user

Get the profile of the currently authenticated Workable user.

### Parameters

This function takes no parameters.

### Examples

```js
var result = app.integrations.workable.get_current_user()

console.log("Logged in as: " + result.name)
console.log("Email: " + result.email)
console.log("Role: " + (result.role || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Workable accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.workable.list_jobs({})

// Explicit default (portable across setups)
app.integrations.workable.default.list_jobs({})

// Named accounts
app.integrations.workable.us_office.list_jobs({})
app.integrations.workable.eu_office.list_jobs({})
```
All functions are identical across accounts — only the credentials differ.
