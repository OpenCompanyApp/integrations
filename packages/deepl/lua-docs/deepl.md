# DeepL — Lua API Reference

## translate

Translate a single text string to a target language.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text to translate |
| `target_lang` | string | yes | Target language code (e.g., `"DE"`, `"EN-US"`, `"FR"`, `"JA"`) |
| `source_lang` | string | no | Source language code. Omit to auto-detect |
| `formality` | string | no | `"default"`, `"more"` (formal), or `"less"` (informal) |

### Common Language Codes

| Code | Language | Code | Language |
|------|----------|------|----------|
| `BG` | Bulgarian | `JA` | Japanese |
| `CS` | Czech | `KO` | Korean |
| `DA` | Danish | `LT` | Lithuanian |
| `DE` | German | `LV` | Latvian |
| `EL` | Greek | `NB` | Norwegian |
| `EN-US` | English (US) | `NL` | Dutch |
| `EN-GB` | English (UK) | `PL` | Polish |
| `ES` | Spanish | `PT-BR` | Portuguese (Brazil) |
| `ET` | Estonian | `PT-PT` | Portuguese (Portugal) |
| `FI` | Finnish | `RO` | Romanian |
| `FR` | French | `RU` | Russian |
| `HU` | Hungarian | `SK` | Slovak |
| `ID` | Indonesian | `SL` | Slovenian |
| `IT` | Italian | `SV` | Swedish |
| `ZH` | Chinese | `TR` | Turkish |
| `UK` | Ukrainian | | |

### Formality Support

Formality is supported for: DE, FR, IT, ES, NL, PL, PT-BR, PT-PT, RU, JA, KO, and others.

### Example

```lua
local result = app.integrations.deepl.translate({
  text = "Hello, how are you?",
  target_lang = "DE"
})

print(result.text)                -- "Hallo, wie geht es dir?"
print(result.detected_source_lang) -- "EN"
```

### Formal translation

```lua
local result = app.integrations.deepl.translate({
  text = "Hello, how are you?",
  target_lang = "DE",
  formality = "more"
})

print(result.text) -- "Hallo, wie geht es Ihnen?"
```

---

## batch_translate

Translate multiple texts at once to a single target language.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `texts` | array | yes | Array of text strings to translate |
| `target_lang` | string | yes | Target language code |
| `source_lang` | string | no | Source language code. Omit to auto-detect |
| `formality` | string | no | `"default"`, `"more"`, or `"less"` |

### Example

```lua
local result = app.integrations.deepl.batch_translate({
  texts = {
    "Good morning",
    "Thank you",
    "See you later"
  },
  target_lang = "FR"
})

for _, t in ipairs(result.translations) do
  print(t.original .. " → " .. t.translated)
end

-- Good morning → Bonjour
-- Thank you → Merci
-- See you later → À plus tard
```

---

## detect_language

Detect the language of a text.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text to identify the language of |

### Example

```lua
local result = app.integrations.deepl.detect_language({
  text = "Guten Tag, wie geht es Ihnen?"
})

print(result.language_code) -- "DE"
print(result.language_name) -- "German"
```

---

## get_usage

Check your DeepL API usage for the current billing period.

### Parameters

None.

### Example

```lua
local result = app.integrations.deepl.get_usage()

print("Characters used: " .. result.character_count)
print("Character limit: " .. result.character_limit)
print("Usage: " .. result.percentage_used .. "%")
```

---

## list_languages

List all languages supported by DeepL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter: `"source"` or `"target"`. Omit for all languages |

### Example

```lua
-- All target languages
local result = app.integrations.deepl.list_languages({
  type = "target"
})

for _, lang in ipairs(result.languages) do
  print(lang.code .. ": " .. lang.name)
  if lang.supports_formality then
    print("  (supports formality)")
  end
end
```

---

## Multi-Account Usage

If you have multiple DeepL accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.deepl.translate({ text = "Hello", target_lang = "DE" })

-- Explicit default (portable across setups)
app.integrations.deepl.default.translate({ text = "Hello", target_lang = "DE" })

-- Named accounts
app.integrations.deepl.marketing.translate({ text = "Hello", target_lang = "DE" })
app.integrations.deepl.support.translate({ text = "Hello", target_lang = "DE" })
```

All functions are identical across accounts — only the credentials differ.
