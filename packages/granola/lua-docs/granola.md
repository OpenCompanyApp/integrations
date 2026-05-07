# Granola - Lua API Reference

Namespace: `app.integrations.granola`

Granola's Enterprise API is currently read-only. It exposes meeting notes,
individual note details, and folders. There are no official API endpoints here
for creating notes, sharing meetings, or reading a current-user profile.

## list_notes

List accessible meeting notes with cursor pagination and date filters.

```lua
local result = app.integrations.granola.list_notes({
  page_size = 10,
  created_after = "2026-01-01"
})

for _, note in ipairs(result.notes or {}) do
  print(note.id .. " - " .. note.title)
end
```

Supported parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `created_before` | string | no | Return notes created before this date |
| `created_after` | string | no | Return notes created after this date |
| `updated_after` | string | no | Return notes updated after this date |
| `cursor` | string | no | Cursor from a previous response |
| `page_size` | integer | no | Number of notes to return, from 1 to 30 |

Responses include `notes`, `hasMore`, and `cursor`.

## get_note

Get one meeting note by ID. The response can include transcript, summary,
attendees, owner, and calendar event data when available.

```lua
local note = app.integrations.granola.get_note({
  note_id = "not_1d3tmYTlCICgjy"
})

print(note.title)
print(note.summary or "")
```

## list_folders

List accessible folders with cursor pagination. Folder responses include
hierarchy metadata through `parent_folder_id`.

```lua
local result = app.integrations.granola.list_folders({
  page_size = 30
})

for _, folder in ipairs(result.folders or {}) do
  print(folder.id .. " - " .. folder.name)
end
```

Supported parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Cursor from a previous response |
| `page_size` | integer | no | Number of folders to return, from 1 to 30 |

## Multi-Account Usage

```lua
app.integrations.granola.list_notes({ page_size = 10 })
app.integrations.granola.default.list_notes({ page_size = 10 })
app.integrations.granola.team.list_notes({ page_size = 10 })
```

All account namespaces expose the same read-only tools; only credentials and API
base URL differ.
