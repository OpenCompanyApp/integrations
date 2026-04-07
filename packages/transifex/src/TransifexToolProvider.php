<?php

namespace OpenCompany\Integrations\Transifex;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Transifex\Tools\TransifexListProjects;
use OpenCompany\Integrations\Transifex\Tools\TransifexGetProject;
use OpenCompany\Integrations\Transifex\Tools\TransifexListResources;
use OpenCompany\Integrations\Transifex\Tools\TransifexGetResource;
use OpenCompany\Integrations\Transifex\Tools\TransifexListTranslations;
use OpenCompany\Integrations\Transifex\Tools\TransifexListLanguages;
use OpenCompany\Integrations\Transifex\Tools\TransifexGetCurrentUser;

class TransifexToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'transifex';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, resources, translations, languages',
            'description' => 'Translation management platform',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:transifex',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Transifex',
            'description' => 'Cloud-based translation management platform for localization workflows',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:transifex',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.transifex.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Transifex API token',
                'hint' => 'Generate an API token in <a href="https://www.transifex.com/user/settings/api/" target="_blank">Transifex Settings → API Token</a>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.transifex.com/v2',
                'hint' => 'The Transifex API v2 base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.transifex.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.transifex.com/v2', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                $error = $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Transifex API error: {$error}",
                ];
            }

            $user = $response->json();
            $username = $user['username'] ?? $user['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Transifex as {$username}.",
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
            'transifex_list_projects' => [
                'class' => TransifexListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Transifex projects.',
                'icon' => 'ph:folder',
            ],
            'transifex_get_project' => [
                'class' => TransifexGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific Transifex project.',
                'icon' => 'ph:folder-open',
            ],
            'transifex_list_resources' => [
                'class' => TransifexListResources::class,
                'type' => 'read',
                'name' => 'List Resources',
                'description' => 'List resources in a Transifex project.',
                'icon' => 'ph:files',
            ],
            'transifex_get_resource' => [
                'class' => TransifexGetResource::class,
                'type' => 'read',
                'name' => 'Get Resource',
                'description' => 'Get details of a specific resource.',
                'icon' => 'ph:file-text',
            ],
            'transifex_list_translations' => [
                'class' => TransifexListTranslations::class,
                'type' => 'read',
                'name' => 'List Translations',
                'description' => 'List translations for a resource.',
                'icon' => 'ph:globe',
            ],
            'transifex_list_languages' => [
                'class' => TransifexListLanguages::class,
                'type' => 'read',
                'name' => 'List Languages',
                'description' => 'List languages for a Transifex project.',
                'icon' => 'ph:globe-hemisphere-west',
            ],
            'transifex_get_current_user' => [
                'class' => TransifexGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Transifex user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/transifex.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.transifex.com/v2'],
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

            $service = new TransifexService(
                apiToken: $creds->get('transifex', 'api_token', '', $account),
                baseUrl: $creds->get('transifex', 'base_url', 'https://api.transifex.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(TransifexService::class));
    }
}
