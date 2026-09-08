<?php

namespace OpenCompany\Integrations\Logto;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Logto.
 *
 * Exposes the official Logto Management API operation set for users,
 * applications, organizations, roles, resources, connectors, hooks, and branding.
 */
class LogtoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth_client_credentials','legacy_auth_type'=>'api_token','credential_mode'=>'client_credentials','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>true,'token_keys'=>['access_token'],'notes'=>['Use a Logto machine-to-machine application with Management API permission `all`, or provide a pre-issued access token.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'logto'; } public function appMeta(): array { return ['label'=>'Logto','description'=>'Customer identity management and Management API','icon'=>'ph:key','logo'=>'simple-icons:logto']; }
    public function integrationMeta(): array { return ['name'=>'Logto','description'=>'Manage Logto users, applications, organizations, roles, API resources, connectors, hooks, sign-in experience, branding, and tenant settings.','icon'=>'ph:key','logo'=>'simple-icons:logto','category'=>'productivity','badge'=>'verified','docs_url'=>'https://openapi.logto.io/','source_url'=>'https://openapi.logto.io/source.json']; }
    public function configSchema(): array { return [['key'=>'client_id','type'=>'text','label'=>'Client ID','required'=>false],['key'=>'client_secret','type'=>'secret','label'=>'Client Secret','required'=>false],['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>false],['key'=>'base_url','type'=>'url','label'=>'Logto Base URL','default'=>'https://tenant.logto.app','required'=>true],['key'=>'token_url','type'=>'url','label'=>'Token URL','required'=>false],['key'=>'resource','type'=>'text','label'=>'Resource','required'=>false],['key'=>'scope','type'=>'text','label'=>'Scope','default'=>'all','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $service=new LogtoService(clientId:(string)($config['client_id']??''), clientSecret:(string)($config['client_secret']??''), accessToken:(string)($config['access_token']??''), baseUrl:(string)($config['base_url']??'https://tenant.logto.app'), tokenUrl:(string)($config['token_url']??''), resource:(string)($config['resource']??''), scope:(string)($config['scope']??'all')); if(!$service->isConfigured()) return ['success'=>false,'error'=>'Provide either an access token or both Logto client id and client secret.']; try{$service->request('GET','/api/applications'); return ['success'=>true,'message'=>'Connected to Logto Management API.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['client_id'=>'nullable|string','client_secret'=>'nullable|string','access_token'=>'nullable|string','base_url'=>'required|url','token_url'=>'nullable|url','resource'=>'nullable|string','scope'=>'nullable|string']; } public function credentialFields(): array { return [['key'=>'client_id','type'=>'string','label'=>'Client ID','required'=>false],['key'=>'client_secret','type'=>'secret','label'=>'Client Secret','required'=>false],['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>false],['key'=>'base_url','type'=>'url','label'=>'Logto Base URL','required'=>true,'default'=>'https://tenant.logto.app'],['key'=>'token_url','type'=>'url','label'=>'Token URL','required'=>false],['key'=>'resource','type'=>'string','label'=>'Resource','required'=>false],['key'=>'scope','type'=>'string','label'=>'Scope','required'=>false,'default'=>'all']]; }
    public function tools(): array { return array (
  'logto_add_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddMfaVerification',
    'type' => 'write',
    'name' => 'Add a MFA verification',
    'description' => 'Add a MFA verification to the user, a logto-verification-id in header is required for checking sensitive permissions.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_add_one_time_tokens' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddOneTimeTokens',
    'type' => 'write',
    'name' => 'Create one-time token',
    'description' => 'Create a new one-time token associated with an email address. The token can be used for verification purposes and has an expiration time.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_add_organization_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddOrganizationApplications',
    'type' => 'write',
    'name' => 'Add organization application',
    'description' => 'Add an application to the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_add_organization_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddOrganizationUsers',
    'type' => 'write',
    'name' => 'Add user members to organization',
    'description' => 'Add users as members to the specified organization with the given user IDs.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_add_user_identities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddUserIdentities',
    'type' => 'write',
    'name' => 'Add a user identity',
    'description' => 'Add an identity (social identity) to the user, a logto-verification-id in header is required for checking sensitive permissions, and a verification record for the social identity is required.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_add_user_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAddUserProfile',
    'type' => 'write',
    'name' => 'Add user profile',
    'description' => 'Adds user profile data to the current experience interaction. - For `Register`: The profile data provided before the identification request will be used to create a new user account. - For `SignIn` and `Register`: The profile data provided after the user is identified will be used to update the user\'s profile when the interaction is submitted. - `ForgotPassword`: Not supported.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assert_saml' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssertSaml',
    'type' => 'write',
    'name' => 'SAML ACS endpoint (social)',
    'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) social connectors. SAML social connectors are deprecated. Use the SSO SAML connector instead.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assert_single_sign_on_saml' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssertSingleSignOnSaml',
    'type' => 'write',
    'name' => 'SAML ACS endpoint (SSO)',
    'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) single sign-on (SSO) connectors. This endpoint is used to complete the SAML SSO authentication flow. It receives the SAML assertion response from the identity provider (IdP) and redirects the user to complete the authentication flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_application_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignApplicationRoles',
    'type' => 'write',
    'name' => 'Assign API resource roles to application',
    'description' => 'Assign API resource roles to the specified application. The API resource roles will be added to the existing API resource roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_organization_roles_to_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignOrganizationRolesToApplication',
    'type' => 'write',
    'name' => 'Add organization application role',
    'description' => 'Add a role to the application in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_organization_roles_to_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignOrganizationRolesToApplications',
    'type' => 'write',
    'name' => 'Assign roles to applications in an organization',
    'description' => 'Assign roles to applications in the specified organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_organization_roles_to_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignOrganizationRolesToUser',
    'type' => 'write',
    'name' => 'Assign roles to a user in an organization',
    'description' => 'Assign roles to a user in the specified organization with the provided data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_organization_roles_to_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignOrganizationRolesToUsers',
    'type' => 'write',
    'name' => 'Assign roles to organization user members',
    'description' => 'Assign roles to user members of the specified organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_assign_user_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoAssignUserRoles',
    'type' => 'write',
    'name' => 'Assign roles to user',
    'description' => 'Assign API resource roles to the user. The roles will be added to the existing roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_bind_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoBindMfaVerification',
    'type' => 'write',
    'name' => 'Bind MFA verification by verificationId',
    'description' => 'Bind new MFA verification to the user profile using the verificationId.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_bind_passkey' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoBindPasskey',
    'type' => 'write',
    'name' => 'Bind passkey for sign-in',
    'description' => 'Bind a WebAuthn credential as a passkey for sign-in purposes. Unlike `POST /api/experience/profile/mfa` with `type: WebAuthn`, this endpoint is exclusively for adding a passkey as a sign-in method and does NOT mark the user\'s optional MFA as enabled.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_check_password_with_default_sign_in_experience' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCheckPasswordWithDefaultSignInExperience',
    'type' => 'write',
    'name' => 'Check if a password meets the password policy',
    'description' => 'Check if a password meets the password policy in the sign-in experience settings.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_cleanup_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCleanupDomains',
    'type' => 'write',
    'name' => 'Cleanup stale domains',
    'description' => 'Clean up custom domains that have been inactive (not verified) for a specified number of days. This uses Cloudflare as the source of truth to determine domain activity.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_and_send_mfa_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateAndSendMfaVerificationCode',
    'type' => 'write',
    'name' => 'Create and send MFA verification code',
    'description' => 'Create a new MFA verification code and send it to the user\'s bound identifier (email or phone). This endpoint automatically uses the user\'s bound email address or phone number from their profile for MFA verification. The user must be identified before calling this endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_and_send_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateAndSendVerificationCode',
    'type' => 'write',
    'name' => 'Create and send verification code',
    'description' => 'Create a new `CodeVerification` record and sends the code to the specified identifier. The code verification can be used to verify the given identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateApplication',
    'type' => 'write',
    'name' => 'Create an application',
    'description' => 'Create a new application with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_application_protected_app_metadata_custom_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateApplicationProtectedAppMetadataCustomDomain',
    'type' => 'write',
    'name' => 'Add a custom domain to the application',
    'description' => 'Add a custom domain to the application. You\'ll need to setup DNS record later.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateApplicationSecret',
    'type' => 'write',
    'name' => 'Add application secret',
    'description' => 'Add a new secret for the application.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_application_user_consent_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateApplicationUserConsentOrganization',
    'type' => 'write',
    'name' => 'Grant a list of organization access of a user for a application',
    'description' => 'Grant a list of organization access of a user for a application by application id and user id. The user must be a member of all the organizations. Only third-party application needs to be granted access to organizations, all the other applications can request for all the organizations\' access by default.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_application_user_consent_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateApplicationUserConsentScope',
    'type' => 'write',
    'name' => 'Assign user consent scopes to application',
    'description' => 'Assign the user consent scopes to an application by application id',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateConnector',
    'type' => 'write',
    'name' => 'Create connector',
    'description' => 'Create a connector with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_connector_authorization_uri' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateConnectorAuthorizationUri',
    'type' => 'write',
    'name' => 'Get connector\'s authorization URI',
    'description' => 'Get authorization URI for specified connector by providing redirect URI and randomly generated state.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_connector_test' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateConnectorTest',
    'type' => 'write',
    'name' => 'Test passwordless connector',
    'description' => 'Test a passwordless (email or SMS) connector by sending a test message to the given phone number or email address.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_custom_profile_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateCustomProfileField',
    'type' => 'write',
    'name' => 'Create a custom profile field',
    'description' => 'Create a custom profile field.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_custom_profile_fields_batch' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateCustomProfileFieldsBatch',
    'type' => 'write',
    'name' => 'Batch create custom profile fields',
    'description' => 'Create multiple custom profile fields in a single request (max 20 items).',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateDomain',
    'type' => 'write',
    'name' => 'Create domain',
    'description' => 'Create a new domain with the given data. The maximum domain number is 1, once created, can not be modified, you\'ll have to delete and recreate one.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_enterprise_sso_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateEnterpriseSsoVerification',
    'type' => 'write',
    'name' => 'Create enterprise SSO verification',
    'description' => 'Create a new EnterpriseSSO verification record and return the provider\'s authorization URI for the given connector.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_hook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateHook',
    'type' => 'write',
    'name' => 'Create a hook',
    'description' => 'Create a new hook with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_hook_test' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateHookTest',
    'type' => 'write',
    'name' => 'Test hook',
    'description' => 'Test the specified hook with the given events and config.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_new_password_identity_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateNewPasswordIdentityVerification',
    'type' => 'write',
    'name' => 'Create new password identity verification',
    'description' => 'Create a NewPasswordIdentity verification record for the new user registration use. The verification record includes a unique user identifier and a password that can be used to create a new user account.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_or_replace_totp_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrReplaceTotpMfaVerification',
    'type' => 'write',
    'name' => 'Create or replace the authenticator app',
    'description' => 'Create or replace the user\'s TOTP MFA verification with a new authenticator app binding. If the user already has a TOTP verification, it will be replaced; otherwise, a new one will be created. Requires a logto-verification-id header for sensitive permission checks, a valid TOTP secret, and a valid TOTP code generated from the secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganization',
    'type' => 'write',
    'name' => 'Create an organization',
    'description' => 'Create a new organization with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_invitation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationInvitation',
    'type' => 'write',
    'name' => 'Create organization invitation',
    'description' => 'Create an organization invitation and optionally send it via email. The tenant should have an email connector configured if you want to send the invitation via email at this point.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_invitation_message' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationInvitationMessage',
    'type' => 'write',
    'name' => 'Resend invitation message',
    'description' => 'Resend the invitation message to the invitee.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_jit_email_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationJitEmailDomain',
    'type' => 'write',
    'name' => 'Add organization JIT email domain',
    'description' => 'Add a new email domain for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_jit_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationJitRole',
    'type' => 'write',
    'name' => 'Add organization JIT default roles',
    'description' => 'Add new organization roles that will be assigned to users during just-in-time provisioning.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_jit_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationJitSsoConnector',
    'type' => 'write',
    'name' => 'Add organization JIT SSO connectors',
    'description' => 'Add new enterprise SSO connectors for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationRole',
    'type' => 'write',
    'name' => 'Create an organization role',
    'description' => 'Create a new organization role with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_role_resource_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationRoleResourceScope',
    'type' => 'write',
    'name' => 'Assign resource scopes to organization role',
    'description' => 'Assign resource scopes to the specified organization role',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_role_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationRoleScope',
    'type' => 'write',
    'name' => 'Assign organization scopes to organization role',
    'description' => 'Assign organization scopes to the specified organization role',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_organization_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateOrganizationScope',
    'type' => 'write',
    'name' => 'Create an organization scope',
    'description' => 'Create a new organization scope with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_password_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreatePasswordVerification',
    'type' => 'write',
    'name' => 'Create password verification record',
    'description' => 'Create and verify a new Password verification record. The verification record can only be created if the provided user credentials are correct.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateResource',
    'type' => 'write',
    'name' => 'Create an API resource',
    'description' => 'Create an API resource in the current tenant.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_resource_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateResourceScope',
    'type' => 'write',
    'name' => 'Create API resource scope',
    'description' => 'Create a new scope (permission) for an API resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateRole',
    'type' => 'write',
    'name' => 'Create a role',
    'description' => 'Create a new role with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_role_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateRoleApplication',
    'type' => 'write',
    'name' => 'Assign role to applications',
    'description' => 'Assign a role to a list of applications. The role must have the type `Application`.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_role_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateRoleScope',
    'type' => 'write',
    'name' => 'Link scopes to role',
    'description' => 'Link a list of API resource scopes (permissions) to a role. The original linked scopes will be kept.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_role_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateRoleUser',
    'type' => 'write',
    'name' => 'Assign role to users',
    'description' => 'Assign a role to a list of users. The role must have the type `User`.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_saml_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSamlApplication',
    'type' => 'write',
    'name' => 'Create SAML application',
    'description' => 'Create a new SAML application with the given configuration. A default signing certificate with 3 years lifetime will be automatically created.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_saml_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSamlApplicationSecret',
    'type' => 'write',
    'name' => 'Create SAML application secret',
    'description' => 'Create a new signing certificate for the SAML application.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_saml_authn' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSamlAuthn',
    'type' => 'write',
    'name' => 'Handle SAML authentication request (POST binding)',
    'description' => 'Process SAML authentication request using HTTP POST binding.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_sign_in_passkey_authentication' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSignInPasskeyAuthentication',
    'type' => 'write',
    'name' => 'Create passkey sign-in WebAuthn authentication',
    'description' => 'Create WebAuthn authentication options for passkey sign-in. The user will be resolved later by the credential during verification.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_sign_in_passkey_authentication_with_identifier' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSignInPasskeyAuthenticationWithIdentifier',
    'type' => 'write',
    'name' => 'Create passkey sign-in WebAuthn authentication with identifier',
    'description' => 'Create WebAuthn authentication options for passkey sign-in with an identifier. The identifier is used to look up the user\'s WebAuthn credentials and generate non-discoverable authentication options.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_social_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSocialVerification',
    'type' => 'write',
    'name' => 'Create social verification',
    'description' => 'Create a new SocialVerification record and return the provider\'s authorization URI for the given connector.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSsoConnector',
    'type' => 'write',
    'name' => 'Create SSO connector',
    'description' => 'Create an new SSO connector instance for a given provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_subject_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateSubjectToken',
    'type' => 'write',
    'name' => 'Create a new subject token',
    'description' => 'Create a new subject token for the use of impersonating the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_totp_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateTotpSecret',
    'type' => 'write',
    'name' => 'Create TOTP secret',
    'description' => 'Create a new TOTP verification record and generate a new TOTP secret for the user. This secret can be used to bind a new TOTP verification to the user\'s profile. The verification record must be verified before the secret can be used to bind a new TOTP verification to the user\'s profile.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateUser',
    'type' => 'write',
    'name' => 'Create user',
    'description' => 'Create a new user with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_user_asset' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateUserAsset',
    'type' => 'write',
    'name' => 'Upload asset',
    'description' => 'Upload a user asset.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_user_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateUserIdentity',
    'type' => 'write',
    'name' => 'Link social identity to user',
    'description' => 'Link authenticated user identity from a social platform to a Logto user. The usage of this API is usually coupled with `POST /connectors/:connectorId/authorization-uri`. With the help of these pair of APIs, you can implement a user profile page with the link social account feature in your application. Note: Currently due to technical limitations, this API does not support the following connectors that rely on Logto interaction session: `@logto/connector-apple`, `@logto/connector-saml`, `@logto/c',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_user_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateUserMfaVerification',
    'type' => 'write',
    'name' => 'Create an MFA verification for a user',
    'description' => 'Create a new MFA verification for a given user ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_user_personal_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateUserPersonalAccessToken',
    'type' => 'write',
    'name' => 'Add personal access token',
    'description' => 'Add a new personal access token for the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_verification_by_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateVerificationByPassword',
    'type' => 'write',
    'name' => 'Create a record by password',
    'description' => 'Create a verification record by verifying the password.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_verification_by_social' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateVerificationBySocial',
    'type' => 'write',
    'name' => 'Create a social verification record',
    'description' => 'Create a social verification record and return the authorization URI.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_verification_by_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateVerificationByVerificationCode',
    'type' => 'write',
    'name' => 'Create a record by verification code',
    'description' => 'Create a verification record and send the code to the specified identifier. The code verification can be used to verify the given identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateVerificationCode',
    'type' => 'write',
    'name' => 'Request and send a verification code',
    'description' => 'Request a verification code for the provided identifier (email/phone). if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_web_authn_authentication_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateWebAuthnAuthenticationVerification',
    'type' => 'write',
    'name' => 'Create WebAuthn authentication verification',
    'description' => 'Create a new WebAuthn authentication verification record based on the user\'s existing WebAuthn credential. This verification record can be used to verify the user\'s WebAuthn credential.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_create_web_authn_registration_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoCreateWebAuthnRegistrationVerification',
    'type' => 'write',
    'name' => 'Create WebAuthn registration verification',
    'description' => 'Create a new WebAuthn registration verification record. The verification record can be used to bind a new WebAuthn credential to the user\'s profile.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplication',
    'type' => 'write',
    'name' => 'Delete application',
    'description' => 'Delete application by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_legacy_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationLegacySecret',
    'type' => 'write',
    'name' => 'Delete application legacy secret',
    'description' => 'Delete the legacy secret for the application and replace it with a new internal secret. Note: This operation does not "really" delete the legacy secret because it is still needed for internal validation. We may remove the display of the legacy secret (the `secret` field in the application response) in the future.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_protected_app_metadata_custom_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationProtectedAppMetadataCustomDomain',
    'type' => 'write',
    'name' => 'Remove custom domain',
    'description' => 'Remove custom domain from the specified application.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationRole',
    'type' => 'write',
    'name' => 'Remove a API resource role from application',
    'description' => 'Remove a API resource role from the specified application.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationSecret',
    'type' => 'write',
    'name' => 'Delete application secret',
    'description' => 'Delete a secret for the application by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_user_consent_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationUserConsentOrganization',
    'type' => 'write',
    'name' => 'Revoke a user\'s access to an organization for a application',
    'description' => 'Revoke a user\'s access to an organization for a application by application id, user id and organization id.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_application_user_consent_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteApplicationUserConsentScope',
    'type' => 'write',
    'name' => 'Remove user consent scope from application',
    'description' => 'Remove the user consent scope from an application by application id, scope type and scope id',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_captcha_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteCaptchaProvider',
    'type' => 'write',
    'name' => 'Delete captcha provider',
    'description' => 'Delete the captcha provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteConnector',
    'type' => 'write',
    'name' => 'Delete connector',
    'description' => 'Delete connector by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_custom_phrase' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteCustomPhrase',
    'type' => 'write',
    'name' => 'Delete custom phrase',
    'description' => 'Delete custom phrases for the specified language tag.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_custom_profile_field_by_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteCustomProfileFieldByName',
    'type' => 'write',
    'name' => 'Delete a custom profile field by name',
    'description' => 'Delete a custom profile field by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteDomain',
    'type' => 'write',
    'name' => 'Delete domain',
    'description' => 'Delete domain by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_email_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteEmailTemplate',
    'type' => 'write',
    'name' => 'Delete an email template',
    'description' => 'Delete an email template by its ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_email_templates' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteEmailTemplates',
    'type' => 'write',
    'name' => 'Delete email templates',
    'description' => 'Bulk delete email templates by their language tag and template type.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_grant_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteGrantById',
    'type' => 'write',
    'name' => 'Revoke a grant by ID',
    'description' => 'Revoke a specific user application grant by grant ID and remove the related session authorization. A logto-verification-id in header is required for revoking grants.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_hook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteHook',
    'type' => 'write',
    'name' => 'Delete hook',
    'description' => 'Delete hook by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteIdentity',
    'type' => 'write',
    'name' => 'Delete a user identity',
    'description' => 'Delete an identity (social identity) from the user, a logto-verification-id in header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_jwt_customizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteJwtCustomizer',
    'type' => 'write',
    'name' => 'Delete JWT customizer',
    'description' => 'Delete the JWT customizer for the given token type.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteMfaVerification',
    'type' => 'write',
    'name' => 'Delete an MFA verification',
    'description' => 'Delete an MFA verification, a logto-verification-id in header is required for checking sensitive permissions.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_oidc_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOidcKey',
    'type' => 'write',
    'name' => 'Delete OIDC key',
    'description' => 'Delete an OIDC signing key by key type and key ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_one_time_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOneTimeToken',
    'type' => 'write',
    'name' => 'Delete one-time token by ID',
    'description' => 'Delete a one-time token by its ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganization',
    'type' => 'write',
    'name' => 'Delete organization',
    'description' => 'Delete organization by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationApplication',
    'type' => 'write',
    'name' => 'Remove organization application',
    'description' => 'Remove an application from the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_application_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationApplicationRole',
    'type' => 'write',
    'name' => 'Remove organization application role',
    'description' => 'Remove a role from the application in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_invitation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationInvitation',
    'type' => 'write',
    'name' => 'Delete organization invitation',
    'description' => 'Delete an organization invitation by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_jit_email_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationJitEmailDomain',
    'type' => 'write',
    'name' => 'Remove organization JIT email domain',
    'description' => 'Remove an email domain for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_jit_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationJitRole',
    'type' => 'write',
    'name' => 'Remove organization JIT default role',
    'description' => 'Remove an organization role that will be assigned to users during just-in-time provisioning.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_jit_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationJitSsoConnector',
    'type' => 'write',
    'name' => 'Remove organization JIT SSO connector',
    'description' => 'Remove an enterprise SSO connector for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationRole',
    'type' => 'write',
    'name' => 'Delete organization role',
    'description' => 'Delete organization role by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_role_resource_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationRoleResourceScope',
    'type' => 'write',
    'name' => 'Remove resource scope',
    'description' => 'Remove a resource scope assignment from the specified organization role.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_role_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationRoleScope',
    'type' => 'write',
    'name' => 'Remove organization scope',
    'description' => 'Remove a organization scope assignment from the specified organization role.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationScope',
    'type' => 'write',
    'name' => 'Delete organization scope',
    'description' => 'Delete organization scope by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationUser',
    'type' => 'write',
    'name' => 'Remove user member from organization',
    'description' => 'Remove a user\'s membership from the specified organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_organization_user_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteOrganizationUserRole',
    'type' => 'write',
    'name' => 'Remove a role from a user in an organization',
    'description' => 'Remove a role assignment from a user in the specified organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_personal_access_token_post' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeletePersonalAccessTokenPost',
    'type' => 'write',
    'name' => 'Delete personal access token',
    'description' => 'Delete a token for the user by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_primary_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeletePrimaryEmail',
    'type' => 'write',
    'name' => 'Delete primary email',
    'description' => 'Delete primary email for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_primary_phone' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeletePrimaryPhone',
    'type' => 'write',
    'name' => 'Delete primary phone',
    'description' => 'Delete primary phone for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteResource',
    'type' => 'write',
    'name' => 'Delete API resource',
    'description' => 'Delete an API resource by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_resource_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteResourceScope',
    'type' => 'write',
    'name' => 'Delete API resource scope',
    'description' => 'Delete an API resource scope (permission) from the given resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteRole',
    'type' => 'write',
    'name' => 'Delete role',
    'description' => 'Delete a role with the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_role_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteRoleApplication',
    'type' => 'write',
    'name' => 'Remove role from application',
    'description' => 'Remove the role from an application with the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_role_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteRoleScope',
    'type' => 'write',
    'name' => 'Unlink scope from role',
    'description' => 'Unlink an API resource scope (permission) from a role with the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_role_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteRoleUser',
    'type' => 'write',
    'name' => 'Remove role from user',
    'description' => 'Remove a role from a user with the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_saml_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSamlApplication',
    'type' => 'write',
    'name' => 'Delete SAML application',
    'description' => 'Delete a SAML application by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_saml_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSamlApplicationSecret',
    'type' => 'write',
    'name' => 'Delete SAML application secret',
    'description' => 'Delete a signing certificate of the SAML application. Active certificates cannot be deleted.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSecret',
    'type' => 'write',
    'name' => 'Delete secret',
    'description' => 'Delete a secret by its ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_sentinel_activities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSentinelActivities',
    'type' => 'write',
    'name' => 'Bulk delete sentinel activities',
    'description' => 'Remove sentinel activity reports based on the provided target value(identifier).Use this endpoint to unblock users who may be locked out due to too many failed authentication attempts.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_session_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSessionById',
    'type' => 'write',
    'name' => 'Revoke a session by ID',
    'description' => 'Revoke a specific user session by its ID, optionally revoking target associated grants and tokens. A logto-verification-id in header is required for revoking sessions.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteSsoConnector',
    'type' => 'write',
    'name' => 'Delete SSO connector',
    'description' => 'Delete an SSO connector by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUser',
    'type' => 'write',
    'name' => 'Delete user',
    'description' => 'Delete user with the given ID. Note all associated data will be deleted cascadingly.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_grant' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserGrant',
    'type' => 'write',
    'name' => 'Revoke a user grant',
    'description' => 'Revoke a specific grant and its associated token chain by grant ID. Also removes the matching session authorization entry for this grant from the related active session. The grant must belong to the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserIdentity',
    'type' => 'write',
    'name' => 'Delete social identity from user',
    'description' => 'Delete a social identity from the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_mfa_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserMfaVerification',
    'type' => 'write',
    'name' => 'Delete an MFA verification for a user',
    'description' => 'Delete an MFA verification for the user with the given verification ID. The verification ID must be associated with the given user ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_personal_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserPersonalAccessToken',
    'type' => 'write',
    'name' => 'Delete personal access token',
    'description' => 'Delete a token for the user by name using the legacy path parameter. Deprecated: use the POST /delete endpoint instead to avoid url name encoding issues.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserRole',
    'type' => 'write',
    'name' => 'Remove role from user',
    'description' => 'Remove an API resource role from the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_delete_user_session' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoDeleteUserSession',
    'type' => 'write',
    'name' => 'Revoke a user session',
    'description' => 'Revoke a specific user session by its ID, optionally revoking associated target grants and tokens.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_generate_backup_codes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGenerateBackupCodes',
    'type' => 'write',
    'name' => 'Generate backup codes',
    'description' => 'Create a new BackupCode verification record with new backup codes generated. This verification record will be used to bind the backup codes to the user\'s profile.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_generate_my_account_backup_codes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGenerateMyAccountBackupCodes',
    'type' => 'write',
    'name' => 'Generate backup codes',
    'description' => 'Generate backup codes for the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_generate_totp_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGenerateTotpSecret',
    'type' => 'write',
    'name' => 'Generate a TOTP secret',
    'description' => 'Generate a TOTP secret for the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_generate_web_authn_registration_options' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGenerateWebAuthnRegistrationOptions',
    'type' => 'write',
    'name' => 'Generate WebAuthn registration options',
    'description' => 'Generate WebAuthn registration options for the user to register a new WebAuthn device.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_get_account_center_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetAccountCenterSettings',
    'type' => 'read',
    'name' => 'Get account center settings',
    'description' => 'Get the account center settings.',
    'icon' => 'ph:key',
  ),
  'logto_get_active_user_counts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetActiveUserCounts',
    'type' => 'read',
    'name' => 'Get active user data',
    'description' => 'Get active user data, including daily active user (DAU), weekly active user (WAU) and monthly active user (MAU). It also includes an array of DAU in the past 30 days.',
    'icon' => 'ph:key',
  ),
  'logto_get_admin_console_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetAdminConsoleConfig',
    'type' => 'read',
    'name' => 'Get admin console config',
    'description' => 'Get the global configuration object for Logto Console.',
    'icon' => 'ph:key',
  ),
  'logto_get_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetApplication',
    'type' => 'read',
    'name' => 'Get application',
    'description' => 'Get application details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_application_sign_in_experience' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetApplicationSignInExperience',
    'type' => 'read',
    'name' => 'Get the application level sign-in experience',
    'description' => 'Get application level sign-in experience for a given application. - Only branding properties and terms links customization is supported for now. - Only third-party applications can have the sign-in experience customization for now.',
    'icon' => 'ph:key',
  ),
  'logto_get_backup_codes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetBackupCodes',
    'type' => 'read',
    'name' => 'Get backup codes',
    'description' => 'Get all backup codes for the user with their usage status. Requires identity verification.',
    'icon' => 'ph:key',
  ),
  'logto_get_captcha_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetCaptchaProvider',
    'type' => 'read',
    'name' => 'Get captcha provider',
    'description' => 'Get the captcha provider, you can only have one captcha provider.',
    'icon' => 'ph:key',
  ),
  'logto_get_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetConnector',
    'type' => 'read',
    'name' => 'Get connector',
    'description' => 'Get connector data by ID',
    'icon' => 'ph:key',
  ),
  'logto_get_connector_factory' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetConnectorFactory',
    'type' => 'read',
    'name' => 'Get connector factory',
    'description' => 'Get connector factory by the given ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_custom_phrase' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetCustomPhrase',
    'type' => 'read',
    'name' => 'Get custom phrases',
    'description' => 'Get custom phrases for the specified language tag.',
    'icon' => 'ph:key',
  ),
  'logto_get_custom_profile_field_by_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetCustomProfileFieldByName',
    'type' => 'read',
    'name' => 'Get a custom profile field by name',
    'description' => 'Get a custom profile field by name.',
    'icon' => 'ph:key',
  ),
  'logto_get_domain' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetDomain',
    'type' => 'read',
    'name' => 'Get domain',
    'description' => 'Get domain details by ID, by calling this API, the domain status will be synced from remote provider.',
    'icon' => 'ph:key',
  ),
  'logto_get_email_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetEmailTemplate',
    'type' => 'read',
    'name' => 'Get email template by ID',
    'description' => 'Get the email template by its ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_enabled_sso_connectors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetEnabledSsoConnectors',
    'type' => 'read',
    'name' => 'Get enabled SSO connectors by the given email\'s domain',
    'description' => 'Extract the email domain from the provided email address. Returns all the enabled SSO connectors that match the email domain.',
    'icon' => 'ph:key',
  ),
  'logto_get_enterprise_sso_identity_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetEnterpriseSsoIdentityAccessToken',
    'type' => 'read',
    'name' => 'Retrieve the access token issued by a third-party enterprise SSO provider',
    'description' => 'This API retrieves the access token issued by a third-party enterprise SSO provider for a given SSO connector ID. Access is only available if token storage is enabled for the corresponding connector. When a user authenticates through a SSO provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
    'icon' => 'ph:key',
  ),
  'logto_get_grants' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetGrants',
    'type' => 'read',
    'name' => 'Get all active grants',
    'description' => 'Retrieve all active application grants for the user. A logto-verification-id in header is required for checking grant details.',
    'icon' => 'ph:key',
  ),
  'logto_get_hasura_auth' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetHasuraAuth',
    'type' => 'read',
    'name' => 'Hasura auth hook endpoint',
    'description' => 'The `HASURA_GRAPHQL_AUTH_HOOK` endpoint for Hasura auth. Use this endpoint to integrate Hasura\'s [webhook authentication flow](https://hasura.io/docs/latest/auth/authentication/webhook/).',
    'icon' => 'ph:key',
  ),
  'logto_get_hook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetHook',
    'type' => 'read',
    'name' => 'Get hook',
    'description' => 'Get hook details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_id_token_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetIdTokenConfig',
    'type' => 'read',
    'name' => 'Get ID token claims configuration',
    'description' => 'Get the ID token extended claims configuration for the tenant. This configuration controls which extended claims (e.g., `custom_data`, `identities`, `roles`, `organizations`, `organization_roles`) are included in ID tokens.',
    'icon' => 'ph:key',
  ),
  'logto_get_interaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetInteraction',
    'type' => 'read',
    'name' => 'Get public interaction data',
    'description' => 'Get the public interaction data.',
    'icon' => 'ph:key',
  ),
  'logto_get_jwt_customizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetJwtCustomizer',
    'type' => 'read',
    'name' => 'Get JWT customizer',
    'description' => 'Get the JWT customizer for the given token type.',
    'icon' => 'ph:key',
  ),
  'logto_get_log' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetLog',
    'type' => 'read',
    'name' => 'Get log',
    'description' => 'Get log details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_logto_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetLogtoConfig',
    'type' => 'read',
    'name' => 'Get logto config',
    'description' => 'Retrieve the exposed portion of the current user\'s logto config. This includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
    'icon' => 'ph:key',
  ),
  'logto_get_mfa_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetMfaSettings',
    'type' => 'read',
    'name' => 'Get MFA settings',
    'description' => 'Get MFA settings for the user. This endpoint requires the Identities scope. Returns current MFA configuration preferences.',
    'icon' => 'ph:key',
  ),
  'logto_get_mfa_verifications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetMfaVerifications',
    'type' => 'read',
    'name' => 'Get MFA verifications',
    'description' => 'Get MFA verifications for the user.',
    'icon' => 'ph:key',
  ),
  'logto_get_new_user_counts' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetNewUserCounts',
    'type' => 'read',
    'name' => 'Get new user count',
    'description' => 'Get new user count in the past 7 days.',
    'icon' => 'ph:key',
  ),
  'logto_get_oidc_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOidcKeys',
    'type' => 'read',
    'name' => 'Get OIDC keys',
    'description' => 'Get OIDC signing keys by key type. The actual key will be redacted from the result.',
    'icon' => 'ph:key',
  ),
  'logto_get_oidc_session_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOidcSessionConfig',
    'type' => 'read',
    'name' => 'Get OIDC session config',
    'description' => 'Get the OIDC session configuration for the tenant.',
    'icon' => 'ph:key',
  ),
  'logto_get_one_time_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOneTimeToken',
    'type' => 'read',
    'name' => 'Get one-time token by ID',
    'description' => 'Get a one-time token by its ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOrganization',
    'type' => 'read',
    'name' => 'Get organization',
    'description' => 'Get organization details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_organization_invitation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOrganizationInvitation',
    'type' => 'read',
    'name' => 'Get organization invitation',
    'description' => 'Get an organization invitation by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_organization_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOrganizationRole',
    'type' => 'read',
    'name' => 'Get organization role',
    'description' => 'Get organization role details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_organization_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetOrganizationScope',
    'type' => 'read',
    'name' => 'Get organization scope',
    'description' => 'Get organization scope details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetProfile',
    'type' => 'read',
    'name' => 'Get profile',
    'description' => 'Get profile for the user.',
    'icon' => 'ph:key',
  ),
  'logto_get_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetResource',
    'type' => 'read',
    'name' => 'Get API resource',
    'description' => 'Get an API resource details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetRole',
    'type' => 'read',
    'name' => 'Get role',
    'description' => 'Get role details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_saml_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSamlApplication',
    'type' => 'read',
    'name' => 'Get SAML application',
    'description' => 'Get SAML application details by ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_saml_application_callback' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSamlApplicationCallback',
    'type' => 'read',
    'name' => 'SAML application callback',
    'description' => 'Handle the OIDC callback for SAML application and generate SAML response.',
    'icon' => 'ph:key',
  ),
  'logto_get_saml_authn' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSamlAuthn',
    'type' => 'read',
    'name' => 'Handle SAML authentication request (Redirect binding)',
    'description' => 'Process SAML authentication request using HTTP Redirect binding.',
    'icon' => 'ph:key',
  ),
  'logto_get_sessions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSessions',
    'type' => 'read',
    'name' => 'Get all active sessions',
    'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available. A logto-verification-id in header is required for checking sensitive session details.',
    'icon' => 'ph:key',
  ),
  'logto_get_sign_in_exp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSignInExp',
    'type' => 'read',
    'name' => 'Get default sign-in experience settings',
    'description' => 'Get the default sign-in experience settings.',
    'icon' => 'ph:key',
  ),
  'logto_get_sign_in_experience_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSignInExperienceConfig',
    'type' => 'read',
    'name' => 'Get full sign-in experience',
    'description' => 'Get the full sign-in experience configuration.',
    'icon' => 'ph:key',
  ),
  'logto_get_sign_in_experience_phrases' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSignInExperiencePhrases',
    'type' => 'read',
    'name' => 'Get localized phrases',
    'description' => 'Get localized phrases based on the specified language.',
    'icon' => 'ph:key',
  ),
  'logto_get_social_identity_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSocialIdentityAccessToken',
    'type' => 'read',
    'name' => 'Retrieve the access token issued by a third-party social provider',
    'description' => 'This API retrieves the access token issued by a third-party social provider for a given social target. Access is only available if token storage is enabled for the corresponding social connector. When a user authenticates through a social provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
    'icon' => 'ph:key',
  ),
  'logto_get_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSsoConnector',
    'type' => 'read',
    'name' => 'Get SSO connector',
    'description' => 'Get SSO connector data by ID. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
    'icon' => 'ph:key',
  ),
  'logto_get_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetStatus',
    'type' => 'read',
    'name' => 'Health check',
    'description' => 'The traditional health check API. No authentication needed. > **Note** > Even if 204 is returned, it does not guarantee all the APIs are working properly since they may depend on additional resources or external services.',
    'icon' => 'ph:key',
  ),
  'logto_get_swagger_json' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSwaggerJson',
    'type' => 'read',
    'name' => 'Get Swagger JSON',
    'description' => 'The endpoint for the current JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'icon' => 'ph:key',
  ),
  'logto_get_system_application_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetSystemApplicationConfig',
    'type' => 'read',
    'name' => 'Get the application constants',
    'description' => 'Get the application constants.',
    'icon' => 'ph:key',
  ),
  'logto_get_total_user_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetTotalUserCount',
    'type' => 'read',
    'name' => 'Get total user count',
    'description' => 'Get total user count in the current tenant.',
    'icon' => 'ph:key',
  ),
  'logto_get_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUser',
    'type' => 'read',
    'name' => 'Get user',
    'description' => 'Get user data for the given ID.',
    'icon' => 'ph:key',
  ),
  'logto_get_user_asset_service_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUserAssetServiceStatus',
    'type' => 'read',
    'name' => 'Get service status',
    'description' => 'Get user assets service status.',
    'icon' => 'ph:key',
  ),
  'logto_get_user_has_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUserHasPassword',
    'type' => 'read',
    'name' => 'Check if user has password',
    'description' => 'Check if the user with the given ID has a password set.',
    'icon' => 'ph:key',
  ),
  'logto_get_user_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUserIdentity',
    'type' => 'read',
    'name' => 'Retrieve a user\'s social identity and associated token storage ',
    'description' => 'This API retrieves the social identity and its associated token set for the specified user from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding social connector.',
    'icon' => 'ph:key',
  ),
  'logto_get_user_session' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUserSession',
    'type' => 'read',
    'name' => 'Get user active session',
    'description' => 'Retrieve a non-expired session for the user by session ID, including session metadata and interaction details when available.',
    'icon' => 'ph:key',
  ),
  'logto_get_user_sso_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetUserSsoIdentity',
    'type' => 'read',
    'name' => 'Retrieve a user\'s enterprise SSO identity and associated token secret (if token storage is enabled)',
    'description' => 'This API retrieves the user\'s enterprise SSO identity and associated token set record from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding SSO connector.',
    'icon' => 'ph:key',
  ),
  'logto_get_well_known_account_center' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetWellKnownAccountCenter',
    'type' => 'read',
    'name' => 'Get default account center',
    'description' => 'Get the default account center configuration.',
    'icon' => 'ph:key',
  ),
  'logto_get_well_known_experience' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetWellKnownExperience',
    'type' => 'read',
    'name' => 'Get full sign-in experience',
    'description' => 'Get the full sign-in experience configuration.',
    'icon' => 'ph:key',
  ),
  'logto_get_well_known_experience_openapi_json' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetWellKnownExperienceOpenapiJson',
    'type' => 'read',
    'name' => 'Get Experience API swagger JSON',
    'description' => 'The endpoint for the Experience API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'icon' => 'ph:key',
  ),
  'logto_get_well_known_management_openapi_json' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetWellKnownManagementOpenapiJson',
    'type' => 'read',
    'name' => 'Get Management API swagger JSON',
    'description' => 'The endpoint for the Management API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'icon' => 'ph:key',
  ),
  'logto_get_well_known_user_openapi_json' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoGetWellKnownUserOpenapiJson',
    'type' => 'read',
    'name' => 'Get User API swagger JSON',
    'description' => 'The endpoint for the User API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'icon' => 'ph:key',
  ),
  'logto_identify_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoIdentifyUser',
    'type' => 'write',
    'name' => 'Identify user for the current interaction',
    'description' => 'This API identifies the user based on the verificationId within the current experience interaction: - `SignIn` and `ForgotPassword` interactions: Verifies the user\'s identity using the provided `verificationId`. - `Register` interaction: Creates a new user account using the profile data from the current interaction. If a verificationId is provided, the profile data will first be updated with the verification record before creating the account. If not, the account is created directly from the sto',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_init_interaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoInitInteraction',
    'type' => 'write',
    'name' => 'Init new interaction',
    'description' => 'Init a new experience interaction with the given interaction type. Any existing interaction data will be cleared.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_list_application_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationOrganizations',
    'type' => 'read',
    'name' => 'Get application organizations',
    'description' => 'Get the list of organizations that an application is associated with.',
    'icon' => 'ph:key',
  ),
  'logto_list_application_protected_app_metadata_custom_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationProtectedAppMetadataCustomDomains',
    'type' => 'read',
    'name' => 'Get application custom domains',
    'description' => 'Get custom domains of the specified application, the application type should be protected app.',
    'icon' => 'ph:key',
  ),
  'logto_list_application_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationRoles',
    'type' => 'read',
    'name' => 'Get application API resource roles',
    'description' => 'Get API resource roles assigned to the specified application with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_application_secrets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationSecrets',
    'type' => 'read',
    'name' => 'Get application secrets',
    'description' => 'Get all the secrets for the application.',
    'icon' => 'ph:key',
  ),
  'logto_list_application_user_consent_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationUserConsentOrganizations',
    'type' => 'read',
    'name' => 'List all the user consented organizations of a application',
    'description' => 'List all the user consented organizations for a application by application id and user id.',
    'icon' => 'ph:key',
  ),
  'logto_list_application_user_consent_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplicationUserConsentScopes',
    'type' => 'read',
    'name' => 'List all the user consent scopes of an application',
    'description' => 'List all the user consent scopes of an application by application id',
    'icon' => 'ph:key',
  ),
  'logto_list_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListApplications',
    'type' => 'read',
    'name' => 'Get applications',
    'description' => 'Get applications that match the given query with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_connector_factories' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListConnectorFactories',
    'type' => 'read',
    'name' => 'Get connector factories',
    'description' => 'Get all connector factories data available in Logto.',
    'icon' => 'ph:key',
  ),
  'logto_list_connectors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListConnectors',
    'type' => 'read',
    'name' => 'Get connectors',
    'description' => 'Get all connectors in the current tenant.',
    'icon' => 'ph:key',
  ),
  'logto_list_custom_phrases' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListCustomPhrases',
    'type' => 'read',
    'name' => 'Get all custom phrases',
    'description' => 'Get all custom phrases for all languages.',
    'icon' => 'ph:key',
  ),
  'logto_list_custom_profile_fields' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListCustomProfileFields',
    'type' => 'read',
    'name' => 'Get all custom profile fields',
    'description' => 'Get all custom profile fields.',
    'icon' => 'ph:key',
  ),
  'logto_list_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListDomains',
    'type' => 'read',
    'name' => 'Get domains',
    'description' => 'Get all of your custom domains.',
    'icon' => 'ph:key',
  ),
  'logto_list_email_templates' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListEmailTemplates',
    'type' => 'read',
    'name' => 'Get email templates',
    'description' => 'Get the list of email templates.',
    'icon' => 'ph:key',
  ),
  'logto_list_hook_recent_logs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListHookRecentLogs',
    'type' => 'read',
    'name' => 'Get recent logs for a hook',
    'description' => 'Get recent logs that match the given query for the specified hook with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_hooks' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListHooks',
    'type' => 'read',
    'name' => 'Get hooks',
    'description' => 'Get a list of hooks with optional pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_jwt_customizers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListJwtCustomizers',
    'type' => 'read',
    'name' => 'Get all JWT customizers',
    'description' => 'Get all JWT customizers for the tenant.',
    'icon' => 'ph:key',
  ),
  'logto_list_logs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListLogs',
    'type' => 'read',
    'name' => 'Get logs',
    'description' => 'Get logs that match the given query with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_one_time_tokens' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOneTimeTokens',
    'type' => 'read',
    'name' => 'Get one-time tokens',
    'description' => 'Get a list of one-time tokens, filtering by email and status, with optional pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_application_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationApplicationRoles',
    'type' => 'read',
    'name' => 'Get organization application roles',
    'description' => 'Get roles associated with the application in the organization.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationApplications',
    'type' => 'read',
    'name' => 'Get organization applications',
    'description' => 'Get applications associated with the organization.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_invitations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationInvitations',
    'type' => 'read',
    'name' => 'Get organization invitations',
    'description' => 'Get organization invitations.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_jit_email_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationJitEmailDomains',
    'type' => 'read',
    'name' => 'Get organization JIT email domains',
    'description' => 'Get email domains for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_jit_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationJitRoles',
    'type' => 'read',
    'name' => 'Get organization JIT default roles',
    'description' => 'Get organization roles that will be assigned to users during just-in-time provisioning.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_jit_sso_connectors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationJitSsoConnectors',
    'type' => 'read',
    'name' => 'Get organization JIT SSO connectors',
    'description' => 'Get enterprise SSO connectors for just-in-time provisioning of users in the organization.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_role_resource_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationRoleResourceScopes',
    'type' => 'read',
    'name' => 'Get organization role resource scopes',
    'description' => 'Get resource scopes that are assigned to the specified organization role with optional pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_role_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationRoleScopes',
    'type' => 'read',
    'name' => 'Get organization role scopes',
    'description' => 'Get organization scopes that are assigned to the specified organization role with optional pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationRoles',
    'type' => 'read',
    'name' => 'Get organization roles',
    'description' => 'Get organization roles with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationScopes',
    'type' => 'read',
    'name' => 'Get organization scopes',
    'description' => 'Get organization scopes that match with optional pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_user_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationUserRoles',
    'type' => 'read',
    'name' => 'Get roles for a user in an organization',
    'description' => 'Get roles assigned to a user in the specified organization with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_user_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationUserScopes',
    'type' => 'read',
    'name' => 'Get scopes for a user in an organization tailored by the organization roles',
    'description' => 'Get scopes assigned to a user in the specified organization tailored by the organization roles. The scopes are derived from the organization roles assigned to the user.',
    'icon' => 'ph:key',
  ),
  'logto_list_organization_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizationUsers',
    'type' => 'read',
    'name' => 'Get organization user members',
    'description' => 'Get users that are members of the specified organization for the given query with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListOrganizations',
    'type' => 'read',
    'name' => 'Get organizations',
    'description' => 'Get organizations that match the given query with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_resource_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListResourceScopes',
    'type' => 'read',
    'name' => 'Get API resource scopes',
    'description' => 'Get scopes (permissions) defined for an API resource.',
    'icon' => 'ph:key',
  ),
  'logto_list_resources' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListResources',
    'type' => 'read',
    'name' => 'Get API resources',
    'description' => 'Get API resources in the current tenant with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_role_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListRoleApplications',
    'type' => 'read',
    'name' => 'Get role applications',
    'description' => 'Get applications that have the role assigned with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_role_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListRoleScopes',
    'type' => 'read',
    'name' => 'Get role scopes',
    'description' => 'Get API resource scopes (permissions) linked with a role.',
    'icon' => 'ph:key',
  ),
  'logto_list_role_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListRoleUsers',
    'type' => 'read',
    'name' => 'Get role users',
    'description' => 'Get users who have the role assigned with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListRoles',
    'type' => 'read',
    'name' => 'Get roles',
    'description' => 'Get roles with filters and pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_saml_application_metadata' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListSamlApplicationMetadata',
    'type' => 'read',
    'name' => 'Get SAML application metadata',
    'description' => 'Get the SAML metadata XML for the application.',
    'icon' => 'ph:key',
  ),
  'logto_list_saml_application_secrets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListSamlApplicationSecrets',
    'type' => 'read',
    'name' => 'List SAML application secrets',
    'description' => 'Get all signing certificates of the SAML application.',
    'icon' => 'ph:key',
  ),
  'logto_list_sso_connector_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListSsoConnectorProviders',
    'type' => 'read',
    'name' => 'List all the supported SSO connector provider details',
    'description' => 'Get a complete list of supported SSO connector providers.',
    'icon' => 'ph:key',
  ),
  'logto_list_sso_connectors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListSsoConnectors',
    'type' => 'read',
    'name' => 'List SSO connectors',
    'description' => 'Get SSO connectors with pagination. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_all_identities' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserAllIdentities',
    'type' => 'read',
    'name' => 'Retrieve social identities, enterprise SSO identities and associated token secret (if token storage is enabled) for a user',
    'description' => 'This API retrieves all identities (social and enterprise SSO) for a user, along with their associated token set records from the Logto Secret Vault. The token sets will only be available if token storage is enabled for the corresponding identity connector.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_custom_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserCustomData',
    'type' => 'read',
    'name' => 'Get user custom data',
    'description' => 'Get custom data for the given user ID.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_grants' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserGrants',
    'type' => 'read',
    'name' => 'Get user active grants',
    'description' => 'Retrieve all non-expired grants of the user. Optionally filter by application type via `appType`; when omitted, grants from all application types are returned.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_logto_configs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserLogtoConfigs',
    'type' => 'read',
    'name' => 'Get user logto config',
    'description' => 'Retrieve the exposed portion of a user\'s logto config. Includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped).',
    'icon' => 'ph:key',
  ),
  'logto_list_user_mfa_verifications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserMfaVerifications',
    'type' => 'read',
    'name' => 'Get user\'s MFA verifications',
    'description' => 'Get a user\'s existing MFA verifications for a given user ID.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserOrganizations',
    'type' => 'read',
    'name' => 'Get organizations for a user',
    'description' => 'Get all organizations that the user is a member of. In each organization object, the user\'s roles in that organization are included in the `organizationRoles` array.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_personal_access_tokens' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserPersonalAccessTokens',
    'type' => 'read',
    'name' => 'Get personal access tokens',
    'description' => 'Get all personal access tokens for the user.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserRoles',
    'type' => 'read',
    'name' => 'Get roles for user',
    'description' => 'Get API resource roles assigned to the user with pagination.',
    'icon' => 'ph:key',
  ),
  'logto_list_user_sessions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUserSessions',
    'type' => 'read',
    'name' => 'Get user active sessions',
    'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available.',
    'icon' => 'ph:key',
  ),
  'logto_list_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoListUsers',
    'type' => 'read',
    'name' => 'Get users',
    'description' => 'Get users with filters and pagination. Logto provides a very flexible way to query users. You can filter users by almost any fields with multiple modes. To learn more about the query syntax, please refer to [Advanced user search](https://docs.logto.io/docs/recipes/manage-users/advanced-user-search/).',
    'icon' => 'ph:key',
  ),
  'logto_mark_mfa_enabled' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoMarkMfaEnabled',
    'type' => 'write',
    'name' => 'Mark MFA as enabled',
    'description' => 'Mark the user\'s MFA as enabled for the current interaction and persist in DB user configs upon successful submission.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_application_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceApplicationRoles',
    'type' => 'write',
    'name' => 'Update API resource roles for application',
    'description' => 'Update API resource roles assigned to the specified application. This will replace the existing API resource roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_application_sign_in_experience' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceApplicationSignInExperience',
    'type' => 'write',
    'name' => 'Update application level sign-in experience',
    'description' => 'Update application level sign-in experience for the specified application. Create a new sign-in experience if it does not exist. - Only branding properties and terms links customization is supported for now. - Only third-party applications can be customized for now. - Application level sign-in experience customization is optional, if provided, it will override the default branding and terms links.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_application_user_consent_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceApplicationUserConsentOrganizations',
    'type' => 'write',
    'name' => 'Grant a list of organization access of a user for a application',
    'description' => 'Grant a list of organization access of a user for a application by application id and user id. The user must be a member of all the organizations. Only third-party application needs to be granted access to organizations, all the other applications can request for all the organizations\' access by default.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_custom_phrase' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceCustomPhrase',
    'type' => 'write',
    'name' => 'Upsert custom phrases',
    'description' => 'Upsert custom phrases for the specified language tag. Upsert means that if the custom phrases already exist, they will be updated. Otherwise, they will be created.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_email_templates' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceEmailTemplates',
    'type' => 'write',
    'name' => 'Replace email templates',
    'description' => 'Create or replace a list of email templates. If an email template with the same language tag and template type already exists, its details will be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_one_time_token_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOneTimeTokenStatus',
    'type' => 'write',
    'name' => 'Update one-time token status',
    'description' => 'Update the status of a one-time token by its ID. This can be used to mark the token as consumed or expired.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_application_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationApplicationRoles',
    'type' => 'write',
    'name' => 'Replace organization application roles',
    'description' => 'Replace all roles associated with the application in the organization with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_applications' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationApplications',
    'type' => 'write',
    'name' => 'Replace organization applications',
    'description' => 'Replace all applications associated with the organization with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_invitation_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationInvitationStatus',
    'type' => 'write',
    'name' => 'Update organization invitation status',
    'description' => 'Update the status of an organization invitation by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_jit_email_domains' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationJitEmailDomains',
    'type' => 'write',
    'name' => 'Replace organization JIT email domains',
    'description' => 'Replace all just-in-time provisioning email domains for the organization with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_jit_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationJitRoles',
    'type' => 'write',
    'name' => 'Replace organization JIT default roles',
    'description' => 'Replace all organization roles that will be assigned to users during just-in-time provisioning with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_jit_sso_connectors' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationJitSsoConnectors',
    'type' => 'write',
    'name' => 'Replace organization JIT SSO connectors',
    'description' => 'Replace all enterprise SSO connectors for just-in-time provisioning of users in the organization with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_role_resource_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationRoleResourceScopes',
    'type' => 'write',
    'name' => 'Replace resource scopes for organization role',
    'description' => 'Replace all resource scopes that are assigned to the specified organization role with the given resource scopes. This effectively removes all existing organization scope assignments and replaces them with the new ones.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_role_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationRoleScopes',
    'type' => 'write',
    'name' => 'Replace organization scopes for organization role',
    'description' => 'Replace all organization scopes that are assigned to the specified organization role with the given organization scopes. This effectively removes all existing organization scope assignments and replaces them with the new ones.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_user_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationUserRoles',
    'type' => 'write',
    'name' => 'Update roles for a user in an organization',
    'description' => 'Update roles assigned to a user in the specified organization with the provided data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_organization_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceOrganizationUsers',
    'type' => 'write',
    'name' => 'Replace organization user members',
    'description' => 'Replace all user members for the specified organization with the given users. This effectively removing all existing user memberships in the organization and adding the new users as members.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_user_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceUserIdentity',
    'type' => 'write',
    'name' => 'Update social identity of user',
    'description' => 'Directly update a social identity of the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_replace_user_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoReplaceUserRoles',
    'type' => 'write',
    'name' => 'Update roles for user',
    'description' => 'Update API resource roles assigned to the user. This will replace the existing roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_reset_user_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoResetUserPassword',
    'type' => 'write',
    'name' => 'Reset user password',
    'description' => 'Reset the user\'s password. (`ForgotPassword` interaction only)',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_rotate_oidc_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoRotateOidcKeys',
    'type' => 'write',
    'name' => 'Rotate OIDC keys',
    'description' => 'A new key will be generated and prepend to the list of keys. Only two recent keys will be kept. The oldest key will be automatically removed if there are more than two keys.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_skip_mfa_binding_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoSkipMfaBindingFlow',
    'type' => 'write',
    'name' => 'Skip MFA binding flow',
    'description' => 'Skip MFA verification binding flow. If the MFA is enabled in the sign-in experience settings and marked as `UserControlled`, the user can skip the MFA verification binding flow by calling this API.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_skip_mfa_suggestion' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoSkipMfaSuggestion',
    'type' => 'write',
    'name' => 'Skip additional MFA suggestion',
    'description' => 'Mark the optional additional MFA binding suggestion as skipped for the current interaction. When multiple MFA factors are enabled and only an email/phone factor is configured, a suggestion to add another factor may be shown; this endpoint records the choice to skip.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_skip_passkey_binding' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoSkipPasskeyBinding',
    'type' => 'write',
    'name' => 'Skip passkey binding',
    'description' => 'Skip passkey binding flow. The users can temporarily skip the passkey binding flow by calling this API during sign-up. On sign-in, the skip flag will be persisted to user config.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_submit_interaction' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoSubmitInteraction',
    'type' => 'write',
    'name' => 'Submit interaction',
    'description' => 'Submit the current interaction. - Submit the verified user identity to the OIDC provider for further authentication (SignIn and Register). - Update the user\'s profile data if any (SignIn and Register). - Reset the password and clear all the interaction records (ForgotPassword).',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_test_jwt_customizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoTestJwtCustomizer',
    'type' => 'write',
    'name' => 'Test JWT customizer',
    'description' => 'Test the JWT customizer script with the given sample context and sample token payload.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_account_center_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateAccountCenterSettings',
    'type' => 'write',
    'name' => 'Update account center settings',
    'description' => 'Update the account center settings with the provided settings.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_admin_console_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateAdminConsoleConfig',
    'type' => 'write',
    'name' => 'Update admin console config',
    'description' => 'Update the global configuration object for Logto Console. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateApplication',
    'type' => 'write',
    'name' => 'Update application',
    'description' => 'Update application details by ID with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_application_custom_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateApplicationCustomData',
    'type' => 'write',
    'name' => 'Update application custom data',
    'description' => 'Update the custom data of an application.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateApplicationSecret',
    'type' => 'write',
    'name' => 'Update application secret',
    'description' => 'Update a secret for the application by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_captcha_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateCaptchaProvider',
    'type' => 'write',
    'name' => 'Update captcha provider',
    'description' => 'Update the captcha provider with the provided settings.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateConnector',
    'type' => 'write',
    'name' => 'Update connector',
    'description' => 'Update connector by ID with the given data. This methods performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_custom_profile_field_by_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateCustomProfileFieldByName',
    'type' => 'write',
    'name' => 'Update a custom profile field by name',
    'description' => 'Update a custom profile field by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_custom_profile_fields_sie_order' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateCustomProfileFieldsSieOrder',
    'type' => 'write',
    'name' => 'Update the display order of the custom profile fields in Sign-in Experience',
    'description' => 'Update the display order of the custom profile fields in Sign-in Experience.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_email_template_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateEmailTemplateDetails',
    'type' => 'write',
    'name' => 'Update email template details',
    'description' => 'Update the details of an email template by its ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_hook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateHook',
    'type' => 'write',
    'name' => 'Update hook',
    'description' => 'Update hook details by ID with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_hook_signing_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateHookSigningKey',
    'type' => 'write',
    'name' => 'Update signing key for a hook',
    'description' => 'Update the signing key for the specified hook.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_interaction_event' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateInteractionEvent',
    'type' => 'write',
    'name' => 'Update interaction event',
    'description' => 'Update the current experience interaction event to the given event type. This API is used to switch the interaction event between `SignIn` and `Register`, while keeping all the verification records data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_jwt_customizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateJwtCustomizer',
    'type' => 'write',
    'name' => 'Update JWT customizer',
    'description' => 'Update the JWT customizer for the given token type.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_logto_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateLogtoConfig',
    'type' => 'write',
    'name' => 'Update logto config',
    'description' => 'Update the exposed portion of the current user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_mfa_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateMfaSettings',
    'type' => 'write',
    'name' => 'Update MFA settings',
    'description' => 'Update MFA settings for the user. This endpoint requires identity verification and the Identities scope. Controls whether MFA verification is required during sign-in when the user has MFA configured.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_mfa_verification_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateMfaVerificationName',
    'type' => 'write',
    'name' => 'Update a MFA verification name',
    'description' => 'Update a MFA verification name, a logto-verification-id in header is required for checking sensitive permissions. Only WebAuthn is supported for now.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_oidc_session_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateOidcSessionConfig',
    'type' => 'write',
    'name' => 'Update OIDC session config',
    'description' => 'Update the OIDC session configuration for the tenant. This method performs a partial update. If the configuration does not exist, it will be created.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateOrganization',
    'type' => 'write',
    'name' => 'Update organization',
    'description' => 'Update organization details by ID with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_organization_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateOrganizationRole',
    'type' => 'write',
    'name' => 'Update organization role',
    'description' => 'Update organization role details by ID with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_organization_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateOrganizationScope',
    'type' => 'write',
    'name' => 'Update organization scope',
    'description' => 'Update organization scope details by ID with the given data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_other_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateOtherProfile',
    'type' => 'write',
    'name' => 'Update other profile',
    'description' => 'Update other profile for the user, only the fields that are passed in will be updated, to update the address, the user must have the address scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdatePassword',
    'type' => 'write',
    'name' => 'Update password',
    'description' => 'Update password for the user, a logto-verification-id in header is required for checking sensitive permissions.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_personal_access_token_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdatePersonalAccessTokenName',
    'type' => 'write',
    'name' => 'Update personal access token',
    'description' => 'Update a token for the user by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_primary_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdatePrimaryEmail',
    'type' => 'write',
    'name' => 'Update primary email',
    'description' => 'Update primary email for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new email ownership verification.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_primary_phone' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdatePrimaryPhone',
    'type' => 'write',
    'name' => 'Update primary phone',
    'description' => 'Update primary phone for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new phone ownership verification.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateProfile',
    'type' => 'write',
    'name' => 'Update profile',
    'description' => 'Update profile for the user, only the fields that are passed in will be updated. Updating or deleting username requires a logto-verification-id header for checking sensitive permissions. Removing any sign-in identifier, including username, is rejected if it would remove the user\'s last identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateResource',
    'type' => 'write',
    'name' => 'Update API resource',
    'description' => 'Update an API resource details by ID with the given data. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_resource_is_default' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateResourceIsDefault',
    'type' => 'write',
    'name' => 'Set API resource as default',
    'description' => 'Set an API resource as the default resource for the current tenant. Each tenant can have only one default API resource. If an API resource is set as default, the previously set default API resource will be set as non-default. See [this section](https://docs.logto.io/docs/references/resources/#default-api) for more information.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_resource_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateResourceScope',
    'type' => 'write',
    'name' => 'Update API resource scope',
    'description' => 'Update an API resource scope (permission) for the given resource. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateRole',
    'type' => 'write',
    'name' => 'Update role',
    'description' => 'Update role details. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_saml_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateSamlApplication',
    'type' => 'write',
    'name' => 'Update SAML application',
    'description' => 'Update SAML application details by ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_saml_application_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateSamlApplicationSecret',
    'type' => 'write',
    'name' => 'Update SAML application secret',
    'description' => 'Update the status of a signing certificate.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_sign_in_exp' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateSignInExp',
    'type' => 'write',
    'name' => 'Update default sign-in experience settings',
    'description' => 'Update the default sign-in experience settings with the provided data.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_social_identity_access_token_by_verification_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateSocialIdentityAccessTokenByVerificationId',
    'type' => 'write',
    'name' => 'Update the access token for a social identity by verification ID',
    'description' => 'This API updates the token storage for a social identity by a given social verification ID. It is used to fetch a new access token from the social provider and store it securely in Logto.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_sso_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateSsoConnector',
    'type' => 'write',
    'name' => 'Update SSO connector',
    'description' => 'Update an SSO connector by ID. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUser',
    'type' => 'write',
    'name' => 'Update user',
    'description' => 'Update user data for the given ID. This method performs a partial update.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_custom_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserCustomData',
    'type' => 'write',
    'name' => 'Update user custom data',
    'description' => 'Update custom data for the given user ID. This method performs a partial update of the custom data object.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_is_suspended' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserIsSuspended',
    'type' => 'write',
    'name' => 'Update user suspension status',
    'description' => 'Update user suspension status for the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_logto_configs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserLogtoConfigs',
    'type' => 'write',
    'name' => 'Update user logto config',
    'description' => 'Update the exposed portion of a user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped). All fields are optional - only provided fields will be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserPassword',
    'type' => 'write',
    'name' => 'Update user password',
    'description' => 'Update user password for the given ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_personal_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserPersonalAccessToken',
    'type' => 'write',
    'name' => 'Update personal access token',
    'description' => 'Update a token for the user by name using the legacy path parameter. Deprecated: use the PATCH /personal-access-tokens endpoint instead to avoid url name encoding issues.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_update_user_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpdateUserProfile',
    'type' => 'write',
    'name' => 'Update user profile',
    'description' => 'Update profile for the given user ID. This method performs a partial update of the profile object.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_upload_custom_ui_assets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUploadCustomUiAssets',
    'type' => 'write',
    'name' => 'Upload custom UI assets',
    'description' => 'Upload a zip file containing custom web assets such as HTML, CSS, and JavaScript files, then replace the default sign-in experience with the custom UI assets.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_upsert_id_token_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpsertIdTokenConfig',
    'type' => 'write',
    'name' => 'Upsert ID token claims configuration',
    'description' => 'Create or update the ID token extended claims configuration for the tenant. This controls which extended claims are included in ID tokens when the corresponding scopes are requested.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_upsert_jwt_customizer' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoUpsertJwtCustomizer',
    'type' => 'write',
    'name' => 'Create or update JWT customizer',
    'description' => 'Create or update a JWT customizer for the given token type.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_backup_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyBackupCode',
    'type' => 'write',
    'name' => 'Verify backup code',
    'description' => 'Create a new BackupCode verification record and verify the provided backup code against the user\'s backup codes. The verification record will be marked as verified if the code is correct.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_enterprise_sso_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyEnterpriseSsoVerification',
    'type' => 'write',
    'name' => 'Verify enterprise SSO verification',
    'description' => 'Verify the SSO authorization response data and get the user\'s identity from the SSO provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_mfa_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyMfaVerificationCode',
    'type' => 'write',
    'name' => 'Verify MFA verification code',
    'description' => 'Verify the provided MFA verification code. The verification code must have been sent using the MFA verification code endpoint. This endpoint verifies the code against the user\'s bound identifier and marks the verification as complete if successful.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_one_time_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyOneTimeToken',
    'type' => 'write',
    'name' => 'Verify one-time token',
    'description' => 'Verify a one-time token associated with an email address. If the token is valid and not expired, it will be marked as consumed.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_one_time_token_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyOneTimeTokenVerification',
    'type' => 'write',
    'name' => 'Verify one-time token',
    'description' => 'Verify the provided one-time token against the user\'s email. If successful, the verification record will be marked as verified.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_sign_in_passkey_authentication' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifySignInPasskeyAuthentication',
    'type' => 'write',
    'name' => 'Verify passkey sign-in WebAuthn authentication',
    'description' => 'Verify the passkey sign-in WebAuthn authentication response against the stored authentication challenge. When `verificationId` is provided, it verifies against the challenge generated by the identifier-based authentication endpoint. When omitted, it verifies against the preflight authentication options stored in the interaction. Upon successful verification, the verification record will be marked as verified and the user will be resolved by the credential if not provided earlier.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_social_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifySocialVerification',
    'type' => 'write',
    'name' => 'Verify social verification',
    'description' => 'Verify the social authorization response data and get the user\'s identity data from the social provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_totp_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyTotpVerification',
    'type' => 'write',
    'name' => 'Verify TOTP verification',
    'description' => 'Verifies the provided TOTP code against the new created TOTP secret or the existing TOTP secret. If a verificationId is provided, this API will verify the code against the TOTP secret that is associated with the verification record. Otherwise, a new TOTP verification record will be created and verified against the user\'s existing TOTP secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_user_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyUserPassword',
    'type' => 'write',
    'name' => 'Verify user password',
    'description' => 'Test if the given password matches the user\'s password.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_verification_by_social' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyVerificationBySocial',
    'type' => 'write',
    'name' => 'Verify a social verification record',
    'description' => 'Verify a social verification record by callback connector data, and save the user information to the record.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_verification_by_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyVerificationByVerificationCode',
    'type' => 'write',
    'name' => 'Verify verification code',
    'description' => 'Verify the provided verification code against the identifier. If successful, the verification record will be marked as verified.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_verification_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyVerificationCode',
    'type' => 'write',
    'name' => 'Verify a verification code',
    'description' => 'Verify a verification code for a specified identifier. if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_verification_code_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyVerificationCodeVerification',
    'type' => 'write',
    'name' => 'Verify verification code',
    'description' => 'Verify the provided verification code against the user\'s identifier. If successful, the verification record will be marked as verified.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_web_authn_authentication_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyWebAuthnAuthenticationVerification',
    'type' => 'write',
    'name' => 'Verify WebAuthn authentication verification',
    'description' => 'Verifies the WebAuthn authentication response against the user\'s authentication challenge. Upon successful verification, the verification record will be marked as verified.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_web_authn_registration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyWebAuthnRegistration',
    'type' => 'write',
    'name' => 'Verify WebAuthn registration',
    'description' => 'Verify the WebAuthn registration by the user\'s response.',
    'icon' => 'ph:pencil-simple',
  ),
  'logto_verify_web_authn_registration_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Logto\\Tools\\LogtoVerifyWebAuthnRegistrationVerification',
    'type' => 'write',
    'name' => 'Verify WebAuthn registration verification',
    'description' => 'Verify the WebAuthn registration response against the user\'s WebAuthn registration challenge. If the response is valid, the WebAuthn registration record will be marked as verified.',
    'icon' => 'ph:pencil-simple',
  ),
); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/logto.md'; } public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime context from the host. */ private function resolveService(array $context=[]): LogtoService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new LogtoService(clientId:$creds->get('logto','client_id','',$account), clientSecret:$creds->get('logto','client_secret','',$account), accessToken:$creds->get('logto','access_token','',$account), baseUrl:$creds->get('logto','base_url','https://tenant.logto.app',$account), tokenUrl:$creds->get('logto','token_url','',$account), resource:$creds->get('logto','resource','',$account), scope:$creds->get('logto','scope','all',$account));} return app(LogtoService::class); }
}