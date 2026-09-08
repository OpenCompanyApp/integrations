# Actively CRM - Ruby API Reference

## list_organizations

List organizations you have access to in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max organizations to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.actively.list_organizations(limit: 10, page: 1)
result.data.each do |org|
  puts((org.id).to_s + ": " + (org.name).to_s)
end
```
---

## get_current_user

Get the authenticated user's profile from Actively.

### Parameters

None.

### Example

```ruby
user = app.integrations.actively.get_current_user()
puts("Logged in as: " + (user.name).to_s + " (" + (user.email).to_s + ")")
```
---

## list_campaigns

List campaigns for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max campaigns to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.actively.list_campaigns(org_id: "org_abc123", limit: 10, page: 1)
result.data.each do |campaign|
  puts((campaign.title).to_s + " (" + (campaign.type).to_s + ") - " + (campaign.status).to_s)
end
```
---

## get_campaign

Get details of a specific campaign in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `campaign_id` | string | yes | The campaign UUID |

### Example

```ruby
campaign = app.integrations.actively.get_campaign(org_id: "org_abc123", campaign_id: "camp_xyz789")
puts(campaign.title)
puts("Type: " + (campaign.type).to_s)
puts("Period: " + (campaign.start_date).to_s + " to " + (campaign.end_date).to_s)
```
---

## create_campaign

Create a new campaign for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `title` | string | yes | The campaign title |
| `type` | string | yes | Campaign type (e.g., `"email"`, `"social"`, `"ads"`) |
| `start_date` | string | yes | Start date in ISO 8601 format (e.g., `"2026-01-01"`) |
| `end_date` | string | yes | End date in ISO 8601 format (e.g., `"2026-03-31"`) |

### Example

```ruby
campaign = app.integrations.actively.create_campaign(org_id: "org_abc123", title: "Q1 Product Launch", type: "email", start_date: "2026-01-15", end_date: "2026-03-31")
puts("Created campaign: " + (campaign.id).to_s)
```
---

## list_contacts

List contacts for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max contacts to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.actively.list_contacts(org_id: "org_abc123", limit: 50, page: 1)
result.data.each do |contact|
  puts((contact.name).to_s + " - " + (contact.email).to_s)
end
```
---

## get_contact

Get details of a specific contact in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `contact_id` | string | yes | The contact UUID |

### Example

```ruby
contact = app.integrations.actively.get_contact(org_id: "org_abc123", contact_id: "cont_def456")
puts(contact.name)
puts("Email: " + (contact.email).to_s)
puts("Phone: " + ((contact.phone || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Actively accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts - only the credentials differ.
