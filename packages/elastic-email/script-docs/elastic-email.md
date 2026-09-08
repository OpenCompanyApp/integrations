# Elastic Email Ruby API Reference

Namespace: `app.integrations["elastic-email"]`

Elastic Email tools use REST API v4. API keys are sent with `X-ElasticEmail-ApiKey`.

## Email

```ruby
sent = app.call("integrations.elastic-email.send_transactional", to: "person@example.test", subject: "Welcome", body: "<p>Hello</p>", from: "sender@example.test")
status = app.call("integrations.elastic-email.get_status", transaction_id: "tx_123")
```
`send_bulk_email` accepts a full Elastic Email v4 email payload under `payload`.

## Contacts And Lists

```ruby
contacts = app.call("integrations.elastic-email.list_contacts", limit: 50)
contact = app.call("integrations.elastic-email.get_contact", email: "person@example.test")
created = app.call("integrations.elastic-email.create_contact", email: "person@example.test", list_name: "Newsletter", first_name: "Example")
lists = app.call("integrations.elastic-email.list_lists")
members = app.call("integrations.elastic-email.list_list_contacts", name: "Newsletter")
```
Use `add_contacts_to_list` and `remove_contacts_from_list` with comma- or semicolon-separated email addresses.

## Campaigns, Events, Suppressions

```ruby
campaigns = app.call("integrations.elastic-email.list_campaigns")
campaign = app.call("integrations.elastic-email.get_campaign", name: "Launch")
events = app.call("integrations.elastic-email.elasticemail_list_events", params: {limit: 100})
suppressions = app.call("integrations.elastic-email.list_suppressions", type: "bounces")
```
Suppression `type` must be `unsubscribes`, `bounces`, or `complaints`.

## Templates, Statistics, Files

```ruby
templates = app.call("integrations.elastic-email.list_templates", limit: 20)
template = app.call("integrations.elastic-email.get_template", id: "welcome")
stats = app.call("integrations.elastic-email.get_statistics")
campaign_stats = app.call("integrations.elastic-email.get_campaign_statistics", name: "Launch")
files = app.call("integrations.elastic-email.list_files")
```
The `id` field for `get_template` is the template name in the v4 path.

## Long-Tail Endpoints

```ruby
domains = app.call("integrations.elastic-email.api_get", path: "/domains")
exportResult = app.call("integrations.elastic-email.api_post", path: "/contacts/export", payload: {FileFormat: "Csv"})
```
Generic API tools accept relative paths only.

## Multi-Account Usage

```ruby
app.call("integrations.elastic-email.send_transactional")
app.call("integrations.elastic-email.default.send_transactional")
app.call("integrations.elastic-email.marketing.list_campaigns")
```
All functions are identical across accounts; only credentials differ.
