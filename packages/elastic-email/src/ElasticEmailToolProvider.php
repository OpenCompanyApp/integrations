<?php

namespace OpenCompany\Integrations\ElasticEmail;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailSendEmail;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListTemplates;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetTemplate;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListContacts;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailCreateContact;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetCurrentUser;

class ElasticEmailToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'elastic-email';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'send, templates, contacts',
            'description' => 'Transactional email',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:elasticemail',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Elastic Email',
            'description' => 'Transactional email delivery and contact management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:elasticemail',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://elasticemail.com/developers/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Elastic Email API key',
                'hint' => 'Generate an API key in your Elastic Email account under "Settings → API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.elasticemail.com/v2',
                'hint' => 'Use the default Elastic Email API URL, or a custom endpoint if applicable',
                'default' => 'https://api.elasticemail.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.elasticemail.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-ElasticEmail-ApiKey' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Elastic Email API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Elastic Email API at {$baseUrl}.",
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
        ];
    }

    public function tools(): array
    {
        return [
            'elasticemail_send_email' => [
                'class' => ElasticEmailSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send a transactional email.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'elasticemail_list_templates' => [
                'class' => ElasticEmailListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates.',
                'icon' => 'ph:file',
            ],
            'elasticemail_get_template' => [
                'class' => ElasticEmailGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details of a specific email template.',
                'icon' => 'ph:file-text',
            ],
            'elasticemail_list_contacts' => [
                'class' => ElasticEmailListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in the account.',
                'icon' => 'ph:address-book',
            ],
            'elasticemail_create_contact' => [
                'class' => ElasticEmailCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create or add a contact.',
                'icon' => 'ph:user-plus',
            ],
            'elasticemail_get_current_user' => [
                'class' => ElasticEmailGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current authenticated user info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/elastic-email.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.elasticemail.com/v2'],
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

            $service = new ElasticEmailService(
                apiKey: $creds->get('elastic-email', 'api_key', '', $account),
                baseUrl: $creds->get('elastic-email', 'url', 'https://api.elasticemail.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(ElasticEmailService::class));
    }
}
