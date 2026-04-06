# EmailOctopus Lua API Reference

## Overview

The EmailOctopus integration provides tools for managing contacts, viewing campaigns, and accessing account information via the EmailOctopus API.

All tools are available under the `emailoctopus_` namespace.

---

## Tools

### `emailoctopus_list_contacts`

List contacts in an EmailOctopus mailing list.

**Parameters:**

| Parameter  | Type    | Required | Description                                          |
|------------|---------|----------|------------------------------------------------------|
| `list_id`  | string  | No       | List ID to query. Uses default configured list if omitted. |
| `limit`    | integer | No       | Max contacts to return (default: 100, max: 100).     |
| `before`   | string  | No       | Pagination cursor — contact ID to paginate before.   |
| `after`    | string  | No       | Pagination cursor — contact ID to paginate after.    |

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_list_contacts({
    limit = 25,
})
```

---

### `emailoctopus_get_contact`

Get details of a specific contact.

**Parameters:**

| Parameter     | Type   | Required | Description                                          |
|---------------|--------|----------|------------------------------------------------------|
| `contact_id`  | string | Yes      | The contact ID to retrieve.                          |
| `list_id`     | string | No       | The list ID. Uses default configured list if omitted.|

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_get_contact({
    contact_id = "cntg_abc123",
})
```

---

### `emailoctopus_create_contact`

Add a new contact to a mailing list.

**Parameters:**

| Parameter       | Type   | Required | Description                                          |
|-----------------|--------|----------|------------------------------------------------------|
| `email_address` | string | Yes      | The contact's email address.                         |
| `list_id`       | string | No       | List ID. Uses default configured list if omitted.    |
| `first_name`    | string | No       | The contact's first name.                            |
| `last_name`     | string | No       | The contact's last name.                             |

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_create_contact({
    email_address = "user@example.com",
    first_name = "Jane",
    last_name = "Doe",
})
```

---

### `emailoctopus_list_campaigns`

List all email campaigns.

**Parameters:**

| Parameter | Type    | Required | Description                                       |
|-----------|---------|----------|---------------------------------------------------|
| `limit`   | integer | No       | Max campaigns to return (default: 100, max: 100). |
| `before`  | string  | No       | Pagination cursor.                                |
| `after`   | string  | No       | Pagination cursor.                                |

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_list_campaigns({})
```

---

### `emailoctopus_get_campaign`

Get details of a specific campaign.

**Parameters:**

| Parameter      | Type   | Required | Description              |
|----------------|--------|----------|--------------------------|
| `campaign_id`  | string | Yes      | The campaign ID.         |

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_get_campaign({
    campaign_id = "cmpn_abc123",
})
```

---

### `emailoctopus_get_current_user`

Get the authenticated account details.

**Parameters:** None

**Example:**

```lua
app.integrations["email-octopus"].work.emailoctopus_get_current_user({})
```

---

## Multi-Account Usage

When multiple EmailOctopus accounts are configured, specify the account namespace:

```lua
app.integrations["email-octopus"].marketing.emailoctopus_list_contacts({})
app.integrations["email-octopus"].newsletter.emailoctopus_create_contact({
    email_address = "new@example.com",
})
```
