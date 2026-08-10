# Telnyx — JavaScript API Reference

## list_phone_numbers

List phone numbers on your Telnyx account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Results per page (default: 20, max: 250) |
| `page_number` | integer | no | Page number (starts at 1) |
| `filter_phone_number` | string | no | Filter by E.164 number (e.g., `"+12345678900"`) |
| `filter_status` | string | no | Filter by status: `active`, `deleted`, `purchase_pending`, `purchase_failed`, `port_pending`, `port_failed` |

### Example

```js
var result = app.integrations.telnyx.list_phone_numbers({
  page_size: 10,
  filter_status: "active",
})

for (const pn of (result.data)) {
  console.log(pn.phone_number + " (" + pn.status + ")")
}
```
---

## get_phone_number

Get details for a specific phone number.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number_id` | string | yes | Telnyx phone number ID |

### Example

```js
var result = app.integrations.telnyx.get_phone_number({
  phone_number_id: "1293384265029123456",
})

console.log(result.data.phone_number) // "+12345678900"
console.log(result.data.status) // "active"
```
---

## list_messages

List SMS and MMS messages sent and received.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Results per page (default: 20, max: 250) |
| `page_number` | integer | no | Page number (starts at 1) |
| `direction` | string | no | `inbound` or `outbound` |
| `filter_source` | string | no | Source phone number (E.164) |
| `filter_destination` | string | no | Destination phone number (E.164) |
| `filter_status` | string | no | `queued`, `sending`, `sent`, `delivered`, `undeliverable`, `expired` |

### Example

```js
var result = app.integrations.telnyx.list_messages({
  direction: "outbound",
  page_size: 50,
})

for (const msg of (result.data)) {
  console.log(msg.from + " -> " + msg.to + ": " + msg.text)
}
```
---

## send_sms

Send an SMS or MMS message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender phone number (E.164, must be on your account) |
| `to` | string | yes | Destination phone number (E.164) |
| `text` | string | yes | Message body |
| `subject` | string | no | Subject (for MMS) |
| `media_urls` | array | no | URLs of media attachments for MMS |
| `use_mms` | boolean | no | Set to `true` to send as MMS |

### Example

```js
var result = app.integrations.telnyx.send_sms({
  from: "+12345678900",
  to: "+19876543210",
  text: "Hello from Telnyx!",
})

console.log("Message ID: " + result.data.id)
console.log("Status: " + result.data.status)
```
---

## list_calls

List voice calls on the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Results per page (default: 20, max: 250) |
| `page_number` | integer | no | Page number (starts at 1) |
| `filter_status` | string | no | `initiating`, `ringing`, `in-progress`, `no-answer`, `completed`, `failed`, `busy`, `timeout` |

### Example

```js
var result = app.integrations.telnyx.list_calls({
  filter_status: "completed",
  page_size: 20,
})

for (const call of (result.data)) {
  console.log("Call: " + call.call_session_id + " - " + call.status)
}
```
---

## get_call

Get details for a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_session_id` | string | yes | Call session ID |

### Example

```js
var result = app.integrations.telnyx.get_call({
  call_session_id: "0ccc7b54-4e3a-4fa1-8c3f-5d2e3f4g5h6i",
})

console.log("Status: " + result.data.status)
console.log("Duration: " + result.data.duration + "s")
```
---

## list_call_records

List call recordings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Results per page (default: 20, max: 250) |
| `page_number` | integer | no | Page number (starts at 1) |
| `filter_call_session_id` | string | no | Filter by call session ID |
| `filter_conference_id` | string | no | Filter by conference ID |

### Example

```js
var result = app.integrations.telnyx.list_call_records({
  filter_call_session_id: "0ccc7b54-4e3a-4fa1-8c3f-5d2e3f4g5h6i",
})

for (const rec of (result.data)) {
  console.log("Recording: " + rec.id + " - " + rec.duration + "s")
  console.log("Download: " + rec.download_urls[0])
}
```
---

## Multi-Account Usage

If you have multiple Telnyx accounts configured, use account-specific namespaces:

```js
// Default account
app.integrations.telnyx.send_sms({ from: "+1...", to: "+1...", text: "Hi" })

// Named accounts
app.integrations.telnyx.work.send_sms({ from: "+1...", to: "+1...", text: "Hi" })
app.integrations.telnyx.personal.send_sms({ from: "+1...", to: "+1...", text: "Hi" })
```
All functions are identical across accounts — only the credentials differ.
