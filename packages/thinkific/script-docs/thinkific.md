# Thinkific — Ruby API Reference

## list_courses

List courses in your Thinkific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of courses per page (default: 25, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `query` | string | no | Search term to filter courses by name |

### Examples

```ruby
# List first 50 courses
result = app.integrations.thinkific.list_courses(limit: 50, page: 1)
# Search for a course
result = app.integrations.thinkific.list_courses(query: "onboarding")
result.items.each do |course|
  puts((course.id).to_s + ": " + (course.name).to_s)
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

```ruby
course = app.integrations.thinkific.get_course(id: 12345)
puts("Course: " + (course.name).to_s)
puts("Description: " + ((course.description || "N/A")).to_s)
puts("Status: " + (course.status).to_s)
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

```ruby
course = app.integrations.thinkific.create_course(name: "Introduction to Ruby", description: "Learn the basics of Ruby programming")
puts("Created course: " + (course.id).to_s)
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

```ruby
# List all enrollments
result = app.integrations.thinkific.list_enrollments(limit: 50, page: 1)
# Filter by course
result = app.integrations.thinkific.list_enrollments(course_id: 12345)
# Filter by user
result = app.integrations.thinkific.list_enrollments(user_id: 67890)
result.items.each do |enrollment|
  puts((enrollment.id).to_s + ": Course " + (enrollment.course_id).to_s + " - User " + (enrollment.user_id).to_s + " - " + ((enrollment.percentage_completed).to_s).to_s + "% complete")
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

```ruby
enrollment = app.integrations.thinkific.get_enrollment(id: 56789)
puts("Course ID: " + (enrollment.course_id).to_s)
puts("User ID: " + (enrollment.user_id).to_s)
puts("Progress: " + ((enrollment.percentage_completed).to_s).to_s + "%")
puts("Completed: " + ((enrollment.completed).to_s).to_s)
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

```ruby
# List first 50 users
result = app.integrations.thinkific.list_users(limit: 50, page: 1)
# Search for a user
result = app.integrations.thinkific.list_users(query: "john")
result.items.each do |user|
  puts((user.id).to_s + ": " + (user.first_name).to_s + " " + (user.last_name).to_s + " (" + (user.email).to_s + ")")
end
```
---

## get_current_user

Get the profile of the currently authenticated Thinkific user.

### Parameters

None.

### Example

```ruby
me = app.integrations.thinkific.get_current_user()
puts("Logged in as: " + (me.first_name).to_s + " " + (me.last_name).to_s)
puts("Email: " + (me.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Thinkific accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.thinkific.list_courses()
# Explicit default (portable across setups)
app.integrations.thinkific.default.list_courses()
# Named accounts
app.integrations.thinkific.production.list_courses()
app.integrations.thinkific.staging.list_courses()
```
All functions are identical across accounts — only the credentials differ.
