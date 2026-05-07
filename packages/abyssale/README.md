# Abyssale Integration

[Abyssale](https://abyssale.com) is a creative automation platform for generating images, videos, PDFs, GIFs, HTML5 assets, ZIP exports, and dynamic images from reusable designs.

## Coverage

This package targets the current Abyssale API reference at `https://api-reference.abyssale.com/`. It authenticates with the documented `x-api-key` header and wraps:

- designs: list designs, get design details, get format details
- generation: synchronous image generation and asynchronous multi-format media generation
- fonts: list custom and Google fonts
- files and exports: get generated files and create ZIP exports
- projects: list and create projects
- workspace templates: duplicate a workspace template and poll duplication status
- dynamic images: create or retrieve dynamic image URLs
- multi-page PDFs: asynchronous multi-page PDF generation
- generic helpers: `abyssale_api_get` and `abyssale_api_post` for documented endpoints without a named wrapper

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Abyssale API key, sent as `x-api-key` |
| `url` | url | no | API base URL, default `https://api.abyssale.com` |

## Tool Notes

- Use `abyssale_list_designs` and `abyssale_get_design` before generation so agents can inspect editable layer names and format names.
- `abyssale_generate_image` is synchronous and intended for static designs.
- `abyssale_generate_multi_format_media` is asynchronous and supports images, videos, PDFs, GIFs, and HTML5 output.
- `abyssale_generate_multi_page_pdf` uses the same async generation endpoint but sends the documented `pages` payload shape.
- Webhook payloads for completed files and exports are documented in Lua docs as events, not callable tools.

## Installation

```json
{
    "require": {
        "opencompanyapp/integration-abyssale": "@dev"
    }
}
```

## License

MIT
