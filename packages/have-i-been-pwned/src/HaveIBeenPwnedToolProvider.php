<?php

namespace OpenCompany\Integrations\HaveIBeenPwned;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachedAccount;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachedAccountRange;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachedDomain;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachByName;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreaches;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedDataClasses;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedGenerateDnsToken;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedLatestBreach;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedPasteAccount;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedPwnedPasswordRange;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSendDomainVerificationEmail;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedStealerLogsByEmail;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedStealerLogsByEmailDomain;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedStealerLogsByWebsiteDomain;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSubscribedDomains;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSubscriptionStatus;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedVerifyDnsToken;

/**
 * Tool catalog and configuration metadata for Have I Been Pwned.
 *
 * Public breach and Pwned Passwords tools work without credentials. Account,
 * domain, paste, stealer-log, and subscription tools require an HIBP API key.
 */
class HaveIBeenPwnedToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'optional_secret',
                'setup_flows' => ['none', 'manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Public breach catalogue and Pwned Passwords range checks do not require a key. Account, paste, domain, stealer-log, and subscription endpoints require a paid HIBP API key.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'optional_manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'have-i-been-pwned';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Have I Been Pwned',
            'description' => 'Check breach exposure, pastes, domains, stealer logs, and Pwned Passwords',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Have I Been Pwned',
            'description' => 'Have I Been Pwned API for public breach metadata, account breach and paste checks, domain ownership verification, subscribed domains, stealer logs, subscription status, and Pwned Passwords range queries.',
            'icon' => 'ph:shield-warning',
            'logo' => 'ph:shield-warning',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://haveibeenpwned.com/API/V3',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Have I Been Pwned API key', 'hint' => 'Optional for public catalogue and Pwned Passwords. Required for account, paste, domain, stealer-log, and subscription endpoints.', 'required' => false],
        ];
    }

    /**
     * Verify HIBP connectivity and optional API-key validity.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            $request = Http::acceptJson()
                ->withUserAgent('OpenCompany Integrations (https://opencompany.ai)')
                ->timeout(20);

            if ($apiKey !== '') {
                $request = $request->withHeaders(['hibp-api-key' => $apiKey]);
                $response = $request->get('https://haveibeenpwned.com/api/v3/subscription/status');

                return $response->successful()
                    ? ['success' => true, 'message' => 'Have I Been Pwned API key accepted.']
                    : ['success' => false, 'error' => 'Have I Been Pwned API returned HTTP '.$response->status().'.'];
            }

            $response = $request->get('https://haveibeenpwned.com/api/v3/latestbreach');

            return $response->successful()
                ? ['success' => true, 'message' => 'Have I Been Pwned public API is reachable without an API key.']
                : ['success' => false, 'error' => 'Have I Been Pwned API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Have I Been Pwned API key', 'hint' => 'Optional for public catalogue and Pwned Passwords. Required for protected HIBP endpoints.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        return [
            'hibp_breached_account' => ['class' => HaveIBeenPwnedBreachedAccount::class, 'type' => 'read', 'name' => 'Breached Account', 'description' => 'List breaches for an email address.', 'icon' => 'ph:user-warning'],
            'hibp_breached_account_range' => ['class' => HaveIBeenPwnedBreachedAccountRange::class, 'type' => 'read', 'name' => 'Breached Account Range', 'description' => 'List email hash suffixes and affected sites for an account hash prefix.', 'icon' => 'ph:hash'],
            'hibp_breaches' => ['class' => HaveIBeenPwnedBreaches::class, 'type' => 'read', 'name' => 'Breaches', 'description' => 'List breach catalogue entries.', 'icon' => 'ph:list-magnifying-glass'],
            'hibp_breach_by_name' => ['class' => HaveIBeenPwnedBreachByName::class, 'type' => 'read', 'name' => 'Breach By Name', 'description' => 'Retrieve one breach by system name.', 'icon' => 'ph:shield-warning'],
            'hibp_latest_breach' => ['class' => HaveIBeenPwnedLatestBreach::class, 'type' => 'read', 'name' => 'Latest Breach', 'description' => 'Retrieve the most recently added breach.', 'icon' => 'ph:clock-counter-clockwise'],
            'hibp_data_classes' => ['class' => HaveIBeenPwnedDataClasses::class, 'type' => 'read', 'name' => 'Data Classes', 'description' => 'List all breach data classes.', 'icon' => 'ph:tag'],
            'hibp_paste_account' => ['class' => HaveIBeenPwnedPasteAccount::class, 'type' => 'read', 'name' => 'Paste Account', 'description' => 'List pastes for an email address.', 'icon' => 'ph:clipboard-text'],
            'hibp_breached_domain' => ['class' => HaveIBeenPwnedBreachedDomain::class, 'type' => 'read', 'name' => 'Breached Domain', 'description' => 'List breached accounts for a verified domain.', 'icon' => 'ph:globe-warning'],
            'hibp_subscribed_domains' => ['class' => HaveIBeenPwnedSubscribedDomains::class, 'type' => 'read', 'name' => 'Subscribed Domains', 'description' => 'List domains tied to the API-key subscription.', 'icon' => 'ph:globe'],
            'hibp_generate_dns_token' => ['class' => HaveIBeenPwnedGenerateDnsToken::class, 'type' => 'read', 'name' => 'Generate DNS Token', 'description' => 'Generate a DNS ownership-verification token.', 'icon' => 'ph:key'],
            'hibp_verify_dns_token' => ['class' => HaveIBeenPwnedVerifyDnsToken::class, 'type' => 'write', 'name' => 'Verify DNS Token', 'description' => 'Verify a domain DNS token with HIBP.', 'icon' => 'ph:check-circle'],
            'hibp_send_domain_verification_email' => ['class' => HaveIBeenPwnedSendDomainVerificationEmail::class, 'type' => 'write', 'name' => 'Send Domain Verification Email', 'description' => 'Send an HIBP domain verification email.', 'icon' => 'ph:envelope-simple'],
            'hibp_stealer_logs_by_email' => ['class' => HaveIBeenPwnedStealerLogsByEmail::class, 'type' => 'read', 'name' => 'Stealer Logs By Email', 'description' => 'Check stealer logs by email address.', 'icon' => 'ph:detective'],
            'hibp_stealer_logs_by_website_domain' => ['class' => HaveIBeenPwnedStealerLogsByWebsiteDomain::class, 'type' => 'read', 'name' => 'Stealer Logs By Website Domain', 'description' => 'Check stealer logs by compromised website domain.', 'icon' => 'ph:browser'],
            'hibp_stealer_logs_by_email_domain' => ['class' => HaveIBeenPwnedStealerLogsByEmailDomain::class, 'type' => 'read', 'name' => 'Stealer Logs By Email Domain', 'description' => 'Check stealer logs by email address domain.', 'icon' => 'ph:at'],
            'hibp_subscription_status' => ['class' => HaveIBeenPwnedSubscriptionStatus::class, 'type' => 'read', 'name' => 'Subscription Status', 'description' => 'Retrieve subscription status for the API key.', 'icon' => 'ph:receipt'],
            'hibp_pwned_password_range' => ['class' => HaveIBeenPwnedPwnedPasswordRange::class, 'type' => 'read', 'name' => 'Pwned Password Range', 'description' => 'Query Pwned Passwords by hash prefix.', 'icon' => 'ph:password'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an HIBP tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): HaveIBeenPwnedService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new HaveIBeenPwnedService(apiKey: $creds->get('have-i-been-pwned', 'api_key', '', $account));
        }

        return app(HaveIBeenPwnedService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/have-i-been-pwned.md';
    }
}
