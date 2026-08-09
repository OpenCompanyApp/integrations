# Jotform — JavaScript API Reference

## list_forms

List all forms owned by the authenticated Jotform user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of forms to return (default: 20, max: 1000) |
| `offset` | integer | no | Offset for pagination |
| `orderby` | string | no | Order field: `"created_at"`, `"title"`, `"id"`, `"updated_at"` |
| `status` | string | no | Filter by status: `"ENABLED"` or `"DISABLED"` |
| `title` | string | no | Filter by form title (partial match) |

### Example

```js
var result = app.integrations.jotform.list_forms({
  limit: 10,
  orderby: "created_at",
})

for (const form of (result)) {
  console.log(form.title + " (ID: " + form.id + ")")
}
```
---

## get_form

Get detailed information about a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID (e.g., `"231234567890123"`) |

### Example

```js
var result = app.integrations.jotform.get_form({
  form_id: "231234567890123",
})

console.log("Title: " + result.title)
console.log("URL: " + result.url)
console.log("Status: " + result.status)
console.log("Created: " + result.created_at)
```
---

## list_submissions

List submissions for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID |
| `limit` | integer | no | Maximum number of submissions (default: 20, max: 1000) |
| `offset` | integer | no | Offset for pagination |
| `orderby` | string | no | Order field: `"created_at"` (default) or `"id"` |
| `created_at` | string | no | Filter by creation date (format: `"YYYY-MM-DD HH:mm:ss"` or date range) |
| `status` | string | no | Filter by status: `"ACTIVE"` or `"DELETED"` |

### Example

```js
var result = app.integrations.jotform.list_submissions({
  form_id: "231234567890123",
  limit: 10,
  orderby: "created_at",
})

for (const sub of (result)) {
  console.log("Submission " + sub.id + " at " + sub.created_at)
  for (const [key, answer] of Object.entries(sub.answers)) {
    console.log("  " + answer.name + ": " + String(answer.answer))
  }
}
```
---

## get_submission

Get details for a specific submission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | string | yes | The submission ID (e.g., `"512345678901234567"`) |

### Example

```js
var result = app.integrations.jotform.get_submission({
  submission_id: "512345678901234567",
})

for (const [key, answer] of Object.entries(result.answers)) {
  console.log(answer.name + ": " + String(answer.answer))
}
```
---

## create_form

Create a new form in Jotform.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title of the form |
| `questions` | array | no | Array of question definitions (see below) |
| `properties` | object | no | Additional form properties |

### Question Types

| Type | Description |
|------|-------------|
| `control_textbox` | Single-line text input |
| `control_textarea` | Multi-line text input |
| `control_email` | Email input |
| `control_dropdown` | Dropdown select |
| `control_radio` | Radio button group |
| `control_checkbox` | Checkbox group |
| `control_number` | Number input |
| `control_phone` | Phone number input |
| `control_datetime` | Date/time picker |
| `control_fileupload` | File upload |
| `control_scale` | Rating scale |
| `control_matrix` | Matrix / grid |
| `control_fullname` | Full name (first + last) |
| `control_address` | Address (street, city, state, zip, country) |
| `control_hidden` | Hidden field |
| `control_button` | Submit button |

### Example

```js
var result = app.integrations.jotform.create_form({
  title: "Contact Form",
  questions: [
    {
      type: "control_fullname",
      name: "Name",
      order: "1",
      required: "Yes",
    },
    {
      type: "control_email",
      name: "Email",
      order: "2",
      required: "Yes",
    },
    {
      type: "control_textarea",
      name: "Message",
      order: "3",
    }
  ]
})

console.log("Created form: " + result.id)
console.log("URL: " + result.url)
```
---

## list_questions

List all questions (form fields) for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID |
| `offset` | integer | no | Offset for pagination |

### Example

```js
var result = app.integrations.jotform.list_questions({
  form_id: "231234567890123",
})

for (const [key, question] of Object.entries(result)) {
  console.log(question.type + ": " + question.name + " (order: " + question.order + ")")
}
```
---

## get_current_user

Get profile information for the authenticated user.

### Parameters

None.

### Example

```js
var result = app.integrations.jotform.get_current_user({})

console.log("Username: " + result.username)
console.log("Email: " + result.email)
console.log("Account type: " + result.account_type)
console.log("Forms used: " + result.usage.forms + " / " + result.usage.form_limit)
```
---

## Multi-Account Usage

If you have multiple Jotform accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.jotform.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.jotform.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.jotform.work.function_name({ /* parameters */ })
app.integrations.jotform.client.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
