<?php

namespace OpenCompany\Integrations\Clerk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Clerk\Tools\ClerkApiDelete;
use OpenCompany\Integrations\Clerk\Tools\ClerkApiGet;
use OpenCompany\Integrations\Clerk\Tools\ClerkApiPatch;
use OpenCompany\Integrations\Clerk\Tools\ClerkApiPost;
use OpenCompany\Integrations\Clerk\Tools\ClerkBanUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkCountUsers;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateInvitation;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateOrganization;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateOrganizationInvitation;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateOrganizationMembership;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateSignInToken;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkDeleteOrganization;
use OpenCompany\Integrations\Clerk\Tools\ClerkDeleteOrganizationMembership;
use OpenCompany\Integrations\Clerk\Tools\ClerkDeleteUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetCurrentUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetOrganization;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetSession;
use OpenCompany\Integrations\Clerk\Tools\ClerkGetUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkListInvitations;
use OpenCompany\Integrations\Clerk\Tools\ClerkListOrganizationInvitations;
use OpenCompany\Integrations\Clerk\Tools\ClerkListOrganizationMemberships;
use OpenCompany\Integrations\Clerk\Tools\ClerkListOrganizations;
use OpenCompany\Integrations\Clerk\Tools\ClerkListSessions;
use OpenCompany\Integrations\Clerk\Tools\ClerkListUsers;
use OpenCompany\Integrations\Clerk\Tools\ClerkLockUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkRevokeInvitation;
use OpenCompany\Integrations\Clerk\Tools\ClerkRevokeOrganizationInvitation;
use OpenCompany\Integrations\Clerk\Tools\ClerkRevokeSession;
use OpenCompany\Integrations\Clerk\Tools\ClerkRevokeSignInToken;
use OpenCompany\Integrations\Clerk\Tools\ClerkUnbanUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkUnlockUser;
use OpenCompany\Integrations\Clerk\Tools\ClerkUpdateOrganization;
use OpenCompany\Integrations\Clerk\Tools\ClerkUpdateOrganizationMembership;
use OpenCompany\Integrations\Clerk\Tools\ClerkUpdateUser;

/**
 * Tool catalog and setup metadata for the Clerk integration.
 *
 * Exposes first-class Backend API tools for users, sessions, organizations,
 * memberships, invitations, sign-in tokens, and raw long-tail API calls.
 */
class ClerkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['secret_key'],
                'notes' => ['Use a Clerk Backend API secret key, not a publishable key.'],
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
        return 'clerk';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Clerk',
            'description' => 'Authentication, users, sessions, organizations, memberships, and invitations',
            'icon' => 'ph:identification-card',
            'logo' => 'ph:identification-card',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Clerk',
            'description' => 'Clerk Backend API tools for users, sessions, organizations, memberships, invitations, sign-in tokens, and raw API calls.',
            'icon' => 'ph:identification-card',
            'logo' => 'ph:identification-card',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://clerk.com/docs/reference/api/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'secret_key', 'type' => 'secret', 'label' => 'Secret Key', 'placeholder' => 'sk_live_...', 'hint' => 'Find your Backend API secret key in the Clerk Dashboard under API Keys.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.clerk.com/v1', 'hint' => 'Override only for a compatible proxy.', 'default' => 'https://api.clerk.com/v1'],
        ];
    }

    /**
     * Test the connection to the Clerk Backend API.
     *
     * @param  array<string, mixed>  $config  Configuration containing secret_key and optional url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $secretKey = (string) ($config['secret_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.clerk.com/v1'), '/');

        if ($secretKey === '') {
            return ['success' => false, 'error' => 'No secret key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$secretKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/users', ['limit' => 1]);

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Clerk API successfully.'];
            }

            $error = $response->json('errors.0.message') ?? "HTTP {$response->status()}";

            return ['success' => false, 'error' => "Clerk API error: {$error}"];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'secret_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'clerk_api_get' => ['class' => ClerkApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Execute a raw Clerk Backend API GET request.', 'icon' => 'ph:brackets-curly'],
            'clerk_api_post' => ['class' => ClerkApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Execute a raw Clerk Backend API POST request.', 'icon' => 'ph:brackets-curly'],
            'clerk_api_patch' => ['class' => ClerkApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Execute a raw Clerk Backend API PATCH request.', 'icon' => 'ph:brackets-curly'],
            'clerk_api_delete' => ['class' => ClerkApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Execute a raw Clerk Backend API DELETE request.', 'icon' => 'ph:brackets-curly'],

            'clerk_list_users' => ['class' => ClerkListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List users from Clerk with optional filtering and pagination.', 'icon' => 'ph:users'],
            'clerk_count_users' => ['class' => ClerkCountUsers::class, 'type' => 'read', 'name' => 'Count Users', 'description' => 'Count Clerk users with optional filters.', 'icon' => 'ph:number-circle-one'],
            'clerk_get_user' => ['class' => ClerkGetUser::class, 'type' => 'read', 'name' => 'Get User', 'description' => 'Retrieve a single Clerk user by ID.', 'icon' => 'ph:user'],
            'clerk_create_user' => ['class' => ClerkCreateUser::class, 'type' => 'write', 'name' => 'Create User', 'description' => 'Create a new user in Clerk.', 'icon' => 'ph:user-plus'],
            'clerk_update_user' => ['class' => ClerkUpdateUser::class, 'type' => 'write', 'name' => 'Update User', 'description' => 'Update an existing Clerk user profile.', 'icon' => 'ph:pencil'],
            'clerk_delete_user' => ['class' => ClerkDeleteUser::class, 'type' => 'write', 'name' => 'Delete User', 'description' => 'Delete a user from Clerk.', 'icon' => 'ph:trash'],
            'clerk_ban_user' => ['class' => ClerkBanUser::class, 'type' => 'write', 'name' => 'Ban User', 'description' => 'Ban a Clerk user.', 'icon' => 'ph:user-minus'],
            'clerk_unban_user' => ['class' => ClerkUnbanUser::class, 'type' => 'write', 'name' => 'Unban User', 'description' => 'Unban a Clerk user.', 'icon' => 'ph:user-check'],
            'clerk_lock_user' => ['class' => ClerkLockUser::class, 'type' => 'write', 'name' => 'Lock User', 'description' => 'Lock a Clerk user.', 'icon' => 'ph:lock'],
            'clerk_unlock_user' => ['class' => ClerkUnlockUser::class, 'type' => 'write', 'name' => 'Unlock User', 'description' => 'Unlock a Clerk user.', 'icon' => 'ph:lock-open'],

            'clerk_list_sessions' => ['class' => ClerkListSessions::class, 'type' => 'read', 'name' => 'List Sessions', 'description' => 'List Clerk sessions.', 'icon' => 'ph:clock-counter-clockwise'],
            'clerk_get_session' => ['class' => ClerkGetSession::class, 'type' => 'read', 'name' => 'Get Session', 'description' => 'Get a Clerk session.', 'icon' => 'ph:clock'],
            'clerk_revoke_session' => ['class' => ClerkRevokeSession::class, 'type' => 'write', 'name' => 'Revoke Session', 'description' => 'Revoke a Clerk session.', 'icon' => 'ph:sign-out'],

            'clerk_list_organizations' => ['class' => ClerkListOrganizations::class, 'type' => 'read', 'name' => 'List Organizations', 'description' => 'List organizations from Clerk with optional filtering.', 'icon' => 'ph:buildings'],
            'clerk_create_organization' => ['class' => ClerkCreateOrganization::class, 'type' => 'write', 'name' => 'Create Organization', 'description' => 'Create a Clerk organization.', 'icon' => 'ph:plus-circle'],
            'clerk_get_organization' => ['class' => ClerkGetOrganization::class, 'type' => 'read', 'name' => 'Get Organization', 'description' => 'Get a Clerk organization.', 'icon' => 'ph:building'],
            'clerk_update_organization' => ['class' => ClerkUpdateOrganization::class, 'type' => 'write', 'name' => 'Update Organization', 'description' => 'Update a Clerk organization.', 'icon' => 'ph:pencil-simple'],
            'clerk_delete_organization' => ['class' => ClerkDeleteOrganization::class, 'type' => 'write', 'name' => 'Delete Organization', 'description' => 'Delete a Clerk organization.', 'icon' => 'ph:trash'],
            'clerk_list_organization_memberships' => ['class' => ClerkListOrganizationMemberships::class, 'type' => 'read', 'name' => 'List Organization Memberships', 'description' => 'List memberships for a Clerk organization.', 'icon' => 'ph:users-three'],
            'clerk_create_organization_membership' => ['class' => ClerkCreateOrganizationMembership::class, 'type' => 'write', 'name' => 'Create Organization Membership', 'description' => 'Add a user to a Clerk organization.', 'icon' => 'ph:user-plus'],
            'clerk_update_organization_membership' => ['class' => ClerkUpdateOrganizationMembership::class, 'type' => 'write', 'name' => 'Update Organization Membership', 'description' => 'Update a Clerk organization membership.', 'icon' => 'ph:user-gear'],
            'clerk_delete_organization_membership' => ['class' => ClerkDeleteOrganizationMembership::class, 'type' => 'write', 'name' => 'Delete Organization Membership', 'description' => 'Remove a user from a Clerk organization.', 'icon' => 'ph:user-minus'],
            'clerk_list_organization_invitations' => ['class' => ClerkListOrganizationInvitations::class, 'type' => 'read', 'name' => 'List Organization Invitations', 'description' => 'List invitations for a Clerk organization.', 'icon' => 'ph:envelope-open'],
            'clerk_create_organization_invitation' => ['class' => ClerkCreateOrganizationInvitation::class, 'type' => 'write', 'name' => 'Create Organization Invitation', 'description' => 'Create an invitation for a Clerk organization.', 'icon' => 'ph:envelope-simple'],
            'clerk_revoke_organization_invitation' => ['class' => ClerkRevokeOrganizationInvitation::class, 'type' => 'write', 'name' => 'Revoke Organization Invitation', 'description' => 'Revoke a Clerk organization invitation.', 'icon' => 'ph:envelope-simple-open'],

            'clerk_list_invitations' => ['class' => ClerkListInvitations::class, 'type' => 'read', 'name' => 'List Invitations', 'description' => 'List Clerk application invitations.', 'icon' => 'ph:envelope-open'],
            'clerk_create_invitation' => ['class' => ClerkCreateInvitation::class, 'type' => 'write', 'name' => 'Create Invitation', 'description' => 'Create a Clerk application invitation.', 'icon' => 'ph:envelope-simple'],
            'clerk_revoke_invitation' => ['class' => ClerkRevokeInvitation::class, 'type' => 'write', 'name' => 'Revoke Invitation', 'description' => 'Revoke a Clerk application invitation.', 'icon' => 'ph:envelope-simple-open'],
            'clerk_create_sign_in_token' => ['class' => ClerkCreateSignInToken::class, 'type' => 'write', 'name' => 'Create Sign-In Token', 'description' => 'Create a Clerk sign-in token.', 'icon' => 'ph:key'],
            'clerk_revoke_sign_in_token' => ['class' => ClerkRevokeSignInToken::class, 'type' => 'write', 'name' => 'Revoke Sign-In Token', 'description' => 'Revoke a Clerk sign-in token.', 'icon' => 'ph:key-return'],

            'clerk_get_current_user' => ['class' => ClerkGetCurrentUser::class, 'type' => 'read', 'name' => 'Health Check', 'description' => 'Verify Clerk API connectivity by fetching the first user.', 'icon' => 'ph:heartbeat'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/clerk.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  array<string, mixed>  $context  Context containing optional account information.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): ClerkService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ClerkService(
                secretKey: $creds->get('clerk', 'secret_key', '', $account),
                baseUrl: $creds->get('clerk', 'url', 'https://api.clerk.com/v1', $account),
            );
        }

        return app(ClerkService::class);
    }
}
