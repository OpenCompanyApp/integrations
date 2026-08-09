# HubSpot — JavaScript API Reference

## Overview

The HubSpot integration provides 26 tools for managing contacts, companies, deals, tickets, associations, engagements, and CRM metadata. All calls go through `app.integrations.hubspot.<tool_name>({ ... })` and return a JavaScript object.

## Authentication

HubSpot uses a **Private App Access Token** (format: `pat-...`) with Bearer token authentication. The token is configured once in the integration settings and sent automatically on every request — you never pass it in JavaScript calls.

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

```js
// First page
var page1 = app.integrations.hubspot.list_deals({ limit: 50 })

// Next page
if (page1.after) {
  var page2 = app.integrations.hubspot.list_deals({ limit: 50, after: page1.after })
}
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

```js
var contact = app.integrations.hubspot.create_contact({
  first_name: "Jane",
  last_name: "Smith",
  email: "jane@example.com",
  phone: "+1-555-0123",
  company: "Acme Corp",
})
// contact.id          → "12345"
// contact.properties  → { firstname: "Jane", lastname: "Smith", email: "jane@example.com"}
```
Pass custom properties via the `properties` table:

```js
var contact = app.integrations.hubspot.create_contact({
  first_name: "Jane",
  email: "jane@example.com",
  properties: {
    jobtitle: "CTO",
    city: "San Francisco",
    lifecyclestage: "lead",
  }
})
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

```js
var contact = app.integrations.hubspot.get_contact({
  id: "12345",
})
// contact.id          → "12345"
// contact.properties  → { firstname: "Jane", email: "jane@example.com"}
```
Fetch only specific properties to reduce response size:

```js
var contact = app.integrations.hubspot.get_contact({
  id: "12345",
  properties: [ "firstname", "lastname", "email" ],
})
```
| Parameter    | Type          | Required | Description                                      |
|--------------|---------------|----------|--------------------------------------------------|
| `id`         | string        | yes      | HubSpot contact ID                               |
| `properties` | array<string> | no       | List of property names to include                |

---

### `app.integrations.hubspot.update_contact(...)`

Update an existing HubSpot contact. Only the properties you pass are changed.

```js
var result = app.integrations.hubspot.update_contact({
  id: "12345",
  properties: {
    phone: "+1-555-9999",
    jobtitle: "VP Engineering",
  }
})
// result.id          → "12345"
// result.properties  → { phone: "+1-555-9999", jobtitle: "VP Engineering"}
```
| Parameter    | Type   | Required | Description                                      |
|--------------|--------|----------|--------------------------------------------------|
| `id`         | string | yes      | HubSpot contact ID                               |
| `properties` | object | yes      | Properties to update as key-value pairs          |

---

### `app.integrations.hubspot.search_contacts(...)`

Search HubSpot contacts with filters. Pass a query string for text search or structured filter groups.

```js
var results = app.integrations.hubspot.search_contacts({
  query: "jane@example.com",
  properties: [ "firstname", "lastname", "email" ],
  limit: 10,
})
// results.results  → { { id: "12345", properties: { /* parameters */ } }}
```
Search with structured filters:

```js
var results = app.integrations.hubspot.search_contacts({
  properties: [ "firstname", "lastname", "email", "lifecyclestage" ],
  limit: 25,
  filter_groups: [
    {
      filters: [
        {
          property_name: "lifecyclestage",
          operator: "EQ",
          value: "marketingqualifiedlead",
        }
      ]
    }
  ]
})
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

```js
var result = app.integrations.hubspot.delete_contact({
  id: "12345",
})
// result.id      → "12345"
// result.deleted → true
```
| Parameter | Type   | Required | Description              |
|-----------|--------|----------|--------------------------|
| `id`      | string | yes      | HubSpot contact ID       |

---

### `app.integrations.hubspot.create_or_update_contact(...)`

Create or update a contact matched by email. If a contact with that email exists, it is updated; otherwise a new one is created. The response includes an `action` field indicating what happened.

```js
var result = app.integrations.hubspot.create_or_update_contact({
  email: "jane@example.com",
  first_name: "Jane",
  last_name: "Smith",
  phone: "+1-555-0123",
  company: "Acme Corp",
})
// result.id       → "12345"
// result.action   → "created"  (or "updated")
// result.properties  → { firstname: "Jane", email: "jane@example.com"}
```
Include custom properties:

```js
var result = app.integrations.hubspot.create_or_update_contact({
  email: "jane@example.com",
  first_name: "Jane",
  properties: {
    jobtitle: "CTO",
    city: "Berlin",
  }
})
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

