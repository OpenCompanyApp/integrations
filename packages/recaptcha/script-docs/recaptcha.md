# Google reCAPTCHA Enterprise — Ruby API Reference

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

```ruby
result = app.integrations.recaptcha.list_assessments(parent: "projects/my-project", page_size: 20)
result.assessments.each do |a|
  puts((a.name).to_s + " — score: " + ((a.score || "N/A")).to_s)
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

```ruby
assessment = app.integrations.recaptcha.get_assessment(name: "projects/my-project/assessments/12345678")
puts("Score: " + ((assessment.score || "N/A")).to_s)
if assessment.tokenProperties
  puts("Valid: " + ((assessment.tokenProperties.valid).to_s).to_s)
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

```ruby
result = app.integrations.recaptcha.create_assessment(parent: "projects/my-project", token: "TOKEN_FROM_CLIENT_WIDGET", site_key: "6Ld1234567890abcdef", expected_action: "LOGIN")
puts("Score: " + ((result.score || "N/A")).to_s)
if result.tokenProperties
  puts("Token valid: " + ((result.tokenProperties.valid).to_s).to_s)
  puts("Action: " + ((result.tokenProperties.action || "N/A")).to_s)
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

```ruby
result = app.integrations.recaptcha.list_keys(parent: "projects/my-project")
result.keys.each do |key|
  puts((key.name).to_s + " — " + ((key.display_name || "unnamed")).to_s)
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

```ruby
key = app.integrations.recaptcha.get_key(name: "projects/my-project/keys/my-key-id")
puts("Display name: " + ((key.displayName || "N/A")).to_s)
if key.webSettings
  puts(("Allowed domains: " + (key.webSettings.allowedDomains).to_s || [].join(", ")))
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

```ruby
result = app.integrations.recaptcha.list_annotations(parent: "projects/my-project/assessments/12345678")
result.annotations.each do |ann|
  puts((ann.name).to_s + " — reason: " + ((ann.reason || "N/A")).to_s)
end
```
---

## get_current_user

Get information about the current reCAPTCHA Enterprise API access. Returns accessible projects to verify connectivity.

### Parameters

None.

### Example

```ruby
info = app.integrations.recaptcha.get_current_user()
if info.projects
  info.projects.each do |project|
    puts("Project: " + (((project.projectId || project.name) || "unknown")).to_s)
  end
else
  puts("API is reachable")
end
```
---

## Common Patterns

### Verify a login token

```ruby
result = app.integrations.recaptcha.create_assessment(parent: "projects/my-project", token: "USER_TOKEN_HERE", site_key: "6Ld1234567890abcdef", expected_action: "LOGIN")
if (((result.score && (result.score >= 0.5)) && result.tokenProperties) && result.tokenProperties.valid)
  puts("Login is legitimate (score: " + (result.score).to_s + ")")
else
  puts("Suspicious activity detected")
end
```
### Paginate through all assessments

```ruby
page_token = ""
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.recaptcha.list_assessments(parent: "projects/my-project", page_size: 100, page_token: page_token)
  result.assessments.each do |a|
    puts((a.name).to_s + " score=" + ((a.score || "?")).to_s)
  end
  page_token = (result.next_page_token || "")
  break unless (!(page_token == ""))
end
```