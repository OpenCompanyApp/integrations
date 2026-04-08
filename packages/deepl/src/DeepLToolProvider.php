<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DeepL\Tools\DeepLTranslateText;
use OpenCompany\Integrations\DeepL\Tools\DeepLListLanguages;
use OpenCompany\Integrations\DeepL\Tools\DeepLGetUsage;
use OpenCompany\Integrations\DeepL\Tools\DeepLListGlossaries;
use OpenCompany\Integrations\DeepL\Tools\DeepLGetGlossary;
use OpenCompany\Integrations\DeepL\Tools\DeepLCreateGlossary;
use OpenCompany\Integrations\DeepL\Tools\DeepLGetCurrentUser;

class DeepLToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'deepl';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'translate, languages, glossaries, usage',
            'description' => 'AI-powered translation',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'DeepL',
            'description' => 'AI-powered language translation with glossary support',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:deepl',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.deepl.com/docs',
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
                'hint' => 'Find your API key in the <a href="https://www.deepl.com/account/summary" target="_blank">DeepL account settings</a>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.deepl.com',
                'hint' => 'Use <code>https://api.deepl.com</code> for paid plans or <code>https://api-free.deepl.com</code> for the free tier',
                'default' => 'https://api.deepl.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.deepl.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/usage');

            if (!$response->successful()) {
                $error = $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "DeepL API error: {$error}",
                ];
            }

            $usage = $response->json();
            $characterCount = number_format($usage['character_count'] ?? 0);
            $characterLimit = number_format($usage['character_limit'] ?? 0);

            return [
                'success' => true,
                'message' => "Connected to DeepL API. Usage: {$characterCount} / {$characterLimit} characters.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'deepl_translate_text' => [
                'class' => DeepLTranslateText::class,
                'type' => 'write',
                'name' => 'Translate Text',
                'description' => 'Translate text using DeepL.',
                'icon' => 'ph:translate',
            ],
            'deepl_list_languages' => [
                'class' => DeepLListLanguages::class,
                'type' => 'read',
                'name' => 'List Languages',
                'description' => 'List supported languages.',
                'icon' => 'ph:globe',
            ],
            'deepl_get_usage' => [
                'class' => DeepLGetUsage::class,
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Check DeepL API usage.',
                'icon' => 'ph:chart-bar',
            ],
            'deepl_list_glossaries' => [
                'class' => DeepLListGlossaries::class,
                'type' => 'read',
                'name' => 'List Glossaries',
                'description' => 'List all glossaries.',
                'icon' => 'ph:book-open',
            ],
            'deepl_get_glossary' => [
                'class' => DeepLGetGlossary::class,
                'type' => 'read',
                'name' => 'Get Glossary',
                'description' => 'Get details of a glossary.',
                'icon' => 'ph:book-open',
            ],
            'deepl_create_glossary' => [
                'class' => DeepLCreateGlossary::class,
                'type' => 'write',
                'name' => 'Create Glossary',
                'description' => 'Create a new glossary.',
                'icon' => 'ph:plus-circle',
            ],
            'deepl_get_current_user' => [
                'class' => DeepLGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current DeepL account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/deepl.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.deepl.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new DeepLService(
                apiKey: $creds->get('deepl', 'api_key', '', $account),
                baseUrl: $creds->get('deepl', 'base_url', 'https://api.deepl.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(DeepLService::class));
    }
}
