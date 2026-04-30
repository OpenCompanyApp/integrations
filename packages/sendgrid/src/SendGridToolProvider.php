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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridAddContact;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridAddContactToList;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridAddSuppression;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridCreateList;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridDeleteContact;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridGetContactByEmail;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridGetEmailStats;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridGetTemplates;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridListLists;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridListSenderIdentities;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridListSuppressions;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridRemoveContactFromList;
use OpenCompany\Integrations\Sendgrid\Tools\SendGridSearchContacts;
class SendgridToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'sendgrid';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'SendGrid',
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
    }    public function configSchema(): array
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
            'sendgrid_add_contact' => [
                'class' => SendGridAddContact::class,
                'type' => 'write',
                'name' => 'Add Contact',
                'description' => 'Add a new contact or update an existing one in SendGrid. Uses a PUT upsert based on the email address. Optionally set first name, last name, custom fields, and assign the contact to one or more marketing lists.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_add_contact_to_list' => [
                'class' => SendGridAddContactToList::class,
                'type' => 'write',
                'name' => 'Add Contact To List',
                'description' => 'Add one or more existing contacts to a SendGrid marketing list. Provide the list ID and an array of contact IDs to add.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_add_suppression' => [
                'class' => SendGridAddSuppression::class,
                'type' => 'write',
                'name' => 'Add Suppression',
                'description' => 'Add one or more email addresses to the SendGrid suppression list. Suppressed emails will not receive future emails from your account.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_create_list' => [
                'class' => SendGridCreateList::class,
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a new marketing list in SendGrid. Returns the created list with its ID.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_delete_contact' => [
                'class' => SendGridDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete one or more contacts from SendGrid by providing their contact IDs. This action is permanent and cannot be undone.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_contact_by_email' => [
                'class' => SendGridGetContactByEmail::class,
                'type' => 'read',
                'name' => 'Get Contact By Email',
                'description' => 'Look up a SendGrid marketing contact by their email address. Returns the contact record if found, including ID, name, and custom fields.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_email_stats' => [
                'class' => SendGridGetEmailStats::class,
                'type' => 'read',
                'name' => 'Get Email Stats',
                'description' => 'Get email delivery statistics from SendGrid. Returns metrics such as delivers, opens, clicks, bounces, and spam reports. Requires a start_date, optionally filtered by end_date and aggregated by day, week, or month.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_templates' => [
                'class' => SendGridGetTemplates::class,
                'type' => 'read',
                'name' => 'Get Templates',
                'description' => 'List email templates in the connected SendGrid account. Returns each template\'s ID, name, type, and versions.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_contacts' => [
                'class' => SendgridListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in your SendGrid marketing contacts database. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_lists' => [
                'class' => SendGridListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all marketing lists in the connected SendGrid account. Returns each list\'s ID, name, and contact count.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_sender_identities' => [
                'class' => SendGridListSenderIdentities::class,
                'type' => 'read',
                'name' => 'List Sender Identities',
                'description' => 'List all verified sender identities in the connected SendGrid account. Returns each sender\'s ID, nickname, email address, and verification status.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_suppressions' => [
                'class' => SendGridListSuppressions::class,
                'type' => 'read',
                'name' => 'List Suppressions',
                'description' => 'List bounce suppressions (bounced email addresses) from SendGrid. Optionally filter by start and end time (Unix timestamps) and limit results.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_remove_contact_from_list' => [
                'class' => SendGridRemoveContactFromList::class,
                'type' => 'write',
                'name' => 'Remove Contact From List',
                'description' => 'Remove one or more contacts from a SendGrid marketing list. Provide the list ID and an array of contact IDs to remove. The contacts are removed from the list but not deleted from SendGrid.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_search_contacts' => [
                'class' => SendGridSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search SendGrid marketing contacts using a query string. Example queries: "email LIKE \'%@example.com\'" or "first_name = \'John\'". Returns matching contact records.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_send_email' => [
                'class' => SendgridSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via SendGrid. Specify sender, recipients, subject, and HTML or text content.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_contact' => [
                'class' => SendgridGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact in SendGrid by their contact ID. Returns email, custom fields, and list memberships.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_current_user' => [
                'class' => SendgridGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated SendGrid user, including email, first name, and last name.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_get_template' => [
                'class' => SendgridGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details of a specific email template in SendGrid by its ID. Returns template name, versions, and active version content.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_emails' => [
                'class' => SendgridListEmails::class,
                'type' => 'read',
                'name' => 'List Emails',
                'description' => 'List emails in your SendGrid account. Supports filtering by query and pagination.',
                'icon' => 'ph:wrench',
            ],
            'sendgrid_list_templates' => [
                'class' => SendgridListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates in your SendGrid account. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sendgrid.md';
    }    public function credentialFields(): array
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
