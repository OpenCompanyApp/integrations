# Integration: Granola

Granola Enterprise API integration for the OpenCompany integration ecosystem.
It gives agents read-only access to meeting notes, detailed transcripts and
summaries, and folder hierarchy metadata.

## Configuration

This package requires a Granola Enterprise API key.

```php
return [
    'granola' => [
        'api_key' => env('GRANOLA_API_KEY'),
        'url'     => env('GRANOLA_URL', 'https://public-api.granola.ai/v1'),
    ],
];
```

The official API is read-only. This package intentionally does not expose
generated legacy tools for creating notes, sharing meetings, or getting a
current user profile because those endpoints are not in the current public API.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `granola_list_notes` | read | List accessible meeting notes with pagination and date filters |
| `granola_get_note` | read | Get one note with transcript, summary, attendees, and calendar data |
| `granola_list_folders` | read | List accessible folders and parent folder relationships |

## Standalone Service Usage

```php
use OpenCompany\Integrations\Granola\GranolaService;

$service = new GranolaService('granola_test_key');

$notes = $service->listNotes([
    'page_size' => 10,
    'created_after' => '2026-01-01',
]);

$note = $service->getNote('not_1d3tmYTlCICgjy');
$folders = $service->listFolders(['page_size' => 30]);
```

## Agent Docs

See `script-docs/granola.md` for JavaScript namespace examples and return-shape notes.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A Granola account with Enterprise API access

## License

MIT - see [LICENSE](LICENSE)
