# Freshteam — Ruby API Reference

## list_candidates

List recruitment candidates with optional status filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"active"`, `"hired"`, `"rejected"`, `"on_hold"`) |

### Example

```ruby
result = app.integrations.freshteam.list_candidates(page: 1, per_page: 10, status: "active")
result.each do |candidate|
  puts((candidate.first_name).to_s + " " + (candidate.last_name).to_s + " - " + (candidate.email).to_s)
end
```
---

## get_candidate

Retrieve details for a specific candidate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The candidate ID |

### Example

```ruby
candidate = app.integrations.freshteam.get_candidate(id: 12345)
puts((candidate.first_name).to_s + " " + (candidate.last_name).to_s)
puts("Email: " + (candidate.email).to_s)
puts("Status: " + (candidate.status).to_s)
```
---

## list_job_postings

List job postings with optional filtering by status and department.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"published"`, `"draft"`, `"closed"`) |
| `department_id` | integer | no | Filter by department ID |

### Example

```ruby
result = app.integrations.freshteam.list_job_postings(page: 1, per_page: 10, status: "published")
result.each do |job|
  puts((job.title).to_s + " (" + (job.status).to_s + ")")
end
```
---

## get_job_posting

Retrieve details for a specific job posting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The job posting ID |

### Example

```ruby
job = app.integrations.freshteam.get_job_posting(id: 67890)
puts(job.title)
puts("Department: " + (((job.department && job.department.name) || "N/A")).to_s)
puts("Location: " + ((job.location || "Remote")).to_s)
```
---

## list_employees

List employees with optional department filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `department_id` | integer | no | Filter by department ID |

### Example

```ruby
result = app.integrations.freshteam.list_employees(page: 1, per_page: 50)
result.each do |emp|
  puts((emp.first_name).to_s + " " + (emp.last_name).to_s + " - " + ((emp.email || "")).to_s)
end
```
---

## get_employee

Retrieve details for a specific employee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The employee ID |

### Example

```ruby
emp = app.integrations.freshteam.get_employee(id: 54321)
puts((emp.first_name).to_s + " " + (emp.last_name).to_s)
puts("Email: " + (emp.email).to_s)
puts("Department: " + (((emp.department && emp.department.name) || "N/A")).to_s)
```
---

## get_current_user

Retrieve the currently authenticated user's profile. Useful for verifying the connection.

### Parameters

None.

### Example

```ruby
user = app.integrations.freshteam.get_current_user()
puts("Logged in as: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Freshteam accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.freshteam.list_candidates()
# Explicit default (portable across setups)
app.integrations.freshteam.default.list_candidates()
# Named accounts
app.integrations.freshteam.acme.list_candidates()
app.integrations.freshteam.other_company.list_employees()
```
All functions are identical across accounts — only the credentials differ.
