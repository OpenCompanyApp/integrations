# ChurnZero Lua API Reference

ChurnZero uses an action-based HTTP API at an `/i` endpoint. The integration adds the secret `appKey` automatically and exposes the documented action surface for attributes, events, and lifecycle writes.

ChurnZero does not expose a normal paginated REST read API through this package. Use your system of record for reads and push account/contact changes into ChurnZero.

## set_attributes

Set one or more attributes on an account or contact. Each attribute is sent through a `setAttribute` action.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entity` | string | yes | `account` or `contact` |
| `account_external_id` | string | yes | Account ID from your source system |
| `contact_external_id` | string | contact only | Contact ID from your source system |
| `attributes` | table | yes | Attribute name/value pairs |

### Example

```lua
app.integrations.churnzero.set_attributes({
  entity = "account",
  account_external_id = "acct_123",
  attributes = {
    Name = "Example Account",
    ARR = 12000
  }
})
```

For contact attributes:

```lua
app.integrations.churnzero.set_attributes({
  entity = "contact",
  account_external_id = "acct_123",
  contact_external_id = "user_456",
  attributes = {
    Email = "person@example.test",
    Role = "Admin"
  }
})
```

## track_event

Track an event for an account and optionally a contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_external_id` | string | yes | Account ID from your source system |
| `event_name` | string | yes | Event name in ChurnZero |
| `contact_external_id` | string | no | Contact ID from your source system |
| `description` | string | no | Event description |
| `quantity` | number | no | Numeric value for usage-style events |
| `custom_fields` | table | no | Event custom fields |

### Example

```lua
app.integrations.churnzero.track_event({
  account_external_id = "acct_123",
  contact_external_id = "user_456",
  event_name = "Report Exported",
  quantity = 1
})
```

## increment_attribute

Increment a numeric account or contact attribute.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entity` | string | yes | `account` or `contact` |
| `account_external_id` | string | yes | Account ID from your source system |
| `contact_external_id` | string | contact only | Contact ID from your source system |
| `name` | string | yes | Numeric attribute name |
| `value` | number | yes | Amount to add; can be negative |

### Example

```lua
app.integrations.churnzero.increment_attribute({
  entity = "contact",
  account_external_id = "acct_123",
  contact_external_id = "user_456",
  name = "Login Count",
  value = 1
})
```

## delete_contact

Delete a contact by external IDs. This is destructive.

```lua
app.integrations.churnzero.delete_contact({
  account_external_id = "acct_123",
  contact_external_id = "user_456"
})
```

## delete_account

Delete an account by external ID. This is destructive and may affect related contacts and event history.

```lua
app.integrations.churnzero.delete_account({
  account_external_id = "acct_123"
})
```

## send_action

Send an advanced raw ChurnZero action. Do not include `appKey`; the integration adds it from credentials.

```lua
app.integrations.churnzero.send_action({
  params = {
    action = "trackEvent",
    accountExternalId = "acct_123",
    eventName = "Custom Action"
  }
})
```

## Notes

Attribute names must match fields configured in ChurnZero. Custom fields are not necessarily created on the fly. The HTTP API often returns a small status payload, so treat successful calls as write acknowledgements rather than fresh record reads.

## Multi-Account Usage

```lua
app.integrations.churnzero.set_attributes({...})
app.integrations.churnzero.default.set_attributes({...})
app.integrations.churnzero.eu_team.track_event({...})
```
