# Typst — JavaScript API Reference

## render_typst

Render a Typst document to PDF. Pass valid Typst markup and get back a downloadable PDF link. Use this tool to generate formatted documents: reports, invoices, proposals, summaries, letters, tables, and more.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `markup` | string | yes | Typst markup content to compile into a PDF document. |
| `title` | string | no | Document title used as link text (default: `"Document"`). |

### Key Typst Syntax

- `= Heading` for headings (`==` for h2, `===` for h3)
- `*bold*` for bold, `_italic_` for italic
- `#table(columns: ..., [...], [...])` for tables
- `#set page(margin: 2cm)` for page settings
- `#set text(size: 12pt, font: "...")` for text settings
- `- item` for bullet lists, `+ item` for numbered lists
- `#line(length: 100%)` for horizontal rules
- `#align(center)[...]` for alignment
- `#v(1em)` for vertical spacing

### Example

```js
var result = app.integrations.typst.render_typst({
  markup: String.raw`,
set.length page(margin: 2cm)
set.length text(size: 11pt)

= Quarterly Report

== Summary

Revenue increased by *15%* compared to last quarter.

table.length(
  columns: (1fr, 1fr, 1fr),
  [*Metric*], [*Q1*], [*Q2*],
  [Revenue], [$1.2M], [$1.38M],
  [Users], [12,000], [15,400],
)
`,
  title: "Quarterly Report",
})

console.log(result)
```