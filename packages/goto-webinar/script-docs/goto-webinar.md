# GoTo Webinar — Ruby API Reference

## list_webinars

List webinars from GoTo Webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-based, default: 0) |
| `size` | integer | no | Page size (default: 20, max: 200) |
| `status` | string | no | Filter: `"ACTIVE"`, `"IN_SESSION"`, `"ENDED"`, `"CANCELED"` |

### Examples

```ruby
# List all upcoming webinars
result = app.call("integrations.goto-webinar.list", status: "ACTIVE")
(result._embedded.webinars || []).each do |webinar|
  puts((webinar.subject).to_s + " (" + (webinar.webinarKey).to_s + ")")
end
# Paginate through past webinars
result = app.call("integrations.goto-webinar.list", status: "ENDED", page: 0, size: 50)
```
---

## get_webinar

Get details of a specific webinar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The webinar key |

### Example

```ruby
result = app.call("integrations.goto-webinar.get", id: "1234567890")
puts(result.subject)
puts(result.description)
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

```ruby
result = app.call("integrations.goto-webinar.create", subject: "Q2 Product Demo", times: [{startTime: "2026-04-15T14:00:00Z", endTime: "2026-04-15T15:00:00Z"}], description: "Join us for a live demo of our latest features.")
puts("Created webinar: " + (result.webinarKey).to_s)
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

```ruby
result = app.call("integrations.goto-webinar.list_sessions", webinar_id: "1234567890")
(result._embedded.sessions || []).each do |session|
  puts((session.sessionKey).to_s + ": " + (session.startTime).to_s)
end
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

```ruby
result = app.call("integrations.goto-webinar.get_session", webinar_id: "1234567890", id: "9876543210")
puts("Attendees: " + (result.attendees).to_s)
puts("Duration (seconds): " + (result.duration).to_s)
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

```ruby
result = app.call("integrations.goto-webinar.list_panelists", webinar_id: "1234567890")
(result._embedded.panelists || []).each do |panelist|
  puts((panelist.name).to_s + " <" + (panelist.email).to_s + ">")
end
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.goto-webinar.get_current_user")
puts((result.firstName).to_s + " " + (result.lastName).to_s)
puts("Email: " + (result.email).to_s)
puts("Account key: " + (result.accountKey).to_s)
```
---

## Multi-Account Usage

If you have multiple GoTo Webinar accounts configured, use account-specific namespaces:

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
