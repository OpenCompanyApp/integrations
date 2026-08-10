# Featurebase

Use the `featurebase` namespace to work with the Featurebase `2026-01-01.nova` REST API.

Authentication uses `Authorization: Bearer <api-key>`. The integration also sends the `Featurebase-Version` header, defaulting to `2026-01-01.nova`.

## Coverage

This package exposes one first-class tool for each operation listed in the official Featurebase API reference:

- Boards, posts, voters, post statuses, comments, and custom fields
- Changelogs and changelog subscribers
- Admins, admin roles, teams, and brands
- Contacts, contact email preferences, companies, and company-contact membership
- Surveys and survey responses
- Help center help centers, collections, articles, and redirect rules
- Conversations, conversation tags, participants, replies, and redaction
- Tickets, ticket replies, ticket custom fields, categories, and statuses
- Webhooks and webhook secret rotation

## Argument shape

Path parameters are exposed as snake_case top-level arguments. For example, the API path `{userId}` becomes `user_id`, and `{contactId}` becomes `contact_id`.

Query parameters and JSON request bodies go in `payload` using the API's documented field names.

```js
featurebase_create_post({
  payload: {
    boardId: "board_123",
    title: "Add invoice exports",
    content: "<p>Customers need CSV && PDF exports.</p>",
    tags: ["billing", "export"],
  }
})
```
```js
featurebase_get_contact_by_user_id({
  user_id: "external-user-123",
})
```
```js
featurebase_reply_to_conversation({
  id: "conv_123",
  payload: {
    body: "Thanks for the extra context.",
    author: {
      type: "admin",
      id: "admin_123",
    }
  }
})
```
The raw `featurebase_api_get`, `featurebase_api_post`, `featurebase_api_patch`, and `featurebase_api_delete` tools only accept relative paths such as `/v2/boards`; full URLs are rejected.
