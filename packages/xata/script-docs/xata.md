# Xata JavaScript API Reference

Namespace: `app.integrations.xata`

Configure an API key plus a database API endpoint such as `https://example.us-east-1.xata.sh`. Workspace management tools also need `workspace_id`.

## Workspace Management

```js
var databases = app.integrations.xata.list_databases({
  workspace_id: "ws_example",
})

var branch = app.integrations.xata.create_branch({
  workspace_id: "ws_example",
  database: "app",
  branch: "preview",
})
```
Tools:

- `list_databases({ workspace_id })`
- `create_database({ workspace_id, database, body })`
- `list_branches({ workspace_id, database })`
- `create_branch({ workspace_id, database, branch, body })`

## Schema

```js
var schema = app.integrations.xata.get_schema({
  database: "app",
  branch: "main",
})
```
Use `update_schema({ database, branch, body })` for schema changes. The body is passed through to Xata unchanged.

## Records

```js
var created = app.integrations.xata.insert_record({
  database: "app",
  branch: "main",
  table: "contacts",
  body: {
    name: "Ada Lovelace",
    email: "ada@example.test",
  }
})

var record = app.integrations.xata.get_record({
  database: "app",
  branch: "main",
  table: "contacts",
  record_id: created.id,
})
```
Record tools:

- `get_record`
- `insert_record`
- `update_record`
- `delete_record`

## Query, Search, Aggregates, And Transactions

```js
var rows = app.integrations.xata.query_table({
  database: "app",
  branch: "main",
  table: "contacts",
  body: {
    columns: [ "name", "email" ],
    page: { size: 25 },
  }
})

var search = app.integrations.xata.search_branch({
  database: "app",
  branch: "main",
  body: {
    query: "ada",
    tables: [ { table: "contacts" } ],
  }
})
```
Additional tools:

- `aggregate_table({ database, branch, table, body })`
- `vector_search({ database, branch, table, body })`
- `transaction({ database, branch, body })`

Responses are the normalized JSON returned by Xata.
