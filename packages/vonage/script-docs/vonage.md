# Vonage — JavaScript API Reference

## send_sms

Send an SMS message via Vonage. Provide sender, recipient, and message text. The recipient number must be in E.164 format.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender ID or phone number (e.g. `"VonageAPI"` or a purchased number). |
| `to` | string | yes | Recipient phone number in E.164 format (e.g. `"14155552671"`). |
| `text` | string | yes | The SMS message body text. |
| `type` | string | no | Message type: `"text"` (default), `"unicode"`, or `"binary"`. |

### Examples

```js
var result = app.integrations.vonage.send_sms({
  from: "VonageAPI",
  to: "14155552671",
  text: "Hello from Vonage!",
})

console.log("Sent " + result.message_count + " message(s)")
for (const msg of (result.messages)) {
  console.log("  To: " + msg.to + " — ID: " + msg.message_id)
}
```
---

## list_messages

Search and list SMS messages from your Vonage account. Requires a date in YYYY-MM-DD format.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | Date to search messages for, in YYYY-MM-DD format (e.g. `"2025-01-15"`). |
| `to` | string | no | Recipient phone number to filter by (E.164 format). |

### Examples

```js
var result = app.integrations.vonage.list_messages({
  date: "2025-06-15",
})

for (const msg of (result.messages || [])) {
  console.log(msg.message_id + ": " + (msg.status || "unknown"))
}
```
```js
// Filter by recipient
var result = app.integrations.vonage.list_messages({
  date: "2025-06-15",
  to: "14155552671",
})
```
---

## list_sms

Search and list SMS messages from your Vonage account. Alias for list_messages with the same parameters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | Date to search in ISO format (YYYY-MM-DD, e.g. `"2025-01-15"`). |
| `to` | string | no | Filter by recipient phone number in E.164 format. |

### Examples

```js
var result = app.integrations.vonage.list_sms({
  date: "2025-06-01",
})
```
---

## list_numbers

List phone numbers purchased on your Vonage account. Optionally filter by pattern.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pattern` | string | no | A pattern to search for in the phone numbers. |
| `search_pattern` | integer | no | How to match the pattern: `0` = starts with, `1` = contains, `2` = ends with. |
| `size` | integer | no | Number of results per page (default: 10). |
| `index` | integer | no | Page index for pagination (1-based). |

### Examples

```js
var result = app.integrations.vonage.list_numbers()

for (const num of (result.numbers || [])) {
  console.log(num.msisdn + " (" + num.country + ")")
}
```
```js
// Find US numbers containing "555"
var result = app.integrations.vonage.list_numbers({
  pattern: "555",
  search_pattern: 1,
})
```
---

## get_account_balance

Get the current balance of your Vonage account.

### Parameters

None.

### Examples

```js
var result = app.integrations.vonage.get_account_balance()

console.log("Balance: " + result.value + " " + (result.currency || ""))
console.log("Auto-reload: " + String(result.auto_reload))
```
---

## list_applications

List Vonage applications configured on your account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of applications per page (default: 10). |
| `page` | integer | no | Page number for pagination (1-based). |

### Examples

```js
var result = app.integrations.vonage.list_applications()

for (const app of (result._embedded.applications || [])) {
  console.log(app.name + " — " + app.id)
}
```
---

## verify_request

Send a verification code to a phone number via Vonage Verify. Returns a request_id used to check the code later.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `number` | string | yes | Phone number to verify in E.164 format (e.g. `"14155552671"`). |
| `brand` | string | yes | The name shown in the verification message (e.g. `"MyApp"`). |

### Examples

```js
var result = app.integrations.vonage.verify_request({
  number: "14155552671",
  brand: "MyApp",
})

console.log("Request ID: " + result.request_id)
// Store request_id for use with verify_check
```
---

## verify_check

Check a verification code against a Vonage Verify request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `request_id` | string | yes | The request_id returned by the verify request. |
| `code` | string | yes | The verification code entered by the user. |

### Examples

```js
var result = app.integrations.vonage.verify_check({
  request_id: "abc123-request-id",
  code: "4821",
})

if (result.status === "0") {
  console.log("Verification successful!")
} else {
  console.log("Verification failed")
}
```
---

## Multi-Account Usage

If you have multiple vonage accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.vonage.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.vonage.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.vonage.us.function_name({ /* parameters */ })
app.integrations.vonage.eu.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
