<?php

namespace OpenCompany\Integrations\Sendgrid;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridListEmails;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridSendEmail;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridListTemplates;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridGetTemplate;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridListContacts;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridGetContact;
use OpenCompany\Integrations\Sendgrid\Tools\SendgridGetCurrentUser;

class SendgridToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'sendgrid';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'email, templates, contacts',
            'description' => 'Email delivery & communication',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:sendgrid',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'SendGrid',
            'description' => 'Email delivery service for transactional and marketing emails, templates, and contact management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:sendgrid',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.sendgrid.com/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your SendGrid API key',
                'hint' => 'Generate an API key in your SendGrid account under Settings > API Keys',
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
            $service = new SendgridService(apiKey: $apiKey);
            $profile = $service->getCurrentUser();

            $email = $profile['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to SendGrid as {$email}.",
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
            'sendgrid_list_emails' => [
                'class' => SendgridListEmails::class,
                'type' => 'read',
                'name' => 'List Emails',
                'description' => 'List emails in your SendGrid account with optional filtering and pagination.',
                'icon' => 'ph:envelope',
            ],
            'sendgrid_send_email' => [
                'class' => SendgridSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via SendGrid with support for HTML and text content.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'sendgrid_list_templates' => [
                'class' => SendgridListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates in your SendGrid account.',
                'icon' => 'ph:file',
            ],
            'sendgrid_get_template' => [
                'class' => SendgridGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details of a specific email template by its ID.',
                'icon' => 'ph:file-text',
            ],
            'sendgrid_list_contacts' => [
                'class' => SendgridListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in your SendGrid marketing contacts database.',
                'icon' => 'ph:users',
            ],
            'sendgrid_get_contact' => [
                'class' => SendgridGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact by their ID.',
                'icon' => 'ph:user',
            ],
            'sendgrid_get_current_user' => [
                'class' => SendgridGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated SendGrid user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sendgrid.md';
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

            $service = new SendgridService(
                apiKey: $creds->get('sendgrid', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(SendgridService::class));
    }
}