```js
var company = app.integrations.hubspot.create_company({
  name: "Acme Corp",
  domain: "acme.com",
})
// company.id          → "67890"
// company.properties  → { name: "Acme Corp", domain: "acme.com"}
```
With custom properties:

```js
var company = app.integrations.hubspot.create_company({
  name: "Acme Corp",
  domain: "acme.com",
  properties: {
    industry: "TECHNOLOGY",
    city: "New York",
    description: "A technology company",
  }
})
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

```js
var company = app.integrations.hubspot.get_company({
  id: "67890",
})
// company.id          → "67890"
// company.properties  → { name: "Acme Corp", domain: "acme.com"}
```
With specific properties:

```js
var company = app.integrations.hubspot.get_company({
  id: "67890",
  properties: [ "name", "domain", "industry" ],
})
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot company ID                  |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_company(...)`

Update an existing HubSpot company.

```js
var result = app.integrations.hubspot.update_company({
  id: "67890",
  properties: {
    industry: "FINANCE",
    city: "London",
  }
})
// result.id          → "67890"
// result.properties  → { industry: "FINANCE", city: "London"}
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot company ID                      |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

### `app.integrations.hubspot.search_companies(...)`

Search HubSpot companies with filters. Pass a query string for text search or structured filter groups.

```js
var results = app.integrations.hubspot.search_companies({
  query: "Acme",
  properties: [ "name", "domain", "industry" ],
  limit: 10,
})
// results.results  → { { id: "67890", properties: { /* parameters */ } }}
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

```js
var deal = app.integrations.hubspot.create_deal({
  dealname: "Enterprise License Deal",
  amount: "50000",
  pipeline: "default",
  dealstage: "appointmentscheduled",
  closedate: "2026-06-30",
})
// deal.id          → "99999"
// deal.properties  → { dealname: "Enterprise License Deal", amount: "50000"}
```
With custom properties:

```js
var deal = app.integrations.hubspot.create_deal({
  dealname: "Partner Deal",
  amount: "25000",
  properties: {
    deal_type: "newbusiness",
    description: "Partner referral",
  }
})
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

```js
var deal = app.integrations.hubspot.get_deal({
  id: "99999",
})
// deal.id          → "99999"
// deal.properties  → { dealname: "Enterprise License Deal", amount: "50000"}
```
With specific properties:

```js
var deal = app.integrations.hubspot.get_deal({
  id: "99999",
  properties: [ "dealname", "amount", "dealstage", "pipeline" ],
})
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot deal ID                     |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_deal(...)`

Update an existing HubSpot deal. Commonly used to move deals through pipeline stages.

```js
var result = app.integrations.hubspot.update_deal({
  id: "99999",
  properties: {
    dealstage: "closedwon",
    amount: "55000",
    closedate: "2026-04-05",
  }
})
// result.id          → "99999"
// result.properties  → { dealstage: "closedwon", amount: "55000"}
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot deal ID                         |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

### `app.integrations.hubspot.list_deals(...)`

List deals with cursor-based pagination.

```js
var page = app.integrations.hubspot.list_deals({
  limit: 50,
  properties: [ "dealname", "amount", "dealstage", "closedate" ],
})
// page.results  → { { id: "99999", properties: { /* parameters */ } }}
// page.total    → 50
// page.after    → "eyJuZXh0IjoiMTAwIn0"  (cursor for next page, nil if last page)
```
Fetch the next page:

```js
if (page.after) {
  var page2 = app.integrations.hubspot.list_deals({
    limit: 50,
    after: page.after,
    properties: [ "dealname", "amount", "dealstage" ],
  })
}
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

```js
var ticket = app.integrations.hubspot.create_ticket({
  subject: "Login page !loading",
  content: "Customer reports that the login page returns a 500 error since yesterday.",
  hs_pipeline: "0",
  hs_pipeline_stage: "1",
})
// ticket.id          → "55555"
// ticket.properties  → { subject: "Login page not loading", content: "..."}
```
With custom properties:

