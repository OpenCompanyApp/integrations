# Litmos LMS — Ruby API Reference

## list_users

List users in your Litmos organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100, max: 1000) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `search` | string | no | Search term to filter users by name or email |

### Examples

```ruby
# List first 50 users
result = app.integrations.litmos.list_users(limit: 50, page: 1)
# Search for a user
result = app.integrations.litmos.list_users(search: "john")
result.each do |user|
  puts((user.Id).to_s + ": " + (user.FirstName).to_s + " " + (user.LastName).to_s + " (" + (user.Email).to_s + ")")
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

```ruby
user = app.integrations.litmos.get_user(id: "abc123")
puts((user.FirstName).to_s + " " + (user.LastName).to_s)
puts("Email: " + (user.Email).to_s)
puts("Status: " + (user.Active).to_s)
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

```ruby
user = app.integrations.litmos.create_user(first_name: "Jane", last_name: "Doe", email: "jane@example.com", user_name: "janedoe")
puts("Created user: " + (user.Id).to_s)
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

```ruby
# List all courses
result = app.integrations.litmos.list_courses(limit: 100, page: 1)
# Search for a course
result = app.integrations.litmos.list_courses(search: "onboarding")
result.each do |course|
  puts((course.Id).to_s + ": " + (course.Name).to_s)
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

```ruby
course = app.integrations.litmos.get_course(id: "course-456")
puts("Course: " + (course.Name).to_s)
puts("Description: " + ((course.Description || "N/A")).to_s)
puts("Active: " + ((course.Active).to_s).to_s)
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

```ruby
result = app.integrations.litmos.list_teams(limit: 50, page: 1)
result.each do |team|
  puts((team.Id).to_s + ": " + (team.Name).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated Litmos user.

### Parameters

None.

### Example

```ruby
me = app.integrations.litmos.get_current_user()
puts("Logged in as: " + (me.FirstName).to_s + " " + (me.LastName).to_s)
puts("Email: " + (me.Email).to_s)
```
---

## Multi-Account Usage

If you have multiple Litmos accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.litmos.list_users()
# Explicit default (portable across setups)
app.integrations.litmos.default.list_users()
# Named accounts
app.integrations.litmos.production.list_users()
app.integrations.litmos.staging.list_users()
```
All functions are identical across accounts — only the credentials differ.
