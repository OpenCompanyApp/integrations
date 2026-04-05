# Trello — Lua API Reference

## Overview

Interact with Trello boards, lists, cards, labels, members, comments, and checklists from Lua scripts. All 25 tools are available under `app.integrations.trello`.

## Authentication

Requires an **API Key** and **API Token** obtained from [trello.com/app-key](https://trello.com/app-key). Both are configured in the integration settings and sent with every request.

## Cards

### `app.integrations.trello.create_card({ id_list, name, desc, id_labels, id_members, due, pos })`

Create a new card on a Trello list.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_list` | string | yes | ID of the list to add the card to |
| `name` | string | yes | Name for the card |
| `desc` | string | no | Description (supports Markdown) |
| `id_labels` | array | no | Array of label IDs to add |
| `id_members` | array | no | Array of member IDs to assign |
| `due` | string | no | Due date in ISO 8601 format |
| `pos` | string | no | Position: `"top"`, `"bottom"`, or a positive number |

```lua
local card = app.integrations.trello.create_card({
  id_list = "5abbe4b7ddc1b351ef961414",
  name = "New task",
  desc = "Description of the task",
  id_labels = { "labelId1", "labelId2" },
  due = "2026-04-30T12:00:00Z"
})
```

### `app.integrations.trello.get_card({ id })`

Get detailed information about a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID |

```lua
local card = app.integrations.trello.get_card({
  id = "5abbe4b7ddc1b351ef961414"
})
print(card.name .. ": " .. card.desc)
```

### `app.integrations.trello.update_card({ id, name, desc, id_labels, id_members, due, pos })`

Update an existing Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID to update |
| `name` | string | no | New name for the card |
| `desc` | string | no | New description |
| `id_labels` | array | no | Replace labels with this array of label IDs |
| `id_members` | array | no | Replace members with this array of member IDs |
| `due` | string | no | Due date in ISO 8601 format (or `null` to remove) |
| `pos` | string | no | Position: `"top"`, `"bottom"`, or a positive number |

```lua
local card = app.integrations.trello.update_card({
  id = "5abbe4b7ddc1b351ef961414",
  name = "Updated task name",
  desc = "Updated description",
  due = "2026-05-15T17:00:00Z"
})
```

### `app.integrations.trello.delete_card({ id })`

Delete a Trello card permanently.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID to delete |

```lua
local result = app.integrations.trello.delete_card({
  id = "5abbe4b7ddc1b351ef961414"
})
```

### `app.integrations.trello.move_card({ id, id_list })`

Move a card to a different list.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID to move |
| `id_list` | string | yes | The destination list ID |

```lua
local card = app.integrations.trello.move_card({
  id = "5abbe4b7ddc1b351ef961414",
  id_list = "destinationListId"
})
```

### `app.integrations.trello.archive_card({ id })`

Archive a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID to archive |

```lua
local card = app.integrations.trello.archive_card({
  id = "5abbe4b7ddc1b351ef961414"
})
```

### `app.integrations.trello.get_cards_in_list({ id_list })`

List all cards in a Trello list.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_list` | string | yes | The list ID |

```lua
local cards = app.integrations.trello.get_cards_in_list({
  id_list = "5abbe4b7ddc1b351ef961414"
})

for _, card in ipairs(cards) do
  print(card.name)
end
```

### `app.integrations.trello.search_cards({ query, id_boards, limit })`

Search for cards across Trello boards.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `query` | string | yes | Search query string |
| `id_boards` | string | no | Comma-separated board IDs to search in (default: all) |
| `limit` | integer | no | Max results to return (1–100, default 10) |

```lua
local cards = app.integrations.trello.search_cards({
  query = "bug report",
  limit = 20
})

for _, card in ipairs(cards) do
  print(card.name)
end
```

## Boards

### `app.integrations.trello.create_board({ name, desc, default_labels, default_lists })`

Create a new Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | yes | Name for the new board |
| `desc` | string | no | Board description |
| `default_labels` | boolean | no | Whether to add default labels (default: true) |
| `default_lists` | boolean | no | Whether to add default lists (default: true) |

```lua
local board = app.integrations.trello.create_board({
  name = "Project Board",
  desc = "Board for tracking project tasks",
  default_lists = true
})
```

### `app.integrations.trello.get_board({ id })`

Get detailed information about a Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The board ID |

```lua
local board = app.integrations.trello.get_board({
  id = "5abbe4b7ddc1b351ef961414"
})
print(board.name)
```

### `app.integrations.trello.list_boards({ filter })`

List all boards for the authenticated member.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `filter` | string | no | Filter: `"all"`, `"closed"`, `"members"`, `"open"`, `"organization"`, `"public"` (default: `"all"`) |

```lua
local boards = app.integrations.trello.list_boards({
  filter = "open"
})

for _, board in ipairs(boards) do
  print(board.name)
end
```

### `app.integrations.trello.get_board_lists({ id })`

Get all lists on a Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The board ID |

```lua
local lists = app.integrations.trello.get_board_lists({
  id = "5abbe4b7ddc1b351ef961414"
})

for _, list in ipairs(lists) do
  print(list.name)
end
```

### `app.integrations.trello.get_board_members({ id })`

Get all members of a Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The board ID |

```lua
local members = app.integrations.trello.get_board_members({
  id = "5abbe4b7ddc1b351ef961414"
})

for _, member in ipairs(members) do
  print(member.fullName .. " (" .. member.username .. ")")
end
```

## Lists

### `app.integrations.trello.create_list({ id_board, name, pos })`

Create a new list on a Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_board` | string | yes | ID of the board to add the list to |
| `name` | string | yes | Name for the new list |
| `pos` | string | no | Position: `"top"`, `"bottom"`, or a positive number |

```lua
local list = app.integrations.trello.create_list({
  id_board = "5abbe4b7ddc1b351ef961414",
  name = "In Progress",
  pos = "bottom"
})
```

### `app.integrations.trello.get_list({ id })`

Get detailed information about a Trello list.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The list ID |

```lua
local list = app.integrations.trello.get_list({
  id = "5abbe4b7ddc1b351ef961414"
})
print(list.name)
```

### `app.integrations.trello.update_list({ id, name, closed })`

Update a Trello list.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The list ID to update |
| `name` | string | no | New name for the list |
| `closed` | boolean | no | Set to `true` to archive the list |

```lua
local list = app.integrations.trello.update_list({
  id = "5abbe4b7ddc1b351ef961414",
  name = "Renamed List"
})
```

## Labels

### `app.integrations.trello.create_label({ id_board, name, color })`

Create a new label on a Trello board.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_board` | string | yes | ID of the board to create the label on |
| `name` | string | yes | Name for the label |
| `color` | string | no | Label color (e.g. `"green"`, `"yellow"`, `"red"`, `"blue"`) |

```lua
local label = app.integrations.trello.create_label({
  id_board = "5abbe4b7ddc1b351ef961414",
  name = "Priority",
  color = "red"
})
```

### `app.integrations.trello.add_label_to_card({ id, id_label })`

Add a label to a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID |
| `id_label` | string | yes | The label ID to add |

```lua
local result = app.integrations.trello.add_label_to_card({
  id = "cardId123",
  id_label = "labelId456"
})
```

### `app.integrations.trello.remove_label_from_card({ id, id_label })`

Remove a label from a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID |
| `id_label` | string | yes | The label ID to remove |

```lua
local result = app.integrations.trello.remove_label_from_card({
  id = "cardId123",
  id_label = "labelId456"
})
```

## Members

### `app.integrations.trello.get_member({ id })`

Get a Trello member by ID.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | Member ID or username |

```lua
local member = app.integrations.trello.get_member({
  id = "johnDoe"
})
print(member.fullName .. " — " .. member.email)
```

### `app.integrations.trello.get_current_member({})`

Get the currently authenticated Trello member.

```lua
local member = app.integrations.trello.get_current_member({})
print("Logged in as: " .. member.fullName)
```

### `app.integrations.trello.add_member_to_card({ id, id_member })`

Add a member to a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID |
| `id_member` | string | yes | The member ID to add |

```lua
local result = app.integrations.trello.add_member_to_card({
  id = "cardId123",
  id_member = "memberId456"
})
```

## Comments & Checklists

### `app.integrations.trello.add_comment({ id, text })`

Add a comment to a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The card ID |
| `text` | string | yes | Comment text (supports Markdown) |

```lua
local comment = app.integrations.trello.add_comment({
  id = "5abbe4b7ddc1b351ef961414",
  text = "Updated status: **in progress**"
})
```

### `app.integrations.trello.create_checklist({ id_card, name })`

Create a new checklist on a Trello card.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_card` | string | yes | The card ID to add the checklist to |
| `name` | string | yes | Name for the checklist |

```lua
local checklist = app.integrations.trello.create_checklist({
  id_card = "cardId123",
  name = "Deployment Checklist"
})
```

### `app.integrations.trello.create_checklist_item({ id_checklist, name, checked })`

Add an item to a Trello checklist.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id_checklist` | string | yes | The checklist ID |
| `name` | string | yes | Text for the checklist item |
| `checked` | boolean | no | Whether the item starts checked (default: false) |

```lua
local item = app.integrations.trello.create_checklist_item({
  id_checklist = "checklistId123",
  name = "Run database migrations",
  checked = false
})
```

## Pagination

Some list endpoints support pagination via `limit` and cursor-style parameters. Check each tool's parameter table for available options. When results are truncated, use the returned pagination tokens or adjust the `limit` parameter to retrieve additional records.

## Notes

- All IDs are Trello short or long IDs (24-character hex strings) unless noted otherwise.
- Date values use ISO 8601 format (e.g. `"2026-04-30T12:00:00Z"`).
- Text fields (`desc`, `text`) support Markdown.
- Archiving a card or list is reversible; deleting a card is permanent.
- Rate limits apply — avoid rapid successive calls in tight loops.
