# Microsoft Outlook — JavaScript API Reference

## list_messages

List email messages in the signed-in user's Outlook mailbox.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of messages to return (default: 25, max: 999) |
| `filter` | string | no | OData filter expression |
| `orderby` | string | no | OData orderby expression |
| `select` | string | no | Comma-separated list of properties to include |
| `skip` | integer | no | Number of messages to skip (for pagination) |

### Common Filter Examples

```
"isRead eq false"                                    -- Unread messages
"receivedDateTime ge 2025-01-01T00:00:00Z"           -- Since a date
"from/emailAddress/address eq 'boss@example.com'"    -- From a specific sender
"contains(subject, 'invoice')"                       -- Subject contains keyword
```

### Examples

```js
// List 10 most recent unread messages
var result = app.integrations["microsoft-outlook"].list_messages({
  top: 10,
  filter: "isRead eq false",
  orderby: "receivedDateTime desc",
})

for (const msg of (result.messages)) {
  console.log(msg.subject + " from " + msg.from.emailAddress.address)
}

// List messages from a specific sender
var result = app.integrations["microsoft-outlook"].list_messages({
  filter: "from/emailAddress/address eq 'alice@example.com'",
  top: 5,
})
```
---

## get_message

Retrieve a single email message by its id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message_id` | string | yes | The unique id of the message |
| `select` | string | no | Comma-separated list of properties to include |

### Example

```js
var msg = app.integrations["microsoft-outlook"].get_message({
  message_id: "AAMkAGI2TG93AAA=",
})

console.log(msg.subject)
console.log(msg.body.content)
```
---

## send_message

Send an email message via Outlook.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | array | yes | Array of recipient email addresses |
| `subject` | string | yes | Email subject line |
| `body` | string | yes | Email body content |
| `content_type` | string | no | "HTML" (default) or "Text" |
| `cc` | array | no | Array of CC email addresses |
| `bcc` | array | no | Array of BCC email addresses |
| `reply_to` | array | no | Array of reply-to email addresses |

### Example

```js
app.integrations["microsoft-outlook"].send_message({
  to: ["alice@example.com", "bob@example.com"],
  subject: "Meeting Tomorrow",
  body: "<p>Hi team,</p><p>Just a reminder about our meeting at 10am.</p>",
  content_type: "HTML",
  cc: ["manager@example.com"],
})
```
---

## list_calendars

List all calendars in the user's mailbox.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of calendars to return |
| `select` | string | no | Comma-separated list of properties to include |

### Example

```js
var result = app.integrations["microsoft-outlook"].list_calendars()

for (const cal of (result.calendars)) {
  console.log(cal.name + " (id: " + cal.id + ")")
}
```
---

## list_events

List events on the default Outlook calendar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of events to return (default: 25) |
| `filter` | string | no | OData filter expression |
| `orderby` | string | no | OData orderby expression |
| `select` | string | no | Comma-separated list of properties to include |
| `start_date_time` | string | no | Start of date range (ISO 8601, e.g. "2025-01-01T00:00:00") |
| `end_date_time` | string | no | End of date range (ISO 8601, e.g. "2025-12-31T23:59:59") |

### Examples

```js
// Get the next 10 upcoming events
var result = app.integrations["microsoft-outlook"].list_events({
  top: 10,
  orderby: "start/dateTime",
})

for (const evt of (result.events)) {
  console.log(evt.subject + " at " + evt.start.dateTime)
}

// Get events for a specific date range
var result = app.integrations["microsoft-outlook"].list_events({
  start_date_time: "2025-06-01T00:00:00",
  end_date_time: "2025-06-30T23:59:59",
  orderby: "start/dateTime",
})
```
---

## create_event

Create a new event on the default Outlook calendar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Event subject / title |
| `start` | string | yes | Start date and time (ISO 8601, e.g. "2025-06-15T09:00:00") |
| `end` | string | yes | End date and time (ISO 8601, e.g. "2025-06-15T10:00:00") |
| `time_zone` | string | no | IANA time zone (default: "UTC") |
| `body` | string | no | Event description |
| `body_type` | string | no | "HTML" (default) or "Text" |
| `location` | string | no | Location display name |
| `attendees` | array | no | Array of attendee email addresses |
| `is_all_day` | boolean | no | Whether this is an all-day event |

### Example

```js
var event = app.integrations["microsoft-outlook"].create_event({
  subject: "Team Standup",
  start: "2025-06-15T09:00:00",
  end: "2025-06-15T09:30:00",
  time_zone: "Europe/Amsterdam",
  body: "Daily standup meeting",
  location: "Conference Room A",
  attendees: ["alice@example.com", "bob@example.com"],
})

console.log("Created event: " + event.id)
```
---

## get_current_user

Get the signed-in user's profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `select` | string | no | Comma-separated list of properties to include |

### Example

```js
var user = app.integrations["microsoft-outlook"].get_current_user()

console.log("Name: " + user.displayName)
console.log("Email: " + (user.mail || user.userPrincipalName))
```
---

## Multi-Account Usage

If you have multiple Microsoft Outlook accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["microsoft-outlook"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["microsoft-outlook"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["microsoft-outlook"].work.function_name({ /* parameters */ })
app.integrations["microsoft-outlook"].personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
