<?php

namespace OpenCompany\Integrations\Abyssale;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleCreateGeneration;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetCurrentUser;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetGeneration;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetTemplate;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListFormats;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListGenerations;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleListTemplates;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AbyssaleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'abyssale';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'generations, templates, formats',
            'description' => 'Automated image generation',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:abyssale',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Abyssale',
            'description' => 'Automated image and banner generation platform',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:abyssale',
            'category' => 'media',
            'badge' => 'verified',
            'docs_url' => 'https://api.abyssale.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Abyssale access token',
                'hint' => 'Find your API key in Abyssale under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.abyssale.com',
                'hint' => 'Defaults to <code>https://api.abyssale.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.abyssale.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.abyssale.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Abyssale API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Abyssale API returned an error: {$error}",
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));
            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Abyssale as {$name} ({$email}).",
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
            'abyssale_list_generations' => [
                'class' => AbyssaleListGenerations::class,
                'type' => 'read',
                'name' => 'List Generations',
                'description' => 'List image generation jobs.',
                'icon' => 'ph:images',
            ],
            'abyssale_get_generation' => [
                'class' => AbyssaleGetGeneration::class,
                'type' => 'read',
                'name' => 'Get Generation',
                'description' => 'Get details of a specific image generation.',
                'icon' => 'ph:image',
            ],
            'abyssale_create_generation' => [
                'class' => AbyssaleCreateGeneration::class,
                'type' => 'write',
                'name' => 'Create Generation',
                'description' => 'Generate images from a template.',
                'icon' => 'ph:plus-circle',
            ],
            'abyssale_list_templates' => [
                'class' => AbyssaleListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available design templates.',
                'icon' => 'ph:layout',
            ],
            'abyssale_get_template' => [
                'class' => AbyssaleGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details of a specific template.',
                'icon' => 'ph:layout',
            ],
            'abyssale_list_formats' => [
                'class' => AbyssaleListFormats::class,
                'type' => 'read',
                'name' => 'List Formats',
                'description' => 'List available output formats.',
                'icon' => 'ph:crop',
            ],
            'abyssale_get_current_user' => [
                'class' => AbyssaleGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/abyssale.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.abyssale.com'],
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

            $service = new AbyssaleService(
                accessToken: $creds->get('abyssale', 'access_token', '', $account),
                baseUrl: $creds->get('abyssale', 'url', 'https://api.abyssale.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AbyssaleService::class));
    }
}
