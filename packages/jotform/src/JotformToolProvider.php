<?php

namespace OpenCompany\Integrations\Jotform;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Jotform\Tools\JotformListForms;
use OpenCompany\Integrations\Jotform\Tools\JotformGetForm;
use OpenCompany\Integrations\Jotform\Tools\JotformListSubmissions;
use OpenCompany\Integrations\Jotform\Tools\JotformGetSubmission;
use OpenCompany\Integrations\Jotform\Tools\JotformCreateForm;
use OpenCompany\Integrations\Jotform\Tools\JotformListQuestions;
use OpenCompany\Integrations\Jotform\Tools\JotformGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class JotformToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'jotform';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'forms, submissions, questions',
            'description' => 'Online form builder',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:jotform',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Jotform',
            'description' => 'Online form builder — create forms, collect submissions, and manage questions',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:jotform',
            'category' => 'forms',
            'badge' => 'verified',
            'docs_url' => 'https://api.jotform.com/docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Jotform API key',
                'hint' => 'Find your API key in your Jotform account under <strong>Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.jotform.com',
                'hint' => 'Use <code>https://api.jotform.com</code> for the default API, or <code>https://eu-api.jotform.com</code> for EU region',
                'default' => 'https://api.jotform.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.jotform.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'JotAPI-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Jotform API at {$baseUrl}. Check the URL.",
                ];
            }

            if (isset($json['responseCode']) && $json['responseCode'] === 200) {
                $username = $json['content']['username'] ?? 'unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Jotform API as {$username}.",
                ];
            }

            $message = $json['message'] ?? $json['error'] ?? 'Unknown error';
            return [
                'success' => false,
                'error' => "Jotform API error: {$message}",
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
            'jotform_list_forms' => [
                'class' => JotformListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms owned by the authenticated user.',
                'icon' => 'ph:list',
            ],
            'jotform_get_form' => [
                'class' => JotformGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific form.',
                'icon' => 'ph:notebook',
            ],
            'jotform_list_submissions' => [
                'class' => JotformListSubmissions::class,
                'type' => 'read',
                'name' => 'List Submissions',
                'description' => 'List submissions for a specific form.',
                'icon' => 'ph:inbox',
            ],
            'jotform_get_submission' => [
                'class' => JotformGetSubmission::class,
                'type' => 'read',
                'name' => 'Get Submission',
                'description' => 'Get details for a specific submission.',
                'icon' => 'ph:file-text',
            ],
            'jotform_create_form' => [
                'class' => JotformCreateForm::class,
                'type' => 'write',
                'name' => 'Create Form',
                'description' => 'Create a new form.',
                'icon' => 'ph:plus-circle',
            ],
            'jotform_list_questions' => [
                'class' => JotformListQuestions::class,
                'type' => 'read',
                'name' => 'List Questions',
                'description' => 'List all questions (fields) for a form.',
                'icon' => 'ph:question',
            ],
            'jotform_get_current_user' => [
                'class' => JotformGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get profile info for the authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/jotform.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.jotform.com'],
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

            $service = new JotformService(
                apiKey: $creds->get('jotform', 'api_key', '', $account),
                baseUrl: $creds->get('jotform', 'url', 'https://api.jotform.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(JotformService::class));
    }
}
