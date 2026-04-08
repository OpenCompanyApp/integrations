<?php

namespace OpenCompany\Integrations\Gravity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gravity\Tools\GravityListForms;
use OpenCompany\Integrations\Gravity\Tools\GravityGetForm;
use OpenCompany\Integrations\Gravity\Tools\GravitySubmitForm;
use OpenCompany\Integrations\Gravity\Tools\GravityListSubmissions;
use OpenCompany\Integrations\Gravity\Tools\GravityListEntries;
use OpenCompany\Integrations\Gravity\Tools\GravityGetEntry;
use OpenCompany\Integrations\Gravity\Tools\GravityGetCurrentUser;

class GravityToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'gravity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'forms, submissions, entries',
            'description' => 'Gravity Forms — WordPress form management',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:gravity',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Gravity Forms',
            'description' => 'WordPress form builder — manage forms, collect submissions, and view entries',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:gravity',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.gravity.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Gravity API key',
                'hint' => 'Find your API key in your Gravity Forms settings under <strong>Settings → REST API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.gravity.com/v1',
                'hint' => 'Use <code>https://api.gravity.com/v1</code> for the default API',
                'default' => 'https://api.gravity.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.gravity.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gravity API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                $username = $json['username'] ?? $json['user']['username'] ?? 'unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Gravity API as {$username}.",
                ];
            }

            $message = $json['message'] ?? $json['error'] ?? 'Unknown error';
            return [
                'success' => false,
                'error' => "Gravity API error: {$message}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gravity_list_forms' => [
                'class' => GravityListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms.',
                'icon' => 'ph:list',
            ],
            'gravity_get_form' => [
                'class' => GravityGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific form.',
                'icon' => 'ph:notebook',
            ],
            'gravity_submit_form' => [
                'class' => GravitySubmitForm::class,
                'type' => 'write',
                'name' => 'Submit Form',
                'description' => 'Submit a form with field values.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'gravity_list_submissions' => [
                'class' => GravityListSubmissions::class,
                'type' => 'read',
                'name' => 'List Submissions',
                'description' => 'List submissions for a specific form.',
                'icon' => 'ph:inbox',
            ],
            'gravity_list_entries' => [
                'class' => GravityListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries for a specific form.',
                'icon' => 'ph:table',
            ],
            'gravity_get_entry' => [
                'class' => GravityGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Get details for a specific entry.',
                'icon' => 'ph:file-text',
            ],
            'gravity_get_current_user' => [
                'class' => GravityGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get profile info for the authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gravity.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.gravity.com/v1'],
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

            $service = new GravityService(
                apiKey: $creds->get('gravity', 'api_key', '', $account),
                baseUrl: $creds->get('gravity', 'url', 'https://api.gravity.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(GravityService::class));
    }
}
