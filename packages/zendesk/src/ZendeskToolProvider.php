<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskAddTags;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskApplyMacro;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateArticle;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateUser;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskDeleteTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetArticle;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetUser;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListGroups;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListMacros;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListSections;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTicketComments;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTicketFields;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTickets;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListUsers;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSearchArticles;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSearchTickets;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSetTags;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskUpdateTicket;

/**
 * Registers the Zendesk integration and its tools with the integration platform.
 *
 * Provides ticket, user, group, help center, macro, and tag management
 * tools via the Zendesk REST API v2.
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
            'label' => 'tickets, users, help center, macros',
            'description' => 'Zendesk integration for customer support and help center management',
            'icon' => 'simple-icons:zendesk',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk',
            'description' => 'Manage tickets, users, help center articles, macros, and tags on Zendesk.',
            'icon' => 'simple-icons:zendesk',
            'logo' => 'simple-icons:zendesk',
            'category' => 'support',
            'docs_url' => 'https://developer.zendesk.com/api-reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'email',
                'type' => 'text',
                'label' => 'Email Address',
                'placeholder' => 'admin@example.com',
                'hint' => 'The email address associated with your Zendesk account.',
                'required' => true,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'hint' => 'Generate an API token at <a href="https://support.zendesk.com/hc/en-us/articles/226022787-Generating-a-new-API-token" target="_blank">Zendesk Admin → Channels → API</a>.',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Subdomain',
                'placeholder' => 'mycompany',
                'hint' => 'Your Zendesk subdomain (e.g. "mycompany" from mycompany.zendesk.com).',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $email = $config['email'] ?? '';
        $apiToken = $config['api_token'] ?? '';
        $subdomain = $config['subdomain'] ?? '';

        if (empty($email) || empty($apiToken) || empty($subdomain)) {
            return ['success' => false, 'error' => 'Email, API token, and subdomain are all required.'];
        }

        try {
            $response = Http::withBasicAuth($email . '/token', $apiToken)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get("https://{$subdomain}.zendesk.com/api/v2/users/me.json");

            if ($response->successful()) {
                $user = $response->json()['user'] ?? $response->json();
                $name = $user['name'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Zendesk as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['error'] ?? $response->body();

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
            'email' => 'nullable|string|email',
            'api_token' => 'nullable|string',
            'subdomain' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'zendesk_create_ticket' => [
                'class' => ZendeskCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new Zendesk ticket.',
                'icon' => 'mdi:ticket-plus-outline',
            ],
            'zendesk_get_ticket' => [
                'class' => ZendeskGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get details for a specific Zendesk ticket.',
                'icon' => 'mdi:ticket-outline',
            ],
            'zendesk_update_ticket' => [
                'class' => ZendeskUpdateTicket::class,
                'type' => 'write',
                'name' => 'Update Ticket',
                'description' => 'Update an existing Zendesk ticket.',
                'icon' => 'mdi:ticket-edit-outline',
            ],
            'zendesk_delete_ticket' => [
                'class' => ZendeskDeleteTicket::class,
                'type' => 'write',
                'name' => 'Delete Ticket',
                'description' => 'Delete a Zendesk ticket.',
                'icon' => 'mdi:ticket-minus-outline',
            ],
            'zendesk_list_tickets' => [
                'class' => ZendeskListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List Zendesk tickets with pagination and sorting.',
                'icon' => 'mdi:format-list-bulleted',
            ],
            'zendesk_search_tickets' => [
                'class' => ZendeskSearchTickets::class,
                'type' => 'read',
                'name' => 'Search Tickets',
                'description' => 'Search Zendesk tickets using query syntax.',
                'icon' => 'mdi:magnify',
            ],
            'zendesk_list_ticket_comments' => [
                'class' => ZendeskListTicketComments::class,
                'type' => 'read',
                'name' => 'List Ticket Comments',
                'description' => 'List comments on a Zendesk ticket.',
                'icon' => 'mdi:comment-text-outline',
            ],
            'zendesk_list_ticket_fields' => [
                'class' => ZendeskListTicketFields::class,
                'type' => 'read',
                'name' => 'List Ticket Fields',
                'description' => 'List custom and system ticket fields.',
                'icon' => 'mdi:form-select',
            ],
            'zendesk_get_user' => [
                'class' => ZendeskGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details for a specific Zendesk user.',
                'icon' => 'mdi:account-outline',
            ],
            'zendesk_list_users' => [
                'class' => ZendeskListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Zendesk users with optional role filtering.',
                'icon' => 'mdi:account-group-outline',
            ],
            'zendesk_create_user' => [
                'class' => ZendeskCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new Zendesk user.',
                'icon' => 'mdi:account-plus-outline',
            ],
            'zendesk_list_groups' => [
                'class' => ZendeskListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List Zendesk groups.',
                'icon' => 'mdi:account-multiple-outline',
            ],
            'zendesk_search_articles' => [
                'class' => ZendeskSearchArticles::class,
                'type' => 'read',
                'name' => 'Search Articles',
                'description' => 'Search Zendesk Help Center articles.',
                'icon' => 'mdi:text-box-search-outline',
            ],
            'zendesk_get_article' => [
                'class' => ZendeskGetArticle::class,
                'type' => 'read',
                'name' => 'Get Article',
                'description' => 'Get a specific Help Center article.',
                'icon' => 'mdi:text-box-outline',
            ],
            'zendesk_create_article' => [
                'class' => ZendeskCreateArticle::class,
                'type' => 'write',
                'name' => 'Create Article',
                'description' => 'Create a Help Center article in a section.',
                'icon' => 'mdi:text-box-plus-outline',
            ],
            'zendesk_list_sections' => [
                'class' => ZendeskListSections::class,
                'type' => 'read',
                'name' => 'List Sections',
                'description' => 'List Help Center sections.',
                'icon' => 'mdi:folder-outline',
            ],
            'zendesk_list_macros' => [
                'class' => ZendeskListMacros::class,
                'type' => 'read',
                'name' => 'List Macros',
                'description' => 'List available Zendesk macros.',
                'icon' => 'mdi:lightning-bolt-outline',
            ],
            'zendesk_apply_macro' => [
                'class' => ZendeskApplyMacro::class,
                'type' => 'write',
                'name' => 'Apply Macro',
                'description' => 'Apply a macro to a Zendesk ticket.',
                'icon' => 'mdi:lightning-bolt',
            ],
            'zendesk_add_tags' => [
                'class' => ZendeskAddTags::class,
                'type' => 'write',
                'name' => 'Add Tags',
                'description' => 'Add tags to a Zendesk ticket (appends to existing).',
                'icon' => 'mdi:tag-plus-outline',
            ],
            'zendesk_set_tags' => [
                'class' => ZendeskSetTags::class,
                'type' => 'write',
                'name' => 'Set Tags',
                'description' => 'Set tags on a Zendesk ticket (replaces all existing tags).',
                'icon' => 'mdi:tag-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/zendesk.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'email', 'type' => 'text', 'label' => 'Email Address', 'required' => true],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'subdomain', 'type' => 'text', 'label' => 'Subdomain', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ZendeskService(
                email: $creds->get('zendesk', 'email', '', $account),
                apiToken: $creds->get('zendesk', 'api_token', '', $account),
                subdomain: $creds->get('zendesk', 'subdomain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZendeskService::class));
    }
}
