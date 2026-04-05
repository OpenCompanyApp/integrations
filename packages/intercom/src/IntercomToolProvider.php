<?php

namespace OpenCompany\Integrations\Intercom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Intercom\Tools\IntercomCreateContact;
use OpenCompany\Integrations\Intercom\Tools\IntercomGetContact;
use OpenCompany\Integrations\Intercom\Tools\IntercomUpdateContact;
use OpenCompany\Integrations\Intercom\Tools\IntercomListContacts;
use OpenCompany\Integrations\Intercom\Tools\IntercomSearchContacts;
use OpenCompany\Integrations\Intercom\Tools\IntercomDeleteContact;
use OpenCompany\Integrations\Intercom\Tools\IntercomCreateConversation;
use OpenCompany\Integrations\Intercom\Tools\IntercomReplyConversation;
use OpenCompany\Integrations\Intercom\Tools\IntercomListConversations;
use OpenCompany\Integrations\Intercom\Tools\IntercomGetConversation;
use OpenCompany\Integrations\Intercom\Tools\IntercomListAdmins;
use OpenCompany\Integrations\Intercom\Tools\IntercomListTags;
use OpenCompany\Integrations\Intercom\Tools\IntercomTagContacts;
use OpenCompany\Integrations\Intercom\Tools\IntercomCreateNote;
use OpenCompany\Integrations\Intercom\Tools\IntercomListCompanies;

/**
 * Registers all Intercom tools and provides integration metadata, configuration schema, and connection testing.
 */
class IntercomToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'intercom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crm, contacts, conversations, support',
            'description' => 'Customer messaging platform',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:intercom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Intercom',
            'description' => 'Customer messaging platform – contacts, conversations, admins, tags, notes, and companies',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:intercom',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.intercom.com/docs/references/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'dG9rZW4...',
                'hint' => 'Create a personal access token in Intercom Settings → Developers → Your App → Configure → Authentication.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Create one in Intercom Settings → Developers.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Intercom-Version' => '2.11',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.intercom.io/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = trim(($data['name'] ?? '') . ' ' . ($data['email'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Intercom as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['errors'] ?? $body['message'] ?? $response->body();

            if (is_array($error)) {
                $error = collect($error)->map(fn ($e) => ($e['message'] ?? json_encode($e)))->implode('; ');
            }

            return [
                'success' => false,
                'error' => 'Intercom API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Contacts
            'intercom_create_contact' => [
                'class' => IntercomCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Intercom.',
                'icon' => 'ph:user-plus',
            ],
            'intercom_get_contact' => [
                'class' => IntercomGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve an Intercom contact by ID.',
                'icon' => 'ph:user',
            ],
            'intercom_update_contact' => [
                'class' => IntercomUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing Intercom contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'intercom_list_contacts' => [
                'class' => IntercomListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List Intercom contacts with pagination.',
                'icon' => 'ph:users',
            ],
            'intercom_search_contacts' => [
                'class' => IntercomSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search Intercom contacts with structured queries.',
                'icon' => 'ph:magnifying-glass',
            ],
            'intercom_delete_contact' => [
                'class' => IntercomDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete an Intercom contact.',
                'icon' => 'ph:trash',
            ],
            // Conversations
            'intercom_create_conversation' => [
                'class' => IntercomCreateConversation::class,
                'type' => 'write',
                'name' => 'Create Conversation',
                'description' => 'Create a new Intercom conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'intercom_reply_conversation' => [
                'class' => IntercomReplyConversation::class,
                'type' => 'write',
                'name' => 'Reply Conversation',
                'description' => 'Reply to an Intercom conversation.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'intercom_list_conversations' => [
                'class' => IntercomListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List Intercom conversations with pagination.',
                'icon' => 'ph:list',
            ],
            'intercom_get_conversation' => [
                'class' => IntercomGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Retrieve an Intercom conversation by ID.',
                'icon' => 'ph:chat-circle',
            ],
            // Admins
            'intercom_list_admins' => [
                'class' => IntercomListAdmins::class,
                'type' => 'read',
                'name' => 'List Admins',
                'description' => 'List Intercom admins.',
                'icon' => 'ph:shield-check',
            ],
            // Tags
            'intercom_list_tags' => [
                'class' => IntercomListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List Intercom tags.',
                'icon' => 'ph:tag',
            ],
            'intercom_tag_contacts' => [
                'class' => IntercomTagContacts::class,
                'type' => 'write',
                'name' => 'Tag Contacts',
                'description' => 'Tag Intercom contacts.',
                'icon' => 'ph:tag-simple',
            ],
            // Notes
            'intercom_create_note' => [
                'class' => IntercomCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note on an Intercom contact.',
                'icon' => 'ph:note',
            ],
            // Companies
            'intercom_list_companies' => [
                'class' => IntercomListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List Intercom companies with pagination.',
                'icon' => 'ph:buildings',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/intercom.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
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
     * Resolve the IntercomService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): IntercomService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new IntercomService(
                apiToken: $creds->get('intercom', 'api_token', '', $account),
            );
        }

        return app(IntercomService::class);
    }
}
