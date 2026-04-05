<?php

namespace OpenCompany\Integrations\Metabase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Metabase\Tools\MetabaseListDashboards;
use OpenCompany\Integrations\Metabase\Tools\MetabaseGetDashboard;
use OpenCompany\Integrations\Metabase\Tools\MetabaseListCards;
use OpenCompany\Integrations\Metabase\Tools\MetabaseGetCard;
use OpenCompany\Integrations\Metabase\Tools\MetabaseQueryCard;
use OpenCompany\Integrations\Metabase\Tools\MetabaseListDatabases;
use OpenCompany\Integrations\Metabase\Tools\MetabaseGetDatabase;
use OpenCompany\Integrations\Metabase\Tools\MetabaseGetCurrentUser;

class MetabaseToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'metabase';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'dashboards, cards, databases',
            'description' => 'Business intelligence & analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:metabase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Metabase',
            'description' => 'Open-source business intelligence dashboards and analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:metabase',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://www.metabase.com/docs/latest/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Metabase URL',
                'placeholder' => 'https://your-metabase.example.com',
                'hint' => 'The base URL of your Metabase instance (e.g., <code>https://metabase.example.com</code>)',
                'required' => true,
            ],
            [
                'key' => 'username',
                'type' => 'string',
                'label' => 'Username',
                'placeholder' => 'user@example.com',
                'hint' => 'The Metabase account email or username used to authenticate API requests',
                'required' => true,
            ],
            [
                'key' => 'password',
                'type' => 'secret',
                'label' => 'Password',
                'placeholder' => 'Enter your Metabase password',
                'hint' => 'The password for the Metabase account. Stored securely.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $hostname = rtrim($config['hostname'] ?? '', '/');
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        if (empty($hostname) || empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Hostname, username, and password are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($hostname . '/api/session', [
                'username' => $username,
                'password' => $password,
            ]);

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();
                return [
                    'success' => false,
                    'error' => 'Authentication failed: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Metabase at {$hostname}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'hostname' => 'required|url',
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'metabase_list_dashboards' => [
                'class' => MetabaseListDashboards::class,
                'type' => 'read',
                'name' => 'List Dashboards',
                'description' => 'List all dashboards in Metabase.',
                'icon' => 'ph:squares-four',
            ],
            'metabase_get_dashboard' => [
                'class' => MetabaseGetDashboard::class,
                'type' => 'read',
                'name' => 'Get Dashboard',
                'description' => 'Get a dashboard with its cards and layout.',
                'icon' => 'ph:squares-four',
            ],
            'metabase_list_cards' => [
                'class' => MetabaseListCards::class,
                'type' => 'read',
                'name' => 'List Cards',
                'description' => 'List all cards (questions) in Metabase.',
                'icon' => 'ph:credit-card',
            ],
            'metabase_get_card' => [
                'class' => MetabaseGetCard::class,
                'type' => 'read',
                'name' => 'Get Card',
                'description' => 'Get the definition of a card (question).',
                'icon' => 'ph:credit-card',
            ],
            'metabase_query_card' => [
                'class' => MetabaseQueryCard::class,
                'type' => 'read',
                'name' => 'Query Card',
                'description' => 'Execute a card (question) and return results.',
                'icon' => 'ph:play',
            ],
            'metabase_list_databases' => [
                'class' => MetabaseListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all connected databases.',
                'icon' => 'ph:database',
            ],
            'metabase_get_database' => [
                'class' => MetabaseGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get database metadata including tables and fields.',
                'icon' => 'ph:database',
            ],
            'metabase_get_current_user' => [
                'class' => MetabaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Metabase user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/metabase.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Metabase URL', 'required' => true],
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => true],
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

            $service = new MetabaseService(
                username: $creds->get('metabase', 'username', '', $account),
                password: $creds->get('metabase', 'password', '', $account),
                hostname: $creds->get('metabase', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MetabaseService::class));
    }
}
