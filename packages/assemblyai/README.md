# Integration: AssemblyAI

AssemblyAI integration for OpenCompany agents: pre-recorded transcription, uploads, transcript exports, deletion, temporary Streaming STT tokens, and LLM Gateway chat completions.

## Configuration

```php
return [
    'assemblyai' => [
        'api_key' => env('ASSEMBLYAI_API_KEY'),
        'url' => env('ASSEMBLYAI_URL', 'https://api.assemblyai.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `assemblyai_transcribe` | write | Submit an audio or video URL for transcription |
| `assemblyai_get_transcript` | read | Retrieve a transcript by ID |
| `assemblyai_delete_transcript` | write | Delete transcript data |
| `assemblyai_get_paragraphs` | read | Export transcript paragraphs |
| `assemblyai_get_sentences` | read | Export transcript sentences |
| `assemblyai_get_subtitles` | read | Export SRT or VTT subtitle text |
| `assemblyai_get_redacted_audio` | read | Retrieve generated redacted audio |
| `assemblyai_list_transcripts` | read | List transcripts with pagination |
| `assemblyai_upload` | write | Upload a local audio/video file |
| `assemblyai_create_streaming_token` | read | Generate a temporary Streaming STT token |
| `assemblyai_llm_gateway_chat` | read | Create an LLM Gateway chat completion |

## Service Usage

```php
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

$service = app(AssemblyAIService::class);

$transcript = $service->transcribe([
    'audio_url' => 'https://example.test/podcast.mp3',
    'speech_models' => ['universal-3-pro', 'universal-2'],
    'speaker_labels' => true,
]);

$paragraphs = $service->getParagraphs($transcript['id']);
$subtitles = $service->getSubtitles($transcript['id'], 'vtt');
$token = $service->createStreamingToken(60, 3600);

$chat = $service->chatCompletion([
    'model' => 'claude-sonnet-4-5-20250929',
    'prompt' => 'Summarize this transcript.',
]);
```

## Endpoint Notes

The REST base URL defaults to `https://api.assemblyai.com/v2`. Temporary streaming tokens use `https://streaming.assemblyai.com/v3/token`, and LLM Gateway chat uses `https://llm-gateway.assemblyai.com/v1/chat/completions`.

The old generated `get_lemons` and `get_current_user` tools were removed because they do not map to the current documented API reference.
