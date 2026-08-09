# Buffer - JavaScript API Reference

Namespace: `app.integrations.buffer`

This package covers Buffer's documented legacy REST API for profiles, schedules,
updates, links, user, and configuration metadata. It also includes
`graphql()` for the current Buffer GraphQL API beta at `https://api.buffer.com`.

## Profiles And Schedules

```js
var profiles = app.integrations.buffer.list_profiles()

var profile = app.integrations.buffer.get_profile({
  profileId: "profile_123",
})

var schedules = app.integrations.buffer.list_profile_schedules({
  profileId: "profile_123",
})
```
Replace a profile's posting schedules:

```js
var result = app.integrations.buffer.update_profile_schedules({
  profileId: "profile_123",
  payload: {
    schedules: [
      { days: [ "mon", "wed", "fri" ], times: [ "09:00", "15:30" ] }
    ]
  }
})
```
## Updates

Create or immediately publish an update:

```js
var result = app.integrations.buffer.create_update({
  text: "New post from our site https://example.test/post",
  profileIds: [ "profile_123", "profile_456" ],
  scheduledAt: "2026-06-01T09:00:00Z",
  media: {
    link: "https://example.test/post",
    title: "Example post",
    description: "Short summary",
  }
})
```
List pending and sent updates:

```js
var pending = app.integrations.buffer.list_pending_updates({
  profileId: "profile_123",
  count: 20,
  page: 1,
  utc: true,
})

var sent = app.integrations.buffer.list_sent_updates({
  profileId: "profile_123",
  filter: "all",
})
```
Manage pending updates:

```js
app.integrations.buffer.reorder_updates({
  profileId: "profile_123",
  order: [ "update_1", "update_2" ],
  offset: 0,
})

app.integrations.buffer.shuffle_updates({
  profileId: "profile_123",
  count: 10,
})

app.integrations.buffer.update_update({
  updateId: "update_123",
  payload: {
    text: "Edited post text",
    scheduled_at: "2026-06-01T10:00:00Z",
  }
})

app.integrations.buffer.share_update({ updateId: "update_123" })
app.integrations.buffer.move_update_to_top({ updateId: "update_123" })
app.integrations.buffer.destroy_update({ updateId: "update_123" })
```
## Links, Info, And User

```js
var shares = app.integrations.buffer.get_link_shares({
  url: "https://example.test/post",
})

var config = app.integrations.buffer.get_info_configuration()
var user = app.integrations.buffer.get_current_user()
```
`deauthorize_user()` revokes the current token. Treat it as destructive:

```js
// app.integrations.buffer.deauthorize_user()
```
## GraphQL Beta

The current Buffer API is GraphQL and supports post creation/deletion/retrieval,
idea creation, account retrieval, organization retrieval, and channel retrieval.
Use `graphql()` when an operation belongs to the beta GraphQL API rather than
the legacy REST surface.

```js
var result = app.integrations.buffer.graphql({
  query: String.raw`,
    query GetOrganizations {
      account {
        organizations {
          id
        }
      }
    }
  `
})
```
For mutations, pass variables explicitly:

```js
var result = app.integrations.buffer.graphql({
  query: String.raw`,
    mutation Example($text: String) {
      createPost(text: $text) {
        id
      }
    }
  `,
  variables: {
    text: "Draft from an integration",
  }
})
```
## Multi-Account Usage

```js
app.integrations.buffer.list_profiles()
app.integrations.buffer.default.list_profiles()
app.integrations.buffer.client_acct.list_profiles()
```
All functions are identical across accounts. Only the credentials differ.
