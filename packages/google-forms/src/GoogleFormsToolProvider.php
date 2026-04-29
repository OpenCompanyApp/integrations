<?php

namespace OpenCompany\Integrations\GoogleForms;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsListForms;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsGetForm;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsCreateForm;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsListResponses;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsGetResponse;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsCreateResponse;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleFormsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'google-forms';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Forms',
            'description' => 'Create forms and collect responses',
            'icon' => 'ph:clipboard-text',
            'logo' => 'logos:google-forms',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Forms',
            'description' => 'Create surveys, quizzes, and forms. Collect and manage responses.',
            'icon' => 'ph:clipboard-text',
            'logo' => 'logos:google-forms',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/forms/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth access token',
                'hint' => 'Use a Google OAuth 2.0 access token with Forms API scope (<code>https://www.googleapis.com/auth/forms</code>)',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://forms.googleapis.com',
                'hint' => 'Override only if using a proxy or custom endpoint',
                'default' => 'https://forms.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://forms.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($response->successful() && isset($json['email'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Google Forms as {$json['email']}.",
                ];
            }

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Google Forms API at {$baseUrl}.",
                ];
            }

            $error = $json['error']['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => "Authentication failed: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gforms_list_forms' => [
                'class' => GFormsListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List Google Forms owned by the authenticated user.',
                'icon' => 'ph:list',
            ],
            'gforms_get_form' => [
                'class' => GFormsGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details of a specific Google Form.',
                'icon' => 'ph:clipboard-text',
            ],
            'gforms_create_form' => [
                'class' => GFormsCreateForm::class,
                'type' => 'write',
                'name' => 'Create Form',
                'description' => 'Create a new Google Form.',
                'icon' => 'ph:plus-circle',
            ],
            'gforms_list_responses' => [
                'class' => GFormsListResponses::class,
                'type' => 'read',
                'name' => 'List Responses',
                'description' => 'List responses submitted to a Google Form.',
                'icon' => 'ph:list-checks',
            ],
            'gforms_get_response' => [
                'class' => GFormsGetResponse::class,
                'type' => 'read',
                'name' => 'Get Response',
                'description' => 'Get a specific form response.',
                'icon' => 'ph:file-text',
            ],
            'gforms_create_response' => [
                'class' => GFormsCreateResponse::class,
                'type' => 'write',
                'name' => 'Submit Response',
                'description' => 'Submit a response to a Google Form.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'gforms_get_current_user' => [
                'class' => GFormsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-forms.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://forms.googleapis.com'],
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

            $service = new GoogleFormsService(
                accessToken: $creds->get('google-forms', 'access_token', '', $account),
                baseUrl: $creds->get('google-forms', 'url', 'https://forms.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleFormsService::class));
    }
}
