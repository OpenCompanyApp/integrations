# DeepL JavaScript Docs

Namespace: `deepl`

DeepL tools call the official DeepL API. Configure an API key and base URL before use. Use `https://api.deepl.com` for paid plans or `https://api-free.deepl.com` for the free tier.

This integration mirrors DeepL's official OpenAPI document, including tools for text translation, document translation, v2 and v3 glossaries, glossary language pairs, write/rephrase, usage, supported languages, admin developer keys, admin analytics, style rules, translation memories, and voice realtime sessions.

Common tools:

```js
var translated = deepl.deepl_translate_text({
  body: {
    text: [ "Hello world" ],
    target_lang: "DE",
  }
})

var usage = deepl.deepl_get_usage({})

var languages = deepl.deepl_list_languages({
  type: "target",
})
```
Request bodies can be passed as a `body` object. DeepL operations that support both JSON and form bodies default to JSON; pass `content_type = "application/x-www-form-urlencoded"` when you need form encoding. Document upload uses `multipart/form-data` according to the upstream API.

The previous `deepl_get_current_user` tool has been removed because DeepL does not expose a current-user endpoint in the official OpenAPI definition. Use `deepl_get_usage` for account usage and limits.

Use fake text, glossary ids, and API keys in examples and tests. Do not store real DeepL API keys in committed fixtures.