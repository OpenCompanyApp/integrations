# BambooHR — JavaScript API Reference

## list_employees

List all employees from the company directory.

### Parameters

None.

### Example

```js
var result = app.integrations.bamboohr.list_employees({})

for (const emp of (result.employees)) {
  console.log(emp.id + ": " + emp.firstName + " " + emp.lastName + " — " + (emp.jobTitle || "N/A"))
}
```
---

## get_employee

Get detailed information for a specific employee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `employee_id` | integer | yes | The BambooHR employee ID |
| `fields` | array | no | Fields to retrieve (e.g., `{"firstName", "lastName", "jobTitle", "workEmail", "department", "hireDate", "status"}`) |

### Example

```js
var result = app.integrations.bamboohr.get_employee({
  employee_id: 42,
  fields: ["firstName", "lastName", "jobTitle", "workEmail", "hireDate"],
})

console.log(result.firstName + " " + result.lastName)
console.log("Title: " + (result.jobTitle || "N/A"))
console.log("Email: " + (result.workEmail || "N/A"))
console.log("Hired: " + (result.hireDate || "N/A"))
```
---

## create_employee

Create a new employee record in BambooHR.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | yes | Employee first name |
| `last_name` | string | yes | Employee last name |
| `work_email` | string | no | Work email address |
| `job_title` | string | no | Job title |
| `department` | string | no | Department name |
| `hire_date` | string | no | Hire date (YYYY-MM-DD) |
| `status` | string | no | Employment status (e.g., "Active") |
| `location` | string | no | Work location |
| `supervisor_id` | integer | no | Employee ID of the supervisor |

### Example

```js
var result = app.integrations.bamboohr.create_employee({
  first_name: "Jane",
  last_name: "Doe",
  work_email: "jane.doe@example.com",
  job_title: "Software Engineer",
  department: "Engineering",
  hire_date: "2026-04-01",
})

console.log("Created employee: " + String(result.id || "success"))
```
---

## update_employee

Update an existing employee record.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `employee_id` | integer | yes | The BambooHR employee ID to update |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `work_email` | string | no | Updated work email |
| `job_title` | string | no | Updated job title |
| `department` | string | no | Updated department |
| `status` | string | no | Updated employment status |
| `location` | string | no | Updated work location |
| `supervisor_id` | integer | no | Updated supervisor employee ID |

### Example

```js
var result = app.integrations.bamboohr.update_employee({
  employee_id: 42,
  job_title: "Senior Software Engineer",
  department: "Engineering",
})

console.log("Employee updated: " + String(result.success || "done"))
```
---

## list_departments

List all company departments.

### Parameters

None.

### Example

```js
var result = app.integrations.bamboohr.list_departments({})

for (const dept of (result.departments || [])) {
  console.log(dept.name + " (ID: " + String(dept.id) + ")")
}
```
---

## list_time_off_requests

List time-off requests with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start` | string | no | Start date filter (YYYY-MM-DD) |
| `end` | string | no | End date filter (YYYY-MM-DD) |
| `status` | string | no | Filter by status ("approved", "pending", "denied") |
| `employee_id` | integer | no | Filter by employee ID |
| `type_id` | integer | no | Filter by time-off type ID |

### Example

```js
var result = app.integrations.bamboohr.list_time_off_requests({
  start: "2026-04-01",
  end: "2026-04-30",
  status: "approved",
})

for (const req of (result.requests || [])) {
  console.log("Employee " + req.employeeId + ": " + req.start + " to " + req.end + " (" + req.typeName + ")")
}
```
---

## get_time_off_request

Get detailed information for a specific time-off request by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `request_id` | integer | yes | The BambooHR time-off request ID |

### Example

```js
var result = app.integrations.bamboohr.get_time_off_request({
  request_id: 123,
})

console.log("Request for employee " + (result.employeeId || ""))
console.log("From " + (result.start || "") + " to " + (result.end || ""))
console.log("Status: " + (result.status || ""))
console.log("Type: " + (result.typeName || ""))
```
---

## list_reports

Generate a custom report with specified employee fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | array | yes | List of employee fields to include (e.g., `{"firstName", "lastName", "jobTitle", "department", "workEmail", "hireDate", "status"}`) |
| `title` | string | no | Optional title for the report |

### Available Fields

Common field names: `firstName`, `lastName`, `jobTitle`, `department`, `workEmail`, `hireDate`, `status`, `location`, `supervisor`, `workPhone`, `mobilePhone`, `address1`, `city`, `state`, `zipcode`, `country`, `gender`, `maritalStatus`, `birthday`, `ssn`, `payRate`, `payType`, `payPer`, `employeeNumber`.

### Example

```js
var result = app.integrations.bamboohr.list_reports({
  fields: ["firstName", "lastName", "jobTitle", "department", "hireDate"],
  title: "Engineering Team Report",
})

for (const row of (result.employees || [])) {
  console.log(row.firstName + " " + row.lastName + " — " + (row.jobTitle || "N/A"))
}
```
---

## get_current_user

Get information about the currently authenticated BambooHR user.

### Parameters

None.

### Example

```js
var result = app.integrations.bamboohr.get_current_user({})

console.log("User: " + (result.firstName || "") + " " + (result.lastName || ""))
console.log("Email: " + (result.email || "N/A"))
```
---

## Multi-Account Usage

If you have multiple BambooHR accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.bamboohr.list_employees({})

// Explicit default (portable across setups)
app.integrations.bamboohr.default.list_employees({})

// Named accounts
app.integrations.bamboohr.us_office.list_employees({})
app.integrations.bamboohr.eu_office.list_employees({})
```
All functions are identical across accounts — only the credentials differ.
