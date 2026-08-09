# RingCentral JavaScript API Reference

Namespace: `app.integrations.ringcentral`

This integration wraps the RingCentral REST API under `/restapi/v1.0`. It covers account and extension discovery, phone numbers, message store workflows, SMS, call logs, presence, personal contacts, and generic relative API calls for documented endpoints that do not yet have a named helper.

## Account, Extensions, And Phone Numbers

```js
var account = app.integrations.ringcentral.get_account({})

var extensions = app.integrations.ringcentral.list_extensions({
  extensionType: "User",
  perPage: 50,
})

var extension = app.integrations.ringcentral.get_extension({
  extension_id: "123456789",
})

var account_numbers = app.integrations.ringcentral.list_account_phone_numbers({})
var my_numbers = app.integrations.ringcentral.list_extension_phone_numbers({})
```
Phone-number records include usage types such as `MainCompanyNumber`, `CompanyNumber`, and `DirectNumber`, plus type/capability data such as voice, fax, and SMS support.

## Messages And SMS

```js
var messages = app.integrations.ringcentral.list_messages({
  messageType: "Sms",
  dateFrom: "2026-05-01T00:00:00Z",
  perPage: 25,
})

var message = app.integrations.ringcentral.get_message({
  messageId: "1234567890",
})

app.integrations.ringcentral.update_message({
  message_id: "1234567890",
  readStatus: "Read",
})

app.integrations.ringcentral.send_sms({
  from: "+16505551234",
  to: "+16505559876",
  text: "Hello from RingCentral",
})
```
The message store contains SMS, fax, pager, and voicemail records visible to the authenticated extension. Account-wide SMS history may require account-level reporting or admin workflows outside this extension mailbox endpoint.

## Call Logs And Presence

```js
var calls = app.integrations.ringcentral.list_calls({
  dateFrom: "2026-05-01T00:00:00Z",
  direction: "Inbound",
})

var account_calls = app.integrations.ringcentral.list_account_calls({
  dateFrom: "2026-05-01T00:00:00Z",
  perPage: 100,
})

var presence = app.integrations.ringcentral.get_presence({
  detailedTelephonyState: true,
})
```
Extension call logs show records for the authenticated extension. Account-level call logs may require admin privileges and broader scopes.

## Contacts

```js
var contacts = app.integrations.ringcentral.list_contacts({
  startsWith: "Acme",
})

var created = app.integrations.ringcentral.create_contact({
  firstName: "Ada",
  lastName: "Lovelace",
  mobilePhone: "+16505550100",
  email: "ada@example.test",
})

var updated = app.integrations.ringcentral.update_contact({
  contact_id: created.id,
  company: "Example",
})
```
Contact tools operate on the authenticated extension's personal address book.

## Generic API Tools

Use `api_get`, `api_post`, `api_put`, and `api_delete` for documented relative RingCentral API paths that are not wrapped yet. Absolute URLs are rejected.

```js
var raw = app.integrations.ringcentral.api_get({
  path: "/restapi/v1.0/account/~/extension/~",
})
```
## Account

`get_current_user` returns the authenticated extension. Multi-account namespaces expose the same tool set:

```js
app.integrations.ringcentral.list_messages({})
app.integrations.ringcentral.default.list_messages({})
app.integrations.ringcentral.support.list_messages({})
```