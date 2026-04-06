<?php

namespace OpenCompany\Integrations\Brevo;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Brevo\Tools\BrevoListContacts;
use OpenCompany\Integrations\Brevo\Tools\BrevoGetContact;
use OpenCompany\Integrations\Brevo\Tools\BrevoCreateContact;
use OpenCompany\Integrations\Brevo\Tools\BrevoListLists;
use OpenCompany\Integrations\Brevo\Tools\BrevoGetList;
use OpenCompany\Integrations\Brevo\Tools\BrevoSendEmail;
use OpenCompany\Integrations\Brevo\Tools\BrevoGetAccount;

class BrevoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'brevo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, lists, email',
            'description' => 'Email marketing & transactional email',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:brevo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Brevo',
            'description' => 'Email marketing, transactional email, and CRM platform (formerly Sendinblue)',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:brevo',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.brevo.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Brevo API key',
                'hint' => 'Generate an API key in your Brevo account under SMTP & API > API Keys',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $service = new BrevoService(apiKey: $apiKey);
            $account = $service->getAccount();

            $email = $account['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Brevo as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'brevo_list_contacts' => [
                'class' => BrevoListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in your Brevo account with optional search and pagination.',
                'icon' => 'ph:users',
            ],
            'brevo_get_contact' => [
                'class' => BrevoGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact by email address.',
                'icon' => 'ph:user',
            ],
            'brevo_create_contact' => [
                'class' => BrevoCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Brevo.',
                'icon' => 'ph:user-plus',
            ],
            'brevo_list_lists' => [
                'class' => BrevoListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all contact lists in your Brevo account.',
                'icon' => 'ph:list-bullets',
            ],
            'brevo_get_list' => [
                'class' => BrevoGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get details of a specific contact list.',
                'icon' => 'ph:list-bullets',
            ],
            'brevo_send_email' => [
                'class' => BrevoSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send a transactional email via Brevo.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'brevo_get_account' => [
                'class' => BrevoGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get information about the Brevo account.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/brevo.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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

            $service = new BrevoService(
                apiKey: $creds->get('brevo', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BrevoService::class));
    }
}
