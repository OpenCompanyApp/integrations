# Drip Integration — JavaScript API Reference

## Overview

The Drip integration provides tools for managing email marketing subscribers, campaigns, and workflows through the Drip REST API v2.

## Authentication

All requests require a Bearer token (`api_key`) and an `account_id` (used in URL paths for account-scoped endpoints).

## Tools

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

### drip_get_campaign

Fetch a single email campaign by its campaign ID.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The campaign ID |

**Endpoint:** `GET /v2/{account_id}/campaigns/{id}`

---

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

### drip_list_workflows

List workflows in the Drip account.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 1000 (default: 100) |

**Endpoint:** `GET /v2/{account_id}/workflows`

---

### drip_get_workflow

Fetch a single workflow by its workflow ID.

**Type:** read

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | yes | The workflow ID |

**Endpoint:** `GET /v2/{account_id}/workflows/{id}`

---

### drip_get_current_user

Get the currently authenticated Drip user.

**Type:** read

**Parameters:** none

**Endpoint:** `GET /v2/user`

---

## Multi-Account Usage

The Drip integration supports multi-account configurations. Each account can have its own `api_key`, `account_id`, and `url`:

```js
// When using with a specific account
tools.drip_list_subscribers({ account: "work" })

// Default account
tools.drip_list_subscribers({})
```
## Error Handling

All tools return structured results. On error, the response includes an error message describing what went wrong (e.g., authentication failure, invalid account ID, network issues).
