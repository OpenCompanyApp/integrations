# Google Forms — Lua API Reference

## list_forms

List Google Forms owned by the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max forms per page (default: 20, max: 100) |
| `pageToken` | string | no | Token from a previous response to fetch the next page |
| `filter` | string | no | Filter expression, e.g. `"creator_email = 'user@example.com'"` |

### Examples

```lua
local result = app.integrations.google-forms.list_forms()

for _, form in ipairs(result.forms) do
  print(form.formId .. ": " .. (form.info.title or "Untitled"))
end
```

### Paginated

```lua
local result = app.integrations.google-forms.list_forms({ pageSize = 10 })

if result.nextPageToken then
  local next = app.integrations.google-forms.list_forms({ pageToken = result.nextPageToken })
end
```

---

## get_form

Get the full details of a specific Google Form, including questions and settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The form ID |

### Examples

```lua
local form = app.integrations.google-forms.get_form({ id = "FORM_ID" })

print("Title: " .. form.info.title)
print("Questions:")

for _, item in ipairs(form.items) do
  print("  - " .. item.title .. " (" .. item.questionItem.question.questionId .. ")")
end
```

---

## create_form

Create a new Google Form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `info` | object | no | Full form info object (JSON) for advanced creation |
| `title` | string | no | Title shown at the top of the form |
| `description` | string | no | Description shown below the title |
| `documentTitle` | string | no | Title shown in Google Drive |

### Examples

```lua
local result = app.integrations.google-forms.create_form({
  title = "Customer Feedback Survey",
  description = "Please share your experience with our service.",
  documentTitle = "Q1 2026 Customer Feedback"
})

print("Created form: " .. result.formId)
print("Edit URL: " .. result.responderUri)
```

### With pre-configured questions

```lua
local result = app.integrations.google-forms.create_form({
  info = {
    title = "Event RSVP",
    description = "Please confirm your attendance.",
    documentTitle = "Annual Meetup RSVP",
    items = {
      {
        title = "Will you attend?",
        questionItem = {
          question = {
            required = true,
            choiceQuestion = {
              type = "RADIO",
              options = {
                { value = "Yes" },
                { value = "No" },
                { value = "Maybe" }
              }
            }
          }
        }
      },
      {
        title = "Dietary restrictions?",
        questionItem = {
          question = {
            required = false,
            textQuestion = {
              paragraph = false
            }
          }
        }
      }
    }
  }
})
```

---

## list_responses

List responses submitted to a Google Form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The form ID |
| `pageSize` | integer | no | Max responses per page |
| `pageToken` | string | no | Token from a previous response to fetch the next page |
| `filter` | string | no | Filter expression, e.g. `"timestamp >= 1234567890"` |

### Examples

```lua
local result = app.integrations.google-forms.list_responses({ id = "FORM_ID" })

for _, response in ipairs(result.responses) do
  print("Response " .. response.responseId .. " at " .. response.lastSubmittedTime)

  for qid, answer in pairs(response.answers) do
    print("  Q: " .. qid)
    for _, a in ipairs(answer.textAnswers.answers) do
      print("    A: " .. a.value)
    end
  end
end
```

### Filter by date

```lua
local result = app.integrations.google-forms.list_responses({
  id = "FORM_ID",
  filter = "timestamp >= 1711929600"
})
```

---

## get_response

Get a specific form response by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID |
| `id` | string | yes | The response ID |

### Examples

```lua
local response = app.integrations.google-forms.get_response({
  form_id = "FORM_ID",
  id = "RESPONSE_ID"
})

for qid, answer in pairs(response.answers) do
  print(qid .. ": " .. answer.textAnswers.answers[1].value)
end
```

---

## create_response

Submit a response to a Google Form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The form ID |
| `answers` | object | yes | Map of question IDs to answer objects |

### Answer Format

Each answer should follow this structure:

```json
{
  "QUESTION_ID": {
    "textAnswers": {
      "answers": [
        { "value": "your answer" }
      ]
    }
  }
}
```

### Examples

```lua
local result = app.integrations.google-forms.create_response({
  id = "FORM_ID",
  answers = {
    ["QUESTION_ID_1"] = {
      textAnswers = {
        answers = {
          { value = "Yes" }
        }
      }
    },
    ["QUESTION_ID_2"] = {
      textAnswers = {
        answers = {
          { value = "Great experience, thank you!" }
        }
      }
    }
  }
})

print("Submitted response: " .. result.responseId)
```

---

## get_current_user

Get the authenticated Google user's profile.

### Parameters

None.

### Examples

```lua
local user = app.integrations.google-forms.get_current_user()

print("Email: " .. user.email)
print("Name: " .. (user.displayName or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Google Forms accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google-forms.function_name({...})

-- Explicit default (portable across setups)
app.integrations.google-forms.default.function_name({...})

-- Named accounts
app.integrations.google-forms.work.function_name({...})
app.integrations.google-forms.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
