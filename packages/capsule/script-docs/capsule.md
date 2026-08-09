# Capsule CRM JavaScript API Reference

Namespace: `app.integrations.capsule`

Capsule CRM tools use the v2 REST API. The integration returns the JSON shape that Capsule returns, usually wrapped in keys such as `party`, `parties`, `opportunity`, `opportunities`, `kase`, `kases`, `task`, `tasks`, `tags`, or `definitions`.

## Parties

Parties are Capsule contacts and organisations.

```js
var parties = app.integrations.capsule.list_contacts({
  page: 1,
  per_page: 50,
})

var party = app.integrations.capsule.get_contact({ id: 123 })

app.integrations.capsule.create_contact({
  type: "person",
  firstName: "Jane",
  lastName: "Doe",
  emailAddresses: [
    { address: "jane@example.test" }
  ]
})

app.integrations.capsule.update_contact({
  id: 123,
  party: {
    firstName: "Janet",
  }
})
```
## Opportunities

```js
var opportunities = app.integrations.capsule.list_opportunities({
  status: "OPEN",
  page: 1,
  per_page: 100,
})

var party_opportunities = app.integrations.capsule.list_party_opportunities({
  party_id: 123,
  params: { embed: "party,milestone,tags,fields" },
})

app.integrations.capsule.create_opportunity({
  opportunity: {
    name: "New deal",
    party: { id: 123 },
    value: { amount: 25000, currency: "USD" },
  }
})
```
## Cases

Capsule calls projects "kases" in the API path.

```js
var cases = app.integrations.capsule.list_cases({
  params: { page: 1, perPage: 50, embed: "party,tags,fields" },
})

app.integrations.capsule.create_case({
  kase: {
    name: "Implementation",
    party: { id: 123 },
  }
})
```
## Tasks

```js
var tasks = app.integrations.capsule.list_tasks({
  status: "OPEN",
  page: 1,
  per_page: 50,
})

app.integrations.capsule.create_task({
  task: {
    description: "Follow up",
    dueOn: "2026-05-15",
  }
})
```
## Tracks, Tags, And Custom Fields

Tags and custom fields use an `entity` argument. Valid entity values are `parties`, `opportunities`, and `kases`; aliases such as `contacts`, `cases`, and `projects` are normalized.

```js
var tracks = app.integrations.capsule.list_tracks({})

var tags = app.integrations.capsule.list_tags({
  entity: "parties",
})

var fields = app.integrations.capsule.list_custom_fields({
  entity: "opportunities",
})
```
Use tag and field mutation tools only when managing account schema, not when adding values to a record. To add tag or custom field values to a party, opportunity, or case, update that record with the correct Capsule payload.

## Raw API Helpers

Use `api_get`, `api_post`, `api_put`, and `api_delete` for relative paths below the configured Capsule API v2 base URL. Full URLs and parent-directory paths are rejected.

```js
var response = app.integrations.capsule.api_get({
  path: "/parties",
  query: { q: "Acme" },
})
```
## Multi-Account

```js
app.integrations.capsule.production.list_contacts({})
app.integrations.capsule.staging.list_contacts({})
```