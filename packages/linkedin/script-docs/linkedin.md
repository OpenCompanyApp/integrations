# Client for the LinkedIn REST API v2 covering posts, organizations, and ad accounts — JavaScript API Reference

## linkedin_list_posts

List LinkedIn UGC posts for an author.
Returns post IDs, lifecycle state, and creation timestamps.
Use author, count, and start for filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `author` | string | yes | Author URN (e.g. "urn:li:person:ABC123" or "urn:li:organization:12345"). |
| `count` | integer | no | Maximum number of posts to return (default 10, max 100). |
| `start` | integer | no | Pagination offset (0-based). |

### Example

```js
var result = app.integrations.linkedin.linkedin_list_posts({
  author: "urn:li:person:ABC123",
  count: 10,
  start: 0,
})
```
## linkedin_get_post

Retrieve a LinkedIn UGC post by its ID.
Returns the full post including content, lifecycle state, and visibility.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | LinkedIn UGC post URN or ID (e.g. "urn:li:ugcPost:123456789"). |

### Example

```js
var result = app.integrations.linkedin.linkedin_get_post({
  post_id: "urn:li:ugcPost:123456789",
})
```
## linkedin_create_post

Create a new LinkedIn UGC post.
Requires an author URN and text content.
Returns the created post with its ID and lifecycle state.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `author` | string | yes | Author URN (e.g. "urn:li:person:ABC123" or "urn:li:organization:12345"). |
| `text` | string | yes | Text content for the post. |
| `visibility` | string | no | Visibility: "PUBLIC" (default) or "CONNECTIONS". |

### Example

```js
var result = app.integrations.linkedin.linkedin_create_post({
  author: "urn:li:person:ABC123",
  text: "Hello from the LinkedIn API!",
  visibility: "PUBLIC",
})
```
## linkedin_list_organizations

List LinkedIn organizations (company pages) the authenticated user has access to.
Returns organization IDs, names, and roles.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Maximum number of organizations to return (default 10). |
| `start` | integer | no | Pagination offset (0-based). |

### Example

```js
var result = app.integrations.linkedin.linkedin_list_organizations({
  count: 10,
  start: 0,
})
```
## linkedin_get_organization

Retrieve a LinkedIn organization (company page) by its ID.
Returns the organization's name, description, website, and other profile data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization_id` | string | yes | LinkedIn organization ID or URN (e.g. "12345" or "urn:li:organization:12345"). |

### Example

```js
var result = app.integrations.linkedin.linkedin_get_organization({
  organization_id: "12345",
})
```
## linkedin_list_ad_accounts

List LinkedIn ad accounts the authenticated user has access to.
Returns ad account IDs, names, statuses, and currency information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Maximum number of ad accounts to return (default 10). |
| `start` | integer | no | Pagination offset (0-based). |

### Example

```js
var result = app.integrations.linkedin.linkedin_list_ad_accounts({
  count: 10,
  start: 0,
})
```
## linkedin_get_current_user

Retrieve the currently authenticated LinkedIn user profile.
Returns the user's ID, localized name, and profile metadata.
Useful for identifying which account or token is in use.

### Example

```js
var result = app.integrations.linkedin.linkedin_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple linkedin accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.linkedin.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.linkedin.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.linkedin.work.function_name({ /* parameters */ })
app.integrations.linkedin.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
