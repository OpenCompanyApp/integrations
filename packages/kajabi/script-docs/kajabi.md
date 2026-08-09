# Kajabi — JavaScript API Reference

## list_offers

List all offers in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

```js
var result = app.integrations.kajabi.list_offers()

for (const offer of (result.offers)) {
  console.log(offer.title + " — " + offer.id)
}
```
---

## get_offer

Get detailed information about a single Kajabi offer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offer_id` | string | yes | The ID of the offer to retrieve |

### Example

```js
var result = app.integrations.kajabi.get_offer({
  offer_id: "abc123",
})

console.log(result.title)
console.log(result.price)
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

```js
var result = app.integrations.kajabi.list_products()

for (const product of (result.products)) {
  console.log(product.title + " — " + product.type + " (" + product.id + ")")
}
```
#### Paginated results

```js
var result = app.integrations.kajabi.list_products({
  page: 2,
  per_page: 10,
})
```
---

## get_product

Get detailed information about a single Kajabi product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```js
var result = app.integrations.kajabi.get_product({
  product_id: "abc123",
})

console.log(result.title)
console.log(result.description)
console.log(result.type)
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

```js
var result = app.integrations.kajabi.list_members()

for (const member of (result.members)) {
  console.log(member.name + " — " + member.email + " — " + member.status)
}
```
#### Paginated results

```js
var result = app.integrations.kajabi.list_members({
  page: 2,
  per_page: 50,
})

console.log("Total members on page: " + result.totalCount)
```
---

## get_member

Get details for a single member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member |

### Example

```js
var result = app.integrations.kajabi.get_member({
  member_id: "abc123",
})

console.log(result.name)
console.log(result.email)
console.log(result.status)
```
---

## get_current_user

Get the profile of the currently authenticated Kajabi user.

### Parameters

None.

### Example

```js
var result = app.integrations.kajabi.get_current_user()

console.log("Connected as: " + result.name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Kajabi accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.kajabi.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.kajabi.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.kajabi.main_site.function_name({ /* parameters */ })
app.integrations.kajabi.coaching.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
