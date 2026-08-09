# Twilio — JavaScript API Reference

## twilio_send_sms

Send an SMS or MMS message via Twilio. Provide "to" and "from" phone numbers in E.164 format (e.g., `"+15551234567"`). Optionally include `media_url` for MMS and `status_callback` for delivery tracking.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Destination phone number in E.164 format. |
| `from` | string | yes | Twilio phone number to send from in E.164 format. |
| `body` | string | yes | Text body of the message (max 1600 characters). |
| `media_url` | string | no | URL of media to include (for MMS). |
| `status_callback` | string | no | URL Twilio will call with status updates. |

### Example

```js
var result = app.integrations.twilio.twilio_send_sms({
  to: "+15551234567",
  from: "+15559876543",
  body: "Hello from Twilio!",
})

console.log("Message SID: " + result.sid)
console.log("Status: " + result.status)
```
## twilio_get_message

Retrieve a Twilio message by its SID. Returns the full message details including status, body, timestamps, and pricing.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message_sid` | string | yes | Message SID (e.g., `"SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```js
var result = app.integrations.twilio.twilio_get_message({
  message_sid: "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
})

console.log("Status: " + result.status)
console.log("Body: " + result.body)
```
## twilio_list_messages

List Twilio messages with optional filtering. Filter by To, From, DateSent. Use `page_size` to control pagination (default 50, max 1000).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | no | Filter by destination phone number in E.164 format. |
| `from` | string | no | Filter by originating phone number in E.164 format. |
| `date_sent` | string | no | Filter by date sent (YYYY-MM-DD format). |
| `limit` | integer | no | Maximum number of messages to return. |
| `page_size` | integer | no | Number of results per page (default 50, max 1000). |

### Example

```js
var result = app.integrations.twilio.twilio_list_messages({
  to: "+15551234567",
  limit: 10,
})

for (const msg of (result.messages)) {
  console.log(msg.sid + " — " + msg.status + ": " + msg.body)
}
```
## twilio_make_call

Make an outbound voice call via Twilio. Provide a `url` that returns TwiML, or inline `twiml` to control the call. Optionally provide a `status_callback` URL for call progress events.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Destination phone number in E.164 format. |
| `from` | string | yes | Twilio phone number to call from in E.164 format. |
| `url` | string | no | URL that returns TwiML instructions for the call. |
| `twiml` | string | no | Inline TwiML to execute when the call connects. |
| `status_callback` | string | no | URL Twilio will call with status updates. |

### Example

```js
var result = app.integrations.twilio.twilio_make_call({
  to: "+15551234567",
  from: "+15559876543",
  twiml: '<Response><Say>Hello from Twilio!</Say></Response>',
})

