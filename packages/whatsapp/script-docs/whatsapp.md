# WhatsApp Business JavaScript API Reference

Namespace: `app.integrations.whatsapp`

This package wraps the WhatsApp Business Platform Graph API. Configure an
`access_token` for all calls, a `phone_number_id` for message/media/profile
operations, and a `whatsapp_business_account_id` for template, phone-number
listing, and webhook subscription operations.

## Messages

### send_message

Send a text message within an active customer-service window.

```js
var result = app.integrations.whatsapp.send_message({
  to: "15551234567",
  body: "Your order has shipped.",
  preview_url: false,
})

console.log(result.messages[0].id)
```
### send_template

Send a pre-approved template message, usually used to start a conversation.

```js
var result = app.integrations.whatsapp.send_template({
  to: "15551234567",
  template_name: "hello_world",
  language: "en_US",
})
```
### send_message_payload

Send any official Cloud API message payload. Use this for media, location,
contacts, reaction, interactive, catalog, or future message types.

```js
var result = app.integrations.whatsapp.send_message_payload({
  payload: {
    to: "15551234567",
    type: "image",
    image: { link: "https://example.test/image.jpg" },
  }
})
```
### mark_message_read

```js
app.integrations.whatsapp.mark_message_read({
  message_id: "wamid.HBgM...",
})
```
### get_message

Retrieves a message or Graph object by ID. Meta may return limited fields for
message IDs; webhook payloads are still the primary source for message content
and delivery statuses.

```js
var message = app.integrations.whatsapp.get_message({
  message_id: "wamid.HBgM...",
  fields: "id",
})
```
## Contacts

### check_contacts

Validate phone numbers through the official `/{phone-number-id}/contacts`
endpoint. The legacy `list_contacts` slug is kept as an alias for this
validation behavior because Cloud API does not expose a contact listing edge.

```js
var result = app.integrations.whatsapp.check_contacts({
  contacts: [ "15551234567", "15557654321" ],
})
```
## Media

### upload_media

Upload a readable local file and receive a WhatsApp media ID.

```js
var media = app.integrations.whatsapp.upload_media({
  file_path: "/tmp/invoice.pdf",
  mime_type: "application/pdf",
})
```
### get_media

Get media metadata and a temporary download URL.

```js
var media = app.integrations.whatsapp.get_media({
  media_id: "1234567890",
})
```
### delete_media

```js
app.integrations.whatsapp.delete_media({ media_id: "1234567890" })
```
## Message Templates

Template tools use the configured `whatsapp_business_account_id`, not the phone
number ID.

### list_templates

```js
var page = app.integrations.whatsapp.list_templates({
  limit: 50,
  status: "APPROVED",
})

for (const template of (page.data || [])) {
  console.log(template.name + " " + template.status)
}
```
### get_template

```js
var template = app.integrations.whatsapp.get_template({
  template_id: "1234567890",
})
```
### create_template

```js
var created = app.integrations.whatsapp.create_template({
  template: {
    name: "order_update",
    language: "en_US",
    category: "UTILITY",
    components: [
      { type: "BODY", text: "Order {{1}} is {{2}}." }
    ]
  }
})
```
### update_template

```js
app.integrations.whatsapp.update_template({
  template_id: "1234567890",
  template: {
    components: [
      { type: "BODY", text: "Order {{1}} status: {{2}}." }
    ]
  }
})
```
### delete_template

```js
app.integrations.whatsapp.delete_template({
  name: "order_update",
  template_id: "1234567890",
})
```
## Phone Numbers

```js
var numbers = app.integrations.whatsapp.list_phone_numbers({ limit: 25 })

var number = app.integrations.whatsapp.get_phone_number({
  phone_number_id: "1234567890",
})
```
Registration helpers map to Meta's phone-number lifecycle endpoints:
`request_verification_code`, `verify_code`, `register_phone_number`, and
`deregister_phone_number`.

```js
app.integrations.whatsapp.request_verification_code({
  code_method: "SMS",
  language: "en",
})
```
## Business Profile

```js
var profile = app.integrations.whatsapp.get_business_profile({})

app.integrations.whatsapp.update_business_profile({
  profile: {
    about: "Support && order updates",
    email: "support@example.test",
    websites: [ "https://example.test" ],
    vertical: "ECOMMERCE",
  }
})
```
## Webhook Subscriptions

```js
app.integrations.whatsapp.subscribe_app({})
var apps = app.integrations.whatsapp.list_subscribed_apps({})
app.integrations.whatsapp.unsubscribe_app({})
```
## Raw Graph API Helpers

Use these only for WhatsApp Graph API endpoints that are not yet modeled as
first-class tools. Paths must be relative; full URLs and parent-directory
segments are rejected.

```js
var me = app.integrations.whatsapp.api_get({
  path: "/me",
  params: { fields: "id,name" },
})

var response = app.integrations.whatsapp.api_post({
  path: "/1234567890/subscribed_apps",
  payload: {},
})
```
## Multi-Account Usage

```js
app.integrations.whatsapp.send_message({ to: "15551234567", body: "Hello" })
app.integrations.whatsapp.support.send_template({
  to: "15551234567",
  template_name: "hello_world",
  language: "en_US",
})
```