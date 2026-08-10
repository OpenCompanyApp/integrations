# Readwise

Use the `readwise` namespace to work with both Readwise highlights/books and Reader documents.

Authentication uses a Readwise access token in the `Authorization: Token ...` header. Agents should not pass the token manually.

## Readwise v2

- `readwise_list_books` and `readwise_get_book` read source books/articles.
- `readwise_list_highlights`, `readwise_get_highlight`, `readwise_create_highlights`, `readwise_update_highlight`, and `readwise_delete_highlight` manage highlights.
- `readwise_export_highlights` is the preferred sync endpoint. Use `updatedAfter` and `pageCursor` for incremental exports.
- `readwise_get_review_queue` retrieves review queue items.
- Book and highlight tag tools use `book_id`, `highlight_id`, and `tag_id` path fields.

## Reader v3

- `readwise_save_document` saves a URL or HTML document to Reader.
- `readwise_list_documents` accepts filters such as `updatedAfter`, `location`, `category`, `tag`, `limit`, and `pageCursor`.
- `readwise_update_document` updates metadata, tags, notes, location, category, and seen state for one document.
- `readwise_bulk_update_documents` accepts an `updates` array.
- `readwise_delete_document` deletes a Reader document.
- `readwise_list_reader_tags` lists Reader tags for filtering.

## Examples

```js
readwise_save_document({
  url: "https://example.test/article",
  payload: {
    tags: ["research", "later"],
    saved_using: "agent",
  }
})
```
```js
readwise_list_documents({
  payload: {
    location: "archive",
    updatedAfter: "2026-05-01T00:00:00Z",
    limit: 100,
  }
})
```
```js
readwise_export_highlights({
  payload: {
    updatedAfter: "2026-05-01T00:00:00Z",
    pageCursor: "cursor-from-previous-response",
  }
})
```
The raw `readwise_api_get`, `readwise_api_post`, `readwise_api_patch`, and `readwise_api_delete` tools only accept relative paths such as `/api/v3/list/`; full URLs are rejected.
