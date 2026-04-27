<?php

namespace OpenCompany\Integrations\Kintone;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Kintone\Tools\KintoneListRecords;
use OpenCompany\Integrations\Kintone\Tools\KintoneGetRecord;
use OpenCompany\Integrations\Kintone\Tools\KintoneCreateRecord;
use OpenCompany\Integrations\Kintone\Tools\KintoneListApps;
use OpenCompany\Integrations\Kintone\Tools\KintoneGetApp;
use OpenCompany\Integrations\Kintone\Tools\KintoneListSpaces;
use OpenCompany\Integrations\Kintone\Tools\KintoneGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KintoneToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'kintone';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'records, apps, spaces',
            'description' => 'Business application platform',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:kintone',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Kintone',
            'description' => 'Customizable business application platform for team workflows',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:kintone',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.kintone.io/hc/en-us/articles/360019245194',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Kintone API token',
                'hint' => 'Generate an API token in your Kintone app settings under the "App Settings > API Token" tab',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'example.cybozu.com',
                'hint' => 'Your Kintone domain (e.g., <code>example.cybozu.com</code>)',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $domain = rtrim($config['domain'] ?? '', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No domain provided'];
        }

        $baseUrl = str_starts_with($domain, 'http://') || str_starts_with($domain, 'https://')
            ? $domain
            : 'https://' . $domain;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Kintone API at {$baseUrl}. Check the domain.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Authentication failed: {$message}",
                ];
            }

            $userName = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Kintone as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'kintone_list_records' => [
                'class' => KintoneListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'Retrieve records from a Kintone app with optional filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'kintone_get_record' => [
                'class' => KintoneGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Retrieve a single record from a Kintone app by ID.',
                'icon' => 'ph:file-text',
            ],
            'kintone_create_record' => [
                'class' => KintoneCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in a Kintone app.',
                'icon' => 'ph:plus',
            ],
            'kintone_list_apps' => [
                'class' => KintoneListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List available Kintone apps.',
                'icon' => 'ph:squares-four',
            ],
            'kintone_get_app' => [
                'class' => KintoneGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details of a specific Kintone app.',
                'icon' => 'ph:squares-four',
            ],
            'kintone_list_spaces' => [
                'class' => KintoneListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'List Kintone spaces.',
                'icon' => 'ph:folder',
            ],
            'kintone_get_current_user' => [
                'class' => KintoneGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Kintone user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/kintone.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Kintone Domain', 'required' => true],
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

            $service = new KintoneService(
                accessToken: $creds->get('kintone', 'access_token', '', $account),
                domain: $creds->get('kintone', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(KintoneService::class));
    }
}
