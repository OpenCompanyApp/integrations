<?php

namespace OpenCompany\Integrations\Hostinger;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hostinger\Tools\HostingerGetCurrentUser;
use OpenCompany\Integrations\Hostinger\Tools\HostingerGetDomain;
use OpenCompany\Integrations\Hostinger\Tools\HostingerGetServer;
use OpenCompany\Integrations\Hostinger\Tools\HostingerListDnsRecords;
use OpenCompany\Integrations\Hostinger\Tools\HostingerListDomains;
use OpenCompany\Integrations\Hostinger\Tools\HostingerListServers;
use OpenCompany\Integrations\Hostinger\Tools\HostingerListSsl;

class HostingerToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'hostinger';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'servers, domains, DNS, SSL',
            'description' => 'Web hosting',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:hostinger',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hostinger',
            'description' => 'Web hosting — VPS servers, domains, DNS records, and SSL certificates',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:hostinger',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.hostinger.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Hostinger API token',
                'hint' => 'Generate an API token in the Hostinger control panel under <strong>Account Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://developers.hostinger.com/api',
                'hint' => 'Override only if using a custom Hostinger-compatible endpoint',
                'default' => 'https://developers.hostinger.com/api',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://developers.hostinger.com/api', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/current');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Hostinger API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Hostinger API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Hostinger as {$email}.",
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
            'hostinger_list_servers' => [
                'class' => HostingerListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all VPS servers in the Hostinger account.',
                'icon' => 'ph:server',
            ],
            'hostinger_get_server' => [
                'class' => HostingerGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific VPS server.',
                'icon' => 'ph:server',
            ],
            'hostinger_list_domains' => [
                'class' => HostingerListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains in the Hostinger account.',
                'icon' => 'ph:globe',
            ],
            'hostinger_get_domain' => [
                'class' => HostingerGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details for a specific domain.',
                'icon' => 'ph:globe',
            ],
            'hostinger_list_dns_records' => [
                'class' => HostingerListDnsRecords::class,
                'type' => 'read',
                'name' => 'List DNS Records',
                'description' => 'List DNS records for a domain.',
                'icon' => 'ph:list-dashes',
            ],
            'hostinger_list_ssl' => [
                'class' => HostingerListSsl::class,
                'type' => 'read',
                'name' => 'List SSL Certificates',
                'description' => 'List SSL certificates in the account.',
                'icon' => 'ph:shield-check',
            ],
            'hostinger_get_current_user' => [
                'class' => HostingerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hostinger.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://developers.hostinger.com/api'],
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

            $service = new HostingerService(
                accessToken: $creds->get('hostinger', 'access_token', '', $account),
                baseUrl: $creds->get('hostinger', 'url', 'https://developers.hostinger.com/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(HostingerService::class));
    }
}
