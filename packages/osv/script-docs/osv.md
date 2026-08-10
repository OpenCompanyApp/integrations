# OSV

Namespace: `osv`

Use this integration to query OSV.dev open source vulnerability records by
package version, package URL, git commit, batch query, or vulnerability ID. It
also exposes OSV's experimental import-findings and C/C++ version-determination
endpoints.

## Authentication

OSV.dev is public and does not require credentials.

## Tools

- `osv_query`: query one package version, package URL, or git commit. Use
  either `commit`, or a package query. For package queries, pass either
  `package_name` plus `ecosystem`, or `purl`. Add `version` unless the purl is
  already versioned.
- `osv_query_batch`: query multiple package versions or commits. The response
  order matches the input `queries` order. OSV currently allows up to 1000 query
  items in one batch.
- `osv_get_vulnerability`: retrieve one full OSV vulnerability record by ID.
- `osv_import_findings`: experimental endpoint for records from a source that
  fail import-time quality checks.
- `osv_determine_version`: experimental endpoint for identifying probable C/C++
  library versions from relative file paths and base64-encoded MD5 hash bytes.

## Return Notes

This package keeps OSV response field names intact. `osv_query` returns
`vulns` and may include `next_page_token`. `osv_query_batch` returns `results`,
where each result corresponds to the input query at the same index and may have
its own `next_page_token`.

Case matters for ecosystems and vulnerability IDs. Use `PyPI`, not `pypi`; use
the exact `GHSA-*`, `CVE-*`, or `OSV-*` identifier when fetching by ID.

## Examples

```js
var vulns = tools.osv_query({
  package_name: "jinja2",
  ecosystem: "PyPI",
  version: "3.1.4",
})

var batch = tools.osv_query_batch({
  queries: [
    {purl: "pkg:pypi/mlflow@0.4.0"},
    {commit: "6879efc2c1596d11a6a6ad296f80063b558d5e0f"},
    {package_name: "jinja2", ecosystem: "PyPI", version: "2.4.1"}
  ]
})

var record = tools.osv_get_vulnerability({
  id: "GHSA-vp9c-fpxx-744v",
})
```
For pagination, repeat the same query with `page_token` set to the returned
`next_page_token` until no token remains.
