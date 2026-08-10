# SendGrid — JavaScript API Reference

## list_emails

List emails in your SendGrid account with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of emails to return (default: 20, max: 100) |
| `query` | string | no | Search query to filter emails (e.g., `subject="Welcome"`) |

### Example

```js
var result = app.integrations.sendgrid.list_emails({
  limit: 10,
  query: 'subject="Welcome"',
})

for (const email of (result.messages)) {
  console.log(email.from_email + " -> " + email.subject)
}
```
---

## send_email

Send an email via SendGrid.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | object | yes | Sender with `email` and optionally `name` keys |
| `to` | array | yes | Array of recipient objects, each with `email` and optionally `name` |
| `subject` | string | yes | The email subject line |
| `htmlContent` | string | no | HTML body of the email |
| `textContent` | string | no | Plain text body of the email |

### Example

```js
var result = app.integrations.sendgrid.send_email({
  from: {
    email: "noreply@example.com",
    name: "My App",
  },
  to: [
    { email: "user@example.com", name: "John" }
  ],
  subject: "Welcome!",
  htmlContent: "<h1>Hello!</h1><p>Welcome to our service.</p>",
  textContent: "Hello! Welcome to our service.",
})

console.log("Email sent successfully")
```
---

## list_templates

List email templates in your SendGrid account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of templates to return per page (default: 20, max: 100) |
| `page_token` | string | no | Token for the next page of results |

### Example

```js
var result = app.integrations.sendgrid.list_templates({
  page_size: 10,
})

for (const template of (result.templates)) {
  console.log(template.id + ": " + template.name)
}
```
---

## get_template

Get details of a specific email template by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the template to retrieve |

### Example

```js
var result = app.integrations.sendgrid.get_template({
  id: "d-abc123def456",
})

console.log("Template: " + result.name)

if (result.versions) {
  for (const version of (result.versions)) {
    console.log("  Version: " + version.name + " (active: " + String(version.active) + ")")
  }
}
```
---

## list_contacts

List contacts in your SendGrid marketing contacts database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of contacts to return per page (default: 50, max: 100) |
| `page_token` | string | no | Token for the next page of results |

### Example

```js
var result = app.integrations.sendgrid.list_contacts({
  page_size: 20,
})

for (const contact of (result.result)) {
  console.log(contact.email)
}
```
---

## get_contact

Get details of a specific contact by their ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the contact to retrieve |

### Example

```js
var result = app.integrations.sendgrid.get_contact({
  id: "abc123-def456-ghi789",
})

console.log("Email: " + result.email)
console.log("First name: " + (result.first_name || "N/A"))
console.log("Last name: " + (result.last_name || "N/A"))
```
---

## get_current_user

Get the profile of the currently authenticated SendGrid user.

### Parameters

None.

### Example

```js
var result = app.integrations.sendgrid.get_current_user()

console.log("Email: " + result.email)
console.log("Name: " + (result.first_name || "") + " " + (result.last_name || ""))
```
---

## Multi-Account Usage

If you have multiple SendGrid accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.sendgrid.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.sendgrid.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.sendgrid.work.function_name({ /* parameters */ })
app.integrations.sendgrid.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
