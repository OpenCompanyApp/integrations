# HubSpot — Ruby API Reference

## Overview

The HubSpot integration provides 26 tools for managing contacts, companies, deals, tickets, associations, engagements, and CRM metadata. All calls go through `app.integrations.hubspot.<tool_name>({ ... })` and return a Ruby object.

## Authentication

HubSpot uses a **Private App Access Token** (format: `pat-...`) with Bearer token authentication. The token is configured once in the integration settings and sent automatically on every request — you never pass it in Ruby calls.

Create a token: **HubSpot → Settings → Integrations → Private Apps → Create a private app**

## Object Types

HubSpot CRM objects are referenced by type string throughout the API:

| Type String   | Object   |
|---------------|----------|
| `contacts`    | Contact  |
| `companies`   | Company  |
| `deals`       | Deal     |
| `tickets`     | Ticket   |

These type strings are used in associations, pipelines, and properties endpoints.

## Pagination

List endpoints (`list_deals`, `list_owners`, `list_forms`) use **cursor-based pagination**. Pass `after` from a previous response to fetch the next page:

```ruby
# First page
page1 = app.integrations.hubspot.list_deals(limit: 50)
# Next page
if page1.after
  page2 = app.integrations.hubspot.list_deals(limit: 50, after: page1.after)
end
```
The `after` field is `nil` when there are no more results.

## Common Properties

HubSpot uses internal property names. The most common ones:

| Object  | Property Name        | Description              |
|---------|----------------------|--------------------------|
| Contact | `firstname`          | First name               |
| Contact | `lastname`           | Last name                |
| Contact | `email`              | Email address            |
| Contact | `phone`              | Phone number             |
| Contact | `company`            | Company name             |
| Company | `name`               | Company name             |
| Company | `domain`             | Website domain           |
| Deal    | `dealname`           | Deal name                |
| Deal    | `amount`             | Deal amount              |
| Deal    | `pipeline`           | Pipeline ID              |
| Deal    | `dealstage`          | Stage ID within pipeline |
| Deal    | `closedate`          | Expected close date      |
| Deal    | `hubspot_owner_id`   | Assigned owner ID        |
| Ticket  | `subject`            | Ticket subject/title     |
| Ticket  | `content`            | Ticket body/description  |
| Ticket  | `hs_pipeline`        | Ticket pipeline ID       |
| Ticket  | `hs_pipeline_stage`  | Ticket pipeline stage ID |

Use `list_properties` to discover all available properties for any object type.

---

## Contacts

### `app.integrations.hubspot.create_contact(...)`

Create a new contact in HubSpot CRM. Returns the contact's HubSpot ID and properties.

```ruby
contact = app.integrations.hubspot.create_contact(first_name: "Jane", last_name: "Smith", email: "jane@example.com", phone: "+1-555-0123", company: "Acme Corp")
```
Pass custom properties via the `properties` table:

```ruby
contact = app.integrations.hubspot.create_contact(first_name: "Jane", email: "jane@example.com", properties: {jobtitle: "CTO", city: "San Francisco", lifecyclestage: "lead"})
```
| Parameter     | Type   | Required | Description                                      |
|---------------|--------|----------|--------------------------------------------------|
| `first_name`  | string | no       | Contact first name (maps to `firstname`)         |
| `last_name`   | string | no       | Contact last name (maps to `lastname`)           |
| `email`       | string | no       | Contact email address                            |
| `phone`       | string | no       | Contact phone number                             |
| `company`     | string | no       | Contact company name                             |
| `properties`  | object | no       | Additional custom properties as key-value pairs  |

> At least one property is required.

---

### `app.integrations.hubspot.get_contact(...)`

Retrieve a HubSpot contact by ID. Optionally specify which properties to return.

```ruby
contact = app.integrations.hubspot.get_contact(id: "12345")
```
Fetch only specific properties to reduce response size:

```ruby
contact = app.integrations.hubspot.get_contact(id: "12345", properties: ["firstname", "lastname", "email"])
```
| Parameter    | Type          | Required | Description                                      |
|--------------|---------------|----------|--------------------------------------------------|
| `id`         | string        | yes      | HubSpot contact ID                               |
| `properties` | array<string> | no       | List of property names to include                |

---

### `app.integrations.hubspot.update_contact(...)`

Update an existing HubSpot contact. Only the properties you pass are changed.

