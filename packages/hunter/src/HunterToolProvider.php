<?php

namespace OpenCompany\Integrations\Hunter;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hunter\Tools\HunterCreateLead;
use OpenCompany\Integrations\Hunter\Tools\HunterDomainSearch;
use OpenCompany\Integrations\Hunter\Tools\HunterEmailCount;
use OpenCompany\Integrations\Hunter\Tools\HunterEmailFinder;
use OpenCompany\Integrations\Hunter\Tools\HunterEmailVerifier;
use OpenCompany\Integrations\Hunter\Tools\HunterGetCurrentUser;
use OpenCompany\Integrations\Hunter\Tools\HunterGetLead;
use OpenCompany\Integrations\Hunter\Tools\HunterListLeads;

/**
 * Registers all Hunter.io tools and provides integration metadata, configuration schema, and connection testing.
 */
class HunterToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'hunter';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'domain search, email finder, verifier, leads',
            'description' => 'Email outreach and lead generation',
            'icon' => 'ph:at',
            'logo' => 'simple-icons:hunter',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hunter',
            'description' => 'Find and verify professional email addresses, search domains, and manage leads.',
            'icon' => 'ph:at',
            'logo' => 'simple-icons:hunter',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://hunter.io/api-documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Hunter.io API key',
                'hint' => 'Find your API key at <code>https://hunter.io/api-keys</code>',
                'required' => true,
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $service = new HunterService(apiKey: $apiKey);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error' => 'Hunter API key is not configured.',
                ];
            }

            $result = $service->getAccount();
            $email = $result['data']['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Hunter.io as {$email}.",
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
            'hunter_domain_search' => [
                'class' => HunterDomainSearch::class,
                'type' => 'read',
                'name' => 'Domain Search',
                'description' => 'Search for email addresses associated with a domain.',
                'icon' => 'ph:magnifying-glass',
            ],
            'hunter_email_finder' => [
                'class' => HunterEmailFinder::class,
                'type' => 'read',
                'name' => 'Email Finder',
                'description' => 'Find the most likely email address for a person.',
                'icon' => 'ph:at',
            ],
            'hunter_email_verifier' => [
                'class' => HunterEmailVerifier::class,
                'type' => 'read',
                'name' => 'Email Verifier',
                'description' => 'Verify the deliverability of an email address.',
                'icon' => 'ph:shield-check',
            ],
            'hunter_email_count' => [
                'class' => HunterEmailCount::class,
                'type' => 'read',
                'name' => 'Email Count',
                'description' => 'Get the number of email addresses found for a domain.',
                'icon' => 'ph:calculator',
            ],
            'hunter_list_leads' => [
                'class' => HunterListLeads::class,
                'type' => 'read',
                'name' => 'List Leads',
                'description' => 'List leads with optional pagination.',
                'icon' => 'ph:users',
            ],
            'hunter_get_lead' => [
                'class' => HunterGetLead::class,
                'type' => 'read',
                'name' => 'Get Lead',
                'description' => 'Retrieve a single lead by ID.',
                'icon' => 'ph:user',
            ],
            'hunter_create_lead' => [
                'class' => HunterCreateLead::class,
                'type' => 'write',
                'name' => 'Create Lead',
                'description' => 'Create a new lead in Hunter.',
                'icon' => 'ph:user-plus',
            ],
            'hunter_get_current_user' => [
                'class' => HunterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get account information and API usage.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hunter.md';
    }

    public function credentialFields(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'required' => true,
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
    private function resolveService(array $context = []): HunterService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new HunterService(
                apiKey: $creds->get('hunter', 'api_key', '', $account),
            );
        }

        return app(HunterService::class);
    }
}
