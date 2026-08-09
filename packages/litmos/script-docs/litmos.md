# Litmos LMS — JavaScript API Reference

## list_users

List users in your Litmos organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100, max: 1000) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `search` | string | no | Search term to filter users by name or email |

### Examples

```js
// List first 50 users
var result = app.integrations.litmos.list_users({
  limit: 50,
  page: 1,
})

// Search for a user
var result = app.integrations.litmos.list_users({
  search: "john",
})

for (const user of (result)) {
  console.log(user.Id + ": " + user.FirstName + " " + user.LastName + " (" + user.Email + ")")
}
```
---

## get_user

Get detailed information about a specific Litmos user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Litmos user ID |

### Example

```js
var user = app.integrations.litmos.get_user({ id: "abc123" })
console.log(user.FirstName + " " + user.LastName)
console.log("Email: " + user.Email)
console.log("Status: " + user.Active)
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

```js
var user = app.integrations.litmos.create_user({
  FirstName: "Jane",
  LastName: "Doe",
  Email: "jane@example.com",
  UserName: "janedoe",
})
console.log("Created user: " + user.Id)
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

```js
// List all courses
var result = app.integrations.litmos.list_courses({
  limit: 100,
  page: 1,
})

// Search for a course
var result = app.integrations.litmos.list_courses({
  search: "onboarding",
})

for (const course of (result)) {
  console.log(course.Id + ": " + course.Name)
}
```
---

## get_course

Get detailed information about a specific Litmos course.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Litmos course ID |

### Example

```js
var course = app.integrations.litmos.get_course({ id: "course-456" })
console.log("Course: " + course.Name)
console.log("Description: " + (course.Description || "N/A"))
console.log("Active: " + String(course.Active))
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

```js
var result = app.integrations.litmos.list_teams({
  limit: 50,
  page: 1,
})

for (const team of (result)) {
  console.log(team.Id + ": " + team.Name)
}
```
---

## get_current_user

Get the profile of the currently authenticated Litmos user.

### Parameters

None.

### Example

```js
var me = app.integrations.litmos.get_current_user({})
console.log("Logged in as: " + me.FirstName + " " + me.LastName)
console.log("Email: " + me.Email)
```
---

## Multi-Account Usage

If you have multiple Litmos accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.litmos.list_users({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.litmos.default.list_users({ /* parameters */ })

// Named accounts
app.integrations.litmos.production.list_users({ /* parameters */ })
app.integrations.litmos.staging.list_users({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
