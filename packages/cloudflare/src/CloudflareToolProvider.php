<?php

namespace OpenCompany\Integrations\Cloudflare;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListZones;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetZone;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListDnsRecords;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareCreateDnsRecord;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareListPageRules;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetAnalytics;
use OpenCompany\Integrations\Cloudflare\Tools\CloudflareGetCurrentUser;

class CloudflareToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'cloudflare';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'zones, dns, pagerules, analytics',
            'description' => 'DNS & CDN management',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudflare',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cloudflare',
            'description' => 'DNS, CDN, and security management platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudflare',
            'category' => 'cloud',
            'badge' => 'verified',
            'docs_url' => 'https://developers.cloudflare.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Cloudflare API token',
                'hint' => 'Create an API token in the Cloudflare dashboard under My Profile → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cloudflare.com/client/v4',
                'hint' => 'Use the default Cloudflare API URL, or a custom endpoint if using a compatible API',
                'default' => 'https://api.cloudflare.com/client/v4',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cloudflare.com/client/v4', '/');

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
                    'error' => "Could not reach Cloudflare API at {$baseUrl}. Check the URL.",
                ];
            }

            if (isset($json['success']) && $json['success'] === true) {
                $username = $json['result']['username'] ?? 'unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Cloudflare API as {$username}.",
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
            'cloudflare_list_zones' => [
                'class' => CloudflareListZones::class,
                'type' => 'read',
                'name' => 'List Zones',
                'description' => 'List all Cloudflare zones (domains).',
                'icon' => 'ph:globe',
            ],
            'cloudflare_get_zone' => [
                'class' => CloudflareGetZone::class,
                'type' => 'read',
                'name' => 'Get Zone',
                'description' => 'Get details for a specific zone.',
                'icon' => 'ph:globe',
            ],
            'cloudflare_list_dns_records' => [
                'class' => CloudflareListDnsRecords::class,
                'type' => 'read',
                'name' => 'List DNS Records',
                'description' => 'List DNS records for a zone.',
                'icon' => 'ph:list-dashes',
            ],
            'cloudflare_create_dns_record' => [
                'class' => CloudflareCreateDnsRecord::class,
                'type' => 'write',
                'name' => 'Create DNS Record',
                'description' => 'Create a new DNS record in a zone.',
                'icon' => 'ph:plus-circle',
            ],
            'cloudflare_list_page_rules' => [
                'class' => CloudflareListPageRules::class,
                'type' => 'read',
                'name' => 'List Page Rules',
                'description' => 'List page rules for a zone.',
                'icon' => 'ph:list-bullets',
            ],
            'cloudflare_get_analytics' => [
                'class' => CloudflareGetAnalytics::class,
                'type' => 'read',
                'name' => 'Get Analytics',
                'description' => 'Get analytics dashboard data for a zone.',
                'icon' => 'ph:chart-line-up',
            ],
            'cloudflare_get_current_user' => [
                'class' => CloudflareGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cloudflare.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cloudflare.com/client/v4'],
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

            $service = new CloudflareService(
                accessToken: $creds->get('cloudflare', 'access_token', '', $account),
                baseUrl: $creds->get('cloudflare', 'url', 'https://api.cloudflare.com/client/v4', $account),
            );

            return new $class($service);
        }

        return new $class(app(CloudflareService::class));
    }
}
