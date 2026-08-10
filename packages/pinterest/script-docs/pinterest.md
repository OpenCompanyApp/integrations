# Pinterest — JavaScript API Reference

## list_pins

List pins for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of pins to return per page (max 250) |

### Example

```js
var result = app.integrations.pinterest.list_pins({
  pageSize: 25,
})

for (const pin of (result.items)) {
  console.log(pin.id + ": " + (pin.title || ""))
}
```
---

## get_pin

Get details of a specific pin by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pinId` | string | yes | The pin ID to retrieve |

### Example

```js
var result = app.integrations.pinterest.get_pin({
  pinId: "1234567890",
})
console.log(result.title)
console.log(result.description)
console.log(result.link)
```
---

## create_pin

Create a new pin on a Pinterest board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `boardId` | string | yes | The board ID to pin to |
| `title` | string | yes | The title of the pin |
| `description` | string | yes | The description of the pin |
| `mediaSource` | string | no | The media source type (default: `"image_url"`) |
| `imageUrl` | string | yes | The URL of the image to pin |
| `link` | string | no | Optional destination link URL for the pin |

### Example

```js
var result = app.integrations.pinterest.create_pin({
  boardId: "987654321",
  title: "My New Pin",
  description: "Check out this amazing content!",
  imageUrl: "https://example.com/image.jpg",
  link: "https://example.com/blog",
})
console.log("Created pin: " + result.id)
```
---

## list_boards

List boards for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of boards to return per page (max 250) |

### Example

```js
var result = app.integrations.pinterest.list_boards({
  pageSize: 25,
})

for (const board of (result.items)) {
  console.log(board.id + ": " + board.name + " (" + (board.pin_count || 0) + " pins)")
}
```
---

## get_board

Get details of a specific board by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `boardId` | string | yes | The board ID to retrieve |

### Example

```js
var result = app.integrations.pinterest.get_board({
  boardId: "1234567890",
})
console.log(result.name)
console.log(result.description)
console.log("Pin count: " + (result.pin_count || 0))
```
---

## list_campaigns

List ad campaigns for a Pinterest ad account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `adAccountId` | string | yes | The ad account ID to list campaigns for |
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of campaigns to return per page |

### Example

```js
var result = app.integrations.pinterest.list_campaigns({
  adAccountId: "549560687913",
  pageSize: 50,
})

for (const campaign of (result.items)) {
  console.log(campaign.id + ": " + campaign.name + " (" + campaign.status + ")")
}
```
---

## get_current_user

Get the currently authenticated Pinterest user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.pinterest.get_current_user()
console.log("Logged in as: " + (result.username || ""))
console.log("Account type: " + (result.account_type || ""))
```
---

## Multi-Account Usage

If you have multiple Pinterest accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.pinterest.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.pinterest.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.pinterest.brand_account.function_name({ /* parameters */ })
app.integrations.pinterest.agency.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
