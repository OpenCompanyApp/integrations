# Pinterest — Lua API Reference

## list_pins

List pins for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of pins to return per page (max 250) |

### Example

```lua
local result = app.integrations.pinterest.list_pins({
  pageSize = 25
})

for _, pin in ipairs(result.items) do
  print(pin.id .. ": " .. (pin.title or ""))
end
```

---

## get_pin

Get details of a specific pin by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pinId` | string | yes | The pin ID to retrieve |

### Example

```lua
local result = app.integrations.pinterest.get_pin({
  pinId = "1234567890"
})
print(result.title)
print(result.description)
print(result.link)
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

```lua
local result = app.integrations.pinterest.create_pin({
  boardId = "987654321",
  title = "My New Pin",
  description = "Check out this amazing content!",
  imageUrl = "https://example.com/image.jpg",
  link = "https://example.com/blog"
})
print("Created pin: " .. result.id)
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

```lua
local result = app.integrations.pinterest.list_boards({
  pageSize = 25
})

for _, board in ipairs(result.items) do
  print(board.id .. ": " .. board.name .. " (" .. (board.pin_count or 0) .. " pins)")
end
```

---

## get_board

Get details of a specific board by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `boardId` | string | yes | The board ID to retrieve |

### Example

```lua
local result = app.integrations.pinterest.get_board({
  boardId = "1234567890"
})
print(result.name)
print(result.description)
print("Pin count: " .. (result.pin_count or 0))
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

```lua
local result = app.integrations.pinterest.list_campaigns({
  adAccountId = "549560687913",
  pageSize = 50
})

for _, campaign in ipairs(result.items) do
  print(campaign.id .. ": " .. campaign.name .. " (" .. campaign.status .. ")")
end
```

---

## get_current_user

Get the currently authenticated Pinterest user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.pinterest.get_current_user()
print("Logged in as: " .. (result.username or ""))
print("Account type: " .. (result.account_type or ""))
```

---

## Multi-Account Usage

If you have multiple Pinterest accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pinterest.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pinterest.default.function_name({...})

-- Named accounts
app.integrations.pinterest.brand_account.function_name({...})
app.integrations.pinterest.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
