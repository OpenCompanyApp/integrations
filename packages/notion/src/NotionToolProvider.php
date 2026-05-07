<?php

namespace OpenCompany\Integrations\Notion;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Notion\Tools\NotionAppendBlockChildren;
use OpenCompany\Integrations\Notion\Tools\NotionArchivePage;
use OpenCompany\Integrations\Notion\Tools\NotionCreateComment;
use OpenCompany\Integrations\Notion\Tools\NotionCreateDatabase;
use OpenCompany\Integrations\Notion\Tools\NotionCreatePage;
use OpenCompany\Integrations\Notion\Tools\NotionDeleteBlock;
use OpenCompany\Integrations\Notion\Tools\NotionGetBlock;
use OpenCompany\Integrations\Notion\Tools\NotionGetBlockChildren;
use OpenCompany\Integrations\Notion\Tools\NotionGetComments;
use OpenCompany\Integrations\Notion\Tools\NotionGetCurrentUser;
use OpenCompany\Integrations\Notion\Tools\NotionGetDatabase;
use OpenCompany\Integrations\Notion\Tools\NotionGetPage;
use OpenCompany\Integrations\Notion\Tools\NotionGetUser;
use OpenCompany\Integrations\Notion\Tools\NotionListDatabases;
use OpenCompany\Integrations\Notion\Tools\NotionListUsers;
use OpenCompany\Integrations\Notion\Tools\NotionQueryDatabase;
use OpenCompany\Integrations\Notion\Tools\NotionSearch;
use OpenCompany\Integrations\Notion\Tools\NotionUpdateBlock;
use OpenCompany\Integrations\Notion\Tools\NotionUpdateDatabase;
use OpenCompany\Integrations\Notion\Tools\NotionUpdatePage;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all available Notion tools and provides integration metadata, configuration schema, and connection testing.
 */
class NotionToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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

    public function appName(): string
    {
        return 'notion';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Notion',
            'description' => 'Knowledge management',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:notion',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Notion',
            'description' => 'Pages, databases, blocks, search, and comments',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:notion',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.notion.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Internal Integration Secret',
                'placeholder' => 'secret_...',
                'hint' => 'Create an integration at <a href="https://www.notion.so/my-integrations" target="_blank">notion.so/my-integrations</a> and share it with the pages/databases you need.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Create one at Notion → My Integrations.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Notion-Version' => '2022-06-28',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.notion.com/v1/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name'] ?? 'Unknown bot';

                return [
                    'success' => true,
                    'message' => "Connected to Notion as \"{$name}\".",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Notion API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Search
            'notion_search' => [
                'class' => NotionSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search pages and databases in Notion.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Pages
            'notion_create_page' => [
                'class' => NotionCreatePage::class,
                'type' => 'write',
                'name' => 'Create Page',
                'description' => 'Create a new page in Notion.',
                'icon' => 'ph:plus-circle',
            ],
            'notion_get_page' => [
                'class' => NotionGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get page details by ID.',
                'icon' => 'ph:file-text',
            ],
            'notion_update_page' => [
                'class' => NotionUpdatePage::class,
                'type' => 'write',
                'name' => 'Update Page',
                'description' => 'Update page properties.',
                'icon' => 'ph:pencil-simple',
            ],
            'notion_archive_page' => [
                'class' => NotionArchivePage::class,
                'type' => 'write',
                'name' => 'Archive Page',
                'description' => 'Archive a page.',
                'icon' => 'ph:archive',
            ],
            // Databases
            'notion_create_database' => [
                'class' => NotionCreateDatabase::class,
                'type' => 'write',
                'name' => 'Create Database',
                'description' => 'Create a new database in a page.',
                'icon' => 'ph:table',
            ],
            'notion_get_database' => [
                'class' => NotionGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get database schema by ID.',
                'icon' => 'ph:table',
            ],
            'notion_update_database' => [
                'class' => NotionUpdateDatabase::class,
                'type' => 'write',
                'name' => 'Update Database',
                'description' => 'Update database title and properties.',
                'icon' => 'ph:table',
            ],
            'notion_query_database' => [
                'class' => NotionQueryDatabase::class,
                'type' => 'read',
                'name' => 'Query Database',
                'description' => 'Query database rows with filters and sorts.',
                'icon' => 'ph:funnel',
            ],
            'notion_list_databases' => [
                'class' => NotionListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases via search.',
                'icon' => 'ph:table',
            ],
            // Blocks
            'notion_get_block_children' => [
                'class' => NotionGetBlockChildren::class,
                'type' => 'read',
                'name' => 'Get Block Children',
                'description' => 'Get child blocks of a page or block.',
                'icon' => 'ph:list',
            ],
            'notion_append_block_children' => [
                'class' => NotionAppendBlockChildren::class,
                'type' => 'write',
                'name' => 'Append Block Children',
                'description' => 'Append blocks to a page or block.',
                'icon' => 'ph:plus-circle',
            ],
            'notion_get_block' => [
                'class' => NotionGetBlock::class,
                'type' => 'read',
                'name' => 'Get Block',
                'description' => 'Get a block by ID.',
                'icon' => 'ph:square',
            ],
            'notion_update_block' => [
                'class' => NotionUpdateBlock::class,
                'type' => 'write',
                'name' => 'Update Block',
                'description' => 'Update block content.',
                'icon' => 'ph:pencil-simple',
            ],
            'notion_delete_block' => [
                'class' => NotionDeleteBlock::class,
                'type' => 'write',
                'name' => 'Delete Block',
                'description' => 'Delete a block.',
                'icon' => 'ph:trash',
            ],
            // Users
            'notion_get_current_user' => [
                'class' => NotionGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current integration bot user.',
                'icon' => 'ph:robot',
            ],
            'notion_list_users' => [
                'class' => NotionListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List all users in the workspace.',
                'icon' => 'ph:users',
            ],
            'notion_get_user' => [
                'class' => NotionGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a user by ID.',
                'icon' => 'ph:user',
            ],
            // Comments
            'notion_create_comment' => [
                'class' => NotionCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Create a comment on a page.',
                'icon' => 'ph:chat-circle',
            ],
            'notion_get_comments' => [
                'class' => NotionGetComments::class,
                'type' => 'read',
                'name' => 'Get Comments',
                'description' => 'Get comments on a page.',
                'icon' => 'ph:chat-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/notion.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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
     * Resolve the NotionService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): NotionService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $apiKey = $creds->get('notion', 'api_key', '', $account)
                ?: $creds->get('notion', 'access_token', '', $account)
                ?: $creds->get('notion2', 'api_key', '', $account)
                ?: $creds->get('notion2', 'access_token', '', $account);

            return new NotionService(
                apiKey: $apiKey,
            );
        }

        return app(NotionService::class);
    }
}
