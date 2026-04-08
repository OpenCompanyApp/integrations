# Google reCAPTCHA Enterprise — Lua API Reference

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

```lua
local result = app.integrations.recaptcha.list_assessments({
  parent = "projects/my-project",
  page_size = 20
})

for _, a in ipairs(result.assessments) do
  print(a.name .. " — score: " .. (a.score or "N/A"))
end
```

---

## get_assessment

Get a single reCAPTCHA Enterprise assessment by its full resource name. Returns score, token properties, event details, and risk analysis.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full assessment resource name, e.g. `"projects/my-project/assessments/12345678"` |

### Example

```lua
local assessment = app.integrations.recaptcha.get_assessment({
  name = "projects/my-project/assessments/12345678"
})

print("Score: " .. (assessment.score or "N/A"))
if assessment.tokenProperties then
  print("Valid: " .. tostring(assessment.tokenProperties.valid))
end
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

```lua
local result = app.integrations.recaptcha.create_assessment({
  parent = "projects/my-project",
  token = "TOKEN_FROM_CLIENT_WIDGET",
  site_key = "6Ld1234567890abcdef",
  expected_action = "LOGIN"
})

print("Score: " .. (result.score or "N/A"))
if result.tokenProperties then
  print("Token valid: " .. tostring(result.tokenProperties.valid))
  print("Action: " .. (result.tokenProperties.action or "N/A"))
end
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

```lua
local result = app.integrations.recaptcha.list_keys({
  parent = "projects/my-project"
})

for _, key in ipairs(result.keys) do
  print(key.name .. " — " .. (key.display_name or "unnamed"))
end
```

---

## get_key

Get a reCAPTCHA Enterprise site key by its full resource name. Returns the key configuration including web, Android, and iOS settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full key resource name, e.g. `"projects/my-project/keys/my-key-id"` |

### Example

```lua
local key = app.integrations.recaptcha.get_key({
  name = "projects/my-project/keys/my-key-id"
})

print("Display name: " .. (key.displayName or "N/A"))
if key.webSettings then
  print("Allowed domains: " .. table.concat(key.webSettings.allowedDomains or {}, ", "))
end
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

```lua
local result = app.integrations.recaptcha.list_annotations({
  parent = "projects/my-project/assessments/12345678"
})

for _, ann in ipairs(result.annotations) do
  print(ann.name .. " — reason: " .. (ann.reason or "N/A"))
end
```

---

## get_current_user

Get information about the current reCAPTCHA Enterprise API access. Returns accessible projects to verify connectivity.

### Parameters

None.

### Example

```lua
local info = app.integrations.recaptcha.get_current_user({})

if info.projects then
  for _, project in ipairs(info.projects) do
    print("Project: " .. (project.projectId or project.name or "unknown"))
  end
else
  print("API is reachable")
end
```

---

## Common Patterns

### Verify a login token

```lua
local result = app.integrations.recaptcha.create_assessment({
  parent = "projects/my-project",
  token = "USER_TOKEN_HERE",
  site_key = "6Ld1234567890abcdef",
  expected_action = "LOGIN"
})

if result.score and result.score >= 0.5 and result.tokenProperties and result.tokenProperties.valid then
  print("Login is legitimate (score: " .. result.score .. ")")
else
  print("Suspicious activity detected")
end
```

### Paginate through all assessments

```lua
local page_token = ""
repeat
  local result = app.integrations.recaptcha.list_assessments({
    parent = "projects/my-project",
    page_size = 100,
    page_token = page_token
  })

  for _, a in ipairs(result.assessments) do
    print(a.name .. " score=" .. (a.score or "?"))
  end

  page_token = result.next_page_token or ""
until page_token == ""
```
