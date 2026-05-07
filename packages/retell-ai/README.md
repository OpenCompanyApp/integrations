# Integration: Retell AI

> Retell AI API integration for Laravel agents. Manage calls, voice agents, phone numbers, Retell LLMs, voices, and documented API endpoints.

This package uses the official Retell API base URL `https://api.retellai.com`. Call operations remain under `/v2/...`, while agents, phone numbers, LLMs, and voices use root API paths such as `/create-agent` and `/list-voices`.

## Installation

```console
composer require opencompanyapp/integration-retell-ai
```

Laravel auto-discovers the service provider.

## Configuration

```php
return [
    'retell-ai' => [
        'api_key' => env('RETELL_AI_API_KEY'),
        'url' => env('RETELL_AI_URL', 'https://api.retellai.com'),
    ],
];
```

Older configs using `https://api.retellai.com/v2` are normalized to the API root internally.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `retell_ai_create_call` | write | Create a phone call. |
| `retell_ai_create_web_call` | write | Create a web call. |
| `retell_ai_get_call` | read | Get a call by ID. |
| `retell_ai_list_calls` | read | List calls. |
| `retell_ai_update_call` | write | Update call metadata. |
| `retell_ai_stop_call` | write | Stop an in-progress call. |
| `retell_ai_delete_call` | write | Delete a call record. |
| `retell_ai_list_agents` | read | List voice agents. |
| `retell_ai_get_agent` | read | Get a voice agent. |
| `retell_ai_create_agent` | write | Create a voice agent. |
| `retell_ai_update_agent` | write | Update a voice agent. |
| `retell_ai_delete_agent` | write | Delete a voice agent. |
| `retell_ai_list_phone_numbers` | read | List phone numbers. |
| `retell_ai_get_phone_number` | read | Get a phone number. |
| `retell_ai_update_phone_number` | write | Update phone number routing. |
| `retell_ai_list_retell_llms` | read | List Retell LLMs. |
| `retell_ai_get_retell_llm` | read | Get a Retell LLM. |
| `retell_ai_list_voices` | read | List voices. |
| `retell_ai_get_voice` | read | Get a voice. |
| `retell_ai_get_current_user` | read | Compatibility connectivity check using list agents. |
| `retell_ai_api_get` | read | Call a documented GET endpoint. |
| `retell_ai_api_post` | write | Call a documented POST endpoint. |
| `retell_ai_api_patch` | write | Call a documented PATCH endpoint. |
| `retell_ai_api_delete` | write | Call a documented DELETE endpoint. |

## Service Usage

```php
use OpenCompany\Integrations\RetellAI\RetellAIService;

$service = app(RetellAIService::class);

$agents = $service->listAgents();
$voices = $service->listVoices();
$numbers = $service->listPhoneNumbers();

$call = $service->createCall('agent_123', ['customer_id' => 'cus_123'], [
    'from_number' => '+14155550100',
    'to_number' => '+14155550199',
]);

$service->updateCall($call['call_id'], [
    'metadata' => ['status' => 'reviewed'],
]);
```

## Generic Helpers

Use generic helpers for documented Retell endpoints that are not yet first-class tools:

```php
$flows = $service->apiGet('/list-conversation-flows');
$llm = $service->apiPost('/create-retell-llm', [
    'general_prompt' => 'You are a helpful support agent.',
]);
```

Absolute URLs are rejected so agents cannot bypass the configured Retell API host.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- Retell AI API key

## License

MIT - see [LICENSE](LICENSE).