```ruby
result = app.integrations.hubspot.update_contact(id: "12345", properties: {phone: "+1-555-9999", jobtitle: "VP Engineering"})
```
| Parameter    | Type   | Required | Description                                      |
|--------------|--------|----------|--------------------------------------------------|
| `id`         | string | yes      | HubSpot contact ID                               |
| `properties` | object | yes      | Properties to update as key-value pairs          |

---

### `app.integrations.hubspot.search_contacts(...)`

Search HubSpot contacts with filters. Pass a query string for text search or structured filter groups.

```ruby
results = app.integrations.hubspot.search_contacts(query: "jane@example.com", properties: ["firstname", "lastname", "email"], limit: 10)
```
Search with structured filters:

```ruby
results = app.integrations.hubspot.search_contacts(properties: ["firstname", "lastname", "email", "lifecyclestage"], limit: 25, filter_groups: [{filters: [{property_name: "lifecyclestage", operator: "EQ", value: "marketingqualifiedlead"}]}])
```
| Parameter       | Type          | Required | Description                                  |
|-----------------|---------------|----------|----------------------------------------------|
| `query`         | string        | no       | Text search across contact properties        |
| `properties`    | array<string> | no       | Property names to include in results         |
| `limit`         | integer       | no       | Max results to return                        |
| `filter_groups` | array         | no       | Structured filter groups for advanced search |

---

### `app.integrations.hubspot.delete_contact(...)`

Permanently delete a HubSpot contact by ID. **This action cannot be undone.**

```ruby
result = app.integrations.hubspot.delete_contact(id: "12345")
```
| Parameter | Type   | Required | Description              |
|-----------|--------|----------|--------------------------|
| `id`      | string | yes      | HubSpot contact ID       |

---

### `app.integrations.hubspot.create_or_update_contact(...)`

Create or update a contact matched by email. If a contact with that email exists, it is updated; otherwise a new one is created. The response includes an `action` field indicating what happened.

```ruby
result = app.integrations.hubspot.create_or_update_contact(email: "jane@example.com", first_name: "Jane", last_name: "Smith", phone: "+1-555-0123", company: "Acme Corp")
```
Include custom properties:

```ruby
result = app.integrations.hubspot.create_or_update_contact(email: "jane@example.com", first_name: "Jane", properties: {jobtitle: "CTO", city: "Berlin"})
```
| Parameter    | Type   | Required | Description                                      |
|--------------|--------|----------|--------------------------------------------------|
| `email`      | string | yes      | Email address used for lookup and matching        |
| `first_name` | string | no       | Contact first name                               |
| `last_name`  | string | no       | Contact last name                                |
| `phone`      | string | no       | Contact phone number                             |
| `company`    | string | no       | Contact company name                             |
| `properties` | object | no       | Additional custom properties as key-value pairs   |

---

## Companies

### `app.integrations.hubspot.create_company(...)`

Create a new company in HubSpot CRM.

```ruby
company = app.integrations.hubspot.create_company(name: "Acme Corp", domain: "acme.com")
```
With custom properties:

```ruby
company = app.integrations.hubspot.create_company(name: "Acme Corp", domain: "acme.com", properties: {industry: "TECHNOLOGY", city: "New York", description: "A technology company"})
```
| Parameter    | Type   | Required | Description                                      |
|--------------|--------|----------|--------------------------------------------------|
| `name`       | string | no       | Company name                                      |
| `domain`     | string | no       | Company website domain                            |
| `properties` | object | no       | Additional custom properties as key-value pairs   |

> At least one company property is required.

---

### `app.integrations.hubspot.get_company(...)`

Retrieve a HubSpot company by ID.

```ruby
company = app.integrations.hubspot.get_company(id: "67890")
```
With specific properties:

```ruby
company = app.integrations.hubspot.get_company(id: "67890", properties: ["name", "domain", "industry"])
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot company ID                  |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_company(...)`

Update an existing HubSpot company.

