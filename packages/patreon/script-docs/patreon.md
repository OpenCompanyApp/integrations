# Patreon — JavaScript API Reference

## list_campaigns

List all campaigns for the authenticated Patreon creator.

### Parameters

None.

### Examples

```js
var result = app.integrations.patreon.list_campaigns()

for (const campaign of (result.campaigns)) {
  console.log(campaign.attributes.creation_name + " — Patrons: " + campaign.attributes.patron_count)
}
```
---

## get_campaign

Get detailed information about a single Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to retrieve |

### Example

```js
var result = app.integrations.patreon.get_campaign({
  campaign_id: "123456",
})

console.log(result.attributes.creation_name)
console.log(result.attributes.summary)
console.log(result.attributes.patron_count)
```
---

## list_members

List members (patrons) for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list members for |

### Examples

#### All members

```js
var result = app.integrations.patreon.list_members({
  campaign_id: "123456",
})

for (const member of (result.members)) {
  console.log(member.attributes.full_name + " — " + member.attributes.patron_status)
}
```
---

## get_member

Get details for a single Patreon member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member to retrieve |

### Example

```js
var result = app.integrations.patreon.get_member({
  member_id: "789012",
})

console.log(result.attributes.full_name)
console.log(result.attributes.email)
console.log(result.attributes.patron_status)
```
---

## list_posts

List posts for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list posts for |

### Examples

```js
var result = app.integrations.patreon.list_posts({
  campaign_id: "123456",
})

for (const post of (result.posts)) {
  console.log(post.attributes.title + " — " + post.attributes.published_at)
}
```
---

## get_post

Get details for a single Patreon post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to retrieve |

### Example

```js
var result = app.integrations.patreon.get_post({
  post_id: "345678",
})

console.log(result.attributes.title)
console.log(result.attributes.content)
console.log(result.attributes.published_at)
```
---

## get_current_user

Get the profile of the currently authenticated Patreon user.

### Parameters

None.

### Example

```js
var result = app.integrations.patreon.get_current_user()

console.log("Connected as: " + result.attributes.full_name)
console.log("Email: " + result.attributes.email)
```
---

## Multi-Account Usage

If you have multiple Patreon accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.patreon.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.patreon.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.patreon.main_creator.function_name({ /* parameters */ })
app.integrations.patreon.side_project.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
