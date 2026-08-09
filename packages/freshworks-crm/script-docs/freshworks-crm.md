# Freshworks CRM JavaScript API Reference

Namespace: `freshworks-crm`

Freshworks CRM tools call Freshsales/Freshworks CRM REST endpoints under a base URL ending in `/crm/sales`, for example `https://example.myfreshworks.com/crm/sales`.

## Contacts

```js
var contacts = app.integrations["freshworks-crm"].freshworks_crm_list_contacts({
  page: 1,
  per_page: 25,
})

var contact = app.integrations["freshworks-crm"].freshworks_crm_get_contact({ id: 123 })

var created = app.integrations["freshworks-crm"].freshworks_crm_create_contact({
  first_name: "Ada",
  last_name: "Example",
  email: "ada@example.test",
})

app.integrations["freshworks-crm"].freshworks_crm_update_contact({
  id: 123,
  job_title: "VP Sales",
})

app.integrations["freshworks-crm"].freshworks_crm_delete_contact({ id: 123 })
```
Contact filters and views:

```js
var filters = app.integrations["freshworks-crm"].freshworks_crm_list_contact_filters({})

var view = app.integrations["freshworks-crm"].freshworks_crm_get_contact_view({
  view_id: 3,
  page: 1,
  per_page: 25,
})
```
## Sales Accounts And Deals

```js
var accounts = app.integrations["freshworks-crm"].freshworks_crm_list_accounts({ page: 1 })

var account = app.integrations["freshworks-crm"].freshworks_crm_create_account({
  name: "Example Corp",
  website: "https://example.test",
})

var deals = app.integrations["freshworks-crm"].freshworks_crm_list_deals({
  page: 1,
  per_page: 25,
})

var deal = app.integrations["freshworks-crm"].freshworks_crm_create_deal({
  name: "Example Renewal",
  amount: 25000,
  sales_account_id: 456,
})
```
Accounts and deals each have matching `get`, `update`, `delete`, filter-list, view, and bulk-upsert tools where supported by Freshworks CRM.

## Tasks And Appointments

```js
var tasks = app.integrations["freshworks-crm"].freshworks_crm_list_tasks({
  filter: "open",
  page: 1,
})

var task = app.integrations["freshworks-crm"].freshworks_crm_create_task({
  title: "Follow up",
  targetable_id: 123,
  targetable_type: "Contact",
})

var appointments = app.integrations["freshworks-crm"].freshworks_crm_list_appointments({
  filter: "upcoming",
})

var appointment = app.integrations["freshworks-crm"].freshworks_crm_create_appointment({
  title: "Discovery call",
  targetable_id: 123,
  targetable_type: "Contact",
})
```
Tasks and appointments each have matching `get`, `update`, and `delete` tools.

## Notes, Calls, And Activities

```js
var note = app.integrations["freshworks-crm"].freshworks_crm_create_note({
  description: "Buyer asked about implementation timeline.",
  targetable_id: 123,
  targetable_type: "Contact",
})

var call = app.integrations["freshworks-crm"].freshworks_crm_create_phone_call({
  targetable_id: 123,
  targetable_type: "Contact",
  phone_number: "+15550101010",
  direction: "outgoing",
})

var activities = app.integrations["freshworks-crm"].freshworks_crm_list_sales_activities({
  page: 1,
  per_page: 25,
})

var activity = app.integrations["freshworks-crm"].freshworks_crm_create_sales_activity({
  title: "Demo completed",
  targetable_id: 678,
  targetable_type: "Deal",
})
```
Notes and sales activities have matching `get`, `update`, and `delete` tools.

## Search And Metadata

```js
var me = app.integrations["freshworks-crm"].freshworks_crm_get_current_user({})

var results = app.integrations["freshworks-crm"].freshworks_crm_search({
  q: "Example Corp",
})

var lookup = app.integrations["freshworks-crm"].freshworks_crm_lookup({
  q: "ada@example.test",
})

var contact_fields = app.integrations["freshworks-crm"].freshworks_crm_list_contact_fields({})
var account_fields = app.integrations["freshworks-crm"].freshworks_crm_list_account_fields({})
var deal_fields = app.integrations["freshworks-crm"].freshworks_crm_list_deal_fields({})
var activity_fields = app.integrations["freshworks-crm"].freshworks_crm_list_sales_activity_fields({})
```
## Multi-Account

Hosts can expose account-scoped namespaces. The functions are identical; only credentials differ.

```js
app.integrations["freshworks-crm"].default.freshworks_crm_list_contacts({ page: 1 })
app.integrations["freshworks-crm"].eu_team.freshworks_crm_list_deals({ page: 1 })
```