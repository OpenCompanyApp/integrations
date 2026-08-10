# Open Library

Namespace: `open-library`

Use this integration to retrieve public Open Library book metadata: search
results, works, editions, ISBN records, author records, author works, subject
works, recent changes, legacy Books API bibkey lookups, and cover image URLs.

## Authentication

The public read APIs used here require no credentials.

## Tools

- `open_library_search_books`: search books and works.
- `open_library_search_authors`: search authors.
- `open_library_work`: retrieve one work by work ID.
- `open_library_work_editions`: list editions for a work.
- `open_library_work_ratings`: retrieve work ratings.
- `open_library_work_bookshelves`: retrieve bookshelf counts for a work.
- `open_library_edition`: retrieve one edition by edition ID.
- `open_library_isbn`: retrieve an edition by ISBN.
- `open_library_books`: legacy bibkey lookup for ISBN, LCCN, OCLC, and OLID.
- `open_library_author`: retrieve one author.
- `open_library_author_works`: list works by an author.
- `open_library_subject`: list works for a subject.
- `open_library_recent_changes`: list recent changes.
- `open_library_cover_url`: build an Open Library cover image URL.

## Return Notes

Open Library responses keep upstream field names. Search results use `docs`,
`numFound` or `num_found`, and pagination fields. Work, edition, author, and
subject endpoints return Open Library JSON records directly.

For cover images, Open Library exposes deterministic image URLs. The cover tool
does not fetch the image; it returns the URL to use.

## Examples

```js
var books = tools.open_library_search_books({
  q: "the lord of the rings",
  fields: "key,title,author_name,first_publish_year,cover_i",
  limit: 5,
})

var work = tools.open_library_work({
  id: "OL27448W",
})

var cover = tools.open_library_cover_url({
  type: "isbn",
  value: "9780140328721",
  size: "L",
})
```