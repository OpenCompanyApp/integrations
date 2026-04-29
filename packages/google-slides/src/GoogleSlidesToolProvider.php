<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesListPresentations;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesGetPresentation;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesCreatePresentation;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesListSlides;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesGetSlide;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesCreateSlide;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleSlidesToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'google-slides';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Slides',
            'description' => 'Google Slides',
            'icon' => 'ph:presentation-chart',
            'logo' => 'simple-icons:googleslides',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Slides',
            'description' => 'Create, read, and manage Google Slides presentations',
            'icon' => 'ph:presentation-chart',
            'logo' => 'simple-icons:googleslides',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/slides/api/reference/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth access token',
                'hint' => 'Provide a valid OAuth 2.0 access token with Google Slides and Drive scopes',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://slides.googleapis.com',
                'hint' => 'Defaults to <code>https://slides.googleapis.com</code>. Change only if using a proxy or custom endpoint.',
                'default' => 'https://slides.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://slides.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/presentations/__connection_test__');

            // Even a 404 means auth worked (presentation doesn't exist, but token is valid)
            if ($response->status() === 404) {
                $json = $response->json();
                // If the error is about the presentation not being found, auth is OK
                if (isset($json['error']['status']) && $json['error']['status'] === 'NOT_FOUND') {
                    return [
                        'success' => true,
                        'message' => 'Connected to Google Slides API.',
                    ];
                }
            }

            // A 403 would indicate auth failure
            if ($response->status() === 401 || $response->status() === 403) {
                $error = $response->json('error.message') ?? 'Authentication failed';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Google Slides API.',
                ];
            }

            return [
                'success' => false,
                'error' => "Unexpected response (HTTP {$response->status()}): " . ($response->json('error.message') ?? $response->body()),
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
            'gslides_list_presentations' => [
                'class' => GoogleSlidesListPresentations::class,
                'type' => 'read',
                'name' => 'List Presentations',
                'description' => 'List Google Slides presentations from the user\'s Drive.',
                'icon' => 'ph:files',
            ],
            'gslides_get_presentation' => [
                'class' => GoogleSlidesGetPresentation::class,
                'type' => 'read',
                'name' => 'Get Presentation',
                'description' => 'Get full details of a specific Google Slides presentation.',
                'icon' => 'ph:file',
            ],
            'gslides_create_presentation' => [
                'class' => GoogleSlidesCreatePresentation::class,
                'type' => 'write',
                'name' => 'Create Presentation',
                'description' => 'Create a new Google Slides presentation.',
                'icon' => 'ph:plus',
            ],
            'gslides_list_slides' => [
                'class' => GoogleSlidesListSlides::class,
                'type' => 'read',
                'name' => 'List Slides',
                'description' => 'List all slides in a Google Slides presentation.',
                'icon' => 'ph:rectangular-grid',
            ],
            'gslides_get_slide' => [
                'class' => GoogleSlidesGetSlide::class,
                'type' => 'read',
                'name' => 'Get Slide',
                'description' => 'Get details of a specific slide in a presentation.',
                'icon' => 'ph:square',
            ],
            'gslides_create_slide' => [
                'class' => GoogleSlidesCreateSlide::class,
                'type' => 'write',
                'name' => 'Create Slide',
                'description' => 'Add a new slide to an existing presentation.',
                'icon' => 'ph:plus-square',
            ],
            'gslides_get_current_user' => [
                'class' => GoogleSlidesGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-slides.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://slides.googleapis.com'],
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

            $service = new GoogleSlidesService(
                accessToken: $creds->get('google-slides', 'access_token', '', $account),
                baseUrl: $creds->get('google-slides', 'url', 'https://slides.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleSlidesService::class));
    }
}
