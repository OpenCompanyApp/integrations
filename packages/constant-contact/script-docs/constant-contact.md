# Constant Contact Ruby API Reference

Namespace: `app.integrations["constant-contact"]`

The Constant Contact integration targets the V3 API. It uses OAuth Bearer tokens stored by the host.

## Contacts

```ruby
contacts = app.call("integrations.constant-contact.list", status: "active", limit: 100)
contact = app.call("integrations.constant-contact.get", contact_id: "contact_123")
created = app.call("integrations.constant-contact.create", email: "person@example.test", first_name: "Example", list_ids: ["list_123"])
```
Use `create_or_update_contact` when you want Constant Contact's sign-up form create-or-update behavior and can provide the full V3 payload.

## Lists, Tags, Custom Fields

```ruby
lists = app.call("integrations.constant-contact.list_lists")
list = app.call("integrations.constant-contact.get_list", list_id: "list_123")
tags = app.call("integrations.constant-contact.list_tags")
fields = app.call("integrations.constant-contact.list_custom_fields")
```
List create/update/delete tools are write operations.

## Campaigns And Reports

```ruby
campaigns = app.call("integrations.constant-contact.list_campaigns", limit: 20)
campaign = app.call("integrations.constant-contact.get_campaign", campaign_id: "campaign_123")
activity = app.call("integrations.constant-contact.get_campaign_activity", activity_id: "activity_123")
sends = app.call("integrations.constant-contact.email_sends_report", activity_id: "activity_123", params: {limit: 100})
```
First-class report tools cover sends, bounces, and clicks. Use `api_get` for other tracking report endpoints such as opens, forwards, or opt-outs.

## Segments And Activities

```ruby
segments = app.call("integrations.constant-contact.list_segments")
segment = app.call("integrations.constant-contact.get_segment", segment_id: "segment_123")
activities = app.call("integrations.constant-contact.list_activities")
activity_status = app.call("integrations.constant-contact.get_activity", activity_id: "activity_bulk_123")
```
## Account

```ruby
account = app.call("integrations.constant-contact.constantcontact_get_account_summary", params: {extra_fields: "physical_address,company_logo"})
privileges = app.call("integrations.constant-contact.get_user_privileges")
```
`get_current_user` is retained as a compatibility alias for account summary.

## Long-Tail Endpoints

```ruby
opens = app.call("integrations.constant-contact.api_get", path: "/reports/email_reports/activity_123/tracking/opens")
exportResult = app.call("integrations.constant-contact.api_post", path: "/activities/contact_exports", payload: {file_type: "CSV"})
```
Generic API tools accept relative paths only.

## Multi-Account Usage

```ruby
app.call("integrations.constant-contact.list")
app.call("integrations.constant-contact.default.list")
app.call("integrations.constant-contact.marketing.list_campaigns")
```
All functions are identical across accounts; only credentials differ.
