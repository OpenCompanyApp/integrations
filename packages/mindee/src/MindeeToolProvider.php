<?php

namespace OpenCompany\Integrations\Mindee;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mindee\Tools\MindeeGetAsyncPrediction;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseCustom;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseInvoice;
use OpenCompany\Integrations\Mindee\Tools\MindeeParsePassport;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseReceipt;
use OpenCompany\Integrations\Mindee\Tools\MindeePredictDocument;
use OpenCompany\Integrations\Mindee\Tools\MindeePredictDocumentAsync;

/**
 * Tool catalog and configuration metadata for Mindee.
 *
 * Exposes Mindee's synchronous prediction, asynchronous prediction, polling,
 * and common off-the-shelf parsing endpoints.
 */
class MindeeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Mindee uses the Authorization: Token header format.'],
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
        return 'mindee';
    }

    /**
     * Metadata for app display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Mindee',
            'description' => 'Document OCR and parsing',
            'icon' => 'ph:scan',
            'logo' => 'simple-icons:mindee',
        ];
    }

    /**
     * Metadata for catalogs and integration settings.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mindee',
            'description' => 'Document OCR and data extraction with synchronous and asynchronous prediction endpoints',
            'icon' => 'ph:scan',
            'logo' => 'simple-icons:mindee',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mindee.com/docs/endpoints',
        ];
    }

    /**
     * Get the configuration schema for the integration settings.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Mindee API key',
                'hint' => 'Generate a Mindee API key from the Mindee platform.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mindee.net/v1',
                'hint' => 'Override only for a proxy or compatible endpoint.',
                'default' => 'https://api.mindee.net/v1',
            ],
        ];
    }

    /**
     * Test the configuration without making a document-processing request.
     *
     * Mindee's documented API is prediction-oriented, so this check verifies that
     * required setup values are present without calling an unrelated endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        return [
            'success' => true,
            'message' => 'Mindee API key is present. Run a prediction tool with a sample document for a live API check.',
        ];
    }

    /**
     * Get validation rules for integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'mindee_predict_document' => [
                'class' => MindeePredictDocument::class,
                'type' => 'write',
                'name' => 'Predict Document',
                'description' => 'Run synchronous prediction against any Mindee product endpoint.',
                'icon' => 'ph:scan',
            ],
            'mindee_predict_document_async' => [
                'class' => MindeePredictDocumentAsync::class,
                'type' => 'write',
                'name' => 'Predict Document Async',
                'description' => 'Enqueue asynchronous prediction against any Mindee product endpoint.',
                'icon' => 'ph:clock',
            ],
            'mindee_get_async_prediction' => [
                'class' => MindeeGetAsyncPrediction::class,
                'type' => 'read',
                'name' => 'Get Async Prediction',
                'description' => 'Poll a Mindee asynchronous prediction job.',
                'icon' => 'ph:queue',
            ],
            'mindee_parse_invoice' => [
                'class' => MindeeParseInvoice::class,
                'type' => 'write',
                'name' => 'Parse Invoice',
                'description' => 'Extract structured data from an invoice document.',
                'icon' => 'ph:invoice',
            ],
            'mindee_parse_receipt' => [
                'class' => MindeeParseReceipt::class,
                'type' => 'write',
                'name' => 'Parse Receipt',
                'description' => 'Extract structured data from an expense receipt.',
                'icon' => 'ph:receipt',
            ],
            'mindee_parse_passport' => [
                'class' => MindeeParsePassport::class,
                'type' => 'write',
                'name' => 'Parse Passport',
                'description' => 'Extract structured data from a passport document.',
                'icon' => 'ph:identification-card',
            ],
            'mindee_parse_custom' => [
                'class' => MindeeParseCustom::class,
                'type' => 'write',
                'name' => 'Parse Custom Document',
                'description' => 'Parse a document using a custom Mindee endpoint ID.',
                'icon' => 'ph:file-text',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/mindee.md';
    }

    /**
     * Get credential fields for this integration.
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Mindee service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    private function resolveService(array $context = []): MindeeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MindeeService(
                apiKey: $creds->get('mindee', 'api_key', '', $account),
                baseUrl: $creds->get('mindee', 'url', 'https://api.mindee.net/v1', $account),
            );
        }

        return app(MindeeService::class);
    }
}
