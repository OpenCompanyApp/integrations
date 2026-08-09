# Buy Me a Coffee — JavaScript API Reference

## list_supporters

List all supporters in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.buymeacoffee.list_supporters()

for (const supporter of (result.supporters)) {
  console.log(supporter.supporter_name + " — $" + supporter.support_amount + " (" + supporter.support_id + ")")
}
```
---

## get_supporter

Get detailed information about a single Buy Me a Coffee supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `supporter_id` | string | yes | The ID of the supporter to retrieve |

### Example

```js
var result = app.integrations.buymeacoffee.get_supporter({
  supporter_id: "12345",
})

console.log(result.supporter_name)
console.log(result.support_amount)
console.log(result.support_note)
```
---

## list_subscriptions

List all active recurring subscriptions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.buymeacoffee.list_subscriptions()

for (const sub of (result.subscriptions)) {
  console.log(sub.supporter_name + " — $" + sub.support_amount + " — " + sub.status)
}
```
---

## list_extras

List all extras (additional purchase options) in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.buymeacoffee.list_extras()

for (const extra of (result.extras)) {
  console.log(extra.title + " — $" + extra.price + " — " + extra.purchases + " purchases")
}
```
---

## get_extra

Get detailed information about a single extra.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `extra_id` | string | yes | The ID of the extra to retrieve |

### Example

```js
var result = app.integrations.buymeacoffee.get_extra({
  extra_id: "67890",
})

console.log(result.title)
console.log(result.description)
console.log(result.price)
```
---

## list_shops

List all shop items in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations.buymeacoffee.list_shops()

for (const item of (result.shops)) {
  console.log(item.title + " — $" + item.price)
}
```
---

## get_current_user

Get the profile of the currently authenticated Buy Me a Coffee user.

### Parameters

None.

### Example

```js
var result = app.integrations.buymeacoffee.get_current_user()

console.log("Connected as: " + result.user_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Buy Me a Coffee accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.buymeacoffee.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.buymeacoffee.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.buymeacoffee.main_page.function_name({ /* parameters */ })
app.integrations.buymeacoffee.side_project.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
