# Ko-fi — Ruby API Reference

## list_supporters

List all supporters who have donated or subscribed to your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```ruby
result = app.call("integrations.ko-fi.list_supporters")
result.supporters.each do |supporter|
  puts((supporter.name).to_s + " — " + (supporter.email).to_s)
end
```
#### Paginated results

```ruby
result = app.call("integrations.ko-fi.list_supporters", page: 2, limit: 10)
puts("Total supporters on page: " + (result.totalCount).to_s)
```
---

## get_supporter

Get detailed information about a single Ko-fi supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address of the supporter to retrieve |

### Example

```ruby
result = app.call("integrations.ko-fi.get_supporter", email: "fan@example.com")
puts(result.name)
puts(result.total_donated)
puts(result.status)
```
---

## list_transactions

List all transactions including donations, subscriptions, and shop orders.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter by type: `donation`, `subscription`, or `shop_order` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All recent transactions

```ruby
result = app.call("integrations.ko-fi.list_transactions")
result.transactions.each do |tx|
  puts((tx.type).to_s + " — $" + (tx.amount).to_s + " — " + (tx.supporter_name).to_s)
end
```
#### Filter by type

```ruby
result = app.call("integrations.ko-fi.list_transactions", type: "donation")
puts("Donation count: " + (result.totalCount).to_s)
```
---

## list_commissions

List all commission requests on your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `pending`, `accepted`, `completed`, or `declined` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All commissions

```ruby
result = app.call("integrations.ko-fi.list_commissions")
result.commissions.each do |commission|
  puts((commission.title).to_s + " — " + (commission.status).to_s + " — $" + (commission.price).to_s)
end
```
#### Pending commissions only

```ruby
result = app.call("integrations.ko-fi.list_commissions", status: "pending")
```
---

## get_commission

Get details for a single commission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `commission_id` | string | yes | The ID of the commission to retrieve |

### Example

```ruby
result = app.call("integrations.ko-fi.get_commission", commission_id: "COM123")
puts(result.title)
puts(result.description)
puts(result.status)
puts(result.requester_name)
```
---

## list_shop_items

List all items in your Ko-fi shop.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```ruby
result = app.call("integrations.ko-fi.list_shop_items")
result.items.each do |item|
  puts((item.name).to_s + " — $" + (item.price).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated Ko-fi user.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.ko-fi.get_current_user")
puts("Connected as: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Ko-fi accounts configured, use account-specific namespaces:

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
