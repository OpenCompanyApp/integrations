# Gainsight — Lua API Reference

## list_companies

List companies from Gainsight.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (starting from 1) |
| `limit` | integer | no | Maximum number of companies to return (default: 50) |
| `search` | string | no | Search term to filter companies by name |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `companies` | array | Array of company objects |
| `count` | integer | Number of companies returned |
| `totalRecords` | integer | Total matching records (if available) |

### Example

```lua
local result = app.integrations.gainsight.list_companies({
  search = "Acme"
})

for _, company in ipairs(result.companies) do
  print(company.name .. " — Health: " .. company.healthScore)
end
```

---

## get_company

Get detailed information about a specific company.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `companyId` | string | yes | The unique company identifier |

### Example

```lua
local result = app.integrations.gainsight.get_company({
  companyId = "1A2B3C4D"
})

print("Company: " .. result.name)
print("ARR: " .. result.arr)
print("Health Score: " .. result.healthScore)
print("Lifecycle Stage: " .. result.lifecycleStage)
```

---

## list_users

List users in the Gainsight tenant.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (starting from 1) |
| `limit` | integer | no | Maximum number of users to return (default: 50) |
| `role` | string | no | Filter users by role (e.g., "Admin", "CSM", "Manager") |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `users` | array | Array of user objects |
| `count` | integer | Number of users returned |
| `totalRecords` | integer | Total matching records (if available) |

### Example

```lua
local result = app.integrations.gainsight.list_users({
  role = "CSM"
})

for _, user in ipairs(result.users) do
  print(user.name .. " — " .. user.email .. " — " .. user.role)
end
```

---

## get_user

Get detailed information about a specific user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `userId` | string | yes | The unique user identifier |

### Example

```lua
local result = app.integrations.gainsight.get_user({
  userId = "5E6F7G8H"
})

print("Name: " .. result.name)
print("Email: " .. result.email)
print("Role: " .. result.role)
```

---

## list_surveys

List surveys from Gainsight.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (starting from 1) |
| `limit` | integer | no | Maximum number of surveys to return (default: 50) |
| `status` | string | no | Filter surveys by status (e.g., "active", "draft", "closed") |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `surveys` | array | Array of survey objects |
| `count` | integer | Number of surveys returned |
| `totalRecords` | integer | Total matching records (if available) |

### Example

```lua
local result = app.integrations.gainsight.list_surveys({
  status = "active"
})

for _, survey in ipairs(result.surveys) do
  print(survey.name .. " — Responses: " .. survey.responseCount)
end
```

---

## get_survey

Get detailed information about a specific survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `surveyId` | string | yes | The unique survey identifier |

### Example

```lua
local result = app.integrations.gainsight.get_survey({
  surveyId = "9I0J1K2L"
})

print("Survey: " .. result.name)
print("Type: " .. result.type)
print("Status: " .. result.status)
print("Responses: " .. result.responseCount)
```

---

## get_current_user

Get the currently authenticated Gainsight user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.gainsight.get_current_user({})

print("Logged in as: " .. result.name)
print("Email: " .. result.email)
print("Role: " .. result.role)
```

---

## Multi-Account Usage

If you have multiple Gainsight accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.gainsight.list_companies({})

-- Explicit default (portable across setups)
app.integrations.gainsight.default.list_companies({})

-- Named accounts
app.integrations.gainsight.us_tenant.list_companies({})
app.integrations.gainsight.eu_tenant.list_companies({})
```

All functions are identical across accounts — only the credentials differ.
