# Drip Integration — Lua API Reference

## Overview

The Drip integration provides tools for managing email marketing subscribers, campaigns, and orders through the Drip REST API v2.

## Authentication

All requests require a Bearer token (`api_key`) and an `account_id` (used in URL paths for account-scoped endpoints).

## Tools

### drip_list_subscribers

List subscribers in the Drip account.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 1000 (default: 100) |

**Endpoint:** `GET /v2/{account_id}/subscribers`

---

### drip_get_subscriber

Fetch a single subscriber by ID or email.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | Subscriber ID or email address |

**Endpoint:** `GET /v2/subscribers/{id}`

---

### drip_create_subscriber

Create or update a subscriber. If a subscriber with the given email already exists, their record will be updated.

**Type:** write

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `email` | string | yes | Subscriber email address |
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `custom_fields` | object | no | Custom field key-value pairs |
| `tags` | array | no | Tags to apply |

**Endpoint:** `POST /v2/subscribers`

**Request body:**

```json
{
  "subscribers": [
    {
      "email": "user@example.com",
      "first_name": "John",
      "tags": ["newsletter"]
    }
  ]
}
```

---

### drip_list_campaigns

List email campaigns in the Drip account.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 1000 (default: 100) |

**Endpoint:** `GET /v2/{account_id}/campaigns`

---

### drip_list_orders

List orders recorded in the Drip account.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 1000 (default: 100) |

**Endpoint:** `GET /v2/{account_id}/orders`

---

### drip_get_current_user

Get the currently authenticated Drip user.

**Type:** read

**Parameters:** none

**Endpoint:** `GET /v2/user`

---

## Multi-Account Usage

The Drip integration supports multi-account configurations. Each account can have its own `api_key`, `account_id`, and `url`:

```lua
-- When using with a specific account
tools.drip_list_subscribers({ account = "work" })

-- Default account
tools.drip_list_subscribers({})
```

## Error Handling

All tools return structured results. On error, the response includes an error message describing what went wrong (e.g., authentication failure, invalid account ID, network issues).
