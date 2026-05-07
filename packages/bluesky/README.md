# Bluesky Integration

Bluesky and AT Protocol XRPC tools for OpenCompany and KosmoKrator agents.

This package targets the Bluesky app lexicons and the AT Protocol XRPC shape
under `/xrpc/{method}`. It includes common typed tools plus generic XRPC GET and
POST tools for endpoints that do not need a dedicated wrapper yet.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `bluesky_create_post` | write | Create an `app.bsky.feed.post` record. |
| `bluesky_get_profile` | read | Get actor profile by handle or DID. |
| `bluesky_get_timeline` | read | Authenticated home timeline. |
| `bluesky_get_author_feed` | read | Posts and reposts by actor. |
| `bluesky_get_feed` | read | Posts from a feed generator URI. |
| `bluesky_get_feed_generator` | read | Feed generator metadata. |
| `bluesky_get_post_thread` | read | Thread rooted at a post URI. |
| `bluesky_get_posts` | read | Batch post lookup by URI. |
| `bluesky_get_likes` | read | Actors who liked a post. |
| `bluesky_get_reposted_by` | read | Actors who reposted a post. |
| `bluesky_list_followers` | read | Actor followers. |
| `bluesky_list_following` | read | Actor follows. |
| `bluesky_search_posts` | read | Search posts. |
| `bluesky_list_notifications` | read | Authenticated account notifications. |
| `bluesky_get_current_user` | read | Profile for configured DID. |
| `bluesky_create_record` | write | Generic `com.atproto.repo.createRecord`. |
| `bluesky_delete_record` | write | Generic `com.atproto.repo.deleteRecord`. |
| `bluesky_like_post` | write | Create an `app.bsky.feed.like` record. |
| `bluesky_repost_post` | write | Create an `app.bsky.feed.repost` record. |
| `bluesky_follow_actor` | write | Create an `app.bsky.graph.follow` record. |
| `bluesky_xrpc_get` | read | Generic GET XRPC call. |
| `bluesky_xrpc_post` | write | Generic POST XRPC call. |

## Configuration

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `access_token` | secret | yes | OAuth access token or AT Protocol session token. |
| `did` | string | yes | Authenticated account DID, required for repository writes. |
| `url` | url | no | PDS URL, default `https://bsky.social`. |

## Notes

- Repository write tools use the configured DID as the repo.
- Generic XRPC tools are intentionally included because AT Protocol lexicons are
  broad and host apps can safely pass method IDs plus params/body.
- GET XRPC array parameters are encoded as repeated query keys, matching
  endpoints such as `app.bsky.feed.getPosts`.
