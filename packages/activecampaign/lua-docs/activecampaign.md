# ActiveCampaign Integration

Manage contacts, lists, deals, automations, and notes in ActiveCampaign.

## Authentication

This integration uses an **API Key** and **Account Name** for authentication.

- **API Key**: Found in Settings → Developer → API Access in your ActiveCampaign account.
- **Account Name**: The subdomain from your ActiveCampaign URL (e.g., `mycompany` from `mycompany.activehosted.com`).

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | ✅ | Your ActiveCampaign API key |
| `account_name` | string | ✅ | Your ActiveCampaign account name (subdomain) |

## Tools

### `activecampaign_list_contacts`

List contacts with pagination, search, and filters.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `limit` | integer | No | Number of contacts per page (default: 20, max: 100) |
| `offset` | integer | No | Offset for pagination |
| `search` | string | No | Search by email or name |
| `filters` | object | No | Additional filters (e.g., `{"status": "-1"}`, `{"listid": 5}`) |

**Example**:

```lua
activecampaign_list_contacts({ search = "john@example.com", limit = 10 })
```

---

### `activecampaign_get_contact`

Get details of a specific contact by ID.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The ActiveCampaign contact ID |

**Example**:

```lua
activecampaign_get_contact({ contact_id = 123 })
```

---

### `activecampaign_create_contact`

Create a new contact.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `email` | string | ✅ | Contact email address |
| `firstName` | string | No | First name |
| `lastName` | string | No | Last name |
| `phone` | string | No | Phone number |

**Example**:

```lua
activecampaign_create_contact({
  email = "jane@example.com",
  firstName = "Jane",
  lastName = "Doe",
  phone = "+1234567890"
})
```

---

### `activecampaign_update_contact`

Update an existing contact.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The contact ID to update |
| `email` | string | No | Updated email |
| `firstName` | string | No | Updated first name |
| `lastName` | string | No | Updated last name |
| `phone` | string | No | Updated phone |
| `fields` | object | No | Custom field values (e.g., `{"field[1]": "value"}`) |

**Example**:

```lua
activecampaign_update_contact({
  contact_id = 123,
  firstName = "John",
  lastName = "Updated"
})
```

---

### `activecampaign_delete_contact`

Delete a contact permanently.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The contact ID to delete |

**Example**:

```lua
activecampaign_delete_contact({ contact_id = 123 })
```

---

### `activecampaign_list_lists`

List all contact lists.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `limit` | integer | No | Number of lists per page (default: 20) |
| `offset` | integer | No | Offset for pagination |

**Example**:

```lua
activecampaign_list_lists({ limit = 50 })
```

---

### `activecampaign_get_list`

Get details of a specific list.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `list_id` | integer | ✅ | The list ID |

**Example**:

```lua
activecampaign_get_list({ list_id = 5 })
```

---

### `activecampaign_add_contact_to_list`

Subscribe a contact to a list.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The contact ID |
| `list_id` | integer | ✅ | The list ID to subscribe to |

**Example**:

```lua
activecampaign_add_contact_to_list({
  contact_id = 123,
  list_id = 5
})
```

---

### `activecampaign_remove_contact_from_list`

Unsubscribe a contact from a list.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The contact ID |
| `list_id` | integer | ✅ | The list ID to unsubscribe from |

**Example**:

```lua
activecampaign_remove_contact_from_list({
  contact_id = 123,
  list_id = 5
})
```

---

### `activecampaign_list_deals`

List deals with filters.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `limit` | integer | No | Number of deals per page (default: 20) |
| `offset` | integer | No | Offset for pagination |
| `search` | string | No | Search by deal title |
| `filters` | object | No | Filters (e.g., `{"pipeline": 1, "stage": 2, "status": 0}`). Status: 0=open, 1=won, 2=lost, 3=abandoned |

**Example**:

```lua
activecampaign_list_deals({ filters = { status = 0 }, limit = 25 })
```

---

### `activecampaign_get_deal`

Get details of a specific deal.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `deal_id` | integer | ✅ | The deal ID |

**Example**:

```lua
activecampaign_get_deal({ deal_id = 42 })
```

---

### `activecampaign_create_deal`

Create a new deal.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `title` | string | ✅ | Deal title |
| `value` | number | ✅ | Deal value |
| `contact_id` | integer | ✅ | Associated contact ID |
| `stage` | integer | ✅ | Pipeline stage ID |
| `pipeline` | integer | No | Pipeline ID (default pipeline if omitted) |

**Example**:

```lua
activecampaign_create_deal({
  title = "New Enterprise Deal",
  value = 50000,
  contact_id = 123,
  stage = 1,
  pipeline = 2
})
```

---

### `activecampaign_update_deal`

Update an existing deal.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `deal_id` | integer | ✅ | The deal ID to update |
| `title` | string | No | Updated title |
| `value` | number | No | Updated value |
| `stage` | integer | No | Updated stage ID |
| `pipeline` | integer | No | Updated pipeline ID |
| `status` | integer | No | Status: 0=open, 1=won, 2=lost, 3=abandoned |
| `owner` | string | No | Updated owner (user ID) |
| `percent` | integer | No | Updated percentage |
| `fields` | object | No | Custom fields |

**Example**:

```lua
activecampaign_update_deal({
  deal_id = 42,
  status = 1,  -- Mark as won
  value = 55000
})
```

---

### `activecampaign_list_automations`

List all automations.

**Type**: read

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `limit` | integer | No | Number of automations per page (default: 20) |
| `offset` | integer | No | Offset for pagination |

**Example**:

```lua
activecampaign_list_automations({ limit = 50 })
```

---

### `activecampaign_create_note`

Add a note to a contact.

**Type**: write

**Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | ✅ | The contact ID |
| `note` | string | ✅ | The note text |

**Example**:

```lua
activecampaign_create_note({
  contact_id = 123,
  note = "Called customer, they are interested in the enterprise plan."
})
```
