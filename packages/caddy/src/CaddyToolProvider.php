<?php

namespace OpenCompany\Integrations\Caddy;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Caddy\Tools\CaddyListSites;
use OpenCompany\Integrations\Caddy\Tools\CaddyGetSite;
use OpenCompany\Integrations\Caddy\Tools\CaddyCreateSite;
use OpenCompany\Integrations\Caddy\Tools\CaddyDeleteSite;
use OpenCompany\Integrations\Caddy\Tools\CaddyListCertificates;
use OpenCompany\Integrations\Caddy\Tools\CaddyGetCertificate;
use OpenCompany\Integrations\Caddy\Tools\CaddyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CaddyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'caddy';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Caddy',
            'description' => 'Web server management',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:caddy',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Caddy',
            'description' => 'Powerful, enterprise-ready web server with automatic HTTPS',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:caddy',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://caddyserver.com/docs/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Caddy API token',
                'hint' => 'Generate an API token from your Caddy dashboard or admin panel',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.caddyserver.com/v1',
                'hint' => 'Use the default Caddy API URL, or a custom endpoint if using a self-hosted instance',
                'default' => 'https://api.caddyserver.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.caddyserver.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
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
                    'error' => "Could not reach Caddy API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                $username = $json['username'] ?? $json['email'] ?? 'unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Caddy API as {$username}.",
                ];
            }

            $errors = $json['errors'] ?? [];
            $errorMessages = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);

            return [
                'success' => false,
                'error' => implode('; ', $errorMessages) ?: 'Authentication failed.',
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
            'caddy_list_sites' => [
                'class' => CaddyListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all Caddy sites.',
                'icon' => 'ph:list',
            ],
            'caddy_get_site' => [
                'class' => CaddyGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific site.',
                'icon' => 'ph:globe',
            ],
            'caddy_create_site' => [
                'class' => CaddyCreateSite::class,
                'type' => 'write',
                'name' => 'Create Site',
                'description' => 'Create a new site in Caddy.',
                'icon' => 'ph:plus-circle',
            ],
            'caddy_delete_site' => [
                'class' => CaddyDeleteSite::class,
                'type' => 'write',
                'name' => 'Delete Site',
                'description' => 'Delete a site from Caddy.',
                'icon' => 'ph:trash',
            ],
            'caddy_list_certificates' => [
                'class' => CaddyListCertificates::class,
                'type' => 'read',
                'name' => 'List Certificates',
                'description' => 'List all TLS certificates.',
                'icon' => 'ph:shield-check',
            ],
            'caddy_get_certificate' => [
                'class' => CaddyGetCertificate::class,
                'type' => 'read',
                'name' => 'Get Certificate',
                'description' => 'Get details for a specific certificate.',
                'icon' => 'ph:shield-check',
            ],
            'caddy_get_current_user' => [
                'class' => CaddyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/caddy.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.caddyserver.com/v1'],
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

            $service = new CaddyService(
                accessToken: $creds->get('caddy', 'access_token', '', $account),
                baseUrl: $creds->get('caddy', 'url', 'https://api.caddyserver.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CaddyService::class));
    }
}
