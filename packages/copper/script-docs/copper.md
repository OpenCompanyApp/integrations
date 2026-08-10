# Copper CRM JavaScript API Reference

Namespace: `copper`

Copper calls contact records "People" in the official API. This package keeps the existing `contact` tool names for agent compatibility while routing them to Copper `/people` endpoints.

## Authentication

Copper requires:

- `api_key`
- `email`
- optional `url`, defaulting to `https://api.copper.com/developer_api/v1`

## People / Contacts

```js
var people = app.integrations.copper.list_contacts({
  page_size: 25,
  page_number: 1,
  sort_by: "name",
})

var person = app.integrations.copper.get_contact({ id: 123 })

var by_email = app.integrations.copper.get_contact_by_email({
  email: "ada@example.test",
})

var created = app.integrations.copper.create_contact({
  name: "Ada Example",
  email: "ada@example.test",
})

var updated = app.integrations.copper.update_contact({
  id: 123,
  name: "Ada Lovelace",
})

app.integrations.copper.delete_contact({ id: 123 })
```
## Companies

```js
var companies = app.integrations.copper.list_companies({
  page_size: 25,
  sort_by: "name",
})

var company = app.integrations.copper.get_company({ id: 456 })

var created = app.integrations.copper.create_company({
  name: "Example Corp",
})

app.integrations.copper.update_company({
  id: 456,
  details: "Enterprise account",
})

app.integrations.copper.delete_company({ id: 456 })
```
## Opportunities

```js
var opportunities = app.integrations.copper.list_opportunities({
  page_size: 25,
  pipeline_ids: [ 10 ],
})

var opportunity = app.integrations.copper.get_opportunity({ id: 789 })

var created = app.integrations.copper.create_opportunity({
  name: "Example renewal",
  pipeline_id: 10,
})

app.integrations.copper.update_opportunity({
  id: 789,
  monetary_value: 250000,
  win_probability: 70,
})

app.integrations.copper.delete_opportunity({ id: 789 })
```
## Leads

```js
var leads = app.integrations.copper.list_leads({
  page_size: 25,
  email: "buyer@example.test",
})

var lead = app.integrations.copper.get_lead({ id: 111 })

var created = app.integrations.copper.create_lead({
  name: "Buyer Example",
  company_name: "Example Corp",
  status_id: 222,
})

app.integrations.copper.update_lead({
  id: 111,
  details: "Qualified inbound lead",
})

app.integrations.copper.delete_lead({ id: 111 })
```
## Projects And Tasks

```js
var projects = app.integrations.copper.list_projects({
  page_size: 25,
})

var project = app.integrations.copper.create_project({
  name: "Implementation",
  company_id: 456,
})

var tasks = app.integrations.copper.list_tasks({
  page_size: 25,
  status: "open",
})

var task = app.integrations.copper.create_task({
  name: "Follow up",
  assignee_id: 333,
  related_resource: { type: "company", id: 456 },
})
```
Each project and task also has matching `get`, `update`, and `delete` tools.

## Activities

```js
var activities = app.integrations.copper.list_activities({
  page_size: 25,
  parent: { type: "person", id: 123 },
})

var activity = app.integrations.copper.create_activity({
  parent: { type: "person", id: 123 },
  type: { category: "user", id: 1 },
  details: "Discussed renewal timing.",
})

var types = app.integrations.copper.list_activity_types({})
```
Activities also support `get_activity`, `update_activity`, and `delete_activity`.

## Users, Pipelines, And Metadata

```js
var me = app.integrations.copper.get_current_user({})
var users = app.integrations.copper.list_users({ page_size: 50 })
var account = app.integrations.copper.get_account_details({})

var pipelines = app.integrations.copper.list_pipelines({})
var stages = app.integrations.copper.list_pipeline_stages({})
var stages_for_pipeline = app.integrations.copper.list_pipeline_stages_in_pipeline({
  pipeline_id: 10,
})

var lead_statuses = app.integrations.copper.list_lead_statuses({})
var sources = app.integrations.copper.list_customer_sources({})
var loss_reasons = app.integrations.copper.list_loss_reasons({})
var contact_types = app.integrations.copper.list_contact_types({})
var tags = app.integrations.copper.list_tags({})
var custom_fields = app.integrations.copper.list_custom_field_definitions({})
```
## Webhooks

```js
var hooks = app.integrations.copper.list_webhooks({})

var hook = app.integrations.copper.create_webhook({
  target: "https://example.test/hooks/copper",
  type: "person",
  event: "updated",
})

var fetched = app.integrations.copper.get_webhook({ id: 1001 })

app.integrations.copper.update_webhook({
  id: 1001,
  target: "https://example.test/hooks/copper-v2",
})

app.integrations.copper.delete_webhook({ id: 1001 })
```
## Multi-Account

Hosts can expose account-scoped namespaces. The functions are identical; only credentials differ.

```js
app.integrations.copper.default.list_contacts({ page_size: 10 })
app.integrations.copper.sales.list_opportunities({ page_size: 10 })
```