<?php

namespace OpenCompany\Integrations\ChurnZero;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroDeleteAccount;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroDeleteContact;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroIncrementAttribute;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroSendAction;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroSetAttributes;
use OpenCompany\Integrations\ChurnZero\Tools\ChurnZeroTrackEvent;

/**
 * Tool catalog and configuration metadata for ChurnZero.
 *
 * Exposes ChurnZero's action-based HTTP API for agent-safe customer success
 * writes, event tracking, and account/contact lifecycle actions.
 */
class ChurnZeroToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key_query',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['app_key'],
                'notes' => ['ChurnZero expects appKey as a query parameter on the configured /i endpoint.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
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

    /**
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'churnzero';
    }

    /**
     * Get short metadata describing the integration's capabilities.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'ChurnZero',
            'description' => 'Customer success event and attribute API',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:churnzero',
        ];
    }

    /**
     * Get full integration metadata for display and categorization.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ChurnZero',
            'description' => 'Send ChurnZero account attributes, contact attributes, events, and lifecycle actions.',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:churnzero',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API',
        ];
    }

    /**
     * Get the configuration schema for the ChurnZero integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'app_key',
                'type' => 'secret',
                'label' => 'App Key',
                'placeholder' => 'ChurnZero app key',
                'hint' => 'Found in ChurnZero under Admin > Data > Application Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'HTTP API Endpoint',
                'placeholder' => 'https://analytics.churnzero.net/i',
                'hint' => 'Use the endpoint shown beside the ChurnZero application key. Regional hosts are supported.',
                'default' => 'https://analytics.churnzero.net/i',
            ],
        ];
    }

    /**
     * Validate ChurnZero configuration without issuing a mutating HTTP API action.
     *
     * @param  array<string, mixed>  $config  Configuration containing app_key and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $appKey = (string) ($config['app_key'] ?? $config['api_key'] ?? '');
        $endpoint = $this->normalizeEndpoint((string) ($config['url'] ?? 'https://analytics.churnzero.net/i'));

        if ($appKey === '') {
            return ['success' => false, 'error' => 'No ChurnZero app key provided.'];
        }

        if (! filter_var($endpoint, FILTER_VALIDATE_URL)) {
            return ['success' => false, 'error' => 'ChurnZero HTTP API endpoint must be a valid URL.'];
        }

        return [
            'success' => true,
            'message' => 'ChurnZero configuration is present for ' . $endpoint . '. The HTTP API has no documented non-mutating test endpoint, so the first write action verifies credentials.',
        ];
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'app_key' => 'nullable|string',
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'churnzero_set_attributes' => [
                'class' => ChurnZeroSetAttributes::class,
                'type' => 'write',
                'name' => 'Set Attributes',
                'description' => 'Set one or more account or contact attributes through ChurnZero setAttribute actions.',
                'icon' => 'ph:pencil-simple',
            ],
            'churnzero_track_event' => [
                'class' => ChurnZeroTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track a ChurnZero event for an account and optional contact.',
                'icon' => 'ph:activity',
            ],
            'churnzero_increment_attribute' => [
                'class' => ChurnZeroIncrementAttribute::class,
                'type' => 'write',
                'name' => 'Increment Attribute',
                'description' => 'Increment a numeric ChurnZero account or contact attribute.',
                'icon' => 'ph:plus-circle',
            ],
            'churnzero_delete_contact' => [
                'class' => ChurnZeroDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a ChurnZero contact by account and contact external IDs.',
                'icon' => 'ph:user-minus',
            ],
            'churnzero_delete_account' => [
                'class' => ChurnZeroDeleteAccount::class,
                'type' => 'write',
                'name' => 'Delete Account',
                'description' => 'Delete a ChurnZero account by external ID.',
                'icon' => 'ph:building-office',
            ],
            'churnzero_send_action' => [
                'class' => ChurnZeroSendAction::class,
                'type' => 'write',
                'name' => 'Send Action',
                'description' => 'Send an advanced raw action to the ChurnZero HTTP API endpoint.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/churnzero.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'app_key', 'type' => 'secret', 'label' => 'App Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'HTTP API Endpoint', 'required' => false, 'default' => 'https://analytics.churnzero.net/i'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a ChurnZero service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    private function resolveService(array $context = []): ChurnZeroService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ChurnZeroService(
                appKey: $creds->get('churnzero', 'app_key', $creds->get('churnzero', 'api_key', '', $account), $account),
                endpoint: $creds->get('churnzero', 'url', 'https://analytics.churnzero.net/i', $account),
            );
        }

        return app(ChurnZeroService::class);
    }

    /**
     * Normalize a configured endpoint or host to the HTTP API /i endpoint.
     */
    private function normalizeEndpoint(string $endpoint): string
    {
        $endpoint = rtrim($endpoint, '/');

        return str_ends_with($endpoint, '/i') ? $endpoint : $endpoint . '/i';
    }
}
