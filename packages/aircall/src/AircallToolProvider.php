<?php

namespace OpenCompany\Integrations\Aircall;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Aircall tools and integration metadata.
 *
 * Exposes the Public API surface for discovery and resolves account-scoped
 * services for multi-account host applications.
 */
class AircallToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_auth_or_bearer_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_secret', 'manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_id', 'api_token', 'access_token'],
                'notes' => ['Aircall customers use Basic Auth with api_id and api_token. Marketplace OAuth tokens can be used as bearer access_token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'aircall';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Aircall',
            'description' => 'Cloud phone system and call operations',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:aircall',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Aircall',
            'description' => 'Cloud phone system for calls, users, numbers, teams, contacts, tags, webhooks, and conversation intelligence',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:aircall',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.aircall.io/api-references/',
        ];
    }

    /**
     * Define the configuration schema for the Aircall integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_id',
                'type' => 'text',
                'label' => 'API ID',
                'placeholder' => 'Enter your Aircall API ID',
                'hint' => 'Create this in Aircall Company Settings > API Keys.',
                'required' => false,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Aircall API token',
                'hint' => 'Use with API ID for Aircall Basic Auth. Aircall only shows the token when it is created.',
                'required' => false,
            ],
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Aircall OAuth access token',
                'hint' => 'Optional bearer token from Aircall OAuth for Marketplace apps.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.aircall.io',
                'hint' => 'Defaults to https://api.aircall.io. Change only for a compatible proxy.',
                'default' => 'https://api.aircall.io',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to the Aircall API.
     *
     * @param  array<string, mixed>  $config  Configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiId = (string) ($config['api_id'] ?? '');
        $apiToken = (string) ($config['api_token'] ?? $config['api_key'] ?? '');
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = preg_replace('#/v[12]$#', '', rtrim((string) ($config['url'] ?? 'https://api.aircall.io'), '/')) ?: 'https://api.aircall.io';

        if (($apiId === '' || $apiToken === '') && $accessToken === '') {
            return ['success' => false, 'error' => 'Provide either Aircall API ID and API token, or an OAuth access token.'];
        }

        try {
            $http = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
                ->timeout(10);

            $http = $apiId !== '' && $apiToken !== ''
                ? $http->withBasicAuth($apiId, $apiToken)
                : $http->withToken($accessToken);

            $response = $http->get($baseUrl . '/v1/ping');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";
                return ['success' => false, 'error' => 'Aircall API rejected the credentials: ' . (is_string($error) ? $error : json_encode($error))];
            }

            return ['success' => true, 'message' => 'Connected to Aircall.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Aircall configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'api_id' => 'nullable|string',
            'api_token' => 'nullable|string',
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Aircall tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'aircall_ping' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallPing', 'type' => 'read', 'name' => 'Ping', 'description' => 'Test the Aircall API token with the ping endpoint.', 'icon' => 'ph:phone-call'],
            'aircall_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Retrieve the currently authenticated user.', 'icon' => 'ph:phone-call'],
            'aircall_list_users' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List users in the Aircall account.', 'icon' => 'ph:phone-call'],
            'aircall_get_user' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Retrieve a user by ID or email.', 'icon' => 'ph:phone-call'],
            'aircall_create_user' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateUser', 'type' => 'write', 'name' => 'Create User', 'description' => 'Create a user.', 'icon' => 'ph:phone-call'],
            'aircall_update_user' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateUser', 'type' => 'write', 'name' => 'Update User', 'description' => 'Update a user.', 'icon' => 'ph:phone-call'],
            'aircall_delete_user' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteUser', 'type' => 'write', 'name' => 'Delete User', 'description' => 'Delete a user.', 'icon' => 'ph:phone-call'],
            'aircall_list_user_availabilities' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListUserAvailabilities', 'type' => 'read', 'name' => 'List User Availabilities', 'description' => 'List users availability.', 'icon' => 'ph:phone-call'],
            'aircall_get_user_availability' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetUserAvailability', 'type' => 'read', 'name' => 'Get User Availability', 'description' => 'Retrieve one user availability.', 'icon' => 'ph:phone-call'],
            'aircall_start_outbound_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallStartOutboundCall', 'type' => 'write', 'name' => 'Start Outbound Call', 'description' => 'Start an outbound call from a user phone app.', 'icon' => 'ph:phone-call'],
            'aircall_dial_user_phone' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDialUserPhone', 'type' => 'write', 'name' => 'Dial User Phone', 'description' => 'Dial a phone number in a user phone app.', 'icon' => 'ph:phone-call'],
            'aircall_list_users_v2' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListUsersV2', 'type' => 'read', 'name' => 'List Users V2', 'description' => 'List users using the v2 user API.', 'icon' => 'ph:phone-call'],
            'aircall_get_user_v2' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetUserV2', 'type' => 'read', 'name' => 'Get User V2', 'description' => 'Retrieve a user using the v2 user API.', 'icon' => 'ph:phone-call'],
            'aircall_create_user_v2' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateUserV2', 'type' => 'write', 'name' => 'Create User V2', 'description' => 'Create a user using the v2 user API.', 'icon' => 'ph:phone-call'],
            'aircall_update_user_v2' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateUserV2', 'type' => 'write', 'name' => 'Update User V2', 'description' => 'Update a user using the v2 user API.', 'icon' => 'ph:phone-call'],
            'aircall_list_user_numbers_v2' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListUserNumbersV2', 'type' => 'read', 'name' => 'List User Numbers V2', 'description' => 'List numbers assigned to a v2 user.', 'icon' => 'ph:phone-call'],
            'aircall_list_teams' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListTeams', 'type' => 'read', 'name' => 'List Teams', 'description' => 'List teams.', 'icon' => 'ph:phone-call'],
            'aircall_get_team' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetTeam', 'type' => 'read', 'name' => 'Get Team', 'description' => 'Retrieve a team.', 'icon' => 'ph:phone-call'],
            'aircall_create_team' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateTeam', 'type' => 'write', 'name' => 'Create Team', 'description' => 'Create a team.', 'icon' => 'ph:phone-call'],
            'aircall_delete_team' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteTeam', 'type' => 'write', 'name' => 'Delete Team', 'description' => 'Delete a team.', 'icon' => 'ph:phone-call'],
            'aircall_add_user_to_team' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallAddUserToTeam', 'type' => 'write', 'name' => 'Add User To Team', 'description' => 'Add a user to a team.', 'icon' => 'ph:phone-call'],
            'aircall_remove_user_from_team' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallRemoveUserFromTeam', 'type' => 'write', 'name' => 'Remove User From Team', 'description' => 'Remove a user from a team.', 'icon' => 'ph:phone-call'],
            'aircall_list_calls' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListCalls', 'type' => 'read', 'name' => 'List Calls', 'description' => 'List calls with filters and pagination.', 'icon' => 'ph:phone-call'],
            'aircall_search_calls' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallSearchCalls', 'type' => 'read', 'name' => 'Search Calls', 'description' => 'Search calls by user, number, phone number, tags, and dates.', 'icon' => 'ph:phone-call'],
            'aircall_get_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCall', 'type' => 'read', 'name' => 'Get Call', 'description' => 'Retrieve details of a specific call.', 'icon' => 'ph:phone-call'],
            'aircall_transfer_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallTransferCall', 'type' => 'write', 'name' => 'Transfer Call', 'description' => 'Transfer a call to a user, team, or external phone number.', 'icon' => 'ph:phone-call'],
            'aircall_comment_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCommentCall', 'type' => 'write', 'name' => 'Comment Call', 'description' => 'Add a comment to a call.', 'icon' => 'ph:phone-call'],
            'aircall_tag_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallTagCall', 'type' => 'write', 'name' => 'Tag Call', 'description' => 'Apply tags to a call.', 'icon' => 'ph:phone-call'],
            'aircall_archive_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallArchiveCall', 'type' => 'write', 'name' => 'Archive Call', 'description' => 'Archive a call.', 'icon' => 'ph:phone-call'],
            'aircall_unarchive_call' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUnarchiveCall', 'type' => 'write', 'name' => 'Unarchive Call', 'description' => 'Unarchive a call.', 'icon' => 'ph:phone-call'],
            'aircall_pause_call_recording' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallPauseCallRecording', 'type' => 'write', 'name' => 'Pause Call Recording', 'description' => 'Pause live recording on a call.', 'icon' => 'ph:phone-call'],
            'aircall_resume_call_recording' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallResumeCallRecording', 'type' => 'write', 'name' => 'Resume Call Recording', 'description' => 'Resume live recording on a call.', 'icon' => 'ph:phone-call'],
            'aircall_delete_call_recording' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteCallRecording', 'type' => 'write', 'name' => 'Delete Call Recording', 'description' => 'Delete a call recording.', 'icon' => 'ph:phone-call'],
            'aircall_delete_call_voicemail' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteCallVoicemail', 'type' => 'write', 'name' => 'Delete Call Voicemail', 'description' => 'Delete a call voicemail.', 'icon' => 'ph:phone-call'],
            'aircall_create_insight_card' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateInsightCard', 'type' => 'write', 'name' => 'Create Insight Card', 'description' => 'Create an insight card on a call.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_transcription' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallTranscription', 'type' => 'read', 'name' => 'Get Call Transcription', 'description' => 'Retrieve a call transcription.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_realtime_transcription' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallRealtimeTranscription', 'type' => 'read', 'name' => 'Get Call Realtime Transcription', 'description' => 'Retrieve a realtime call transcription.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_sentiments' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallSentiments', 'type' => 'read', 'name' => 'Get Call Sentiments', 'description' => 'Retrieve call sentiments.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_topics' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallTopics', 'type' => 'read', 'name' => 'Get Call Topics', 'description' => 'Retrieve call topics.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_summary' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallSummary', 'type' => 'read', 'name' => 'Get Call Summary', 'description' => 'Retrieve a call summary.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_custom_summary_result' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallCustomSummaryResult', 'type' => 'read', 'name' => 'Get Call Custom Summary Result', 'description' => 'Retrieve a custom call summary result.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_action_items' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallActionItems', 'type' => 'read', 'name' => 'Get Call Action Items', 'description' => 'Retrieve call action items.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_playbook_result' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallPlaybookResult', 'type' => 'read', 'name' => 'Get Call Playbook Result', 'description' => 'Retrieve call playbook result.', 'icon' => 'ph:phone-call'],
            'aircall_get_call_evaluations' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCallEvaluations', 'type' => 'read', 'name' => 'Get Call Evaluations', 'description' => 'Retrieve call evaluations.', 'icon' => 'ph:phone-call'],
            'aircall_get_dialer_campaign' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetDialerCampaign', 'type' => 'read', 'name' => 'Get Dialer Campaign', 'description' => 'Retrieve a user dialer campaign.', 'icon' => 'ph:phone-call'],
            'aircall_create_dialer_campaign' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateDialerCampaign', 'type' => 'write', 'name' => 'Create Dialer Campaign', 'description' => 'Create a user dialer campaign.', 'icon' => 'ph:phone-call'],
            'aircall_delete_dialer_campaign' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteDialerCampaign', 'type' => 'write', 'name' => 'Delete Dialer Campaign', 'description' => 'Delete a user dialer campaign.', 'icon' => 'ph:phone-call'],
            'aircall_list_dialer_campaign_phone_numbers' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListDialerCampaignPhoneNumbers', 'type' => 'read', 'name' => 'List Dialer Campaign Phone Numbers', 'description' => 'List dialer campaign phone numbers.', 'icon' => 'ph:phone-call'],
            'aircall_add_dialer_campaign_phone_numbers' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallAddDialerCampaignPhoneNumbers', 'type' => 'write', 'name' => 'Add Dialer Campaign Phone Numbers', 'description' => 'Add phone numbers to a dialer campaign.', 'icon' => 'ph:phone-call'],
            'aircall_delete_dialer_campaign_phone_number' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteDialerCampaignPhoneNumber', 'type' => 'write', 'name' => 'Delete Dialer Campaign Phone Number', 'description' => 'Delete a phone number from a dialer campaign.', 'icon' => 'ph:phone-call'],
            'aircall_list_numbers' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListNumbers', 'type' => 'read', 'name' => 'List Numbers', 'description' => 'List Aircall numbers.', 'icon' => 'ph:phone-call'],
            'aircall_get_number' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetNumber', 'type' => 'read', 'name' => 'Get Number', 'description' => 'Retrieve an Aircall number.', 'icon' => 'ph:phone-call'],
            'aircall_update_number' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateNumber', 'type' => 'write', 'name' => 'Update Number', 'description' => 'Update an Aircall number.', 'icon' => 'ph:phone-call'],
            'aircall_update_number_music_and_messages' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateNumberMusicAndMessages', 'type' => 'write', 'name' => 'Update Number Music And Messages', 'description' => 'Update number music and messages.', 'icon' => 'ph:phone-call'],
            'aircall_create_number_configuration' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateNumberConfiguration', 'type' => 'write', 'name' => 'Create Number Configuration', 'description' => 'Create number configuration for public API messaging.', 'icon' => 'ph:phone-call'],
            'aircall_delete_number_configuration' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteNumberConfiguration', 'type' => 'write', 'name' => 'Delete Number Configuration', 'description' => 'Delete number configuration for public API messaging.', 'icon' => 'ph:phone-call'],
            'aircall_list_contacts' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List contacts.', 'icon' => 'ph:phone-call'],
            'aircall_get_contact' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Retrieve a contact.', 'icon' => 'ph:phone-call'],
            'aircall_create_contact' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a contact.', 'icon' => 'ph:phone-call'],
            'aircall_update_contact' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a contact.', 'icon' => 'ph:phone-call'],
            'aircall_delete_contact' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a contact.', 'icon' => 'ph:phone-call'],
            'aircall_update_contact_phone_number' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateContactPhoneNumber', 'type' => 'write', 'name' => 'Update Contact Phone Number', 'description' => 'Update a phone number from a contact.', 'icon' => 'ph:phone-call'],
            'aircall_delete_contact_phone_number' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteContactPhoneNumber', 'type' => 'write', 'name' => 'Delete Contact Phone Number', 'description' => 'Delete a phone number from a contact.', 'icon' => 'ph:phone-call'],
            'aircall_update_contact_email' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateContactEmail', 'type' => 'write', 'name' => 'Update Contact Email', 'description' => 'Update an email from a contact.', 'icon' => 'ph:phone-call'],
            'aircall_delete_contact_email' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteContactEmail', 'type' => 'write', 'name' => 'Delete Contact Email', 'description' => 'Delete an email from a contact.', 'icon' => 'ph:phone-call'],
            'aircall_list_tags' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List tags.', 'icon' => 'ph:phone-call'],
            'aircall_get_tag' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetTag', 'type' => 'read', 'name' => 'Get Tag', 'description' => 'Retrieve a tag.', 'icon' => 'ph:phone-call'],
            'aircall_create_tag' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateTag', 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a tag.', 'icon' => 'ph:phone-call'],
            'aircall_update_tag' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateTag', 'type' => 'write', 'name' => 'Update Tag', 'description' => 'Update a tag.', 'icon' => 'ph:phone-call'],
            'aircall_delete_tag' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteTag', 'type' => 'write', 'name' => 'Delete Tag', 'description' => 'Delete a tag.', 'icon' => 'ph:phone-call'],
            'aircall_list_webhooks' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhooks.', 'icon' => 'ph:phone-call'],
            'aircall_get_webhook' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetWebhook', 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Retrieve a webhook.', 'icon' => 'ph:phone-call'],
            'aircall_create_webhook' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook.', 'icon' => 'ph:phone-call'],
            'aircall_update_webhook' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallUpdateWebhook', 'type' => 'write', 'name' => 'Update Webhook', 'description' => 'Update a webhook.', 'icon' => 'ph:phone-call'],
            'aircall_delete_webhook' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a webhook.', 'icon' => 'ph:phone-call'],
            'aircall_get_company' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetCompany', 'type' => 'read', 'name' => 'Get Company', 'description' => 'Retrieve company information.', 'icon' => 'ph:phone-call'],
            'aircall_get_integration' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallGetIntegration', 'type' => 'read', 'name' => 'Get Integration', 'description' => 'Retrieve integration information.', 'icon' => 'ph:phone-call'],
            'aircall_api_get' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative Aircall API path with GET.', 'icon' => 'ph:phone-call'],
            'aircall_api_post' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative Aircall API path with POST.', 'icon' => 'ph:phone-call'],
            'aircall_api_put' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallApiPut', 'type' => 'write', 'name' => 'Api Put', 'description' => 'Call a safe relative Aircall API path with PUT.', 'icon' => 'ph:phone-call'],
            'aircall_api_delete' => ['class' => 'OpenCompany\\Integrations\\Aircall\\Tools\\AircallApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative Aircall API path with DELETE.', 'icon' => 'ph:phone-call'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/aircall.md';
    }

    /**
     * Get credential field definitions for the Aircall integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_id', 'type' => 'text', 'label' => 'API ID', 'required' => false],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.aircall.io'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account context.
     *
     * @param  string  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the default or account-scoped Aircall service.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AircallService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AircallService(
                accessToken: $creds->get('aircall', 'access_token', '', $account),
                baseUrl: $creds->get('aircall', 'url', 'https://api.aircall.io', $account),
                apiId: $creds->get('aircall', 'api_id', '', $account),
                apiToken: $creds->get('aircall', 'api_token', $creds->get('aircall', 'api_key', '', $account), $account),
            );
        }

        return app(AircallService::class);
    }
}
