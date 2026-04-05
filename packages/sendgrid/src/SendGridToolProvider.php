<?php

namespace OpenCompany\Integrations\SendGrid;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SendGrid\Tools\SendGridAddContact;
use OpenCompany\Integrations\SendGrid\Tools\SendGridAddContactToList;
use OpenCompany\Integrations\SendGrid\Tools\SendGridAddSuppression;
use OpenCompany\Integrations\SendGrid\Tools\SendGridCreateList;
use OpenCompany\Integrations\SendGrid\Tools\SendGridDeleteContact;
use OpenCompany\Integrations\SendGrid\Tools\SendGridGetContactByEmail;
use OpenCompany\Integrations\SendGrid\Tools\SendGridGetEmailStats;
use OpenCompany\Integrations\SendGrid\Tools\SendGridGetTemplates;
use OpenCompany\Integrations\SendGrid\Tools\SendGridListContacts;
use OpenCompany\Integrations\SendGrid\Tools\SendGridListLists;
use OpenCompany\Integrations\SendGrid\Tools\SendGridListSenderIdentities;
use OpenCompany\Integrations\SendGrid\Tools\SendGridListSuppressions;
use OpenCompany\Integrations\SendGrid\Tools\SendGridRemoveContactFromList;
use OpenCompany\Integrations\SendGrid\Tools\SendGridSearchContacts;
use OpenCompany\Integrations\SendGrid\Tools\SendGridSendEmail;

/**
 * Registers all SendGrid tools and provides integration metadata, configuration schema, and connection testing.
 */
class SendGridToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'sendgrid';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'SendGrid',
            'description' => 'Email delivery and marketing platform — send emails, manage contacts, lists, and templates.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:sendgrid',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'SendGrid',
            'description' => 'Connect SendGrid to send emails, manage contacts, marketing lists, templates, and view statistics.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:sendgrid',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.sendgrid.com/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'name' => 'api_key',
                'label' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your SendGrid API key with the necessary permissions.',
                'placeholder' => 'SG.xxxxxxxxxxxxxxxxxxxxxx',
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $service = new SendGridService(apiKey: $apiKey);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error' => 'SendGrid API key is not configured.',
                ];
            }

            $result = $service->getUserProfile();

            return [
                'success' => true,
                'message' => sprintf(
                    'Connected to SendGrid account "%s".',
                    $result['email'] ?? 'Unknown',
                ),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'sendgrid_send_email' => [
                'class' => SendGridSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via SendGrid.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'sendgrid_list_contacts' => [
                'class' => SendGridListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List marketing contacts in SendGrid.',
                'icon' => 'ph:users',
            ],
            'sendgrid_add_contact' => [
                'class' => SendGridAddContact::class,
                'type' => 'write',
                'name' => 'Add Contact',
                'description' => 'Add or update a contact in SendGrid.',
                'icon' => 'ph:user-plus',
            ],
            'sendgrid_search_contacts' => [
                'class' => SendGridSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search SendGrid marketing contacts with a query.',
                'icon' => 'ph:magnifying-glass',
            ],
            'sendgrid_delete_contact' => [
                'class' => SendGridDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete one or more contacts from SendGrid.',
                'icon' => 'ph:user-minus',
            ],
            'sendgrid_get_contact_by_email' => [
                'class' => SendGridGetContactByEmail::class,
                'type' => 'read',
                'name' => 'Get Contact by Email',
                'description' => 'Look up a SendGrid contact by their email address.',
                'icon' => 'ph:at',
            ],
            'sendgrid_list_lists' => [
                'class' => SendGridListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all SendGrid marketing lists.',
                'icon' => 'ph:list-bullets',
            ],
            'sendgrid_create_list' => [
                'class' => SendGridCreateList::class,
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a new SendGrid marketing list.',
                'icon' => 'ph:plus',
            ],
            'sendgrid_add_contact_to_list' => [
                'class' => SendGridAddContactToList::class,
                'type' => 'write',
                'name' => 'Add Contact to List',
                'description' => 'Add one or more contacts to a SendGrid marketing list.',
                'icon' => 'ph:user-plus',
            ],
            'sendgrid_remove_contact_from_list' => [
                'class' => SendGridRemoveContactFromList::class,
                'type' => 'write',
                'name' => 'Remove Contact from List',
                'description' => 'Remove one or more contacts from a SendGrid marketing list.',
                'icon' => 'ph:user-minus',
            ],
            'sendgrid_list_sender_identities' => [
                'class' => SendGridListSenderIdentities::class,
                'type' => 'read',
                'name' => 'List Sender Identities',
                'description' => 'List all verified sender identities in SendGrid.',
                'icon' => 'ph:identification-card',
            ],
            'sendgrid_get_email_stats' => [
                'class' => SendGridGetEmailStats::class,
                'type' => 'read',
                'name' => 'Get Email Stats',
                'description' => 'Get email delivery statistics from SendGrid.',
                'icon' => 'ph:chart-bar',
            ],
            'sendgrid_list_suppressions' => [
                'class' => SendGridListSuppressions::class,
                'type' => 'read',
                'name' => 'List Suppressions',
                'description' => 'List bounce suppressions from SendGrid.',
                'icon' => 'ph:prohibit',
            ],
            'sendgrid_add_suppression' => [
                'class' => SendGridAddSuppression::class,
                'type' => 'write',
                'name' => 'Add Suppression',
                'description' => 'Add email addresses to the SendGrid suppression list.',
                'icon' => 'ph:prohibit-insert',
            ],
            'sendgrid_get_templates' => [
                'class' => SendGridGetTemplates::class,
                'type' => 'read',
                'name' => 'Get Templates',
                'description' => 'List SendGrid email templates.',
                'icon' => 'ph:file',
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
            'api_key' => [
                'label' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your SendGrid API key.',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): SendGridService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SendGridService(
                apiKey: $creds->get('sendgrid', 'api_key', '', $account),
            );
        }

        return app(SendGridService::class);
    }
}
