# Google reCAPTCHA Enterprise — JavaScript API Reference

All reCAPTCHA tools are available under `app.integrations.recaptcha`.

## list_assessments

List reCAPTCHA Enterprise assessments for a Google Cloud project. Returns assessment names, scores, token properties, and event details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The project resource name, e.g. `"projects/my-project"` |
| `page_size` | integer | no | Max assessments per page (default: 50, max: 100) |
| `page_token` | string | no | Page token from a previous response |

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `assessments` | array | List of assessment objects |
| `next_page_token` | string\|null | Token for the next page |

### Example

```js
var result = app.integrations.recaptcha.list_assessments({
  parent: "projects/my-project",
  page_size: 20,
})

for (const a of (result.assessments)) {
  console.log(a.name + " — score: " + (a.score || "N/A"))
}
```
---

## get_assessment

Get a single reCAPTCHA Enterprise assessment by its full resource name. Returns score, token properties, event details, and risk analysis.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full assessment resource name, e.g. `"projects/my-project/assessments/12345678"` |

### Example

```js
var assessment = app.integrations.recaptcha.get_assessment({
  name: "projects/my-project/assessments/12345678",
})

console.log("Score: " + (assessment.score || "N/A"))
if (assessment.tokenProperties) {
  console.log("Valid: " + String(assessment.tokenProperties.valid))
}
```
---

## create_assessment

Create a reCAPTCHA Enterprise assessment to evaluate a token. Provide the project parent, the token from the client widget, and the site key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Project resource name, e.g. `"projects/my-project"` |
| `token` | string | yes | reCAPTCHA token from the client-side widget |
| `site_key` | string | yes | reCAPTCHA Enterprise site key |
| `expected_action` | string | no | Expected action name for action-based verification (e.g. `"LOGIN"`) |
| `hashed_account_id` | string | no | Hashed user account ID for account defender assessment |

### Example

```js
var result = app.integrations.recaptcha.create_assessment({
  parent: "projects/my-project",
  token: "TOKEN_FROM_CLIENT_WIDGET",
  site_key: "6Ld1234567890abcdef",
  expected_action: "LOGIN",
})

console.log("Score: " + (result.score || "N/A"))
if (result.tokenProperties) {
  console.log("Token valid: " + String(result.tokenProperties.valid))
  console.log("Action: " + (result.tokenProperties.action || "N/A"))
}
```
---

## list_keys

List reCAPTCHA Enterprise site keys for a Google Cloud project. Returns key names, display names, web settings, and integration type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The project resource name, e.g. `"projects/my-project"` |
| `page_size` | integer | no | Max keys per page (default: 50, max: 100) |
| `page_token` | string | no | Page token from a previous response |

### Example

```js
var result = app.integrations.recaptcha.list_keys({
  parent: "projects/my-project",
})

for (const key of (result.keys)) {
  console.log(key.name + " — " + (key.display_name || "unnamed"))
}
```
---

## get_key

Get a reCAPTCHA Enterprise site key by its full resource name. Returns the key configuration including web, Android, and iOS settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full key resource name, e.g. `"projects/my-project/keys/my-key-id"` |

### Example

```js
var key = app.integrations.recaptcha.get_key({
  name: "projects/my-project/keys/my-key-id",
})

console.log("Display name: " + (key.displayName || "N/A"))
if (key.webSettings) {
  console.log("Allowed domains: " + key.webSettings.allowedDomains || {}.join(", "))
}
```
---

## list_annotations

List annotations for a reCAPTCHA Enterprise assessment. Annotations provide feedback (LEGITIMATE, FRAUDULENT, etc.) to improve model accuracy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Assessment resource name, e.g. `"projects/my-project/assessments/12345678"` |
| `page_size` | integer | no | Max annotations per page (default: 50, max: 100) |
| `page_token` | string | no | Page token from a previous response |

### Example

```js
var result = app.integrations.recaptcha.list_annotations({
  parent: "projects/my-project/assessments/12345678",
})

for (const ann of (result.annotations)) {
  console.log(ann.name + " — reason: " + (ann.reason || "N/A"))
}
```
---

## get_current_user

Get information about the current reCAPTCHA Enterprise API access. Returns accessible projects to verify connectivity.

### Parameters

None.

### Example

```js
var info = app.integrations.recaptcha.get_current_user({})

if (info.projects) {
  for (const project of (info.projects)) {
    console.log("Project: " + (project.projectId || project.name || "unknown"))
  }
} else {
  console.log("API is reachable")
}
```
---

## Common Patterns

### Verify a login token

```js
var result = app.integrations.recaptcha.create_assessment({
  parent: "projects/my-project",
  token: "USER_TOKEN_HERE",
  site_key: "6Ld1234567890abcdef",
  expected_action: "LOGIN",
})

if (result.score && result.score >= 0.5 && result.tokenProperties && result.tokenProperties.valid) {
  console.log("Login is legitimate (score: " + result.score + ")")
} else {
  console.log("Suspicious activity detected")
}
```
### Paginate through all assessments

```js
var page_token = ""
do {
  var result = app.integrations.recaptcha.list_assessments({
    parent: "projects/my-project",
    page_size: 100,
    page_token: page_token,
  })

  for (const a of (result.assessments)) {
    console.log(a.name + " score=" + (a.score || "?"))
  }

  page_token = result.next_page_token || ""
} while (!(page_token === ""));
```