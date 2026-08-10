# Trello — JavaScript API Reference

## list_boards

List all boards for the authenticated Trello member. Supports filtering by status and field selection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Filter: `"all"`, `"closed"`, `"members"`, `"open"`, `"organization"`, `"public"` (default: `"all"`) |
| `fields` | string | no | Comma-separated board fields to return (default: `"all"`) |
| `limit` | integer | no | Max number of boards to return (1–1000) |

### Examples

```js
// List all open boards
var result = app.integrations.trello.list_boards({
  filter: "open",
})

for (const board of (result)) {
  console.log(board.name + " (id: " + board.id + ")")
}

// List boards with specific fields
var result = app.integrations.trello.list_boards({
  filter: "open",
  fields: "name,url,dateLastActivity",
  limit: 50,
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

```js
var result = app.integrations.trello.get_board({
  id: "5abbe4b7ddc1b351ef961414",
})
console.log(result.name)
console.log("URL: " + result.url)
console.log("Lists: " + result.lists.length)
```
---

## list_lists

List all lists on a Trello board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | string | yes | The board ID to list lists from |

### Examples

```js
var result = app.integrations.trello.list_lists({
  board_id: "5abbe4b7ddc1b351ef961414",
})

for (const list of (result)) {
  console.log(list.name + " (id: " + list.id + ")")
}
```
---

## get_list

Get detailed information about a Trello list by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The list ID |

### Examples

```js
var result = app.integrations.trello.get_list({
  id: "5abbe4b7ddc1b351ef961414",
})
console.log(result.name)
console.log("Board: " + result.idBoard)
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

```js
// List cards in a list
var result = app.integrations.trello.list_cards({
  list_id: "5abbe4b7ddc1b351ef961414",
})

for (const card of (result)) {
  console.log(card.name + " — " + (card.desc || ""))
}

// Paginated listing
var result = app.integrations.trello.list_cards({
  list_id: "5abbe4b7ddc1b351ef961414",
  limit: 10,
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

```js
// Create a simple card
var card = app.integrations.trello.create_card({
  id_list: "5abbe4b7ddc1b351ef961414",
  name: "New task",
})

// Create a card with full details
var card = app.integrations.trello.create_card({
  id_list: "5abbe4b7ddc1b351ef961414",
  name: "Bug fix",
  desc: "Fix the login page issue",
  id_labels: [ "labelId1" ],
  id_members: [ "memberId1" ],
  due: "2026-04-30T12:00:00Z",
  pos: "top",
})

console.log("Created card: " + card.name + " (id: " + card.id + ")")
```
---

## get_current_user

Get the profile of the currently authenticated Trello user.

### Parameters

None.

### Examples

```js
var result = app.integrations.trello.get_current_user({})
console.log("Logged in as: " + result.fullName + " (@" + result.username + ")")
console.log("ID: " + result.id)
```
---

## Multi-Account Usage

If you have multiple Trello accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.trello.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.trello.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.trello.work.function_name({ /* parameters */ })
app.integrations.trello.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
