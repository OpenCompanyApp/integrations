# Okta — Lua API Reference

## okta_list_users

List users in the Okta organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (1–200, default: 200) |
| `q` | string | no | Search query to filter users by first name, last name, or email |

### Example

```lua
-- List all users
local result = app.integrations.okta.list_users({})

for _, user in ipairs(result) do
  print(user.profile.login .. " — " .. user.profile.firstName .. " " .. user.profile.lastName .. " (" .. user.status .. ")")
end

-- Search for a user
local result = app.integrations.okta.list_users({ q = "john" })
```

---

## okta_get_user

Get details for a specific Okta user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Okta user ID or login email address |

### Example

```lua
local user = app.integrations.okta.get_user({ id = "00u1a2b3c4d5e6f7g8h9" })
print(user.profile.login)
print(user.profile.email)
print(user.status)
```

---

## okta_get_current_user

Get the profile of the currently authenticated API token owner.

### Parameters

None.

### Example

```lua
local me = app.integrations.okta.get_current_user({})
print("Connected as: " .. me.profile.login)
```

---

## okta_create_user

Create a new user in Okta.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile` | object | yes | User profile. Required: `firstName`, `lastName`, `email`, `login` |
| `credentials` | object | no | User credentials, e.g. `{ password = { value = "TempPass123!" } }` |
| `activate` | boolean | no | Activate immediately (default: `true`) |

### Profile Fields

| Field | Type | Description |
|-------|------|-------------|
| `firstName` | string | **Required.** First name |
| `lastName` | string | **Required.** Last name |
| `email` | string | **Required.** Primary email |
| `login` | string | **Required.** Login username (often same as email) |
| `mobilePhone` | string | Mobile phone number |
| `secondEmail` | string | Backup email |
| `title` | string | Job title |
| `department` | string | Department name |
| `organization` | string | Organization name |

### Example

```lua
local user = app.integrations.okta.create_user({
  profile = {
    firstName = "Jane",
    lastName = "Doe",
    email = "jane.doe@example.com",
    login = "jane.doe@example.com",
    title = "Software Engineer",
    department = "Engineering"
  },
  activate = true
})

print("Created user: " .. user.id)
```

### With password

```lua
local user = app.integrations.okta.create_user({
  profile = {
    firstName = "Jane",
    lastName = "Doe",
    email = "jane.doe@example.com",
    login = "jane.doe@example.com"
  },
  credentials = {
    password = { value = "TempPass123!" }
  },
  activate = true
})
```

---

## okta_update_user

Update an existing Okta user profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Okta user ID or login email |
| `profile` | object | yes | Fields to update (only include what you want to change) |
| `credentials` | object | no | Updated credentials |

### Example

```lua
local user = app.integrations.okta.update_user({
  id = "00u1a2b3c4d5e6f7g8h9",
  profile = {
    title = "Senior Engineer",
    department = "Platform"
  }
})
```

---

## okta_deactivate_user

Deactivate an Okta user. The user cannot sign in but data is retained.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Okta user ID or login email |

### Example

```lua
app.integrations.okta.deactivate_user({ id = "00u1a2b3c4d5e6f7g8h9" })
print("User deactivated")
```

---

## okta_list_groups

List groups in the Okta organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | no | Search query to filter groups by name |

### Example

```lua
-- List all groups
local groups = app.integrations.okta.list_groups({})
for _, group in ipairs(groups) do
  print(group.id .. ": " .. group.profile.name)
end

-- Search for a group
local groups = app.integrations.okta.list_groups({ q = "Engineering" })
```

---

## okta_get_group

Get details for a specific Okta group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Okta group ID |

### Example

```lua
local group = app.integrations.okta.get_group({ id = "00g1a2b3c4d5e6f7g8h9" })
print(group.profile.name)
print(group.profile.description or "(no description)")
```

---

## okta_add_user_to_group

Add a user to an Okta group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `groupId` | string | yes | Okta group ID |
| `userId` | string | yes | Okta user ID |

### Example

```lua
app.integrations.okta.add_user_to_group({
  groupId = "00g1a2b3c4d5e6f7g8h9",
  userId = "00u1a2b3c4d5e6f7g8h9"
})
print("User added to group")
```

---

## okta_list_applications

List applications in the Okta organization.

### Parameters

None.

### Example

```lua
local apps = app.integrations.okta.list_applications({})
for _, app in ipairs(apps) do
  print(app.id .. ": " .. app.label .. " (" .. app.status .. ")")
end
```

---

## Multi-Account Usage

If you have multiple Okta organizations configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.okta.list_users({})

-- Explicit default (portable across setups)
app.integrations.okta.default.list_users({})

-- Named accounts
app.integrations.okta.production.list_users({})
app.integrations.okta.staging.list_users({})
```

All functions are identical across accounts — only the credentials differ.
