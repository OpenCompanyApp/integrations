<?php

namespace OpenCompany\Integrations\Mailgun;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMessages;
use OpenCompany\Integrations\Mailgun\Tools\MailgunSendEmail;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListDomains;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetDomain;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListRoutes;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListWebhooks;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Mailgun\Tools\MailgunAddMember;
use OpenCompany\Integrations\Mailgun\Tools\MailgunAddMemberBulk;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateMailingList;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateSuppression;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetEvents;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetStats;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetSuppressions;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMailingLists;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMembers;
class MailgunToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mailgun';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mailgun',
            'description' => 'Email delivery service',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailgun',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailgun',
            'description' => 'Email delivery service for sending, receiving, and tracking emails',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailgun',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.mailgun.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Mailgun API key',
                'hint' => 'Find your API key in the Mailgun dashboard under Domain Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'text',
                'label' => 'Sending Domain',
                'placeholder' => 'e.g., mg.example.com',
                'hint' => 'The Mailgun domain used for sending emails',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = $config['domain'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No sending domain provided'];
        }

        try {
            $service = new MailgunService(apiKey: $apiKey, domain: $domain);
            $result = $service->getDomain($domain);

            $name = $result['domain']['name'] ?? $domain;
            $state = $result['domain']['state'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Mailgun. Domain: {$name} (state: {$state}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

        public function tools(): array
    {
        return [
            'mailgun_add_member' => [
                'class' => MailgunAddMember::class,
                'type' => 'write',
                'name' => 'Add Member',
                'description' => 'Add a member to a Mailgun mailing list. Requires list_address and member address.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_add_member_bulk' => [
                'class' => MailgunAddMemberBulk::class,
                'type' => 'write',
                'name' => 'Add Member Bulk',
                'description' => 'Add multiple members to a Mailgun mailing list in a single request. Uses upsert mode — existing members are updated. Each member object must contain at least an "address" key, and may include "name" and "vars".',
                'icon' => 'ph:wrench',
            ],
            'mailgun_create_mailing_list' => [
                'class' => MailgunCreateMailingList::class,
                'type' => 'write',
                'name' => 'Create Mailing List',
                'description' => 'Create a new mailing list in Mailgun. Requires an address. Optionally include a name and description.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_create_suppression' => [
                'class' => MailgunCreateSuppression::class,
                'type' => 'write',
                'name' => 'Create Suppression',
                'description' => 'Create a bounce (suppression) for an address on a Mailgun domain. Prevents future email delivery to that address.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_get_current_user' => [
                'class' => MailgunGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify the Mailgun API connection and retrieve basic account info by listing domains.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_get_domain' => [
                'class' => MailgunGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details and DNS records for a specific Mailgun domain.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_get_events' => [
                'class' => MailgunGetEvents::class,
                'type' => 'read',
                'name' => 'Get Events',
                'description' => 'Get events for the Mailgun domain. Filter by event type, date range, limit, and recipient.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_get_stats' => [
                'class' => MailgunGetStats::class,
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get total stats for the Mailgun domain. Filter by event type, date range, and resolution (hour, day, month).',
                'icon' => 'ph:wrench',
            ],
            'mailgun_get_suppressions' => [
                'class' => MailgunGetSuppressions::class,
                'type' => 'read',
                'name' => 'Get Suppressions',
                'description' => 'Get bounces (suppressions) for a Mailgun domain. Returns bounced addresses with codes and error messages.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_domains' => [
                'class' => MailgunListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains in your Mailgun account with optional pagination.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_mailing_lists' => [
                'class' => MailgunListMailingLists::class,
                'type' => 'read',
                'name' => 'List Mailing Lists',
                'description' => 'List all mailing lists in the Mailgun account. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_members' => [
                'class' => MailgunListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a Mailgun mailing list. Requires the list address.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_messages' => [
                'class' => MailgunListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List message events in your Mailgun domain with optional filtering and pagination.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_routes' => [
                'class' => MailgunListRoutes::class,
                'type' => 'read',
                'name' => 'List Routes',
                'description' => 'List all routes in your Mailgun account with optional pagination.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_list_webhooks' => [
                'class' => MailgunListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List all webhooks configured for a Mailgun domain.',
                'icon' => 'ph:wrench',
            ],
            'mailgun_send_email' => [
                'class' => MailgunSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via Mailgun. Specify from, to, subject, and text or HTML content.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailgun.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'text', 'label' => 'Sending Domain', 'required' => true],
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

            $service = new MailgunService(
                apiKey: $creds->get('mailgun', 'api_key', '', $account),
                domain: $creds->get('mailgun', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MailgunService::class));
    }
}
