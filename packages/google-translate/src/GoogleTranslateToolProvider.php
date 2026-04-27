<?php

namespace OpenCompany\Integrations\GoogleTranslate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateTranslateText;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateDetectLanguage;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateListSupportedLanguages;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateListGlossaries;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateGetGlossary;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateCreateGlossary;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleTranslateToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
        return 'google-translate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'translate, detect, languages, glossaries',
            'description' => 'Google Cloud Translation API',
            'icon' => 'ph:translate',
            'logo' => 'logos:google-translate',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Translate',
            'description' => 'Translate text, detect languages, and manage glossaries with Google Cloud Translation API',
            'icon' => 'ph:translate',
            'logo' => 'logos:google-translate',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://cloud.google.com/translate/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Google Cloud Translation API key',
                'hint' => 'Create an API key in the <a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console</a> and enable the Cloud Translation API',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://translation.googleapis.com/language/translate/v2',
                'hint' => 'The base URL for the Google Cloud Translation API. Override only if using a custom endpoint.',
                'default' => 'https://translation.googleapis.com/language/translate/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://translation.googleapis.com/language/translate/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/languages', [
                'key' => $apiKey,
                'target' => 'en',
            ]);

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Google Translate API error: {$error}",
                ];
            }

            $data = $response->json();
            $languageCount = count($data['data']['languages'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Google Cloud Translation API. {$languageCount} languages available.",
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
            'google_translate_translate_text' => [
                'class' => GoogleTranslateTranslateText::class,
                'type' => 'write',
                'name' => 'Translate Text',
                'description' => 'Translate text using Google Cloud Translation.',
                'icon' => 'ph:translate',
            ],
            'google_translate_detect_language' => [
                'class' => GoogleTranslateDetectLanguage::class,
                'type' => 'read',
                'name' => 'Detect Language',
                'description' => 'Detect the language of text.',
                'icon' => 'ph:magnifying-glass',
            ],
            'google_translate_list_supported_languages' => [
                'class' => GoogleTranslateListSupportedLanguages::class,
                'type' => 'read',
                'name' => 'List Supported Languages',
                'description' => 'List languages supported by Google Translate.',
                'icon' => 'ph:globe',
            ],
            'google_translate_list_glossaries' => [
                'class' => GoogleTranslateListGlossaries::class,
                'type' => 'read',
                'name' => 'List Glossaries',
                'description' => 'List all glossaries.',
                'icon' => 'ph:book-open',
            ],
            'google_translate_get_glossary' => [
                'class' => GoogleTranslateGetGlossary::class,
                'type' => 'read',
                'name' => 'Get Glossary',
                'description' => 'Get details of a glossary.',
                'icon' => 'ph:book-open',
            ],
            'google_translate_create_glossary' => [
                'class' => GoogleTranslateCreateGlossary::class,
                'type' => 'write',
                'name' => 'Create Glossary',
                'description' => 'Create a new glossary.',
                'icon' => 'ph:plus-circle',
            ],
            'google_translate_get_current_user' => [
                'class' => GoogleTranslateGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify the API key and get connection info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-translate.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://translation.googleapis.com/language/translate/v2'],
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

            $service = new GoogleTranslateService(
                apiKey: $creds->get('google-translate', 'api_key', '', $account),
                baseUrl: $creds->get('google-translate', 'base_url', 'https://translation.googleapis.com/language/translate/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleTranslateService::class));
    }
}
