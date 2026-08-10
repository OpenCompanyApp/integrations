# Gainsight — JavaScript API Reference

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

```js
var result = app.integrations.gainsight.list_companies({
  search: "Acme",
})

for (const company of (result.companies)) {
  console.log(company.name + " — Health: " + company.healthScore)
}
```
---

## get_company

Get detailed information about a specific company.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `companyId` | string | yes | The unique company identifier |

### Example

```js
var result = app.integrations.gainsight.get_company({
  companyId: "1A2B3C4D",
})

console.log("Company: " + result.name)
console.log("ARR: " + result.arr)
console.log("Health Score: " + result.healthScore)
console.log("Lifecycle Stage: " + result.lifecycleStage)
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

```js
var result = app.integrations.gainsight.list_users({
  role: "CSM",
})

for (const user of (result.users)) {
  console.log(user.name + " — " + user.email + " — " + user.role)
}
```
---

## get_user

Get detailed information about a specific user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `userId` | string | yes | The unique user identifier |

### Example

```js
var result = app.integrations.gainsight.get_user({
  userId: "5E6F7G8H",
})

console.log("Name: " + result.name)
console.log("Email: " + result.email)
console.log("Role: " + result.role)
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

```js
var result = app.integrations.gainsight.list_surveys({
  status: "active",
})

for (const survey of (result.surveys)) {
  console.log(survey.name + " — Responses: " + survey.responseCount)
}
```
---

## get_survey

Get detailed information about a specific survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `surveyId` | string | yes | The unique survey identifier |

### Example

```js
var result = app.integrations.gainsight.get_survey({
  surveyId: "9I0J1K2L",
})

console.log("Survey: " + result.name)
console.log("Type: " + result.type)
console.log("Status: " + result.status)
console.log("Responses: " + result.responseCount)
```
---

## get_current_user

Get the currently authenticated Gainsight user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.gainsight.get_current_user({})

console.log("Logged in as: " + result.name)
console.log("Email: " + result.email)
console.log("Role: " + result.role)
```
---

## Multi-Account Usage

If you have multiple Gainsight accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.gainsight.list_companies({})

// Explicit default (portable across setups)
app.integrations.gainsight.default.list_companies({})

// Named accounts
app.integrations.gainsight.us_tenant.list_companies({})
app.integrations.gainsight.eu_tenant.list_companies({})
```
All functions are identical across accounts — only the credentials differ.
