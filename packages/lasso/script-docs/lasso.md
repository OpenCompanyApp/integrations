# Lasso CRM — Ruby API Reference

## list_contacts

List contacts (registrants) in Lasso CRM. Supports filtering by project and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter contacts by project ID |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.lasso.list_contacts(project_id: "proj_abc123", limit: 10)
result.contacts.each do |contact|
  puts((contact.id).to_s + ": " + ((contact.first_name || "")).to_s + " " + ((contact.last_name || "")).to_s)
end
```
---

## get_contact

Get full details for a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID |

### Example

```ruby
contact = app.integrations.lasso.get_contact(id: "contact_abc123")
puts((contact.first_name).to_s + " " + (contact.last_name).to_s)
puts("Email: " + ((contact.email || "N/A")).to_s)
puts("Phone: " + ((contact.phone || "N/A")).to_s)
```
---

## create_contact

Create a new contact (registrant) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Contact first name |
| `last_name` | string | no | Contact last name |
| `email` | string | no | Primary email address |
| `phone` | string | no | Primary phone number |
| `project_id` | string | no | Project ID to associate with |
| `source` | string | no | Lead source (e.g., "Website", "Referral") |
| `notes` | string | no | Notes about the contact |

At least a `first_name` or `last_name` is required.

### Example

```ruby
contact = app.integrations.lasso.create_contact(first_name: "Jane", last_name: "Smith", email: "jane@example.com", phone: "+1234567890", project_id: "proj_abc123", source: "Website")
puts("Created contact: " + (contact.id).to_s)
```
---

## list_deals

List deals (sales) in Lasso CRM with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter deals by project ID |
| `status` | string | no | Filter by deal status |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.lasso.list_deals(project_id: "proj_abc123", status: "Active", limit: 10)
result.deals.each do |deal|
  puts((deal.id).to_s + ": " + ((deal.name || deal.id)).to_s)
end
```
---

## get_deal

Get full details for a single deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The deal ID |

### Example

```ruby
deal = app.integrations.lasso.get_deal(id: "deal_abc123")
puts("Deal: " + ((deal.name || deal.id)).to_s)
puts("Price: " + ((deal.price || "N/A")).to_s)
puts("Status: " + ((deal.status || "N/A")).to_s)
```
---

## list_inventory

List available inventory (units/lots) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter inventory by project ID |
| `status` | string | no | Filter by status (e.g., "Available", "Sold", "Reserved") |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.lasso.list_inventory(project_id: "proj_abc123", status: "Available", limit: 10)
result.inventory.each do |item|
  puts((item.id).to_s + ": " + (((item.name || item.unit_number) || item.id)).to_s)
end
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```ruby
user = app.integrations.lasso.get_current_user()
puts("Logged in as: " + ((user.first_name || "")).to_s + " " + ((user.last_name || "")).to_s)
puts("Email: " + ((user.email || "N/A")).to_s)
if user.organization
  puts("Organization: " + ((user.organization.name || "N/A")).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Lasso CRM accounts configured, use account-specific namespaces:

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
