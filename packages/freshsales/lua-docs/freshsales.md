# Freshsales Integration

Tools for interacting with the Freshsales CRM API.

## Tools

### freshsales_list_contacts
List contacts from Freshsales CRM.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1)
- `per_page` (integer, optional) — Number of contacts per page (default: 20, max: 100)
- `sort` (string, optional) — Sort direction: "asc" or "desc"
- `sort_by` (string, optional) — Field to sort by (e.g., "created_at", "updated_at", "first_name")

### freshsales_get_contact
Get full details for a specific contact.

**Parameters:**
- `id` (integer, required) — The contact ID

### freshsales_create_contact
Create a new contact in Freshsales.

**Parameters:**
- `first_name` (string, required) — First name
- `last_name` (string, required) — Last name
- `email` (string, optional) — Email address
- `mobile_number` (string, optional) — Mobile phone number

### freshsales_list_deals
List deals from Freshsales CRM.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1)
- `per_page` (integer, optional) — Number of deals per page (default: 20, max: 100)

### freshsales_get_deal
Get full details for a specific deal.

**Parameters:**
- `id` (integer, required) — The deal ID

### freshsales_list_accounts
List sales accounts from Freshsales CRM.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1)
- `per_page` (integer, optional) — Number of accounts per page (default: 20, max: 100)

### freshsales_get_current_user
Get the currently authenticated user profile. Useful for verifying the API connection.

**Parameters:** None
