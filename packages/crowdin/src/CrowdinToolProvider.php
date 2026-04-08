<?php

namespace OpenCompany\Integrations\Crowdin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinListProjects;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinGetProject;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinListStrings;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinGetString;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinListTranslations;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinListLanguages;
use OpenCompany\Integrations\Crowdin\Tools\CrowdinGetCurrentUser;

class CrowdinToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'crowdin';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, strings, translations, languages',
            'description' => 'Localization management platform',
            'icon' => 'ph:globe-stand',
            'logo' => 'simple-icons:crowdin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Crowdin',
            'description' => 'Localization management platform for translating content across multiple languages',
            'icon' => 'ph:globe-stand',
            'logo' => 'simple-icons:crowdin',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.crowdin.com/api/v2/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Crowdin Personal Access Token',
                'hint' => 'Generate a Personal Access Token in <a href="https://crowdin.com/settings#api-key" target="_blank">Crowdin Settings → API</a>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.crowdin.com/api/v2',
                'hint' => 'Use <code>https://api.crowdin.com/api/v2</code> for cloud or your own URL for Crowdin Enterprise',
                'default' => 'https://api.crowdin.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.crowdin.com/api/v2', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if (!$response->successful()) {
                $error = $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Crowdin API error: {$error}",
                ];
            }

            $user = $response->json('data') ?? [];

            return [
                'success' => true,
                'message' => "Connected to Crowdin API as " . ($user['username'] ?? 'unknown user') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'crowdin_list_projects' => [
                'class' => CrowdinListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Crowdin projects.',
                'icon' => 'ph:folder',
            ],
            'crowdin_get_project' => [
                'class' => CrowdinGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'crowdin_list_strings' => [
                'class' => CrowdinListStrings::class,
                'type' => 'read',
                'name' => 'List Strings',
                'description' => 'List source strings in a project.',
                'icon' => 'ph:text-aa',
            ],
            'crowdin_get_string' => [
                'class' => CrowdinGetString::class,
                'type' => 'read',
                'name' => 'Get String',
                'description' => 'Get details of a specific string.',
                'icon' => 'ph:text-aa',
            ],
            'crowdin_list_translations' => [
                'class' => CrowdinListTranslations::class,
                'type' => 'read',
                'name' => 'List Translations',
                'description' => 'List translations for a project.',
                'icon' => 'ph:translate',
            ],
            'crowdin_list_languages' => [
                'class' => CrowdinListLanguages::class,
                'type' => 'read',
                'name' => 'List Languages',
                'description' => 'List supported languages.',
                'icon' => 'ph:globe',
            ],
            'crowdin_get_current_user' => [
                'class' => CrowdinGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/crowdin.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.crowdin.com/api/v2'],
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

            $service = new CrowdinService(
                apiToken: $creds->get('crowdin', 'api_token', '', $account),
                baseUrl: $creds->get('crowdin', 'base_url', 'https://api.crowdin.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(CrowdinService::class));
    }
}
