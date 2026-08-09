# GoTo Webinar — JavaScript API Reference

## list_webinars

List webinars from GoTo Webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-based, default: 0) |
| `size` | integer | no | Page size (default: 20, max: 200) |
| `status` | string | no | Filter: `"ACTIVE"`, `"IN_SESSION"`, `"ENDED"`, `"CANCELED"` |

### Examples

```js
// List all upcoming webinars
var result = app.integrations["goto-webinar"].list_webinars({
  status: "ACTIVE",
})

for (const webinar of (result._embedded.webinars || [])) {
  console.log(webinar.subject + " (" + webinar.webinarKey + ")")
}

// Paginate through past webinars
var result = app.integrations["goto-webinar"].list_webinars({
  status: "ENDED",
  page: 0,
  size: 50,
})
```
---

## get_webinar

Get details of a specific webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The webinar key |

### Example

```js
var result = app.integrations["goto-webinar"].get_webinar({
  id: "1234567890",
})
console.log(result.subject)
console.log(result.description)
```
---

## create_webinar

Schedule a new webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Webinar title |
| `times` | array | yes | Time slots with `startTime` and `endTime` (ISO 8601) |
| `description` | string | no | Webinar description |

### Time Slot Format

Each time slot must include:

```json
{
  "startTime": "2026-04-10T15:00:00Z",
  "endTime": "2026-04-10T16:00:00Z"
}
```

For recurring webinars, pass multiple time slots.

### Example

```js
var result = app.integrations["goto-webinar"].create_webinar({
  subject: "Q2 Product Demo",
  times: [
    {
      startTime: "2026-04-15T14:00:00Z",
      endTime: "2026-04-15T15:00:00Z",
    }
  ],
  description: "Join us for a live demo of our latest features.",
})
console.log("Created webinar: " + result.webinarKey)
```
---

## list_sessions

List sessions for a specific webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `webinar_id` | string | yes | The webinar key |
| `page` | integer | no | Page number (0-based, default: 0) |
| `size` | integer | no | Page size (default: 20) |

### Example

```js
var result = app.integrations["goto-webinar"].list_sessions({
  webinar_id: "1234567890",
})
for (const session of (result._embedded.sessions || [])) {
  console.log(session.sessionKey + ": " + session.startTime)
}
```
---

## get_session

Get details of a specific session.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `webinar_id` | string | yes | The webinar key |
| `id` | string | yes | The session key |

### Example

```js
var result = app.integrations["goto-webinar"].get_session({
  webinar_id: "1234567890",
  id: "9876543210",
})
console.log("Attendees: " + result.attendees)
console.log("Duration (seconds): " + result.duration)
```
---

## list_panelists

List panelists for a specific webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `webinar_id` | string | yes | The webinar key |
| `page` | integer | no | Page number (0-based, default: 0) |
| `size` | integer | no | Page size (default: 20) |

### Example

```js
var result = app.integrations["goto-webinar"].list_panelists({
  webinar_id: "1234567890",
})
for (const panelist of (result._embedded.panelists || [])) {
  console.log(panelist.name + " <" + panelist.email + ">")
}
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```js
var result = app.integrations["goto-webinar"].get_current_user({})
console.log(result.firstName + " " + result.lastName)
console.log("Email: " + result.email)
console.log("Account key: " + result.accountKey)
```
---

## Multi-Account Usage

If you have multiple GoTo Webinar accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["goto-webinar"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["goto-webinar"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["goto-webinar"].marketing.function_name({ /* parameters */ })
app.integrations["goto-webinar"].sales.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
