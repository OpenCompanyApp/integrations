# Sprout Social — Ruby API Reference

## list_profiles

List all social media profiles connected to the Sprout Social account.

### Parameters

None.

### Example

```ruby
result = app.integrations.sproutsocial.list_profiles()
result.each do |profile|
  puts((profile.id).to_s + ": " + (profile.service).to_s + " (" + (profile.service_username).to_s + ")")
end
```
---

## get_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```ruby
result = app.integrations.sproutsocial.get_profile(profile_id: "123456")
puts(result.service)
puts(result.service_username)
```
---

## list_posts

List posts across social profiles with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of posts to return per page |
| `page` | integer | no | Page number for pagination |
| `status` | string | no | Filter by status: "sent", "scheduled", or "draft" |

### Example

```ruby
result = app.integrations.sproutsocial.list_posts(status: "scheduled", count: 20, page: 1)
result.posts.each do |post|
  puts((post.id).to_s + ": " + (post.text).to_s + " @ " + (post.scheduled_at).to_s)
end
```
---

## create_post

Create and schedule a new social media post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text content of the post |
| `profileIds` | array | yes | Profile IDs to publish to |
| `scheduledAt` | string | no | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |
| `media` | object | no | Media attachments (photo, link, etc.) |

### Example

```ruby
result = app.integrations.sproutsocial.create_post(text: "Check out our latest blog post! https://example.com/blog", profile_ids: ["123456", "789012"], scheduled_at: "2025-02-01T09:00:00Z")
puts("Created post: " + (result.id).to_s)
```
---

## list_messages

List inbox messages and conversations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of messages to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.sproutsocial.list_messages(count: 10)
result.messages.each do |msg|
  puts((msg.id).to_s + ": " + (msg.sender).to_s + " - " + (msg.snippet).to_s)
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
result = app.integrations.sproutsocial.get_message(message_id: "msg_abc123")
puts(result.sender)
puts(result.content)
```
---

## get_current_user

Get the currently authenticated Sprout Social user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.sproutsocial.get_current_user()
puts("Logged in as: " + ((result.name || "")).to_s)
puts("Email: " + ((result.email || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple Sprout Social accounts configured, use account-specific namespaces:

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
