# Freshworks CRM Ruby API Reference

Namespace: `freshworks-crm`

Freshworks CRM tools call Freshsales/Freshworks CRM REST endpoints under a base URL ending in `/crm/sales`, for example `https://example.myfreshworks.com/crm/sales`.

## Contacts

```ruby
contacts = app.call("integrations.freshworks-crm.list_contacts", page: 1, per_page: 25)
contact = app.call("integrations.freshworks-crm.get_contact", id: 123)
created = app.call("integrations.freshworks-crm.create_contact", first_name: "Ada", last_name: "Example", email: "ada@example.test")
app.call("integrations.freshworks-crm.update_contact", id: 123, job_title: "VP Sales")
app.call("integrations.freshworks-crm.delete_contact", id: 123)
```
Contact filters and views:

```ruby
filters = app.call("integrations.freshworks-crm.list_contact_filters")
view = app.call("integrations.freshworks-crm.get_contact_view", view_id: 3, page: 1, per_page: 25)
```
## Sales Accounts And Deals

```ruby
accounts = app.call("integrations.freshworks-crm.list_accounts", page: 1)
account = app.call("integrations.freshworks-crm.create_account", name: "Example Corp", website: "https://example.test")
deals = app.call("integrations.freshworks-crm.list_deals", page: 1, per_page: 25)
deal = app.call("integrations.freshworks-crm.create_deal", name: "Example Renewal", amount: 25000, sales_account_id: 456)
```
Accounts and deals each have matching `get`, `update`, `delete`, filter-list, view, and bulk-upsert tools where supported by Freshworks CRM.

## Tasks And Appointments

```ruby
tasks = app.call("integrations.freshworks-crm.list_tasks", filter: "open", page: 1)
task = app.call("integrations.freshworks-crm.create_task", title: "Follow up", targetable_id: 123, targetable_type: "Contact")
appointments = app.call("integrations.freshworks-crm.list_appointments", filter: "upcoming")
appointment = app.call("integrations.freshworks-crm.create_appointment", title: "Discovery call", targetable_id: 123, targetable_type: "Contact")
```
Tasks and appointments each have matching `get`, `update`, and `delete` tools.

## Notes, Calls, And Activities

```ruby
note = app.call("integrations.freshworks-crm.create_note", description: "Buyer asked about implementation timeline.", targetable_id: 123, targetable_type: "Contact")
call = app.call("integrations.freshworks-crm.create_phone_call", targetable_id: 123, targetable_type: "Contact", phone_number: "+15550101010", direction: "outgoing")
activities = app.call("integrations.freshworks-crm.list_sales_activities", page: 1, per_page: 25)
activity = app.call("integrations.freshworks-crm.create_sales_activity", title: "Demo completed", targetable_id: 678, targetable_type: "Deal")
```
Notes and sales activities have matching `get`, `update`, and `delete` tools.

## Search And Metadata

```ruby
me = app.call("integrations.freshworks-crm.get_current_user")
results = app.call("integrations.freshworks-crm.search", q: "Example Corp")
lookup = app.call("integrations.freshworks-crm.lookup", q: "ada@example.test")
contact_fields = app.call("integrations.freshworks-crm.list_contact_fields")
account_fields = app.call("integrations.freshworks-crm.list_account_fields")
deal_fields = app.call("integrations.freshworks-crm.list_deal_fields")
activity_fields = app.call("integrations.freshworks-crm.list_sales_activity_fields")
```
## Multi-Account

Hosts can expose account-scoped namespaces. The functions are identical; only credentials differ.

```ruby
app.call("integrations.freshworks-crm.default.list_contacts", page: 1)
app.call("integrations.freshworks-crm.eu_team.list_deals", page: 1)
```