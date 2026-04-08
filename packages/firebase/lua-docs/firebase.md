# Firebase — Lua API Reference

## list_projects

List all Firebase projects the caller has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Maximum number of projects to return (default: 100, max: 256) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```lua
local result = app.integrations.firebase.list_projects({
  page_size = 50
})

for _, project in ipairs(result.results or {}) do
  print(project.projectId .. ": " .. project.displayName)
end
```

---

## get_project

Get details of a specific Firebase project by its resource name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The project resource name (e.g. `"projects/my-project-id"`) |

### Example

```lua
local result = app.integrations.firebase.get_project({
  name = "projects/my-project-id"
})

print("Project: " .. result.displayName)
print("ID: " .. result.projectId)
```

---

## list_databases

List Cloud Firestore databases in a Firebase project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | no | The parent project name (e.g. `"projects/my-project-id"`). Uses the configured project ID if omitted. |

### Example

```lua
local result = app.integrations.firebase.list_databases({
  parent = "projects/my-project-id"
})

for _, db in ipairs(result.databases or {}) do
  print(db.name .. " (" .. db.locationId .. ")")
end
```

---

## list_documents

List documents in a Firestore collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `collection_id` | string | yes | The collection ID to list documents from |
| `page_size` | integer | no | Maximum number of documents to return |
| `page_token` | string | no | Token for pagination from a previous list call |
| `order_by` | string | no | Field to order results by |

### Example

```lua
local result = app.integrations.firebase.list_documents({
  parent = "projects/my-project/databases/(default)/documents",
  collection_id = "users",
  page_size = 20
})

for _, doc in ipairs(result.documents or {}) do
  print(doc.name)
end
```

---

## list_collections

List collection IDs under a Firestore document or database root.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `page_size` | integer | no | Maximum number of collection IDs to return |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```lua
local result = app.integrations.firebase.list_collections({
  parent = "projects/my-project/databases/(default)/documents"
})

for _, id in ipairs(result.collectionIds or {}) do
  print("Collection: " .. id)
end
```

---

## list_users

List users in a Firebase project via the Identity Toolkit API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_results` | integer | no | Maximum number of users to return (default: 1000, max: 1000) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```lua
local result = app.integrations.firebase.list_users({
  max_results = 50
})

for _, user in ipairs(result.users or {}) do
  print(user.localId .. ": " .. (user.email or "no email"))
end
```

---

## get_current_user

Get the currently authenticated OAuth2 user profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.firebase.get_current_user({})

print("Name: " .. (result.name or "unknown"))
print("Email: " .. (result.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Firebase accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.firebase.list_projects({...})

-- Explicit default (portable across setups)
app.integrations.firebase.default.list_projects({...})

-- Named accounts
app.integrations.firebase.production.list_projects({...})
app.integrations.firebase.staging.list_projects({...})
```

All functions are identical across accounts — only the credentials differ.
