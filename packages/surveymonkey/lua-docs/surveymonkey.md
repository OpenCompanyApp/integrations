# SurveyMonkey — Lua API Reference

## list_surveys

List all surveys in your SurveyMonkey account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of surveys per page (default: 50, max: 100) |

### Examples

```lua
local result = app.integrations.surveymonkey.list_surveys({
  page = 1,
  per_page = 10
})

for _, survey in ipairs(result.data) do
  print(survey.id .. ": " .. survey.title)
end
```

---

## get_survey

Get details of a specific survey by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```lua
local result = app.integrations.surveymonkey.get_survey({
  survey_id = "123456789"
})

print("Title: " .. result.title)
print("Questions: " .. #result.pages)
```

---

## create_survey

Create a new blank survey with a given title.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title for the new survey |

### Examples

```lua
local result = app.integrations.surveymonkey.create_survey({
  title = "Customer Satisfaction Q1"
})

print("Created survey: " .. result.id)
```

---

## list_responses

List all bulk responses for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of responses per page (default: 50, max: 100) |

### Examples

```lua
local result = app.integrations.surveymonkey.list_responses({
  survey_id = "123456789",
  per_page = 25
})

for _, response in ipairs(result.data) do
  print(response.id .. " - " .. response.date_modified)
end
```

---

## get_response

Get a single response for a survey by response ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `response_id` | string | yes | The response ID |

### Examples

```lua
local result = app.integrations.surveymonkey.get_response({
  survey_id = "123456789",
  response_id = "987654321"
})

print("Respondent: " .. (result.recipient_email or "anonymous"))
for _, page in ipairs(result.pages) do
  for _, answer in ipairs(page.answers) do
    print("Q" .. answer.question_id .. ": " .. (answer.text or "selected"))
  end
end
```

---

## list_collectors

List all collectors for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```lua
local result = app.integrations.surveymonkey.list_collectors({
  survey_id = "123456789"
})

for _, collector in ipairs(result.data) do
  print(collector.id .. ": " .. collector.name .. " (" .. collector.type .. ")")
end
```

---

## create_collector

Create a collector for distributing a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `type` | string | yes | Collector type: `"weblink"` or `"email"` |
| `name` | string | no | A display name for the collector |

### Examples

```lua
local result = app.integrations.surveymonkey.create_collector({
  survey_id = "123456789",
  type = "weblink",
  name = "Website Feedback Link"
})

print("Collector URL: " .. result.url)
```

---

## get_current_user

Get details of the currently authenticated SurveyMonkey user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.surveymonkey.get_current_user({})

print("User: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
print("Plan: " .. (result.group_type or "free"))
```

---

## Multi-Account Usage

If you have multiple SurveyMonkey accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.surveymonkey.function_name({...})

-- Explicit default (portable across setups)
app.integrations.surveymonkey.default.function_name({...})

-- Named accounts
app.integrations.surveymonkey.work.function_name({...})
app.integrations.surveymonkey.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
