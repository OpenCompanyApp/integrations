# Google Translate Integration

## Tools

### google_translate_translate_text
Translate text using Google Cloud Translation.

**Parameters:**
- `text` (string, required) — The text to translate.
- `target` (string, required) — Target language code (e.g., "en", "de", "fr", "es", "ja", "zh").
- `source` (string, optional) — Source language code. Auto-detected if omitted.
- `format` (string, optional) — Text format: "text" (plain text, default) or "html".

### google_translate_detect_language
Detect the language of text.

**Parameters:**
- `text` (string, required) — The text to detect the language of.

### google_translate_list_supported_languages
List languages supported by Google Cloud Translation.

**Parameters:**
- `target` (string, optional) — Target language code for localizing language names (e.g., "en").

### google_translate_list_glossaries
List all glossaries.

**Parameters:** None.

### google_translate_get_glossary
Get details of a specific glossary.

**Parameters:**
- `name` (string, required) — The glossary resource name (e.g., "projects/PROJECT_ID/locations/LOCATION/glossaries/GLOSSARY_ID").

### google_translate_create_glossary
Create a new glossary.

**Parameters:**
- `name` (string, required) — The glossary resource name.
- `source_lang` (string, required) — Source language code.
- `target_lang` (string, required) — Target language code.
- `entries` (array, required) — Array of term pairs with "source" and "target" keys.

### google_translate_get_current_user
Verify the API key and get connection information.

**Parameters:** None.
