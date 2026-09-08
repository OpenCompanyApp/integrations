# Telnyx — Ruby API Reference

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

```ruby
result = app.integrations.telnyx.list_phone_numbers(page_size: 10, filter_status: "active")
result.data.each do |pn|
  puts((pn.phone_number).to_s + " (" + (pn.status).to_s + ")")
end
```
---

## get_phone_number

Get details for a specific phone number.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number_id` | string | yes | Telnyx phone number ID |

### Example

```ruby
result = app.integrations.telnyx.get_phone_number(phone_number_id: "1293384265029123456")
puts(result.data.phone_number)
# "+12345678900"
puts(result.data.status)
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

```ruby
result = app.integrations.telnyx.list_messages(direction: "outbound", page_size: 50)
result.data.each do |msg|
  puts((msg.from).to_s + " -> " + (msg.to).to_s + ": " + (msg.text).to_s)
end
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

```ruby
result = app.integrations.telnyx.send_sms(from: "+12345678900", to: "+19876543210", text: "Hello from Telnyx!")
puts("Message ID: " + (result.data.id).to_s)
puts("Status: " + (result.data.status).to_s)
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

```ruby
result = app.integrations.telnyx.list_calls(filter_status: "completed", page_size: 20)
result.data.each do |call|
  puts("Call: " + (call.call_session_id).to_s + " - " + (call.status).to_s)
end
```
---

## get_call

Get details for a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_session_id` | string | yes | Call session ID |

### Example

```ruby
result = app.integrations.telnyx.get_call(call_session_id: "0ccc7b54-4e3a-4fa1-8c3f-5d2e3f4g5h6i")
puts("Status: " + (result.data.status).to_s)
puts("Duration: " + (result.data.duration).to_s + "s")
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

```ruby
result = app.integrations.telnyx.list_call_recordings(filter_call_session_id: "0ccc7b54-4e3a-4fa1-8c3f-5d2e3f4g5h6i")
result.data.each do |rec|
  puts("Recording: " + (rec.id).to_s + " - " + (rec.duration).to_s + "s")
  puts("Download: " + (rec.download_urls[0]).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Telnyx accounts configured, use account-specific namespaces:

```ruby
# Default account
app.integrations.telnyx.send_sms(from: "+1...", to: "+1...", text: "Hi")
# Named accounts
app.integrations.telnyx.work.send_sms(from: "+1...", to: "+1...", text: "Hi")
app.integrations.telnyx.personal.send_sms(from: "+1...", to: "+1...", text: "Hi")
```
All functions are identical across accounts — only the credentials differ.
