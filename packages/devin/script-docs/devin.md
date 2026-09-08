# Devin - Ruby API Reference

Namespace: `app.integrations.devin`

This integration targets Devin's current v3 API by default. Configure `org_id`
for organization-scoped tools. If a host still uses a URL ending in `/v1`, the
basic session tools use legacy v1 endpoints; v3-only tools return a clear error.

## Sessions

Create a session:

```ruby
session = app.integrations.devin.create_session(prompt: "Investigate why the example.test billing specs fail", title: "Billing spec investigation", tags: ["billing", "tests"], repos: ["example/example-app"])
```
List and inspect sessions:

```ruby
sessions = app.integrations.devin.list_sessions(first: 10)
details = app.integrations.devin.get_session(session_id: "devin-abc123")
```
Send follow-up instructions:

```ruby
app.integrations.devin.send_message(session_id: "devin-abc123", message: "Please summarize the failing assertion before changing code.")
```
Terminate a session:

```ruby
app.integrations.devin.terminate_session(session_id: "devin-abc123")
```
## Session Metadata

Use these v3 tools after creating or discovering a session:

```ruby
messages = app.integrations.devin.list_session_messages(session_id: "devin-abc123", first: 25)
attachments = app.integrations.devin.list_session_attachments(session_id: "devin-abc123")
tags = app.integrations.devin.get_session_tags(session_id: "devin-abc123")
app.integrations.devin.append_session_tags(session_id: "devin-abc123", tags: ["reviewed"])
```
Generate and read insights:

```ruby
app.integrations.devin.generate_session_insights(session_id: "devin-abc123")
insights = app.integrations.devin.get_session_insights(session_id: "devin-abc123")
```
## Account And Secrets

Check which principal the API key represents:

```ruby
self_value = app.integrations.devin.get_current_user()
```
Manage organization secrets:

```ruby
secrets = app.integrations.devin.list_secrets(first: 20)
secret = app.integrations.devin.create_secret(type: "key-value", key: "EXAMPLE_TOKEN", value: "dummy-value", is_sensitive: true, note: "Safe fake example")
app.integrations.devin.delete_secret(secret_id: secret.id)
```
Secret list responses return metadata only. Do not expect secret values to be
returned after creation.

## Return Shapes

The integration returns Devin's JSON objects with minimal normalization. Cursor
paginated v3 responses may include collection items and page info fields exactly
as Devin returns them. Legacy v1 session responses may use older field names such
as `session_id` instead of v3 IDs such as `devin_id`.

## Multi-Account Usage

```ruby
app.integrations.devin.create_session(prompt: "...")
app.integrations.devin.default.create_session(prompt: "...")
app.integrations.devin.engineering.create_session(prompt: "...")
```
All account namespaces expose the same tools; only credentials, organization ID,
and API version differ.
