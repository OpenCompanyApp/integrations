<?php

namespace OpenCompany\Integrations\Mindee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mindee\Tools\MindeeGetCurrentUser;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseCustom;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseInvoice;
use OpenCompany\Integrations\Mindee\Tools\MindeeParsePassport;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseReceipt;

/**
 * Tool provider for the Mindee document OCR integration.
 *
 * Implements ConfigurableIntegration for credential management and
 * multi-account support via createTool().
 */
class MindeeToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration's app name identifier.
     */
    public function appName(): string
    {
        return 'mindee';
    }

    /**
     * Get metadata for the app display in the UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'invoice OCR, receipt OCR, passport OCR, custom documents',
            'description' => 'Document OCR & parsing',
            'icon' => 'ph:scan',
            'logo' => 'simple-icons:mindee',
        ];
    }

    /**
     * Get metadata for the integration configuration UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mindee',
            'description' => 'Document OCR and data extraction — invoices, receipts, passports, and custom documents',
            'icon' => 'ph:scan',
            'logo' => 'simple-icons:mindee',
            'category' => 'documents',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mindee.com/docs',
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
                'hint' => 'Find your API key in the Mindee dashboard under <b>Settings → API Keys</b>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.mindee.net/v1',
                'hint' => 'Use the default Mindee API URL, or override for a custom endpoint',
                'default' => 'https://api.mindee.net/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Mindee API using the provided configuration.
     *
     * @param array<string, mixed> $config Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.mindee.net/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->successful()) {
                $user = $response->json('data') ?? [];

                return [
                    'success' => true,
                    'message' => 'Connected to Mindee API' . (isset($user['email']) ? " as {$user['email']}." : '.'),
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Mindee API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
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
            'mindee_parse_invoice' => [
                'class' => MindeeParseInvoice::class,
                'type' => 'write',
                'name' => 'Parse Invoice',
                'description' => 'Extract structured data from an invoice document (PDF or image).',
                'icon' => 'ph:invoice',
            ],
            'mindee_parse_receipt' => [
                'class' => MindeeParseReceipt::class,
                'type' => 'write',
                'name' => 'Parse Receipt',
                'description' => 'Extract structured data from an expense receipt (PDF or image).',
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
                'description' => 'Parse a document using a custom Mindee endpoint.',
                'icon' => 'ph:file-text',
            ],
            'mindee_get_current_user' => [
                'class' => MindeeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Mindee user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mindee.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.mindee.net/v1'],
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * Supports multi-account by resolving a MindeeService with the
     * credentials from the specified account context.
     *
     * @param class-string<Tool> $class   The tool class to instantiate.
     * @param array<string, mixed> $context Context containing optional 'account' key.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MindeeService, with optional account-specific credentials.
     *
     * @param array<string, mixed> $context Context containing optional 'account' key.
     * @return MindeeService The resolved service instance.
     */
    private function resolveService(array $context = []): MindeeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MindeeService(
                apiKey: $creds->get('mindee', 'api_key', '', $account),
                baseUrl: $creds->get('mindee', 'url', 'https://api.mindee.net/v1', $account),
            );
        }

        return app(MindeeService::class);
    }
}
