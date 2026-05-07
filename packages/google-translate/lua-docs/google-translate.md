# Google Translate

Google Translate tools are exposed under `app.integrations.google_translate`. This package is generated from Google's official Cloud Translation API v3 Discovery document and exposes 51 REST methods.

## Coverage

- Source: `https://translate.googleapis.com/$discovery/rest?version=v3`
- Read tools: 21
- Write tools: 30
- Base URL: `https://translate.googleapis.com`

## Usage Notes

Pass resource names such as `projects/my-project`, `projects/my-project/locations/global`, glossaries, datasets, models, and operation names exactly as Google documents them. Path parameters use reserved expansion where Discovery declares `{+name}`, `{+parent}`, or `{+dataset}` so slash-delimited resource names are preserved. Query parameters can be passed as top-level shortcuts or inside `query`. Translation, detection, document, glossary, model, dataset, adaptive MT, and operation methods accept the official JSON request object inside `body`.

Long-running batch and model/dataset operations return Google operation resources; poll with the generated operations tools.

## Tools

- `google_translate_projects_get_supported_languages` - GET /v3/{+parent}/supportedLanguages
- `google_translate_projects_detect_language` - POST /v3/{+parent}:detectLanguage
- `google_translate_projects_translate_text` - POST /v3/{+parent}:translateText
- `google_translate_projects_romanize_text` - POST /v3/{+parent}:romanizeText
- `google_translate_projects_locations_refine_text` - POST /v3/{+parent}:refineText
- `google_translate_projects_locations_get` - GET /v3/{+name}
- `google_translate_projects_locations_translate_text` - POST /v3/{+parent}:translateText
- `google_translate_projects_locations_adaptive_mt_translate` - POST /v3/{+parent}:adaptiveMtTranslate
- `google_translate_projects_locations_list` - GET /v3/{+name}/locations
- `google_translate_projects_locations_translate_document` - POST /v3/{+parent}:translateDocument
- `google_translate_projects_locations_get_supported_languages` - GET /v3/{+parent}/supportedLanguages
- `google_translate_projects_locations_batch_translate_text` - POST /v3/{+parent}:batchTranslateText
- `google_translate_projects_locations_detect_language` - POST /v3/{+parent}:detectLanguage
- `google_translate_projects_locations_batch_translate_document` - POST /v3/{+parent}:batchTranslateDocument
- `google_translate_projects_locations_romanize_text` - POST /v3/{+parent}:romanizeText
- `google_translate_projects_locations_models_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_models_list` - GET /v3/{+parent}/models
- `google_translate_projects_locations_models_get` - GET /v3/{+name}
- `google_translate_projects_locations_models_create` - POST /v3/{+parent}/models
- `google_translate_projects_locations_operations_get` - GET /v3/{+name}
- `google_translate_projects_locations_operations_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_operations_cancel` - POST /v3/{+name}:cancel
- `google_translate_projects_locations_operations_list` - GET /v3/{+name}/operations
- `google_translate_projects_locations_operations_wait` - POST /v3/{+name}:wait
- `google_translate_projects_locations_datasets_import_data` - POST /v3/{+dataset}:importData
- `google_translate_projects_locations_datasets_create` - POST /v3/{+parent}/datasets
- `google_translate_projects_locations_datasets_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_datasets_get` - GET /v3/{+name}
- `google_translate_projects_locations_datasets_export_data` - POST /v3/{+dataset}:exportData
- `google_translate_projects_locations_datasets_list` - GET /v3/{+parent}/datasets
- `google_translate_projects_locations_datasets_examples_list` - GET /v3/{+parent}/examples
- `google_translate_projects_locations_glossaries_patch` - PATCH /v3/{+name}
- `google_translate_projects_locations_glossaries_list` - GET /v3/{+parent}/glossaries
- `google_translate_projects_locations_glossaries_create` - POST /v3/{+parent}/glossaries
- `google_translate_projects_locations_glossaries_get` - GET /v3/{+name}
- `google_translate_projects_locations_glossaries_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_glossaries_glossary_entries_get` - GET /v3/{+name}
- `google_translate_projects_locations_glossaries_glossary_entries_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_glossaries_glossary_entries_create` - POST /v3/{+parent}/glossaryEntries
- `google_translate_projects_locations_glossaries_glossary_entries_list` - GET /v3/{+parent}/glossaryEntries
- `google_translate_projects_locations_glossaries_glossary_entries_patch` - PATCH /v3/{+name}
- `google_translate_projects_locations_adaptive_mt_datasets_list` - GET /v3/{+parent}/adaptiveMtDatasets
- `google_translate_projects_locations_adaptive_mt_datasets_import_adaptive_mt_file` - POST /v3/{+parent}:importAdaptiveMtFile
- `google_translate_projects_locations_adaptive_mt_datasets_create` - POST /v3/{+parent}/adaptiveMtDatasets
- `google_translate_projects_locations_adaptive_mt_datasets_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_adaptive_mt_datasets_get` - GET /v3/{+name}
- `google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_sentences_list` - GET /v3/{+parent}/adaptiveMtSentences
- `google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_delete` - DELETE /v3/{+name}
- `google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_get` - GET /v3/{+name}
- `google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_list` - GET /v3/{+parent}/adaptiveMtFiles
- `google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_adaptive_mt_sentences_list` - GET /v3/{+parent}/adaptiveMtSentences

## Examples

```lua
local translated = app.integrations.google_translate.google_translate_projects_translate_text({
  parent = "projects/example-project",
  body = { contents = { "Hello" }, targetLanguageCode = "es" }
})

local languages = app.integrations.google_translate.google_translate_projects_locations_get_supported_languages({
  parent = "projects/example-project/locations/global"
})
```

Responses are decoded Cloud Translation JSON responses, or `{ success = true, status = ... }` for successful empty responses.
