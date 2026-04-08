# Litmos LMS — Lua API Reference

## list_users

List users in your Litmos organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100, max: 1000) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `search` | string | no | Search term to filter users by name or email |

### Examples

```lua
-- List first 50 users
local result = app.integrations.litmos.list_users({
  limit = 50,
  page = 1
})

-- Search for a user
local result = app.integrations.litmos.list_users({
  search = "john"
})

for _, user in ipairs(result) do
  print(user.Id .. ": " .. user.FirstName .. " " .. user.LastName .. " (" .. user.Email .. ")")
end
```

---

## get_user

Get detailed information about a specific Litmos user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Litmos user ID |

### Example

```lua
local user = app.integrations.litmos.get_user({ id = "abc123" })
print(user.FirstName .. " " .. user.LastName)
print("Email: " .. user.Email)
print("Status: " .. user.Active)
```

---

## create_user

Create a new user in Litmos.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `FirstName` | string | yes | The user's first name |
| `LastName` | string | yes | The user's last name |
| `Email` | string | yes | The user's email address |
| `UserName` | string | yes | The user's login username |

### Example

```lua
local user = app.integrations.litmos.create_user({
  FirstName = "Jane",
  LastName = "Doe",
  Email = "jane@example.com",
  UserName = "janedoe"
})
print("Created user: " .. user.Id)
```

---

## list_courses

List courses in your Litmos organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of courses per page (default: 100, max: 1000) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `search` | string | no | Search term to filter courses by name |

### Examples

```lua
-- List all courses
local result = app.integrations.litmos.list_courses({
  limit = 100,
  page = 1
})

-- Search for a course
local result = app.integrations.litmos.list_courses({
  search = "onboarding"
})

for _, course in ipairs(result) do
  print(course.Id .. ": " .. course.Name)
end
```

---

## get_course

Get detailed information about a specific Litmos course.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Litmos course ID |

### Example

```lua
local course = app.integrations.litmos.get_course({ id = "course-456" })
print("Course: " .. course.Name)
print("Description: " .. (course.Description or "N/A"))
print("Active: " .. tostring(course.Active))
```

---

## list_teams

List teams in your Litmos organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of teams per page (default: 100, max: 1000) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.litmos.list_teams({
  limit = 50,
  page = 1
})

for _, team in ipairs(result) do
  print(team.Id .. ": " .. team.Name)
end
```

---

## get_current_user

Get the profile of the currently authenticated Litmos user.

### Parameters

None.

### Example

```lua
local me = app.integrations.litmos.get_current_user({})
print("Logged in as: " .. me.FirstName .. " " .. me.LastName)
print("Email: " .. me.Email)
```

---

## Multi-Account Usage

If you have multiple Litmos accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.litmos.list_users({...})

-- Explicit default (portable across setups)
app.integrations.litmos.default.list_users({...})

-- Named accounts
app.integrations.litmos.production.list_users({...})
app.integrations.litmos.staging.list_users({...})
```

All functions are identical across accounts — only the credentials differ.
