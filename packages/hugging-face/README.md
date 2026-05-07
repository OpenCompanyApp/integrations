# Integration: Hugging Face

> Hugging Face integration for the [Laravel AI SDK](https://github.com/laravel/ai) - list models, datasets, Spaces, run inference, and manage your account. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the Hugging Face Hub. Search models and datasets, run serverless inference, explore Spaces, and retrieve account info - all through the [Hugging Face API](https://huggingface.co/docs/hub/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Hugging Face tool lets AI agents search the model hub, run inference, and explore datasets and Spaces - giving agents direct access to the world's largest collection of AI models.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-hugging-face
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Hugging Face User Access Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'hugging-face' => [
        'access_token' => env('HUGGINGFACE_ACCESS_TOKEN'),
        'url'           => env('HUGGINGFACE_API_URL', 'https://huggingface.co/api'),
        'inference_url' => env('HUGGINGFACE_INFERENCE_URL', 'https://router.huggingface.co/hf-inference/models'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `huggingface_list_models` | read | Search and list AI models on the Hub |
| `huggingface_get_model` | read | Get detailed info about a specific model |
| `huggingface_list_datasets` | read | Search and list datasets on the Hub |
| `huggingface_get_dataset` | read | Get detailed info about a specific dataset |
| `huggingface_inference` | write | Run inference on a model via the Inference API |
| `huggingface_list_spaces` | read | Search and list Spaces on the Hub |
| `huggingface_get_space` | read | Get detailed info about a specific Space |
| `huggingface_get_current_user` | read | Get the authenticated user's profile |
| `huggingface_list_commits` | read | List commits for a model, dataset, or Space repository |
| `huggingface_list_refs` | read | List branches and tags for a repository |
| `huggingface_list_tree` | read | List repository files and folders |
| `huggingface_get_scan_status` | read | Get repository security scan status |
| `huggingface_list_model_tags` | read | List model tags grouped by type |
| `huggingface_list_dataset_tags` | read | List dataset tags grouped by type |
| `huggingface_list_space_hardware` | read | List available Space hardware options |
| `huggingface_create_repo` | write | Create a model, dataset, or Space repository |
| `huggingface_api_get` | read | Call an unwrapped relative Hub API GET endpoint |
| `huggingface_api_post` | write | Call an unwrapped relative Hub API POST endpoint |
| `huggingface_api_put` | write | Call an unwrapped relative Hub API PUT endpoint |
| `huggingface_api_delete` | write | Call an unwrapped relative Hub API DELETE endpoint |

## Quick Start

```php
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceListModels;
use OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceInference;

// Create tools
$service = app(HuggingFaceService::class);
$tools = [
    new HuggingFaceListModels($service),
    new HuggingFaceInference($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find the most downloaded text generation model and run a quick test');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 20 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('hugging-face');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\HuggingFace\Tools\HuggingFaceInference::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

$service = app(HuggingFaceService::class);

// Search models
$models = $service->listModels(['search' => 'llama', 'sort' => 'downloads', 'limit' => 5]);

// Get model details
$model = $service->getModel('meta-llama/Llama-3.3-70B-Instruct');

// Run inference
$result = $service->inference('meta-llama/Llama-3.3-70B-Instruct', [
    'inputs' => 'What is the meaning of life?',
    'parameters' => ['max_new_tokens' => 100],
]);

// List datasets
$datasets = $service->listDatasets(['search' => 'sentiment']);

// List Spaces
$spaces = $service->listSpaces(['search' => 'chat']);

// List repository files
$files = $service->listTree('models', 'bert-base-uncased');

// Get current user
$user = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Hugging Face](https://huggingface.co) account with an Access Token

## License

MIT - see [LICENSE](LICENSE)
