# ActiveCampaign JavaScript API Reference

Namespace: `app.integrations.activecampaign`

This integration targets the ActiveCampaign API v3 under `https://{account}.api-us1.com/api/3` and sends credentials with the `Api-Token` header. It covers common contact, tag, custom-field, list, deal, campaign, account, automation, note, user, and generic API workflows.

## Contacts And Lists

```js
var contacts = app.integrations.activecampaign.list_contacts({
  limit: 25,
  search: "person@example.test",
})

var contact = app.integrations.activecampaign.get_contact({ contact_id: 123 })

var synced = app.integrations.activecampaign.sync_contact({
  contact: {
    email: "person@example.test",
    firstName: "Person",
    lastName: "Example",
    phone: "+15555550100",
  }
})

app.integrations.activecampaign.add_contact_to_list({
  contact_id: 123,
  list_id: 5,
})
```
Use `sync_contact` when you want ActiveCampaign to create or update by email. Use `create_contact` only when you explicitly want the create endpoint.

## Tags And Custom Fields

```js
var tags = app.integrations.activecampaign.list_tags({
  params: { limit: 100 },
})

var tag = app.integrations.activecampaign.create_tag({
  tag: "vip",
  description: "High-value contact",
})

app.integrations.activecampaign.add_contact_tag({
  contact_id: 123,
  tag_id: tag.tag.id,
})

var fields = app.integrations.activecampaign.list_fields({
  params: { limit: 100 },
})

app.integrations.activecampaign.create_field_value({
  contact_id: 123,
  field_id: 42,
  value: "Enterprise",
})
```
`remove_contact_tag` expects the contact-tag relationship ID, not the tag ID. List a contact's tags first when you need that relationship ID.

## Deals And Accounts

```js
var pipelines = app.integrations.activecampaign.list_deal_groups({})
var stages = app.integrations.activecampaign.list_deal_stages({})

var deal = app.integrations.activecampaign.create_deal({
  title: "Expansion",
  value: 25000,
  contact_id: 123,
  stage: 7,
})

var accounts = app.integrations.activecampaign.list_accounts({
  params: { limit: 50 },
})
```
Deal status values follow ActiveCampaign's v3 API: `0` open, `1` won, `2` lost. Some accounts require Deals permissions for deal endpoints.

## Campaigns, Messages, Automations, And Users

```js
var campaigns = app.integrations.activecampaign.list_campaigns({
  params: { limit: 20 },
})

var campaign = app.integrations.activecampaign.get_campaign({
  campaign_id: 123,
})

var messages = app.integrations.activecampaign.list_messages({})
var automations = app.integrations.activecampaign.list_automations({})
var user = app.integrations.activecampaign.get_current_user({})
```
Campaign and message tools are read-only wrappers for inspection/reporting workflows. Use generic API helpers for less-common campaign subresources.

## Generic API Helpers

```js
var raw = app.integrations.activecampaign.api_get({
  path: "/contacts",
  params: { limit: 1 },
})

var posted = app.integrations.activecampaign.api_post({
  path: "/tags",
  payload: { tag: { tag: "customer" } },
})
```
Generic helpers call documented `/api/3` endpoints directly:

- `api_get({ path, params? })`
- `api_post({ path, payload? })`
- `api_put({ path, payload? })`
- `api_delete({ path, payload? })`

Prefer named tools where available because they validate IDs and shape the common payloads.

## Multi-Account Usage

```js
app.integrations.activecampaign.list_contacts({})
app.integrations.activecampaign.default.list_contacts({})
app.integrations.activecampaign.production.list_contacts({})
```
All account namespaces expose the same tools; only stored credentials differ.
