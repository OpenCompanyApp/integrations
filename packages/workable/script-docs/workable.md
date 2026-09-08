# Workable — Ruby API Reference

## list_jobs

List jobs from your Workable account with optional state filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by job state: `"published"`, `"draft"`, `"closed"`, or `"archived"`. Omit to list all jobs. |
| `limit` | integer | no | Number of results per page (default: 50, max: 100). |
| `offset` | integer | no | Offset for pagination — pass the value from a previous response to get the next page. |

### Examples

```ruby
# List all published jobs
result = app.integrations.workable.list_jobs(state: "published")
result.jobs.each do |job|
  puts((job.title).to_s + " (" + (job.shortcode).to_s + ")")
end
# Paginate through all jobs
offset = 0
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  page = app.integrations.workable.list_jobs(limit: 50, offset: offset)
  (page.jobs || []).each do |job|
    puts((job.title).to_s + " - " + (job.state).to_s)
  end
  offset = (offset + 50)
  break unless (!(page.jobs.length < 50))
end
```
---

## get_job

Get full details for a specific Workable job by its shortcode.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | The job shortcode identifier (e.g., `"GROVF002"`). |

### Examples

```ruby
result = app.integrations.workable.get_job(shortcode: "GROVF002")
puts(result.title)
puts(result.department)
puts(result.employment_type)
puts((result.location.city).to_s + ", " + (result.location.country).to_s)
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

```ruby
result = app.integrations.workable.create_job(title: "Senior Backend Engineer", description: "<p>We are looking for an experienced backend engineer...</p>", department: "Engineering", employment_type: "full-time")
puts("Created job: " + (result.shortcode).to_s)
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

```ruby
# List candidates for a job
result = app.integrations.workable.list_candidates(shortcode: "GROVF002")
(result.candidates || []).each do |candidate|
  puts((candidate.name).to_s + " - Stage: " + (candidate.stage).to_s)
end
# Paginate through all candidates
offset = 0
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  page = app.integrations.workable.list_candidates(shortcode: "GROVF002", limit: 50, offset: offset)
  (page.candidates || []).each do |candidate|
    puts((candidate.name).to_s + " <" + (candidate.email).to_s + ">")
  end
  offset = (offset + 50)
  break unless (!((page.candidates || {}).length < 50))
end
```
---

## get_candidate

Get full details for a specific Workable candidate by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The candidate ID (e.g., `"abc123def456"`). |

### Examples

```ruby
result = app.integrations.workable.get_candidate(id: "abc123def456")
puts(result.name)
puts(result.email)
puts(result.stage)
puts("Applied: " + (result.applied_at).to_s)
puts("Phone: " + ((result.phone || "N/A")).to_s)
```
---

## list_members

List all team members in your Workable account.

### Parameters

This function takes no parameters.

### Examples

```ruby
result = app.integrations.workable.list_members()
(result.members || []).each do |member|
  puts((member.name).to_s + " - " + (member.email).to_s + " (" + ((member.role || "member")).to_s + ")")
end
```
---

## get_current_user

Get the profile of the currently authenticated Workable user.

### Parameters

This function takes no parameters.

### Examples

```ruby
result = app.integrations.workable.get_current_user()
puts("Logged in as: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Role: " + ((result.role || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Workable accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.workable.list_jobs()
# Explicit default (portable across setups)
app.integrations.workable.default.list_jobs()
# Named accounts
app.integrations.workable.us_office.list_jobs()
app.integrations.workable.eu_office.list_jobs()
```
All functions are identical across accounts — only the credentials differ.
