<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTickets;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListUsers;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetUser;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListOrganizations;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetCurrentUser;

/**
 * Registers all Zendesk tools and provides integration metadata, configuration schema, and connection testing.
 */
class ZendeskToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zendesk';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tickets, users, organizations',
            'description' => 'Customer support platform',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk',
            'description' => 'Customer support platform – tickets, users, and organizations',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zendesk',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zendesk.com/api-reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'dG9rZW4...',
                'hint' => 'Create an OAuth token or API token in Zendesk Admin → API. Use Bearer token authentication.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.zendesk.com/v2',
                'hint' => 'Override only if using a custom Zendesk instance. Defaults to <code>https://api.zendesk.com/v2</code>.',
                'default' => 'https://api.zendesk.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.zendesk.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Create one in Zendesk Admin → API.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $user = $data['user'] ?? [];
                $name = trim(($user['name'] ?? '') . ' <' . ($user['email'] ?? '') . '>');

                return [
                    'success' => true,
                    'message' => "Connected to Zendesk as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['error'] ?? $body['description'] ?? $body['message'] ?? $response->body();

            if (is_array($error)) {
                $error = json_encode($error);
            }

            return [
                'success' => false,
                'error' => 'Zendesk API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Tickets
            'zendesk_list_tickets' => [
                'class' => ZendeskListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List Zendesk tickets with pagination and filtering.',
                'icon' => 'ph:list',
            ],
            'zendesk_get_ticket' => [
                'class' => ZendeskGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Retrieve a Zendesk ticket by ID.',
                'icon' => 'ph:ticket',
            ],
            'zendesk_create_ticket' => [
                'class' => ZendeskCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new Zendesk ticket.',
                'icon' => 'ph:ticket',
            ],
            // Users
            'zendesk_list_users' => [
                'class' => ZendeskListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Zendesk users with pagination.',
                'icon' => 'ph:users',
            ],
            'zendesk_get_user' => [
                'class' => ZendeskGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a Zendesk user by ID.',
                'icon' => 'ph:user',
            ],
            // Organizations
            'zendesk_list_organizations' => [
                'class' => ZendeskListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Zendesk organizations.',
                'icon' => 'ph:buildings',
            ],
            'zendesk_get_current_user' => [
                'class' => ZendeskGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zendesk user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/zendesk.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.zendesk.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZendeskService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZendeskService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZendeskService(
                accessToken: $creds->get('zendesk', 'access_token', '', $account),
                baseUrl: $creds->get('zendesk', 'base_url', 'https://api.zendesk.com/v2', $account),
            );
        }

        return app(ZendeskService::class);
    }
}
