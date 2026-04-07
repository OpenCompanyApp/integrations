# Teachable — Lua API Reference

## list_courses

List courses from your Teachable school.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 100) |

### Examples

```lua
local result = app.integrations.teachable.list_courses({
  per_page = 10,
  page = 1
})

for _, course in ipairs(result.data) do
  print(course.name .. " — " .. course.id)
end
```

---

## get_course

Get a single course by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `course_id` | string | yes | The ID of the course to retrieve |

### Examples

```lua
local result = app.integrations.teachable.get_course({
  course_id = "12345"
})

print(result.data.name)
print(result.data.description)
```

---

## list_users

List users from your Teachable school.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 100) |

### Examples

```lua
local result = app.integrations.teachable.list_users({
  per_page = 50,
  page = 1
})

for _, user in ipairs(result.data) do
  print(user.email .. " — " .. user.name)
end
```

---

## get_user

Get a single user by their ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The ID of the user to retrieve |

### Examples

```lua
local result = app.integrations.teachable.get_user({
  user_id = "67890"
})

print(result.data.email)
print(result.data.name)
```

---

## list_enrollments

List enrollments from your Teachable school.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no | Filter enrollments by user ID |
| `course_id` | string | no | Filter enrollments by course ID |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 100) |

### Examples

```lua
-- List all enrollments
local result = app.integrations.teachable.list_enrollments({
  per_page = 25,
  page = 1
})

-- Filter by course
local result = app.integrations.teachable.list_enrollments({
  course_id = "12345"
})

-- Filter by user
local result = app.integrations.teachable.list_enrollments({
  user_id = "67890"
})

for _, enrollment in ipairs(result.data) do
  print(enrollment.user_id .. " enrolled in " .. enrollment.course_id)
end
```

---

## get_enrollment

Get a single enrollment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `enrollment_id` | string | yes | The ID of the enrollment to retrieve |

### Examples

```lua
local result = app.integrations.teachable.get_enrollment({
  enrollment_id = "54321"
})

print(result.data.course_id)
print(result.data.user_id)
print(result.data.completed)
```

---

## get_current_user

Verify your API key and get the current user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.teachable.get_current_user({})

print(result.data.email)
print(result.data.name)
print(result.data.role)
```

---

## Multi-Account Usage

If you have multiple Teachable accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.teachable.list_courses({})

-- Explicit default (portable across setups)
app.integrations.teachable.default.list_courses({})

-- Named accounts
app.integrations.teachable.school_a.list_courses({})
app.integrations.teachable.school_b.list_courses({})
```

All functions are identical across accounts — only the credentials differ.
