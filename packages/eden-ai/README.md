# Integration: Eden AI

Eden AI integration for the OpenCompany integration ecosystem. It exposes the current Eden AI V3 AI gateway, plus legacy V2 helper tools for accounts that still use the old API.

## Configuration

```php
return [
    'eden-ai' => [
        'api_key' => env('EDEN_AI_API_KEY'),
        'url' => env('EDEN_AI_URL', 'https://api.edenai.run/v2'),
        'v3_url' => env('EDEN_AI_V3_URL', 'https://api.edenai.run/v3'),
    ],
];
```

Eden AI V3 uses `https://api.edenai.run/v3` with bearer authentication. Eden AI states that users from before `2026-01-05` retain access to the previous version until the end of 2026, so this package keeps the V2 tools and labels them as legacy.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `edenai_chat_completions` | write | Create a V3 OpenAI-compatible chat completion |
| `edenai_list_models` | read | List V3 LLM models and capabilities |
| `edenai_universal_ai` | write | Call V3 Universal AI synchronously |
| `edenai_universal_ai_async` | write | Submit a V3 Universal AI async job |
| `edenai_get_universal_ai_job` | read | Fetch a V3 Universal AI async result |
| `edenai_list_features` | read | List V3 expert model features |
| `edenai_get_feature_info` | read | Get V3 feature/subfeature details |
| `edenai_upload_file` | write | Upload a file to V3 persistent storage |
| `edenai_delete_all_uploaded_files` | write | Delete all V3 uploaded files |
| `edenai_generate_text` | write | Legacy V2 text generation |
| `edenai_analyze_image` | read | Legacy V2 image analysis |
| `edenai_translate_text` | write | Legacy V2 translation |
| `edenai_transcribe_audio` | read | Legacy V2 audio transcription |
| `edenai_ocr` | read | Legacy V2 OCR |
| `edenai_get_current_user` | read | Legacy V2 user/account info |
| `edenai_api_get` | read | Generic V2 GET |
| `edenai_api_post` | write | Generic V2 POST |
| `edenai_v3_api_get` | read | Generic V3 GET |
| `edenai_v3_api_post` | write | Generic V3 POST |

## V3 Examples

```php
use OpenCompany\Integrations\EdenAi\EdenAiService;

$service = app(EdenAiService::class);

$chat = $service->chatCompletions([
    'model' => 'openai/gpt-4o',
    'messages' => [
        ['role' => 'user', 'content' => 'Summarize this note.'],
    ],
]);

$features = $service->listFeatures();

$ocr = $service->universalAi([
    'model' => 'ocr/ocr/google',
    'input' => [
        'file' => 'https://example.test/invoice.pdf',
    ],
]);
```

## Notes

- V3 LLM model IDs use `provider/model`, for example `openai/gpt-4o`.
- V3 Universal AI model IDs use `feature/subfeature/provider[/model]`, for example `text/moderation/openai` or `ocr/ocr/amazon`.
- File uploads use multipart `/v3/upload` and return a file ID that can be reused in Universal AI requests.
- Do not commit real Eden AI API keys, uploaded file IDs, provider payloads, or private document URLs in tests or docs.

## License

MIT
