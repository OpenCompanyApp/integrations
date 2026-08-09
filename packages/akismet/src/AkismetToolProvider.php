<?php

namespace OpenCompany\Integrations\Akismet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Akismet\Tools\AkismetCommentCheck;
use OpenCompany\Integrations\Akismet\Tools\AkismetKeySites;
use OpenCompany\Integrations\Akismet\Tools\AkismetSubmitHam;
use OpenCompany\Integrations\Akismet\Tools\AkismetSubmitSpam;
use OpenCompany\Integrations\Akismet\Tools\AkismetUsageLimit;
use OpenCompany\Integrations\Akismet\Tools\AkismetVerifyKey;

/**
 * Tool catalog and configuration metadata for Akismet.
 *
 * Exposes key verification, content spam checks, feedback submission, API-key
 * site activity, and current usage-limit endpoints.
 */
class AkismetToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key', 'blog'],
                'notes' => ['Akismet requires an API key and the front-page URL of the site or app instance.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'akismet';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Akismet',
            'description' => 'Spam detection for comments, forms, signups, and user content',
            'icon' => 'ph:shield-check',
            'logo' => 'ph:shield-check',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Akismet',
            'description' => 'Akismet API for API-key verification, comment and form spam detection, missed-spam and false-positive feedback, key/site activity, and monthly usage-limit status.',
            'icon' => 'ph:shield-check',
            'logo' => 'ph:shield-check',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://akismet.com/developers/detailed-docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Akismet API key', 'hint' => 'Required for all Akismet API calls.', 'required' => true],
            ['key' => 'blog', 'type' => 'url', 'label' => 'Blog URL', 'placeholder' => 'https://example.test', 'hint' => 'Front page or home URL of the site or app instance.', 'required' => true],
        ];
    }

    /**
     * Verify Akismet credentials with the verify-key endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            $blog = (string) ($config['blog'] ?? '');
            if ($apiKey === '' || $blog === '') {
                return ['success' => false, 'error' => 'Akismet API key and blog URL are required.'];
            }

            $response = Http::asForm()
                ->withUserAgent('OpenCompany Integrations/1.0 | Akismet')
                ->timeout(20)
                ->post('https://rest.akismet.com/1.1/verify-key', ['api_key' => $apiKey, 'blog' => $blog]);

            return trim($response->body()) === 'valid'
                ? ['success' => true, 'message' => 'Akismet API key accepted.']
                : ['success' => false, 'error' => 'Akismet verify-key returned '.trim($response->body()).'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'blog' => 'required|url'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Akismet API key', 'hint' => 'Required for all Akismet API calls.', 'required' => true],
            ['key' => 'blog', 'type' => 'url', 'label' => 'Blog URL', 'placeholder' => 'https://example.test', 'hint' => 'Front page or home URL of the site or app instance.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'akismet_verify_key' => ['class' => AkismetVerifyKey::class, 'type' => 'read', 'name' => 'Verify Key', 'description' => 'Verify the Akismet API key and blog URL.', 'icon' => 'ph:key'],
            'akismet_comment_check' => ['class' => AkismetCommentCheck::class, 'type' => 'read', 'name' => 'Comment Check', 'description' => 'Check submitted content for spam.', 'icon' => 'ph:chat-circle-dots'],
            'akismet_submit_spam' => ['class' => AkismetSubmitSpam::class, 'type' => 'write', 'name' => 'Submit Spam', 'description' => 'Submit missed spam feedback to Akismet.', 'icon' => 'ph:warning'],
            'akismet_submit_ham' => ['class' => AkismetSubmitHam::class, 'type' => 'write', 'name' => 'Submit Ham', 'description' => 'Submit false-positive ham feedback to Akismet.', 'icon' => 'ph:check-circle'],
            'akismet_key_sites' => ['class' => AkismetKeySites::class, 'type' => 'read', 'name' => 'Key Sites', 'description' => 'Retrieve site activity for the API key.', 'icon' => 'ph:chart-bar'],
            'akismet_usage_limit' => ['class' => AkismetUsageLimit::class, 'type' => 'read', 'name' => 'Usage Limit', 'description' => 'Retrieve current monthly API usage and throttling status.', 'icon' => 'ph:gauge'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an Akismet tool from the catalog class name.
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
    private function resolveService(array $context = []): AkismetService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AkismetService(
                apiKey: $creds->get('akismet', 'api_key', '', $account),
                blog: $creds->get('akismet', 'blog', '', $account),
            );
        }

        return app(AkismetService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/akismet.md';
    }
}
