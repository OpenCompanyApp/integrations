<?php

namespace OpenCompany\Integrations\Bitwarden;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Bitwarden.
 *
 * Exposes the official Bitwarden Public API operation set for organization
 * collections, events, groups, members, subscriptions, imports, and policies.
 */
class BitwardenToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'oauth_client_credentials',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'client_credentials',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => true,
                'token_keys' => ['access_token'],
                'notes' => ['Use an organization API key. Personal Bitwarden API keys do not work with the Public API.'],
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
        return 'bitwarden';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Bitwarden',
            'description' => 'Organization password manager administration',
            'icon' => 'ph:vault',
            'logo' => 'simple-icons:bitwarden',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bitwarden',
            'description' => 'Manage Bitwarden organization members, groups, collections, event logs, subscription data, imports, and policies through the Public API.',
            'icon' => 'ph:vault',
            'logo' => 'simple-icons:bitwarden',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://bitwarden.com/help/public-api/',
            'source_url' => 'https://bitwarden.com/help/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'placeholder' => 'organization.ClientId', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Optional pre-issued bearer token', 'required' => false],
            ['key' => 'api_url', 'type' => 'url', 'label' => 'API URL', 'default' => 'https://api.bitwarden.com', 'required' => false],
            ['key' => 'identity_url', 'type' => 'url', 'label' => 'Identity Token URL', 'default' => 'https://identity.bitwarden.com/connect/token', 'required' => false],
        ];
    }

    /**
     * Verify that supplied Bitwarden credentials can access the Public API.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $clientId = (string) ($config['client_id'] ?? '');
        $clientSecret = (string) ($config['client_secret'] ?? '');
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['api_url'] ?? 'https://api.bitwarden.com'), '/');
        $identityUrl = rtrim((string) ($config['identity_url'] ?? 'https://identity.bitwarden.com/connect/token'), '/');

        if ($accessToken === '' && ($clientId === '' || $clientSecret === '')) {
            return ['success' => false, 'error' => 'Provide either an access token or both Bitwarden client id and client secret.'];
        }

        try {
            $service = new BitwardenService(
                clientId: $clientId,
                clientSecret: $clientSecret,
                accessToken: $accessToken,
                baseUrl: $baseUrl,
                identityUrl: $identityUrl,
            );
            $service->request('GET', '/public/organization/subscription');

            return ['success' => true, 'message' => 'Connected to Bitwarden Public API at '.$baseUrl.'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
            'access_token' => 'nullable|string',
            'api_url' => 'nullable|url',
            'identity_url' => 'nullable|url',
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'client_id', 'type' => 'string', 'label' => 'Client ID', 'required' => false],
            ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'required' => false],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => false],
            ['key' => 'api_url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.bitwarden.com'],
            ['key' => 'identity_url', 'type' => 'url', 'label' => 'Identity Token URL', 'required' => false, 'default' => 'https://identity.bitwarden.com/connect/token'],
        ];
    }

    public function tools(): array
    {
        return array (
  'bitwarden_collections_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenCollectionsGet',
    'type' => 'read',
    'name' => 'Retrieve a collection.',
    'description' => 'Retrieves the details of an existing collection. You need only supply the unique collection identifier that was returned upon collection creation.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_collections_put' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenCollectionsPut',
    'type' => 'write',
    'name' => 'Update a collection.',
    'description' => 'Updates the specified collection object. If a property is not provided, the value of the existing property will be reset.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_collections_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenCollectionsDelete',
    'type' => 'write',
    'name' => 'Delete a collection.',
    'description' => 'Permanently deletes a collection. This cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_collections_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenCollectionsList',
    'type' => 'read',
    'name' => 'List all collections.',
    'description' => 'Returns a list of your organization\'s collections. Collection objects listed in this call do not include information about their associated groups.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_events_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenEventsList',
    'type' => 'read',
    'name' => 'List all events.',
    'description' => 'Returns a filtered list of your organization\'s event logs, paged by a continuation token. If no filters are provided, it will return the last 30 days of event for the organization.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_groups_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsGet',
    'type' => 'read',
    'name' => 'Retrieve a group.',
    'description' => 'Retrieves the details of an existing group. You need only supply the unique group identifier that was returned upon group creation.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_groups_put' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsPut',
    'type' => 'write',
    'name' => 'Update a group.',
    'description' => 'Updates the specified group object. If a property is not provided, the value of the existing property will be reset.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_groups_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsDelete',
    'type' => 'write',
    'name' => 'Delete a group.',
    'description' => 'Permanently deletes a group. This cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_groups_get_member_ids' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsGetMemberIds',
    'type' => 'read',
    'name' => 'Retrieve a groups\'s member ids',
    'description' => 'Retrieves the unique identifiers for all members that are associated with this group. You need only supply the unique group identifier that was returned upon group creation.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_groups_put_member_ids' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsPutMemberIds',
    'type' => 'write',
    'name' => 'Update a group\'s members.',
    'description' => 'Updates the specified group\'s member associations.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_groups_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsList',
    'type' => 'read',
    'name' => 'List all groups.',
    'description' => 'Returns a list of your organization\'s groups. Group objects listed in this call include information about their associated collections.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_groups_post' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenGroupsPost',
    'type' => 'write',
    'name' => 'Create a group.',
    'description' => 'Creates a new group object.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersGet',
    'type' => 'read',
    'name' => 'Retrieve a member.',
    'description' => 'Retrieves the details of an existing member of the organization. You need only supply the unique member identifier that was returned upon member creation.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_members_put' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersPut',
    'type' => 'write',
    'name' => 'Update a member.',
    'description' => 'Updates the specified member object. If a property is not provided, the value of the existing property will be reset.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_remove' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersRemove',
    'type' => 'write',
    'name' => 'Remove a member.',
    'description' => 'Removes a member from the organization. This cannot be undone. The user account will still remain.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_get_group_ids' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersGetGroupIds',
    'type' => 'read',
    'name' => 'Retrieve a member\'s group ids',
    'description' => 'Retrieves the unique identifiers for all groups that are associated with this member. You need only supply the unique member identifier that was returned upon member creation.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_members_put_group_ids' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersPutGroupIds',
    'type' => 'write',
    'name' => 'Update a member\'s groups.',
    'description' => 'Updates the specified member\'s group associations.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersList',
    'type' => 'read',
    'name' => 'List all members.',
    'description' => 'Returns a list of your organization\'s members. Member objects listed in this call include information about their associated collections.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_members_post' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersPost',
    'type' => 'write',
    'name' => 'Create a member.',
    'description' => 'Creates a new member object by inviting a user to the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_post_reinvite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersPostReinvite',
    'type' => 'write',
    'name' => 'Re-invite a member.',
    'description' => 'Re-sends the invitation email to an organization member.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_revoke' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersRevoke',
    'type' => 'write',
    'name' => 'Revoke a member\'s access to an organization.',
    'description' => 'Revoke a member\'s access to an organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_members_restore' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenMembersRestore',
    'type' => 'write',
    'name' => 'Restore a member.',
    'description' => 'Restores a previously revoked member of the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_organization_get_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenOrganizationGetSubscription',
    'type' => 'read',
    'name' => 'Retrieves the subscription details for the current organization.',
    'description' => 'Retrieves the subscription details for the current organization.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_organization_post_subscription' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenOrganizationPostSubscription',
    'type' => 'write',
    'name' => 'Update the organization\'s current subscription for Password Manager and/or Secrets Manager.',
    'description' => 'Update the organization\'s current subscription for Password Manager and/or Secrets Manager.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_organization_import' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenOrganizationImport',
    'type' => 'write',
    'name' => 'Import members and groups.',
    'description' => 'Import members and groups from an external system.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_policies_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenPoliciesGet',
    'type' => 'read',
    'name' => 'Retrieve a policy.',
    'description' => 'Retrieves the details of a policy.',
    'icon' => 'ph:shield-check',
  ),
  'bitwarden_policies_put' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenPoliciesPut',
    'type' => 'write',
    'name' => 'Update a policy.',
    'description' => 'Updates the specified policy. If a property is not provided, the value of the existing property will be reset.',
    'icon' => 'ph:pencil-simple',
  ),
  'bitwarden_policies_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Bitwarden\\Tools\\BitwardenPoliciesList',
    'type' => 'read',
    'name' => 'List all policies.',
    'description' => 'Returns a list of your organization\'s policies.',
    'icon' => 'ph:shield-check',
  ),
);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/bitwarden.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the correct service instance for default or named-account execution.
     *
     * @param  array<string, mixed>  $context  Runtime context from the host.
     */
    private function resolveService(array $context = []): BitwardenService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BitwardenService(
                clientId: $creds->get('bitwarden', 'client_id', '', $account),
                clientSecret: $creds->get('bitwarden', 'client_secret', '', $account),
                accessToken: $creds->get('bitwarden', 'access_token', '', $account),
                baseUrl: $creds->get('bitwarden', 'api_url', 'https://api.bitwarden.com', $account),
                identityUrl: $creds->get('bitwarden', 'identity_url', 'https://identity.bitwarden.com/connect/token', $account),
            );
        }

        return app(BitwardenService::class);
    }
}
