# MessageBird - Lua API Reference

Namespace: `app.integrations.messagebird`

This integration wraps MessageBird's classic REST API at `https://rest.messagebird.com` using `Authorization: AccessKey ...`. It covers SMS, voice messages, contacts, groups, lookup/HLR, Verify, balance, and purchased numbers.

## SMS Messages

```lua
app.integrations.messagebird.send_sms({
  originator = "ExampleCo",
  recipients = {"31612345678"},
  body = "Your order is ready.",
  options = { reference = "ord_123" }
})

local messages = app.integrations.messagebird.list_messages({
  limit = 20,
  status = "delivered",
  direction = "mt"
})

local message = app.integrations.messagebird.get_message({ id = "msg_123" })
app.integrations.messagebird.delete_message({ id = "msg_123" })
```

`delete_message` only applies to messages the API still allows cancelling, such as scheduled messages.

## Voice Messages

```lua
app.integrations.messagebird.send_voice_message({
  originator = "31612345678",
  recipients = {"31687654321"},
  body = "This is a voice notification.",
  options = { language = "en-gb", voice = "female", repeat = 1 }
})

local voice_messages = app.integrations.messagebird.list_voice_messages({ limit = 20 })
local voice_message = app.integrations.messagebird.get_voice_message({ id = "voice_123" })
app.integrations.messagebird.delete_voice_message({ id = "voice_123" })
```

## Contacts

```lua
local contacts = app.integrations.messagebird.list_contacts({ limit = 20 })

local contact = app.integrations.messagebird.create_contact({
  contact = {
    msisdn = 31612345678,
    firstName = "Ada",
    lastName = "Lovelace",
    customDetails = { custom1 = "customer" }
  }
})

local saved = app.integrations.messagebird.get_contact({ id = "contact_123" })

app.integrations.messagebird.update_contact({
  id = "contact_123",
  contact = { firstName = "Ada" }
})

local groups = app.integrations.messagebird.list_contact_groups({ id = "contact_123" })
local messages = app.integrations.messagebird.list_contact_messages({ id = "contact_123" })
```

`delete_contact({ id = "contact_123" })` removes the contact.

## Groups

```lua
local groups = app.integrations.messagebird.list_groups({ limit = 20 })
local group = app.integrations.messagebird.create_group({ name = "Customers" })
local one = app.integrations.messagebird.get_group({ id = "group_123" })

app.integrations.messagebird.update_group({
  id = "group_123",
  name = "VIP Customers"
})

local group_contacts = app.integrations.messagebird.list_group_contacts({
  id = "group_123"
})

app.integrations.messagebird.add_contact_to_group({
  group_id = "group_123",
  contact_id = "contact_123"
})

app.integrations.messagebird.remove_contact_from_group({
  group_id = "group_123",
  contact_id = "contact_123"
})
```

`delete_group({ id = "group_123" })` deletes a group.

## Lookup And HLR

```lua
local lookup = app.integrations.messagebird.lookup_phone_number({
  phone_number = "31612345678",
  country_code = "NL"
})

local hlr = app.integrations.messagebird.get_hlr_lookup({
  phone_number = "31612345678"
})

local requested = app.integrations.messagebird.request_hlr_lookup({
  phone_number = "31612345678",
  options = { reference = "crm_check_123" }
})
```

HLR requests can incur provider costs. Use them when active network/operator status is needed, not for simple formatting checks.

## Verify

```lua
local verify = app.integrations.messagebird.create_verify({
  recipient = "31612345678",
  options = {
    originator = "Code",
    type = "sms",
    template = "Your code is %token"
  }
})

local status = app.integrations.messagebird.get_verify({ id = verify.id })

local checked = app.integrations.messagebird.verify_token({
  id = verify.id,
  token = "123456"
})
```

`delete_verify({ id = "verify_123" })` deletes or cancels a verification.

## Balance And Numbers

```lua
local balance = app.integrations.messagebird.list_balance({})
local account = app.integrations.messagebird.get_current_user({})

local numbers = app.integrations.messagebird.list_numbers({
  limit = 20,
  country_code = "NL",
  number_type = "mobile"
})

local number = app.integrations.messagebird.get_number({
  number = "31612345678"
})

app.integrations.messagebird.update_number({
  number = "31612345678",
  settings = { smsUrl = "https://example.test/messagebird/inbound" }
})
```

`get_current_user` is an account-level balance check because the classic MessageBird REST API does not expose a richer current-user endpoint.

## Multi-Account Usage

```lua
app.integrations.messagebird.send_sms({...})
app.integrations.messagebird.default.send_sms({...})
app.integrations.messagebird.production.send_sms({...})
```

Named account namespaces use the same functions with different stored credentials.