console.log("Call SID: " + result.sid)
console.log("Status: " + result.status)
```
## twilio_get_call

Retrieve a Twilio call by its SID. Returns the full call details including status, duration, timestamps, and pricing.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_sid` | string | yes | Call SID (e.g., `"CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```js
var result = app.integrations.twilio.twilio_get_call({
  call_sid: "CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
})

console.log("Status: " + result.status)
console.log("Duration: " + (result.duration || "N/A") + " seconds")
```
## twilio_list_calls

List Twilio calls with optional filtering. Filter by To, From, Status. Use `page_size` to control pagination (default 50, max 1000).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | no | Filter by destination phone number in E.164 format. |
| `from` | string | no | Filter by originating phone number in E.164 format. |
| `status` | string | no | Filter by call status (`queued`, `ringing`, `in-progress`, `canceled`, `completed`, `failed`, `busy`, `no-answer`). |
| `limit` | integer | no | Maximum number of calls to return. |
| `page_size` | integer | no | Number of results per page (default 50, max 1000). |

### Example

```js
var result = app.integrations.twilio.twilio_list_calls({
  status: "completed",
  limit: 10,
})

for (const call of (result.calls)) {
  console.log(call.sid + " — " + call.status + " (" + (call.duration || "0") + "s)")
}
```
## twilio_list_phone_numbers

List incoming phone numbers on the Twilio account. Returns all phone numbers associated with the account, including capabilities.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of phone numbers to return. |

### Example

```js
var result = app.integrations.twilio.twilio_list_phone_numbers({})

for (const pn of (result.phone_numbers)) {
  console.log(pn.phone_number + " (" + pn.friendly_name + ")")
}
```
## twilio_get_phone_number

Retrieve a Twilio incoming phone number by its SID. Returns phone number details including capabilities and configuration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_sid` | string | yes | Phone number SID (e.g., `"PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```js
var result = app.integrations.twilio.twilio_get_phone_number({
  phone_sid: "PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
})

console.log(result.phone_number + " — " + result.friendly_name)
```
## twilio_lookup_phone

Lookup phone number details using the Twilio Lookup API v2. Provide a phone number in E.164 format. Optionally request additional fields like `"caller_name"`, `"line_type_intelligence"`, `"sim_swap"`, or `"call_forwarding"`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number` | string | yes | Phone number in E.164 format (e.g., `"+15551234567"`). |
| `fields` | string | no | Comma-separated list of additional fields to request (e.g., `"line_type_intelligence,caller_name"`). |

### Example

```js
var result = app.integrations.twilio.twilio_lookup_phone({
  phone_number: "+15551234567",
  fields: "line_type_intelligence,caller_name",
})

console.log("Valid: " + String(result.valid))
console.log("Country: " + result.country_code)
```
## twilio_create_usage_trigger

Create a usage trigger on the Twilio account. Twilio will notify the callback URL when usage of the specified category exceeds the trigger value. Supports recurring triggers (daily, monthly, yearly) or one-time triggers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `usage_category` | string | yes | Usage category to monitor (e.g., `"calls"`, `"sms"`, `"phonenumbers"`, `"totalprice"`). |
| `trigger_value` | string | yes | Usage value that triggers the callback (e.g., `"100.00"`). |
| `callback_url` | string | yes | URL Twilio will call when the trigger fires. |
| `recurring` | string | no | Recurrence interval: `"daily"`, `"monthly"`, `"yearly"`, or omit for one-time. |

### Example

```js
var result = app.integrations.twilio.twilio_create_usage_trigger({
  usage_category: "sms",
  trigger_value: "50.00",
  callback_url: "https://example.com/twilio/callback",
  recurring: "monthly",
})

console.log("Trigger SID: " + result.sid)
console.log("Current value: " + result.current_value)
```
## twilio_list_usage_records

List Twilio usage records with optional filtering. Filter by category and date range. Returns usage counts and pricing per category.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `category` | string | no | Filter by usage category (e.g., `"calls"`, `"sms"`, `"phonenumbers"`, `"totalprice"`). |
| `start_date` | string | no | Start date for usage records (YYYY-MM-DD format). |
| `end_date` | string | no | End date for usage records (YYYY-MM-DD format). |
| `limit` | integer | no | Maximum number of records to return. |

### Example

```js
var result = app.integrations.twilio.twilio_list_usage_records({
  category: "sms",
  start_date: "2026-01-01",
  end_date: "2026-01-31",
})

for (const record of (result.usage_records)) {
  console.log(record.category + ": " + record.count + " (" + record.price + " " + record.price_unit + ")")
}
```
## twilio_send_whatsapp

Send a WhatsApp message via Twilio. Provide "to" and "from" phone numbers in E.164 format — they will automatically be prefixed with `"whatsapp:"`. Supports text and media messages.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Destination phone number in E.164 format (e.g., `"+15551234567"`). |
| `from` | string | yes | Twilio WhatsApp-enabled phone number in E.164 format. |
| `body` | string | yes | Text body of the WhatsApp message. |
| `media_url` | string | no | URL of media to include (image, audio, video, or document). |

### Example

```js
var result = app.integrations.twilio.twilio_send_whatsapp({
  to: "+15551234567",
  from: "+15559876543",
  body: "Hello via WhatsApp!",
})

console.log("Message SID: " + result.sid)
console.log("Status: " + result.status)
```
## twilio_get_account

Retrieve Twilio account details. Optionally provide an account SID to look up a specific subaccount, or omit to retrieve the current account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sid` | string | no | Account SID to look up, or omit for the current account. |

### Example

```js
var result = app.integrations.twilio.twilio_get_account({})

console.log("Account: " + result.friendly_name)
console.log("Status: " + result.status)
console.log("Type: " + result.type)
```
## twilio_list_recordings

List Twilio call recordings with optional filtering. Filter by call SID, date created, or limit the number of results returned.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_sid` | string | no | Filter by call SID to get recordings for a specific call. |
| `date_created` | string | no | Filter by date created (YYYY-MM-DD format). |
| `limit` | integer | no | Maximum number of recordings to return. |

### Example

```js
var result = app.integrations.twilio.twilio_list_recordings({
  limit: 10,
})

for (const rec of (result.recordings)) {
  console.log(rec.sid + " — " + rec.duration + "s — " + rec.status)
}
```
## twilio_delete_recording

Delete a Twilio recording by its SID. Permanently removes the recording and all associated media. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `recording_sid` | string | yes | Recording SID (e.g., `"RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```js
var result = app.integrations.twilio.twilio_delete_recording({
  recording_sid: "RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
})

console.log("Deleted: " + String(result.deleted))
```
---

## Multi-Account Usage

If you have multiple twilio accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.twilio.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.twilio.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.twilio.work.function_name({ /* parameters */ })
app.integrations.twilio.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
