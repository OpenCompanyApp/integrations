<?php

namespace OpenCompany\Integrations\Notion2;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Notion2\Tools\NotionListPages;
use OpenCompany\Integrations\Notion2\Tools\NotionGetPage;
use OpenCompany\Integrations\Notion2\Tools\NotionCreatePage;
use OpenCompany\Integrations\Notion2\Tools\NotionListDatabases;
use OpenCompany\Integrations\Notion2\Tools\NotionQueryDatabase;
use OpenCompany\Integrations\Notion2\Tools\NotionListUsers;
use OpenCompany\Integrations\Notion2\Tools\NotionGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NotionToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string { return 'notion2'; }

    public function appMeta(): array
    {
        return [
            'label' => 'Notion',
            'description' => 'Workspace',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:notion',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Notion',
            'description' => 'Pages, databases, and users from your Notion workspace',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:notion',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.notion.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Internal Integration Token',
                'placeholder' => 'secret_xxx…',
                'hint' => 'Create an internal integration at <code>https://www.notion.so/my-integrations</code> and paste the token here.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Internal Integration Token is required.'];
        }
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Notion-Version' => '2022-06-28',
            ])->timeout(10)->get('https://api.notion.com/v1/users/me');
            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = ($data['name'] ?? 'Unknown');
                $type = $data['type'] ?? '';
                $bot = ($data['bot'] ?? []) !== [] ? 'bot' : $type;
                return ['success' => true, 'message' => "Connected to Notion as {$name} ({$bot})."];
            }
            return ['success' => false, 'error' => 'Notion API error (' . $response->status() . '): ' . $response->body()];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'notion2_list_pages'      => ['class' => NotionListPages::class,      'type' => 'read',  'name' => 'List Pages',      'description' => 'Search and list pages in your Notion workspace.',        'icon' => 'ph:files'],
            'notion2_get_page'        => ['class' => NotionGetPage::class,         'type' => 'read',  'name' => 'Get Page',        'description' => 'Get detailed information about a Notion page.',          'icon' => 'ph:file-text'],
            'notion2_create_page'     => ['class' => NotionCreatePage::class,      'type' => 'write', 'name' => 'Create Page',     'description' => 'Create a new page in Notion.',                          'icon' => 'ph:file-plus'],
            'notion2_list_databases'  => ['class' => NotionListDatabases::class,   'type' => 'read',  'name' => 'List Databases',  'description' => 'List databases in your Notion workspace.',              'icon' => 'ph:database'],
            'notion2_query_database'  => ['class' => NotionQueryDatabase::class,   'type' => 'read',  'name' => 'Query Database',  'description' => 'Query a Notion database with optional filters.',        'icon' => 'ph:magnifying-glass'],
            'notion2_list_users'      => ['class' => NotionListUsers::class,       'type' => 'read',  'name' => 'List Users',      'description' => 'List all users in your Notion workspace.',              'icon' => 'ph:users'],
            'notion2_get_current_user'=> ['class' => NotionGetCurrentUser::class,  'type' => 'read',  'name' => 'Get Current User','description' => 'Get the currently authenticated Notion user/bot.',      'icon' => 'ph:user-circle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/notion2.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Internal Integration Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool { return true; }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    private function resolveService(array $context = []): NotionService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);
            return new NotionService(accessToken: $creds->get('notion2', 'access_token', '', $account));
        }
        return app(NotionService::class);
    }
}
