# Gainsight — Ruby API Reference

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

```ruby
result = app.integrations.gainsight.list_companies(search: "Acme")
result.companies.each do |company|
  puts((company.name).to_s + " — Health: " + (company.healthScore).to_s)
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

```ruby
result = app.integrations.gainsight.get_company(company_id: "1A2B3C4D")
puts("Company: " + (result.name).to_s)
puts("ARR: " + (result.arr).to_s)
puts("Health Score: " + (result.healthScore).to_s)
puts("Lifecycle Stage: " + (result.lifecycleStage).to_s)
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

```ruby
result = app.integrations.gainsight.list_users(role: "CSM")
result.users.each do |user|
  puts((user.name).to_s + " — " + (user.email).to_s + " — " + (user.role).to_s)
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

```ruby
result = app.integrations.gainsight.get_user(user_id: "5E6F7G8H")
puts("Name: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Role: " + (result.role).to_s)
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

```ruby
result = app.integrations.gainsight.list_surveys(status: "active")
result.surveys.each do |survey|
  puts((survey.name).to_s + " — Responses: " + (survey.responseCount).to_s)
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

```ruby
result = app.integrations.gainsight.get_survey(survey_id: "9I0J1K2L")
puts("Survey: " + (result.name).to_s)
puts("Type: " + (result.type).to_s)
puts("Status: " + (result.status).to_s)
puts("Responses: " + (result.responseCount).to_s)
```
---

## get_current_user

Get the currently authenticated Gainsight user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.gainsight.get_current_user()
puts("Logged in as: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Role: " + (result.role).to_s)
```
---

## Multi-Account Usage

If you have multiple Gainsight accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.gainsight.list_companies()
# Explicit default (portable across setups)
app.integrations.gainsight.default.list_companies()
# Named accounts
app.integrations.gainsight.us_tenant.list_companies()
app.integrations.gainsight.eu_tenant.list_companies()
```
All functions are identical across accounts — only the credentials differ.
