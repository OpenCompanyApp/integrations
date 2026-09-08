# RingCentral Ruby API Reference

Namespace: `app.integrations.ringcentral`

This integration wraps the RingCentral REST API under `/restapi/v1.0`. It covers account and extension discovery, phone numbers, message store workflows, SMS, call logs, presence, personal contacts, and generic relative API calls for documented endpoints that do not yet have a named helper.

## Account, Extensions, And Phone Numbers

```ruby
account = app.integrations.ringcentral.get_account()
extensions = app.integrations.ringcentral.list_extensions(extension_type: "User", per_page: 50)
extension = app.integrations.ringcentral.get_extension(extension_id: "123456789")
account_numbers = app.integrations.ringcentral.list_account_phone_numbers()
my_numbers = app.integrations.ringcentral.list_extension_phone_numbers()
```
Phone-number records include usage types such as `MainCompanyNumber`, `CompanyNumber`, and `DirectNumber`, plus type/capability data such as voice, fax, and SMS support.

## Messages And SMS

```ruby
messages = app.integrations.ringcentral.list_messages(message_type: "Sms", date_from: "2026-05-01T00:00:00Z", per_page: 25)
message = app.integrations.ringcentral.get_message(message_id: "1234567890")
app.integrations.ringcentral.update_message(message_id: "1234567890", read_status: "Read")
app.integrations.ringcentral.send_sms(from: "+16505551234", to: "+16505559876", text: "Hello from RingCentral")
```
The message store contains SMS, fax, pager, and voicemail records visible to the authenticated extension. Account-wide SMS history may require account-level reporting or admin workflows outside this extension mailbox endpoint.

## Call Logs And Presence

```ruby
calls = app.integrations.ringcentral.list_calls(date_from: "2026-05-01T00:00:00Z", direction: "Inbound")
account_calls = app.integrations.ringcentral.list_account_calls(date_from: "2026-05-01T00:00:00Z", per_page: 100)
presence = app.integrations.ringcentral.get_presence(detailed_telephony_state: true)
```
Extension call logs show records for the authenticated extension. Account-level call logs may require admin privileges and broader scopes.

## Contacts

```ruby
contacts = app.integrations.ringcentral.list_contacts(starts_with: "Acme")
created = app.integrations.ringcentral.create_contact(first_name: "Ada", last_name: "Lovelace", mobile_phone: "+16505550100", email: "ada@example.test")
updated = app.integrations.ringcentral.update_contact(contact_id: created.id, company: "Example")
```
Contact tools operate on the authenticated extension's personal address book.

## Generic API Tools

Use `api_get`, `api_post`, `api_put`, and `api_delete` for documented relative RingCentral API paths that are not wrapped yet. Absolute URLs are rejected.

```ruby
raw = app.integrations.ringcentral.api_get(path: "/restapi/v1.0/account/~/extension/~")
```
## Account

`get_current_user` returns the authenticated extension. Multi-account namespaces expose the same tool set:

```ruby
app.integrations.ringcentral.list_messages()
app.integrations.ringcentral.default.list_messages()
app.integrations.ringcentral.support.list_messages()
```