```ruby
result = app.integrations.hubspot.update_company(id: "67890", properties: {industry: "FINANCE", city: "London"})
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot company ID                      |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

### `app.integrations.hubspot.search_companies(...)`

Search HubSpot companies with filters. Pass a query string for text search or structured filter groups.

```ruby
results = app.integrations.hubspot.search_companies(query: "Acme", properties: ["name", "domain", "industry"], limit: 10)
```
| Parameter       | Type          | Required | Description                                  |
|-----------------|---------------|----------|----------------------------------------------|
| `query`         | string        | no       | Text search across company properties        |
| `properties`    | array<string> | no       | Property names to include in results         |
| `limit`         | integer       | no       | Max results to return                        |
| `filter_groups` | array         | no       | Structured filter groups for advanced search |

---

## Deals

### `app.integrations.hubspot.create_deal(...)`

Create a new deal in HubSpot CRM.

```ruby
deal = app.integrations.hubspot.create_deal(dealname: "Enterprise License Deal", amount: "50000", pipeline: "default", dealstage: "appointmentscheduled", closedate: "2026-06-30")
```
With custom properties:

```ruby
deal = app.integrations.hubspot.create_deal(dealname: "Partner Deal", amount: "25000", properties: {deal_type: "newbusiness", description: "Partner referral"})
```
| Parameter    | Type   | Required | Description                                            |
|--------------|--------|----------|--------------------------------------------------------|
| `dealname`   | string | no       | Deal name                                              |
| `amount`     | string | no       | Deal amount                                            |
| `pipeline`   | string | no       | Pipeline ID or internal name                           |
| `dealstage`  | string | no       | Deal stage ID or internal name                         |
| `closedate`  | string | no       | Expected close date (ISO 8601 or milliseconds)         |
| `properties` | object | no       | Additional custom properties as key-value pairs        |

> At least one deal property is required.

---

### `app.integrations.hubspot.get_deal(...)`

Retrieve a HubSpot deal by ID.

```ruby
deal = app.integrations.hubspot.get_deal(id: "99999")
```
With specific properties:

```ruby
deal = app.integrations.hubspot.get_deal(id: "99999", properties: ["dealname", "amount", "dealstage", "pipeline"])
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot deal ID                     |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_deal(...)`

Update an existing HubSpot deal. Commonly used to move deals through pipeline stages.

```ruby
result = app.integrations.hubspot.update_deal(id: "99999", properties: {dealstage: "closedwon", amount: "55000", closedate: "2026-04-05"})
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot deal ID                         |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

### `app.integrations.hubspot.list_deals(...)`

List deals with cursor-based pagination.

```ruby
page = app.integrations.hubspot.list_deals(limit: 50, properties: ["dealname", "amount", "dealstage", "closedate"])
```
Fetch the next page:

```ruby
if page.after
  page2 = app.integrations.hubspot.list_deals(limit: 50, after: page.after, properties: ["dealname", "amount", "dealstage"])
end
```
| Parameter    | Type          | Required | Description                              |
|--------------|---------------|----------|------------------------------------------|
| `limit`      | integer       | no       | Max deals to return (default 10, max 100)|
| `after`      | string        | no       | Pagination cursor from previous response |
| `properties` | array<string> | no       | Property names to include in results     |

---

## Tickets

### `app.integrations.hubspot.create_ticket(...)`

Create a new ticket in HubSpot CRM.

```ruby
ticket = app.integrations.hubspot.create_ticket(subject: "Login page !loading", content: "Customer reports that the login page returns a 500 error since yesterday.", hs_pipeline: "0", hs_pipeline_stage: "1")
```
With custom properties:

```ruby
ticket = app.integrations.hubspot.create_ticket(subject: "Billing inquiry", content: "Customer wants to upgrade their plan.", properties: {priority: "HIGH", source_type: "PHONE"})
```
| Parameter            | Type   | Required | Description                                   |
|----------------------|--------|----------|-----------------------------------------------|
| `subject`            | string | yes      | Ticket subject / title                        |
| `content`            | string | no       | Ticket body content / description             |
| `hs_pipeline`        | string | no       | Pipeline ID for the ticket                    |
| `hs_pipeline_stage`  | string | no       | Pipeline stage ID for the ticket              |
| `properties`         | object | no       | Additional custom properties as key-value pairs|

---

### `app.integrations.hubspot.get_ticket(...)`

Retrieve a HubSpot ticket by ID.

```ruby
ticket = app.integrations.hubspot.get_ticket(id: "55555")
```
With specific properties:

```ruby
ticket = app.integrations.hubspot.get_ticket(id: "55555", properties: ["subject", "content", "hs_pipeline_stage", "priority"])
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot ticket ID                   |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_ticket(...)`

