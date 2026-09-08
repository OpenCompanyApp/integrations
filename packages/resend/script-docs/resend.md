# Resend - Ruby API Reference

Namespace: `app.integrations.resend`

This package exposes 83 generated tools from Resend's official OpenAPI document at `https://raw.githubusercontent.com/resend/resend-openapi/main/resend.yaml`. Requests use `Authorization: Bearer <api_key>` against `https://api.resend.com` by default.

## Common Operations

```ruby
sent = app.integrations.resend.email(from: "noreply@example.com", to: ["recipient@example.com"], subject: "Welcome", html: "<p>Hello</p>")
domains = app.integrations.resend.retrieve_list_domains()
contact = app.integrations.resend.create_new_contact(email: "jane@example.com", first_name: "Jane", last_name: "Doe", audience_id: "aud_123")
```
## Generated Tool Shape

Tool names follow Resend's official paths and summaries, normalized to snake_case with a `resend_` prefix in metadata and exposed without the prefix in Ruby. Existing common names such as `send_email`, `get_email`, `list_emails`, `create_domain`, `list_domains`, `verify_domain`, `create_api_key`, `list_api_keys`, and `create_contact` are preserved.

Path parameters with a single id accept `id` for convenience. Specific aliases such as `email_id`, `domain_id`, `api_key_id`, `webhook_id`, `automation_id`, `contact_id`, and `segment_id` are also accepted when the upstream path needs them.

Request bodies can be passed as `body = { ... }`. Generated tools also collect loose arguments that are not path, query, or header parameters into the JSON body.

## Coverage Notes

The generated catalog covers emails, batch emails, scheduled email cancellation, sent and received attachments, domains, API keys, templates, audiences, contacts, broadcasts, webhooks, segments, topics, contact properties, logs, automations, and events.

## Multi-Account Usage

```ruby
app.integrations.resend.email(from: "noreply@example.com", to: ["a@example.com"], subject: "Hi", text: "Hello")
app.integrations.resend.production.retrieve_list_domains()
app.integrations.resend.marketing.retrieve_list_broadcasts()
```
All functions are identical across accounts; only the resolved credentials differ.
