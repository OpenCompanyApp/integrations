# SignNow JavaScript API Reference

Namespace: `app.integrations.signnow`

Use this integration to manage SignNow documents, templates, signing invites,
downloads, history, and relative API calls. Returned values are parsed JSON when
the API returns JSON. Binary or text download responses are returned as
`{ body = "..." }`.

## Documents

| Function | Purpose |
|----------|---------|
| `list_documents({ page?, per_page? })` | List documents from `/user/documentsv2`. |
| `get_document({ document_id })` | Get full document details. |
| `create_document({ file_path, file_name? })` | Upload a file and create a document. |
| `update_document({ document_id, payload })` | Update fields, text tags, checks, metadata, or other official document payload fields. |
| `delete_document({ document_id })` | Delete a document. |
| `download_document({ document_id, type? })` | Download a document. |
| `get_document_download_link({ document_id, type? })` | Get a temporary download link. |
| `get_document_history({ document_id })` | Get document event history. |
| `merge_documents({ document_ids, name?, payload? })` | Merge multiple documents into one document. |

Example:

```js
var docs = app.integrations.signnow.list_documents({ page: 1, per_page: 20 })

for (const doc of (docs.documents || [])) {
  console.log(doc.id + " " + (doc.document_name || doc.name || "Untitled"))
}
```
## Templates

| Function | Purpose |
|----------|---------|
| `list_templates({})` | List available templates. |
| `create_template({ document_id, template_name?, remove_original_document? })` | Create a template from a document. |
| `duplicate_template({ template_id, document_name? })` | Copy a template into a new document. |
| `delete_template({ template_id })` | Delete a template. |

## Invites

| Function | Purpose |
|----------|---------|
| `send_invite({ document_id, to, from, subject, message?, payload? })` | Send a simple signing invite. |
| `send_freeform_invite({ document_id, payload })` | Send a full official invite payload for advanced routing, roles, reminders, or multiple signers. |
| `cancel_field_invite({ document_id })` | Cancel active field invites for a document. |
| `cancel_freeform_invite({ invite_id })` | Cancel a free-form invite by invite ID. |

Use `send_invite` for simple one-recipient emails. Use
`send_freeform_invite` when you need official SignNow fields that are too large
or workflow-specific to model as first-class parameters.

## Generic API Helpers

| Function | Purpose |
|----------|---------|
| `api_get({ path, params? })` | Send GET to a relative SignNow API path. |
| `api_post({ path, payload? })` | Send POST to a relative SignNow API path. |
| `api_put({ path, payload? })` | Send PUT to a relative SignNow API path. |
| `api_delete({ path, payload? })` | Send DELETE to a relative SignNow API path. |

Generic helpers reject absolute URLs. Use paths such as `/document`,
`/document/{id}/invite`, or `/template/{id}/copy` so host credentials and base
URL handling stay centralized.

## Current User

`get_current_user({})` fetches the authenticated SignNow user from `/user`.
Use it to confirm which account the integration is connected to.

## Multi-Account Usage

All functions work under account-specific namespaces:

```js
app.integrations.signnow.list_documents({ page: 1 })
app.integrations.signnow.default.list_documents({ page: 1 })
app.integrations.signnow.legal.list_documents({})
```