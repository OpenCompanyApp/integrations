# Patreon — Ruby API Reference

## list_campaigns

List all campaigns for the authenticated Patreon creator.

### Parameters

None.

### Examples

```ruby
result = app.integrations.patreon.list_campaigns()
result.campaigns.each do |campaign|
  puts((campaign.attributes.creation_name).to_s + " — Patrons: " + (campaign.attributes.patron_count).to_s)
end
```
---

## get_campaign

Get detailed information about a single Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to retrieve |

### Example

```ruby
result = app.integrations.patreon.get_campaign(campaign_id: "123456")
puts(result.attributes.creation_name)
puts(result.attributes.summary)
puts(result.attributes.patron_count)
```
---

## list_members

List members (patrons) for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list members for |

### Examples

#### All members

```ruby
result = app.integrations.patreon.list_members(campaign_id: "123456")
result.members.each do |member|
  puts((member.attributes.full_name).to_s + " — " + (member.attributes.patron_status).to_s)
end
```
---

## get_member

Get details for a single Patreon member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member to retrieve |

### Example

```ruby
result = app.integrations.patreon.get_member(member_id: "789012")
puts(result.attributes.full_name)
puts(result.attributes.email)
puts(result.attributes.patron_status)
```
---

## list_posts

List posts for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list posts for |

### Examples

```ruby
result = app.integrations.patreon.list_posts(campaign_id: "123456")
result.posts.each do |post|
  puts((post.attributes.title).to_s + " — " + (post.attributes.published_at).to_s)
end
```
---

## get_post

Get details for a single Patreon post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to retrieve |

### Example

```ruby
result = app.integrations.patreon.get_post(post_id: "345678")
puts(result.attributes.title)
puts(result.attributes.content)
puts(result.attributes.published_at)
```
---

## get_current_user

Get the profile of the currently authenticated Patreon user.

### Parameters

None.

### Example

```ruby
result = app.integrations.patreon.get_current_user()
puts("Connected as: " + (result.attributes.full_name).to_s)
puts("Email: " + (result.attributes.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Patreon accounts configured, use account-specific namespaces:

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
