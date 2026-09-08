# Facebook — Ruby API Reference

## list_pages

List all Facebook Pages the authenticated user manages.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated fields (e.g. `"id,name,category,fan_count,about"`). Defaults to `"id,name,category"`. |
| `limit` | integer | no | Max pages per request. |

### Example

```ruby
result = app.integrations.facebook.list_pages(fields: "id,name,fan_count,category")
result.data.each do |page|
  puts((page.name).to_s + " (ID: " + (page.id).to_s + ", Fans: " + (page.fan_count).to_s + ")")
end
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

```ruby
result = app.integrations.facebook.get_page(page_id: "123456789", fields: "id,name,fan_count,about,website")
puts((result.name).to_s + " — " + (result.fan_count).to_s + " followers")
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

```ruby
result = app.integrations.facebook.list_posts(page_id: "123456789", fields: "id,message,created_time", limit: 10)
result.data.each do |post|
  puts((post.created_time).to_s + ": " + ((post.message || "(no text)")).to_s)
end
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

```ruby
# Publish immediately
result = app.integrations.facebook.create_post(page_id: "123456789", message: "Check out our latest blog post!", link: "https://example.com/blog")
puts("Published post ID: " + (result.id).to_s)
# Schedule for later
result = app.integrations.facebook.create_post(page_id: "123456789", message: "Scheduled post content", scheduled_publish_time: "1735689600")
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

```ruby
result = app.integrations.facebook.get_post(post_id: "123456789_987654321", fields: "id,message,created_time,attachments,shares")
puts(result.message)
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

```ruby
result = app.integrations.facebook.list_insights(page_id: "123456789", metric: "page_impressions,page_engaged_users", period: "day", since: "2026-01-01", until: "2026-01-31")
result.data.each do |insight|
  puts((insight.name).to_s + ":")
  insight.values.each do |val|
    puts("  " + (val.end_time).to_s + " = " + (val.value).to_s)
  end
end
```
---

## get_current_user

Get the authenticated user's Facebook profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated fields. Defaults to `"id,name"`. |

### Example

```ruby
result = app.integrations.facebook.get_current_user(fields: "id,name,picture")
puts("Authenticated as: " + (result.name).to_s + " (ID: " + (result.id).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Facebook accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.facebook.list_pages()
# Explicit default (portable across setups)
app.integrations.facebook.default.list_pages()
# Named accounts
app.integrations.facebook.work.list_pages()
app.integrations.facebook.client_page.list_pages()
```
All functions are identical across accounts — only the credentials differ.
