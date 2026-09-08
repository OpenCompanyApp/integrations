# Client for the Intercom REST API covering conversations, contacts, and companies — Ruby API Reference

## intercom_list_conversations

List Intercom conversations with pagination and sorting.
Returns conversation IDs, created dates, and state.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of conversations to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |
| `sort_order` | string | no | Sort order: "asc" or "desc". |
| `status` | string | no | Filter by conversation status: "open", "closed", or "all". |

### Example

```ruby
result = app.integrations.intercom.list_conversations(limit: 20, starting_after: "", sort_order: "desc")
```
## intercom_get_conversation

Retrieve an Intercom conversation by its ID.
Returns the full conversation including message parts, contacts, and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Intercom conversation ID. |

### Example

```ruby
result = app.integrations.intercom.get_conversation(conversation_id: "12345")
```
## intercom_create_conversation

Create a new conversation in Intercom.
Requires a user_id (Intercom contact ID) and a message body.
Returns the created conversation with its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | Intercom contact ID (user) to create the conversation for. |
| `body` | string | yes | Initial message body for the conversation. |

### Example

```ruby
result = app.integrations.intercom.create_conversation(user_id: "67890", body: "Hello, I need help with my account.")
```
## intercom_list_contacts

List Intercom contacts with pagination.
Returns contact IDs, emails, names, and roles.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```ruby
result = app.integrations.intercom.list_contacts(limit: 20, starting_after: "")
```
## intercom_get_contact

Retrieve an Intercom contact by its ID.
Returns the contact's ID, email, name, phone, role, and custom attributes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Intercom contact ID. |

### Example

```ruby
result = app.integrations.intercom.get_contact(contact_id: "67890")
```
## intercom_list_companies

List Intercom companies with pagination.
Returns company IDs, names, employee counts, and industry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of companies to return (default 20). |
| `starting_after` | string | no | Pagination cursor from a previous response. |

### Example

```ruby
result = app.integrations.intercom.list_companies(limit: 20, starting_after: "")
```
## intercom_get_current_user

Retrieve the currently authenticated Intercom admin user.
Returns the admin's ID, name, email, and avatar.
Useful for identifying which workspace or token is in use.

### Example

```ruby
result = app.integrations.intercom.get_current_user()
```
---

## Multi-Account Usage

If you have multiple intercom accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
