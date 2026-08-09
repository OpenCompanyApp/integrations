# Crossref

Namespace: `crossref`

Crossref provides public scholarly metadata through its REST API. No API key is required. Pass `mailto` on list requests to identify your client and use Crossref's polite pool.

## Works

```js
var works = crossref.list_works({
  query: "large language models",
  rows: 10,
  filter: {
    type: "journal-article",
    ["from-pub-date"]: "2024-01-01",
  },
  mailto: "agent@example.test",
})

var work = crossref.get_work({
  doi: "10.1128/mbio.01735-25",
})
```
Use `crossref_get_work_agency` to identify whether a DOI is registered with Crossref, DataCite, or another agency.

## Scoped Works

Crossref supports work lists scoped by journal, member, prefix, funder, and work type:

- `crossref_list_journal_works`
- `crossref_list_member_works`
- `crossref_list_prefix_works`
- `crossref_list_funder_works`
- `crossref_list_type_works`

These tools accept the same common list parameters as `crossref_list_works`, including `rows`, `offset`, `cursor`, `filter`, `select`, `sort`, `order`, `facet`, `sample`, and `mailto`.

## Reference Data

Use the list/get tools for Crossref reference entities:

- journals
- members
- prefixes
- funders
- types
- licenses

```js
var journal = crossref.get_journal({ issn: "0306-4530" })
var member = crossref.get_member({ id: "98" })
var prefix = crossref.get_prefix({ prefix: "10.5555" })
var article_type = crossref.get_type({ id: "journal-article" })
```
## Return Shape

The integration returns Crossref JSON directly. Successful responses usually contain:

- `status`
- `message-type`
- `message-version`
- `message`

Filters can be sent as a raw Crossref filter string or as a JavaScript object; tables are converted to `filter:value` comma syntax.