```js
var ticket = app.integrations.hubspot.create_ticket({
  subject: "Billing inquiry",
  content: "Customer wants to upgrade their plan.",
  properties: {
    priority: "HIGH",
    source_type: "PHONE",
  }
})
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

```js
var ticket = app.integrations.hubspot.get_ticket({
  id: "55555",
})
// ticket.id          → "55555"
// ticket.properties  → { subject: "Login page not loading", content: "..."}
```
With specific properties:

```js
var ticket = app.integrations.hubspot.get_ticket({
  id: "55555",
  properties: [ "subject", "content", "hs_pipeline_stage", "priority" ],
})
```
| Parameter    | Type          | Required | Description                         |
|--------------|---------------|----------|-------------------------------------|
| `id`         | string        | yes      | HubSpot ticket ID                   |
| `properties` | array<string> | no       | List of property names to include   |

---

### `app.integrations.hubspot.update_ticket(...)`

Update an existing HubSpot ticket. Commonly used to change ticket status/pipeline stage.

```js
var result = app.integrations.hubspot.update_ticket({
  id: "55555",
  properties: {
    hs_pipeline_stage: "4",
    content: "Issue resolved. Fix deployed in v2.3.1.",
  }
})
// result.id          → "55555"
// result.properties  → { hs_pipeline_stage: "4", content: "..."}
```
| Parameter    | Type   | Required | Description                             |
|--------------|--------|----------|-----------------------------------------|
| `id`         | string | yes      | HubSpot ticket ID                       |
| `properties` | object | yes      | Properties to update as key-value pairs |

---

## Associations & Metadata

### `app.integrations.hubspot.create_association(...)`

Associate two HubSpot CRM objects. Both objects must already exist.

```js
var result = app.integrations.hubspot.create_association({
  from_type: "contacts",
  from_id: "12345",
  to_type: "companies",
  to_id: "67890",
  association_type: "contact_to_company",
})
// result.from_type        → "contacts"
// result.from_id          → "12345"
// result.to_type          → "companies"
// result.to_id            → "67890"
// result.association_type → "contact_to_company"
// result.created          → true
```
Associate a deal to a company:

```js
app.integrations.hubspot.create_association({
  from_type: "deals",
  from_id: "99999",
  to_type: "companies",
  to_id: "67890",
  association_type: "deal_to_company",
})
```
Associate a ticket to a contact:

```js
app.integrations.hubspot.create_association({
  from_type: "tickets",
  from_id: "55555",
  to_type: "contacts",
  to_id: "12345",
  association_type: "ticket_to_contact",
})
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

```js
var result = app.integrations.hubspot.list_associations({
  from_type: "contacts",
  from_id: "12345",
  to_type: "companies",
})
// result.from_type  → "contacts"
// result.from_id    → "12345"
// result.to_type    → "companies"
// result.results    → { { id: "67890", type: "contact_to_company" }}
```
List deals associated with a company:

```js
var result = app.integrations.hubspot.list_associations({
  from_type: "companies",
  from_id: "67890",
  to_type: "deals",
})
```
| Parameter   | Type   | Required | Description                                            |
|-------------|--------|----------|--------------------------------------------------------|
| `from_type` | string | yes      | Source object type                                     |
| `from_id`   | string | yes      | Source object ID                                       |
| `to_type`   | string | yes      | Target object type to find associations for            |

---

### `app.integrations.hubspot.list_owners(...)`

List HubSpot CRM owners (users). Useful for assigning owners to contacts, deals, and tickets.

```js
var result = app.integrations.hubspot.list_owners({})
// result.results  → {
//   { id: "101", email: "sarah@acme.com", first_name: "Sarah", last_name: "Jones", user_id: 201 },
//   { id: "102", email: "mike@acme.com", first_name: "Mike", last_name: "Chen", user_id: 202 },
// }
```
Paginate through all owners:

```js
var page = app.integrations.hubspot.list_owners({ limit: 100 })
if (page.after) {
  var page2 = app.integrations.hubspot.list_owners({ limit: 100, after: page.after })
}
```
| Parameter | Type    | Required | Description                               |
|-----------|---------|----------|-------------------------------------------|
| `limit`   | integer | no       | Max owners to return (default 100)        |
| `after`   | string  | no       | Pagination cursor from previous response  |

---

### `app.integrations.hubspot.create_engagement(...)`

Create a note, task, or meeting engagement in HubSpot CRM.

**Create a note:**

```js
var note = app.integrations.hubspot.create_engagement({
  type: "notes",
  body: "<p>Customer called to discuss pricing for enterprise plan.</p>",
  owner_id: "101",
})
// note.id          → "77777"
// note.type        → "notes"
// note.properties  → { hs_note_body: "...", hubspot_owner_id: "101"}
```
**Create a task:**

```js
var task = app.integrations.hubspot.create_engagement({
  type: "tasks",
  body: "Send follow-up proposal to the client",
  owner_id: "101",
  properties: {
    hs_task_subject: "Follow-up proposal",
    hs_task_status: "NOT_STARTED",
    hs_task_priority: "HIGH",
  }
})
```
**Create a meeting:**

