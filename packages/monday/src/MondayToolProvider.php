<?php

namespace OpenCompany\Integrations\Monday;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Monday\Tools\MondayCreateBoard;
use OpenCompany\Integrations\Monday\Tools\MondayCreateItem;
use OpenCompany\Integrations\Monday\Tools\MondayCreateUpdate;
use OpenCompany\Integrations\Monday\Tools\MondayDeleteItem;
use OpenCompany\Integrations\Monday\Tools\MondayGetBoardColumns;
use OpenCompany\Integrations\Monday\Tools\MondayGetItem;
use OpenCompany\Integrations\Monday\Tools\MondayGetMe;
use OpenCompany\Integrations\Monday\Tools\MondayListBoards;
use OpenCompany\Integrations\Monday\Tools\MondayListItems;
use OpenCompany\Integrations\Monday\Tools\MondayListUpdates;
use OpenCompany\Integrations\Monday\Tools\MondayListUsers;
use OpenCompany\Integrations\Monday\Tools\MondayListWorkspaces;
use OpenCompany\Integrations\Monday\Tools\MondayMoveItemToGroup;
use OpenCompany\Integrations\Monday\Tools\MondayUpdateItem;
use OpenCompany\Integrations\Monday\Tools\MondayUploadFile;

/**
 * Registers all Monday.com tools and provides integration metadata.
 *
 * Exposes 15 tools covering boards, items, updates, workspaces,
 * and users via the ToolProvider contract.
 */
class MondayToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'monday';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'boards, items, updates, workspaces, and users',
            'description' => 'Project Management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:mondaydotcom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Monday.com',
            'description' => 'Boards, items, updates, workspaces, and users',
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
                'placeholder' => 'Your Monday.com Personal Access Token',
                'hint' => 'Generate at <code>https://developer.monday.com/api-reference/docs/authentication</code> under your account settings.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Monday.com connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'API Token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.monday.com/v2', [
                'query' => '{ me { id name email } }',
            ]);

            if ($response->successful()) {
                $json = $response->json();

                if (isset($json['errors']) && ! empty($json['errors'])) {
                    return [
                        'success' => false,
                        'error' => 'GraphQL error: ' . ($json['errors'][0]['message'] ?? 'Unknown error'),
                    ];
                }

                $me = $json['data']['me'] ?? [];
                $name = $me['name'] ?? 'Unknown';
                $email = $me['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Monday.com as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Monday.com API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Items
            'monday_create_item' => [
                'class' => MondayCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item on a Monday.com board.',
                'icon' => 'ph:plus-circle',
            ],
            'monday_get_item' => [
                'class' => MondayGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get detailed information about a Monday.com item.',
                'icon' => 'ph:note',
            ],
            'monday_update_item' => [
                'class' => MondayUpdateItem::class,
                'type' => 'write',
                'name' => 'Update Item',
                'description' => 'Update column values on an existing Monday.com item.',
                'icon' => 'ph:pencil-simple',
            ],
            'monday_list_items' => [
                'class' => MondayListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items on a Monday.com board with optional filtering.',
                'icon' => 'ph:list-checks',
            ],
            'monday_delete_item' => [
                'class' => MondayDeleteItem::class,
                'type' => 'write',
                'name' => 'Delete Item',
                'description' => 'Delete an item from a Monday.com board.',
                'icon' => 'ph:trash',
            ],
            // Boards
            'monday_create_board' => [
                'class' => MondayCreateBoard::class,
                'type' => 'write',
                'name' => 'Create Board',
                'description' => 'Create a new board on Monday.com.',
                'icon' => 'ph:folder-plus',
            ],
            'monday_list_boards' => [
                'class' => MondayListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List boards on Monday.com with optional filters.',
                'icon' => 'ph:folders',
            ],
            'monday_get_board_columns' => [
                'class' => MondayGetBoardColumns::class,
                'type' => 'read',
                'name' => 'Get Board Columns',
                'description' => 'Get the column structure of a Monday.com board.',
                'icon' => 'ph:columns',
            ],
            // Updates (comments)
            'monday_create_update' => [
                'class' => MondayCreateUpdate::class,
                'type' => 'write',
                'name' => 'Create Update',
                'description' => 'Add an update (comment) to a Monday.com item.',
                'icon' => 'ph:chat-circle-text',
            ],
            'monday_list_updates' => [
                'class' => MondayListUpdates::class,
                'type' => 'read',
                'name' => 'List Updates',
                'description' => 'List updates (comments) on a Monday.com item.',
                'icon' => 'ph:chats-circle',
            ],
            // Workspaces & Users
            'monday_list_workspaces' => [
                'class' => MondayListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List workspaces on Monday.com.',
                'icon' => 'ph:buildings',
            ],
            'monday_list_users' => [
                'class' => MondayListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users on a Monday.com account.',
                'icon' => 'ph:users',
            ],
            // Files
            'monday_upload_file' => [
                'class' => MondayUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to a column on a Monday.com item.',
                'icon' => 'ph:upload-simple',
            ],
            // Groups
            'monday_move_item_to_group' => [
                'class' => MondayMoveItemToGroup::class,
                'type' => 'write',
                'name' => 'Move Item to Group',
                'description' => 'Move a Monday.com item to a different group.',
                'icon' => 'ph:arrows-out-line-horizontal',
            ],
            // Current User
            'monday_get_me' => [
                'class' => MondayGetMe::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Monday.com user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/monday.md';
    }

    public function credentialFields(): array
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
