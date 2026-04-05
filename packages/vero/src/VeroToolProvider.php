<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vero\Tools\VeroGetCurrentUser;
use OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser;
use OpenCompany\Integrations\Vero\Tools\VeroResubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;
use OpenCompany\Integrations\Vero\Tools\VeroUnsubscribe;
use OpenCompany\Integrations\Vero\Tools\VeroUpdateUser;

/**
 * Tool provider for the Vero email marketing integration.
 *
 * Registers six tools for user identity management, event tracking,
 * and subscription control. Supports multi-account credential resolution.
 */
class VeroToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'identify, track, subscribe, unsubscribe',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vero',
            'description' => 'Email marketing — user identity, event tracking, and subscription management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vero',
            'category' => 'email',
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
                'hint' => 'Find your auth token in Vero under Settings → API Credentials',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getvero.com/api/v2',
                'hint' => 'Use the default Vero API URL, or a custom endpoint for proxying',
                'default' => 'https://api.getvero.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $authToken = $config['auth_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getvero.com/api/v2', '/');

        if (empty($authToken)) {
            return ['success' => false, 'error' => 'No auth token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $authToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Vero API at {$baseUrl}.",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Vero API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'auth_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'vero_identify_user' => [
                'class' => VeroIdentifyUser::class,
                'type' => 'write',
                'name' => 'Identify User',
                'description' => 'Identify (create or update) a user in Vero with email, name, and custom attributes.',
                'icon' => 'ph:user-plus',
            ],
            'vero_track_event' => [
                'class' => VeroTrackEvent::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track a behavioral event for a user in Vero.',
                'icon' => 'ph:lightning',
            ],
            'vero_update_user' => [
                'class' => VeroUpdateUser::class,
                'type' => 'write',
                'name' => 'Update User',
                'description' => 'Update a user\'s profile data and email in Vero.',
                'icon' => 'ph:pencil-simple',
            ],
            'vero_unsubscribe' => [
                'class' => VeroUnsubscribe::class,
                'type' => 'write',
                'name' => 'Unsubscribe',
                'description' => 'Unsubscribe a user from all Vero email campaigns.',
                'icon' => 'ph:envelope-simple',
            ],
            'vero_resubscribe' => [
                'class' => VeroResubscribe::class,
                'type' => 'write',
                'name' => 'Resubscribe',
                'description' => 'Resubscribe a user to Vero email campaigns.',
                'icon' => 'ph:envelope-open',
            ],
            'vero_get_current_user' => [
                'class' => VeroGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Vero user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vero.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getvero.com/api/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context (may contain 'account' key).
     */
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
