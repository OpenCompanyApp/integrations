# Autopilot

Namespace: `app.integrations.autopilot`

Autopilot tools follow the official API Blueprint from the
`autopilotdev.github.io` repository. The API uses the `autopilotapikey` header,
not bearer authorization. Configure `api_key`; set `url` only for a test proxy.

## Contacts

```js
var contact = app.integrations.autopilot.create_contact({
  payload: {
    Email: "ada@example.test",
    FirstName: "Ada",
    LastName: "Lovelace",
    Company: "Example Co",
    custom_fields: {
      Plan: "pro",
    }
  }
})

var fetched = app.integrations.autopilot.get_contact({
  contact_id_or_email: "ada@example.test",
})

app.integrations.autopilot.delete_contact({
  contact_id_or_email: "ada@example.test",
})
```
Autopilot de-duplicates contacts by `Email`. The create contact operation is
also the documented update path.

## Lists

```js
var list = app.integrations.autopilot.add_list({
  payload: {
    name: "Product-qualified leads",
  }
})

var contacts = app.integrations.autopilot.get_contacts_on_list({
  list_id: list.list_id,
})

app.integrations.autopilot.delete_list({
  payload: {
    list_id: list.list_id,
  }
})
```
The official API Blueprint does not expose bulk contact listing or journey
listing endpoints. Use list-specific contact lookup when you have a list ID.

## Journeys

```js
app.integrations.autopilot.eject_contact_from_journey({
  journey_id: "campaign_123",
  contact_id_or_email: "ada@example.test",
})
```
The documented journey operation removes a known contact from a known journey.
The blueprint says there is no programmatic journey listing endpoint.

## REST Hooks

```js
var hook = app.integrations.autopilot.register_rest_hook({
  payload: {
    event: "contact_added",
    target_url: "https://example.test/autopilot/hooks/contact-added",
  }
})

var hooks = app.integrations.autopilot.list_rest_hooks({})

app.integrations.autopilot.unregister_rest_hook({
  hook_id: hook.id,
})
```
Supported events in the blueprint are:

- `contact_added`
- `contact_unsubscribes`
- `contact_added_to_list`
- `contact_removed_from_list`
- `contact_entered_segment`
- `contact_left_segment`

## Argument Shape

Path parameters are top-level snake_case arguments. Write operations accept a
`payload` object for the documented JSON body. Tools also accept `query` for
extra documented query parameters.

Empty Autopilot responses return `{ success = true, status = 204 }`.

## Multi-Account Usage

```js
app.integrations.autopilot.get_contact({ contact_id_or_email: "ada@example.test" })
app.integrations.autopilot.default.get_contact({ contact_id_or_email: "ada@example.test" })
app.integrations.autopilot.marketing.get_contact({ contact_id_or_email: "ada@example.test" })
```
All account namespaces expose the same tool names. Only credentials differ.
