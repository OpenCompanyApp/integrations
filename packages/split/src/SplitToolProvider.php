<?php

namespace OpenCompany\Integrations\Split;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Split\Tools\SplitGetCurrentUser;
use OpenCompany\Integrations\Split\Tools\SplitGetSplit;
use OpenCompany\Integrations\Split\Tools\SplitListEnvironments;
use OpenCompany\Integrations\Split\Tools\SplitListSplits;
use OpenCompany\Integrations\Split\Tools\SplitListWorkspaces;
use OpenCompany\Integrations\Split\Tools\SplitCreateSplit;
use OpenCompany\Integrations\Split\Tools\SplitGetEnvironment;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SplitToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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

    public function appName(): string
    {
        return 'split';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'splits, environments, workspaces',
            'description' => 'Feature flags',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:splitio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Split',
            'description' => 'Feature flags and controlled rollouts',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:splitio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.split.io/reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Split API token',
                'hint' => 'Generate an API token in Split under Admin Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'workspace_id',
                'type' => 'text',
                'label' => 'Default Workspace ID',
                'placeholder' => 'Enter your workspace ID',
                'hint' => 'The Split workspace ID to use by default. Find it in your Split workspace settings.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.split.io/internal/api/v3',
                'hint' => 'Use <code>https://api.split.io/internal/api/v3</code> for the standard Split API, or your custom proxy URL',
                'default' => 'https://api.split.io/internal/api/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.split.io/internal/api/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Split API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['name'] ?? $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Split as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'workspace_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'split_list_splits' => [
                'class' => SplitListSplits::class,
                'type' => 'read',
                'name' => 'List Splits',
                'description' => 'List feature splits in a Split workspace.',
                'icon' => 'ph:flag',
            ],
            'split_get_split' => [
                'class' => SplitGetSplit::class,
                'type' => 'read',
                'name' => 'Get Split',
                'description' => 'Get details of a specific feature split.',
                'icon' => 'ph:flag',
            ],
            'split_create_split' => [
                'class' => SplitCreateSplit::class,
                'type' => 'write',
                'name' => 'Create Split',
                'description' => 'Create a new feature split in a workspace.',
                'icon' => 'ph:plus-circle',
            ],
            'split_list_environments' => [
                'class' => SplitListEnvironments::class,
                'type' => 'read',
                'name' => 'List Environments',
                'description' => 'List environments for a Split workspace.',
                'icon' => 'ph:tree-structure',
            ],
            'split_get_environment' => [
                'class' => SplitGetEnvironment::class,
                'type' => 'read',
                'name' => 'Get Environment',
                'description' => 'Get details of a specific Split environment.',
                'icon' => 'ph:tree-structure',
            ],
            'split_list_workspaces' => [
                'class' => SplitListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Split workspaces.',
                'icon' => 'ph:folder',
            ],
            'split_get_current_user' => [
                'class' => SplitGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Split user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/split.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'workspace_id', 'type' => 'text', 'label' => 'Workspace ID', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.split.io/internal/api/v3'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SplitService(
                accessToken: $creds->get('split', 'access_token', '', $account),
                workspaceId: $creds->get('split', 'workspace_id', '', $account),
                baseUrl: $creds->get('split', 'url', 'https://api.split.io/internal/api/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(SplitService::class));
    }
}
