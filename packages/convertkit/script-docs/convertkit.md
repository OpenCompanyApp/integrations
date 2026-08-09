# Kit (ConvertKit) JavaScript API Reference

Namespace: `app.integrations.convertkit`

This integration targets the current Kit API V4 at `https://api.kit.com/v4`.
Most tools accept a `params` object for cursor pagination and filters, or a
`payload` object for write requests. Individual common fields such as
`email_address`, `first_name`, `tag_id`, or `subscriber_id` may also be passed at
the top level.

## Common Patterns

List subscribers:

```js
var result = app.integrations.convertkit.list_subscribers({
  email_address: "reader@example.test",
  per_page: 25,
})
```
Create or upsert a subscriber:

```js
var result = app.integrations.convertkit.create_subscriber({
  email_address: "reader@example.test",
  first_name: "Ada",
  fields: {
    plan: "pro",
  }
})
```
Tag a subscriber by email address:

```js
var result = app.integrations.convertkit.tag_subscriber_by_email({
  tag_id: 42,
  email_address: "reader@example.test",
})
```
Create a broadcast from a full V4 payload:

```js
var result = app.integrations.convertkit.create_broadcast({
  payload: {
    subject: "Weekly update",
    preview_text: "What changed this week",
    description: "Weekly update",
    content: "<p>Hello readers</p>",
    public: false,
    published_at: "2026-01-01T00:00:00Z",
    subscriber_filter: {},
  }
})
```
## Resource Coverage

Tools are grouped around Kit V4 resources:

- `get_current_account`, `get_current_user`, `get_creator_profile`, `get_email_stats`, `get_growth_stats`, `list_colors`, `update_colors`
- `list_broadcasts`, `create_broadcast`, `get_broadcast`, `update_broadcast`, `delete_broadcast`, `get_broadcast_stats`, `list_broadcast_stats`, `get_broadcast_clicks`
- `list_subscribers`, `create_subscriber`, `filter_subscribers`, `get_subscriber`, `update_subscriber`, `unsubscribe_subscriber`, `list_subscriber_stats`, `list_subscriber_tags`, `bulk_create_subscribers`
- `list_forms`, `list_form_subscribers`, `add_subscriber_to_form`, `add_subscriber_to_form_by_email`, `bulk_add_subscribers_to_forms`
- `list_tags`, `create_tag`, `update_tag`, `list_tag_subscribers`, `tag_subscriber`, `tag_subscriber_by_email`, `remove_tag_from_subscriber`, `remove_tag_from_subscriber_by_email`, `bulk_create_tags`, `bulk_tag_subscribers`, `bulk_remove_tags_from_subscribers`
- `list_sequences`, `create_sequence`, `get_sequence`, `update_sequence`, `delete_sequence`, `list_sequence_subscribers`, `add_subscriber_to_sequence`, `add_subscriber_to_sequence_by_email`
- `list_custom_fields`, `create_custom_field`, `update_custom_field`, `delete_custom_field`, `bulk_create_custom_fields`, `bulk_update_subscriber_custom_fields`
- `list_email_templates`, `list_posts`, `get_post`, `list_purchases`, `create_purchase`, `get_purchase`, `list_segments`, `list_snippets`, `create_snippet`, `get_snippet`, `update_snippet`, `list_webhooks`, `create_webhook`, `delete_webhook`

## Raw API Helpers

Use raw helpers for newly released V4 endpoints that are not yet wrapped:

```js
var result = app.integrations.convertkit.api_get({
  path: "/segments",
  params: {
    per_page: 50,
  }
})
```
The `path` must be relative, for example `/subscribers` or `/v4/subscribers`.
Absolute URLs and parent-directory paths are rejected.

## OAuth-Restricted Endpoints

Kit documents some endpoints, including bulk operations and purchase creation,
as requiring OAuth. If an API key receives an authorization error for one of
these tools, configure `oauth_access_token` for the account.

## Multi-Account Usage

```js
app.integrations.convertkit.list_subscribers({ per_page: 25 })
app.integrations.convertkit.default.list_subscribers({ per_page: 25 })
app.integrations.convertkit.work.list_subscribers({ per_page: 25 })
```