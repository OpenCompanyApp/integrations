# Lob — Ruby API Reference

## list_letters

List letters with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip (default: 0) |

### Example

```ruby
result = app.integrations.lob.list_letters(limit: 25)
result.data.each do |letter|
  puts((letter.id).to_s + " — " + (letter.status).to_s)
end
```
---

## get_letter

Retrieve a letter by its Lob ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The letter ID (e.g., `"ltr_abcdef123456"`) |

### Example

```ruby
result = app.integrations.lob.get_letter(id: "ltr_abc123")
puts("Status: " + (result.status).to_s)
puts("Tracking: " + ((result.tracking_number || "N/A")).to_s)
puts("URL: " + (result.url).to_s)
```
---

## create_letter

Create and send a letter via Lob.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient — address ID (e.g., `"adr_..."`) or inline address object |
| `from` | string | no | Sender — address ID or inline address object |
| `description` | string | no | Internal description (not printed on the letter) |
| `file` | string | yes | HTML string or template ID for the letter content |
| `color` | boolean | no | Print in color (default: `true`) |
| `double_sided` | boolean | no | Print double-sided (default: `true`) |

### Example

```ruby
result = app.integrations.lob.create_letter(to: "adr_abc123", from: "adr_def456", description: "Welcome letter", file: "<html><body><p>Dear {{name}}, welcome!</p></body></html>", color: true, double_sided: true)
puts("Letter ID: " + (result.id).to_s)
puts("Expected delivery: " + (result.expected_delivery_date).to_s)
```
### Using a template

```ruby
result = app.integrations.lob.create_letter(to: "adr_abc123", from: "adr_def456", file: "tmpl_welcome_letter", description: "Template letter")
```
---

## list_postcards

List postcards with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip (default: 0) |

### Example

```ruby
result = app.integrations.lob.list_postcards(limit: 25)
result.data.each do |postcard|
  puts((postcard.id).to_s + " — " + (postcard.status).to_s)
end
```
---

## get_postcard

Retrieve a postcard by its Lob ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The postcard ID (e.g., `"psc_abcdef123456"`) |

### Example

```ruby
result = app.integrations.lob.get_postcard(id: "psc_abc123")
puts("Status: " + (result.status).to_s)
puts("Tracking: " + ((result.tracking_number || "N/A")).to_s)
```
---

## create_postcard

Create and send a postcard via Lob.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient — address ID or inline address object |
| `from` | string | no | Sender — address ID or inline address object |
| `description` | string | no | Internal description (not printed on the postcard) |
| `front` | string | yes | HTML string or template ID for the front of the postcard |
| `back` | string | yes | HTML string or template ID for the back of the postcard |

### Example

```ruby
result = app.integrations.lob.create_postcard(to: "adr_abc123", from: "adr_def456", description: "Marketing postcard", front: "<html><body><h1>Hello!</h1></body></html>", back: "<html><body><p>Return: 123 Main St</p></body></html>")
puts("Postcard ID: " + (result.id).to_s)
puts("Status: " + (result.status).to_s)
```
### Using a template

```ruby
result = app.integrations.lob.create_postcard(to: "adr_abc123", from: "adr_def456", front: "tmpl_postcard_front", back: "tmpl_postcard_back", description: "Template postcard")
```
---

## get_current_user

List saved addresses in the Lob account.

### Parameters

None.

### Example

```ruby
result = app.integrations.lob.get_addresses()
result.data.each do |addr|
  puts((addr.id).to_s + ": " + (addr.description).to_s + " — " + (addr.address_line1).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Lob accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.lob.create_letter()
# Explicit default (portable across setups)
app.integrations.lob.default.create_letter()
# Named accounts
app.integrations.lob.marketing.create_postcard()
app.integrations.lob.billing.create_letter()
```
All functions are identical across accounts — only the credentials differ.