Update an existing HubSpot ticket. Commonly used to change ticket status/pipeline stage.

```ruby
result = app.integrations.hubspot.update_ticket(id: "55555", properties: {hs_pipeline_stage: "4", content: "Issue resolved. Fix deployed in v2.3.1."})
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot ticket ID                       |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

## Associations & Metadata

### `app.integrations.hubspot.create_association(...)`

Associate two HubSpot CRM objects. Both objects must already exist.

```ruby
result = app.integrations.hubspot.create_association(from_type: "contacts", from_id: "12345", to_type: "companies", to_id: "67890", association_type: "contact_to_company")
```
Associate a deal to a company:

```ruby
app.integrations.hubspot.create_association(from_type: "deals", from_id: "99999", to_type: "companies", to_id: "67890", association_type: "deal_to_company")
```
Associate a ticket to a contact:

```ruby
app.integrations.hubspot.create_association(from_type: "tickets", from_id: "55555", to_type: "contacts", to_id: "12345", association_type: "ticket_to_contact")
```
Common association types:
- `contact_to_company`
- `company_to_contact`
- `deal_to_company`
- `deal_to_contact`
- `ticket_to_contact`
- `ticket_to_company`

| Parameter          | Type   | Required | Description                                            |
|--------------------|--------|----------|--------------------------------------------------------|
| `from_type`        | string | yes      | Source object type (`contacts`, `companies`, `deals`, `tickets`) |
| `from_id`          | string | yes      | Source object ID                                       |
| `to_type`          | string | yes      | Target object type                                     |
| `to_id`            | string | yes      | Target object ID                                       |
| `association_type` | string | yes      | Association type name (e.g., `contact_to_company`)    |

---

### `app.integrations.hubspot.list_associations(...)`

List all associations from an object to a specific target type.

```ruby
result = app.integrations.hubspot.list_associations(from_type: "contacts", from_id: "12345", to_type: "companies")
```
List deals associated with a company:

```ruby
result = app.integrations.hubspot.list_associations(from_type: "companies", from_id: "67890", to_type: "deals")
```
| Parameter   | Type   | Required | Description                                            |
|-------------|--------|----------|--------------------------------------------------------|
| `from_type` | string | yes      | Source object type                                     |
| `from_id`   | string | yes      | Source object ID                                       |
| `to_type`   | string | yes      | Target object type to find associations for            |

---

### `app.integrations.hubspot.list_owners(...)`

List HubSpot CRM owners (users). Useful for assigning owners to contacts, deals, and tickets.

```ruby
result = app.integrations.hubspot.list_owners()
```
Paginate through all owners:

```ruby
page = app.integrations.hubspot.list_owners(limit: 100)
if page.after
  page2 = app.integrations.hubspot.list_owners(limit: 100, after: page.after)
