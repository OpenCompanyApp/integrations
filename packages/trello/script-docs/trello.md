# Trello — Ruby API Reference

## list_boards

List all boards for the authenticated Trello member. Supports filtering by status and field selection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Filter: `"all"`, `"closed"`, `"members"`, `"open"`, `"organization"`, `"public"` (default: `"all"`) |
| `fields` | string | no | Comma-separated board fields to return (default: `"all"`) |
| `limit` | integer | no | Max number of boards to return (1–1000) |

### Examples

```ruby
# List all open boards
result = app.integrations.trello.list_boards(filter: "open")
result.each do |board|
  puts((board.name).to_s + " (id: " + (board.id).to_s + ")")
end
# List boards with specific fields
result = app.integrations.trello.list_boards(filter: "open", fields: "name,url,dateLastActivity", limit: 50)
```
---

## get_board

Get detailed information about a Trello board by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The board ID |

### Examples

```ruby
result = app.integrations.trello.get_board(id: "5abbe4b7ddc1b351ef961414")
puts(result.name)
puts("URL: " + (result.url).to_s)
puts("Lists: " + (result.lists.length).to_s)
```
---

## list_lists

List all lists on a Trello board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The board ID to list lists from |

### Examples

```ruby
result = app.integrations.trello.list_lists(board_id: "5abbe4b7ddc1b351ef961414")
result.each do |list|
  puts((list.name).to_s + " (id: " + (list.id).to_s + ")")
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

```ruby
result = app.integrations.trello.get_list(id: "5abbe4b7ddc1b351ef961414")
puts(result.name)
puts("Board: " + (result.idBoard).to_s)
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

```ruby
# List cards in a list
result = app.integrations.trello.list_cards(list_id: "5abbe4b7ddc1b351ef961414")
result.each do |card|
  puts((card.name).to_s + " — " + ((card.desc || "")).to_s)
end
# Paginated listing
result = app.integrations.trello.list_cards(list_id: "5abbe4b7ddc1b351ef961414", limit: 10)
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

```ruby
# Create a simple card
card = app.integrations.trello.create_card(id_list: "5abbe4b7ddc1b351ef961414", name: "New task")
# Create a card with full details
card = app.integrations.trello.create_card(id_list: "5abbe4b7ddc1b351ef961414", name: "Bug fix", desc: "Fix the login page issue", id_labels: ["labelId1"], id_members: ["memberId1"], due: "2026-04-30T12:00:00Z", pos: "top")
puts("Created card: " + (card.name).to_s + " (id: " + (card.id).to_s + ")")
```
---

## get_current_user

Get the profile of the currently authenticated Trello user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.trello.get_current_user()
puts("Logged in as: " + (result.fullName).to_s + " (@" + (result.username).to_s + ")")
puts("ID: " + (result.id).to_s)
```
---

## Multi-Account Usage

If you have multiple Trello accounts configured, use account-specific namespaces:

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
