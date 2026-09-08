# Zendesk Marketing — Ruby API Reference

## list_campaigns

List all email marketing campaigns in your Zendesk account.

### Parameters

None.

### Example

```ruby
result = app.integrations.zend.list_campaigns()
result.each do |campaign|
  puts((campaign.subject).to_s + " (" + (campaign.status).to_s + ")")
end
```
---

## get_campaign

Get detailed information about a specific email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The campaign ID |

### Example

```ruby
result = app.integrations.zend.get_campaign(campaign_id: "abc123")
puts("Subject: " + (result.subject).to_s)
puts("Status: " + (result.status).to_s)
```
---

## create_campaign

Create a new email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | The campaign email subject line |
| `content` | string | no | The HTML content of the campaign email |
| `list_ids` | array | no | Array of subscriber list IDs to target |
| `from_name` | string | no | The sender name for the campaign |
| `from_email` | string | no | The sender email address for the campaign |

### Example

```ruby
result = app.integrations.zend.create_campaign(subject: "Monthly Newsletter", content: "<h1>Hello!</h1>", list_ids: ["list_abc", "list_def"], from_name: "Marketing Team", from_email: "marketing@example.com")
puts("Created campaign: " + (result.id).to_s)
```
---

## list_lists

List all subscriber lists in your Zendesk account.

### Parameters

None.

### Example

```ruby
result = app.integrations.zend.list_subscriber_lists()
result.each do |list|
  puts((list.name).to_s + " (" + (list.id).to_s + ")")
end
```
---

## get_list

Get detailed information about a specific subscriber list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The subscriber list ID |

### Example

```ruby
result = app.integrations.zend.get_subscriber_list(list_id: "abc123")
puts("List: " + (result.name).to_s)
puts("Subscribers: " + (result.subscriber_count).to_s)
```
---

## list_subscribers

List subscribers on a Zendesk list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | no | The subscriber list ID to filter by |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of subscribers per page (default: 100) |

### Example

```ruby
result = app.integrations.zend.list_subscribers(list_id: "abc123", page: 1, page_size: 50)
result.data.each do |sub|
  puts((sub.email).to_s + " - " + (sub.name).to_s)
end
```
---

## get_subscribers

Get detailed information about a specific subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | string | yes | The subscriber ID |

### Example

```ruby
result = app.integrations.zend.get_subscriber(subscriber_id: "sub_abc123")
puts("Email: " + (result.email).to_s)
puts("Name: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
```
---

## get_current_user

Get the authenticated user's Zendesk account details.

### Parameters

None.

### Example

```ruby
result = app.integrations.zend.get_current_user()
puts("Account: " + (result.email).to_s)
puts("Name: " + (result.name).to_s)
```
---

## Multi-Account Usage

If you have multiple Zendesk accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.zend.list_subscriber_lists()
# Explicit default (portable across setups)
app.integrations.zend.default.list_subscriber_lists()
# Named accounts
app.integrations.zend.marketing.list_subscriber_lists()
app.integrations.zend.transactional.list_subscriber_lists()
```
All functions are identical across accounts — only the credentials differ.
