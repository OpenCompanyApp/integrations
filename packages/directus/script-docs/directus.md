# Directus JavaScript Docs

Namespace: `directus`

Directus tools call the official Directus REST API. Configure an instance URL and an access token before using protected endpoints. Public authentication and health endpoints are also exposed from the official OpenAPI source.

The integration now mirrors the official Directus OpenAPI package, including tools for activity, assets, authentication, items, presets, collections, comments, extensions, fields, files, flows, folders, operations, permissions, relations, revisions, roles, schema, server info, settings, users, utilities, and content versions.

Common tools:

```js
var items = directus.directus_list_items({
  collection: "articles",
  limit: 10,
  fields: [ "id", "title", "status" ],
})

var article = directus.directus_get_item({
  collection: "articles",
  id: "example-id",
})

var created = directus.directus_create_item({
  collection: "articles",
  body: {
    title: "Example",
    status: "draft",
  }
})
```
Request bodies can be passed as a `body` object. For JSON endpoints, loose arguments that are not path, query, or header parameters are also sent as the request body.

Directus returns most successful responses as `{ data = ... }` and may include `meta` for list endpoints when requested. Non-JSON responses, such as binary asset responses or exports, are returned as `{ body = "...", content_type = "..." }`.

Use fake collection names, ids, and instance URLs in examples and tests. Do not store real Directus tokens in JavaScript programs or committed fixtures.