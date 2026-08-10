# Thinkific — JavaScript API Reference

## list_courses

List courses in your Thinkific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of courses per page (default: 25, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `query` | string | no | Search term to filter courses by name |

### Examples

```js
// List first 50 courses
var result = app.integrations.thinkific.list_courses({
  limit: 50,
  page: 1,
})

// Search for a course
var result = app.integrations.thinkific.list_courses({
  query: "onboarding",
})

for (const course of (result.items)) {
  console.log(course.id + ": " + course.name)
}
```
---

## get_course

Get detailed information about a specific Thinkific course.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Thinkific course ID |

### Example

```js
var course = app.integrations.thinkific.get_course({ id: 12345 })
console.log("Course: " + course.name)
console.log("Description: " + (course.description || "N/A"))
console.log("Status: " + course.status)
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

```js
var course = app.integrations.thinkific.create_course({
  name: "Introduction to JavaScript",
  description: "Learn the basics of JavaScript programming",
})
console.log("Created course: " + course.id)
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

```js
// List all enrollments
var result = app.integrations.thinkific.list_enrollments({
  limit: 50,
  page: 1,
})

// Filter by course
var result = app.integrations.thinkific.list_enrollments({
  course_id: 12345,
})

// Filter by user
var result = app.integrations.thinkific.list_enrollments({
  user_id: 67890,
})

for (const enrollment of (result.items)) {
  console.log(enrollment.id + ": Course " + enrollment.course_id + " - User " + enrollment.user_id + " - " + String(enrollment.percentage_completed) + "% complete")
}
```
---

## get_enrollment

Get detailed information about a specific Thinkific enrollment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Thinkific enrollment ID |

### Example

```js
var enrollment = app.integrations.thinkific.get_enrollment({ id: 56789 })
console.log("Course ID: " + enrollment.course_id)
console.log("User ID: " + enrollment.user_id)
console.log("Progress: " + String(enrollment.percentage_completed) + "%")
console.log("Completed: " + String(enrollment.completed))
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

```js
// List first 50 users
var result = app.integrations.thinkific.list_users({
  limit: 50,
  page: 1,
})

// Search for a user
var result = app.integrations.thinkific.list_users({
  query: "john",
})

for (const user of (result.items)) {
  console.log(user.id + ": " + user.first_name + " " + user.last_name + " (" + user.email + ")")
}
```
---

## get_current_user

Get the profile of the currently authenticated Thinkific user.

### Parameters

None.

### Example

```js
var me = app.integrations.thinkific.get_current_user({})
console.log("Logged in as: " + me.first_name + " " + me.last_name)
console.log("Email: " + me.email)
```
---

## Multi-Account Usage

If you have multiple Thinkific accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.thinkific.list_courses({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.thinkific.default.list_courses({ /* parameters */ })

// Named accounts
app.integrations.thinkific.production.list_courses({ /* parameters */ })
app.integrations.thinkific.staging.list_courses({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
