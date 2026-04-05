<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailgun\Tools\MailgunSendEmail;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetEvents;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetStats;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListDomains;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetDomain;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMailingLists;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateMailingList;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListMembers;
use OpenCompany\Integrations\Mailgun\Tools\MailgunAddMember;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetSuppressions;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateSuppression;
use OpenCompany\Integrations\Mailgun\Tools\MailgunGetCurrentUser;

/**
 * Registers all Mailgun tools and provides integration metadata, configuration schema, and connection testing.
 *
 * Exposes 12 tools covering email sending, events, stats, domains, mailing lists, and suppressions
 * via the ToolProvider contract.
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
            'label' => 'email, delivery, events, mailing lists',
            'description' => 'Email delivery service',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailgun',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailgun',
            'description' => 'Email delivery, events, stats, domains, mailing lists, and suppressions',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailgun',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.mailgun.com/docs/mailgun/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Your Mailgun API key',
                'hint' => 'Found in Mailgun Dashboard → Sending → Domain Settings → API Keys.',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'text',
                'label' => 'Sending Domain',
                'placeholder' => 'mg.example.com',
                'hint' => 'Your Mailgun sending domain.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://api.mailgun.net/v3',
                'hint' => 'Mailgun API base URL. Use https://api.eu.mailgun.net/v3 for EU regions.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Mailgun connection using the provided credentials.
     *
     * Fetches the domain list and returns the domain count.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key' and 'domain'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://api.mailgun.net/v3';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'API key is required. Find it in Mailgun Dashboard → Sending → Domain Settings → API Keys.'];
        }

        try {
            $url = rtrim($baseUrl, '/') . '/domains';
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($url);

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $total = $body['total_count'] ?? count($body['items'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to Mailgun. {$total} domain(s) found.",
                ];
            }

            return [
                'success' => false,
                'error' => 'Mailgun API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key'  => 'nullable|string',
            'domain'   => 'nullable|string',
            'base_url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Email
            'mailgun_send_email' => [
                'class' => MailgunSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email through Mailgun.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            // Events & Stats
            'mailgun_get_events' => [
                'class' => MailgunGetEvents::class,
                'type' => 'read',
                'name' => 'Get Events',
                'description' => 'Get events for the Mailgun domain.',
                'icon' => 'ph:list',
            ],
            'mailgun_get_stats' => [
                'class' => MailgunGetStats::class,
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get total stats for the Mailgun domain.',
                'icon' => 'ph:chart-bar',
            ],
            // Domains
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
                'description' => 'Get details for a Mailgun domain.',
                'icon' => 'ph:globe-simple',
            ],
            // Mailing Lists
            'mailgun_list_mailing_lists' => [
                'class' => MailgunListMailingLists::class,
                'type' => 'read',
                'name' => 'List Mailing Lists',
                'description' => 'List all mailing lists in the Mailgun account.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_create_mailing_list' => [
                'class' => MailgunCreateMailingList::class,
                'type' => 'write',
                'name' => 'Create Mailing List',
                'description' => 'Create a new mailing list in Mailgun.',
                'icon' => 'ph:users-three-plus',
            ],
            'mailgun_list_members' => [
                'class' => MailgunListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a Mailgun mailing list.',
                'icon' => 'ph:user-list',
            ],
            'mailgun_add_member' => [
                'class' => MailgunAddMember::class,
                'type' => 'write',
                'name' => 'Add Member',
                'description' => 'Add a member to a Mailgun mailing list.',
                'icon' => 'ph:user-plus',
            ],
            // Suppressions
            'mailgun_get_suppressions' => [
                'class' => MailgunGetSuppressions::class,
                'type' => 'read',
                'name' => 'Get Suppressions',
                'description' => 'Get bounces (suppressions) for a Mailgun domain.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_suppression' => [
                'class' => MailgunCreateSuppression::class,
                'type' => 'write',
                'name' => 'Create Suppression',
                'description' => 'Create a bounce (suppression) for a Mailgun domain.',
                'icon' => 'ph:shield-plus',
            ],
            // Account
            'mailgun_get_current_user' => [
                'class' => MailgunGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get Mailgun account info (domains list as health check).',
                'icon' => 'ph:identification-badge',
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
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'text', 'label' => 'Sending Domain', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MailgunService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): MailgunService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MailgunService(
                apiKey: $creds->get('mailgun', 'api_key', '', $account),
                domain: $creds->get('mailgun', 'domain', '', $account),
                baseUrl: $creds->get('mailgun', 'base_url', 'https://api.mailgun.net/v3', $account),
            );
        }

        return app(MailgunService::class);
    }
}
