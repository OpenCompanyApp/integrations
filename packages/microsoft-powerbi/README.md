# Legacy Microsoft Power BI Integration

This package is deprecated. Use `opencompanyapp/integration-microsoft-power-bi`,
which owns the canonical `powerbi` app namespace and the maintained Microsoft
Power BI REST API surface.

## Installation

```json
{
    "repositories": [
        {"type": "path", "url": "../integrations/packages/microsoft-power-bi"}
    ],
    "require": {
        "opencompanyapp/integration-microsoft-power-bi": "@dev"
    }
}
```

## Configuration

Add to `config/ai-tools.php`:

```php
'powerbi' => [
    'access_token' => env('POWERBI_ACCESS_TOKEN'),
    'url'          => env('POWERBI_URL', 'https://api.powerbi.com'),
],
```

## Tools

See `packages/microsoft-power-bi/script-docs/powerbi.md` for the maintained tool
list. The Power BI REST API does not expose a general current-user profile
endpoint in this integration.

## Authentication

This integration uses an Azure AD access token with Power BI API permissions. You can obtain a token via:

1. **Azure AD app registration** — Register an app in the Azure portal, grant Power BI API permissions, and use the client credentials flow.
2. **Power BI embedded** — Use the Power BI .NET SDK or REST API to generate an embed token.

See the [Power BI REST API documentation](https://learn.microsoft.com/en-us/rest/api/power-bi/) for details.

## License

MIT
