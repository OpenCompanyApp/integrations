# MessageBird - Ruby API Reference

Namespace: `app.integrations.messagebird`

This integration wraps MessageBird's classic REST API at `https://rest.messagebird.com` using `Authorization: AccessKey ...`. It covers SMS, voice messages, contacts, groups, lookup/HLR, Verify, balance, and purchased numbers.

## SMS Messages

```ruby
app.integrations.messagebird.send_sms(originator: "ExampleCo", recipients: ["31612345678"], body: "Your order is ready.", options: {reference: "ord_123"})
messages = app.integrations.messagebird.list(limit: 20, status: "delivered", direction: "mt")
message = app.integrations.messagebird.get(id: "msg_123")
app.integrations.messagebird.delete(id: "msg_123")
```
`delete_message` only applies to messages the API still allows cancelling, such as scheduled messages.

## Voice Messages

```ruby
app.integrations.messagebird.send_voice(originator: "31612345678", recipients: ["31687654321"], body: "This is a voice notification.", options: {language: "en-gb", voice: "female", repeat: 1})
voice_messages = app.integrations.messagebird.list_voice(limit: 20)
voice_message = app.integrations.messagebird.get_voice(id: "voice_123")
app.integrations.messagebird.delete_voice(id: "voice_123")
```
## Contacts

```ruby
contacts = app.integrations.messagebird.list_contacts(limit: 20)
contact = app.integrations.messagebird.create_contact(contact: {msisdn: 31612345678, firstName: "Ada", lastName: "Lovelace", customDetails: {custom1: "customer"}})
saved = app.integrations.messagebird.get_contact(id: "contact_123")
app.integrations.messagebird.update_contact(id: "contact_123", contact: {firstName: "Ada"})
groups = app.integrations.messagebird.list_contact_groups(id: "contact_123")
messages = app.integrations.messagebird.list_contact(id: "contact_123")
```
`delete_contact({ id = "contact_123" })` removes the contact.

## Groups

```ruby
groups = app.integrations.messagebird.list_groups(limit: 20)
group = app.integrations.messagebird.create_group(name: "Customers")
one = app.integrations.messagebird.get_group(id: "group_123")
app.integrations.messagebird.update_group(id: "group_123", name: "VIP Customers")
group_contacts = app.integrations.messagebird.list_group_contacts(id: "group_123")
app.integrations.messagebird.add_contact_group(group_id: "group_123", contact_id: "contact_123")
app.integrations.messagebird.remove_contact_from_group(group_id: "group_123", contact_id: "contact_123")
```
`delete_group({ id = "group_123" })` deletes a group.

## Lookup And HLR

```ruby
lookup = app.integrations.messagebird.lookup_phone_number(phone_number: "31612345678", country_code: "NL")
hlr = app.integrations.messagebird.get_hlr_lookup(phone_number: "31612345678")
requested = app.integrations.messagebird.request_hlr_lookup(phone_number: "31612345678", options: {reference: "crm_check_123"})
```
HLR requests can incur provider costs. Use them when active network/operator status is needed, not for simple formatting checks.

## Verify

```ruby
verify = app.integrations.messagebird.create_verify(recipient: "31612345678", options: {originator: "Code", type: "sms", template: "Your code is %token"})
status = app.integrations.messagebird.get_verify(id: verify.id)
checked = app.integrations.messagebird.verify_token(id: verify.id, token: "123456")
```
`delete_verify({ id = "verify_123" })` deletes or cancels a verification.

## Balance And Numbers

```ruby
balance = app.integrations.messagebird.get_balance()
account = app.integrations.messagebird.get_current_user()
numbers = app.integrations.messagebird.list_numbers(limit: 20, country_code: "NL", number_type: "mobile")
number = app.integrations.messagebird.get_number(number: "31612345678")
app.integrations.messagebird.update_number(number: "31612345678", settings: {smsUrl: "https://example.test/messagebird/inbound"})
```
`get_current_user` is an account-level balance check because the classic MessageBird REST API does not expose a richer current-user endpoint.

## Multi-Account Usage

```ruby
app.integrations.messagebird.send_sms()
app.integrations.messagebird.default.send_sms()
app.integrations.messagebird.production.send_sms()
```
Named account namespaces use the same functions with different stored credentials.
