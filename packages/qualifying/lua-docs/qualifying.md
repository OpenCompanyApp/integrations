# Qualifying Integration

## Tools

### qualifying_list_accounts
List sales accounts from Qualifying.

**Parameters:**
- `limit` (integer, optional): Maximum number of accounts to return per page (default: 25, max: 100).
- `page` (integer, optional): Page number for pagination (default: 1).

### qualifying_get_account
Get detailed information about a specific account.

**Parameters:**
- `id` (string, required): The unique identifier of the account.

### qualifying_list_contacts
List contacts from Qualifying with optional account filter.

**Parameters:**
- `limit` (integer, optional): Maximum number of contacts to return per page (default: 25, max: 100).
- `page` (integer, optional): Page number for pagination (default: 1).
- `account_id` (string, optional): Filter contacts by account ID.

### qualifying_get_contact
Get detailed information about a specific contact.

**Parameters:**
- `id` (string, required): The unique identifier of the contact.

### qualifying_list_deals
List deals from Qualifying with optional stage filter.

**Parameters:**
- `limit` (integer, optional): Maximum number of deals to return per page (default: 25, max: 100).
- `page` (integer, optional): Page number for pagination (default: 1).
- `stage` (string, optional): Filter deals by pipeline stage (e.g., "lead", "qualified", "proposal", "won", "lost").

### qualifying_get_current_user
Get the profile of the currently authenticated user.

**Parameters:** None.
