# BambooHR — Lua API Reference

## list_employees

List all employees from the company directory.

### Parameters

None.

### Example

```lua
local result = app.integrations.bamboohr.list_employees({})

for _, emp in ipairs(result.employees) do
  print(emp.id .. ": " .. emp.firstName .. " " .. emp.lastName .. " — " .. (emp.jobTitle or "N/A"))
end
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

```lua
local result = app.integrations.bamboohr.get_employee({
  employee_id = 42,
  fields = {"firstName", "lastName", "jobTitle", "workEmail", "hireDate"}
})

print(result.firstName .. " " .. result.lastName)
print("Title: " .. (result.jobTitle or "N/A"))
print("Email: " .. (result.workEmail or "N/A"))
print("Hired: " .. (result.hireDate or "N/A"))
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

```lua
local result = app.integrations.bamboohr.create_employee({
  first_name = "Jane",
  last_name = "Doe",
  work_email = "jane.doe@example.com",
  job_title = "Software Engineer",
  department = "Engineering",
  hire_date = "2026-04-01"
})

print("Created employee: " .. tostring(result.id or "success"))
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

```lua
local result = app.integrations.bamboohr.update_employee({
  employee_id = 42,
  job_title = "Senior Software Engineer",
  department = "Engineering"
})

print("Employee updated: " .. tostring(result.success or "done"))
```

---

## list_departments

List all company departments.

### Parameters

None.

### Example

```lua
local result = app.integrations.bamboohr.list_departments({})

for _, dept in ipairs(result.departments or {}) do
  print(dept.name .. " (ID: " .. tostring(dept.id) .. ")")
end
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

```lua
local result = app.integrations.bamboohr.list_time_off_requests({
  start = "2026-04-01",
  end = "2026-04-30",
  status = "approved"
})

for _, req in ipairs(result.requests or {}) do
  print("Employee " .. req.employeeId .. ": " .. req.start .. " to " .. req.end .. " (" .. req.typeName .. ")")
end
```

---

## get_current_user

Get information about the currently authenticated BambooHR user.

### Parameters

None.

### Example

```lua
local result = app.integrations.bamboohr.get_current_user({})

print("User: " .. (result.firstName or "") .. " " .. (result.lastName or ""))
print("Email: " .. (result.email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple BambooHR accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bamboohr.list_employees({})

-- Explicit default (portable across setups)
app.integrations.bamboohr.default.list_employees({})

-- Named accounts
app.integrations.bamboohr.us_office.list_employees({})
app.integrations.bamboohr.eu_office.list_employees({})
```

All functions are identical across accounts — only the credentials differ.
