# Buy Me a Coffee — Ruby API Reference

## list_supporters

List all supporters in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.buymeacoffee.list_supporters()
result.supporters.each do |supporter|
  puts((supporter.supporter_name).to_s + " — $" + (supporter.support_amount).to_s + " (" + (supporter.support_id).to_s + ")")
end
```
---

## get_supporter

Get detailed information about a single Buy Me a Coffee supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `supporter_id` | string | yes | The ID of the supporter to retrieve |

### Example

```ruby
result = app.integrations.buymeacoffee.get_supporter(supporter_id: "12345")
puts(result.supporter_name)
puts(result.support_amount)
puts(result.support_note)
```
---

## list_subscriptions

List all active recurring subscriptions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.buymeacoffee.list_subscriptions()
result.subscriptions.each do |sub|
  puts((sub.supporter_name).to_s + " — $" + (sub.support_amount).to_s + " — " + (sub.status).to_s)
end
```
---

## list_extras

List all extras (additional purchase options) in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.buymeacoffee.list_extras()
result.extras.each do |extra|
  puts((extra.title).to_s + " — $" + (extra.price).to_s + " — " + (extra.purchases).to_s + " purchases")
end
```
---

## get_extra

Get detailed information about a single extra.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `extra_id` | string | yes | The ID of the extra to retrieve |

### Example

```ruby
result = app.integrations.buymeacoffee.get_extra(extra_id: "67890")
puts(result.title)
puts(result.description)
puts(result.price)
```
---

## list_shops

List all shop items in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.buymeacoffee.list_shops()
result.shops.each do |item|
  puts((item.title).to_s + " — $" + (item.price).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated Buy Me a Coffee user.

### Parameters

None.

### Example

```ruby
result = app.integrations.buymeacoffee.get_current_user()
puts("Connected as: " + (result.user_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Buy Me a Coffee accounts configured, use account-specific namespaces:

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
