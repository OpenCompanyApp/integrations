# Appwrite - Lua API Reference

Namespace: `app.integrations.appwrite`

This integration uses the Appwrite server REST API with `X-Appwrite-Key` and `X-Appwrite-Project` headers. Configure the Appwrite Cloud endpoint, for example `https://cloud.appwrite.io/v1`, or a self-hosted `/v1` endpoint.

## Coverage

Tools cover the main server-side Appwrite surfaces:

- Databases: list, create, get, update, delete databases.
- Collections: list, create, get, update, delete collections.
- Documents: list, create, get, update, delete documents.
- Users: list, create, get, enable or block, delete users.
- Teams: list, create, get, delete teams, and list memberships.
- Storage: list, create, get, update, delete buckets; list, get, delete files.
- Functions: list and get functions; create, list, and get executions.
- Messaging: list providers, topics, and messages; create or delete topics; create email and push messages.

## Query Parameters

Appwrite's REST API accepts `queries` arrays generated with Appwrite's Query helpers. Pass those query strings directly:

```lua
local users = app.integrations.appwrite.list_users({
  queries = {'limit(25)', 'orderDesc("$createdAt")'},
  search = "ada"
})
```

## Databases

```lua
local database = app.integrations.appwrite.create_database({
  database_id = "crm",
  name = "CRM"
})

local collection = app.integrations.appwrite.create_collection({
  database_id = "crm",
  collection_id = "contacts",
  name = "Contacts",
  permissions = {"read(\"any\")"},
  document_security = true
})

local document = app.integrations.appwrite.create_document({
  database_id = "crm",
  collection_id = "contacts",
  document_id = "unique()",
  data = {
    name = "Ada Example",
    email = "ada@example.test"
  }
})
```

Existing database/document tools use snake_case arguments such as `database_id`, `collection_id`, and `document_id`. New tools keep the same convention and map to Appwrite's camelCase REST fields internally.

## Users And Teams

```lua
local user = app.integrations.appwrite.create_user({
  user_id = "unique()",
  email = "ada@example.test",
  password = "replace-with-generated-secret",
  name = "Ada Example"
})

app.integrations.appwrite.update_user_status({
  user_id = user["$id"],
  status = false
})

local team = app.integrations.appwrite.create_team({
  team_id = "ops",
  name = "Operations",
  roles = {"owner"}
})
```

## Storage

```lua
local bucket = app.integrations.appwrite.create_bucket({
  bucket_id = "imports",
  name = "Imports",
  file_security = true,
  maximum_file_size = 10485760,
  allowed_file_extensions = {"csv", "json"}
})

local files = app.integrations.appwrite.list_files({
  bucket_id = "imports",
  queries = {'limit(10)'}
})
```

File upload/download endpoints are intentionally not wrapped here because they need multipart or binary response handling. Use storage metadata tools to inspect and clean up files from agents.

## Functions

```lua
local execution = app.integrations.appwrite.create_execution({
  function_id = "sync_contacts",
  body = '{"dry_run":true}',
  async = false,
  method = "POST"
})
```

Function execution `body` is a string because Appwrite passes it to the function runtime as request body content.

## Messaging

```lua
local topic = app.integrations.appwrite.create_topic({
  topic_id = "product_updates",
  name = "Product updates",
  subscribe = {"user:example"}
})

local email = app.integrations.appwrite.create_email({
  message_id = "unique()",
  subject = "Status update",
  content = "Deployment completed.",
  users = {"user_123"},
  draft = true
})
```

Messaging provider setup is provider-specific, so the integration exposes list operations for providers and message/topic operations that are safe to drive from agents.

## Return Shapes

Responses are the normalized Appwrite REST JSON payloads. Collection list endpoints usually return `total` plus an array named for the resource, such as `databases`, `collections`, `documents`, `users`, `teams`, `buckets`, `files`, `functions`, `executions`, `topics`, or `messages`.

## Multi-Account Usage

```lua
app.integrations.appwrite.list_databases({})
app.integrations.appwrite.default.list_databases({})
app.integrations.appwrite.production.list_databases({})
```

All account namespaces expose the same tools; only credentials differ.
