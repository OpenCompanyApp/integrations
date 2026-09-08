# GetResponse — Ruby API Reference

## list_contacts

List contacts in your GetResponse account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Default: 1 |
| `perPage` | integer | no | Results per page (max 1000). Default: 50 |

### Example

```ruby
result = app.integrations.getresponse.list_contacts(page: 1, per_page: 25)
result.each do |contact|
  puts((contact.email).to_s + " - " + ((contact.name || "N/A")).to_s)
end
```
---

## get_contact

Get details of a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |

### Example

```ruby
result = app.integrations.getresponse.contact(id: "abc123")
puts(result.email)
puts(result.name)
```
---

## create_contact

Create a new contact in GetResponse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Contact email address |
| `name` | string | no | Contact full name |
| `campaign` | string | no | Campaign ID to assign the contact to |

### Example

```ruby
result = app.integrations.getresponse.create_contact(email: "john@example.com", name: "John Doe", campaign: "campaignIdHere")
puts("Created contact: " + (result.contactId).to_s)
```
---

## update_contact

Update an existing contact's details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |
| `name` | string | no | New name for the contact |

### Example

```ruby
result = app.integrations.getresponse.update_contact(id: "abc123", name: "Jane Doe")
puts("Contact updated")
```
---

## delete_contact

Delete a contact from GetResponse permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier to delete |

### Example

```ruby
result = app.integrations.getresponse.delete_contact(id: "abc123")
puts(result)
```
---

## list_campaigns

List all campaigns in your GetResponse account.

### Parameters

None.

### Example

```ruby
result = app.integrations.getresponse.list_campaigns()
result.each do |campaign|
  puts((campaign.campaignId).to_s + " - " + (campaign.name).to_s)
end
```
---

## get_campaign

Get details of a specific campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique campaign identifier |

### Example

```ruby
result = app.integrations.getresponse.campaign(id: "campaignIdHere")
puts(result.name)
```
---

## create_campaign

Create a new email campaign in GetResponse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new campaign |

### Example

```ruby
result = app.integrations.getresponse.create_campaign(name: "Q1 Newsletter")
puts("Created campaign: " + (result.campaignId).to_s)
```
---

## list_newsletters

List newsletters in your GetResponse account.

### Parameters

None.

### Example

```ruby
result = app.integrations.getresponse.list_newsletters()
result.each do |newsletter|
  puts((newsletter.subject).to_s + " (" + (newsletter.status).to_s + ")")
end
```
---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.getresponse.current_user()
puts("Account: " + (result.email).to_s)
puts("Name: " + ((result.firstName || "")).to_s + " " + ((result.lastName || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple GetResponse accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.getresponse.list_contacts()
# Explicit default (portable across setups)
app.integrations.getresponse.default.list_contacts()
# Named accounts
app.integrations.getresponse.marketing.list_contacts()
app.integrations.getresponse.sales.list_contacts()
```
All functions are identical across accounts — only the credentials differ.
