# Loops - Ruby API Reference

Namespace: `app.integrations.loops`

The Loops API lets agents manage contacts, send events, send transactional
email, read mailing lists and contact properties, manage suppression status, and
inspect sending configuration.

## Contacts

```ruby
app.integrations.loops.create_contact(email: "reader@example.test", first_name: "Ada", last_name: "Lovelace", user_id: "user_123", properties: {planName: "Pro"})
app.integrations.loops.update_contact(email: "reader@example.test", subscribed: false)
contacts = app.integrations.loops.find_contact(email: "reader@example.test")
app.integrations.loops.delete_contact(user_id: "user_123")
```
For `find_contact`, `delete_contact`, and suppression tools, provide exactly one
of `email` or `userId`.

## Contact Properties And Lists

```ruby
app.integrations.loops.create_contact_property(name: "planName", type: "string")
properties = app.integrations.loops.list_contact_properties()
lists = app.integrations.loops.list_mailing_lists()
```
Property names must be camelCase. Supported property types are `string`,
`number`, `boolean`, and `date`.

## Events

```ruby
app.integrations.loops.send_event(email: "reader@example.test", event_name: "trial_started", event_properties: {plan: "Pro"})
```
Events can identify contacts by `email` or `userId` and can include
`eventProperties`.

## Transactional Email

```ruby
app.integrations.loops.send_transactional_email(email: "reader@example.test", transactional_id: "clw6rbuwp01rmeiyndm80155l", add_to_audience: true, data_variables: {loginUrl: "https://example.test/login"}, idempotency_key: "550e8400-e29b-41d4-a716-446655440000")
emails = app.integrations.loops.list_transactional_emails(per_page: 20)
```
Attachments can be sent with `attachments`, each containing `filename`,
`contentType`, and base64 `data`.

## Suppression And Configuration

```ruby
status = app.integrations.loops.check_contact_suppression(email: "reader@example.test")
app.integrations.loops.remove_contact_suppression(email: "reader@example.test")
key = app.integrations.loops.test_api_key()
ips = app.integrations.loops.list_dedicated_sending_ips()
```
Suppression removal is quota-limited by Loops. Dedicated sending IPs are only for
rare allowlisting workflows and may change over time.

## Multi-Account Usage

```ruby
app.integrations.loops.create_contact(email: "reader@example.test")
app.integrations.loops.default.create_contact(email: "reader@example.test")
app.integrations.loops.marketing.create_contact(email: "reader@example.test")
```
All account namespaces expose the same tools; only credentials and API base URL
differ.
