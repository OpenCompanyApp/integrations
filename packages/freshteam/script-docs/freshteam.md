# Freshteam — JavaScript API Reference

## list_candidates

List recruitment candidates with optional status filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"active"`, `"hired"`, `"rejected"`, `"on_hold"`) |

### Example

```js
var result = app.integrations.freshteam.list_candidates({
  page: 1,
  per_page: 10,
  status: "active",
})

for (const candidate of (result)) {
  console.log(candidate.first_name + " " + candidate.last_name + " - " + candidate.email)
}
```
---

## get_candidate

Retrieve details for a specific candidate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The candidate ID |

### Example

```js
var candidate = app.integrations.freshteam.get_candidate({ id: 12345 })
console.log(candidate.first_name + " " + candidate.last_name)
console.log("Email: " + candidate.email)
console.log("Status: " + candidate.status)
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

```js
var result = app.integrations.freshteam.list_job_postings({
  page: 1,
  per_page: 10,
  status: "published",
})

for (const job of (result)) {
  console.log(job.title + " (" + job.status + ")")
}
```
---

## get_job_posting

Retrieve details for a specific job posting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The job posting ID |

### Example

```js
var job = app.integrations.freshteam.get_job_posting({ id: 67890 })
console.log(job.title)
console.log("Department: " + (job.department && job.department.name || "N/A"))
console.log("Location: " + (job.location || "Remote"))
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

```js
var result = app.integrations.freshteam.list_employees({
  page: 1,
  per_page: 50,
})

for (const emp of (result)) {
  console.log(emp.first_name + " " + emp.last_name + " - " + (emp.email || ""))
}
```
---

## get_employee

Retrieve details for a specific employee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The employee ID |

### Example

```js
var emp = app.integrations.freshteam.get_employee({ id: 54321 })
console.log(emp.first_name + " " + emp.last_name)
console.log("Email: " + emp.email)
console.log("Department: " + (emp.department && emp.department.name || "N/A"))
```
---

## get_current_user

Retrieve the currently authenticated user's profile. Useful for verifying the connection.

### Parameters

None.

### Example

```js
var user = app.integrations.freshteam.get_current_user({})
console.log("Logged in as: " + user.email)
```
---

## Multi-Account Usage

If you have multiple Freshteam accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.freshteam.list_candidates({})

// Explicit default (portable across setups)
app.integrations.freshteam.default.list_candidates({})

// Named accounts
app.integrations.freshteam.acme.list_candidates({})
app.integrations.freshteam.other_company.list_employees({})
```
All functions are identical across accounts — only the credentials differ.
