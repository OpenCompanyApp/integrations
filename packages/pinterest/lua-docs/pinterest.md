# Pinterest — Lua API Reference

## list_boards

List all boards for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of boards to return (default: 25, max: 250) |
| `bookmark` | string | no | Cursor for pagination — pass the bookmark from a previous response |

### Examples

```lua
local result = app.integrations.pinterest.list_boards({
  limit = 25
})

for _, board in ipairs(result.items) do
  print(board.name .. " (ID: " .. board.id .. ")")
end
```

### Paginating through all boards

```lua
local all_boards = {}
local bookmark = nil

repeat
  local result = app.integrations.pinterest.list_boards({
    limit = 100,
    bookmark = bookmark
  })
  for _, board in ipairs(result.items or {}) do
    table.insert(all_boards, board)
  end
  bookmark = result.bookmark
until not bookmark
```

---

## get_board

Get details for a specific Pinterest board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The unique identifier of the board |

### Example

```lua
local board = app.integrations.pinterest.get_board({
  board_id = "1234567890"
})

print(board.name)
print("Pins: " .. tostring(board.pin_count))
print("Privacy: " .. board.privacy)
```

---

## create_board

Create a new board on Pinterest.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Board name (max 180 characters) |
| `description` | string | no | Board description (max 1500 characters) |

### Example

```lua
local board = app.integrations.pinterest.create_board({
  name = "Travel Inspiration",
  description = "Places I want to visit someday"
})

print("Created board: " .. board.name .. " (ID: " .. board.id .. ")")
```

---

## list_pins

List pins on a specific Pinterest board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The unique identifier of the board |
| `limit` | integer | no | Maximum number of pins to return (default: 25, max: 250) |
| `bookmark` | string | no | Cursor for pagination |

### Example

```lua
local result = app.integrations.pinterest.list_pins({
  board_id = "1234567890",
  limit = 25
})

for _, pin in ipairs(result.items or {}) do
  print(pin.title or "(untitled)")
  if pin.link then
    print("  Link: " .. pin.link)
  end
end
```

---

## create_pin

Create a new pin on a Pinterest board using an image URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The board to pin to |
| `title` | string | yes | Pin title |
| `image_url` | string | yes | URL of the image to pin |
| `description` | string | no | Pin description |
| `link` | string | no | Destination link for the pin |

### Example

```lua
local pin = app.integrations.pinterest.create_pin({
  board_id = "1234567890",
  title = "Beautiful Sunset",
  image_url = "https://example.com/photos/sunset.jpg",
  description = "A gorgeous sunset over the ocean",
  link = "https://example.com/blog/sunset-photos"
})

print("Created pin: " .. pin.title .. " (ID: " .. pin.id .. ")")
```

---

## delete_pin

Delete a pin from Pinterest. This action is permanent and cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pin_id` | string | yes | The unique identifier of the pin to delete |

### Example

```lua
app.integrations.pinterest.delete_pin({
  pin_id = "9876543210"
})
```

---

## get_current_user

Get the authenticated Pinterest user's account information.

### Parameters

None.

### Example

```lua
local user = app.integrations.pinterest.get_current_user({})

print("Username: @" .. user.username)
print("Account type: " .. (user.account_type or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Pinterest accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pinterest.list_boards({...})

-- Explicit default (portable across setups)
app.integrations.pinterest.default.list_boards({...})

-- Named accounts
app.integrations.pinterest.business.list_boards({...})
app.integrations.pinterest.personal.list_boards({...})
```

All functions are identical across accounts — only the credentials differ.
