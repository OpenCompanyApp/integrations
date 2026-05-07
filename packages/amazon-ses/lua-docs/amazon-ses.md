# Amazon SES Lua Reference

Namespace: `amazon-ses`

Amazon SES uses AWS Signature Version 4. Configure `access_key_id`,
`secret_access_key`, `region`, and optional `session_token`; do not use bearer
tokens.

## Core Tools

```lua
local sent = app.integrations["amazon-ses"].send_email({
  from_email_address = "hello@example.test",
  destination = { ToAddresses = { "user@example.test" } },
  subject = "Welcome",
  text_body = "Thanks for signing up",
})

local account = app.integrations["amazon-ses"].get_account({})
local identities = app.integrations["amazon-ses"].list_identities({ page_size = 50 })
local identity = app.integrations["amazon-ses"].get_identity({ identity = "example.test" })
local config_sets = app.integrations["amazon-ses"].list_configuration_sets({})
local suppressions = app.integrations["amazon-ses"].list_suppressions({ reason = "BOUNCE" })
```

Template tools:

```lua
app.integrations["amazon-ses"].create_template({
  template_name = "welcome",
  subject = "Welcome, {{name}}",
  html_content = "<p>Hello {{name}}</p>",
  text_content = "Hello {{name}}",
})

local template = app.integrations["amazon-ses"].get_template({
  name = "welcome",
})

app.integrations["amazon-ses"].update_template({
  template_name = "welcome",
  subject = "Updated subject",
  text_content = "Updated text",
})

app.integrations["amazon-ses"].delete_template({
  template_name = "welcome",
})
```

## Generic Signed API

Use generic tools for SES v2 endpoints without a dedicated wrapper. Paths must
start with `/v2/`.

```lua
local result = app.integrations["amazon-ses"].api_get({
  path = "/v2/email/account",
})

local updated = app.integrations["amazon-ses"].api_put({
  path = "/v2/email/account/suppression",
  body = {
    SuppressedReasons = { "BOUNCE", "COMPLAINT" },
  },
})
```

Generic tools return raw SES JSON. Refer to the official SES v2 API reference
for request and response shapes.
