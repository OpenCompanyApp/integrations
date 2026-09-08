# Twilio — Ruby API Reference

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

```ruby
result = app.integrations.twilio.send_sms(to: "+15551234567", from: "+15559876543", body: "Hello from Twilio!")
puts("Message SID: " + (result.sid).to_s)
puts("Status: " + (result.status).to_s)
```
## twilio_get_message

Retrieve a Twilio message by its SID. Returns the full message details including status, body, timestamps, and pricing.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message_sid` | string | yes | Message SID (e.g., `"SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```ruby
result = app.integrations.twilio.get_message(message_sid: "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
puts("Status: " + (result.status).to_s)
puts("Body: " + (result.body).to_s)
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

```ruby
result = app.integrations.twilio.list_messages(to: "+15551234567", limit: 10)
result.messages.each do |msg|
  puts((msg.sid).to_s + " — " + (msg.status).to_s + ": " + (msg.body).to_s)
end
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

```ruby
result = app.integrations.twilio.make_call(to: "+15551234567", from: "+15559876543", twiml: "<Response><Say>Hello from Twilio!</Say></Response>")
puts("Call SID: " + (result.sid).to_s)
puts("Status: " + (result.status).to_s)
```
## twilio_get_call

Retrieve a Twilio call by its SID. Returns the full call details including status, duration, timestamps, and pricing.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_sid` | string | yes | Call SID (e.g., `"CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```ruby
result = app.integrations.twilio.get_call(call_sid: "CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
puts("Status: " + (result.status).to_s)
puts("Duration: " + ((result.duration || "N/A")).to_s + " seconds")
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

```ruby
result = app.integrations.twilio.list_calls(status: "completed", limit: 10)
result.calls.each do |call|
  puts((call.sid).to_s + " — " + (call.status).to_s + " (" + ((call.duration || "0")).to_s + "s)")
end
```
## twilio_list_phone_numbers

List incoming phone numbers on the Twilio account. Returns all phone numbers associated with the account, including capabilities.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of phone numbers to return. |

### Example

```ruby
result = app.integrations.twilio.list_phone_numbers()
result.phone_numbers.each do |pn|
  puts((pn.phone_number).to_s + " (" + (pn.friendly_name).to_s + ")")
end
```
## twilio_get_phone_number

Retrieve a Twilio incoming phone number by its SID. Returns phone number details including capabilities and configuration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_sid` | string | yes | Phone number SID (e.g., `"PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```ruby
result = app.integrations.twilio.get_phone_number(phone_sid: "PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
puts((result.phone_number).to_s + " — " + (result.friendly_name).to_s)
```
## twilio_lookup_phone

Lookup phone number details using the Twilio Lookup API v2. Provide a phone number in E.164 format. Optionally request additional fields like `"caller_name"`, `"line_type_intelligence"`, `"sim_swap"`, or `"call_forwarding"`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number` | string | yes | Phone number in E.164 format (e.g., `"+15551234567"`). |
| `fields` | string | no | Comma-separated list of additional fields to request (e.g., `"line_type_intelligence,caller_name"`). |

### Example

```ruby
result = app.integrations.twilio.lookup_phone(phone_number: "+15551234567", fields: "line_type_intelligence,caller_name")
puts("Valid: " + ((result.valid).to_s).to_s)
puts("Country: " + (result.country_code).to_s)
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

```ruby
result = app.integrations.twilio.create_usage_trigger(usage_category: "sms", trigger_value: "50.00", callback_url: "https://example.com/twilio/callback", recurring: "monthly")
puts("Trigger SID: " + (result.sid).to_s)
puts("Current value: " + (result.current_value).to_s)
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

```ruby
result = app.integrations.twilio.list_usage_records(category: "sms", start_date: "2026-01-01", end_date: "2026-01-31")
result.usage_records.each do |record|
  puts((record.category).to_s + ": " + (record.count).to_s + " (" + (record.price).to_s + " " + (record.price_unit).to_s + ")")
end
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

```ruby
result = app.integrations.twilio.send_whatsapp(to: "+15551234567", from: "+15559876543", body: "Hello via WhatsApp!")
puts("Message SID: " + (result.sid).to_s)
puts("Status: " + (result.status).to_s)
```
## twilio_get_account

Retrieve Twilio account details. Optionally provide an account SID to look up a specific subaccount, or omit to retrieve the current account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sid` | string | no | Account SID to look up, or omit for the current account. |

### Example

```ruby
result = app.integrations.twilio.get_account()
puts("Account: " + (result.friendly_name).to_s)
puts("Status: " + (result.status).to_s)
puts("Type: " + (result.type).to_s)
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

```ruby
result = app.integrations.twilio.list_recordings(limit: 10)
result.recordings.each do |rec|
  puts((rec.sid).to_s + " — " + (rec.duration).to_s + "s — " + (rec.status).to_s)
end
```
## twilio_delete_recording

Delete a Twilio recording by its SID. Permanently removes the recording and all associated media. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `recording_sid` | string | yes | Recording SID (e.g., `"RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"`). |

### Example

```ruby
result = app.integrations.twilio.delete_recording(recording_sid: "RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
puts("Deleted: " + ((result.deleted).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple twilio accounts configured, use account-specific namespaces:

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
