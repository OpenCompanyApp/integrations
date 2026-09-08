# Moosend — Ruby API Reference

## list_mailing_lists

List all mailing lists in your Moosend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of mailing lists to return (default: 10). |
| `offset` | integer | no | Offset for pagination (default: 0). |

### Example

```ruby
result = app.integrations.moosend.list_mailing_lists(limit: 20, offset: 0)
result.MailingLists.each do |list|
  puts((list.Name).to_s + " (ID: " + (list.ID).to_s + ") — " + (list.ActiveMemberCount).to_s + " active subscribers")
end
```
---

## get_mailing_list

Get detailed information about a specific mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The mailing list ID. |

### Example

```ruby
result = app.integrations.moosend.get_mailing_list(id: "abc123-def456")
list = result.MailingList
puts("List: " + (list.Name).to_s)
puts("Active subscribers: " + (list.ActiveMemberCount).to_s)
puts("Unsubscribed: " + (list.UnsubscribedMemberCount).to_s)
```
---

## create_mailing_list

Create a new mailing list in Moosend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new mailing list. |

### Example

```ruby
result = app.integrations.moosend.create_mailing_list(name: "Newsletter Subscribers")
puts("Created list with ID: " + (result.MailingList.ID).to_s)
```
---

## list_subscribers

List subscribers for a specific mailing list. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to retrieve subscribers for. |
| `limit` | integer | no | Maximum number of subscribers to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Subscribed"`, `"Unsubscribed"`, `"Bounced"`, `"Removed"`. |

### Example

```ruby
result = app.integrations.moosend.list_subscribers(list_id: "abc123-def456", limit: 50, page: 1, status: "Subscribed")
result.Subscribers.each do |sub|
  puts((sub.Email).to_s + " — " + ((sub.Name || "N/A")).to_s)
end
```
---

## add_subscriber

Add a new subscriber to a Moosend mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to add the subscriber to. |
| `email` | string | yes | The subscriber's email address. |
| `name` | string | no | The subscriber's name. |

### Example

```ruby
result = app.integrations.moosend.add_subscriber(list_id: "abc123-def456", email: "user@example.com", name: "Jane Doe")
puts("Added subscriber ID: " + (result.Subscriber.ID).to_s)
```
---

## list_campaigns

List all email campaigns in your Moosend account. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of campaigns to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Sent"`, `"Draft"`, `"Scheduled"`, `"Sending"`. |

### Example

```ruby
result = app.integrations.moosend.list_campaigns(limit: 20, page: 1, status: "Sent")
result.Campaigns.each do |campaign|
  puts((campaign.Name).to_s + " — Subject: " + (campaign.Subject).to_s + " — Status: " + (campaign.Status).to_s)
end
```
---

## get_current_user

Get the current authenticated Moosend user. Useful as a health check to verify API connectivity.

### Parameters

None.

### Example

```ruby
result = app.integrations.moosend.get_current_user()
puts("User: " + (result.User.Email).to_s)
puts("Account: " + (result.User.Company).to_s)
```
---

## Multi-Account Usage

If you have multiple Moosend accounts configured, use account-specific namespaces:

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
