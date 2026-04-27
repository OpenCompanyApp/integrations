<?php

namespace OpenCompany\Integrations\Mailjet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailjet\Tools\MailjetCreateContact;
use OpenCompany\Integrations\Mailjet\Tools\MailjetGetCampaign;
use OpenCompany\Integrations\Mailjet\Tools\MailjetGetContact;
use OpenCompany\Integrations\Mailjet\Tools\MailjetGetCurrentUser;
use OpenCompany\Integrations\Mailjet\Tools\MailjetGetStats;
use OpenCompany\Integrations\Mailjet\Tools\MailjetListCampaigns;
use OpenCompany\Integrations\Mailjet\Tools\MailjetListContacts;
use OpenCompany\Integrations\Mailjet\Tools\MailjetListTemplates;
use OpenCompany\Integrations\Mailjet\Tools\MailjetSendEmail;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MailjetToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mailjet';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'email, contacts, campaigns, templates',
            'description' => 'Email delivery & marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailjet',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailjet',
            'description' => 'Email delivery and marketing automation platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailjet',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://dev.mailjet.com/email/guides/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Mailjet API key',
                'hint' => 'Find your API key in the Mailjet dashboard under Account Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'api_secret',
                'type' => 'secret',
                'label' => 'API Secret',
                'placeholder' => 'Enter your Mailjet API secret',
                'hint' => 'Find your API secret alongside the API key in Account Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mailjet.com/v3',
                'hint' => 'Override only if using a custom Mailjet endpoint. Defaults to <code>https://api.mailjet.com/v3</code>',
                'default' => 'https://api.mailjet.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $apiSecret = $config['api_secret'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mailjet.com/v3', '/');

        if (empty($apiKey) || empty($apiSecret)) {
            return ['success' => false, 'error' => 'API key and secret are required'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, $apiSecret)
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mailjet API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['ErrorMessage'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => "Mailjet API error ({$response->status()}): {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Mailjet API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'mailjet_send_email' => [
                'class' => MailjetSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via Mailjet.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailjet_list_contacts' => [
                'class' => MailjetListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in the Mailjet account.',
                'icon' => 'ph:users',
            ],
            'mailjet_get_contact' => [
                'class' => MailjetGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a single contact.',
                'icon' => 'ph:user',
            ],
            'mailjet_create_contact' => [
                'class' => MailjetCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Mailjet.',
                'icon' => 'ph:user-plus',
            ],
            'mailjet_list_campaigns' => [
                'class' => MailjetListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List email campaigns.',
                'icon' => 'ph:envelopes',
            ],
            'mailjet_get_campaign' => [
                'class' => MailjetGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a single campaign.',
                'icon' => 'ph:envelope-open',
            ],
            'mailjet_list_templates' => [
                'class' => MailjetListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates.',
                'icon' => 'ph:file',
            ],
            'mailjet_get_stats' => [
                'class' => MailjetGetStats::class,
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get email statistics from statcounters.',
                'icon' => 'ph:chart-bar',
            ],
            'mailjet_get_current_user' => [
                'class' => MailjetGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Mailjet user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailjet.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'required' => true],
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

            $service = new MailjetService(
                apiKey: $creds->get('mailjet', 'api_key', '', $account),
                apiSecret: $creds->get('mailjet', 'api_secret', '', $account),
                baseUrl: $creds->get('mailjet', 'url', 'https://api.mailjet.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(MailjetService::class));
    }
}
