# Prismic — Ruby API Reference

## list_documents

Search and list documents from the Prismic repository. Supports filtering with Prismic query predicates, pagination, ordering, and language selection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | no | Prismic query predicate(s), e.g. `[[:d = at(document.type, "blog_post")]]` |
| `pageSize` | integer | no | Number of documents per page (default: 20, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `orderings` | string | no | Ordering rules, e.g. `[my.blog_post.date desc]` |
| `lang` | string | no | Language code to filter results (e.g., `"en-us"`, `"fr-fr"`). Use `"*"` for all languages |
| `ref` | string | no | The ref (release/draft) ID to query. Defaults to the master ref |

### Query Predicates

Prismic queries use predicate syntax enclosed in `[[ ]]`. Multiple predicates can be combined:

| Predicate | Description |
|-----------|-------------|
| `at(path, value)` | Exact match |
| `not(path, value)` | Not equal |
| `any(path, values)` | Match any value in array |
| `in(path, values)` | Match any value in array (for document tags) |
| `fulltext(path, value)` | Full-text search |
| `has(path)` | Field has a value |
| `missing(path)` | Field is empty |
| `similar(document_id, max_results)` | Find similar documents |

Common paths: `document.type`, `document.tags`, `document.id`, `my.{type}.{field}`.

### Example

```ruby
result = app.integrations.prismic.list_documents(q: "String.raw`:d = at(document.type, \"blog_post\")`", page_size: 10, page: 1, orderings: "[my.blog_post.date desc]", lang: "en-us")
result.results.each do |doc|
  puts(doc.id, doc.type, doc.slugs[0])
end
```
---

## get_document

Retrieve a single document from the Prismic repository by its unique document ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique document ID (e.g., `"YjRHVhAAACEAnFqZ"`) |
| `ref` | string | no | The ref (release/draft) ID to query. Defaults to the master ref |
| `lang` | string | no | Language code to retrieve a specific translation |

### Example

```ruby
doc = app.integrations.prismic.get_document(id: "YjRHVhAAACEAnFqZ")
puts(doc.type, doc.data.title[0].text)
```
---

## list_types

List all custom types defined in the Prismic repository. Returns type IDs and names that can be used for document queries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of types to return (default: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.prismic.list_types(limit: 50)
(result.types || []).each do |t|
  puts(t.id, t.name)
end
```
---

## get_tags

List all tags defined in the Prismic repository. Tags can be used to filter documents in search queries.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.prismic.get_tags()
(result.tags || []).each do |tag|
  puts(tag)
end
```
---

## list_refs

List all refs (releases and drafts) for the Prismic repository. The master ref points to published content; other refs point to drafts or releases in progress.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.prismic.list_refs()
(result.refs || []).each do |ref|
  puts(ref.id, ref.ref, ref.label, ref.isMasterRef)
end
```
---

## list_languages

List all languages configured in the Prismic repository. Returns language codes and names for querying content in specific locales.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.prismic.list_languages()
(result.languages || []).each do |lang|
  puts(lang.id, lang.name)
end
```
---

## get_current_user

Verify the Prismic API connection is working by performing a minimal document search. Returns connection status and repository information.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.prismic.health_check()
puts(result.status, result.total_results_size, result.message)
```