```js
var meeting = app.integrations.hubspot.create_engagement({
  type: "meetings",
  body: "Quarterly review meeting",
  timestamp: "2026-04-15T10:00:00",
  owner_id: "101",
  properties: {
    hs_meeting_title: "Q2 Review",
    hs_meeting_start_time: "2026-04-15T10:00:00",
    hs_meeting_end_time: "2026-04-15T11:00:00",
  }
})
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

```js
var result = app.integrations.hubspot.list_pipelines({
  object_type: "deals",
})
// result.results  → {
//   {
//     id = "default",
//     label = "Sales Pipeline",
//     stages = {
//       { id: "appointmentscheduled", label: "Appointment Scheduled" },
//       { id: "qualifiedtobuy", label: "Qualified to Buy" },
//       { id: "presentationscheduled", label: "Presentation Scheduled" },
//       { id: "contractsent", label: "Contract Sent" },
//       { id: "closedwon", label: "Closed Won" },
//       { id: "closedlost", label: "Closed Lost" },
//     }
//   }
// }
```
List ticket pipelines:

```js
var result = app.integrations.hubspot.list_pipelines({
  object_type: "tickets",
})
```
| Parameter      | Type   | Required | Description                                     |
|----------------|--------|----------|-------------------------------------------------|
| `object_type`  | string | yes      | Object type: `"deals"` or `"tickets"`           |

---

### `app.integrations.hubspot.list_properties(...)`

List all property definitions for a given CRM object type. Useful to discover available property names, types, and options.

```js
var result = app.integrations.hubspot.list_properties({
  object_type: "contacts",
})
// result.results  → {
//   { name: "firstname", label: "First Name", type: "string"},
//   { name: "lastname", label: "Last Name", type: "string"},
//   { name: "email", label: "Email", type: "string"},
//   { name: "lifecyclestage", label: "Lifecycle Stage", type: "enumeration",
//     options = { { value: "lead", label: "Lead" }} },
//   ...
// }
```
Discover deal properties:

```js
var result = app.integrations.hubspot.list_properties({
  object_type: "deals",
})
```
| Parameter      | Type   | Required | Description                                              |
|----------------|--------|----------|----------------------------------------------------------|
| `object_type`  | string | yes      | Object type: `"contacts"`, `"companies"`, `"deals"`, or `"tickets"` |

---

### `app.integrations.hubspot.add_contact_to_list(...)`

Add contacts to a HubSpot marketing list by ID or email. Contacts already in the list are silently skipped.

```js
var result = app.integrations.hubspot.add_contact_to_list({
  list_id: "42",
  contact_ids: [ "12345", "12346" ],
})
// result.list_id        → "42"
// result.updated        → { "12345", "12346" }
// result.discarded      → {}
// result.invalid_vids   → {}
// result.invalid_emails → {}
```
Add by email addresses:

```js
var result = app.integrations.hubspot.add_contact_to_list({
  list_id: "42",
  emails: [ "jane@example.com", "bob@example.com" ],
})
```
Mix IDs and emails:

```js
var result = app.integrations.hubspot.add_contact_to_list({
  list_id: "42",
  contact_ids: [ "12345" ],
  emails: [ "newuser@example.com" ],
})
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

```js
var result = app.integrations.hubspot.list_forms({})
// result.results  → {
//   { id: "abc123", name: "Contact Us", type: "HUBSPOT", created_at: 1712000000000, updated_at: 1712100000000 },
//   { id: "def456", name: "Newsletter Signup", type: "HUBSPOT", created_at: 1712200000000, updated_at: nil },
// }
```
With pagination:

```js
var page1 = app.integrations.hubspot.list_forms({ limit: 50 })
if (page1.after) {
  var page2 = app.integrations.hubspot.list_forms({ limit: 50, after: page1.after })
}
```
| Parameter | Type    | Required | Description                              |
|-----------|---------|----------|------------------------------------------|
| `limit`   | integer | no       | Max forms to return (default 50)         |
| `after`   | string  | no       | Pagination cursor from previous response |

---

## Common Workflows

### Create a deal with contact and company

