# New Relic Integration

New Relic APM integration for Laravel. Monitor applications, deployments, alert policies, and dashboards via the New Relic NerdGraph API.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `newrelic_list_applications` | read | List APM applications |
| `newrelic_get_application` | read | Get details of a specific application |
| `newrelic_list_deployments` | read | List deployment events for an application |
| `newrelic_create_deployment` | write | Record a new deployment |
| `newrelic_list_alert_policies` | read | List alert policies |
| `newrelic_list_dashboards` | read | List dashboards |
| `newrelic_get_current_user` | read | Get the authenticated user profile |

## Configuration

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `api_key` | secret | yes | New Relic API key (User key or Personal API key) |
| `account_id` | string | yes | New Relic account ID |
| `url` | url | no | NerdGraph endpoint (default: `https://api.newrelic.com/graphql`) |

## Installation

```bash
composer require opencompanyapp/integration-newrelic
```
