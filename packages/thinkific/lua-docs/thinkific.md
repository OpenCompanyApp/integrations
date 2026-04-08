# Thinkific — Lua API Reference

## list_courses

List courses in your Thinkific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of courses per page (default: 25, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `query` | string | no | Search term to filter courses by name |

### Examples

```lua
-- List first 50 courses
local result = app.integrations.thinkific.list_courses({
  limit = 50,
  page = 1
})

-- Search for a course
local result = app.integrations.thinkific.list_courses({
  query = "onboarding"
})

for _, course in ipairs(result.items) do
  print(course.id .. ": " .. course.name)
end
```

---

## get_course

Get detailed information about a specific Thinkific course.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Thinkific course ID |

### Example

```lua
local course = app.integrations.thinkific.get_course({ id = 12345 })
print("Course: " .. course.name)
print("Description: " .. (course.description or "N/A"))
print("Status: " .. course.status)
```

---

## create_course

Create a new course in Thinkific.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The course name |
| `description` | string | no | The course description |
| `course_card_subtitle` | string | no | Subtitle shown on the course card |

### Example

```lua
local course = app.integrations.thinkific.create_course({
  name = "Introduction to Lua",
  description = "Learn the basics of Lua programming"
})
print("Created course: " .. course.id)
```

---

## list_enrollments

List enrollments in your Thinkific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of enrollments per page (default: 25, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `course_id` | integer | no | Filter enrollments by course ID |
| `user_id` | integer | no | Filter enrollments by user ID |

### Examples

```lua
-- List all enrollments
local result = app.integrations.thinkific.list_enrollments({
  limit = 50,
  page = 1
})

-- Filter by course
local result = app.integrations.thinkific.list_enrollments({
  course_id = 12345
})

-- Filter by user
local result = app.integrations.thinkific.list_enrollments({
  user_id = 67890
})

for _, enrollment in ipairs(result.items) do
  print(enrollment.id .. ": Course " .. enrollment.course_id .. " - User " .. enrollment.user_id .. " - " .. tostring(enrollment.percentage_completed) .. "% complete")
end
```

---

## get_enrollment

Get detailed information about a specific Thinkific enrollment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Thinkific enrollment ID |

### Example

```lua
local enrollment = app.integrations.thinkific.get_enrollment({ id = 56789 })
print("Course ID: " .. enrollment.course_id)
print("User ID: " .. enrollment.user_id)
print("Progress: " .. tostring(enrollment.percentage_completed) .. "%")
print("Completed: " .. tostring(enrollment.completed))
```

---

## list_users

List users in your Thinkific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 25, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `query` | string | no | Search term to filter users by name or email |

### Examples

```lua
-- List first 50 users
local result = app.integrations.thinkific.list_users({
  limit = 50,
  page = 1
})

-- Search for a user
local result = app.integrations.thinkific.list_users({
  query = "john"
})

for _, user in ipairs(result.items) do
  print(user.id .. ": " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated Thinkific user.

### Parameters

None.

### Example

```lua
local me = app.integrations.thinkific.get_current_user({})
print("Logged in as: " .. me.first_name .. " " .. me.last_name)
print("Email: " .. me.email)
```

---

## Multi-Account Usage

If you have multiple Thinkific accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.thinkific.list_courses({...})

-- Explicit default (portable across setups)
app.integrations.thinkific.default.list_courses({...})

-- Named accounts
app.integrations.thinkific.production.list_courses({...})
app.integrations.thinkific.staging.list_courses({...})
```

All functions are identical across accounts — only the credentials differ.
