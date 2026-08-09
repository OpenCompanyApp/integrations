# Canny

Use the `canny` namespace to work with Canny product-feedback data: boards, posts, comments, votes, users, companies, changelog entries, insights, opportunities, and Autopilot feedback.

Canny's API uses POST requests for every endpoint. The integration injects the configured secret API key into the JSON body as `apiKey`, so agents should never pass it manually.

## Common workflows

- Use `canny_list_boards` before creating or filtering posts.
- Use `canny_create_or_update_user` before creating posts, votes, or comments on behalf of a customer.
- Use `canny_create_post` with `boardID`, `authorID`, `title`, and optional details fields.
- Use `canny_create_vote` with `postID` and `voterID` to record customer demand.
- Use `canny_list_comments`, `canny_list_votes`, `canny_list_users`, and `canny_list_companies` with `cursor` pagination.
- Use `canny_change_post_status`, `canny_add_post_tag`, and `canny_link_jira_issue` to keep roadmap state synchronized.
- Use `canny_enqueue_feedback` for Canny Autopilot accounts when raw feedback should be extracted and deduplicated.

## Payload shape

Most tools accept documented Canny fields either as top-level arguments or inside `payload`.

```js
canny_create_post({
  boardID: "board_123",
  authorID: "user_123",
  title: "Add invoice exports",
  payload: {
    details: "Customers need CSV && PDF exports.",
    byID: "admin_123",
  }
})
```
For cursor-paginated v2 endpoints:

```js
canny_list_votes({
  payload: {
    postID: "post_123",
    limit: 25,
    cursor: "cursor-from-previous-response",
  }
})
```
For skip-paginated v1 endpoints:

```js
canny_list_posts({
  payload: {
    boardID: "board_123",
    limit: 25,
    skip: 50,
    sort: "score",
  }
})
```
## Endpoint notes

Companies are created by associating company data to users through `canny_create_or_update_user`; Canny's reference does not expose a separate `companies/create` endpoint.

Roadmap data is returned inside post data. Canny's reference documents the roadmap object but does not expose a standalone roadmap endpoint.

`canny_find_or_create_user` is included for compatibility with Canny's deprecated endpoint. Prefer `canny_create_or_update_user`.

`canny_api_post` is an escape hatch for newly documented Canny endpoints. It accepts only relative paths such as `/api/v1/boards/list`; full URLs are rejected.
