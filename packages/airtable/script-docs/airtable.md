# Airtable Integration

Namespace: `app.integrations.airtable`

Use this integration to read and write Airtable bases through the Web API. Configure an Airtable Personal Access Token or OAuth access token with the scopes required for the target base, records, schema, comments, or webhooks.

## Common Workflows

### List Records

```js
var result = app.integrations.airtable.list_records({
  base_id: "appXXXXXXXXXXXX",
  table: "Contacts",
  view: "Active",
  pageSize: 100,
})
```
The response contains `records` and may contain an `offset`. Pass the `offset` into the next call to continue pagination.

### Create or Update Records

```js
var created = app.integrations.airtable.create_record({
  base_id: "appXXXXXXXXXXXX",
  table: "Contacts",
  fields: {
    Name: "Ada Lovelace",
    Email: "ada@example.test",
  }
})

var updated = app.integrations.airtable.update_record({
  base_id: "appXXXXXXXXXXXX",
  table: "Contacts",
  record_id: "recXXXXXXXXXXXX",
  fields: {
    Status: "Active",
  }
})
```
For bulk writes, use `create_records`, `update_records`, or `upsert_records` with the Airtable `records` payload shape. Airtable limits record batch operations to small batches, so split large syncs before calling the tool.

### Inspect Schema

```js
var schema = app.integrations.airtable.get_base_schema({
  base_id: "appXXXXXXXXXXXX",
})
```
Schema metadata includes tables, fields, and views. Use table IDs and field IDs when changing schema with `create_table`, `update_table`, `create_field`, and `update_field`.

### Comments

```js
var comment = app.integrations.airtable.create_comment({
  base_id: "appXXXXXXXXXXXX",
  table: "Contacts",
  record_id: "recXXXXXXXXXXXX",
  text: "Follow up next week.",
})
```
The comment tools operate on a specific record: `list_comments`, `create_comment`, `update_comment`, and `delete_comment`.

### Webhooks

```js
var webhook = app.integrations.airtable.create_webhook({
  base_id: "appXXXXXXXXXXXX",
  payload: {
    notificationUrl: "https://example.test/airtable",
    specification: {
      options: {
        filters: {
          dataTypes: [ "tableData" ],
        }
      }
    }
  }
})
```
Use `list_webhook_payloads` to fetch payloads for a webhook. Airtable webhook payload delivery and retention have their own limits, so persist cursors and process payloads promptly.

## Coverage Notes

Focused tools cover authenticated user lookup, base listing, base schema metadata, table and field schema writes, record CRUD and bulk/upsert operations, record comments, base webhooks, webhook payloads, and raw `api_get`, `api_post`, `api_patch`, and `api_delete` escape hatches.

Airtable uses exact query parameter names such as `filterByFormula`, `maxRecords`, and `pageSize`. Use the `query` object for array-style parameters such as `fields[]`, `sort[]`, or `records[]` when a focused parameter is not listed.
