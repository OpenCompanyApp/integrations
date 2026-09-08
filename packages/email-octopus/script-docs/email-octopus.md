# EmailOctopus - Ruby API Reference

Namespace: `app.integrations["email-octopus"]`

This integration targets the public EmailOctopus v1.6 API documentation. API v2
exists in EmailOctopus dashboards, but public method-level docs currently expose
the v1.6 routes.

## Lists, Tags, And Fields

```ruby
lists = app.call("integrations.email-octopus.list_lists", limit: 25, page: 1)
list = app.call("integrations.email-octopus.get_list", list_id: "list_123")
app.call("integrations.email-octopus.create_tag", list_id: "list_123", tag: "vip")
app.call("integrations.email-octopus.create_field", list_id: "list_123", tag: "Birthday", type: "DATE", label: "Birthday")
```
List-scoped tools use the configured default list ID when `list_id` is omitted.

## Contacts

```ruby
app.call("integrations.email-octopus.create_contact", list_id: "list_123", email_address: "reader@example.test", fields: {FirstName: "Ada"}, tags: ["vip"], status: "SUBSCRIBED")
contact = app.call("integrations.email-octopus.get_contact", list_id: "list_123", member_id: "member_123")
app.call("integrations.email-octopus.update_contact", list_id: "list_123", member_id: "member_123", tags: {vip: true, oldTag: false})
```
For `member_id`, EmailOctopus accepts either the list contact ID or the MD5 hash
of the lowercase email address.

Bulk update accepts up to 100 contact objects:

```ruby
app.call("integrations.email-octopus.update_contacts_bulk", list_id: "list_123", data: [{id: "member_123", status: "UNSUBSCRIBED"}])
```
## Campaigns And Reports

```ruby
campaigns = app.call("integrations.email-octopus.list_campaigns", limit: 50, page: 1)
summary = app.call("integrations.email-octopus.get_campaign_report_summary", campaign_id: "campaign_123")
opened = app.call("integrations.email-octopus.get_campaign_report_opened", campaign_id: "campaign_123", limit: 100, page: 1)
```
Report tools exist for `summary`, `links`, `bounced`, `clicked`, `complained`,
`opened`, `sent`, `unsubscribed`, `not-clicked`, and `not-opened`.

## Automations

```ruby
app.call("integrations.email-octopus.start_automation", automation_id: "automation_123", list_member_id: "member_123")
```
The automation must use EmailOctopus's "Started via API" trigger.

## Multi-Account Usage

```ruby
app.call("integrations.email-octopus.list_lists")
app.call("integrations.email-octopus.default.list_lists")
app.call("integrations.email-octopus.newsletter.list_lists")
```
All account namespaces expose the same tools; only credentials and default list
ID differ.
