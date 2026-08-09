# Lob — JavaScript API Reference

## list_letters

List letters with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip (default: 0) |

### Example

```js
var result = app.integrations.lob.list_letters({ limit: 25 })

for (const letter of (result.data)) {
  console.log(letter.id + " — " + letter.status)
}
```
---

## get_letter

Retrieve a letter by its Lob ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The letter ID (e.g., `"ltr_abcdef123456"`) |

### Example

```js
var result = app.integrations.lob.get_letter({ id: "ltr_abc123" })

console.log("Status: " + result.status)
console.log("Tracking: " + (result.tracking_number || "N/A"))
console.log("URL: " + result.url)
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

```js
var result = app.integrations.lob.create_letter({
  to: "adr_abc123",
  from: "adr_def456",
  description: "Welcome letter",
  file: "<html><body><p>Dear {{name}}, welcome!</p></body></html>",
  color: true,
  double_sided: true,
})

console.log("Letter ID: " + result.id)
console.log("Expected delivery: " + result.expected_delivery_date)
```
### Using a template

```js
var result = app.integrations.lob.create_letter({
  to: "adr_abc123",
  from: "adr_def456",
  file: "tmpl_welcome_letter",
  description: "Template letter",
})
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

```js
var result = app.integrations.lob.list_postcards({ limit: 25 })

for (const postcard of (result.data)) {
  console.log(postcard.id + " — " + postcard.status)
}
```
---

## get_postcard

Retrieve a postcard by its Lob ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The postcard ID (e.g., `"psc_abcdef123456"`) |

### Example

```js
var result = app.integrations.lob.get_postcard({ id: "psc_abc123" })

console.log("Status: " + result.status)
console.log("Tracking: " + (result.tracking_number || "N/A"))
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

```js
var result = app.integrations.lob.create_postcard({
  to: "adr_abc123",
  from: "adr_def456",
  description: "Marketing postcard",
  front: "<html><body><h1>Hello!</h1></body></html>",
  back: "<html><body><p>Return: 123 Main St</p></body></html>",
})

console.log("Postcard ID: " + result.id)
console.log("Status: " + result.status)
```
### Using a template

```js
var result = app.integrations.lob.create_postcard({
  to: "adr_abc123",
  from: "adr_def456",
  front: "tmpl_postcard_front",
  back: "tmpl_postcard_back",
  description: "Template postcard",
})
```
---

## get_current_user

List saved addresses in the Lob account.

### Parameters

None.

### Example

```js
var result = app.integrations.lob.get_current_user({})

for (const addr of (result.data)) {
  console.log(addr.id + ": " + addr.description + " — " + addr.address_line1)
}
```
---

## Multi-Account Usage

If you have multiple Lob accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.lob.create_letter({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.lob.default.create_letter({ /* parameters */ })

// Named accounts
app.integrations.lob.marketing.create_postcard({ /* parameters */ })
app.integrations.lob.billing.create_letter({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
