<?php

namespace OpenCompany\Integrations\Matrix;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Matrix\Tools\MatrixCreateRoom;
use OpenCompany\Integrations\Matrix\Tools\MatrixGetCurrentUser;
use OpenCompany\Integrations\Matrix\Tools\MatrixGetProfile;
use OpenCompany\Integrations\Matrix\Tools\MatrixGetRoom;
use OpenCompany\Integrations\Matrix\Tools\MatrixListMembers;
use OpenCompany\Integrations\Matrix\Tools\MatrixListRooms;
use OpenCompany\Integrations\Matrix\Tools\MatrixSendMessage;

class MatrixToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'matrix';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'rooms, messages, members, profiles',
            'description' => 'Decentralized messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:matrix',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Matrix',
            'description' => 'Decentralized, open-source communication protocol',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:matrix',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://spec.matrix.org/v1.13/client-server-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Matrix access token',
                'hint' => 'Get an access token from your Matrix client settings or via the <code>/_matrix/client/v3/login</code> endpoint',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Homeserver URL',
                'placeholder' => 'https://matrix.org',
                'hint' => 'Your Matrix homeserver URL. Use <code>https://matrix.org</code> for the default, or your self-hosted homeserver URL',
                'default' => 'https://matrix.org',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://matrix.org', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/_matrix/client/v3/account/whoami');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Matrix homeserver at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $userId = $json['user_id'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Matrix as {$userId}.",
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
            'matrix_list_rooms' => [
                'class' => MatrixListRooms::class,
                'type' => 'read',
                'name' => 'List Rooms',
                'description' => 'List rooms the authenticated user has joined.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'matrix_get_room' => [
                'class' => MatrixGetRoom::class,
                'type' => 'read',
                'name' => 'Get Room',
                'description' => 'Get details of a specific room.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'matrix_create_room' => [
                'class' => MatrixCreateRoom::class,
                'type' => 'write',
                'name' => 'Create Room',
                'description' => 'Create a new room on the Matrix homeserver.',
                'icon' => 'ph:plus-circle',
            ],
            'matrix_send_message' => [
                'class' => MatrixSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Matrix room.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'matrix_list_members' => [
                'class' => MatrixListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a Matrix room.',
                'icon' => 'ph:users',
            ],
            'matrix_get_profile' => [
                'class' => MatrixGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get a Matrix user\'s profile information.',
                'icon' => 'ph:user',
            ],
            'matrix_get_current_user' => [
                'class' => MatrixGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/matrix.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Homeserver URL', 'required' => false, 'default' => 'https://matrix.org'],
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

            $service = new MatrixService(
                accessToken: $creds->get('matrix', 'access_token', '', $account),
                baseUrl: $creds->get('matrix', 'url', 'https://matrix.org', $account),
            );

            return new $class($service);
        }

        return new $class(app(MatrixService::class));
    }
}
