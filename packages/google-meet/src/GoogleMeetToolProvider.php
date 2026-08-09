<?php

namespace OpenCompany\Integrations\GoogleMeet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Meet.
 *
 * Exposes generated coverage for the official Meet v2 Discovery document,
 * including meeting spaces, conference records, participants, sessions,
 * recordings, transcripts, transcript entries, and smart notes.
 */
class GoogleMeetToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Meet API scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-meet'; }
    public function appMeta(): array { return ['label' => 'Google Meet', 'description' => 'Meeting spaces, conference records, participants, recordings, transcripts, and smart notes', 'icon' => 'ph:video-camera', 'logo' => 'logos:google-meet']; }
    public function integrationMeta(): array { return ['name' => 'Google Meet', 'description' => 'Generated coverage for the Google Meet v2 REST API: spaces, conference records, participants, participant sessions, recordings, transcripts, transcript entries, and smart notes.', 'icon' => 'ph:video-camera', 'logo' => 'logos:google-meet', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/meet/api/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Google Meet API scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://meet.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://meet.googleapis.com']]; }

    /**
     * Verify Google Meet credentials with a lightweight conference records list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://meet.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v2/conferenceRecords', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Google Meet API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Meet at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_meet_spaces_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetSpacesCreate',
  'type' => 'write',
  'name' => 'Spaces Create',
  'description' => 'Spaces Create (POST /v2/spaces).',
  'icon' => 'ph:video-camera',
),
            'google_meet_spaces_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetSpacesGet',
  'type' => 'read',
  'name' => 'Spaces Get',
  'description' => 'Spaces Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_spaces_end_active_conference' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetSpacesEndActiveConference',
  'type' => 'write',
  'name' => 'Spaces End Active Conference',
  'description' => 'Spaces End Active Conference (POST /v2/{+name}:endActiveConference).',
  'icon' => 'ph:video-camera',
),
            'google_meet_spaces_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetSpacesPatch',
  'type' => 'write',
  'name' => 'Spaces Patch',
  'description' => 'Spaces Patch (PATCH /v2/{+name}).',
  'icon' => 'ph:video-camera',
),
            'google_meet_conference_records_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsList',
  'type' => 'read',
  'name' => 'Conference Records List',
  'description' => 'Conference Records List (GET /v2/conferenceRecords).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsGet',
  'type' => 'read',
  'name' => 'Conference Records Get',
  'description' => 'Conference Records Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_recordings_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsRecordingsList',
  'type' => 'read',
  'name' => 'Conference Records Recordings List',
  'description' => 'Conference Records Recordings List (GET /v2/{+parent}/recordings).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_recordings_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsRecordingsGet',
  'type' => 'read',
  'name' => 'Conference Records Recordings Get',
  'description' => 'Conference Records Recordings Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_participants_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsParticipantsGet',
  'type' => 'read',
  'name' => 'Conference Records Participants Get',
  'description' => 'Conference Records Participants Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_participants_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsParticipantsList',
  'type' => 'read',
  'name' => 'Conference Records Participants List',
  'description' => 'Conference Records Participants List (GET /v2/{+parent}/participants).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_participants_participant_sessions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsParticipantsParticipantSessionsList',
  'type' => 'read',
  'name' => 'Conference Records Participants Participant Sessions List',
  'description' => 'Conference Records Participants Participant Sessions List (GET /v2/{+parent}/participantSessions).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_participants_participant_sessions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsParticipantsParticipantSessionsGet',
  'type' => 'read',
  'name' => 'Conference Records Participants Participant Sessions Get',
  'description' => 'Conference Records Participants Participant Sessions Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_transcripts_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsTranscriptsList',
  'type' => 'read',
  'name' => 'Conference Records Transcripts List',
  'description' => 'Conference Records Transcripts List (GET /v2/{+parent}/transcripts).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_transcripts_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsTranscriptsGet',
  'type' => 'read',
  'name' => 'Conference Records Transcripts Get',
  'description' => 'Conference Records Transcripts Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_transcripts_entries_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsTranscriptsEntriesGet',
  'type' => 'read',
  'name' => 'Conference Records Transcripts Entries Get',
  'description' => 'Conference Records Transcripts Entries Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_transcripts_entries_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsTranscriptsEntriesList',
  'type' => 'read',
  'name' => 'Conference Records Transcripts Entries List',
  'description' => 'Conference Records Transcripts Entries List (GET /v2/{+parent}/entries).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_smart_notes_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsSmartNotesGet',
  'type' => 'read',
  'name' => 'Conference Records Smart Notes Get',
  'description' => 'Conference Records Smart Notes Get (GET /v2/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_meet_conference_records_smart_notes_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleMeet\\Tools\\GoogleMeetConferenceRecordsSmartNotesList',
  'type' => 'read',
  'name' => 'Conference Records Smart Notes List',
  'description' => 'Conference Records Smart Notes List (GET /v2/{+parent}/smartNotes).',
  'icon' => 'ph:magnifying-glass',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Meet tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleMeetService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleMeetService(accessToken: $creds->get('google-meet', 'access_token', '', $account), baseUrl: $creds->get('google-meet', 'url', 'https://meet.googleapis.com', $account));
        }
        return app(GoogleMeetService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-meet.md'; }
}