```js
// Step 1: Create the company
var company = app.integrations.hubspot.create_company({
  name: "Acme Corp",
  domain: "acme.com",
})

// Step 2: Create the contact
var contact = app.integrations.hubspot.create_contact({
  first_name: "Jane",
  last_name: "Smith",
  email: "jane@acme.com",
  phone: "+1-555-0123",
})

// Step 3: Associate contact to company
app.integrations.hubspot.create_association({
  from_type: "contacts",
  from_id: contact.id,
  to_type: "companies",
  to_id: company.id,
  association_type: "contact_to_company",
})

// Step 4: Create the deal
var deal = app.integrations.hubspot.create_deal({
  dealname: "Acme Enterprise License",
  amount: "50000",
  pipeline: "default",
  dealstage: "appointmentscheduled",
})

// Step 5: Associate deal to company and contact
app.integrations.hubspot.create_association({
  from_type: "deals",
  from_id: deal.id,
  to_type: "companies",
  to_id: company.id,
  association_type: "deal_to_company",
})
app.integrations.hubspot.create_association({
  from_type: "deals",
  from_id: deal.id,
  to_type: "contacts",
  to_id: contact.id,
  association_type: "deal_to_contact",
})

// Step 6: Add a note to the contact
app.integrations.hubspot.create_engagement({
  type: "notes",
  body: "<p>Initial meeting scheduled for next week. Enterprise deal opportunity.</p>",
  owner_id: "101",
})
```
### Search and update a contact

```js
// Find a contact by email
var results = app.integrations.hubspot.search_contacts({
  query: "jane@acme.com",
  properties: [ "firstname", "lastname", "email", "phone", "lifecyclestage" ],
  limit: 1,
})

if (results.results.length > 0) {
  var contact = results.results[0]
  // Update lifecycle stage
  app.integrations.hubspot.update_contact({
    id: contact.id,
    properties: {
      lifecyclestage: "salesqualifiedlead",
      phone: "+1-555-9999",
    }
  })
}
```
### Move a deal through the pipeline

```js
// Step 1: Get available pipelines and stages
var pipelines = app.integrations.hubspot.list_pipelines({ object_type: "deals" })

// Step 2: Find the target stage ID
var target_stage_id = null
for (const pipeline of (pipelines.results)) {
  if (pipeline.id === "default") {
    for (const stage of (pipeline.stages)) {
      if (stage.label === "Contract Sent") {
        target_stage_id = stage.id
      }
    }
  }
}

// Step 3: Move the deal
if (target_stage_id) {
  app.integrations.hubspot.update_deal({
    id: "99999",
    properties: { dealstage: target_stage_id },
  })
}
```
### Create a ticket and link it to a contact

```js
// Create the ticket
var ticket = app.integrations.hubspot.create_ticket({
  subject: "Cannot access billing portal",
  content: "Customer reports 403 error when navigating to /billing.",
  hs_pipeline: "0",
  hs_pipeline_stage: "1",
})

// Associate with the reporting contact
app.integrations.hubspot.create_association({
  from_type: "tickets",
  from_id: ticket.id,
  to_type: "contacts",
  to_id: "12345",
  association_type: "ticket_to_contact",
})

// Add an internal note
app.integrations.hubspot.create_engagement({
  type: "notes",
  body: "<p>Verified billing portal permissions. escalated to engineering.</p>",
})
```
### Idempotent contact sync (create or update)

```js
// Sync contact data from an external source
var result = app.integrations.hubspot.create_or_update_contact({
  email: "jane@acme.com",
  first_name: "Jane",
  last_name: "Smith",
  properties: {
    jobtitle: "VP Engineering",
    city: "Berlin",
    lifecyclestage: "opportunity",
  }
})

// result.action is "created" or "updated" so you can log what happened
console.log("Contact " + result.id + " was " + result.action)
```
### Discover CRM schema

```js
// List all contact properties to find available field names
var props = app.integrations.hubspot.list_properties({ object_type: "contacts" })
for (const prop of (props.results)) {
  console.log(prop.name + " (" + prop.label + ") — " + prop.type)
}

// List owners to find IDs for assignment
var owners = app.integrations.hubspot.list_owners({})
for (const owner of (owners.results)) {
  console.log(owner.id + ": " + owner.first_name + " " + owner.last_name + " <" + owner.email + ">")
}

// List pipelines to find stage IDs
var pipelines = app.integrations.hubspot.list_pipelines({ object_type: "deals" })
for (const pipeline of (pipelines.results)) {
  console.log("Pipeline: " + pipeline.label)
  for (const stage of (pipeline.stages)) {
    console.log("  " + stage.id + " → " + stage.label)
  }
}
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

```js
// Default account (always works)
app.integrations.hubspot.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.hubspot.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.hubspot.work.function_name({ /* parameters */ })
app.integrations.hubspot.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
