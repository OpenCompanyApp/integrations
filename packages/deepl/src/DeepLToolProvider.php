<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and setup metadata for the DeepL integration.
 *
 * Exposes generated tools for DeepL's official OpenAPI document and resolves
 * account-specific DeepL API keys for host applications.
 */
class DeepLToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_key'],
                'notes' => ['DeepL requests use the DeepL-Auth-Key authorization scheme.'],
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
        return 'deepl';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'DeepL',
            'description' => 'Translation, documents, glossaries, write/rephrase, admin analytics, style rules, translation memories, and voice',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'DeepL',
            'description' => 'Translate text and documents, manage DeepL glossaries, rephrase text, inspect usage, administer developer keys and analytics, manage style rules, list translation memories, and create voice realtime sessions.',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.deepl.com/docs',
            'source_url' => 'https://raw.githubusercontent.com/DeepLcom/openapi/main/openapi.yaml',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your DeepL API key',
                'hint' => 'Find your API key in the DeepL account settings.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.deepl.com',
                'hint' => 'Use https://api.deepl.com for paid plans or https://api-free.deepl.com for the free tier.',
                'default' => 'https://api.deepl.com',
            ],
        ];
    }

    /**
     * Test the configured DeepL API key with the usage endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.deepl.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . $apiKey,
            ])->acceptJson()->timeout(10)->get($baseUrl . '/v2/usage');

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'DeepL API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $usage = $response->json() ?? [];
            $characterCount = number_format($usage['character_count'] ?? 0);
            $characterLimit = number_format($usage['character_limit'] ?? 0);

            return [
                'success' => true,
                'message' => "Connected to DeepL API. Usage: {$characterCount} / {$characterLimit} characters.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Register generated DeepL OpenAPI tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (DeepLService::operations() as $slug => $operation) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'],
                'type' => $operation['type'] ?? 'read',
                'name' => $operation['name'] ?? $slug,
                'description' => $operation['description'] ?? '',
                'icon' => $this->iconFor($operation),
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/deepl.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
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
    private function resolveService(array $context = []): DeepLService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DeepLService(
                apiKey: (string) $creds->get('deepl', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('deepl', 'base_url', 'https://api.deepl.com', (string) $account),
            );
        }

        return app(DeepLService::class);
    }

    /**
     * Choose a catalog icon from the operation path.
     *
     * @param  array<string, mixed>  $operation  Operation metadata.
     */
    private function iconFor(array $operation): string
    {
        $path = (string) ($operation['path'] ?? '');

        return match (true) {
            str_contains($path, '/translate') => 'ph:translate',
            str_contains($path, '/document') => 'ph:file-text',
            str_contains($path, '/glossar') => 'ph:book-open',
            str_contains($path, '/usage'), str_contains($path, '/analytics') => 'ph:chart-bar',
            str_contains($path, '/admin') => 'ph:key',
            str_contains($path, '/style_rules') => 'ph:list-checks',
            str_contains($path, '/voice') => 'ph:microphone',
            default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple',
        };
    }
}