end
```
| Parameter | Type    | Required | Description                               |
|-----------|---------|----------|-------------------------------------------|
| `limit`   | integer | no       | Max owners to return (default 100)        |
| `after`   | string  | no       | Pagination cursor from previous response  |

---

### `app.integrations.hubspot.create_engagement(...)`

Create a note, task, or meeting engagement in HubSpot CRM.

**Create a note:**

```ruby
note = app.integrations.hubspot.create_engagement(type: "notes", body: "<p>Customer called to discuss pricing for enterprise plan.</p>", owner_id: "101")
```
**Create a task:**

```ruby
task = app.integrations.hubspot.create_engagement(type: "tasks", body: "Send follow-up proposal to the client", owner_id: "101", properties: {hs_task_subject: "Follow-up proposal", hs_task_status: "NOT_STARTED", hs_task_priority: "HIGH"})
```
**Create a meeting:**

```ruby
meeting = app.integrations.hubspot.create_engagement(type: "meetings", body: "Quarterly review meeting", timestamp: "2026-04-15T10:00:00", owner_id: "101", properties: {hs_meeting_title: "Q2 Review", hs_meeting_start_time: "2026-04-15T10:00:00", hs_meeting_end_time: "2026-04-15T11:00:00"})
```
| Parameter    | Type   | Required | Description                                                       |
|--------------|--------|----------|-------------------------------------------------------------------|
| `type`       | string | yes      | Engagement type: `"notes"`, `"tasks"`, or `"meetings"`            |
| `body`       | string | no       | Body content (HTML for notes, plain text for tasks/meetings)      |
| `timestamp`  | string | no       | Engagement timestamp in ISO 8601 format                           |
| `owner_id`   | string | no       | HubSpot owner ID to assign the engagement to                      |
| `properties` | object | no       | Additional properties (see task/meeting-specific props above)     |

---

### `app.integrations.hubspot.list_pipelines(...)`

List all CRM pipelines and their stages for a given object type. Use this to discover pipeline and stage IDs.

```ruby
result = app.integrations.hubspot.list_pipelines(object_type: "deals")
```
List ticket pipelines:

```ruby
result = app.integrations.hubspot.list_pipelines(object_type: "tickets")
```
| Parameter      | Type   | Required | Description                                     |
|----------------|--------|----------|-------------------------------------------------|
| `object_type`  | string | yes      | Object type: `"deals"` or `"tickets"`           |

---

### `app.integrations.hubspot.list_properties(...)`

List all property definitions for a given CRM object type. Useful to discover available property names, types, and options.

```ruby
result = app.integrations.hubspot.list_properties(object_type: "contacts")
```
Discover deal properties:

```ruby
result = app.integrations.hubspot.list_properties(object_type: "deals")
```
| Parameter      | Type   | Required | Description                                              |
|----------------|--------|----------|----------------------------------------------------------|
| `object_type`  | string | yes      | Object type: `"contacts"`, `"companies"`, `"deals"`, or `"tickets"` |

---

### `app.integrations.hubspot.add_contact_to_list(...)`

Add contacts to a HubSpot marketing list by ID or email. Contacts already in the list are silently skipped.

```ruby
result = app.integrations.hubspot.add_contact_list(list_id: "42", contact_ids: ["12345", "12346"])
```
Add by email addresses:

```ruby
result = app.integrations.hubspot.add_contact_list(list_id: "42", emails: ["jane@example.com", "bob@example.com"])
```
Mix IDs and emails:

```ruby
result = app.integrations.hubspot.add_contact_list(list_id: "42", contact_ids: ["12345"], emails: ["newuser@example.com"])
```
| Parameter     | Type          | Required | Description                                         |
|---------------|---------------|----------|-----------------------------------------------------|
| `list_id`     | string        | yes      | HubSpot list ID to add contacts to                  |
| `contact_ids` | array<string> | no*      | Array of HubSpot contact IDs                        |
| `emails`      | array<string> | no*      | Array of email addresses                            |

> *At least one of `contact_ids` or `emails` is required.*

---

### `app.integrations.hubspot.list_forms(...)`

List HubSpot marketing forms. Returns form IDs, names, types, and timestamps.

```ruby
result = app.integrations.hubspot.list_forms()
```
With pagination:

```ruby
page1 = app.integrations.hubspot.list_forms(limit: 50)
if page1.after
  page2 = app.integrations.hubspot.list_forms(limit: 50, after: page1.after)
end
```
| Parameter | Type    | Required | Description                              |
|-----------|---------|----------|------------------------------------------|
| `limit`   | integer | no       | Max forms to return (default 50)         |
| `after`   | string  | no       | Pagination cursor from previous response |

---

## Common Workflows

### Create a deal with contact and company

```ruby
# Step 1: Create the company
company = app.integrations.hubspot.create_company(name: "Acme Corp", domain: "acme.com")
# Step 2: Create the contact
contact = app.integrations.hubspot.create_contact(first_name: "Jane", last_name: "Smith", email: "jane@acme.com", phone: "+1-555-0123")
# Step 3: Associate contact to company
app.integrations.hubspot.create_association(from_type: "contacts", from_id: contact.id, to_type: "companies", to_id: company.id, association_type: "contact_to_company")
# Step 4: Create the deal
deal = app.integrations.hubspot.create_deal(dealname: "Acme Enterprise License", amount: "50000", pipeline: "default", dealstage: "appointmentscheduled")
# Step 5: Associate deal to company and contact
app.integrations.hubspot.create_association(from_type: "deals", from_id: deal.id, to_type: "companies", to_id: company.id, association_type: "deal_to_company")
app.integrations.hubspot.create_association(from_type: "deals", from_id: deal.id, to_type: "contacts", to_id: contact.id, association_type: "deal_to_contact")
# Step 6: Add a note to the contact
app.integrations.hubspot.create_engagement(type: "notes", body: "<p>Initial meeting scheduled for next week. Enterprise deal opportunity.</p>", owner_id: "101")
```
### Search and update a contact

```ruby
# Find a contact by email
results = app.integrations.hubspot.search_contacts(query: "jane@acme.com", properties: ["firstname", "lastname", "email", "phone", "lifecyclestage"], limit: 1)
if (results.results.length > 0)
  contact = results.results[0]
  # Update lifecycle stage
  app.integrations.hubspot.update_contact(id: contact.id, properties: {lifecyclestage: "salesqualifiedlead", phone: "+1-555-9999"})
