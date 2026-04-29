<?php

namespace OpenCompany\Integrations\Netlify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListSites;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListDeploys;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetDeploy;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListForms;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListDnsZones;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NetlifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'netlify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Netlify',
            'description' => 'Deployment & hosting platform',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:netlify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Netlify',
            'description' => 'Modern web deployment and hosting platform',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:netlify',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.netlify.com/api/get-started/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'Enter your Netlify personal access token',
                'hint' => 'Create a personal access token in Netlify under User Settings → Applications → Personal access tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.netlify.com/api/v1',
                'hint' => 'Use the default Netlify API URL, or a custom endpoint if using a compatible API',
                'default' => 'https://api.netlify.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.netlify.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Netlify API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful() && isset($json['id'])) {
                $email = $json['email'] ?? 'unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Netlify API as {$email}.",
                ];
            }

            $message = $json['message'] ?? $json['error'] ?? 'Authentication failed.';

            return [
                'success' => false,
                'error' => $message,
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'netlify_list_sites' => [
                'class' => NetlifyListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all Netlify sites.',
                'icon' => 'ph:globe',
            ],
            'netlify_get_site' => [
                'class' => NetlifyGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific Netlify site.',
                'icon' => 'ph:globe',
            ],
            'netlify_list_deploys' => [
                'class' => NetlifyListDeploys::class,
                'type' => 'read',
                'name' => 'List Deploys',
                'description' => 'List deploys for a Netlify site.',
                'icon' => 'ph:list-dashes',
            ],
            'netlify_get_deploy' => [
                'class' => NetlifyGetDeploy::class,
                'type' => 'read',
                'name' => 'Get Deploy',
                'description' => 'Get details for a specific deploy.',
                'icon' => 'ph:rocket-launch',
            ],
            'netlify_list_forms' => [
                'class' => NetlifyListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List forms for a Netlify site.',
                'icon' => 'ph:notebook',
            ],
            'netlify_list_dns_zones' => [
                'class' => NetlifyListDnsZones::class,
                'type' => 'read',
                'name' => 'List DNS Zones',
                'description' => 'List all DNS zones in Netlify.',
                'icon' => 'ph:dns',
            ],
            'netlify_get_current_user' => [
                'class' => NetlifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/netlify.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.netlify.com/api/v1'],
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

            $service = new NetlifyService(
                accessToken: $creds->get('netlify', 'access_token', '', $account),
                baseUrl: $creds->get('netlify', 'url', 'https://api.netlify.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(NetlifyService::class));
    }
}
