<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DeepL\Tools\DeepLTranslate;
use OpenCompany\Integrations\DeepL\Tools\DeepLBatchTranslate;
use OpenCompany\Integrations\DeepL\Tools\DeepLDetectLanguage;
use OpenCompany\Integrations\DeepL\Tools\DeepLGetUsage;
use OpenCompany\Integrations\DeepL\Tools\DeepLListLanguages;

/**
 * Tool provider and configurable integration for DeepL.
 *
 * Registers all DeepL translation tools and provides the integration
 * configuration schema, connection testing, and multi-account support.
 */
class DeepLToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'deepl';
    }

    /**
     * Get metadata for the app registry.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'translate, batch translate, detect language, usage, languages',
            'description' => 'AI-powered translation',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
        ];
    }

    /**
     * Get metadata for the integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'DeepL',
            'description' => 'AI-powered language translation',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
            'category' => 'translation',
            'badge' => 'verified',
            'docs_url' => 'https://developers.deepl.com/docs',
        ];
    }

    /**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'auth_key',
                'type' => 'secret',
                'label' => 'Auth Key',
                'placeholder' => 'Enter your DeepL auth key',
                'hint' => 'Find your authentication key in the <a href="https://www.deepl.com/account/summary" target="_blank">DeepL account settings</a>',
                'required' => true,
            ],
            [
                'key' => 'is_free',
                'type' => 'toggle',
                'label' => 'Free API Account',
                'hint' => 'Enable if you are using a DeepL Free API account. Uses <code>api-free.deepl.com</code> instead of <code>api.deepl.com</code>.',
                'default' => false,
            ],
        ];
    }

    /**
     * Test the connection to the DeepL API.
     *
     * @param  array<string, mixed>  $config  The integration configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $authKey = $config['auth_key'] ?? '';
        $isFree = (bool) ($config['is_free'] ?? false);
        $baseUrl = $isFree
            ? 'https://api-free.deepl.com/v2'
            : 'https://api.deepl.com/v2';

        if (empty($authKey)) {
            return ['success' => false, 'error' => 'No auth key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . $authKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/usage');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach DeepL API at {$baseUrl}. Check your auth key and account type.",
                ];
            }

            $used = number_format($json['character_count'] ?? 0);
            $limit = number_format($json['character_limit'] ?? 0);

            return [
                'success' => true,
                'message' => "Connected to DeepL API ({$used} / {$limit} characters used).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'auth_key' => 'nullable|string',
            'is_free' => 'nullable|boolean',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'deepl_translate' => [
                'class' => DeepLTranslate::class,
                'type' => 'write',
                'name' => 'Translate',
                'description' => 'Translate text to a target language.',
                'icon' => 'ph:translate',
            ],
            'deepl_batch_translate' => [
                'class' => DeepLBatchTranslate::class,
                'type' => 'write',
                'name' => 'Batch Translate',
                'description' => 'Translate multiple texts at once.',
                'icon' => 'ph:list-checks',
            ],
            'deepl_detect_language' => [
                'class' => DeepLDetectLanguage::class,
                'type' => 'read',
                'name' => 'Detect Language',
                'description' => 'Detect the language of a text.',
                'icon' => 'ph:magnifying-glass',
            ],
            'deepl_get_usage' => [
                'class' => DeepLGetUsage::class,
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Check API usage and character limits.',
                'icon' => 'ph:chart-bar',
            ],
            'deepl_list_languages' => [
                'class' => DeepLListLanguages::class,
                'type' => 'read',
                'name' => 'List Languages',
                'description' => 'List supported source and target languages.',
                'icon' => 'ph:globe',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/deepl.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_key', 'type' => 'secret', 'label' => 'Auth Key', 'required' => true],
            ['key' => 'is_free', 'type' => 'toggle', 'label' => 'Free API Account', 'required' => false, 'default' => false],
        ];
    }

    /**
     * Whether this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new DeepLService(
                authKey: $creds->get('deepl', 'auth_key', '', $account),
                isFree: (bool) ($creds->get('deepl', 'is_free', false, $account)),
            );

            return new $class($service);
        }

        return new $class(app(DeepLService::class));
    }
}
