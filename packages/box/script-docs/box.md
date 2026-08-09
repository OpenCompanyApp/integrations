# Box Integration

Box provides cloud content management APIs. This package exposes generated tools from the official Box OpenAPI document at `https://raw.githubusercontent.com/box/box-openapi/main/openapi.json`.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | Yes | Box OAuth2 access token or developer token sent as a Bearer token. |
| `url` | url | No | Box API base URL. Default is `https://api.box.com/2.0`. |
| `upload_url` | url | No | Box upload API base URL. Default is `https://upload.box.com/api/2.0`. |

## Usage Pattern

Tool names are generated from official Box operation IDs:

- `box_get_files_id`
- `box_get_folders_id_items`
- `box_post_files_content`
- `box_get_search`
- `box_get_users_me`

Path and query parameters are exposed as snake_case tool arguments. JSON and multipart request payloads are passed through `body` with Box's official field names.

```js
box_get_folders_id_items({
  folder_id: "0",
  limit: 100,
  fields: "id,type,name,size,modified_at",
})
```
```js
box_get_files_id({
  file_id: "12345",
  fields: "id,type,name,size,shared_link",
})
```
```js
box_get_search({
  query: "quarterly report",
  type: "file",
  limit: 25,
})
```
Multipart upload operations use the `upload_url` host. Provide multipart fields in `body`; local file paths are streamed when the value points to an existing file.

```js
box_post_files_content({
  body: {
    attributes: '{"name":"notes.txt","parent":{"id":"0"}}',
    file: "/tmp/notes.txt",
  }
})
```
Additional documented query parameters can be passed exactly as named through `query`.

```js
box_get_events({
  query: {
    stream_type: "admin_logs",
    limit: 100,
  }
})
```
## Return Shape

JSON responses are returned as parsed Box response objects. Non-JSON responses, such as file downloads, are returned as:

```js
const example = {
  body: "...",
  content_type: "application/octet-stream",
}
```
`204 No Content` responses return an empty object. Errors are normalized into tool errors that include the Box HTTP status and message when available.

## Notes

- This package covers the official Box Platform API operations from the OpenAPI spec: files, folders, users, groups, collaborations, metadata, tasks, comments, retention policies, legal holds, sign requests, webhooks, events, collections, and file requests.
- OAuth token issuance endpoints are present in the OpenAPI metadata, but this integration is configured for host-stored access tokens.
- Use fake file IDs, folder IDs, user IDs, URLs, and tokens in tests and examples.
