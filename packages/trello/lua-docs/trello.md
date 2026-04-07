# Trello — Lua API Reference

## list_boards

List all boards for the authenticated Trello member. Supports filtering by status and field selection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Filter: `"all"`, `"closed"`, `"members"`, `"open"`, `"organization"`, `"public"` (default: `"all"`) |
| `fields` | string | no | Comma-separated board fields to return (default: `"all"`) |
| `limit` | integer | no | Max number of boards to return (1–1000) |

### Examples

```lua
-- List all open boards
local result = app.integrations.trello.list_boards({
  filter = "open"
})

for _, board in ipairs(result) do
  print(board.name .. " (id: " .. board.id .. ")")
end

-- List boards with specific fields
local result = app.integrations.trello.list_boards({
  filter = "open",
  fields = "name,url,dateLastActivity",
  limit = 50
})
```

---

## get_board

Get detailed information about a Trello board by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The board ID |

### Examples

```lua
local result = app.integrations.trello.get_board({
  id = "5abbe4b7ddc1b351ef961414"
})
print(result.name)
print("URL: " .. result.url)
print("Lists: " .. #result.lists)
```

---

## list_lists

List all lists on a Trello board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The board ID to list lists from |

### Examples

```lua
local result = app.integrations.trello.list_lists({
  board_id = "5abbe4b7ddc1b351ef961414"
})

for _, list in ipairs(result) do
  print(list.name .. " (id: " .. list.id .. ")")
end
```

---

## get_list

Get detailed information about a Trello list by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The list ID |

### Examples

```lua
local result = app.integrations.trello.get_list({
  id = "5abbe4b7ddc1b351ef961414"
})
print(result.name)
print("Board: " .. result.idBoard)
```

---

## list_cards

List all cards in a Trello list. Supports limit and before cursor for pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The list ID |
| `limit` | integer | no | Max number of cards to return (1–1000) |
| `before` | string | no | Card ID to fetch cards before (for pagination) |

### Examples

```lua
-- List cards in a list
local result = app.integrations.trello.list_cards({
  list_id = "5abbe4b7ddc1b351ef961414"
})

for _, card in ipairs(result) do
  print(card.name .. " — " .. (card.desc or ""))
end

-- Paginated listing
local result = app.integrations.trello.list_cards({
  list_id = "5abbe4b7ddc1b351ef961414",
  limit = 10
})
```

---

## create_card

Create a new card on a Trello list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the card |
| `id_list` | string | yes | ID of the list to add the card to |
| `desc` | string | no | Description (supports Markdown) |
| `id_labels` | array | no | Array of label IDs to add |
| `id_members` | array | no | Array of member IDs to assign |
| `due` | string | no | Due date in ISO 8601 format |
| `pos` | string | no | Position: `"top"`, `"bottom"`, or a positive number |

### Examples

```lua
-- Create a simple card
local card = app.integrations.trello.create_card({
  id_list = "5abbe4b7ddc1b351ef961414",
  name = "New task"
})

-- Create a card with full details
local card = app.integrations.trello.create_card({
  id_list = "5abbe4b7ddc1b351ef961414",
  name = "Bug fix",
  desc = "Fix the login page issue",
  id_labels = { "labelId1" },
  id_members = { "memberId1" },
  due = "2026-04-30T12:00:00Z",
  pos = "top"
})

print("Created card: " .. card.name .. " (id: " .. card.id .. ")")
```

---

## get_current_user

Get the profile of the currently authenticated Trello user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.trello.get_current_user({})
print("Logged in as: " .. result.fullName .. " (@" .. result.username .. ")")
print("ID: " .. result.id)
```

---

## Multi-Account Usage

If you have multiple Trello accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.trello.function_name({...})

-- Explicit default (portable across setups)
app.integrations.trello.default.function_name({...})

-- Named accounts
app.integrations.trello.work.function_name({...})
app.integrations.trello.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
