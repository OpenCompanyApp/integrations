<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;
use OpenCompany\Integrations\Vero\Tools\VeroUpdateUser;
use OpenCompany\Integrations\Vero\Tools\VeroAddTag;
use OpenCompany\Integrations\Vero\Tools\VeroRemoveTag;

class VeroToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'users, events, tags',
            'description' => 'Customer engagement platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vero',
            'description' => 'Customer engagement and email marketing platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
            'category' => 'email_marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.getvero.com/rest-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'auth_token',
                'type' => 'secret',
                'label' => 'Auth Token',
                'placeholder' => 'Enter your Vero auth token',
                'hint' => 'Find your auth token in your Vero account settings under "Account > API Credentials"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getvero.com/api/v2',
                'hint' => 'Override only if using a custom Vero endpoint',
                'default' => 'https://api.getvero.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $authToken = $config['auth_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getvero.com/api/v2', '/');

        if (empty($authToken)) {
            return ['success' => false, 'error' => 'No auth token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $authToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl . '/users/track', [
                'identity' => ['id' => '__connection_test__'],
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Vero API at {$baseUrl}. Check the URL and auth token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Vero API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'auth_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'vero_identify_user' => [
                'class' => VeroIdentifyUser::class,
                'type' => 'write',
                'name' => 'Identify User',
                'description' => 'Identify or create a user in Vero with their profile attributes.',
                'icon' => 'ph:user-plus',
            ],
            'vero_track_event' => [
                'class' => VeroTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track a custom event for a user in Vero.',
                'icon' => 'ph:cursor-click',
            ],
            'vero_update_user' => [
                'class' => VeroUpdateUser::class,
                'type' => 'write',
                'name' => 'Update User',
                'description' => 'Update a user\'s profile attributes in Vero.',
                'icon' => 'ph:pencil-simple',
            ],
            'vero_add_tag' => [
                'class' => VeroAddTag::class,
                'type' => 'write',
                'name' => 'Add Tag',
                'description' => 'Add one or more tags to a user in Vero.',
                'icon' => 'ph:tag',
            ],
            'vero_remove_tag' => [
                'class' => VeroRemoveTag::class,
                'type' => 'write',
                'name' => 'Remove Tag',
                'description' => 'Remove one or more tags from a user in Vero.',
                'icon' => 'ph:tag-x',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vero.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Vero API URL', 'required' => false, 'default' => 'https://api.getvero.com/api/v2'],
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

            $service = new VeroService(
                authToken: $creds->get('vero', 'auth_token', '', $account),
                baseUrl: $creds->get('vero', 'url', 'https://api.getvero.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(VeroService::class));
    }
}
