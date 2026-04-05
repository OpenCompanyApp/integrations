<?php

namespace OpenCompany\Integrations\Mailgun;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailgun\Tools\MailgunAddMember;
use OpenCompany\Integrations\Mailgun\Tools\MailgunAddMemberBulk;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateMailingList;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateSuppression;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetDomain;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetEvents;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetStats;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetSuppressions;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListDomains;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMailingLists;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMembers;
use OpenCompany\Integrations\Mailgun\Tools\MailgunSendEmail;

/**
 * Registers all Mailgun tools and provides integration metadata, configuration schema, and connection testing.
 */
class MailgunToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'mailgun';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mailgun',
            'description' => 'Email delivery service — send emails, manage domains, events, mailing lists, and suppressions.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailgun',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailgun',
            'description' => 'Connect Mailgun to send emails, track events, manage domains, mailing lists, and suppressions.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailgun',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.mailgun.com/en/latest/api_reference.html',
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
                'description' => 'Your Mailgun API key.',
                'placeholder' => 'key-xxxxxxxxxxxxxxxxxxxxxxxx',
            ],
            [
                'name' => 'domain',
                'label' => 'Domain',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Mailgun sending domain (e.g. mg.example.com).',
                'placeholder' => 'mg.example.com',
            ],
            [
                'name' => 'base_url',
                'label' => 'Base URL',
                'type' => 'text',
                'required' => false,
                'description' => 'The Mailgun API base URL. Use https://api.eu.mailgun.net/v3 for EU region.',
                'placeholder' => 'https://api.mailgun.net/v3',
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $domain = $config['domain'] ?? '';
            $baseUrl = $config['base_url'] ?? 'https://api.mailgun.net/v3';
            $service = new MailgunService(apiKey: $apiKey, domain: $domain, baseUrl: $baseUrl);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error' => 'Mailgun API key is not configured.',
                ];
            }

            $result = $service->getDomains();
            $domainCount = count($result['items'] ?? []);

            return [
                'success' => true,
                'message' => sprintf(
                    'Connected to Mailgun — %d domain(s) found.',
                    $domainCount,
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
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
            'base_url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'mailgun_send_email' => [
                'class' => MailgunSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via Mailgun.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailgun_get_events' => [
                'class' => MailgunGetEvents::class,
                'type' => 'read',
                'name' => 'Get Events',
                'description' => 'Get Mailgun events for the configured domain.',
                'icon' => 'ph:list',
            ],
            'mailgun_get_stats' => [
                'class' => MailgunGetStats::class,
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get total delivery statistics from Mailgun.',
                'icon' => 'ph:chart-bar',
            ],
            'mailgun_list_domains' => [
                'class' => MailgunListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains in the Mailgun account.',
                'icon' => 'ph:globe',
            ],
            'mailgun_get_domain' => [
                'class' => MailgunGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details for a single Mailgun domain.',
                'icon' => 'ph:globe-hemisphere-west',
            ],
            'mailgun_list_mailing_lists' => [
                'class' => MailgunListMailingLists::class,
                'type' => 'read',
                'name' => 'List Mailing Lists',
                'description' => 'List all mailing lists in the Mailgun account.',
                'icon' => 'ph:envelopes',
            ],
            'mailgun_create_mailing_list' => [
                'class' => MailgunCreateMailingList::class,
                'type' => 'write',
                'name' => 'Create Mailing List',
                'description' => 'Create a new mailing list in Mailgun.',
                'icon' => 'ph:plus',
            ],
            'mailgun_list_members' => [
                'class' => MailgunListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a Mailgun mailing list.',
                'icon' => 'ph:users',
            ],
            'mailgun_add_member' => [
                'class' => MailgunAddMember::class,
                'type' => 'write',
                'name' => 'Add Member',
                'description' => 'Add a single member to a Mailgun mailing list.',
                'icon' => 'ph:user-plus',
            ],
            'mailgun_add_member_bulk' => [
                'class' => MailgunAddMemberBulk::class,
                'type' => 'write',
                'name' => 'Add Members (Bulk)',
                'description' => 'Add multiple members to a Mailgun mailing list in bulk.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_get_suppressions' => [
                'class' => MailgunGetSuppressions::class,
                'type' => 'read',
                'name' => 'Get Suppressions',
                'description' => 'List bounce suppressions for a Mailgun domain.',
                'icon' => 'ph:prohibit',
            ],
            'mailgun_create_suppression' => [
                'class' => MailgunCreateSuppression::class,
                'type' => 'write',
                'name' => 'Create Suppression',
                'description' => 'Add a bounce suppression to a Mailgun domain.',
                'icon' => 'ph:prohibit-insert',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailgun.md';
    }

    public function credentialFields(): array
    {
        return [
            'api_key' => [
                'label' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Mailgun API key.',
            ],
            'domain' => [
                'label' => 'Domain',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Mailgun sending domain.',
            ],
            'base_url' => [
                'label' => 'Base URL',
                'type' => 'text',
                'required' => false,
                'description' => 'Mailgun API base URL (use EU endpoint for EU region).',
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
    private function resolveService(array $context = []): MailgunService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MailgunService(
                apiKey: $creds->get('mailgun', 'api_key', '', $account),
                domain: $creds->get('mailgun', 'domain', '', $account),
                baseUrl: $creds->get('mailgun', 'base_url', 'https://api.mailgun.net/v3', $account),
            );
        }

        return app(MailgunService::class);
    }
}
