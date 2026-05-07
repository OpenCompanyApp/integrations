<?php

namespace OpenCompany\Integrations\Openrouter;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterApiDelete;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterApiGet;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterApiPatch;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterApiPost;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCountModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateApiKey;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateCompletion;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateEmbedding;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateMessage;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateResponse;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateVideo;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterCreateWorkspace;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterDeleteApiKey;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterDeleteWorkspace;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetActivity;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetApiKey;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetCredits;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetCurrentUser;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetGeneration;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetGenerationContent;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetUsage;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetVideo;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterGetWorkspace;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListApiKeys;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListEmbeddingModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListGenerations;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListGuardrails;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListModelEndpoints;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListOrganizationMembers;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListProviders;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListUserModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListVideoModels;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterListWorkspaces;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterRerank;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterUpdateApiKey;
use OpenCompany\Integrations\Openrouter\Tools\OpenrouterUpdateWorkspace;

/**
 * Registers the integration provider and exposes its tools.
 */
class OpenrouterToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }
    /**
     * The application name used for registration.
     */
    public function appName(): string
    {
        return 'openrouter';
    }

    /**
     * Short metadata for UI display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'OpenRouter',
            'description' => 'OpenRouter AI Gateway',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:openrouter',
        ];
    }

    /**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenRouter',
            'description' => 'OpenRouter AI gateway for model routing, responses, embeddings, reranking, media jobs, account keys, workspaces, providers, and usage.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:openrouter',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://openrouter.ai/docs/api-reference',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your OpenRouter API key',
                'hint' => 'Find your API key in the <a href="https://openrouter.ai/settings/keys" target="_blank">OpenRouter Settings</a> under API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://openrouter.ai/api/v1',
                'hint' => 'Use the default OpenRouter API URL, or a compatible proxy URL',
                'default' => 'https://openrouter.ai/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the OpenRouter API.
     *
     * @param  array  $config  Configuration values to test with.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://openrouter.ai/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/models');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach OpenRouter API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? ($json['error'] ?? 'Unknown error');
                return ['success' => false, 'error' => is_string($error) ? "API error: {$error}" : 'API error: ' . json_encode($error)];
            }

            return [
                'success' => true,
                'message' => "Connected to OpenRouter API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available OpenRouter tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'openrouter_list_models' => [
                'class' => OpenrouterListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available AI models on OpenRouter.',
                'icon' => 'ph:list',
            ],
            'openrouter_create_completion' => [
                'class' => OpenrouterCreateCompletion::class,
                'type' => 'write',
                'name' => 'Create Completion',
                'description' => 'Create a chat completion using any OpenRouter model.',
                'icon' => 'ph:chat-circle-text',
            ],
            'openrouter_create_response' => [
                'class' => OpenrouterCreateResponse::class,
                'type' => 'write',
                'name' => 'Create Response',
                'description' => 'Create a response through the Responses-compatible endpoint.',
                'icon' => 'ph:sparkle',
            ],
            'openrouter_create_message' => [
                'class' => OpenrouterCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Create a message through the messages endpoint.',
                'icon' => 'ph:chat-centered-text',
            ],
            'openrouter_create_embedding' => [
                'class' => OpenrouterCreateEmbedding::class,
                'type' => 'write',
                'name' => 'Create Embedding',
                'description' => 'Create embeddings using an OpenRouter embedding model.',
                'icon' => 'ph:circles-three',
            ],
            'openrouter_list_embedding_models' => [
                'class' => OpenrouterListEmbeddingModels::class,
                'type' => 'read',
                'name' => 'List Embedding Models',
                'description' => 'List models that support embeddings.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'openrouter_rerank' => [
                'class' => OpenrouterRerank::class,
                'type' => 'write',
                'name' => 'Rerank Documents',
                'description' => 'Rerank documents for a query using OpenRouter reranking models.',
                'icon' => 'ph:sort-ascending',
            ],
            'openrouter_list_generations' => [
                'class' => OpenrouterListGenerations::class,
                'type' => 'read',
                'name' => 'List Generations',
                'description' => 'List generation records from OpenRouter.',
                'icon' => 'ph:list',
            ],
            'openrouter_get_generation' => [
                'class' => OpenrouterGetGeneration::class,
                'type' => 'read',
                'name' => 'Get Generation',
                'description' => 'Get details for a specific OpenRouter generation.',
                'icon' => 'ph:info',
            ],
            'openrouter_get_generation_content' => [
                'class' => OpenrouterGetGenerationContent::class,
                'type' => 'read',
                'name' => 'Get Generation Content',
                'description' => 'Get stored prompt and completion content for a generation.',
                'icon' => 'ph:file-text',
            ],
            'openrouter_count_models' => [
                'class' => OpenrouterCountModels::class,
                'type' => 'read',
                'name' => 'Count Models',
                'description' => 'Count available models with optional OpenRouter filters.',
                'icon' => 'ph:hash',
            ],
            'openrouter_list_user_models' => [
                'class' => OpenrouterListUserModels::class,
                'type' => 'read',
                'name' => 'List User Models',
                'description' => 'List models filtered by the account preferences and guardrails.',
                'icon' => 'ph:user-list',
            ],
            'openrouter_list_model_endpoints' => [
                'class' => OpenrouterListModelEndpoints::class,
                'type' => 'read',
                'name' => 'List Model Endpoints',
                'description' => 'List provider endpoints for a specific OpenRouter model.',
                'icon' => 'ph:plugs',
            ],
            'openrouter_list_providers' => [
                'class' => OpenrouterListProviders::class,
                'type' => 'read',
                'name' => 'List Providers',
                'description' => 'List OpenRouter providers and availability metadata.',
                'icon' => 'ph:buildings',
            ],
            'openrouter_get_credits' => [
                'class' => OpenrouterGetCredits::class,
                'type' => 'read',
                'name' => 'Get Credits',
                'description' => 'Get the account credit balance.',
                'icon' => 'ph:coins',
            ],
            'openrouter_get_activity' => [
                'class' => OpenrouterGetActivity::class,
                'type' => 'read',
                'name' => 'Get Activity',
                'description' => 'Get account activity with optional filters.',
                'icon' => 'ph:pulse',
            ],
            'openrouter_list_api_keys' => [
                'class' => OpenrouterListApiKeys::class,
                'type' => 'read',
                'name' => 'List API Keys',
                'description' => 'List API keys for the OpenRouter account.',
                'icon' => 'ph:key',
            ],
            'openrouter_get_api_key' => [
                'class' => OpenrouterGetApiKey::class,
                'type' => 'read',
                'name' => 'Get API Key',
                'description' => 'Get one API key by hash.',
                'icon' => 'ph:keyhole',
            ],
            'openrouter_create_api_key' => [
                'class' => OpenrouterCreateApiKey::class,
                'type' => 'write',
                'name' => 'Create API Key',
                'description' => 'Create an API key with OpenRouter key limits and metadata.',
                'icon' => 'ph:key-plus',
            ],
            'openrouter_update_api_key' => [
                'class' => OpenrouterUpdateApiKey::class,
                'type' => 'write',
                'name' => 'Update API Key',
                'description' => 'Update an OpenRouter API key by hash.',
                'icon' => 'ph:pencil-simple',
            ],
            'openrouter_delete_api_key' => [
                'class' => OpenrouterDeleteApiKey::class,
                'type' => 'write',
                'name' => 'Delete API Key',
                'description' => 'Delete an OpenRouter API key by hash.',
                'icon' => 'ph:trash',
            ],
            'openrouter_get_usage' => [
                'class' => OpenrouterGetUsage::class,
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Get usage statistics for the OpenRouter account.',
                'icon' => 'ph:chart-bar',
            ],
            'openrouter_get_current_user' => [
                'class' => OpenrouterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user',
            ],
            'openrouter_list_organization_members' => [
                'class' => OpenrouterListOrganizationMembers::class,
                'type' => 'read',
                'name' => 'List Organization Members',
                'description' => 'List OpenRouter organization members.',
                'icon' => 'ph:users-three',
            ],
            'openrouter_list_workspaces' => [
                'class' => OpenrouterListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List OpenRouter workspaces.',
                'icon' => 'ph:squares-four',
            ],
            'openrouter_get_workspace' => [
                'class' => OpenrouterGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get one OpenRouter workspace.',
                'icon' => 'ph:square',
            ],
            'openrouter_create_workspace' => [
                'class' => OpenrouterCreateWorkspace::class,
                'type' => 'write',
                'name' => 'Create Workspace',
                'description' => 'Create an OpenRouter workspace.',
                'icon' => 'ph:squares-four',
            ],
            'openrouter_update_workspace' => [
                'class' => OpenrouterUpdateWorkspace::class,
                'type' => 'write',
                'name' => 'Update Workspace',
                'description' => 'Update an OpenRouter workspace.',
                'icon' => 'ph:pencil',
            ],
            'openrouter_delete_workspace' => [
                'class' => OpenrouterDeleteWorkspace::class,
                'type' => 'write',
                'name' => 'Delete Workspace',
                'description' => 'Delete an OpenRouter workspace.',
                'icon' => 'ph:trash-simple',
            ],
            'openrouter_list_guardrails' => [
                'class' => OpenrouterListGuardrails::class,
                'type' => 'read',
                'name' => 'List Guardrails',
                'description' => 'List guardrails configured for the account.',
                'icon' => 'ph:shield-check',
            ],
            'openrouter_list_video_models' => [
                'class' => OpenrouterListVideoModels::class,
                'type' => 'read',
                'name' => 'List Video Models',
                'description' => 'List models that support video generation.',
                'icon' => 'ph:video-camera',
            ],
            'openrouter_create_video' => [
                'class' => OpenrouterCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Submit a video generation request.',
                'icon' => 'ph:film-strip',
            ],
            'openrouter_get_video' => [
                'class' => OpenrouterGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Poll video generation job status.',
                'icon' => 'ph:play-circle',
            ],
            'openrouter_api_get' => [
                'class' => OpenrouterApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a safe relative OpenRouter GET path for newly released endpoints.',
                'icon' => 'ph:terminal-window',
            ],
            'openrouter_api_post' => [
                'class' => OpenrouterApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a safe relative OpenRouter POST path for newly released endpoints.',
                'icon' => 'ph:terminal-window',
            ],
            'openrouter_api_patch' => [
                'class' => OpenrouterApiPatch::class,
                'type' => 'write',
                'name' => 'API PATCH',
                'description' => 'Call a safe relative OpenRouter PATCH path for newly released endpoints.',
                'icon' => 'ph:terminal-window',
            ],
            'openrouter_api_delete' => [
                'class' => OpenrouterApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a safe relative OpenRouter DELETE path for newly released endpoints.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/openrouter.md';
    }

    /**
     * Credential fields required for multi-account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://openrouter.ai/api/v1'],
        ];
    }

    /**
     * Confirm this provider is an integration (not just standalone tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array  $context  Context containing optional 'account' key for multi-account.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new OpenrouterService(
                apiKey: $creds->get('openrouter', 'api_key', '', $account),
                baseUrl: $creds->get('openrouter', 'url', 'https://openrouter.ai/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(OpenrouterService::class));
    }
}
