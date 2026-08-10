<?php

namespace OpenCompany\Integrations\Anthropic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicCancelMessageBatch;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicCountMessageTokens;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicCreateMessage;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicCreateMessageBatch;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicDeleteFile;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicDeleteMessageBatch;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicDownloadFile;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetApiKey;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetCurrentUser;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetFile;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetMessageBatch;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetMessageBatchResults;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetModel;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetOrganization;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetUser;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicGetWorkspace;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListApiKeys;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListFiles;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListMessageBatches;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListMessages;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListModels;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListUsers;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicListWorkspaces;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicRemoveUser;
use OpenCompany\Integrations\Anthropic\Tools\AnthropicUpdateUser;

/**
 * Registers the integration provider and exposes its tools.
 */
class AnthropicToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'anthropic';
    }

/**
     * Short metadata for UI display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Anthropic',
            'description' => 'Anthropic Claude AI',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:anthropic',
        ];
    }

/**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Anthropic',
            'description' => 'Anthropic Claude AI for messages, token counting, batches, files, models, and organization administration.',
            'icon' => 'ph:brain',
            'logo' => 'simple-icons:anthropic',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.anthropic.com/en/docs',
        ];
    }/**
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
                'placeholder' => 'Enter your Anthropic API key',
                'hint' => 'Find your API key in the <a href="https://console.anthropic.com/settings/keys" target="_blank">Anthropic Console</a> under API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.anthropic.com/v1',
                'hint' => 'Use the default Anthropic API URL, or a compatible proxy URL',
                'default' => 'https://api.anthropic.com/v1',
            ],
            [
                'key' => 'admin_key',
                'type' => 'secret',
                'label' => 'Admin API Key',
                'placeholder' => 'Enter your Anthropic Admin API key',
                'hint' => 'Optional. Required only for organization, user, workspace, and API key administration tools.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to the Anthropic API.
     *
     * @param  array  $config  Configuration values to test with.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.anthropic.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/models', [
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Anthropic API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? ($json['error'] ?? 'Unknown error');
                return ['success' => false, 'error' => is_string($error) ? "API error: {$error}" : 'API error: ' . json_encode($error)];
            }

            return [
                'success' => true,
                'message' => "Connected to Anthropic API at {$baseUrl}.",
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
            'admin_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Anthropic tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'anthropic_list_messages' => [
                'class' => AnthropicListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in the Anthropic conversation history.',
                'icon' => 'ph:list',
            ],
            'anthropic_create_message' => [
                'class' => AnthropicCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Send a prompt to Claude and receive a response.',
                'icon' => 'ph:chat-circle-text',
            ],
            'anthropic_count_message_tokens' => [
                'class' => AnthropicCountMessageTokens::class,
                'type' => 'read',
                'name' => 'Count Message Tokens',
                'description' => 'Count input tokens for a Messages API payload.',
                'icon' => 'ph:calculator',
            ],
            'anthropic_create_message_batch' => [
                'class' => AnthropicCreateMessageBatch::class,
                'type' => 'write',
                'name' => 'Create Message Batch',
                'description' => 'Create an asynchronous Message Batch.',
                'icon' => 'ph:stack-plus',
            ],
            'anthropic_list_message_batches' => [
                'class' => AnthropicListMessageBatches::class,
                'type' => 'read',
                'name' => 'List Message Batches',
                'description' => 'List Message Batches in the API key workspace.',
                'icon' => 'ph:stack',
            ],
            'anthropic_get_message_batch' => [
                'class' => AnthropicGetMessageBatch::class,
                'type' => 'read',
                'name' => 'Get Message Batch',
                'description' => 'Get processing status for one Message Batch.',
                'icon' => 'ph:info',
            ],
            'anthropic_cancel_message_batch' => [
                'class' => AnthropicCancelMessageBatch::class,
                'type' => 'write',
                'name' => 'Cancel Message Batch',
                'description' => 'Cancel an in-progress Message Batch.',
                'icon' => 'ph:x-circle',
            ],
            'anthropic_delete_message_batch' => [
                'class' => AnthropicDeleteMessageBatch::class,
                'type' => 'write',
                'name' => 'Delete Message Batch',
                'description' => 'Delete a completed Message Batch.',
                'icon' => 'ph:trash',
            ],
            'anthropic_get_message_batch_results' => [
                'class' => AnthropicGetMessageBatchResults::class,
                'type' => 'read',
                'name' => 'Get Message Batch Results',
                'description' => 'Retrieve JSONL results for a completed Message Batch.',
                'icon' => 'ph:file-text',
            ],
            'anthropic_list_models' => [
                'class' => AnthropicListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available Anthropic AI models.',
                'icon' => 'ph:list',
            ],
            'anthropic_get_model' => [
                'class' => AnthropicGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get details for a specific Anthropic model.',
                'icon' => 'ph:info',
            ],
            'anthropic_list_files' => [
                'class' => AnthropicListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files in the API key workspace.',
                'icon' => 'ph:files',
            ],
            'anthropic_get_file' => [
                'class' => AnthropicGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get metadata for one Anthropic file.',
                'icon' => 'ph:file',
            ],
            'anthropic_delete_file' => [
                'class' => AnthropicDeleteFile::class,
                'type' => 'write',
                'name' => 'Delete File',
                'description' => 'Delete one Anthropic file.',
                'icon' => 'ph:trash',
            ],
            'anthropic_download_file' => [
                'class' => AnthropicDownloadFile::class,
                'type' => 'read',
                'name' => 'Download File',
                'description' => 'Download content for a downloadable code-execution file.',
                'icon' => 'ph:download',
            ],
            'anthropic_get_organization' => [
                'class' => AnthropicGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Get organization information using the Admin API.',
                'icon' => 'ph:buildings',
            ],
            'anthropic_list_workspaces' => [
                'class' => AnthropicListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Organization Workspaces',
                'description' => 'List Anthropic organization workspaces using the Admin API.',
                'icon' => 'ph:folders',
            ],
            'anthropic_get_workspace' => [
                'class' => AnthropicGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Organization Workspace',
                'description' => 'Get one Anthropic organization workspace using the Admin API.',
                'icon' => 'ph:folder',
            ],
            'anthropic_list_users' => [
                'class' => AnthropicListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List organization users using the Admin API.',
                'icon' => 'ph:users',
            ],
            'anthropic_get_user' => [
                'class' => AnthropicGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get one organization user using the Admin API.',
                'icon' => 'ph:user',
            ],
            'anthropic_update_user' => [
                'class' => AnthropicUpdateUser::class,
                'type' => 'write',
                'name' => 'Update User',
                'description' => 'Update an organization user role using the Admin API.',
                'icon' => 'ph:user-gear',
            ],
            'anthropic_remove_user' => [
                'class' => AnthropicRemoveUser::class,
                'type' => 'write',
                'name' => 'Remove User',
                'description' => 'Remove an organization user using the Admin API.',
                'icon' => 'ph:user-minus',
            ],
            'anthropic_list_api_keys' => [
                'class' => AnthropicListApiKeys::class,
                'type' => 'read',
                'name' => 'List API Keys',
                'description' => 'List organization API keys using the Admin API.',
                'icon' => 'ph:key',
            ],
            'anthropic_get_api_key' => [
                'class' => AnthropicGetApiKey::class,
                'type' => 'read',
                'name' => 'Get API Key',
                'description' => 'Get one organization API key metadata record using the Admin API.',
                'icon' => 'ph:key',
            ],
            'anthropic_get_current_user' => [
                'class' => AnthropicGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Organization Alias',
                'description' => 'Backward-compatible alias for organization information; requires an Admin API key.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the JavaScript API documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/anthropic.md';
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.anthropic.com/v1'],
            ['key' => 'admin_key', 'type' => 'secret', 'label' => 'Admin API Key', 'required' => false],
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
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new AnthropicService(
                apiKey: $creds->get('anthropic', 'api_key', '', $account),
                baseUrl: $creds->get('anthropic', 'url', 'https://api.anthropic.com/v1', $account),
                adminKey: $creds->get('anthropic', 'admin_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(AnthropicService::class));
    }
}
