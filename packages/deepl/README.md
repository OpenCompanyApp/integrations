# DeepL Integration for Laravel

DeepL translation integration — translate text, manage glossaries, list languages, and check usage.

## Installation

```bash
composer require opencompanyapp/integration-deepl
```

## Configuration

| Key | Type | Description |
|-----|------|-------------|
| `api_key` | secret | Your DeepL API authentication key. |
| `base_url` | url | API base URL. Use `https://api.deepl.com` (paid) or `https://api-free.deepl.com` (free tier). |

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `deepl_translate_text` | write | Translate text using DeepL. |
| `deepl_list_languages` | read | List supported languages. |
| `deepl_get_usage` | read | Check API usage and character limits. |
| `deepl_list_glossaries` | read | List all glossaries. |
| `deepl_get_glossary` | read | Get details of a specific glossary. |
| `deepl_create_glossary` | write | Create a new glossary with custom term translations. |

## Authentication

Uses the `Authorization: DeepL-Auth-Key {api_key}` header for all API requests.

## License

MIT
