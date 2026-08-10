<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Workspace Admin.
 *
 * Exposes generated coverage for the official Admin SDK Directory v1 Discovery
 * document, including users, groups, aliases, members, org units, roles,
 * privileges, domains, devices, tokens, verification codes, and schemas.
 */
class GoogleWorkspaceAdminToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Admin SDK Directory scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-workspace-admin'; }
    public function appMeta(): array { return ['label' => 'Google Workspace Admin', 'description' => 'Users, groups, aliases, org units, domains, roles, privileges, devices, tokens, and schemas', 'icon' => 'ph:users-three', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Workspace Admin', 'description' => 'Generated coverage for the Admin SDK Directory v1 REST API: users, groups, aliases, members, org units, roles, privileges, domains, ChromeOS and mobile devices, tokens, verification codes, schemas, and customer resources.', 'icon' => 'ph:users-three', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/admin-sdk/directory/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Admin SDK Directory scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://admin.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://admin.googleapis.com'], ['key' => 'customer', 'type' => 'text', 'label' => 'Customer ID', 'placeholder' => 'my_customer', 'hint' => 'Optional. Used only by test connection for a lightweight users list check.']]; }

    /**
     * Verify Google Workspace Admin credentials with a lightweight users list call when customer is supplied.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://admin.googleapis.com'), '/');
        $customer = (string) ($config['customer'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        if ($customer === '') return ['success' => true, 'message' => 'Google Workspace Admin token is present. Provide customer=my_customer or a customer ID to run a live users-list credential check.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/admin/directory/v1/users', ['customer' => $customer, 'maxResults' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Workspace Admin API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Workspace Admin at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url', 'customer' => 'nullable|string']; }

    public function tools(): array
    {
        return [
            'google_workspace_admin_groups_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsUpdate',
  'type' => 'write',
  'name' => 'Groups Update',
  'description' => 'Groups Update (PUT /admin/directory/v1/groups/{groupKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsList',
  'type' => 'read',
  'name' => 'Groups List',
  'description' => 'Groups List (GET /admin/directory/v1/groups).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_groups_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsPatch',
  'type' => 'write',
  'name' => 'Groups Patch',
  'description' => 'Groups Patch (PATCH /admin/directory/v1/groups/{groupKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsGet',
  'type' => 'read',
  'name' => 'Groups Get',
  'description' => 'Groups Get (GET /admin/directory/v1/groups/{groupKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_groups_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsInsert',
  'type' => 'write',
  'name' => 'Groups Insert',
  'description' => 'Groups Insert (POST /admin/directory/v1/groups).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsDelete',
  'type' => 'write',
  'name' => 'Groups Delete',
  'description' => 'Groups Delete (DELETE /admin/directory/v1/groups/{groupKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_aliases_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsAliasesInsert',
  'type' => 'write',
  'name' => 'Groups Aliases Insert',
  'description' => 'Groups Aliases Insert (POST /admin/directory/v1/groups/{groupKey}/aliases).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_aliases_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsAliasesDelete',
  'type' => 'write',
  'name' => 'Groups Aliases Delete',
  'description' => 'Groups Aliases Delete (DELETE /admin/directory/v1/groups/{groupKey}/aliases/{alias}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_groups_aliases_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminGroupsAliasesList',
  'type' => 'read',
  'name' => 'Groups Aliases List',
  'description' => 'Groups Aliases List (GET /admin/directory/v1/groups/{groupKey}/aliases).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_features_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesGet',
  'type' => 'read',
  'name' => 'Resources Features Get',
  'description' => 'Resources Features Get (GET /admin/directory/v1/customer/{customer}/resources/features/{featureKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_features_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesInsert',
  'type' => 'write',
  'name' => 'Resources Features Insert',
  'description' => 'Resources Features Insert (POST /admin/directory/v1/customer/{customer}/resources/features).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_features_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesDelete',
  'type' => 'write',
  'name' => 'Resources Features Delete',
  'description' => 'Resources Features Delete (DELETE /admin/directory/v1/customer/{customer}/resources/features/{featureKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_features_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesUpdate',
  'type' => 'write',
  'name' => 'Resources Features Update',
  'description' => 'Resources Features Update (PUT /admin/directory/v1/customer/{customer}/resources/features/{featureKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_features_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesList',
  'type' => 'read',
  'name' => 'Resources Features List',
  'description' => 'Resources Features List (GET /admin/directory/v1/customer/{customer}/resources/features).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_features_rename' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesRename',
  'type' => 'write',
  'name' => 'Resources Features Rename',
  'description' => 'Resources Features Rename (POST /admin/directory/v1/customer/{customer}/resources/features/{oldName}/rename).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_features_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesFeaturesPatch',
  'type' => 'write',
  'name' => 'Resources Features Patch',
  'description' => 'Resources Features Patch (PATCH /admin/directory/v1/customer/{customer}/resources/features/{featureKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_buildings_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsInsert',
  'type' => 'write',
  'name' => 'Resources Buildings Insert',
  'description' => 'Resources Buildings Insert (POST /admin/directory/v1/customer/{customer}/resources/buildings).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_buildings_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsDelete',
  'type' => 'write',
  'name' => 'Resources Buildings Delete',
  'description' => 'Resources Buildings Delete (DELETE /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_buildings_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsGet',
  'type' => 'read',
  'name' => 'Resources Buildings Get',
  'description' => 'Resources Buildings Get (GET /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_buildings_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsPatch',
  'type' => 'write',
  'name' => 'Resources Buildings Patch',
  'description' => 'Resources Buildings Patch (PATCH /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_buildings_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsUpdate',
  'type' => 'write',
  'name' => 'Resources Buildings Update',
  'description' => 'Resources Buildings Update (PUT /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_buildings_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesBuildingsList',
  'type' => 'read',
  'name' => 'Resources Buildings List',
  'description' => 'Resources Buildings List (GET /admin/directory/v1/customer/{customer}/resources/buildings).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_calendars_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsPatch',
  'type' => 'write',
  'name' => 'Resources Calendars Patch',
  'description' => 'Resources Calendars Patch (PATCH /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_calendars_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsUpdate',
  'type' => 'write',
  'name' => 'Resources Calendars Update',
  'description' => 'Resources Calendars Update (PUT /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_calendars_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsList',
  'type' => 'read',
  'name' => 'Resources Calendars List',
  'description' => 'Resources Calendars List (GET /admin/directory/v1/customer/{customer}/resources/calendars).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_resources_calendars_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsInsert',
  'type' => 'write',
  'name' => 'Resources Calendars Insert',
  'description' => 'Resources Calendars Insert (POST /admin/directory/v1/customer/{customer}/resources/calendars).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_calendars_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsDelete',
  'type' => 'write',
  'name' => 'Resources Calendars Delete',
  'description' => 'Resources Calendars Delete (DELETE /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_resources_calendars_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminResourcesCalendarsGet',
  'type' => 'read',
  'name' => 'Resources Calendars Get',
  'description' => 'Resources Calendars Get (GET /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_domains_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainsDelete',
  'type' => 'write',
  'name' => 'Domains Delete',
  'description' => 'Domains Delete (DELETE /admin/directory/v1/customer/{customer}/domains/{domainName}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_domains_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainsInsert',
  'type' => 'write',
  'name' => 'Domains Insert',
  'description' => 'Domains Insert (POST /admin/directory/v1/customer/{customer}/domains).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_domains_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainsList',
  'type' => 'read',
  'name' => 'Domains List',
  'description' => 'Domains List (GET /admin/directory/v1/customer/{customer}/domains).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_domains_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainsGet',
  'type' => 'read',
  'name' => 'Domains Get',
  'description' => 'Domains Get (GET /admin/directory/v1/customer/{customer}/domains/{domainName}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_mobiledevices_action' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMobiledevicesAction',
  'type' => 'write',
  'name' => 'Mobiledevices Action',
  'description' => 'Mobiledevices Action (POST /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}/action).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_mobiledevices_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMobiledevicesDelete',
  'type' => 'write',
  'name' => 'Mobiledevices Delete',
  'description' => 'Mobiledevices Delete (DELETE /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_mobiledevices_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMobiledevicesGet',
  'type' => 'read',
  'name' => 'Mobiledevices Get',
  'description' => 'Mobiledevices Get (GET /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_mobiledevices_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMobiledevicesList',
  'type' => 'read',
  'name' => 'Mobiledevices List',
  'description' => 'Mobiledevices List (GET /admin/directory/v1/customer/{customerId}/devices/mobile).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customer_devices_chromeos_batch_change_status' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomerDevicesChromeosBatchChangeStatus',
  'type' => 'write',
  'name' => 'Customer Devices Chromeos Batch Change Status',
  'description' => 'Customer Devices Chromeos Batch Change Status (POST /admin/directory/v1/customer/{customerId}/devices/chromeos:batchChangeStatus).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customer_devices_chromeos_count_chrome_os_devices' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomerDevicesChromeosCountChromeOsDevices',
  'type' => 'read',
  'name' => 'Customer Devices Chromeos Count Chrome Os Devices',
  'description' => 'Customer Devices Chromeos Count Chrome Os Devices (GET /admin/directory/v1/customer/{customerId}/devices/chromeos:countChromeOsDevices).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customer_devices_chromeos_issue_command' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomerDevicesChromeosIssueCommand',
  'type' => 'write',
  'name' => 'Customer Devices Chromeos Issue Command',
  'description' => 'Customer Devices Chromeos Issue Command (POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}:issueCommand).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customer_devices_chromeos_commands_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomerDevicesChromeosCommandsGet',
  'type' => 'read',
  'name' => 'Customer Devices Chromeos Commands Get',
  'description' => 'Customer Devices Chromeos Commands Get (GET /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}/commands/{commandId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_orgunits_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsPatch',
  'type' => 'write',
  'name' => 'Orgunits Patch',
  'description' => 'Orgunits Patch (PATCH /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_orgunits_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsUpdate',
  'type' => 'write',
  'name' => 'Orgunits Update',
  'description' => 'Orgunits Update (PUT /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_orgunits_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsList',
  'type' => 'read',
  'name' => 'Orgunits List',
  'description' => 'Orgunits List (GET /admin/directory/v1/customer/{customerId}/orgunits).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_orgunits_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsInsert',
  'type' => 'write',
  'name' => 'Orgunits Insert',
  'description' => 'Orgunits Insert (POST /admin/directory/v1/customer/{customerId}/orgunits).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_orgunits_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsDelete',
  'type' => 'write',
  'name' => 'Orgunits Delete',
  'description' => 'Orgunits Delete (DELETE /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_orgunits_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminOrgunitsGet',
  'type' => 'read',
  'name' => 'Orgunits Get',
  'description' => 'Orgunits Get (GET /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_privileges_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminPrivilegesList',
  'type' => 'read',
  'name' => 'Privileges List',
  'description' => 'Privileges List (GET /admin/directory/v1/customer/{customer}/roles/ALL/privileges).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_members_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersUpdate',
  'type' => 'write',
  'name' => 'Members Update',
  'description' => 'Members Update (PUT /admin/directory/v1/groups/{groupKey}/members/{memberKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_members_has_member' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersHasMember',
  'type' => 'read',
  'name' => 'Members Has Member',
  'description' => 'Members Has Member (GET /admin/directory/v1/groups/{groupKey}/hasMember/{memberKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_members_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersList',
  'type' => 'read',
  'name' => 'Members List',
  'description' => 'Members List (GET /admin/directory/v1/groups/{groupKey}/members).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_members_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersPatch',
  'type' => 'write',
  'name' => 'Members Patch',
  'description' => 'Members Patch (PATCH /admin/directory/v1/groups/{groupKey}/members/{memberKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_members_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersGet',
  'type' => 'read',
  'name' => 'Members Get',
  'description' => 'Members Get (GET /admin/directory/v1/groups/{groupKey}/members/{memberKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_members_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersInsert',
  'type' => 'write',
  'name' => 'Members Insert',
  'description' => 'Members Insert (POST /admin/directory/v1/groups/{groupKey}/members).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_members_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminMembersDelete',
  'type' => 'write',
  'name' => 'Members Delete',
  'description' => 'Members Delete (DELETE /admin/directory/v1/groups/{groupKey}/members/{memberKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_verification_codes_invalidate' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminVerificationCodesInvalidate',
  'type' => 'write',
  'name' => 'Verification Codes Invalidate',
  'description' => 'Verification Codes Invalidate (POST /admin/directory/v1/users/{userKey}/verificationCodes/invalidate).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_verification_codes_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminVerificationCodesList',
  'type' => 'read',
  'name' => 'Verification Codes List',
  'description' => 'Verification Codes List (GET /admin/directory/v1/users/{userKey}/verificationCodes).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_verification_codes_generate' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminVerificationCodesGenerate',
  'type' => 'write',
  'name' => 'Verification Codes Generate',
  'description' => 'Verification Codes Generate (POST /admin/directory/v1/users/{userKey}/verificationCodes/generate).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_two_step_verification_turn_off' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminTwoStepVerificationTurnOff',
  'type' => 'write',
  'name' => 'Two Step Verification Turn Off',
  'description' => 'Two Step Verification Turn Off (POST /admin/directory/v1/users/{userKey}/twoStepVerification/turnOff).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersPatch',
  'type' => 'write',
  'name' => 'Customers Patch',
  'description' => 'Customers Patch (PATCH /admin/directory/v1/customers/{customerKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersGet',
  'type' => 'read',
  'name' => 'Customers Get',
  'description' => 'Customers Get (GET /admin/directory/v1/customers/{customerKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersUpdate',
  'type' => 'write',
  'name' => 'Customers Update',
  'description' => 'Customers Update (PUT /admin/directory/v1/customers/{customerKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_printers_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersGet',
  'type' => 'read',
  'name' => 'Customers Chrome Printers Get',
  'description' => 'Customers Chrome Printers Get (GET /admin/directory/v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_chrome_printers_batch_create_printers' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersBatchCreatePrinters',
  'type' => 'write',
  'name' => 'Customers Chrome Printers Batch Create Printers',
  'description' => 'Customers Chrome Printers Batch Create Printers (POST /admin/directory/v1/{+parent}/chrome/printers:batchCreatePrinters).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_printers_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersDelete',
  'type' => 'write',
  'name' => 'Customers Chrome Printers Delete',
  'description' => 'Customers Chrome Printers Delete (DELETE /admin/directory/v1/{+name}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_printers_batch_delete_printers' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersBatchDeletePrinters',
  'type' => 'write',
  'name' => 'Customers Chrome Printers Batch Delete Printers',
  'description' => 'Customers Chrome Printers Batch Delete Printers (POST /admin/directory/v1/{+parent}/chrome/printers:batchDeletePrinters).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_printers_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersList',
  'type' => 'read',
  'name' => 'Customers Chrome Printers List',
  'description' => 'Customers Chrome Printers List (GET /admin/directory/v1/{+parent}/chrome/printers).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_chrome_printers_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersCreate',
  'type' => 'write',
  'name' => 'Customers Chrome Printers Create',
  'description' => 'Customers Chrome Printers Create (POST /admin/directory/v1/{+parent}/chrome/printers).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_printers_list_printer_models' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersListPrinterModels',
  'type' => 'read',
  'name' => 'Customers Chrome Printers List Printer Models',
  'description' => 'Customers Chrome Printers List Printer Models (GET /admin/directory/v1/{+parent}/chrome/printers:listPrinterModels).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_chrome_printers_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintersPatch',
  'type' => 'write',
  'name' => 'Customers Chrome Printers Patch',
  'description' => 'Customers Chrome Printers Patch (PATCH /admin/directory/v1/{+name}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_print_servers_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersList',
  'type' => 'read',
  'name' => 'Customers Chrome Print Servers List',
  'description' => 'Customers Chrome Print Servers List (GET /admin/directory/v1/{+parent}/chrome/printServers).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_chrome_print_servers_batch_create_print_servers' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersBatchCreatePrintServers',
  'type' => 'write',
  'name' => 'Customers Chrome Print Servers Batch Create Print Servers',
  'description' => 'Customers Chrome Print Servers Batch Create Print Servers (POST /admin/directory/v1/{+parent}/chrome/printServers:batchCreatePrintServers).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_print_servers_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersPatch',
  'type' => 'write',
  'name' => 'Customers Chrome Print Servers Patch',
  'description' => 'Customers Chrome Print Servers Patch (PATCH /admin/directory/v1/{+name}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_print_servers_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersCreate',
  'type' => 'write',
  'name' => 'Customers Chrome Print Servers Create',
  'description' => 'Customers Chrome Print Servers Create (POST /admin/directory/v1/{+parent}/chrome/printServers).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_print_servers_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersGet',
  'type' => 'read',
  'name' => 'Customers Chrome Print Servers Get',
  'description' => 'Customers Chrome Print Servers Get (GET /admin/directory/v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_customers_chrome_print_servers_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersDelete',
  'type' => 'write',
  'name' => 'Customers Chrome Print Servers Delete',
  'description' => 'Customers Chrome Print Servers Delete (DELETE /admin/directory/v1/{+name}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_customers_chrome_print_servers_batch_delete_print_servers' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminCustomersChromePrintServersBatchDeletePrintServers',
  'type' => 'write',
  'name' => 'Customers Chrome Print Servers Batch Delete Print Servers',
  'description' => 'Customers Chrome Print Servers Batch Delete Print Servers (POST /admin/directory/v1/{+parent}/chrome/printServers:batchDeletePrintServers).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_undelete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersUndelete',
  'type' => 'write',
  'name' => 'Users Undelete',
  'description' => 'Users Undelete (POST /admin/directory/v1/users/{userKey}/undelete).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersUpdate',
  'type' => 'write',
  'name' => 'Users Update',
  'description' => 'Users Update (PUT /admin/directory/v1/users/{userKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_sign_out' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersSignOut',
  'type' => 'write',
  'name' => 'Users Sign Out',
  'description' => 'Users Sign Out (POST /admin/directory/v1/users/{userKey}/signOut).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_create_guest' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersCreateGuest',
  'type' => 'write',
  'name' => 'Users Create Guest',
  'description' => 'Users Create Guest (POST /admin/directory/v1/users:createGuest).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersPatch',
  'type' => 'write',
  'name' => 'Users Patch',
  'description' => 'Users Patch (PATCH /admin/directory/v1/users/{userKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersWatch',
  'type' => 'write',
  'name' => 'Users Watch',
  'description' => 'Users Watch (POST /admin/directory/v1/users/watch).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersGet',
  'type' => 'read',
  'name' => 'Users Get',
  'description' => 'Users Get (GET /admin/directory/v1/users/{userKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_users_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersDelete',
  'type' => 'write',
  'name' => 'Users Delete',
  'description' => 'Users Delete (DELETE /admin/directory/v1/users/{userKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersInsert',
  'type' => 'write',
  'name' => 'Users Insert',
  'description' => 'Users Insert (POST /admin/directory/v1/users).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersList',
  'type' => 'read',
  'name' => 'Users List',
  'description' => 'Users List (GET /admin/directory/v1/users).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_users_make_admin' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersMakeAdmin',
  'type' => 'write',
  'name' => 'Users Make Admin',
  'description' => 'Users Make Admin (POST /admin/directory/v1/users/{userKey}/makeAdmin).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_aliases_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersAliasesList',
  'type' => 'read',
  'name' => 'Users Aliases List',
  'description' => 'Users Aliases List (GET /admin/directory/v1/users/{userKey}/aliases).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_users_aliases_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersAliasesWatch',
  'type' => 'write',
  'name' => 'Users Aliases Watch',
  'description' => 'Users Aliases Watch (POST /admin/directory/v1/users/{userKey}/aliases/watch).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_aliases_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersAliasesInsert',
  'type' => 'write',
  'name' => 'Users Aliases Insert',
  'description' => 'Users Aliases Insert (POST /admin/directory/v1/users/{userKey}/aliases).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_aliases_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersAliasesDelete',
  'type' => 'write',
  'name' => 'Users Aliases Delete',
  'description' => 'Users Aliases Delete (DELETE /admin/directory/v1/users/{userKey}/aliases/{alias}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_photos_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersPhotosDelete',
  'type' => 'write',
  'name' => 'Users Photos Delete',
  'description' => 'Users Photos Delete (DELETE /admin/directory/v1/users/{userKey}/photos/thumbnail).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_photos_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersPhotosPatch',
  'type' => 'write',
  'name' => 'Users Photos Patch',
  'description' => 'Users Photos Patch (PATCH /admin/directory/v1/users/{userKey}/photos/thumbnail).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_users_photos_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersPhotosGet',
  'type' => 'read',
  'name' => 'Users Photos Get',
  'description' => 'Users Photos Get (GET /admin/directory/v1/users/{userKey}/photos/thumbnail).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_users_photos_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminUsersPhotosUpdate',
  'type' => 'write',
  'name' => 'Users Photos Update',
  'description' => 'Users Photos Update (PUT /admin/directory/v1/users/{userKey}/photos/thumbnail).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_domain_aliases_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainAliasesList',
  'type' => 'read',
  'name' => 'Domain Aliases List',
  'description' => 'Domain Aliases List (GET /admin/directory/v1/customer/{customer}/domainaliases).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_domain_aliases_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainAliasesGet',
  'type' => 'read',
  'name' => 'Domain Aliases Get',
  'description' => 'Domain Aliases Get (GET /admin/directory/v1/customer/{customer}/domainaliases/{domainAliasName}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_domain_aliases_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainAliasesDelete',
  'type' => 'write',
  'name' => 'Domain Aliases Delete',
  'description' => 'Domain Aliases Delete (DELETE /admin/directory/v1/customer/{customer}/domainaliases/{domainAliasName}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_domain_aliases_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminDomainAliasesInsert',
  'type' => 'write',
  'name' => 'Domain Aliases Insert',
  'description' => 'Domain Aliases Insert (POST /admin/directory/v1/customer/{customer}/domainaliases).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_role_assignments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRoleAssignmentsDelete',
  'type' => 'write',
  'name' => 'Role Assignments Delete',
  'description' => 'Role Assignments Delete (DELETE /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_role_assignments_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRoleAssignmentsInsert',
  'type' => 'write',
  'name' => 'Role Assignments Insert',
  'description' => 'Role Assignments Insert (POST /admin/directory/v1/customer/{customer}/roleassignments).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_role_assignments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRoleAssignmentsList',
  'type' => 'read',
  'name' => 'Role Assignments List',
  'description' => 'Role Assignments List (GET /admin/directory/v1/customer/{customer}/roleassignments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_role_assignments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRoleAssignmentsGet',
  'type' => 'read',
  'name' => 'Role Assignments Get',
  'description' => 'Role Assignments Get (GET /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_schemas_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasGet',
  'type' => 'read',
  'name' => 'Schemas Get',
  'description' => 'Schemas Get (GET /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_schemas_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasDelete',
  'type' => 'write',
  'name' => 'Schemas Delete',
  'description' => 'Schemas Delete (DELETE /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_schemas_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasInsert',
  'type' => 'write',
  'name' => 'Schemas Insert',
  'description' => 'Schemas Insert (POST /admin/directory/v1/customer/{customerId}/schemas).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_schemas_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasList',
  'type' => 'read',
  'name' => 'Schemas List',
  'description' => 'Schemas List (GET /admin/directory/v1/customer/{customerId}/schemas).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_schemas_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasUpdate',
  'type' => 'write',
  'name' => 'Schemas Update',
  'description' => 'Schemas Update (PUT /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_schemas_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminSchemasPatch',
  'type' => 'write',
  'name' => 'Schemas Patch',
  'description' => 'Schemas Patch (PATCH /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_chromeosdevices_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesUpdate',
  'type' => 'write',
  'name' => 'Chromeosdevices Update',
  'description' => 'Chromeosdevices Update (PUT /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_chromeosdevices_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesList',
  'type' => 'read',
  'name' => 'Chromeosdevices List',
  'description' => 'Chromeosdevices List (GET /admin/directory/v1/customer/{customerId}/devices/chromeos).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_chromeosdevices_move_devices_to_ou' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesMoveDevicesToOu',
  'type' => 'write',
  'name' => 'Chromeosdevices Move Devices To Ou',
  'description' => 'Chromeosdevices Move Devices To Ou (POST /admin/directory/v1/customer/{customerId}/devices/chromeos/moveDevicesToOu).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_chromeosdevices_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesPatch',
  'type' => 'write',
  'name' => 'Chromeosdevices Patch',
  'description' => 'Chromeosdevices Patch (PATCH /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_chromeosdevices_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesGet',
  'type' => 'read',
  'name' => 'Chromeosdevices Get',
  'description' => 'Chromeosdevices Get (GET /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_chromeosdevices_action' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChromeosdevicesAction',
  'type' => 'write',
  'name' => 'Chromeosdevices Action',
  'description' => 'Chromeosdevices Action (POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{resourceId}/action).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_channels_stop' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminChannelsStop',
  'type' => 'write',
  'name' => 'Channels Stop',
  'description' => 'Channels Stop (POST /admin/directory_v1/channels/stop).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_asps_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminAspsList',
  'type' => 'read',
  'name' => 'Asps List',
  'description' => 'Asps List (GET /admin/directory/v1/users/{userKey}/asps).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_asps_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminAspsGet',
  'type' => 'read',
  'name' => 'Asps Get',
  'description' => 'Asps Get (GET /admin/directory/v1/users/{userKey}/asps/{codeId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_asps_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminAspsDelete',
  'type' => 'write',
  'name' => 'Asps Delete',
  'description' => 'Asps Delete (DELETE /admin/directory/v1/users/{userKey}/asps/{codeId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_tokens_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminTokensDelete',
  'type' => 'write',
  'name' => 'Tokens Delete',
  'description' => 'Tokens Delete (DELETE /admin/directory/v1/users/{userKey}/tokens/{clientId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_tokens_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminTokensList',
  'type' => 'read',
  'name' => 'Tokens List',
  'description' => 'Tokens List (GET /admin/directory/v1/users/{userKey}/tokens).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_tokens_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminTokensGet',
  'type' => 'read',
  'name' => 'Tokens Get',
  'description' => 'Tokens Get (GET /admin/directory/v1/users/{userKey}/tokens/{clientId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_roles_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesInsert',
  'type' => 'write',
  'name' => 'Roles Insert',
  'description' => 'Roles Insert (POST /admin/directory/v1/customer/{customer}/roles).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_roles_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesDelete',
  'type' => 'write',
  'name' => 'Roles Delete',
  'description' => 'Roles Delete (DELETE /admin/directory/v1/customer/{customer}/roles/{roleId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_roles_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesGet',
  'type' => 'read',
  'name' => 'Roles Get',
  'description' => 'Roles Get (GET /admin/directory/v1/customer/{customer}/roles/{roleId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_workspace_admin_roles_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesPatch',
  'type' => 'write',
  'name' => 'Roles Patch',
  'description' => 'Roles Patch (PATCH /admin/directory/v1/customer/{customer}/roles/{roleId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_roles_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesUpdate',
  'type' => 'write',
  'name' => 'Roles Update',
  'description' => 'Roles Update (PUT /admin/directory/v1/customer/{customer}/roles/{roleId}).',
  'icon' => 'ph:users-three',
),
            'google_workspace_admin_roles_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleWorkspaceAdmin\\Tools\\GoogleWorkspaceAdminRolesList',
  'type' => 'read',
  'name' => 'Roles List',
  'description' => 'Roles List (GET /admin/directory/v1/customer/{customer}/roles).',
  'icon' => 'ph:magnifying-glass',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Workspace Admin tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleWorkspaceAdminService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleWorkspaceAdminService(accessToken: $creds->get('google-workspace-admin', 'access_token', '', $account), baseUrl: $creds->get('google-workspace-admin', 'url', 'https://admin.googleapis.com', $account));
        }
        return app(GoogleWorkspaceAdminService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-workspace-admin.md'; }
}