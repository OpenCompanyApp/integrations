# Buffer - Ruby API Reference

Namespace: `app.integrations.buffer`

This package covers Buffer's documented legacy REST API for profiles, schedules,
updates, links, user, and configuration metadata. It also includes
`graphql()` for the current Buffer GraphQL API beta at `https://api.buffer.com`.

## Profiles And Schedules

```ruby
profiles = app.integrations.buffer.list_profiles()
profile = app.integrations.buffer.get_profile(profile_id: "profile_123")
schedules = app.integrations.buffer.list_profile_schedules(profile_id: "profile_123")
```
Replace a profile's posting schedules:

```ruby
result = app.integrations.buffer.update_profile_schedules(profile_id: "profile_123", payload: {schedules: [{days: ["mon", "wed", "fri"], times: ["09:00", "15:30"]}]})
```
## Updates

Create or immediately publish an update:

```ruby
result = app.integrations.buffer.create_update(text: "New post from our site https://example.test/post", profile_ids: ["profile_123", "profile_456"], scheduled_at: "2026-06-01T09:00:00Z", media: {link: "https://example.test/post", title: "Example post", description: "Short summary"})
```
List pending and sent updates:

```ruby
pending = app.integrations.buffer.list_pending_updates(profile_id: "profile_123", count: 20, page: 1, utc: true)
sent = app.integrations.buffer.list_sent_updates(profile_id: "profile_123", filter: "all")
```
Manage pending updates:

```ruby
app.integrations.buffer.reorder_updates(profile_id: "profile_123", order: ["update_1", "update_2"], offset: 0)
app.integrations.buffer.shuffle_updates(profile_id: "profile_123", count: 10)
app.integrations.buffer.update_update(update_id: "update_123", payload: {text: "Edited post text", scheduled_at: "2026-06-01T10:00:00Z"})
app.integrations.buffer.share_update(update_id: "update_123")
app.integrations.buffer.move_update_top(update_id: "update_123")
app.integrations.buffer.destroy_update(update_id: "update_123")
```
## Links, Info, And User

```ruby
shares = app.integrations.buffer.get_link_shares(url: "https://example.test/post")
config = app.integrations.buffer.get_info_configuration()
user = app.integrations.buffer.get_current_user()
```
`deauthorize_user()` revokes the current token. Treat it as destructive:

```ruby
# app.integrations.buffer.deauthorize_user()
```
## GraphQL Beta

The current Buffer API is GraphQL and supports post creation/deletion/retrieval,
idea creation, account retrieval, organization retrieval, and channel retrieval.
Use `graphql()` when an operation belongs to the beta GraphQL API rather than
the legacy REST surface.

```ruby
result = app.integrations.buffer.graphql_operation(query: "\n    query GetOrganizations {\n      account {\n        organizations {\n          id\n        }\n      }\n    }\n  ")
```
For mutations, pass variables explicitly:

```ruby
result = app.integrations.buffer.graphql_operation(query: "\n    mutation Example($text: String) {\n      createPost(text: $text) {\n        id\n      }\n    }\n  ", variables: {text: "Draft from an integration"})
```
## Multi-Account Usage

```ruby
app.integrations.buffer.list_profiles()
app.integrations.buffer.default.list_profiles()
app.integrations.buffer.client_acct.list_profiles()
```
All functions are identical across accounts. Only the credentials differ.
