# Google Contacts — Lua API Reference

## list_connections

List the authenticated user's contacts (connections) from Google Contacts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of connections per page (1–2000, default 200) |
| `pageToken` | string | no | Token from a previous response to get the next page |
| `sortOrder` | string | no | `"LAST_NAME_ASCENDING"` or `"LAST_NAME_DESCENDING"` |
| `syncToken` | string | no | Sync token to return only changed contacts since last sync |

### Response

Returns an object with:
- `connections` — array of contact objects
- `totalItems` — total number of contacts
- `nextPageToken` — token for the next page (if more results exist)
- `nextSyncToken` — token for incremental sync (use on next call)

Each contact includes: `resourceName`, `displayName`, `givenName`, `familyName`, `emailAddresses`, `phoneNumbers`, `organization`, `title`, `biography`, `photoUrl`.

### Example

```lua
local result = app.integrations.google_contacts.list_connections({
  pageSize = 50,
  sortOrder = "LAST_NAME_ASCENDING"
})

for _, contact in ipairs(result.connections) do
  print(contact.displayName)
  if contact.emailAddresses then
    for _, email in ipairs(contact.emailAddresses) do
      print("  " .. email.value)
    end
  end
end
```

### Paginated listing

```lua
local page_token = nil
repeat
  local result = app.integrations.google_contacts.list_connections({
    pageSize = 200,
    pageToken = page_token
  })

  for _, contact in ipairs(result.connections) do
    print(contact.displayName)
  end

  page_token = result.nextPageToken
until page_token == nil
```

---

## get_connection

Get detailed information about a specific contact by resource name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `resourceName` | string | yes | The resource name (e.g., `"people/c123456789"`) |
| `personFields` | string | no | Comma-separated fields to include (default: names,emailAddresses,phoneNumbers,biographies,organizations,photos) |

### Example

```lua
local contact = app.integrations.google_contacts.get_connection({
  resourceName = "people/c123456789"
})

print(contact.displayName)
print(contact.biography or "No notes")
```

---

## create_contact

Create a new contact in Google Contacts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `givenName` | string | no* | Given (first) name |
| `familyName` | string | no* | Family (last) name |
| `emailAddresses` | array | no | Array of email strings (e.g., `{"john@example.com"}`) |
| `phoneNumbers` | array | no | Array of phone strings (e.g., `{"+1234567890"}`) |
| `biography` | string | no | Notes or biography text |

*At least `givenName` or `familyName` is required.

### Example

```lua
local result = app.integrations.google_contacts.create_contact({
  givenName = "Jane",
  familyName = "Smith",
  emailAddresses = { "jane.smith@example.com" },
  phoneNumbers = { "+15551234567" },
  biography = "Met at the conference"
})

print("Created: " .. result.displayName .. " (" .. result.resourceName .. ")")
```

---

## list_contact_groups

List all contact groups owned by the user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of groups per page (1–2000, default 200) |
| `pageToken` | string | no | Token from a previous response |
| `syncToken` | string | no | Sync token for incremental updates |

### Example

```lua
local result = app.integrations.google_contacts.list_contact_groups({
  pageSize = 50
})

for _, group in ipairs(result.contactGroups) do
  print(group.name .. " (" .. group.memberCount .. " members)")
end
```

---

## get_contact_group

Get details of a specific contact group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `resourceName` | string | yes | The resource name (e.g., `"contactGroups/myContacts"` or `"contactGroups/123"`) |

### Example

```lua
local group = app.integrations.google_contacts.get_contact_group({
  resourceName = "contactGroups/myContacts"
})

print(group.name .. ": " .. group.memberCount .. " members")
for _, member in ipairs(group.memberResourceNames) do
  print("  " .. member)
end
```

---

## list_other_contacts

List contacts the user has interacted with but not added to a group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of contacts per page (1–1000, default 200) |
| `pageToken` | string | no | Token from a previous response |
| `syncToken` | string | no | Sync token for incremental updates |

### Example

```lua
local result = app.integrations.google_contacts.list_other_contacts({
  pageSize = 100
})

for _, contact in ipairs(result.otherContacts) do
  print(contact.displayName or "Unknown")
  if contact.emailAddresses then
    for _, email in ipairs(contact.emailAddresses) do
      print("  " .. email)
    end
  end
end
```

---

## get_current_user

Get the authenticated user's profile information. Takes no parameters.

### Example

```lua
local user = app.integrations.google_contacts.get_current_user({})

print("Signed in as: " .. user.displayName)
if user.emailAddresses then
  for _, email in ipairs(user.emailAddresses) do
    print("  " .. email.value .. (email.primary and " (primary)" or ""))
  end
end
```

---

## Multi-Account Usage

If you have multiple Google accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google_contacts.list_connections({...})

-- Explicit default (portable across setups)
app.integrations.google_contacts.default.list_connections({...})

-- Named accounts
app.integrations.google_contacts.work.list_connections({...})
app.integrations.google_contacts.personal.list_connections({...})
```

All functions are identical across accounts — only the credentials differ.
