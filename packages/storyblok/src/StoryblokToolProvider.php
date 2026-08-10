<?php

namespace OpenCompany\Integrations\Storyblok;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokListStories;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokGetStory;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokCreateStory;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokUpdateStory;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokDeleteStory;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokListComponents;
use OpenCompany\Integrations\Storyblok\Tools\StoryblokGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class StoryblokToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'storyblok';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Storyblok',
            'description' => 'Headless CMS',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:storyblok',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Storyblok',
            'description' => 'Headless CMS with visual editor',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:storyblok',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.storyblok.com/docs/api/management',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Storyblok Personal Access Token',
                'hint' => 'Generate a Personal Access Token in your Storyblok account settings under "Personal Access Tokens"',
                'required' => true,
            ],
            [
                'key' => 'space_id',
                'type' => 'text',
                'label' => 'Space ID',
                'placeholder' => 'e.g., 123456',
                'hint' => 'The numeric ID of the Storyblok space to work with. Found in the space URL or settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.storyblok.com/v1',
                'hint' => 'Use <code>https://api.storyblok.com/v1</code> for the default Management API, or a custom endpoint.',
                'default' => 'https://api.storyblok.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.storyblok.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/spaces');

            $json = $response->json();

            if ($response->successful() && $json !== null) {
                $spaceCount = count($json['spaces'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to Storyblok API. Found {$spaceCount} space(s).",
                ];
            }

            $error = $json['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => "Storyblok API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'space_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'storyblok_list_stories' => [
                'class' => StoryblokListStories::class,
                'type' => 'read',
                'name' => 'List Stories',
                'description' => 'List stories in a Storyblok space.',
                'icon' => 'ph:list',
            ],
            'storyblok_get_story' => [
                'class' => StoryblokGetStory::class,
                'type' => 'read',
                'name' => 'Get Story',
                'description' => 'Get a single story by ID.',
                'icon' => 'ph:file-text',
            ],
            'storyblok_create_story' => [
                'class' => StoryblokCreateStory::class,
                'type' => 'write',
                'name' => 'Create Story',
                'description' => 'Create a new story in Storyblok.',
                'icon' => 'ph:plus',
            ],
            'storyblok_update_story' => [
                'class' => StoryblokUpdateStory::class,
                'type' => 'write',
                'name' => 'Update Story',
                'description' => 'Update an existing story.',
                'icon' => 'ph:pencil',
            ],
            'storyblok_delete_story' => [
                'class' => StoryblokDeleteStory::class,
                'type' => 'write',
                'name' => 'Delete Story',
                'description' => 'Delete a story from Storyblok.',
                'icon' => 'ph:trash',
            ],
            'storyblok_list_components' => [
                'class' => StoryblokListComponents::class,
                'type' => 'read',
                'name' => 'List Components',
                'description' => 'List all components in the space.',
                'icon' => 'ph:puzzle-piece',
            ],
            'storyblok_get_current_user' => [
                'class' => StoryblokGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User / Spaces',
                'description' => 'List available Storyblok spaces (health check).',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/storyblok.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'space_id', 'type' => 'text', 'label' => 'Space ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.storyblok.com/v1'],
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

            $service = new StoryblokService(
                accessToken: $creds->get('storyblok', 'access_token', '', $account),
                spaceId: $creds->get('storyblok', 'space_id', '', $account),
                baseUrl: $creds->get('storyblok', 'url', 'https://api.storyblok.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(StoryblokService::class));
    }
}
