<?php

namespace OpenCompany\Integrations\Affinity;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Affinity tools and integration metadata.
 *
 * Exposes the current v2 API surface for discovery and resolves account-scoped
 * services for multi-account host applications.
 */
class AffinityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Affinity API v2 uses the API key as a bearer token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
        return 'affinity';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Affinity',
            'description' => 'Relationship intelligence CRM',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:affinity',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Affinity',
            'description' => 'Relationship intelligence CRM for persons, companies, opportunities, lists, notes, and interactions',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:affinity',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.affinity.co/docs/v2/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Affinity API key',
                'hint' => 'Generate an API key from Affinity Settings under Manage Apps.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.affinity.co',
                'hint' => 'Defaults to https://api.affinity.co. Change only for a compatible proxy.',
                'default' => 'https://api.affinity.co',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to the Affinity API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.affinity.co'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/v2/auth/user');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Affinity API rejected the credentials.'];
            }

            $name = trim((string) ($response->json('firstName') ?? '') . ' ' . (string) ($response->json('lastName') ?? ''));

            return ['success' => true, 'message' => $name === '' ? 'Connected to Affinity.' : "Connected to Affinity as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Affinity tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'affinity_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Affinity user and API permissions.', 'icon' => 'ph:user-circle'],
            'affinity_list_contacts' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContacts', 'type' => 'read', 'name' => 'List Persons', 'description' => 'List persons in Affinity.', 'icon' => 'ph:users'],
            'affinity_get_contact' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetContact', 'type' => 'read', 'name' => 'Get Person', 'description' => 'Get a person by ID.', 'icon' => 'ph:user'],
            'affinity_create_contact' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityCreateContact', 'type' => 'write', 'name' => 'Create Person', 'description' => 'Create a person using Affinity API.', 'icon' => 'ph:user-plus'],
            'affinity_list_contact_fields' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContactFields', 'type' => 'read', 'name' => 'List Person Fields', 'description' => 'List person field metadata.', 'icon' => 'ph:list-dashes'],
            'affinity_list_contact_field_values' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContactFieldValues', 'type' => 'read', 'name' => 'List Person Field Values', 'description' => 'List field values on a person.', 'icon' => 'ph:list-checks'],
            'affinity_get_contact_field_value' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetContactFieldValue', 'type' => 'read', 'name' => 'Get Person Field Value', 'description' => 'Get a single field value on a person.', 'icon' => 'ph:textbox'],
            'affinity_list_contact_lists' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContactLists', 'type' => 'read', 'name' => 'List Person Lists', 'description' => 'List lists where a person appears.', 'icon' => 'ph:list'],
            'affinity_list_contact_list_entries' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContactListEntries', 'type' => 'read', 'name' => 'List Person List Entries', 'description' => 'List list entries for a person.', 'icon' => 'ph:table'],
            'affinity_list_contact_notes' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListContactNotes', 'type' => 'read', 'name' => 'List Person Notes', 'description' => 'List notes related to a person.', 'icon' => 'ph:note'],
            'affinity_list_organizations' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizations', 'type' => 'read', 'name' => 'List Companies', 'description' => 'List companies in Affinity.', 'icon' => 'ph:buildings'],
            'affinity_get_organization' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetOrganization', 'type' => 'read', 'name' => 'Get Company', 'description' => 'Get a company by ID.', 'icon' => 'ph:building'],
            'affinity_create_organization' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityCreateOrganization', 'type' => 'write', 'name' => 'Create Company', 'description' => 'Create a company using Affinity API.', 'icon' => 'ph:building-office'],
            'affinity_list_organization_fields' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizationFields', 'type' => 'read', 'name' => 'List Company Fields', 'description' => 'List company field metadata.', 'icon' => 'ph:list-dashes'],
            'affinity_list_organization_field_values' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizationFieldValues', 'type' => 'read', 'name' => 'List Company Field Values', 'description' => 'List field values on a company.', 'icon' => 'ph:list-checks'],
            'affinity_get_organization_field_value' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetOrganizationFieldValue', 'type' => 'read', 'name' => 'Get Company Field Value', 'description' => 'Get a single field value on a company.', 'icon' => 'ph:textbox'],
            'affinity_list_organization_lists' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizationLists', 'type' => 'read', 'name' => 'List Company Lists', 'description' => 'List lists where a company appears.', 'icon' => 'ph:list'],
            'affinity_list_organization_list_entries' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizationListEntries', 'type' => 'read', 'name' => 'List Company List Entries', 'description' => 'List list entries for a company.', 'icon' => 'ph:table'],
            'affinity_list_organization_notes' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOrganizationNotes', 'type' => 'read', 'name' => 'List Company Notes', 'description' => 'List notes related to a company.', 'icon' => 'ph:note'],
            'affinity_list_opportunities' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOpportunities', 'type' => 'read', 'name' => 'List Opportunities', 'description' => 'List opportunities in Affinity.', 'icon' => 'ph:briefcase'],
            'affinity_get_opportunity' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetOpportunity', 'type' => 'read', 'name' => 'Get Opportunity', 'description' => 'Get an opportunity by ID.', 'icon' => 'ph:briefcase'],
            'affinity_list_opportunity_notes' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListOpportunityNotes', 'type' => 'read', 'name' => 'List Opportunity Notes', 'description' => 'List notes related to an opportunity.', 'icon' => 'ph:note'],
            'affinity_list_lists' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListLists', 'type' => 'read', 'name' => 'List Lists', 'description' => 'List Affinity lists.', 'icon' => 'ph:list-bullets'],
            'affinity_get_list' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetList', 'type' => 'read', 'name' => 'Get List', 'description' => 'Get metadata for a list.', 'icon' => 'ph:list'],
            'affinity_list_list_fields' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListListFields', 'type' => 'read', 'name' => 'List List Fields', 'description' => 'List field metadata for a list.', 'icon' => 'ph:list-dashes'],
            'affinity_list_list_entries' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListListEntries', 'type' => 'read', 'name' => 'List List Entries', 'description' => 'List entries on a list.', 'icon' => 'ph:table'],
            'affinity_get_list_entry' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetListEntry', 'type' => 'read', 'name' => 'Get List Entry', 'description' => 'Get one list entry.', 'icon' => 'ph:table'],
            'affinity_list_list_entry_fields' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListListEntryFields', 'type' => 'read', 'name' => 'List List Entry Fields', 'description' => 'List field values on a list entry.', 'icon' => 'ph:list-checks'],
            'affinity_get_list_entry_field' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetListEntryField', 'type' => 'read', 'name' => 'Get List Entry Field', 'description' => 'Get one field value on a list entry.', 'icon' => 'ph:textbox'],
            'affinity_update_list_entry_field' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityUpdateListEntryField', 'type' => 'write', 'name' => 'Update List Entry Field', 'description' => 'Update one field value on a list entry.', 'icon' => 'ph:pencil'],
            'affinity_batch_update_list_entry_fields' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityBatchUpdateListEntryFields', 'type' => 'write', 'name' => 'Batch Update List Entry Fields', 'description' => 'Batch update field values on a list entry.', 'icon' => 'ph:stack'],
            'affinity_list_saved_views' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListSavedViews', 'type' => 'read', 'name' => 'List Saved Views', 'description' => 'List saved views for a list.', 'icon' => 'ph:eye'],
            'affinity_get_saved_view' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetSavedView', 'type' => 'read', 'name' => 'Get Saved View', 'description' => 'Get saved view metadata.', 'icon' => 'ph:eye'],
            'affinity_list_saved_view_entries' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListSavedViewEntries', 'type' => 'read', 'name' => 'List Saved View Entries', 'description' => 'List entries on a saved view.', 'icon' => 'ph:table'],
            'affinity_list_notes' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListNotes', 'type' => 'read', 'name' => 'List Notes', 'description' => 'List notes.', 'icon' => 'ph:note'],
            'affinity_get_note' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetNote', 'type' => 'read', 'name' => 'Get Note', 'description' => 'Get a note by ID.', 'icon' => 'ph:note'],
            'affinity_list_note_replies' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListNoteReplies', 'type' => 'read', 'name' => 'List Note Replies', 'description' => 'List replies for a note.', 'icon' => 'ph:chat-circle-text'],
            'affinity_list_note_persons' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListNotePersons', 'type' => 'read', 'name' => 'List Note Persons', 'description' => 'List persons attached to a note.', 'icon' => 'ph:users'],
            'affinity_list_note_companies' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListNoteCompanies', 'type' => 'read', 'name' => 'List Note Companies', 'description' => 'List companies attached to a note.', 'icon' => 'ph:buildings'],
            'affinity_list_note_opportunities' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListNoteOpportunities', 'type' => 'read', 'name' => 'List Note Opportunities', 'description' => 'List opportunities attached to a note.', 'icon' => 'ph:briefcase'],
            'affinity_list_calls' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListCalls', 'type' => 'read', 'name' => 'List Calls', 'description' => 'List call interactions.', 'icon' => 'ph:phone'],
            'affinity_list_emails' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListEmails', 'type' => 'read', 'name' => 'List Emails', 'description' => 'List email interactions.', 'icon' => 'ph:envelope'],
            'affinity_list_meetings' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListMeetings', 'type' => 'read', 'name' => 'List Meetings', 'description' => 'List meeting interactions.', 'icon' => 'ph:calendar'],
            'affinity_list_chat_messages' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListChatMessages', 'type' => 'read', 'name' => 'List Chat Messages', 'description' => 'List chat message interactions.', 'icon' => 'ph:chat'],
            'affinity_list_transcripts' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListTranscripts', 'type' => 'read', 'name' => 'List Transcripts', 'description' => 'List transcripts.', 'icon' => 'ph:file-text'],
            'affinity_get_transcript' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityGetTranscript', 'type' => 'read', 'name' => 'Get Transcript', 'description' => 'Get a transcript by ID.', 'icon' => 'ph:file-text'],
            'affinity_list_transcript_fragments' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityListTranscriptFragments', 'type' => 'read', 'name' => 'List Transcript Fragments', 'description' => 'List fragments for a transcript.', 'icon' => 'ph:quotes'],
            'affinity_semantic_search' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinitySemanticSearch', 'type' => 'read', 'name' => 'Semantic Search', 'description' => 'Perform semantic search.', 'icon' => 'ph:magnifying-glass'],
            'affinity_api_get' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Affinity API path with GET.', 'icon' => 'ph:code'],
            'affinity_api_post' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Affinity API path with POST.', 'icon' => 'ph:code'],
            'affinity_api_put' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityApiPut', 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Affinity API path with PUT.', 'icon' => 'ph:code'],
            'affinity_api_delete' => ['class' => 'OpenCompany\\Integrations\\Affinity\\Tools\\AffinityApiDelete', 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Affinity API path with DELETE.', 'icon' => 'ph:code'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/affinity.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.affinity.co'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a default or account-scoped service.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AffinityService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AffinityService(
                apiKey: $creds->get('affinity', 'api_key', '', $account),
                baseUrl: $creds->get('affinity', 'url', 'https://api.affinity.co', $account),
            );
        }

        return app(AffinityService::class);
    }
}