# Plivo — Ruby API Reference

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

```ruby
result = app.integrations.plivo.list_messages(limit: 10, message_direction: "outbound")
result.objects.each do |msg|
  puts((msg.message_uuid).to_s + ": " + (msg.from).to_s + " -> " + (msg.to).to_s + " [" + (msg.message_state).to_s + "]")
end
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

```ruby
result = app.integrations.plivo.send_sms(src: "+14155552671", dst: "+14155552672", text: "Hello from Plivo!")
puts("Message UUID: " + ((result.message_uuid).to_s).to_s)
puts("API ID: " + ((result.api_id).to_s).to_s)
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

```ruby
result = app.integrations.plivo.list_numbers(limit: 20)
result.objects.each do |num|
  puts((num.number).to_s + " (" + ((num.alias || "no alias")).to_s + ")")
end
```
---

## get_number

Retrieve details of a specific phone number.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `number` | string | yes | The phone number to retrieve (e.g., `"+14155552671"`) |

### Example

```ruby
result = app.integrations.plivo.get_number(number: "+14155552671")
puts("Number: " + (result.number).to_s)
puts("Alias: " + ((result.alias || "none")).to_s)
puts("Application: " + ((result.app_id || "none")).to_s)
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

```ruby
result = app.integrations.plivo.list_calls(limit: 10, call_direction: "inbound")
result.objects.each do |call|
  puts((call.call_uuid).to_s + ": " + (call.from).to_s + " -> " + (call.to).to_s + " [" + (call.call_status).to_s + "]")
end
```
---

## get_call

Retrieve detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique call UUID |

### Example

```ruby
result = app.integrations.plivo.get_call(call_id: "abc123-def456-789")
puts("From: " + (result.from).to_s + " -> To: " + (result.to).to_s)
puts("Duration: " + ((result.duration).to_s).to_s + "s")
puts("Status: " + (result.call_status).to_s)
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

```ruby
result = app.integrations.plivo.list_applications()
result.objects.each do |app|
  puts((app.app_id).to_s + ": " + (app.app_name).to_s)
  puts("  Answer URL: " + (app.answer_url).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Plivo accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
