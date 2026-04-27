<?php

namespace OpenCompany\Integrations\Phrase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Phrase\Tools\PhraseListProjects;
use OpenCompany\Integrations\Phrase\Tools\PhraseGetProject;
use OpenCompany\Integrations\Phrase\Tools\PhraseListKeys;
use OpenCompany\Integrations\Phrase\Tools\PhraseGetKey;
use OpenCompany\Integrations\Phrase\Tools\PhraseListTranslations;
use OpenCompany\Integrations\Phrase\Tools\PhraseListLocales;
use OpenCompany\Integrations\Phrase\Tools\PhraseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all available Phrase tools and provides integration metadata, configuration schema, and connection testing.
 */
class PhraseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'phrase';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'localization, translation, i18n',
            'description' => 'Localization platform',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:phrase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Phrase',
            'description' => 'Localization platform for projects, translation keys, locales, and translations',
            'icon' => 'ph:translate',
            'logo' => 'simple-icons:phrase',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.phrase.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Phrase API token',
                'hint' => 'Generate a token at <a href="https://app.phrase.com/settings/api_tokens" target="_blank">Phrase → Settings → API Tokens</a>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'API token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.phrase.com/v2/user');

            if ($response->successful()) {
                $data = $response->json();
                $name = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
                $name = trim($name) ?: ($data['username'] ?? 'Unknown user');

                return [
                    'success' => true,
                    'message' => "Connected to Phrase as \"{$name}\".",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Phrase API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Projects
            'phrase_list_projects' => [
                'class' => PhraseListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Phrase projects.',
                'icon' => 'ph:folder',
            ],
            'phrase_get_project' => [
                'class' => PhraseGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a single Phrase project.',
                'icon' => 'ph:folder-open',
            ],
            // Keys
            'phrase_list_keys' => [
                'class' => PhraseListKeys::class,
                'type' => 'read',
                'name' => 'List Keys',
                'description' => 'List translation keys in a project.',
                'icon' => 'ph:key',
            ],
            'phrase_get_key' => [
                'class' => PhraseGetKey::class,
                'type' => 'read',
                'name' => 'Get Key',
                'description' => 'Get a single translation key by ID.',
                'icon' => 'ph:key',
            ],
            // Translations
            'phrase_list_translations' => [
                'class' => PhraseListTranslations::class,
                'type' => 'read',
                'name' => 'List Translations',
                'description' => 'List translations in a project.',
                'icon' => 'ph:text-aa',
            ],
            // Locales
            'phrase_list_locales' => [
                'class' => PhraseListLocales::class,
                'type' => 'read',
                'name' => 'List Locales',
                'description' => 'List locales in a project.',
                'icon' => 'ph:globe',
            ],
            // User
            'phrase_get_current_user' => [
                'class' => PhraseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/phrase.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the PhraseService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): PhraseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new PhraseService(
                accessToken: $creds->get('phrase', 'access_token', '', $account),
            );
        }

        return app(PhraseService::class);
    }
}
