<?php

namespace OpenCompany\Integrations\GoogleCalendar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Calendar.
 *
 * Exposes generated coverage for the official Google Calendar v3 Discovery
 * document, including calendars, events, ACLs, settings, and free/busy.
 */
class GoogleCalendarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Calendar API scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-calendar'; }
    public function appMeta(): array { return ['label' => 'Google Calendar', 'description' => 'Calendar events, calendars, ACL rules, settings, free/busy queries, and watch channels', 'icon' => 'ph:calendar', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Calendar', 'description' => 'Generated coverage for the Calendar API v3: events, calendars, ACL rules, settings, colors, free/busy queries, and watch channels.', 'icon' => 'ph:calendar', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/calendar/api/v3/reference']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Calendar API scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://www.googleapis.com/calendar/v3', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://www.googleapis.com/calendar/v3']]; }

    /**
     * Verify Google Calendar credentials with a lightweight colors endpoint call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://www.googleapis.com/calendar/v3'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/colors');
            return $response->successful() ? ['success' => true, 'message' => 'Google Calendar credentials verified.'] : ['success' => false, 'error' => 'Google Calendar API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_calendar_settings_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarSettingsGet',
  'type' => 'read',
  'name' => 'Settings Get',
  'description' => 'Settings Get (GET /users/me/settings/{setting}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_settings_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarSettingsList',
  'type' => 'read',
  'name' => 'Settings List',
  'description' => 'Settings List (GET /users/me/settings).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_settings_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarSettingsWatch',
  'type' => 'write',
  'name' => 'Settings Watch',
  'description' => 'Settings Watch (POST /users/me/settings/watch).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendars_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsInsert',
  'type' => 'write',
  'name' => 'Calendars Insert',
  'description' => 'Calendars Insert (POST /calendars).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendars_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsGet',
  'type' => 'read',
  'name' => 'Calendars Get',
  'description' => 'Calendars Get (GET /calendars/{calendarId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_calendars_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsPatch',
  'type' => 'write',
  'name' => 'Calendars Patch',
  'description' => 'Calendars Patch (PATCH /calendars/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendars_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsUpdate',
  'type' => 'write',
  'name' => 'Calendars Update',
  'description' => 'Calendars Update (PUT /calendars/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendars_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsDelete',
  'type' => 'write',
  'name' => 'Calendars Delete',
  'description' => 'Calendars Delete (DELETE /calendars/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendars_clear' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarsClear',
  'type' => 'write',
  'name' => 'Calendars Clear',
  'description' => 'Calendars Clear (POST /calendars/{calendarId}/clear).',
  'icon' => 'ph:calendar',
),
            'google_calendar_colors_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarColorsGet',
  'type' => 'read',
  'name' => 'Colors Get',
  'description' => 'Colors Get (GET /colors).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_calendar_list_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListGet',
  'type' => 'read',
  'name' => 'Calendar List Get',
  'description' => 'Calendar List Get (GET /users/me/calendarList/{calendarId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_calendar_list_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListWatch',
  'type' => 'write',
  'name' => 'Calendar List Watch',
  'description' => 'Calendar List Watch (POST /users/me/calendarList/watch).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendar_list_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListInsert',
  'type' => 'write',
  'name' => 'Calendar List Insert',
  'description' => 'Calendar List Insert (POST /users/me/calendarList).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendar_list_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListList',
  'type' => 'read',
  'name' => 'Calendar List List',
  'description' => 'Calendar List List (GET /users/me/calendarList).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_calendar_list_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListDelete',
  'type' => 'write',
  'name' => 'Calendar List Delete',
  'description' => 'Calendar List Delete (DELETE /users/me/calendarList/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendar_list_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListUpdate',
  'type' => 'write',
  'name' => 'Calendar List Update',
  'description' => 'Calendar List Update (PUT /users/me/calendarList/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_calendar_list_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarCalendarListPatch',
  'type' => 'write',
  'name' => 'Calendar List Patch',
  'description' => 'Calendar List Patch (PATCH /users/me/calendarList/{calendarId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_channels_stop' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarChannelsStop',
  'type' => 'write',
  'name' => 'Channels Stop',
  'description' => 'Channels Stop (POST /channels/stop).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_move' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsMove',
  'type' => 'write',
  'name' => 'Events Move',
  'description' => 'Events Move (POST /calendars/{calendarId}/events/{eventId}/move).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsWatch',
  'type' => 'write',
  'name' => 'Events Watch',
  'description' => 'Events Watch (POST /calendars/{calendarId}/events/watch).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsDelete',
  'type' => 'write',
  'name' => 'Events Delete',
  'description' => 'Events Delete (DELETE /calendars/{calendarId}/events/{eventId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_import' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsImport',
  'type' => 'write',
  'name' => 'Events Import',
  'description' => 'Events Import (POST /calendars/{calendarId}/events/import).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsInsert',
  'type' => 'write',
  'name' => 'Events Insert',
  'description' => 'Events Insert (POST /calendars/{calendarId}/events).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_quick_add' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsQuickAdd',
  'type' => 'write',
  'name' => 'Events Quick Add',
  'description' => 'Events Quick Add (POST /calendars/{calendarId}/events/quickAdd).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsGet',
  'type' => 'read',
  'name' => 'Events Get',
  'description' => 'Events Get (GET /calendars/{calendarId}/events/{eventId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_events_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsPatch',
  'type' => 'write',
  'name' => 'Events Patch',
  'description' => 'Events Patch (PATCH /calendars/{calendarId}/events/{eventId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_instances' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsInstances',
  'type' => 'read',
  'name' => 'Events Instances',
  'description' => 'Events Instances (GET /calendars/{calendarId}/events/{eventId}/instances).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_events_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsUpdate',
  'type' => 'write',
  'name' => 'Events Update',
  'description' => 'Events Update (PUT /calendars/{calendarId}/events/{eventId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_events_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarEventsList',
  'type' => 'read',
  'name' => 'Events List',
  'description' => 'Events List (GET /calendars/{calendarId}/events).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_acl_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclDelete',
  'type' => 'write',
  'name' => 'Acl Delete',
  'description' => 'Acl Delete (DELETE /calendars/{calendarId}/acl/{ruleId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_acl_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclList',
  'type' => 'read',
  'name' => 'Acl List',
  'description' => 'Acl List (GET /calendars/{calendarId}/acl).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_acl_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclPatch',
  'type' => 'write',
  'name' => 'Acl Patch',
  'description' => 'Acl Patch (PATCH /calendars/{calendarId}/acl/{ruleId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_acl_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclUpdate',
  'type' => 'write',
  'name' => 'Acl Update',
  'description' => 'Acl Update (PUT /calendars/{calendarId}/acl/{ruleId}).',
  'icon' => 'ph:calendar',
),
            'google_calendar_acl_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclGet',
  'type' => 'read',
  'name' => 'Acl Get',
  'description' => 'Acl Get (GET /calendars/{calendarId}/acl/{ruleId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_calendar_acl_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclWatch',
  'type' => 'write',
  'name' => 'Acl Watch',
  'description' => 'Acl Watch (POST /calendars/{calendarId}/acl/watch).',
  'icon' => 'ph:calendar',
),
            'google_calendar_acl_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarAclInsert',
  'type' => 'write',
  'name' => 'Acl Insert',
  'description' => 'Acl Insert (POST /calendars/{calendarId}/acl).',
  'icon' => 'ph:calendar',
),
            'google_calendar_freebusy_query' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleCalendar\\Tools\\GoogleCalendarFreebusyQuery',
  'type' => 'write',
  'name' => 'Freebusy Query',
  'description' => 'Freebusy Query (POST /freeBusy).',
  'icon' => 'ph:calendar',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Calendar tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleCalendarService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleCalendarService(accessToken: $creds->get('google-calendar', 'access_token', '', $account), baseUrl: $creds->get('google-calendar', 'url', 'https://www.googleapis.com/calendar/v3', $account));
        }
        return app(GoogleCalendarService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-calendar.md'; }
}
