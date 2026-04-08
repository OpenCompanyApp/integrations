# DeepL Integration

## Tools

### deepl_translate_text
Translate text using DeepL.

**Parameters:**
- `text` (string, required) — The text to translate.
- `target_lang` (string, required) — Target language code (e.g., "EN", "DE", "FR", "ES", "JA", "ZH").
- `source_lang` (string, optional) — Source language code. Auto-detected if omitted.

### deepl_list_languages
List supported languages.

**Parameters:**
- `type` (string, optional) — Filter: "source" or "target".

### deepl_get_usage
Check DeepL API usage and limits.

**Parameters:** None.

### deepl_list_glossaries
List all glossaries.

**Parameters:** None.

### deepl_get_glossary
Get details of a specific glossary.

**Parameters:**
- `id` (string, required) — The glossary ID.

### deepl_create_glossary
Create a new glossary.

**Parameters:**
- `name` (string, required) — Glossary name.
- `source_lang` (string, required) — Source language code.
- `target_lang` (string, required) — Target language code.
- `entries` (string, required) — Tab-separated entries (source\ttarget), one per line.

### deepl_get_current_user
Get current DeepL account information and usage statistics.

**Parameters:** None.
