<?php

namespace OpenCompany\Integrations\EmailOctopus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListContacts;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListCampaigns;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaign;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class EmailOctopusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'email-octopus';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, campaigns, account',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:emailoctopus',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'EmailOctopus',
            'description' => 'Affordable email marketing platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:emailoctopus',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://emailoctopus.com/api-documentation',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your EmailOctopus API key',
                'hint' => 'Find your API key in EmailOctopus under Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://emailoctopus.com/api',
                'hint' => 'Use the default URL unless you have a custom endpoint',
                'default' => 'https://emailoctopus.com/api',
            ],
            [
                'key' => 'list_id',
                'type' => 'string',
                'label' => 'Default List ID',
                'placeholder' => 'Enter your EmailOctopus list ID',
                'hint' => 'The default contact list ID used for contact operations. Find it in EmailOctopus under Lists → your list → Settings.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://emailoctopus.com/api', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1.5/users/me', [
                'api_key' => $apiKey,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach EmailOctopus API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => "EmailOctopus API error: {$error}",
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to EmailOctopus as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'list_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'emailoctopus_list_contacts' => [
                'class' => EmailOctopusListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in an EmailOctopus mailing list.',
                'icon' => 'ph:users',
            ],
            'emailoctopus_get_contact' => [
                'class' => EmailOctopusGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'emailoctopus_create_contact' => [
                'class' => EmailOctopusCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Add a new contact to an EmailOctopus mailing list.',
                'icon' => 'ph:user-plus',
            ],
            'emailoctopus_list_campaigns' => [
                'class' => EmailOctopusListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all email campaigns.',
                'icon' => 'ph:envelope',
            ],
            'emailoctopus_get_campaign' => [
                'class' => EmailOctopusGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details of a specific email campaign.',
                'icon' => 'ph:envelope-open',
            ],
            'emailoctopus_get_current_user' => [
                'class' => EmailOctopusGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated EmailOctopus account details.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/email-octopus.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://emailoctopus.com/api'],
            ['key' => 'list_id', 'type' => 'string', 'label' => 'Default List ID', 'required' => true],
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

            $service = new EmailOctopusService(
                apiKey: $creds->get('email-octopus', 'api_key', '', $account),
                baseUrl: $creds->get('email-octopus', 'url', 'https://emailoctopus.com/api', $account),
                listId: $creds->get('email-octopus', 'list_id', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(EmailOctopusService::class));
    }
}
