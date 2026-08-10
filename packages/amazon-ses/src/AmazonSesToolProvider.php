<?php

namespace OpenCompany\Integrations\AmazonSes;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesApiDelete;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesApiGet;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesApiPost;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesApiPut;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesCreateTemplate;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesDeleteTemplate;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesGetAccount;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesGetIdentity;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesGetTemplate;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListConfigurationSets;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListIdentities;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListSuppressions;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListTemplates;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesSendEmail;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesUpdateTemplate;

/**
 * Tool catalog and configuration metadata for Amazon SES.
 *
 * Uses AWS access keys for SigV4-signed SES v2 requests and exposes typed plus
 * generic tools for broad SES API coverage.
 */
class AmazonSesToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'aws_sigv4',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Requires AWS access key ID and secret access key with SES permissions.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
        return 'amazon-ses';
    }

    /**
     * Short metadata shown in UI tool listings.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Amazon SES',
            'description' => 'Signed SES v2 email API',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:amazonaws',
        ];
    }

    /**
     * Full integration metadata for catalogs and settings.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Amazon SES',
            'description' => 'AWS SES v2 email sending, templates, identities, suppression lists, configuration sets, and generic signed API tools',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:amazonaws',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.aws.amazon.com/ses/latest/APIReference-V2/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'access_key_id', 'type' => 'secret', 'label' => 'AWS Access Key ID', 'placeholder' => 'AKIA...', 'required' => true],
            ['key' => 'secret_access_key', 'type' => 'secret', 'label' => 'AWS Secret Access Key', 'required' => true],
            ['key' => 'region', 'type' => 'string', 'label' => 'AWS Region', 'placeholder' => 'us-east-1', 'default' => 'us-east-1', 'required' => true],
            ['key' => 'session_token', 'type' => 'secret', 'label' => 'AWS Session Token', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'SES API URL', 'placeholder' => 'https://email.us-east-1.amazonaws.com', 'required' => false],
        ];
    }

    /**
     * Verify required AWS credential fields are present.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        if (empty($config['access_key_id']) || empty($config['secret_access_key'])) {
            return ['success' => false, 'error' => 'AWS access key ID and secret access key are required.'];
        }

        return ['success' => true, 'message' => 'Amazon SES AWS credentials are present. Run Get Account for a live signed API check.'];
    }

    /**
     * Laravel validation rules for configuration values.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_key_id' => 'nullable|string',
            'secret_access_key' => 'nullable|string',
            'region' => 'nullable|string',
            'session_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'amazonses_send_email' => ['class' => AmazonSesSendEmail::class, 'type' => 'write', 'name' => 'Send Email', 'description' => 'Send an email via Amazon SES v2.', 'icon' => 'ph:paper-plane-tilt'],
            'amazonses_get_account' => ['class' => AmazonSesGetAccount::class, 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get SES account-level sending details.', 'icon' => 'ph:gauge'],
            'amazonses_get_template' => ['class' => AmazonSesGetTemplate::class, 'type' => 'read', 'name' => 'Get Template', 'description' => 'Get an SES email template by name.', 'icon' => 'ph:file-text'],
            'amazonses_list_templates' => ['class' => AmazonSesListTemplates::class, 'type' => 'read', 'name' => 'List Templates', 'description' => 'List SES email templates.', 'icon' => 'ph:files'],
            'amazonses_create_template' => ['class' => AmazonSesCreateTemplate::class, 'type' => 'write', 'name' => 'Create Template', 'description' => 'Create an SES email template.', 'icon' => 'ph:file-plus'],
            'amazonses_update_template' => ['class' => AmazonSesUpdateTemplate::class, 'type' => 'write', 'name' => 'Update Template', 'description' => 'Update an SES email template.', 'icon' => 'ph:file-text'],
            'amazonses_delete_template' => ['class' => AmazonSesDeleteTemplate::class, 'type' => 'write', 'name' => 'Delete Template', 'description' => 'Delete an SES email template.', 'icon' => 'ph:trash'],
            'amazonses_list_suppressions' => ['class' => AmazonSesListSuppressions::class, 'type' => 'read', 'name' => 'List Suppressions', 'description' => 'List account-level suppressed email addresses.', 'icon' => 'ph:prohibit'],
            'amazonses_list_identities' => ['class' => AmazonSesListIdentities::class, 'type' => 'read', 'name' => 'List Identities', 'description' => 'List SES verified identities.', 'icon' => 'ph:identification-card'],
            'amazonses_get_identity' => ['class' => AmazonSesGetIdentity::class, 'type' => 'read', 'name' => 'Get Identity', 'description' => 'Get SES identity details.', 'icon' => 'ph:identification-card'],
            'amazonses_list_configuration_sets' => ['class' => AmazonSesListConfigurationSets::class, 'type' => 'read', 'name' => 'List Configuration Sets', 'description' => 'List SES configuration sets.', 'icon' => 'ph:sliders'],
            'amazonses_api_get' => ['class' => AmazonSesApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call any signed SES v2 GET endpoint.', 'icon' => 'ph:terminal-window'],
            'amazonses_api_post' => ['class' => AmazonSesApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call any signed SES v2 POST endpoint.', 'icon' => 'ph:terminal-window'],
            'amazonses_api_put' => ['class' => AmazonSesApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call any signed SES v2 PUT endpoint.', 'icon' => 'ph:terminal-window'],
            'amazonses_api_delete' => ['class' => AmazonSesApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call any signed SES v2 DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/amazon-ses.md';
    }

    /**
     * Credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a named account.
     *
     * @param  class-string<Tool>  $class  Tool class.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Amazon SES service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): AmazonSesService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AmazonSesService(
                accessKeyId: $creds->get('amazon-ses', 'access_key_id', '', $account),
                secretAccessKey: $creds->get('amazon-ses', 'secret_access_key', '', $account),
                region: $creds->get('amazon-ses', 'region', 'us-east-1', $account),
                sessionToken: $creds->get('amazon-ses', 'session_token', '', $account),
                baseUrl: $creds->get('amazon-ses', 'url', '', $account),
            );
        }

        return app(AmazonSesService::class);
    }
}
