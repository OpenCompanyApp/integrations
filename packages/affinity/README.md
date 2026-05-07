# Integration: Affinity

Affinity integration for the OpenCompany integration ecosystem. It targets the
current Affinity API v2 for relationship intelligence data: persons, companies,
opportunities, lists, list entries, field values, saved views, notes,
interactions, transcripts, and semantic search.

API reference: https://developer.affinity.co/docs/v2/

## Installation

```console
composer require opencompanyapp/integration-affinity
```

Laravel auto-discovers the service provider.

## Configuration

Affinity API v2 uses the API key as a bearer token.

```php
return [
    'affinity' => [
        'api_key' => env('AFFINITY_API_KEY'),
        'url' => env('AFFINITY_URL', 'https://api.affinity.co'),
    ],
];
```

## Tool Coverage

The provider exposes 52 tools:

- Auth: current user
- Persons: list, get, create compatibility helper, fields, field values, lists, list entries, notes
- Companies: list, get, create compatibility helper, fields, field values, lists, list entries, notes
- Opportunities: list, get, notes
- Lists: list, get, fields, entries, entry fields, update field values, batch field updates
- Saved views: list, get, entries
- Notes: list, get, replies, attached persons, companies, opportunities
- Interactions: calls, emails, meetings, chat messages, transcripts, transcript fragments
- Semantic search
- Raw helpers: `affinity_api_get`, `affinity_api_post`, `affinity_api_put`, `affinity_api_delete`

Raw helpers accept relative paths such as `/persons` or `/v2/persons`.
Absolute URLs and parent-directory paths are rejected.

## Notes

- New dedicated tools use Affinity v2 endpoint names such as persons and companies.
- Legacy tool names such as `affinity_list_contacts` and `affinity_list_organizations` remain available for host compatibility.
- Raw helpers can call documented legacy `/v1/...` paths when a v2 endpoint does not exist.

## License

MIT
