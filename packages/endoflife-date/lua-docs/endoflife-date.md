# endoflife.date

Namespace: `endoflife-date`

Use this integration to query endoflife.date API v1 for software and hardware
lifecycle data: product discovery, release dates, active support, EOL,
extended support, latest versions, categories, tags, and identifiers.

## Authentication

The endoflife.date API v1 is public and requires no credentials.

## Tools

- `endoflife_date_index`: list the main API v1 endpoints.
- `endoflife_date_products`: list all product summaries.
- `endoflife_date_products_full`: list all products with full release data.
  This can be a large response; use the summary tool first when possible.
- `endoflife_date_product`: get one product with all documented release
  cycles.
- `endoflife_date_product_release`: get one release cycle for one product.
- `endoflife_date_latest_release`: get the latest release cycle for one
  product.
- `endoflife_date_categories`: list categories.
- `endoflife_date_category_products`: list product summaries in a category.
- `endoflife_date_tags`: list tags.
- `endoflife_date_tag_products`: list product summaries with a tag.
- `endoflife_date_identifier_types`: list identifier types such as `purl` and
  `cpe`.
- `endoflife_date_identifiers`: list identifiers for a type and their related
  products.

## Return Notes

This package keeps API v1 field names intact. Product summaries return
`name`, `aliases`, `label`, `category`, `tags`, and `uri`. Product details add
`versionCommand`, `identifiers`, `labels`, `links`, and `releases`.

Release cycles commonly include `name`, `codename`, `label`, `releaseDate`,
`isLts`, `isEol`, `eolFrom`, `isMaintained`, and `latest`. Some lifecycle
fields are product-specific, such as `isEoas`, `eoasFrom`, `isEoes`,
`eoesFrom`, `isDiscontinued`, and `discontinuedFrom`.

The API may permanently redirect renamed products, categories, or tags. The
integration follows redirects.

## Examples

```lua
local ubuntu = tools.endoflife_date_product({
  product = "ubuntu"
})

local noble = tools.endoflife_date_product_release({
  product = "ubuntu",
  release = "24.04"
})

local latest_php = tools.endoflife_date_latest_release({
  product = "php"
})

local purls = tools.endoflife_date_identifiers({
  identifier_type = "purl"
})
```

Use product slugs or aliases in their natural form. The integration handles
path encoding for release names and identifier types.
