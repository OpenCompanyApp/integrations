# Facebook — JavaScript API Reference

## list_pages

List all Facebook Pages the authenticated user manages.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated fields (e.g. `"id,name,category,fan_count,about"`). Defaults to `"id,name,category"`. |
| `limit` | integer | no | Max pages per request. |

### Example

```js
var result = app.integrations.facebook.list_pages({
  fields: "id,name,fan_count,category",
})

for (const page of (result.data)) {
  console.log(page.name + " (ID: " + page.id + ", Fans: " + page.fan_count + ")")
}
```
---

## get_page

Get details for a specific Facebook Page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Facebook Page ID. |
| `fields` | string | no | Comma-separated fields. Defaults to `"id,name,category,fan_count,about"`. |

### Example

```js
var result = app.integrations.facebook.get_page({
  page_id: "123456789",
  fields: "id,name,fan_count,about,website",
})

console.log(result.name + " — " + result.fan_count + " followers")
```
---

## list_posts

List posts published by a Facebook Page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Facebook Page ID. |
| `fields` | string | no | Comma-separated fields per post. Defaults to `"id,message,created_time"`. |
| `limit` | integer | no | Max posts per request. |
| `since` | string | no | Only posts after this timestamp/date. |
| `until` | string | no | Only posts before this timestamp/date. |

### Example

```js
var result = app.integrations.facebook.list_posts({
  page_id: "123456789",
  fields: "id,message,created_time",
  limit: 10,
})

for (const post of (result.data)) {
  console.log(post.created_time + ": " + (post.message || "(no text)"))
}
```
---

## create_post

Publish a new post on a Facebook Page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Facebook Page ID. |
| `message` | string | yes | Post body text. |
| `link` | string | no | URL to attach to the post. |
| `scheduled_publish_time` | string | no | UNIX timestamp for scheduled publishing. |

### Example

```js
// Publish immediately
var result = app.integrations.facebook.create_post({
  page_id: "123456789",
  message: "Check out our latest blog post!",
  link: "https://example.com/blog",
})

console.log("Published post ID: " + result.id)

// Schedule for later
var result = app.integrations.facebook.create_post({
  page_id: "123456789",
  message: "Scheduled post content",
  scheduled_publish_time: "1735689600",
})
```
---

## get_post

Get details for a specific Facebook post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The Facebook Post ID (e.g. `"pageId_postId"`). |
| `fields` | string | no | Comma-separated fields. Defaults to `"id,message,created_time,attachments"`. |

### Example

```js
var result = app.integrations.facebook.get_post({
  post_id: "123456789_987654321",
  fields: "id,message,created_time,attachments,shares",
})

console.log(result.message)
```
---

## list_insights

Get engagement and performance metrics for a Facebook Page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Facebook Page ID. |
| `metric` | string | no | Comma-separated metric names. Omit for all available metrics. |
| `period` | string | no | Aggregation period: `"day"`, `"week"`, `"days_28"`, `"month"`, `"lifetime"`. Defaults to `"day"`. |
| `since` | string | no | Start date (UNIX timestamp or ISO date). |
| `until` | string | no | End date (UNIX timestamp or ISO date). |

### Common Metrics

| Metric | Description |
|--------|-------------|
| `page_impressions` | Total impressions of the page |
| `page_engaged_users` | Users who engaged with the page |
| `page_post_engagements` | Engagements on page posts |
| `page_fans` | Total page followers/fans |
| `page_views_total` | Total page views |
| `page_actions_post_reactions_total` | Reactions on page posts |

### Example

```js
var result = app.integrations.facebook.list_insights({
  page_id: "123456789",
  metric: "page_impressions,page_engaged_users",
  period: "day",
  since: "2026-01-01",
  until: "2026-01-31",
})

for (const insight of (result.data)) {
  console.log(insight.name + ":")
  for (const val of (insight.values)) {
    console.log("  " + val.end_time + " = " + val.value)
  }
}
```
---

## get_current_user

Get the authenticated user's Facebook profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated fields. Defaults to `"id,name"`. |

### Example

```js
var result = app.integrations.facebook.get_current_user({
  fields: "id,name,picture",
})

console.log("Authenticated as: " + result.name + " (ID: " + result.id + ")")
```
---

## Multi-Account Usage

If you have multiple Facebook accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.facebook.list_pages({})

// Explicit default (portable across setups)
app.integrations.facebook.default.list_pages({})

// Named accounts
app.integrations.facebook.work.list_pages({})
app.integrations.facebook.client_page.list_pages({})
```
All functions are identical across accounts — only the credentials differ.
