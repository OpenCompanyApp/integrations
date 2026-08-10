# Bluesky JavaScript Reference

Namespace: `bluesky`

Bluesky tools return raw XRPC JSON. Most app view endpoints return objects such
as `feed`, `posts`, `profile`, `followers`, `follows`, `likes`, or `cursor`.

## Common Reads

```js
var profile = app.integrations.bluesky.get_profile({
  actor: "alice.bsky.social",
})

var timeline = app.integrations.bluesky.get_timeline({
  limit: 25,
})

var author = app.integrations.bluesky.get_author_feed({
  actor: "alice.bsky.social",
  filter: "posts_no_replies",
})

var thread = app.integrations.bluesky.get_post_thread({
  uri: "at://did:plc:example/app.bsky.feed.post/3kexample",
  depth: 6,
})

var posts = app.integrations.bluesky.get_posts({
  uris: [
    "at://did:plc:example/app.bsky.feed.post/3kexample",
  ],
})
```
Other read tools:

- `get_feed({ feed, limit?, cursor? })`
- `get_feed_generator({ feed })`
- `get_likes({ uri, cid?, limit?, cursor? })`
- `get_reposted_by({ uri, cid?, limit?, cursor? })`
- `list_followers({ actor, limit?, cursor? })`
- `list_following({ actor, limit?, cursor? })`
- `search_posts({ q, limit?, cursor? })`
- `list_notifications({ limit?, cursor?, seen_at? })`
- `get_current_user({})`

## Writes

```js
var post = app.integrations.bluesky.create_post({
  text: "Hello from an agent",
  langs: [ "en" ],
})

var like = app.integrations.bluesky.like_post({
  uri: post.uri,
  cid: post.cid,
})

var repost = app.integrations.bluesky.repost_post({
  uri: post.uri,
  cid: post.cid,
})

var follow = app.integrations.bluesky.follow_actor({
  subject: "did:plc:example",
})
```
Generic record writes:

```js
var record = app.integrations.bluesky.create_record({
  collection: "app.bsky.feed.post",
  record: {
    ["$type"]: "app.bsky.feed.post",
    text: "Custom record body",
    createdAt: "2026-05-06T12:00:00Z",
  },
})

app.integrations.bluesky.delete_record({
  collection: "app.bsky.feed.post",
  rkey: "3kexample",
})
```
## Generic XRPC

Use generic XRPC tools for AT Protocol methods not exposed as dedicated tools.

```js
var response = app.integrations.bluesky.xrpc_get({
  method: "app.bsky.actor.searchActors",
  params: {
    q: "opencompany",
    limit: 10,
  },
})

var created = app.integrations.bluesky.xrpc_post({
  method: "com.atproto.repo.createRecord",
  body: {
    repo: "did:plc:example",
    collection: "app.bsky.feed.post",
    record: {
      ["$type"]: "app.bsky.feed.post",
      text: "Via generic XRPC",
      createdAt: "2026-05-06T12:00:00Z",
    },
  },
})
```
## Multi-Account Usage

```js
app.integrations.bluesky.default.get_timeline({ limit: 10 })
app.integrations.bluesky.work.create_post({ text: "Work update" })
```