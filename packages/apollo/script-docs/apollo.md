# Apollo.io Ruby Reference

Namespace: `apollo`

Apollo separates net-new database records from records saved to your team:

- `search_people` searches Apollo's people database.
- `search_contacts` searches contacts saved in your team account.
- `list_organizations` searches Apollo's organization database. The legacy slug
  is retained even though the upstream operation is Organization Search.
- `search_accounts` searches accounts saved in your team account.

Some endpoints require a master API key or plan-specific access. A `403` usually
means the key is valid but the Apollo account cannot use that endpoint.
Requests are authenticated with Apollo's `X-Api-Key` header, not a bearer token.

## Search And Enrichment

```ruby
people = app.integrations.apollo.search_people(q_keywords: "revenue operations", person_titles: ["VP Sales", "Head of Revenue"], page: 1, per_page: 10)
person = app.integrations.apollo.enrich_person(email: "person@example.test", reveal_personal_emails: false)
bulk_people = app.integrations.apollo.bulk_enrich_people(details: [{email: "one@example.test"}, {name: "Jane Example", domain: "example.test"}])
orgs = app.integrations.apollo.search_organizations(q_organization_name: "example", organization_locations: ["california"])
org = app.integrations.apollo.enrich_organization(domain: "example.test")
bulk_orgs = app.integrations.apollo.bulk_enrich_organizations(domains: ["example.test", "example.invalid"])
```
Use the `filters` object for documented Apollo filters that do not have a named
parameter in this package:

```ruby
result = app.integrations.apollo.search_people(filters: {person_seniorities: ["director", "vp"], organization_num_employees_ranges: ["100,250"]}, per_page: 25)
```
## Contacts

```ruby
contacts = app.integrations.apollo.search_contacts(q_keywords: "example", page: 1, per_page: 10)
contact = app.integrations.apollo.view_contact(contact_id: "66e34b81740c50074e3d1bd4")
created = app.integrations.apollo.create_contact(first_name: "Jane", last_name: "Example", email: "jane@example.test", organization_name: "Example Inc", run_dedupe: true)
updated = app.integrations.apollo.update_contact(contact_id: "66e34b81740c50074e3d1bd4", title: "VP Sales")
stages = app.integrations.apollo.list_contact_stages()
```
## Accounts

```ruby
accounts = app.integrations.apollo.search_accounts(q_organization_name: "example", page: 1)
account = app.integrations.apollo.view_account(account_id: "6518c6184f20350001a0b9c0")
created = app.integrations.apollo.create_account(name: "Example Inc", domain: "example.test")
updated = app.integrations.apollo.update_account(account_id: "6518c6184f20350001a0b9c0", account_stage_id: "6095a710bd01d100a506d4b9")
stages = app.integrations.apollo.list_account_stages()
```
## Team Metadata

```ruby
usage = app.integrations.apollo.get_api_usage_stats()
users = app.integrations.apollo.list_users()
email_accounts = app.integrations.apollo.list_email_accounts()
```
## Normalized Output

Tools return Apollo's JSON response with only transport errors normalized. Agents
should inspect the upstream keys such as `people`, `contacts`, `organizations`,
`accounts`, `pagination`, or endpoint-specific result arrays.
