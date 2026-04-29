<?php

namespace OpenCompany\Integrations\Monday;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Monday\Tools\MondayListBoards;
use OpenCompany\Integrations\Monday\Tools\MondayGetBoard;
use OpenCompany\Integrations\Monday\Tools\MondayListItems;
use OpenCompany\Integrations\Monday\Tools\MondayGetItem;
use OpenCompany\Integrations\Monday\Tools\MondayCreateItem;
use OpenCompany\Integrations\Monday\Tools\MondayListWorkspaces;
use OpenCompany\Integrations\Monday\Tools\MondayGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all available Monday.com tools and provides integration metadata, configuration schema, and connection testing.
 */
class MondayToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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

    public function appName(): string
    {
        return 'monday';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Monday.com',
            'description' => 'Work OS',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:mondaydotcom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Monday.com',
            'description' => 'Work OS — boards, items, workspaces, and project tracking',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:mondaydotcom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.monday.com/api-reference/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'eyJhbGciOi...',
                'hint' => 'Generate at Monday.com → Avatar → Developers → API tokens, or use an OAuth token.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate one at Monday.com → Avatar → Developers → API tokens.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.monday.com/v2', [
                'query' => '{ me { id name } }',
            ]);

            $body = $response->json() ?? [];

            if (isset($body['errors'])) {
                $messages = array_map(fn (array $err) => $err['message'] ?? json_encode($err), $body['errors']);

                return [
                    'success' => false,
                    'error' => 'Monday.com API error: ' . implode('; ', $messages),
                ];
            }

            $name = $body['data']['me']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Monday.com as \"{$name}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'monday_list_boards' => [
                'class' => MondayListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List Monday.com boards.',
                'icon' => 'ph:kanban',
            ],
            'monday_get_board' => [
                'class' => MondayGetBoard::class,
                'type' => 'read',
                'name' => 'Get Board',
                'description' => 'Get a single board with columns and groups.',
                'icon' => 'ph:clipboard-text',
            ],
            'monday_list_items' => [
                'class' => MondayListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items on a board.',
                'icon' => 'ph:list-checks',
            ],
            'monday_get_item' => [
                'class' => MondayGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get a single item with column values.',
                'icon' => 'ph:clipboard-text',
            ],
            'monday_create_item' => [
                'class' => MondayCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item on a board.',
                'icon' => 'ph:plus-circle',
            ],
            'monday_list_workspaces' => [
                'class' => MondayListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List workspaces.',
                'icon' => 'ph:folders',
            ],
            'monday_get_current_user' => [
                'class' => MondayGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:robot',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/monday.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MondayService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): MondayService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MondayService(
                apiToken: $creds->get('monday', 'api_token', '', $account),
            );
        }

        return app(MondayService::class);
    }
}
