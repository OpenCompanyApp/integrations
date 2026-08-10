# Firebase — JavaScript API Reference

## list_projects

List all Firebase projects the caller has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Maximum number of projects to return (default: 100, max: 256) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```js
var result = app.integrations.firebase.list_projects({
  page_size: 50,
})

for (const project of (result.results || [])) {
  console.log(project.projectId + ": " + project.displayName)
}
```
---

## get_project

Get details of a specific Firebase project by its resource name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The project resource name (e.g. `"projects/my-project-id"`) |

### Example

```js
var result = app.integrations.firebase.get_project({
  name: "projects/my-project-id",
})

console.log("Project: " + result.displayName)
console.log("ID: " + result.projectId)
```
---

## list_databases

List Cloud Firestore databases in a Firebase project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | no | The parent project name (e.g. `"projects/my-project-id"`). Uses the configured project ID if omitted. |

### Example

```js
var result = app.integrations.firebase.list_databases({
  parent: "projects/my-project-id",
})

for (const db of (result.databases || [])) {
  console.log(db.name + " (" + db.locationId + ")")
}
```
---

## list_documents

List documents in a Firestore collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `collection_id` | string | yes | The collection ID to list documents from |
| `page_size` | integer | no | Maximum number of documents to return |
| `page_token` | string | no | Token for pagination from a previous list call |
| `order_by` | string | no | Field to order results by |

### Example

```js
var result = app.integrations.firebase.list_documents({
  parent: "projects/my-project/databases/(default)/documents",
  collection_id: "users",
  page_size: 20,
})

for (const doc of (result.documents || [])) {
  console.log(doc.name)
}
```
---

## list_collections

List collection IDs under a Firestore document or database root.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | The parent resource (e.g. `"projects/my-project/databases/(default)/documents"`) |
| `page_size` | integer | no | Maximum number of collection IDs to return |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```js
var result = app.integrations.firebase.list_collections({
  parent: "projects/my-project/databases/(default)/documents",
})

for (const id of (result.collectionIds || [])) {
  console.log("Collection: " + id)
}
```
---

## list_users

List users in a Firebase project via the Identity Toolkit API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_results` | integer | no | Maximum number of users to return (default: 1000, max: 1000) |
| `page_token` | string | no | Token for pagination from a previous list call |

### Example

```js
var result = app.integrations.firebase.list_users({
  max_results: 50,
})

for (const user of (result.users || [])) {
  console.log(user.localId + ": " + (user.email || "no email"))
}
```
---

## get_current_user

Get the currently authenticated OAuth2 user profile information.

### Parameters

None.

### Example

```js
var result = app.integrations.firebase.get_current_user({})

console.log("Name: " + (result.name || "unknown"))
console.log("Email: " + (result.email || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Firebase accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.firebase.list_projects({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.firebase.default.list_projects({ /* parameters */ })

// Named accounts
app.integrations.firebase.production.list_projects({ /* parameters */ })
app.integrations.firebase.staging.list_projects({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
