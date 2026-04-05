# Tally Forms — Lua API Reference

## list_forms

List all Tally forms accessible to the authenticated user. Returns form IDs, titles, status, and submission counts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of forms per page (default: 20, max: 100) |

### Example

```lua
local forms = app.integrations.tally.list_forms({ limit = 10 })

for _, form in ipairs(forms.data) do
  print(form.title .. " (" .. form.status .. ") - " .. form.numberOfResponses .. " responses")
end
```

---

## get_form

Get full details of a specific Tally form, including form structure, fields, and settings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The Tally form ID (e.g., `"mVlBRN"`) |

### Example

```lua
local form = app.integrations.tally.get_form({ form_id = "mVlBRN" })
print("Form: " .. form.title)
print("Status: " .. form.status)
print("Fields: " .. #form.questions)
```

---

## list_submissions

List all submissions for a specific Tally form. Returns respondent answers, submission dates, and metadata. Supports pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The Tally form ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of submissions per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.tally.list_submissions({
  form_id = "mVlBRN",
  limit = 50
})

for _, submission in ipairs(result.data) do
  print("Submitted at: " .. submission.createdAt)
  for _, response in ipairs(submission.questions) do
    print("  " .. response.question .. ": " .. tostring(response.value))
  end
end
```

---

## get_submission

Get full details of a specific form submission by its ID, including all field responses and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | string | yes | The Tally submission ID |

### Example

```lua
local sub = app.integrations.tally.get_submission({ submission_id = "sub_abc123" })
print("Submitted: " .. sub.createdAt)
for _, response in ipairs(sub.questions) do
  print(response.question .. ": " .. tostring(response.value))
end
```

---

## list_workspaces

List all workspaces accessible to the authenticated Tally user.

### Parameters

None.

### Example

```lua
local workspaces = app.integrations.tally.list_workspaces({})
for _, ws in ipairs(workspaces.data) do
  print("Workspace: " .. ws.name .. " (ID: " .. ws.id .. ")")
end
```

---

## get_current_user

Get the authenticated user's profile information, including name and email.

### Parameters

None.

### Example

```lua
local user = app.integrations.tally.get_current_user({})
print("Logged in as: " .. user.name .. " (" .. user.email .. ")")
```

---

## Common Workflows

### List all forms and their recent submissions

```lua
local forms = app.integrations.tally.list_forms({ limit = 20 })

for _, form in ipairs(forms.data) do
  print("== " .. form.title .. " ==")

  if form.numberOfResponses and form.numberOfResponses > 0 then
    local submissions = app.integrations.tally.list_submissions({
      form_id = form.id,
      limit = 5
    })

    for _, sub in ipairs(submissions.data) do
      print("  " .. sub.createdAt)
    end
  else
    print("  No submissions yet")
  end
end
```

### Find a form by title and get its submissions

```lua
local forms = app.integrations.tally.list_forms({ limit = 100 })
local target = nil

for _, form in ipairs(forms.data) do
  if form.title == "Contact Form" then
    target = form
    break
  end
end

if target then
  local subs = app.integrations.tally.list_submissions({
    form_id = target.id,
    limit = 50
  })

  print("Found " .. #subs.data .. " submissions")
end
```

## Notes

- Form IDs are short alphanumeric strings (e.g., `"mVlBRN"`)
- Pagination is page-based; increase `page` to get more results
- Submission responses are in the `questions` array of each submission object
- Rate limits may apply; use pagination rather than requesting large limits

---

## Multi-Account Usage

If you have multiple Tally accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.tally.list_forms({})

-- Explicit default (portable across setups)
app.integrations.tally.default.list_forms({})

-- Named accounts
app.integrations.tally.work.list_forms({})
app.integrations.tally.personal.list_forms({})
```

All functions are identical across accounts — only the credentials differ.
