# Integration: Clearbit

Clearbit data enrichment for AI agents: person enrichment, company enrichment, combined person/company enrichment, Reveal IP-to-company lookup, Prospector, Discovery, company autocomplete, legacy name-to-domain, legacy risk, and a read-only endpoint escape hatch.

## Installation

```console
composer require opencompanyapp/integration-clearbit
```

Laravel auto-discovers the service provider.

## Configuration

Most Clearbit endpoints require an API key from an existing Clearbit customer account. Company autocomplete is public and does not require authentication. Clearbit's Name to Domain and Risk APIs are legacy unsupported APIs for existing customers.

```php
return [
    'clearbit' => [
        'api_key' => env('CLEARBIT_API_KEY'),
        'url' => env('CLEARBIT_PERSON_URL', 'https://person.clearbit.com/v2'),
    ],
];
```

The optional `url` field only overrides the Person API host. Other API families use their canonical Clearbit hosts:

- `person.clearbit.com`
- `company.clearbit.com`
- `autocomplete.clearbit.com`
- `prospector.clearbit.com`
- `reveal.clearbit.com`
- `discovery.clearbit.com`
- `risk.clearbit.com`

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `clearbit_enrich_person` | read | Enrich a person by email |
| `clearbit_enrich_combined` | read | Enrich a person and associated company by email |
| `clearbit_enrich_company` | read | Enrich a company by domain |
| `clearbit_reveal` | read | Identify the company behind an IP address |
| `clearbit_prospect` | read | Find people by domain, role, seniority, title, or company |
| `clearbit_list_autocomplete` | read | Search public company autocomplete by name |
| `clearbit_name_to_domain` | read | Resolve a company name to domain and logo |
| `clearbit_discovery_search` | read | Search Clearbit Discovery companies |
| `clearbit_calculate_risk` | read | Calculate a legacy Clearbit Risk score |
| `clearbit_api_get` | read | Call a read-only endpoint on a named Clearbit API host |

## Service Usage

```php
use OpenCompany\Integrations\Clearbit\ClearbitService;

$service = app(ClearbitService::class);

$person = $service->enrichPerson('person@example.test');
$combined = $service->enrichCombined('person@example.test');
$company = $service->enrichCompany('example.test');
$reveal = $service->reveal('203.0.113.10');
$prospects = $service->prospect(['domain' => 'example.test', 'roles' => 'sales,engineering']);
$suggestions = $service->autocomplete('Example');
$domain = $service->nameToDomain('Example');
```

## Notes

- Clearbit APIs use separate hosts per product family. This package routes requests to the correct host instead of using one global base URL.
- `clearbit_list_autocomplete` works without an API key.
- `clearbit_name_to_domain` and `clearbit_calculate_risk` are marked in docs as legacy unsupported APIs for existing customers.
- The former current-user account check was removed from the provider because current Clearbit docs and official clients do not expose a user/account endpoint.

## Dependencies

| Package | Purpose |
|---------|---------|
| `opencompanyapp/integration-core` | ToolProvider contract and registry |

## License

MIT
