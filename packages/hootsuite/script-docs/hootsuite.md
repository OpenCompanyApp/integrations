# Hootsuite — Ruby API Reference

## list_messages

List scheduled and past messages in Hootsuite.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | string | no | Start of time range (ISO 8601, e.g., `"2025-01-01T00:00:00Z"`) |
| `endTime` | string | no | End of time range (ISO 8601, e.g., `"2025-01-31T23:59:59Z"`) |
| `limit` | integer | no | Maximum number of messages to return |
| `socialProfileIds` | array | no | Array of social profile IDs to filter by |

### Example

```ruby
result = app.integrations.hootsuite.list_messages(start_time: "2025-01-01T00:00:00Z", end_time: "2025-01-31T23:59:59Z", limit: 20)
result.data.each do |msg|
  puts((msg.id).to_s + ": " + (msg.text).to_s)
end
```
---

## get_message

Get details of a specific message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messageId` | string | yes | The message ID to retrieve |

### Example

```ruby
result = app.integrations.hootsuite.get_message(message_id: "123456789")
puts(result.data.text)
puts(result.data.state)
```
---

## create_message

Schedule a new social media message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The message text content |
| `socialProfileIds` | array | yes | Social profile IDs to publish to |
| `scheduledSendTime` | string | yes | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |

### Example

```ruby
result = app.integrations.hootsuite.create_message(text: "Check out our latest blog post!", social_profile_ids: ["12345", "67890"], scheduled_send_time: "2025-02-01T09:00:00Z")
puts("Created message: " + (result.data[0].id).to_s)
```
---

## list_social_profiles

List all social media profiles connected to the Hootsuite account.

### Parameters

None.

### Example

```ruby
result = app.integrations.hootsuite.list_social_profiles()
result.data.each do |profile|
  puts((profile.id).to_s + ": " + (profile.socialNetworkUsername).to_s + " (" + (profile.type).to_s + ")")
end
```
---

## get_social_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```ruby
result = app.integrations.hootsuite.get_social_profile(profile_id: "12345")
puts(result.data.socialNetworkUsername)
puts(result.data.type)
```
---

## list_members

List members of the Hootsuite organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of members to return |

### Example

```ruby
result = app.integrations.hootsuite.list_members(limit: 50)
result.data.each do |member|
  puts((member.id).to_s + ": " + ((member.firstName || "")).to_s + " " + ((member.lastName || "")).to_s)
end
```
---

## get_current_user

Get the currently authenticated Hootsuite user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.hootsuite.get_current_user()
puts("Logged in as: " + ((result.data.firstName || "")).to_s + " " + ((result.data.lastName || "")).to_s)
puts("Email: " + ((result.data.email || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple Hootsuite accounts configured, use account-specific namespaces:

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
