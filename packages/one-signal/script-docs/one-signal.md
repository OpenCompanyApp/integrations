# OneSignal JavaScript API

Namespace: `app.integrations["one-signal"]`

Use this integration for OneSignal messages, users, aliases, subscriptions, segments, templates, outcomes, apps, and legacy player records.

## Messages

- `onesignal_list_notifications({ app_id, limit, offset, kind, template_id, time_offset })`
- `onesignal_get_notification({ id, app_id, outcome_names, outcome_time_range, outcome_platforms, outcome_attribution })`
- `onesignal_create_notification({ app_id, payload = {...} })`
- `onesignal_create_notification({ app_id, contents, headings, included_segments, url, data })`
- `onesignal_cancel_notification({ message_id, app_id })`

Only one targeting method should be used per message: aliases, subscription IDs, segments, or filters.

## Users And Aliases

- `onesignal_create_user({ app_id, payload = {...} })`
- `onesignal_get_user({ app_id, alias_label, alias_id })`
- `onesignal_update_user({ app_id, alias_label, alias_id, payload = {...} })`
- `onesignal_delete_user({ app_id, alias_label, alias_id })`
- `onesignal_get_user_identity({ app_id, alias_label, alias_id })`
- `onesignal_create_or_update_alias({ app_id, alias_label, alias_id, identity = {...} })`
- `onesignal_delete_alias({ app_id, alias_label, alias_id, alias_label_to_delete })`

Use `external_id` as the primary `alias_label` when possible.

## Subscriptions

- `onesignal_get_identity_by_subscription({ app_id, subscription_id })`
- `onesignal_create_alias_by_subscription({ app_id, subscription_id, identity = {...} })`
- `onesignal_create_subscription({ app_id, alias_label, alias_id, payload = {...} })`
- `onesignal_update_subscription({ app_id, subscription_id, payload = {...} })`
- `onesignal_transfer_subscription({ app_id, subscription_id, identity = {...} })`

Subscriptions represent the actual delivery channel: push, email, SMS, and related channel-specific properties.

## Segments

- `onesignal_list_segments({ app_id, limit, offset })`
- `onesignal_get_segment({ app_id, segment_id, ["include-segment-detail"] = true })`
- `onesignal_create_segment({ app_id, payload = {...} })`
- `onesignal_update_segment({ app_id, segment_id, payload = {...} })`
- `onesignal_delete_segment({ app_id, segment_id })`

Segment filters use the same format as OneSignal's create/update segment API. User-based segments containing unsupported dashboard-only filters cannot be managed through the public API.

## Templates

- `onesignal_list_templates({ app_id, limit, offset })`
- `onesignal_get_template({ app_id, template_id })`
- `onesignal_create_template({ app_id, payload = {...} })`
- `onesignal_update_template({ app_id, template_id, payload = {...} })`
- `onesignal_delete_template({ app_id, template_id })`

Templates can be push, email, or SMS. Pass the documented template body through `payload`.

## Analytics, Apps, Legacy Devices, Raw API

- `onesignal_view_outcomes({ app_id, outcome_names, outcome_time_range, outcome_platforms, outcome_attribution })`
- `onesignal_list_apps({})`
- `onesignal_get_current_app({ app_id })`
- `onesignal_update_app({ app_id, payload = {...} })`
- `onesignal_list_devices({ app_id, limit, offset })`
- `onesignal_get_device({ id, app_id })`
- `onesignal_api_get({ path, params })`
- `onesignal_api_post({ path, payload })`
- `onesignal_api_patch({ path, payload })`
- `onesignal_api_delete({ path, payload })`

App administration may require an Organization API key. Legacy device tools use the older player terminology and are kept for compatibility.

## Examples

```js
var message = app.integrations["one-signal"].onesignal_create_notification({
  contents: { en: "Your report is ready." },
  include_aliases: {
    external_id: [ "user-123" ],
  },
  target_channel: "push",
})
```
```js
var user = app.integrations["one-signal"].onesignal_update_user({
  alias_label: "external_id",
  alias_id: "user-123",
  payload: {
    properties: {
      tags: {
        plan: "pro",
      }
    }
  }
})
```
```js
var segment = app.integrations["one-signal"].onesignal_create_segment({
  payload: {
    name: "Active Pro Users",
    filters: [
      { field: "tag", key: "plan", relation: "=", value: "pro" },
      { operator: "AND" },
      { field: "session_count", relation: ">", value: "5" }
    ]
  }
})
```