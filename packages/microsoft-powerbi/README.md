# Microsoft Power BI Integration

List reports, datasets, workspaces, and user info from Microsoft Power BI.

## Installation

```json
{
    "repositories": [
        {"type": "path", "url": "../integrations/packages/microsoft-powerbi"}
    ],
    "require": {
        "opencompanyapp/integration-microsoft-powerbi": "@dev"
    }
}
```

## Configuration

Add to `config/ai-tools.php`:

```php
'microsoft_powerbi' => [
    'access_token' => env('POWERBI_ACCESS_TOKEN'),
    'url'          => env('POWERBI_URL', 'https://api.powerbi.com/v1.0/myorg'),
],
```

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `powerbi_list_reports` | read | List all reports |
| `powerbi_get_report` | read | Get a report by ID |
| `powerbi_list_datasets` | read | List all datasets |
| `powerbi_get_dataset` | read | Get a dataset by ID |
| `powerbi_list_workspaces` | read | List all workspaces (groups) |
| `powerbi_get_current_user` | read | Get current user profile |

## Authentication

This integration uses an Azure AD access token with Power BI API permissions. You can obtain a token via:

1. **Azure AD app registration** — Register an app in the Azure portal, grant Power BI API permissions, and use the client credentials flow.
2. **Power BI embedded** — Use the Power BI .NET SDK or REST API to generate an embed token.

See the [Power BI REST API documentation](https://learn.microsoft.com/en-us/rest/api/power-bi/) for details.

## License

MIT
