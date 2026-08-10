# Campaign Monitor JavaScript API Reference

Namespace: `app.integrations.campaign-monitor`

This integration targets Campaign Monitor API v3.3 at
`https://api.createsend.com/api/v3.3`. Most tools accept a `params` object for
query strings or a `payload` object for write requests. Write request fields use
Campaign Monitor's documented PascalCase names.

## Common Patterns

List clients:

```js
var clients = app.integrations["campaign-monitor"].list_clients({})
```
List sent campaigns for a client:

```js
var campaigns = app.integrations["campaign-monitor"].list_campaigns({
  client_id: "client_test",
  page: 1,
  pagesize: 50,
})
```
Add or update a subscriber:

```js
var result = app.integrations["campaign-monitor"].add_subscriber({
  list_id: "list_test",
  EmailAddress: "reader@example.test",
  Name: "Ada Reader",
  Resubscribe: true,
  ConsentToTrack: "Yes",
})
```
Send a transactional classic email:

```js
var result = app.integrations["campaign-monitor"].send_classic_email({
  clientID: "client_test",
  payload: {
    Subject: "Receipt",
    From: "Billing <billing@example.test>",
    To: [ "reader@example.test" ],
    Html: "<p>Thanks</p>",
    Text: "Thanks",
    ConsentToTrack: "No",
  }
})
```
## Resource Coverage

Tools cover:

- Account setup: `get_current_user`, `list_clients`, `create_client`, `get_client`, `update_client`, `delete_client`, `list_countries`, `list_time_zones`, `get_system_date`
- Client resources: `list_lists`, `list_lists_for_email`, `list_client_segments`, `list_client_templates`, `list_client_suppression_list`, `unsuppress_email`, `list_client_tags`, `list_campaigns`, `list_draft_campaigns`, `list_scheduled_campaigns`
- Campaigns and reports: `create_campaign`, `get_campaign`, `send_campaign`, `unschedule_campaign`, `delete_campaign`, `get_campaign_summary`, `get_campaign_email_client_usage`, `get_campaign_lists_and_segments`, `list_campaign_recipients`, `list_campaign_bounces`, `list_campaign_opens`, `list_campaign_clicks`, `list_campaign_unsubscribes`, `list_campaign_spam_complaints`
- Lists and custom fields: `create_list`, `get_list`, `update_list`, `delete_list`, `get_list_stats`, `list_custom_fields`, `create_custom_field`, `update_custom_field`, `delete_custom_field`
- Subscribers: `list_subscribers`, `list_unconfirmed_subscribers`, `list_unsubscribed_subscribers`, `list_deleted_subscribers`, `list_bounced_subscribers`, `add_subscriber`, `import_subscribers`, `get_subscriber`, `update_subscriber`, `delete_subscriber`, `unsubscribe_subscriber`, `get_subscriber_history`
- Segments: `create_segment`, `get_segment`, `update_segment`, `delete_segment`, `list_segment_subscribers`
- Webhooks: `list_webhooks`, `create_webhook`, `get_webhook`, `test_webhook`, `activate_webhook`, `deactivate_webhook`, `delete_webhook`
- Transactional: `list_smart_emails`, `get_smart_email`, `send_smart_email`, `send_classic_email`, `list_classic_email_groups`, `get_transactional_statistics`, `list_transactional_messages`, `get_transactional_message`, `resend_transactional_message`

## Raw API Helpers

Use raw helpers for documented endpoints not yet wrapped:

```js
var result = app.integrations["campaign-monitor"].api_get({
  path: "/clients.json",
})
```
The `path` must be relative. Absolute URLs and parent-directory paths are
rejected.

## Multi-Account Usage

```js
app.integrations["campaign-monitor"].list_clients({})
app.integrations["campaign-monitor"].default.list_clients({})
app.integrations["campaign-monitor"].work.list_clients({})
```