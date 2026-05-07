<?php

namespace OpenCompany\Integrations\Trello;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Trello\Tools\TrelloListBoards;
use OpenCompany\Integrations\Trello\Tools\TrelloGetBoard;
use OpenCompany\Integrations\Trello\Tools\TrelloListLists;
use OpenCompany\Integrations\Trello\Tools\TrelloGetList;
use OpenCompany\Integrations\Trello\Tools\TrelloListCards;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateCard;
use OpenCompany\Integrations\Trello\Tools\TrelloGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Tool catalog and configuration metadata for the Trello integration.
 */
class TrelloToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'trello';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Trello',
            'description' => 'Project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:trello',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Trello',
            'description' => 'Boards, lists, and cards for project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:trello',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.atlassian.com/cloud/trello/rest/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Trello access token',
                'hint' => 'Generate a token from <code>https://trello.com/app-key</code> under "Token"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.trello.com/1',
                'hint' => 'Use <code>https://api.trello.com/1</code> for the default API, or a custom endpoint',
                'default' => 'https://api.trello.com/1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.trello.com/1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/members/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Trello API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Trello API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $username = $json['username'] ?? 'Unknown';
            $fullName = $json['fullName'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Trello as {$fullName} (@{$username}).",
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
            'trello_list_boards' => [
                'class' => TrelloListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List all boards for the authenticated member.',
                'icon' => 'ph:squares-four',
            ],
            'trello_get_board' => [
                'class' => TrelloGetBoard::class,
                'type' => 'read',
                'name' => 'Get Board',
                'description' => 'Get detailed information about a Trello board.',
                'icon' => 'ph:square-half',
            ],
            'trello_list_lists' => [
                'class' => TrelloListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all lists on a Trello board.',
                'icon' => 'ph:list',
            ],
            'trello_get_list' => [
                'class' => TrelloGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get detailed information about a Trello list.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'trello_list_cards' => [
                'class' => TrelloListCards::class,
                'type' => 'read',
                'name' => 'List Cards',
                'description' => 'List all cards in a Trello list.',
                'icon' => 'ph:cards',
            ],
            'trello_create_card' => [
                'class' => TrelloCreateCard::class,
                'type' => 'write',
                'name' => 'Create Card',
                'description' => 'Create a new card on a Trello list.',
                'icon' => 'ph:plus-card',
            ],
            'trello_get_current_user' => [
                'class' => TrelloGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Trello user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/trello.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.trello.com/1'],
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

            $service = new TrelloService(
                accessToken: $creds->get('trello', 'access_token', '', $account),
                baseUrl: $creds->get('trello', 'url', 'https://api.trello.com/1', $account),
            );

            return new $class($service);
        }

        return new $class(app(TrelloService::class));
    }
}
