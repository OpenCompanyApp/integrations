# Plivo — JavaScript API Reference

## list_messages

List SMS messages from Plivo with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `message_direction` | string | no | Filter by direction: `"inbound"` or `"outbound"` |
| `message_state` | string | no | Filter by state: `"queued"`, `"sent"`, `"delivered"`, `"undelivered"`, `"failed"` |
| `src` | string | no | Filter by source phone number (sender) |
| `dst` | string | no | Filter by destination phone number (recipient) |
| `start_time` | string | no | Filter messages after this datetime (ISO 8601) |
| `end_time` | string | no | Filter messages before this datetime (ISO 8601) |

### Example

```js
var result = app.integrations.plivo.list_messages({
  limit: 10,
  message_direction: "outbound",
})

for (const msg of (result.objects)) {
  console.log(msg.message_uuid + ": " + msg.from + " -> " + msg.to + " [" + msg.message_state + "]")
}
```
---

## send_sms

Send an SMS message via Plivo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `src` | string | yes | Source phone number (must be a Plivo-hosted number, e.g., `"+14155552671"`) |
| `dst` | string | yes | Destination number(s). Single number or multiple separated by `"<"` |
| `text` | string | yes | The SMS message text content |
| `type` | string | no | Message type: `"sms"` (default) or `"mms"` |
| `url` | string | no | Webhook URL for delivery status callbacks |
| `log` | boolean | no | Whether to log the message (default: true) |

### Example

```js
var result = app.integrations.plivo.send_sms({
  src: "+14155552671",
  dst: "+14155552672",
  text: "Hello from Plivo!",
})

console.log("Message UUID: " + String(result.message_uuid))
console.log("API ID: " + String(result.api_id))
```
---

## list_numbers

List phone numbers on your Plivo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `number_type` | string | no | Filter by type: `"local"`, `"tollfree"`, or `"national"` |
| `service` | string | no | Filter by service: `"voice"`, `"sms"`, or `"voice,sms"` |

### Example

```js
var result = app.integrations.plivo.list_numbers({
  limit: 20,
})

for (const num of (result.objects)) {
  console.log(num.number + " (" + (num.alias || "no alias") + ")")
}
```
---

## get_number

Retrieve details of a specific phone number.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `number` | string | yes | The phone number to retrieve (e.g., `"+14155552671"`) |

### Example

```js
var result = app.integrations.plivo.get_number({
  number: "+14155552671",
})

console.log("Number: " + result.number)
console.log("Alias: " + (result.alias || "none"))
console.log("Application: " + (result.app_id || "none"))
```
---

## list_calls

List calls from Plivo with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `call_direction` | string | no | Filter by direction: `"inbound"` or `"outbound"` |
| `call_state` | string | no | Filter by state: `"ringing"`, `"in-progress"`, `"ended"`, etc. |
| `from_number` | string | no | Filter by caller phone number |
| `to_number` | string | no | Filter by callee phone number |
| `start_time` | string | no | Filter calls after this datetime (ISO 8601) |
| `end_time` | string | no | Filter calls before this datetime (ISO 8601) |

### Example

```js
var result = app.integrations.plivo.list_calls({
  limit: 10,
  call_direction: "inbound",
})

for (const call of (result.objects)) {
  console.log(call.call_uuid + ": " + call.from + " -> " + call.to + " [" + call.call_status + "]")
}
```
---

## get_call

Retrieve detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique call UUID |

### Example

```js
var result = app.integrations.plivo.get_call({
  call_id: "abc123-def456-789",
})

console.log("From: " + result.from + " -> To: " + result.to)
console.log("Duration: " + String(result.duration) + "s")
console.log("Status: " + result.call_status)
```
---

## list_applications

List Plivo voice applications on the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```js
var result = app.integrations.plivo.list_applications({})

for (const app of (result.objects)) {
  console.log(app.app_id + ": " + app.app_name)
  console.log("  Answer URL: " + app.answer_url)
}
```
---

## Multi-Account Usage

If you have multiple Plivo accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.plivo.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.plivo.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.plivo.us.function_name({ /* parameters */ })
app.integrations.plivo.uk.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
