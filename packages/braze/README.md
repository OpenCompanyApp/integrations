# Integration: Braze

Braze integration for OpenCompany and KosmoKrator agents. It exposes the Braze REST API for campaigns, Canvases, users, messaging, catalogs, templates, subscriptions, SCIM, SDK authentication, and analytics.

## Configuration

Create a Braze REST API key in Settings > APIs and Identifiers > API Keys. Braze keys are scoped per endpoint, so the key must include the permissions for the tools an agent will call.

Required credentials:

| Key | Description |
|-----|-------------|
| `api_key` | Braze REST API key. |
| `url` | Braze REST endpoint for the workspace region. Defaults to `https://rest.iad-01.braze.com`. |

Examples of Braze REST endpoints include `https://rest.iad-01.braze.com` and `https://rest.fra-01.braze.eu`. Use the REST endpoint shown next to the API key in Braze, not the SDK endpoint.

## Coverage

The package includes focused tools for:

- Catalogs, catalog items, catalog fields, and catalog selections
- Cloud Data Ingestion integrations and syncs
- Email bounces, unsubscribes, status updates, spam removal, and blocklisting
- Campaign and Canvas lists, details, analytics, URL info, and duplication
- Events, KPIs, sessions, purchases, segments, and custom attributes
- Message sends, scheduled messages, campaign triggers, Canvas triggers, transactional email, and Live Activities
- Preference centers
- SCIM dashboard users
- SDK authentication keys
- SMS invalid number handling and subscription group status
- Content Blocks and email templates
- User aliases, identify, track, bulk/sync track, delete, merge, external ID migration, and user exports
- Raw `api_get`, `api_post`, `api_put`, `api_patch`, and `api_delete` escape hatches for new or specialized Braze endpoints

## Quick Start

```php
use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns;
use OpenCompany\Integrations\Braze\Tools\BrazeTrackUsers;

$service = app(BrazeService::class);

$campaigns = (new BrazeListCampaigns($service))->execute([
    'page' => 0,
    'limit' => 10,
]);

$tracked = (new BrazeTrackUsers($service))->execute([
    'payload' => [
        'attributes' => [
            ['external_id' => 'user_123', 'email' => 'person@example.test'],
        ],
    ],
]);
```

## Tool Provider

The Laravel service provider registers `BrazeToolProvider` with the `ToolProviderRegistry` when the registry is available. The provider supports multi-account credentials through `CredentialResolver`.

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Braze\Tools\BrazeSendMessages;

$provider = app(ToolProviderRegistry::class)->get('braze');
$tool = $provider->createTool(BrazeSendMessages::class, ['account' => 'eu']);
```

## Requirements

- PHP 8.2+
- Laravel host application
- `opencompanyapp/integration-core`
- Braze account with REST API access

## License

MIT. See [LICENSE](LICENSE).