end
```
### Move a deal through the pipeline

```ruby
# Step 1: Get available pipelines and stages
pipelines = app.integrations.hubspot.list_pipelines(object_type: "deals")
# Step 2: Find the target stage ID
target_stage_id = nil
pipelines.results.each do |pipeline|
  if (pipeline.id == "default")
    pipeline.stages.each do |stage|
      if (stage.label == "Contract Sent")
        target_stage_id = stage.id
      end
    end
  end
end
# Step 3: Move the deal
if target_stage_id
  app.integrations.hubspot.update_deal(id: "99999", properties: {dealstage: target_stage_id})
end
```
### Create a ticket and link it to a contact

```ruby
# Create the ticket
ticket = app.integrations.hubspot.create_ticket(subject: "Cannot access billing portal", content: "Customer reports 403 error when navigating to /billing.", hs_pipeline: "0", hs_pipeline_stage: "1")
# Associate with the reporting contact
app.integrations.hubspot.create_association(from_type: "tickets", from_id: ticket.id, to_type: "contacts", to_id: "12345", association_type: "ticket_to_contact")
# Add an internal note
app.integrations.hubspot.create_engagement(type: "notes", body: "<p>Verified billing portal permissions. escalated to engineering.</p>")
```
### Idempotent contact sync (create or update)

```ruby
# Sync contact data from an external source
result = app.integrations.hubspot.create_or_update_contact(email: "jane@acme.com", first_name: "Jane", last_name: "Smith", properties: {jobtitle: "VP Engineering", city: "Berlin", lifecyclestage: "opportunity"})
# result.action is "created" or "updated" so you can log what happened
puts("Contact " + (result.id).to_s + " was " + (result.action).to_s)
```
### Discover CRM schema

```ruby
# List all contact properties to find available field names
props = app.integrations.hubspot.list_properties(object_type: "contacts")
props.results.each do |prop|
  puts((prop.name).to_s + " (" + (prop.label).to_s + ") — " + (prop.type).to_s)
end
# List owners to find IDs for assignment
owners = app.integrations.hubspot.list_owners()
owners.results.each do |owner|
  puts((owner.id).to_s + ": " + (owner.first_name).to_s + " " + (owner.last_name).to_s + " <" + (owner.email).to_s + ">")
end
# List pipelines to find stage IDs
pipelines = app.integrations.hubspot.list_pipelines(object_type: "deals")
pipelines.results.each do |pipeline|
  puts("Pipeline: " + (pipeline.label).to_s)
  pipeline.stages.each do |stage|
    puts("  " + (stage.id).to_s + " → " + (stage.label).to_s)
  end
end
```
## Notes

- **Property names are case-sensitive** — HubSpot uses lowercase with underscores internally (e.g., `firstname`, not `firstName` or `FirstName`).
- **The `properties` parameter** in create/update tools accepts an object with string keys and string values. Pass custom fields the same way as standard ones.
- **IDs are strings** — HubSpot object IDs are always passed and returned as strings.
- **Timestamps** — HubSpot stores timestamps as milliseconds since epoch. ISO 8601 date strings are accepted where noted and converted automatically.
- **Associations are separate from creation** — After creating a contact, company, or deal, you must explicitly call `create_association` to link them. Associations are not set through properties.
- **Use `list_properties`** to discover available fields, and **`list_pipelines`** to find valid pipeline and stage IDs — these vary per HubSpot account.
- **Use `create_or_update_contact`** instead of `create_contact` when you want idempotent upserts by email — this avoids duplicates.
- **All list endpoints** return a `results` array. Check for the `after` field to determine if more pages are available.
- **Engagements require explicit association** — After creating a note, task, or meeting, you may need to associate it with contacts/deals/companies separately depending on your workflow.

---

## Multi-Account Usage

If you have multiple hubspot accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
