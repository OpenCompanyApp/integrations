# Productboard — Ruby API Reference

## list_features

List features from Productboard with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of features per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
# List all features
result = app.integrations.productboard.list_features()
(result.data || []).each do |feature|
  puts((feature.name).to_s + " — " + ((feature.status || "no status")).to_s)
end
# Paginate through results
cursor = nil
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.productboard.list_features(page_size: 50, cursor: cursor)
  (result.data || []).each do |feature|
    puts((feature.id).to_s + ": " + (feature.name).to_s)
  end
  cursor = ((result.meta && result.meta.next_cursor) || nil)
  break unless (!(!cursor))
end
```
---

## get_feature

Get detailed information about a specific feature.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The feature ID |

### Examples

```ruby
result = app.integrations.productboard.get_feature(id: "feature_abc123")
feature = result.data
puts("Name: " + (feature.name).to_s)
puts("Status: " + ((feature.status || "none")).to_s)
puts("Description: " + ((feature.description || "no description")).to_s)
```
---

## create_feature

Create a new feature in Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The feature name |
| `description` | string | no | Detailed description of the feature |
| `product_id` | string | no | ID of the product to assign this feature to |
| `status` | string | no | Feature status (e.g., "in_discovery", "in_design", "in_development", "shipped") |
| `owner_ids` | array | no | Array of user IDs to assign as feature owners |

### Examples

```ruby
# Create a simple feature
result = app.integrations.productboard.create_feature(name: "Dark Mode Support", description: "Add a dark mode theme option for the application")
puts("Created feature: " + (result.data.id).to_s)
# Create a feature with product and status
result = app.integrations.productboard.create_feature(name: "API Rate Limiting", description: "Implement rate limiting on public API endpoints", product_id: "product_xyz789", status: "in_discovery")
```
---

## list_notes

List notes (customer feedback) from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of notes per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
# List recent notes
result = app.integrations.productboard.list_notes(page_size: 20)
(result.data || []).each do |note|
  puts((note.title).to_s + " by " + (((note.owner && note.owner.name) || "unknown")).to_s)
end
```
---

## create_note

Create a new note (customer feedback) in Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The note title |
| `content` | string | no | The note content (plain text or HTML) |
| `owner_id` | string | no | User ID of the note owner |
| `feature_ids` | array | no | Array of feature IDs to link this note to |
| `company_ids` | array | no | Array of company IDs associated with this note |

### Examples

```ruby
# Create a feedback note
result = app.integrations.productboard.create_note(title: "Customer Request: Bulk Export", content: "Enterprise customer needs bulk export functionality for monthly reporting", feature_ids: ["feature_abc123"], company_ids: ["company_def456"])
puts("Created note: " + (result.data.id).to_s)
```
---

## list_products

List products from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of products per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
result = app.integrations.productboard.list()
(result.data || []).each do |product|
  puts((product.id).to_s + ": " + (product.name).to_s)
end
```
---

## list_companies

List companies from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of companies per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
result = app.integrations.productboard.list_companies()
(result.data || []).each do |company|
  puts((company.id).to_s + ": " + (company.name).to_s + " (" + ((company.domain || "no domain")).to_s + ")")
end
```
---

## get_current_user

Get the currently authenticated Productboard user profile.

### Parameters

None.

### Examples

```ruby
result = app.integrations.productboard.get_current_user()
puts("Authenticated as: " + (result.data.firstName).to_s + " " + (result.data.lastName).to_s)
puts("Email: " + (result.data.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Productboard workspaces configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.productboard.list_features()
# Explicit default (portable across setups)
app.integrations.productboard.default.list_features()
# Named accounts
app.integrations.productboard.workspace_a.list_features()
app.integrations.productboard.workspace_b.list_features()
```
All functions are identical across accounts — only the credentials differ.
