# Kajabi — Ruby API Reference

## list_offers

List all offers in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

```ruby
result = app.integrations.kajabi.list_offers()
result.offers.each do |offer|
  puts((offer.title).to_s + " — " + (offer.id).to_s)
end
```
---

## get_offer

Get detailed information about a single Kajabi offer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offer_id` | string | yes | The ID of the offer to retrieve |

### Example

```ruby
result = app.integrations.kajabi.get_offer(offer_id: "abc123")
puts(result.title)
puts(result.price)
```
---

## list_products

List all products (courses, coaching programs, memberships) in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

#### All products

```ruby
result = app.integrations.kajabi.list_products()
result.products.each do |product|
  puts((product.title).to_s + " — " + (product.type).to_s + " (" + (product.id).to_s + ")")
end
```
#### Paginated results

```ruby
result = app.integrations.kajabi.list_products(page: 2, per_page: 10)
```
---

## get_product

Get detailed information about a single Kajabi product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```ruby
result = app.integrations.kajabi.get_product(product_id: "abc123")
puts(result.title)
puts(result.description)
puts(result.type)
```
---

## list_members

List all members in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

#### All members

```ruby
result = app.integrations.kajabi.list_members()
result.members.each do |member|
  puts((member.name).to_s + " — " + (member.email).to_s + " — " + (member.status).to_s)
end
```
#### Paginated results

```ruby
result = app.integrations.kajabi.list_members(page: 2, per_page: 50)
puts("Total members on page: " + (result.totalCount).to_s)
```
---

## get_member

Get details for a single member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member |

### Example

```ruby
result = app.integrations.kajabi.get_member(member_id: "abc123")
puts(result.name)
puts(result.email)
puts(result.status)
```
---

## get_current_user

Get the profile of the currently authenticated Kajabi user.

### Parameters

None.

### Example

```ruby
result = app.integrations.kajabi.get_current_user()
puts("Connected as: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Kajabi accounts configured, use account-specific namespaces:

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
