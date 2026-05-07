<?php

namespace OpenCompany\Integrations\Logto;

/**
 * Official Logto OpenAPI operation metadata.
 *
 * Generated from the public Logto API references OpenAPI source.
 */
class LogtoOperations
{
    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        return array (
  'logto_add_mfa_verification' =>
  array (
    'slug' => 'logto_add_mfa_verification',
    'class' => 'LogtoAddMfaVerification',
    'method' => 'POST',
    'path' => '/api/my-account/mfa-verifications',
    'operation_id' => 'AddMfaVerification',
    'summary' => 'Add a MFA verification',
    'description' => 'Add a MFA verification to the user, a logto-verification-id in header is required for checking sensitive permissions.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_add_one_time_tokens' =>
  array (
    'slug' => 'logto_add_one_time_tokens',
    'class' => 'LogtoAddOneTimeTokens',
    'method' => 'POST',
    'path' => '/api/one-time-tokens',
    'operation_id' => 'AddOneTimeTokens',
    'summary' => 'Create one-time token',
    'description' => 'Create a new one-time token associated with an email address. The token can be used for verification purposes and has an expiration time.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_add_organization_applications' =>
  array (
    'slug' => 'logto_add_organization_applications',
    'class' => 'LogtoAddOrganizationApplications',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/applications',
    'operation_id' => 'AddOrganizationApplications',
    'summary' => 'Add organization application',
    'description' => 'Add an application to the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_add_organization_users' =>
  array (
    'slug' => 'logto_add_organization_users',
    'class' => 'LogtoAddOrganizationUsers',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/users',
    'operation_id' => 'AddOrganizationUsers',
    'summary' => 'Add user members to organization',
    'description' => 'Add users as members to the specified organization with the given user IDs.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_add_user_identities' =>
  array (
    'slug' => 'logto_add_user_identities',
    'class' => 'LogtoAddUserIdentities',
    'method' => 'POST',
    'path' => '/api/my-account/identities',
    'operation_id' => 'AddUserIdentities',
    'summary' => 'Add a user identity',
    'description' => 'Add an identity (social identity) to the user, a logto-verification-id in header is required for checking sensitive permissions, and a verification record for the social identity is required.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_add_user_profile' =>
  array (
    'slug' => 'logto_add_user_profile',
    'class' => 'LogtoAddUserProfile',
    'method' => 'POST',
    'path' => '/api/experience/profile',
    'operation_id' => 'AddUserProfile',
    'summary' => 'Add user profile',
    'description' => 'Adds user profile data to the current experience interaction. - For `Register`: The profile data provided before the identification request will be used to create a new user account. - For `SignIn` and `Register`: The profile data provided after the user is identified will be used to update the user\'s profile when the interaction is submitted. - `ForgotPassword`: Not supported.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assert_saml' =>
  array (
    'slug' => 'logto_assert_saml',
    'class' => 'LogtoAssertSaml',
    'method' => 'POST',
    'path' => '/api/authn/saml/{connectorId}',
    'operation_id' => 'AssertSaml',
    'summary' => 'SAML ACS endpoint (social)',
    'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) social connectors. SAML social connectors are deprecated. Use the SSO SAML connector instead.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assert_single_sign_on_saml' =>
  array (
    'slug' => 'logto_assert_single_sign_on_saml',
    'class' => 'LogtoAssertSingleSignOnSaml',
    'method' => 'POST',
    'path' => '/api/authn/single-sign-on/saml/{connectorId}',
    'operation_id' => 'AssertSingleSignOnSaml',
    'summary' => 'SAML ACS endpoint (SSO)',
    'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) single sign-on (SSO) connectors. This endpoint is used to complete the SAML SSO authentication flow. It receives the SAML assertion response from the identity provider (IdP) and redirects the user to complete the authentication flow.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_application_roles' =>
  array (
    'slug' => 'logto_assign_application_roles',
    'class' => 'LogtoAssignApplicationRoles',
    'method' => 'POST',
    'path' => '/api/applications/{applicationId}/roles',
    'operation_id' => 'AssignApplicationRoles',
    'summary' => 'Assign API resource roles to application',
    'description' => 'Assign API resource roles to the specified application. The API resource roles will be added to the existing API resource roles.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_organization_roles_to_application' =>
  array (
    'slug' => 'logto_assign_organization_roles_to_application',
    'class' => 'LogtoAssignOrganizationRolesToApplication',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
    'operation_id' => 'AssignOrganizationRolesToApplication',
    'summary' => 'Add organization application role',
    'description' => 'Add a role to the application in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_organization_roles_to_applications' =>
  array (
    'slug' => 'logto_assign_organization_roles_to_applications',
    'class' => 'LogtoAssignOrganizationRolesToApplications',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/applications/roles',
    'operation_id' => 'AssignOrganizationRolesToApplications',
    'summary' => 'Assign roles to applications in an organization',
    'description' => 'Assign roles to applications in the specified organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_organization_roles_to_user' =>
  array (
    'slug' => 'logto_assign_organization_roles_to_user',
    'class' => 'LogtoAssignOrganizationRolesToUser',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/users/{userId}/roles',
    'operation_id' => 'AssignOrganizationRolesToUser',
    'summary' => 'Assign roles to a user in an organization',
    'description' => 'Assign roles to a user in the specified organization with the provided data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_organization_roles_to_users' =>
  array (
    'slug' => 'logto_assign_organization_roles_to_users',
    'class' => 'LogtoAssignOrganizationRolesToUsers',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/users/roles',
    'operation_id' => 'AssignOrganizationRolesToUsers',
    'summary' => 'Assign roles to organization user members',
    'description' => 'Assign roles to user members of the specified organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_assign_user_roles' =>
  array (
    'slug' => 'logto_assign_user_roles',
    'class' => 'LogtoAssignUserRoles',
    'method' => 'POST',
    'path' => '/api/users/{userId}/roles',
    'operation_id' => 'AssignUserRoles',
    'summary' => 'Assign roles to user',
    'description' => 'Assign API resource roles to the user. The roles will be added to the existing roles.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_bind_mfa_verification' =>
  array (
    'slug' => 'logto_bind_mfa_verification',
    'class' => 'LogtoBindMfaVerification',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa',
    'operation_id' => 'BindMfaVerification',
    'summary' => 'Bind MFA verification by verificationId',
    'description' => 'Bind new MFA verification to the user profile using the verificationId.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_bind_passkey' =>
  array (
    'slug' => 'logto_bind_passkey',
    'class' => 'LogtoBindPasskey',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa/passkey',
    'operation_id' => 'BindPasskey',
    'summary' => 'Bind passkey for sign-in',
    'description' => 'Bind a WebAuthn credential as a passkey for sign-in purposes. Unlike `POST /api/experience/profile/mfa` with `type: WebAuthn`, this endpoint is exclusively for adding a passkey as a sign-in method and does NOT mark the user\'s optional MFA as enabled.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_check_password_with_default_sign_in_experience' =>
  array (
    'slug' => 'logto_check_password_with_default_sign_in_experience',
    'class' => 'LogtoCheckPasswordWithDefaultSignInExperience',
    'method' => 'POST',
    'path' => '/api/sign-in-exp/default/check-password',
    'operation_id' => 'CheckPasswordWithDefaultSignInExperience',
    'summary' => 'Check if a password meets the password policy',
    'description' => 'Check if a password meets the password policy in the sign-in experience settings.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_cleanup_domains' =>
  array (
    'slug' => 'logto_cleanup_domains',
    'class' => 'LogtoCleanupDomains',
    'method' => 'POST',
    'path' => '/api/domains/cleanup',
    'operation_id' => 'CleanupDomains',
    'summary' => 'Cleanup stale domains',
    'description' => 'Clean up custom domains that have been inactive (not verified) for a specified number of days. This uses Cloudflare as the source of truth to determine domain activity.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_and_send_mfa_verification_code' =>
  array (
    'slug' => 'logto_create_and_send_mfa_verification_code',
    'class' => 'LogtoCreateAndSendMfaVerificationCode',
    'method' => 'POST',
    'path' => '/api/experience/verification/mfa-verification-code',
    'operation_id' => 'CreateAndSendMfaVerificationCode',
    'summary' => 'Create and send MFA verification code',
    'description' => 'Create a new MFA verification code and send it to the user\'s bound identifier (email or phone). This endpoint automatically uses the user\'s bound email address or phone number from their profile for MFA verification. The user must be identified before calling this endpoint.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_and_send_verification_code' =>
  array (
    'slug' => 'logto_create_and_send_verification_code',
    'class' => 'LogtoCreateAndSendVerificationCode',
    'method' => 'POST',
    'path' => '/api/experience/verification/verification-code',
    'operation_id' => 'CreateAndSendVerificationCode',
    'summary' => 'Create and send verification code',
    'description' => 'Create a new `CodeVerification` record and sends the code to the specified identifier. The code verification can be used to verify the given identifier.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_application' =>
  array (
    'slug' => 'logto_create_application',
    'class' => 'LogtoCreateApplication',
    'method' => 'POST',
    'path' => '/api/applications',
    'operation_id' => 'CreateApplication',
    'summary' => 'Create an application',
    'description' => 'Create a new application with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_application_protected_app_metadata_custom_domain' =>
  array (
    'slug' => 'logto_create_application_protected_app_metadata_custom_domain',
    'class' => 'LogtoCreateApplicationProtectedAppMetadataCustomDomain',
    'method' => 'POST',
    'path' => '/api/applications/{id}/protected-app-metadata/custom-domains',
    'operation_id' => 'CreateApplicationProtectedAppMetadataCustomDomain',
    'summary' => 'Add a custom domain to the application',
    'description' => 'Add a custom domain to the application. You\'ll need to setup DNS record later.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_application_secret' =>
  array (
    'slug' => 'logto_create_application_secret',
    'class' => 'LogtoCreateApplicationSecret',
    'method' => 'POST',
    'path' => '/api/applications/{id}/secrets',
    'operation_id' => 'CreateApplicationSecret',
    'summary' => 'Add application secret',
    'description' => 'Add a new secret for the application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_application_user_consent_organization' =>
  array (
    'slug' => 'logto_create_application_user_consent_organization',
    'class' => 'LogtoCreateApplicationUserConsentOrganization',
    'method' => 'POST',
    'path' => '/api/applications/{id}/users/{userId}/consent-organizations',
    'operation_id' => 'CreateApplicationUserConsentOrganization',
    'summary' => 'Grant a list of organization access of a user for a application',
    'description' => 'Grant a list of organization access of a user for a application by application id and user id. The user must be a member of all the organizations. Only third-party application needs to be granted access to organizations, all the other applications can request for all the organizations\' access by default.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_application_user_consent_scope' =>
  array (
    'slug' => 'logto_create_application_user_consent_scope',
    'class' => 'LogtoCreateApplicationUserConsentScope',
    'method' => 'POST',
    'path' => '/api/applications/{applicationId}/user-consent-scopes',
    'operation_id' => 'CreateApplicationUserConsentScope',
    'summary' => 'Assign user consent scopes to application',
    'description' => 'Assign the user consent scopes to an application by application id',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_connector' =>
  array (
    'slug' => 'logto_create_connector',
    'class' => 'LogtoCreateConnector',
    'method' => 'POST',
    'path' => '/api/connectors',
    'operation_id' => 'CreateConnector',
    'summary' => 'Create connector',
    'description' => 'Create a connector with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_connector_authorization_uri' =>
  array (
    'slug' => 'logto_create_connector_authorization_uri',
    'class' => 'LogtoCreateConnectorAuthorizationUri',
    'method' => 'POST',
    'path' => '/api/connectors/{connectorId}/authorization-uri',
    'operation_id' => 'CreateConnectorAuthorizationUri',
    'summary' => 'Get connector\'s authorization URI',
    'description' => 'Get authorization URI for specified connector by providing redirect URI and randomly generated state.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_connector_test' =>
  array (
    'slug' => 'logto_create_connector_test',
    'class' => 'LogtoCreateConnectorTest',
    'method' => 'POST',
    'path' => '/api/connectors/{factoryId}/test',
    'operation_id' => 'CreateConnectorTest',
    'summary' => 'Test passwordless connector',
    'description' => 'Test a passwordless (email or SMS) connector by sending a test message to the given phone number or email address.',
    'parameters' =>
    array (
      'factory_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the factory.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'factoryId' => 'factory_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_custom_profile_field' =>
  array (
    'slug' => 'logto_create_custom_profile_field',
    'class' => 'LogtoCreateCustomProfileField',
    'method' => 'POST',
    'path' => '/api/custom-profile-fields',
    'operation_id' => 'CreateCustomProfileField',
    'summary' => 'Create a custom profile field',
    'description' => 'Create a custom profile field.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_custom_profile_fields_batch' =>
  array (
    'slug' => 'logto_create_custom_profile_fields_batch',
    'class' => 'LogtoCreateCustomProfileFieldsBatch',
    'method' => 'POST',
    'path' => '/api/custom-profile-fields/batch',
    'operation_id' => 'CreateCustomProfileFieldsBatch',
    'summary' => 'Batch create custom profile fields',
    'description' => 'Create multiple custom profile fields in a single request (max 20 items).',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_domain' =>
  array (
    'slug' => 'logto_create_domain',
    'class' => 'LogtoCreateDomain',
    'method' => 'POST',
    'path' => '/api/domains',
    'operation_id' => 'CreateDomain',
    'summary' => 'Create domain',
    'description' => 'Create a new domain with the given data. The maximum domain number is 1, once created, can not be modified, you\'ll have to delete and recreate one.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_enterprise_sso_verification' =>
  array (
    'slug' => 'logto_create_enterprise_sso_verification',
    'class' => 'LogtoCreateEnterpriseSsoVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/sso/{connectorId}/authorization-uri',
    'operation_id' => 'CreateEnterpriseSsoVerification',
    'summary' => 'Create enterprise SSO verification',
    'description' => 'Create a new EnterpriseSSO verification record and return the provider\'s authorization URI for the given connector.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_hook' =>
  array (
    'slug' => 'logto_create_hook',
    'class' => 'LogtoCreateHook',
    'method' => 'POST',
    'path' => '/api/hooks',
    'operation_id' => 'CreateHook',
    'summary' => 'Create a hook',
    'description' => 'Create a new hook with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_hook_test' =>
  array (
    'slug' => 'logto_create_hook_test',
    'class' => 'LogtoCreateHookTest',
    'method' => 'POST',
    'path' => '/api/hooks/{id}/test',
    'operation_id' => 'CreateHookTest',
    'summary' => 'Test hook',
    'description' => 'Test the specified hook with the given events and config.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_new_password_identity_verification' =>
  array (
    'slug' => 'logto_create_new_password_identity_verification',
    'class' => 'LogtoCreateNewPasswordIdentityVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/new-password-identity',
    'operation_id' => 'CreateNewPasswordIdentityVerification',
    'summary' => 'Create new password identity verification',
    'description' => 'Create a NewPasswordIdentity verification record for the new user registration use. The verification record includes a unique user identifier and a password that can be used to create a new user account.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_or_replace_totp_mfa_verification' =>
  array (
    'slug' => 'logto_create_or_replace_totp_mfa_verification',
    'class' => 'LogtoCreateOrReplaceTotpMfaVerification',
    'method' => 'PUT',
    'path' => '/api/my-account/mfa-verifications/totp',
    'operation_id' => 'CreateOrReplaceTotpMfaVerification',
    'summary' => 'Create or replace the authenticator app',
    'description' => 'Create or replace the user\'s TOTP MFA verification with a new authenticator app binding. If the user already has a TOTP verification, it will be replaced; otherwise, a new one will be created. Requires a logto-verification-id header for sensitive permission checks, a valid TOTP secret, and a valid TOTP code generated from the secret.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization' =>
  array (
    'slug' => 'logto_create_organization',
    'class' => 'LogtoCreateOrganization',
    'method' => 'POST',
    'path' => '/api/organizations',
    'operation_id' => 'CreateOrganization',
    'summary' => 'Create an organization',
    'description' => 'Create a new organization with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_invitation' =>
  array (
    'slug' => 'logto_create_organization_invitation',
    'class' => 'LogtoCreateOrganizationInvitation',
    'method' => 'POST',
    'path' => '/api/organization-invitations',
    'operation_id' => 'CreateOrganizationInvitation',
    'summary' => 'Create organization invitation',
    'description' => 'Create an organization invitation and optionally send it via email. The tenant should have an email connector configured if you want to send the invitation via email at this point.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_invitation_message' =>
  array (
    'slug' => 'logto_create_organization_invitation_message',
    'class' => 'LogtoCreateOrganizationInvitationMessage',
    'method' => 'POST',
    'path' => '/api/organization-invitations/{id}/message',
    'operation_id' => 'CreateOrganizationInvitationMessage',
    'summary' => 'Resend invitation message',
    'description' => 'Resend the invitation message to the invitee.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization invitation.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_jit_email_domain' =>
  array (
    'slug' => 'logto_create_organization_jit_email_domain',
    'class' => 'LogtoCreateOrganizationJitEmailDomain',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/jit/email-domains',
    'operation_id' => 'CreateOrganizationJitEmailDomain',
    'summary' => 'Add organization JIT email domain',
    'description' => 'Add a new email domain for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_jit_role' =>
  array (
    'slug' => 'logto_create_organization_jit_role',
    'class' => 'LogtoCreateOrganizationJitRole',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/jit/roles',
    'operation_id' => 'CreateOrganizationJitRole',
    'summary' => 'Add organization JIT default roles',
    'description' => 'Add new organization roles that will be assigned to users during just-in-time provisioning.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_jit_sso_connector' =>
  array (
    'slug' => 'logto_create_organization_jit_sso_connector',
    'class' => 'LogtoCreateOrganizationJitSsoConnector',
    'method' => 'POST',
    'path' => '/api/organizations/{id}/jit/sso-connectors',
    'operation_id' => 'CreateOrganizationJitSsoConnector',
    'summary' => 'Add organization JIT SSO connectors',
    'description' => 'Add new enterprise SSO connectors for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_role' =>
  array (
    'slug' => 'logto_create_organization_role',
    'class' => 'LogtoCreateOrganizationRole',
    'method' => 'POST',
    'path' => '/api/organization-roles',
    'operation_id' => 'CreateOrganizationRole',
    'summary' => 'Create an organization role',
    'description' => 'Create a new organization role with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_role_resource_scope' =>
  array (
    'slug' => 'logto_create_organization_role_resource_scope',
    'class' => 'LogtoCreateOrganizationRoleResourceScope',
    'method' => 'POST',
    'path' => '/api/organization-roles/{id}/resource-scopes',
    'operation_id' => 'CreateOrganizationRoleResourceScope',
    'summary' => 'Assign resource scopes to organization role',
    'description' => 'Assign resource scopes to the specified organization role',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_role_scope' =>
  array (
    'slug' => 'logto_create_organization_role_scope',
    'class' => 'LogtoCreateOrganizationRoleScope',
    'method' => 'POST',
    'path' => '/api/organization-roles/{id}/scopes',
    'operation_id' => 'CreateOrganizationRoleScope',
    'summary' => 'Assign organization scopes to organization role',
    'description' => 'Assign organization scopes to the specified organization role',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_organization_scope' =>
  array (
    'slug' => 'logto_create_organization_scope',
    'class' => 'LogtoCreateOrganizationScope',
    'method' => 'POST',
    'path' => '/api/organization-scopes',
    'operation_id' => 'CreateOrganizationScope',
    'summary' => 'Create an organization scope',
    'description' => 'Create a new organization scope with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_password_verification' =>
  array (
    'slug' => 'logto_create_password_verification',
    'class' => 'LogtoCreatePasswordVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/password',
    'operation_id' => 'CreatePasswordVerification',
    'summary' => 'Create password verification record',
    'description' => 'Create and verify a new Password verification record. The verification record can only be created if the provided user credentials are correct.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_resource' =>
  array (
    'slug' => 'logto_create_resource',
    'class' => 'LogtoCreateResource',
    'method' => 'POST',
    'path' => '/api/resources',
    'operation_id' => 'CreateResource',
    'summary' => 'Create an API resource',
    'description' => 'Create an API resource in the current tenant.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_resource_scope' =>
  array (
    'slug' => 'logto_create_resource_scope',
    'class' => 'LogtoCreateResourceScope',
    'method' => 'POST',
    'path' => '/api/resources/{resourceId}/scopes',
    'operation_id' => 'CreateResourceScope',
    'summary' => 'Create API resource scope',
    'description' => 'Create a new scope (permission) for an API resource.',
    'parameters' =>
    array (
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'resourceId' => 'resource_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_role' =>
  array (
    'slug' => 'logto_create_role',
    'class' => 'LogtoCreateRole',
    'method' => 'POST',
    'path' => '/api/roles',
    'operation_id' => 'CreateRole',
    'summary' => 'Create a role',
    'description' => 'Create a new role with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_role_application' =>
  array (
    'slug' => 'logto_create_role_application',
    'class' => 'LogtoCreateRoleApplication',
    'method' => 'POST',
    'path' => '/api/roles/{id}/applications',
    'operation_id' => 'CreateRoleApplication',
    'summary' => 'Assign role to applications',
    'description' => 'Assign a role to a list of applications. The role must have the type `Application`.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_role_scope' =>
  array (
    'slug' => 'logto_create_role_scope',
    'class' => 'LogtoCreateRoleScope',
    'method' => 'POST',
    'path' => '/api/roles/{id}/scopes',
    'operation_id' => 'CreateRoleScope',
    'summary' => 'Link scopes to role',
    'description' => 'Link a list of API resource scopes (permissions) to a role. The original linked scopes will be kept.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_role_user' =>
  array (
    'slug' => 'logto_create_role_user',
    'class' => 'LogtoCreateRoleUser',
    'method' => 'POST',
    'path' => '/api/roles/{id}/users',
    'operation_id' => 'CreateRoleUser',
    'summary' => 'Assign role to users',
    'description' => 'Assign a role to a list of users. The role must have the type `User`.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_saml_application' =>
  array (
    'slug' => 'logto_create_saml_application',
    'class' => 'LogtoCreateSamlApplication',
    'method' => 'POST',
    'path' => '/api/saml-applications',
    'operation_id' => 'CreateSamlApplication',
    'summary' => 'Create SAML application',
    'description' => 'Create a new SAML application with the given configuration. A default signing certificate with 3 years lifetime will be automatically created.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_saml_application_secret' =>
  array (
    'slug' => 'logto_create_saml_application_secret',
    'class' => 'LogtoCreateSamlApplicationSecret',
    'method' => 'POST',
    'path' => '/api/saml-applications/{id}/secrets',
    'operation_id' => 'CreateSamlApplicationSecret',
    'summary' => 'Create SAML application secret',
    'description' => 'Create a new signing certificate for the SAML application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_saml_authn' =>
  array (
    'slug' => 'logto_create_saml_authn',
    'class' => 'LogtoCreateSamlAuthn',
    'method' => 'POST',
    'path' => '/api/saml/{id}/authn',
    'operation_id' => 'CreateSamlAuthn',
    'summary' => 'Handle SAML authentication request (POST binding)',
    'description' => 'Process SAML authentication request using HTTP POST binding.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the SAML application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_sign_in_passkey_authentication' =>
  array (
    'slug' => 'logto_create_sign_in_passkey_authentication',
    'class' => 'LogtoCreateSignInPasskeyAuthentication',
    'method' => 'POST',
    'path' => '/api/experience/preflight/sign-in-passkey/authentication',
    'operation_id' => 'CreateSignInPasskeyAuthentication',
    'summary' => 'Create passkey sign-in WebAuthn authentication',
    'description' => 'Create WebAuthn authentication options for passkey sign-in. The user will be resolved later by the credential during verification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_create_sign_in_passkey_authentication_with_identifier' =>
  array (
    'slug' => 'logto_create_sign_in_passkey_authentication_with_identifier',
    'class' => 'LogtoCreateSignInPasskeyAuthenticationWithIdentifier',
    'method' => 'POST',
    'path' => '/api/experience/verification/sign-in-passkey/authentication',
    'operation_id' => 'CreateSignInPasskeyAuthenticationWithIdentifier',
    'summary' => 'Create passkey sign-in WebAuthn authentication with identifier',
    'description' => 'Create WebAuthn authentication options for passkey sign-in with an identifier. The identifier is used to look up the user\'s WebAuthn credentials and generate non-discoverable authentication options.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_social_verification' =>
  array (
    'slug' => 'logto_create_social_verification',
    'class' => 'LogtoCreateSocialVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/social/{connectorId}/authorization-uri',
    'operation_id' => 'CreateSocialVerification',
    'summary' => 'Create social verification',
    'description' => 'Create a new SocialVerification record and return the provider\'s authorization URI for the given connector.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_sso_connector' =>
  array (
    'slug' => 'logto_create_sso_connector',
    'class' => 'LogtoCreateSsoConnector',
    'method' => 'POST',
    'path' => '/api/sso-connectors',
    'operation_id' => 'CreateSsoConnector',
    'summary' => 'Create SSO connector',
    'description' => 'Create an new SSO connector instance for a given provider.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_subject_token' =>
  array (
    'slug' => 'logto_create_subject_token',
    'class' => 'LogtoCreateSubjectToken',
    'method' => 'POST',
    'path' => '/api/subject-tokens',
    'operation_id' => 'CreateSubjectToken',
    'summary' => 'Create a new subject token',
    'description' => 'Create a new subject token for the use of impersonating the user.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_totp_secret' =>
  array (
    'slug' => 'logto_create_totp_secret',
    'class' => 'LogtoCreateTotpSecret',
    'method' => 'POST',
    'path' => '/api/experience/verification/totp/secret',
    'operation_id' => 'CreateTotpSecret',
    'summary' => 'Create TOTP secret',
    'description' => 'Create a new TOTP verification record and generate a new TOTP secret for the user. This secret can be used to bind a new TOTP verification to the user\'s profile. The verification record must be verified before the secret can be used to bind a new TOTP verification to the user\'s profile.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_create_user' =>
  array (
    'slug' => 'logto_create_user',
    'class' => 'LogtoCreateUser',
    'method' => 'POST',
    'path' => '/api/users',
    'operation_id' => 'CreateUser',
    'summary' => 'Create user',
    'description' => 'Create a new user with the given data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_user_asset' =>
  array (
    'slug' => 'logto_create_user_asset',
    'class' => 'LogtoCreateUserAsset',
    'method' => 'POST',
    'path' => '/api/user-assets',
    'operation_id' => 'CreateUserAsset',
    'summary' => 'Upload asset',
    'description' => 'Upload a user asset.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'multipart/form-data',
    'type' => 'write',
  ),
  'logto_create_user_identity' =>
  array (
    'slug' => 'logto_create_user_identity',
    'class' => 'LogtoCreateUserIdentity',
    'method' => 'POST',
    'path' => '/api/users/{userId}/identities',
    'operation_id' => 'CreateUserIdentity',
    'summary' => 'Link social identity to user',
    'description' => 'Link authenticated user identity from a social platform to a Logto user. The usage of this API is usually coupled with `POST /connectors/:connectorId/authorization-uri`. With the help of these pair of APIs, you can implement a user profile page with the link social account feature in your application. Note: Currently due to technical limitations, this API does not support the following connectors that rely on Logto interaction session: `@logto/connector-apple`, `@logto/connector-saml`, `@logto/c',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_user_mfa_verification' =>
  array (
    'slug' => 'logto_create_user_mfa_verification',
    'class' => 'LogtoCreateUserMfaVerification',
    'method' => 'POST',
    'path' => '/api/users/{userId}/mfa-verifications',
    'operation_id' => 'CreateUserMfaVerification',
    'summary' => 'Create an MFA verification for a user',
    'description' => 'Create a new MFA verification for a given user ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_user_personal_access_token' =>
  array (
    'slug' => 'logto_create_user_personal_access_token',
    'class' => 'LogtoCreateUserPersonalAccessToken',
    'method' => 'POST',
    'path' => '/api/users/{userId}/personal-access-tokens',
    'operation_id' => 'CreateUserPersonalAccessToken',
    'summary' => 'Add personal access token',
    'description' => 'Add a new personal access token for the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_verification_by_password' =>
  array (
    'slug' => 'logto_create_verification_by_password',
    'class' => 'LogtoCreateVerificationByPassword',
    'method' => 'POST',
    'path' => '/api/verifications/password',
    'operation_id' => 'CreateVerificationByPassword',
    'summary' => 'Create a record by password',
    'description' => 'Create a verification record by verifying the password.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_verification_by_social' =>
  array (
    'slug' => 'logto_create_verification_by_social',
    'class' => 'LogtoCreateVerificationBySocial',
    'method' => 'POST',
    'path' => '/api/verifications/social',
    'operation_id' => 'CreateVerificationBySocial',
    'summary' => 'Create a social verification record',
    'description' => 'Create a social verification record and return the authorization URI.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_verification_by_verification_code' =>
  array (
    'slug' => 'logto_create_verification_by_verification_code',
    'class' => 'LogtoCreateVerificationByVerificationCode',
    'method' => 'POST',
    'path' => '/api/verifications/verification-code',
    'operation_id' => 'CreateVerificationByVerificationCode',
    'summary' => 'Create a record by verification code',
    'description' => 'Create a verification record and send the code to the specified identifier. The code verification can be used to verify the given identifier.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_verification_code' =>
  array (
    'slug' => 'logto_create_verification_code',
    'class' => 'LogtoCreateVerificationCode',
    'method' => 'POST',
    'path' => '/api/verification-codes',
    'operation_id' => 'CreateVerificationCode',
    'summary' => 'Request and send a verification code',
    'description' => 'Request a verification code for the provided identifier (email/phone). if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_create_web_authn_authentication_verification' =>
  array (
    'slug' => 'logto_create_web_authn_authentication_verification',
    'class' => 'LogtoCreateWebAuthnAuthenticationVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/web-authn/authentication',
    'operation_id' => 'CreateWebAuthnAuthenticationVerification',
    'summary' => 'Create WebAuthn authentication verification',
    'description' => 'Create a new WebAuthn authentication verification record based on the user\'s existing WebAuthn credential. This verification record can be used to verify the user\'s WebAuthn credential.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_create_web_authn_registration_verification' =>
  array (
    'slug' => 'logto_create_web_authn_registration_verification',
    'class' => 'LogtoCreateWebAuthnRegistrationVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/web-authn/registration',
    'operation_id' => 'CreateWebAuthnRegistrationVerification',
    'summary' => 'Create WebAuthn registration verification',
    'description' => 'Create a new WebAuthn registration verification record. The verification record can be used to bind a new WebAuthn credential to the user\'s profile.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application' =>
  array (
    'slug' => 'logto_delete_application',
    'class' => 'LogtoDeleteApplication',
    'method' => 'DELETE',
    'path' => '/api/applications/{id}',
    'operation_id' => 'DeleteApplication',
    'summary' => 'Delete application',
    'description' => 'Delete application by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_legacy_secret' =>
  array (
    'slug' => 'logto_delete_application_legacy_secret',
    'class' => 'LogtoDeleteApplicationLegacySecret',
    'method' => 'DELETE',
    'path' => '/api/applications/{id}/legacy-secret',
    'operation_id' => 'DeleteApplicationLegacySecret',
    'summary' => 'Delete application legacy secret',
    'description' => 'Delete the legacy secret for the application and replace it with a new internal secret. Note: This operation does not "really" delete the legacy secret because it is still needed for internal validation. We may remove the display of the legacy secret (the `secret` field in the application response) in the future.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_protected_app_metadata_custom_domain' =>
  array (
    'slug' => 'logto_delete_application_protected_app_metadata_custom_domain',
    'class' => 'LogtoDeleteApplicationProtectedAppMetadataCustomDomain',
    'method' => 'DELETE',
    'path' => '/api/applications/{id}/protected-app-metadata/custom-domains/{domain}',
    'operation_id' => 'DeleteApplicationProtectedAppMetadataCustomDomain',
    'summary' => 'Remove custom domain',
    'description' => 'Remove custom domain from the specified application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'domain' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `domain`.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'domain' => 'domain',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_role' =>
  array (
    'slug' => 'logto_delete_application_role',
    'class' => 'LogtoDeleteApplicationRole',
    'method' => 'DELETE',
    'path' => '/api/applications/{applicationId}/roles/{roleId}',
    'operation_id' => 'DeleteApplicationRole',
    'summary' => 'Remove a API resource role from application',
    'description' => 'Remove a API resource role from the specified application.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
      'roleId' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_secret' =>
  array (
    'slug' => 'logto_delete_application_secret',
    'class' => 'LogtoDeleteApplicationSecret',
    'method' => 'DELETE',
    'path' => '/api/applications/{id}/secrets/{name}',
    'operation_id' => 'DeleteApplicationSecret',
    'summary' => 'Delete application secret',
    'description' => 'Delete a secret for the application by name.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the secret.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_user_consent_organization' =>
  array (
    'slug' => 'logto_delete_application_user_consent_organization',
    'class' => 'LogtoDeleteApplicationUserConsentOrganization',
    'method' => 'DELETE',
    'path' => '/api/applications/{id}/users/{userId}/consent-organizations/{organizationId}',
    'operation_id' => 'DeleteApplicationUserConsentOrganization',
    'summary' => 'Revoke a user\'s access to an organization for a application',
    'description' => 'Revoke a user\'s access to an organization for a application by application id, user id and organization id.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'organization_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
      'organizationId' => 'organization_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_application_user_consent_scope' =>
  array (
    'slug' => 'logto_delete_application_user_consent_scope',
    'class' => 'LogtoDeleteApplicationUserConsentScope',
    'method' => 'DELETE',
    'path' => '/api/applications/{applicationId}/user-consent-scopes/{scopeType}/{scopeId}',
    'operation_id' => 'DeleteApplicationUserConsentScope',
    'summary' => 'Remove user consent scope from application',
    'description' => 'Remove the user consent scope from an application by application id, scope type and scope id',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'scope_type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `scopeType`.',
        'enum' =>
        array (
          0 => 'organization-scopes',
          1 => 'resource-scopes',
          2 => 'organization-resource-scopes',
          3 => 'user-scopes',
        ),
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the scope.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
      'scopeType' => 'scope_type',
      'scopeId' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_captcha_provider' =>
  array (
    'slug' => 'logto_delete_captcha_provider',
    'class' => 'LogtoDeleteCaptchaProvider',
    'method' => 'DELETE',
    'path' => '/api/captcha-provider',
    'operation_id' => 'DeleteCaptchaProvider',
    'summary' => 'Delete captcha provider',
    'description' => 'Delete the captcha provider.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_connector' =>
  array (
    'slug' => 'logto_delete_connector',
    'class' => 'LogtoDeleteConnector',
    'method' => 'DELETE',
    'path' => '/api/connectors/{id}',
    'operation_id' => 'DeleteConnector',
    'summary' => 'Delete connector',
    'description' => 'Delete connector by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_custom_phrase' =>
  array (
    'slug' => 'logto_delete_custom_phrase',
    'class' => 'LogtoDeleteCustomPhrase',
    'method' => 'DELETE',
    'path' => '/api/custom-phrases/{languageTag}',
    'operation_id' => 'DeleteCustomPhrase',
    'summary' => 'Delete custom phrase',
    'description' => 'Delete custom phrases for the specified language tag.',
    'parameters' =>
    array (
      'language_tag' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `languageTag`.',
        'enum' =>
        array (
          0 => 'af-ZA',
          1 => 'am-ET',
          2 => 'ar',
          3 => 'ar-AR',
          4 => 'as-IN',
          5 => 'az-AZ',
          6 => 'be-BY',
          7 => 'bg-BG',
          8 => 'bn-IN',
          9 => 'br-FR',
          10 => 'bs-BA',
          11 => 'ca-ES',
          12 => 'cb-IQ',
          13 => 'co-FR',
          14 => 'cs',
          15 => 'cs-CZ',
          16 => 'cx-PH',
          17 => 'cy-GB',
          18 => 'da-DK',
          19 => 'de',
          20 => 'de-DE',
          21 => 'el-GR',
          22 => 'en',
          23 => 'en-GB',
          24 => 'en-US',
          25 => 'eo-EO',
          26 => 'es',
          27 => 'es-ES',
          28 => 'es-419',
          29 => 'et-EE',
          30 => 'eu-ES',
          31 => 'fa-IR',
          32 => 'ff-NG',
          33 => 'fi',
          34 => 'fi-FI',
          35 => 'fo-FO',
          36 => 'fr',
          37 => 'fr-CA',
          38 => 'fr-FR',
          39 => 'fy-NL',
          40 => 'ga-IE',
          41 => 'gl-ES',
          42 => 'gn-PY',
          43 => 'gu-IN',
          44 => 'ha-NG',
          45 => 'he-IL',
          46 => 'hi-IN',
          47 => 'hr-HR',
          48 => 'ht-HT',
          49 => 'hu-HU',
          50 => 'hy-AM',
          51 => 'id-ID',
          52 => 'ik-US',
          53 => 'is-IS',
          54 => 'it',
          55 => 'it-IT',
          56 => 'iu-CA',
          57 => 'ja',
          58 => 'ja-JP',
          59 => 'ja-KS',
          60 => 'jv-ID',
          61 => 'ka-GE',
          62 => 'kk-KZ',
          63 => 'km-KH',
          64 => 'kn-IN',
          65 => 'ko',
          66 => 'ko-KR',
          67 => 'ku-TR',
          68 => 'ky-KG',
          69 => 'lo-LA',
          70 => 'lt-LT',
          71 => 'lv-LV',
          72 => 'mg-MG',
          73 => 'mk-MK',
          74 => 'ml-IN',
          75 => 'mn-MN',
          76 => 'mr-IN',
          77 => 'ms-MY',
          78 => 'mt-MT',
          79 => 'my-MM',
          80 => 'nb-NO',
          81 => 'ne-NP',
          82 => 'nl',
          83 => 'nl-BE',
          84 => 'nl-NL',
          85 => 'nn-NO',
          86 => 'or-IN',
          87 => 'pa-IN',
          88 => 'pl-PL',
          89 => 'ps-AF',
          90 => 'pt',
          91 => 'pt-BR',
          92 => 'pt-PT',
          93 => 'ro-RO',
          94 => 'ru',
          95 => 'ru-RU',
          96 => 'rw-RW',
          97 => 'sc-IT',
          98 => 'si-LK',
          99 => 'sk-SK',
          100 => 'sl-SI',
          101 => 'sn-ZW',
          102 => 'sq-AL',
          103 => 'sr-RS',
          104 => 'sv',
          105 => 'sv-SE',
          106 => 'sw-KE',
          107 => 'sy-SY',
          108 => 'sz-PL',
          109 => 'ta-IN',
          110 => 'te-IN',
          111 => 'tg-TJ',
          112 => 'th',
          113 => 'th-TH',
          114 => 'tl-PH',
          115 => 'tr',
          116 => 'tr-TR',
          117 => 'tt-RU',
          118 => 'tz-MA',
          119 => 'uk-UA',
          120 => 'ur-PK',
          121 => 'uz-UZ',
          122 => 'vi-VN',
          123 => 'zh',
          124 => 'zh-CN',
          125 => 'zh-HK',
          126 => 'zh-MO',
          127 => 'zh-TW',
          128 => 'zz-TR',
        ),
      ),
    ),
    'path_params' =>
    array (
      'languageTag' => 'language_tag',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_custom_profile_field_by_name' =>
  array (
    'slug' => 'logto_delete_custom_profile_field_by_name',
    'class' => 'LogtoDeleteCustomProfileFieldByName',
    'method' => 'DELETE',
    'path' => '/api/custom-profile-fields/{name}',
    'operation_id' => 'DeleteCustomProfileFieldByName',
    'summary' => 'Delete a custom profile field by name',
    'description' => 'Delete a custom profile field by name.',
    'parameters' =>
    array (
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `name`.',
      ),
    ),
    'path_params' =>
    array (
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_domain' =>
  array (
    'slug' => 'logto_delete_domain',
    'class' => 'LogtoDeleteDomain',
    'method' => 'DELETE',
    'path' => '/api/domains/{id}',
    'operation_id' => 'DeleteDomain',
    'summary' => 'Delete domain',
    'description' => 'Delete domain by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the domain.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_email_template' =>
  array (
    'slug' => 'logto_delete_email_template',
    'class' => 'LogtoDeleteEmailTemplate',
    'method' => 'DELETE',
    'path' => '/api/email-templates/{id}',
    'operation_id' => 'DeleteEmailTemplate',
    'summary' => 'Delete an email template',
    'description' => 'Delete an email template by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the email template.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_email_templates' =>
  array (
    'slug' => 'logto_delete_email_templates',
    'class' => 'LogtoDeleteEmailTemplates',
    'method' => 'DELETE',
    'path' => '/api/email-templates',
    'operation_id' => 'DeleteEmailTemplates',
    'summary' => 'Delete email templates',
    'description' => 'Bulk delete email templates by their language tag and template type.',
    'parameters' =>
    array (
      'language_tag' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The language tag of the email template, e.g., `en` or `fr`.',
      ),
      'template_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the email template, e.g. `SignIn` or `ForgotPassword`',
        'enum' =>
        array (
          0 => 'SignIn',
          1 => 'Register',
          2 => 'ForgotPassword',
          3 => 'OrganizationInvitation',
          4 => 'Generic',
          5 => 'UserPermissionValidation',
          6 => 'BindNewIdentifier',
          7 => 'MfaVerification',
          8 => 'BindMfa',
        ),
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'languageTag' => 'language_tag',
      'templateType' => 'template_type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_grant_by_id' =>
  array (
    'slug' => 'logto_delete_grant_by_id',
    'class' => 'LogtoDeleteGrantById',
    'method' => 'DELETE',
    'path' => '/api/my-account/grants/{grantId}',
    'operation_id' => 'DeleteGrantById',
    'summary' => 'Revoke a grant by ID',
    'description' => 'Revoke a specific user application grant by grant ID and remove the related session authorization. A logto-verification-id in header is required for revoking grants.',
    'parameters' =>
    array (
      'grant_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the grant.',
      ),
    ),
    'path_params' =>
    array (
      'grantId' => 'grant_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_hook' =>
  array (
    'slug' => 'logto_delete_hook',
    'class' => 'LogtoDeleteHook',
    'method' => 'DELETE',
    'path' => '/api/hooks/{id}',
    'operation_id' => 'DeleteHook',
    'summary' => 'Delete hook',
    'description' => 'Delete hook by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_identity' =>
  array (
    'slug' => 'logto_delete_identity',
    'class' => 'LogtoDeleteIdentity',
    'method' => 'DELETE',
    'path' => '/api/my-account/identities/{target}',
    'operation_id' => 'DeleteIdentity',
    'summary' => 'Delete a user identity',
    'description' => 'Delete an identity (social identity) from the user, a logto-verification-id in header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'parameters' =>
    array (
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
    ),
    'path_params' =>
    array (
      'target' => 'target',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_jwt_customizer' =>
  array (
    'slug' => 'logto_delete_jwt_customizer',
    'class' => 'LogtoDeleteJwtCustomizer',
    'method' => 'DELETE',
    'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
    'operation_id' => 'DeleteJwtCustomizer',
    'summary' => 'Delete JWT customizer',
    'description' => 'Delete the JWT customizer for the given token type.',
    'parameters' =>
    array (
      'token_type_path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The token type path to delete the JWT customizer for.',
        'enum' =>
        array (
          0 => 'access-token',
          1 => 'client-credentials',
        ),
      ),
    ),
    'path_params' =>
    array (
      'tokenTypePath' => 'token_type_path',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_mfa_verification' =>
  array (
    'slug' => 'logto_delete_mfa_verification',
    'class' => 'LogtoDeleteMfaVerification',
    'method' => 'DELETE',
    'path' => '/api/my-account/mfa-verifications/{verificationId}',
    'operation_id' => 'DeleteMfaVerification',
    'summary' => 'Delete an MFA verification',
    'description' => 'Delete an MFA verification, a logto-verification-id in header is required for checking sensitive permissions.',
    'parameters' =>
    array (
      'verification_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the verification.',
      ),
    ),
    'path_params' =>
    array (
      'verificationId' => 'verification_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_oidc_key' =>
  array (
    'slug' => 'logto_delete_oidc_key',
    'class' => 'LogtoDeleteOidcKey',
    'method' => 'DELETE',
    'path' => '/api/configs/oidc/{keyType}/{keyId}',
    'operation_id' => 'DeleteOidcKey',
    'summary' => 'Delete OIDC key',
    'description' => 'Delete an OIDC signing key by key type and key ID.',
    'parameters' =>
    array (
      'key_type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Private keys are used to sign OIDC JWTs. Cookie keys are used to sign OIDC cookies. For clients, they do not need to know private keys to verify OIDC JWTs; they can use public keys from the JWKS endpoint instead.',
        'enum' =>
        array (
          0 => 'private-keys',
          1 => 'cookie-keys',
        ),
      ),
      'key_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the key.',
      ),
    ),
    'path_params' =>
    array (
      'keyType' => 'key_type',
      'keyId' => 'key_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_one_time_token' =>
  array (
    'slug' => 'logto_delete_one_time_token',
    'class' => 'LogtoDeleteOneTimeToken',
    'method' => 'DELETE',
    'path' => '/api/one-time-tokens/{id}',
    'operation_id' => 'DeleteOneTimeToken',
    'summary' => 'Delete one-time token by ID',
    'description' => 'Delete a one-time token by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the one time token.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization' =>
  array (
    'slug' => 'logto_delete_organization',
    'class' => 'LogtoDeleteOrganization',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}',
    'operation_id' => 'DeleteOrganization',
    'summary' => 'Delete organization',
    'description' => 'Delete organization by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_application' =>
  array (
    'slug' => 'logto_delete_organization_application',
    'class' => 'LogtoDeleteOrganizationApplication',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/applications/{applicationId}',
    'operation_id' => 'DeleteOrganizationApplication',
    'summary' => 'Remove organization application',
    'description' => 'Remove an application from the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_application_role' =>
  array (
    'slug' => 'logto_delete_organization_application_role',
    'class' => 'LogtoDeleteOrganizationApplicationRole',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/applications/{applicationId}/roles/{organizationRoleId}',
    'operation_id' => 'DeleteOrganizationApplicationRole',
    'summary' => 'Remove organization application role',
    'description' => 'Remove a role from the application in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'organization_role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
      'organizationRoleId' => 'organization_role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_invitation' =>
  array (
    'slug' => 'logto_delete_organization_invitation',
    'class' => 'LogtoDeleteOrganizationInvitation',
    'method' => 'DELETE',
    'path' => '/api/organization-invitations/{id}',
    'operation_id' => 'DeleteOrganizationInvitation',
    'summary' => 'Delete organization invitation',
    'description' => 'Delete an organization invitation by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization invitation.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_jit_email_domain' =>
  array (
    'slug' => 'logto_delete_organization_jit_email_domain',
    'class' => 'LogtoDeleteOrganizationJitEmailDomain',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/jit/email-domains/{emailDomain}',
    'operation_id' => 'DeleteOrganizationJitEmailDomain',
    'summary' => 'Remove organization JIT email domain',
    'description' => 'Remove an email domain for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'email_domain' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The email domain to remove.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'emailDomain' => 'email_domain',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_jit_role' =>
  array (
    'slug' => 'logto_delete_organization_jit_role',
    'class' => 'LogtoDeleteOrganizationJitRole',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/jit/roles/{organizationRoleId}',
    'operation_id' => 'DeleteOrganizationJitRole',
    'summary' => 'Remove organization JIT default role',
    'description' => 'Remove an organization role that will be assigned to users during just-in-time provisioning.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'organization_role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'organizationRoleId' => 'organization_role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_jit_sso_connector' =>
  array (
    'slug' => 'logto_delete_organization_jit_sso_connector',
    'class' => 'LogtoDeleteOrganizationJitSsoConnector',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/jit/sso-connectors/{ssoConnectorId}',
    'operation_id' => 'DeleteOrganizationJitSsoConnector',
    'summary' => 'Remove organization JIT SSO connector',
    'description' => 'Remove an enterprise SSO connector for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'sso_connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the sso connector.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'ssoConnectorId' => 'sso_connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_role' =>
  array (
    'slug' => 'logto_delete_organization_role',
    'class' => 'LogtoDeleteOrganizationRole',
    'method' => 'DELETE',
    'path' => '/api/organization-roles/{id}',
    'operation_id' => 'DeleteOrganizationRole',
    'summary' => 'Delete organization role',
    'description' => 'Delete organization role by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_role_resource_scope' =>
  array (
    'slug' => 'logto_delete_organization_role_resource_scope',
    'class' => 'LogtoDeleteOrganizationRoleResourceScope',
    'method' => 'DELETE',
    'path' => '/api/organization-roles/{id}/resource-scopes/{scopeId}',
    'operation_id' => 'DeleteOrganizationRoleResourceScope',
    'summary' => 'Remove resource scope',
    'description' => 'Remove a resource scope assignment from the specified organization role.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the scope.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'scopeId' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_role_scope' =>
  array (
    'slug' => 'logto_delete_organization_role_scope',
    'class' => 'LogtoDeleteOrganizationRoleScope',
    'method' => 'DELETE',
    'path' => '/api/organization-roles/{id}/scopes/{organizationScopeId}',
    'operation_id' => 'DeleteOrganizationRoleScope',
    'summary' => 'Remove organization scope',
    'description' => 'Remove a organization scope assignment from the specified organization role.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'organization_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization scope.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'organizationScopeId' => 'organization_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_scope' =>
  array (
    'slug' => 'logto_delete_organization_scope',
    'class' => 'LogtoDeleteOrganizationScope',
    'method' => 'DELETE',
    'path' => '/api/organization-scopes/{id}',
    'operation_id' => 'DeleteOrganizationScope',
    'summary' => 'Delete organization scope',
    'description' => 'Delete organization scope by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization scope.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_user' =>
  array (
    'slug' => 'logto_delete_organization_user',
    'class' => 'LogtoDeleteOrganizationUser',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/users/{userId}',
    'operation_id' => 'DeleteOrganizationUser',
    'summary' => 'Remove user member from organization',
    'description' => 'Remove a user\'s membership from the specified organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_organization_user_role' =>
  array (
    'slug' => 'logto_delete_organization_user_role',
    'class' => 'LogtoDeleteOrganizationUserRole',
    'method' => 'DELETE',
    'path' => '/api/organizations/{id}/users/{userId}/roles/{organizationRoleId}',
    'operation_id' => 'DeleteOrganizationUserRole',
    'summary' => 'Remove a role from a user in an organization',
    'description' => 'Remove a role assignment from a user in the specified organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'organization_role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
      'organizationRoleId' => 'organization_role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_personal_access_token_post' =>
  array (
    'slug' => 'logto_delete_personal_access_token_post',
    'class' => 'LogtoDeletePersonalAccessTokenPost',
    'method' => 'POST',
    'path' => '/api/users/{userId}/personal-access-tokens/delete',
    'operation_id' => 'DeletePersonalAccessTokenPost',
    'summary' => 'Delete personal access token',
    'description' => 'Delete a token for the user by name.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_delete_primary_email' =>
  array (
    'slug' => 'logto_delete_primary_email',
    'class' => 'LogtoDeletePrimaryEmail',
    'method' => 'DELETE',
    'path' => '/api/my-account/primary-email',
    'operation_id' => 'DeletePrimaryEmail',
    'summary' => 'Delete primary email',
    'description' => 'Delete primary email for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_primary_phone' =>
  array (
    'slug' => 'logto_delete_primary_phone',
    'class' => 'LogtoDeletePrimaryPhone',
    'method' => 'DELETE',
    'path' => '/api/my-account/primary-phone',
    'operation_id' => 'DeletePrimaryPhone',
    'summary' => 'Delete primary phone',
    'description' => 'Delete primary phone for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_resource' =>
  array (
    'slug' => 'logto_delete_resource',
    'class' => 'LogtoDeleteResource',
    'method' => 'DELETE',
    'path' => '/api/resources/{id}',
    'operation_id' => 'DeleteResource',
    'summary' => 'Delete API resource',
    'description' => 'Delete an API resource by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_resource_scope' =>
  array (
    'slug' => 'logto_delete_resource_scope',
    'class' => 'LogtoDeleteResourceScope',
    'method' => 'DELETE',
    'path' => '/api/resources/{resourceId}/scopes/{scopeId}',
    'operation_id' => 'DeleteResourceScope',
    'summary' => 'Delete API resource scope',
    'description' => 'Delete an API resource scope (permission) from the given resource.',
    'parameters' =>
    array (
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the scope.',
      ),
    ),
    'path_params' =>
    array (
      'resourceId' => 'resource_id',
      'scopeId' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_role' =>
  array (
    'slug' => 'logto_delete_role',
    'class' => 'LogtoDeleteRole',
    'method' => 'DELETE',
    'path' => '/api/roles/{id}',
    'operation_id' => 'DeleteRole',
    'summary' => 'Delete role',
    'description' => 'Delete a role with the given ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_role_application' =>
  array (
    'slug' => 'logto_delete_role_application',
    'class' => 'LogtoDeleteRoleApplication',
    'method' => 'DELETE',
    'path' => '/api/roles/{id}/applications/{applicationId}',
    'operation_id' => 'DeleteRoleApplication',
    'summary' => 'Remove role from application',
    'description' => 'Remove the role from an application with the given ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_role_scope' =>
  array (
    'slug' => 'logto_delete_role_scope',
    'class' => 'LogtoDeleteRoleScope',
    'method' => 'DELETE',
    'path' => '/api/roles/{id}/scopes/{scopeId}',
    'operation_id' => 'DeleteRoleScope',
    'summary' => 'Unlink scope from role',
    'description' => 'Unlink an API resource scope (permission) from a role with the given ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the scope.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'scopeId' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_role_user' =>
  array (
    'slug' => 'logto_delete_role_user',
    'class' => 'LogtoDeleteRoleUser',
    'method' => 'DELETE',
    'path' => '/api/roles/{id}/users/{userId}',
    'operation_id' => 'DeleteRoleUser',
    'summary' => 'Remove role from user',
    'description' => 'Remove a role from a user with the given ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_saml_application' =>
  array (
    'slug' => 'logto_delete_saml_application',
    'class' => 'LogtoDeleteSamlApplication',
    'method' => 'DELETE',
    'path' => '/api/saml-applications/{id}',
    'operation_id' => 'DeleteSamlApplication',
    'summary' => 'Delete SAML application',
    'description' => 'Delete a SAML application by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_saml_application_secret' =>
  array (
    'slug' => 'logto_delete_saml_application_secret',
    'class' => 'LogtoDeleteSamlApplicationSecret',
    'method' => 'DELETE',
    'path' => '/api/saml-applications/{id}/secrets/{secretId}',
    'operation_id' => 'DeleteSamlApplicationSecret',
    'summary' => 'Delete SAML application secret',
    'description' => 'Delete a signing certificate of the SAML application. Active certificates cannot be deleted.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
      'secret_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the secret.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'secretId' => 'secret_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_secret' =>
  array (
    'slug' => 'logto_delete_secret',
    'class' => 'LogtoDeleteSecret',
    'method' => 'DELETE',
    'path' => '/api/secrets/{id}',
    'operation_id' => 'DeleteSecret',
    'summary' => 'Delete secret',
    'description' => 'Delete a secret by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the secret.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_sentinel_activities' =>
  array (
    'slug' => 'logto_delete_sentinel_activities',
    'class' => 'LogtoDeleteSentinelActivities',
    'method' => 'POST',
    'path' => '/api/sentinel-activities/delete',
    'operation_id' => 'DeleteSentinelActivities',
    'summary' => 'Bulk delete sentinel activities',
    'description' => 'Remove sentinel activity reports based on the provided target value(identifier).Use this endpoint to unblock users who may be locked out due to too many failed authentication attempts.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_delete_session_by_id' =>
  array (
    'slug' => 'logto_delete_session_by_id',
    'class' => 'LogtoDeleteSessionById',
    'method' => 'DELETE',
    'path' => '/api/my-account/sessions/{sessionId}',
    'operation_id' => 'DeleteSessionById',
    'summary' => 'Revoke a session by ID',
    'description' => 'Revoke a specific user session by its ID, optionally revoking target associated grants and tokens. A logto-verification-id in header is required for revoking sessions.',
    'parameters' =>
    array (
      'session_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the session.',
      ),
      'revoke_grants_target' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Optional target for revoking associated grants and tokens. \'all\' revokes grants for every application authorized by this session. \'firstParty\' revokes only first-party app grants; third-party app grants remain active. If omitted, grants remain active when the session authorizations include offline_access; otherwise they are revoked.',
        'enum' =>
        array (
          0 => 'all',
          1 => 'firstParty',
        ),
      ),
    ),
    'path_params' =>
    array (
      'sessionId' => 'session_id',
    ),
    'query_params' =>
    array (
      'revokeGrantsTarget' => 'revoke_grants_target',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_sso_connector' =>
  array (
    'slug' => 'logto_delete_sso_connector',
    'class' => 'LogtoDeleteSsoConnector',
    'method' => 'DELETE',
    'path' => '/api/sso-connectors/{id}',
    'operation_id' => 'DeleteSsoConnector',
    'summary' => 'Delete SSO connector',
    'description' => 'Delete an SSO connector by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the sso connector.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user' =>
  array (
    'slug' => 'logto_delete_user',
    'class' => 'LogtoDeleteUser',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}',
    'operation_id' => 'DeleteUser',
    'summary' => 'Delete user',
    'description' => 'Delete user with the given ID. Note all associated data will be deleted cascadingly.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_grant' =>
  array (
    'slug' => 'logto_delete_user_grant',
    'class' => 'LogtoDeleteUserGrant',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/grants/{grantId}',
    'operation_id' => 'DeleteUserGrant',
    'summary' => 'Revoke a user grant',
    'description' => 'Revoke a specific grant and its associated token chain by grant ID. Also removes the matching session authorization entry for this grant from the related active session. The grant must belong to the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'grant_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the grant.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'grantId' => 'grant_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_identity' =>
  array (
    'slug' => 'logto_delete_user_identity',
    'class' => 'LogtoDeleteUserIdentity',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/identities/{target}',
    'operation_id' => 'DeleteUserIdentity',
    'summary' => 'Delete social identity from user',
    'description' => 'Delete a social identity from the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'target' => 'target',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_mfa_verification' =>
  array (
    'slug' => 'logto_delete_user_mfa_verification',
    'class' => 'LogtoDeleteUserMfaVerification',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/mfa-verifications/{verificationId}',
    'operation_id' => 'DeleteUserMfaVerification',
    'summary' => 'Delete an MFA verification for a user',
    'description' => 'Delete an MFA verification for the user with the given verification ID. The verification ID must be associated with the given user ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'verification_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the verification.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'verificationId' => 'verification_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_personal_access_token' =>
  array (
    'slug' => 'logto_delete_user_personal_access_token',
    'class' => 'LogtoDeleteUserPersonalAccessToken',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/personal-access-tokens/{name}',
    'operation_id' => 'DeleteUserPersonalAccessToken',
    'summary' => 'Delete personal access token',
    'description' => 'Delete a token for the user by name using the legacy path parameter. Deprecated: use the POST /delete endpoint instead to avoid url name encoding issues.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the token.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_role' =>
  array (
    'slug' => 'logto_delete_user_role',
    'class' => 'LogtoDeleteUserRole',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/roles/{roleId}',
    'operation_id' => 'DeleteUserRole',
    'summary' => 'Remove role from user',
    'description' => 'Remove an API resource role from the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'roleId' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_delete_user_session' =>
  array (
    'slug' => 'logto_delete_user_session',
    'class' => 'LogtoDeleteUserSession',
    'method' => 'DELETE',
    'path' => '/api/users/{userId}/sessions/{sessionId}',
    'operation_id' => 'DeleteUserSession',
    'summary' => 'Revoke a user session',
    'description' => 'Revoke a specific user session by its ID, optionally revoking associated target grants and tokens.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'session_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the session.',
      ),
      'revoke_grants_target' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Optional target for revoking associated grants and tokens. \'all\' revokes grants for every application authorized by this session. \'firstParty\' revokes only first-party app grants; third-party app grants remain active. If omitted, grants remain active when the session authorizations include offline_access; otherwise they are revoked.',
        'enum' =>
        array (
          0 => 'all',
          1 => 'firstParty',
        ),
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'sessionId' => 'session_id',
    ),
    'query_params' =>
    array (
      'revokeGrantsTarget' => 'revoke_grants_target',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_generate_backup_codes' =>
  array (
    'slug' => 'logto_generate_backup_codes',
    'class' => 'LogtoGenerateBackupCodes',
    'method' => 'POST',
    'path' => '/api/experience/verification/backup-code/generate',
    'operation_id' => 'GenerateBackupCodes',
    'summary' => 'Generate backup codes',
    'description' => 'Create a new BackupCode verification record with new backup codes generated. This verification record will be used to bind the backup codes to the user\'s profile.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_generate_my_account_backup_codes' =>
  array (
    'slug' => 'logto_generate_my_account_backup_codes',
    'class' => 'LogtoGenerateMyAccountBackupCodes',
    'method' => 'POST',
    'path' => '/api/my-account/mfa-verifications/backup-codes/generate',
    'operation_id' => 'GenerateMyAccountBackupCodes',
    'summary' => 'Generate backup codes',
    'description' => 'Generate backup codes for the user.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_generate_totp_secret' =>
  array (
    'slug' => 'logto_generate_totp_secret',
    'class' => 'LogtoGenerateTotpSecret',
    'method' => 'POST',
    'path' => '/api/my-account/mfa-verifications/totp-secret/generate',
    'operation_id' => 'GenerateTotpSecret',
    'summary' => 'Generate a TOTP secret',
    'description' => 'Generate a TOTP secret for the user.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_generate_web_authn_registration_options' =>
  array (
    'slug' => 'logto_generate_web_authn_registration_options',
    'class' => 'LogtoGenerateWebAuthnRegistrationOptions',
    'method' => 'POST',
    'path' => '/api/verifications/web-authn/registration',
    'operation_id' => 'GenerateWebAuthnRegistrationOptions',
    'summary' => 'Generate WebAuthn registration options',
    'description' => 'Generate WebAuthn registration options for the user to register a new WebAuthn device.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_get_account_center_settings' =>
  array (
    'slug' => 'logto_get_account_center_settings',
    'class' => 'LogtoGetAccountCenterSettings',
    'method' => 'GET',
    'path' => '/api/account-center',
    'operation_id' => 'GetAccountCenterSettings',
    'summary' => 'Get account center settings',
    'description' => 'Get the account center settings.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_active_user_counts' =>
  array (
    'slug' => 'logto_get_active_user_counts',
    'class' => 'LogtoGetActiveUserCounts',
    'method' => 'GET',
    'path' => '/api/dashboard/users/active',
    'operation_id' => 'GetActiveUserCounts',
    'summary' => 'Get active user data',
    'description' => 'Get active user data, including daily active user (DAU), weekly active user (WAU) and monthly active user (MAU). It also includes an array of DAU in the past 30 days.',
    'parameters' =>
    array (
      'date' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The date to get active user data.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'date' => 'date',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_admin_console_config' =>
  array (
    'slug' => 'logto_get_admin_console_config',
    'class' => 'LogtoGetAdminConsoleConfig',
    'method' => 'GET',
    'path' => '/api/configs/admin-console',
    'operation_id' => 'GetAdminConsoleConfig',
    'summary' => 'Get admin console config',
    'description' => 'Get the global configuration object for Logto Console.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_application' =>
  array (
    'slug' => 'logto_get_application',
    'class' => 'LogtoGetApplication',
    'method' => 'GET',
    'path' => '/api/applications/{id}',
    'operation_id' => 'GetApplication',
    'summary' => 'Get application',
    'description' => 'Get application details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_application_sign_in_experience' =>
  array (
    'slug' => 'logto_get_application_sign_in_experience',
    'class' => 'LogtoGetApplicationSignInExperience',
    'method' => 'GET',
    'path' => '/api/applications/{applicationId}/sign-in-experience',
    'operation_id' => 'GetApplicationSignInExperience',
    'summary' => 'Get the application level sign-in experience',
    'description' => 'Get application level sign-in experience for a given application. - Only branding properties and terms links customization is supported for now. - Only third-party applications can have the sign-in experience customization for now.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_backup_codes' =>
  array (
    'slug' => 'logto_get_backup_codes',
    'class' => 'LogtoGetBackupCodes',
    'method' => 'GET',
    'path' => '/api/my-account/mfa-verifications/backup-codes',
    'operation_id' => 'GetBackupCodes',
    'summary' => 'Get backup codes',
    'description' => 'Get all backup codes for the user with their usage status. Requires identity verification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_captcha_provider' =>
  array (
    'slug' => 'logto_get_captcha_provider',
    'class' => 'LogtoGetCaptchaProvider',
    'method' => 'GET',
    'path' => '/api/captcha-provider',
    'operation_id' => 'GetCaptchaProvider',
    'summary' => 'Get captcha provider',
    'description' => 'Get the captcha provider, you can only have one captcha provider.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_connector' =>
  array (
    'slug' => 'logto_get_connector',
    'class' => 'LogtoGetConnector',
    'method' => 'GET',
    'path' => '/api/connectors/{id}',
    'operation_id' => 'GetConnector',
    'summary' => 'Get connector',
    'description' => 'Get connector data by ID',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_connector_factory' =>
  array (
    'slug' => 'logto_get_connector_factory',
    'class' => 'LogtoGetConnectorFactory',
    'method' => 'GET',
    'path' => '/api/connector-factories/{id}',
    'operation_id' => 'GetConnectorFactory',
    'summary' => 'Get connector factory',
    'description' => 'Get connector factory by the given ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector factory.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_custom_phrase' =>
  array (
    'slug' => 'logto_get_custom_phrase',
    'class' => 'LogtoGetCustomPhrase',
    'method' => 'GET',
    'path' => '/api/custom-phrases/{languageTag}',
    'operation_id' => 'GetCustomPhrase',
    'summary' => 'Get custom phrases',
    'description' => 'Get custom phrases for the specified language tag.',
    'parameters' =>
    array (
      'language_tag' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `languageTag`.',
        'enum' =>
        array (
          0 => 'af-ZA',
          1 => 'am-ET',
          2 => 'ar',
          3 => 'ar-AR',
          4 => 'as-IN',
          5 => 'az-AZ',
          6 => 'be-BY',
          7 => 'bg-BG',
          8 => 'bn-IN',
          9 => 'br-FR',
          10 => 'bs-BA',
          11 => 'ca-ES',
          12 => 'cb-IQ',
          13 => 'co-FR',
          14 => 'cs',
          15 => 'cs-CZ',
          16 => 'cx-PH',
          17 => 'cy-GB',
          18 => 'da-DK',
          19 => 'de',
          20 => 'de-DE',
          21 => 'el-GR',
          22 => 'en',
          23 => 'en-GB',
          24 => 'en-US',
          25 => 'eo-EO',
          26 => 'es',
          27 => 'es-ES',
          28 => 'es-419',
          29 => 'et-EE',
          30 => 'eu-ES',
          31 => 'fa-IR',
          32 => 'ff-NG',
          33 => 'fi',
          34 => 'fi-FI',
          35 => 'fo-FO',
          36 => 'fr',
          37 => 'fr-CA',
          38 => 'fr-FR',
          39 => 'fy-NL',
          40 => 'ga-IE',
          41 => 'gl-ES',
          42 => 'gn-PY',
          43 => 'gu-IN',
          44 => 'ha-NG',
          45 => 'he-IL',
          46 => 'hi-IN',
          47 => 'hr-HR',
          48 => 'ht-HT',
          49 => 'hu-HU',
          50 => 'hy-AM',
          51 => 'id-ID',
          52 => 'ik-US',
          53 => 'is-IS',
          54 => 'it',
          55 => 'it-IT',
          56 => 'iu-CA',
          57 => 'ja',
          58 => 'ja-JP',
          59 => 'ja-KS',
          60 => 'jv-ID',
          61 => 'ka-GE',
          62 => 'kk-KZ',
          63 => 'km-KH',
          64 => 'kn-IN',
          65 => 'ko',
          66 => 'ko-KR',
          67 => 'ku-TR',
          68 => 'ky-KG',
          69 => 'lo-LA',
          70 => 'lt-LT',
          71 => 'lv-LV',
          72 => 'mg-MG',
          73 => 'mk-MK',
          74 => 'ml-IN',
          75 => 'mn-MN',
          76 => 'mr-IN',
          77 => 'ms-MY',
          78 => 'mt-MT',
          79 => 'my-MM',
          80 => 'nb-NO',
          81 => 'ne-NP',
          82 => 'nl',
          83 => 'nl-BE',
          84 => 'nl-NL',
          85 => 'nn-NO',
          86 => 'or-IN',
          87 => 'pa-IN',
          88 => 'pl-PL',
          89 => 'ps-AF',
          90 => 'pt',
          91 => 'pt-BR',
          92 => 'pt-PT',
          93 => 'ro-RO',
          94 => 'ru',
          95 => 'ru-RU',
          96 => 'rw-RW',
          97 => 'sc-IT',
          98 => 'si-LK',
          99 => 'sk-SK',
          100 => 'sl-SI',
          101 => 'sn-ZW',
          102 => 'sq-AL',
          103 => 'sr-RS',
          104 => 'sv',
          105 => 'sv-SE',
          106 => 'sw-KE',
          107 => 'sy-SY',
          108 => 'sz-PL',
          109 => 'ta-IN',
          110 => 'te-IN',
          111 => 'tg-TJ',
          112 => 'th',
          113 => 'th-TH',
          114 => 'tl-PH',
          115 => 'tr',
          116 => 'tr-TR',
          117 => 'tt-RU',
          118 => 'tz-MA',
          119 => 'uk-UA',
          120 => 'ur-PK',
          121 => 'uz-UZ',
          122 => 'vi-VN',
          123 => 'zh',
          124 => 'zh-CN',
          125 => 'zh-HK',
          126 => 'zh-MO',
          127 => 'zh-TW',
          128 => 'zz-TR',
        ),
      ),
    ),
    'path_params' =>
    array (
      'languageTag' => 'language_tag',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_custom_profile_field_by_name' =>
  array (
    'slug' => 'logto_get_custom_profile_field_by_name',
    'class' => 'LogtoGetCustomProfileFieldByName',
    'method' => 'GET',
    'path' => '/api/custom-profile-fields/{name}',
    'operation_id' => 'GetCustomProfileFieldByName',
    'summary' => 'Get a custom profile field by name',
    'description' => 'Get a custom profile field by name.',
    'parameters' =>
    array (
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `name`.',
      ),
    ),
    'path_params' =>
    array (
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_domain' =>
  array (
    'slug' => 'logto_get_domain',
    'class' => 'LogtoGetDomain',
    'method' => 'GET',
    'path' => '/api/domains/{id}',
    'operation_id' => 'GetDomain',
    'summary' => 'Get domain',
    'description' => 'Get domain details by ID, by calling this API, the domain status will be synced from remote provider.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the domain.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_email_template' =>
  array (
    'slug' => 'logto_get_email_template',
    'class' => 'LogtoGetEmailTemplate',
    'method' => 'GET',
    'path' => '/api/email-templates/{id}',
    'operation_id' => 'GetEmailTemplate',
    'summary' => 'Get email template by ID',
    'description' => 'Get the email template by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the email template.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_enabled_sso_connectors' =>
  array (
    'slug' => 'logto_get_enabled_sso_connectors',
    'class' => 'LogtoGetEnabledSsoConnectors',
    'method' => 'GET',
    'path' => '/api/experience/sso-connectors',
    'operation_id' => 'GetEnabledSsoConnectors',
    'summary' => 'Get enabled SSO connectors by the given email\'s domain',
    'description' => 'Extract the email domain from the provided email address. Returns all the enabled SSO connectors that match the email domain.',
    'parameters' =>
    array (
      'email' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The email address to find the enabled SSO connectors.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'email' => 'email',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_enterprise_sso_identity_access_token' =>
  array (
    'slug' => 'logto_get_enterprise_sso_identity_access_token',
    'class' => 'LogtoGetEnterpriseSsoIdentityAccessToken',
    'method' => 'GET',
    'path' => '/api/my-account/sso-identities/{connectorId}/access-token',
    'operation_id' => 'GetEnterpriseSsoIdentityAccessToken',
    'summary' => 'Retrieve the access token issued by a third-party enterprise SSO provider',
    'description' => 'This API retrieves the access token issued by a third-party enterprise SSO provider for a given SSO connector ID. Access is only available if token storage is enabled for the corresponding connector. When a user authenticates through a SSO provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_grants' =>
  array (
    'slug' => 'logto_get_grants',
    'class' => 'LogtoGetGrants',
    'method' => 'GET',
    'path' => '/api/my-account/grants',
    'operation_id' => 'GetGrants',
    'summary' => 'Get all active grants',
    'description' => 'Retrieve all active application grants for the user. A logto-verification-id in header is required for checking grant details.',
    'parameters' =>
    array (
      'app_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Optional application type filter. Use \'firstParty\' to return grants from first-party applications only, or \'thirdParty\' for third-party applications only.',
        'enum' =>
        array (
          0 => 'firstParty',
          1 => 'thirdParty',
        ),
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'appType' => 'app_type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_hasura_auth' =>
  array (
    'slug' => 'logto_get_hasura_auth',
    'class' => 'LogtoGetHasuraAuth',
    'method' => 'GET',
    'path' => '/api/authn/hasura',
    'operation_id' => 'GetHasuraAuth',
    'summary' => 'Hasura auth hook endpoint',
    'description' => 'The `HASURA_GRAPHQL_AUTH_HOOK` endpoint for Hasura auth. Use this endpoint to integrate Hasura\'s [webhook authentication flow](https://hasura.io/docs/latest/auth/authentication/webhook/).',
    'parameters' =>
    array (
      'resource' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto query parameter `resource`.',
      ),
      'unauthorized_role' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `unauthorizedRole`.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'resource' => 'resource',
      'unauthorizedRole' => 'unauthorized_role',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_hook' =>
  array (
    'slug' => 'logto_get_hook',
    'class' => 'LogtoGetHook',
    'method' => 'GET',
    'path' => '/api/hooks/{id}',
    'operation_id' => 'GetHook',
    'summary' => 'Get hook',
    'description' => 'Get hook details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
      'include_execution_stats' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to include execution stats in the response.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'includeExecutionStats' => 'include_execution_stats',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_id_token_config' =>
  array (
    'slug' => 'logto_get_id_token_config',
    'class' => 'LogtoGetIdTokenConfig',
    'method' => 'GET',
    'path' => '/api/configs/id-token',
    'operation_id' => 'GetIdTokenConfig',
    'summary' => 'Get ID token claims configuration',
    'description' => 'Get the ID token extended claims configuration for the tenant. This configuration controls which extended claims (e.g., `custom_data`, `identities`, `roles`, `organizations`, `organization_roles`) are included in ID tokens.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_interaction' =>
  array (
    'slug' => 'logto_get_interaction',
    'class' => 'LogtoGetInteraction',
    'method' => 'GET',
    'path' => '/api/experience/interaction',
    'operation_id' => 'GetInteraction',
    'summary' => 'Get public interaction data',
    'description' => 'Get the public interaction data.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_jwt_customizer' =>
  array (
    'slug' => 'logto_get_jwt_customizer',
    'class' => 'LogtoGetJwtCustomizer',
    'method' => 'GET',
    'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
    'operation_id' => 'GetJwtCustomizer',
    'summary' => 'Get JWT customizer',
    'description' => 'Get the JWT customizer for the given token type.',
    'parameters' =>
    array (
      'token_type_path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The token type to get the JWT customizer for.',
        'enum' =>
        array (
          0 => 'access-token',
          1 => 'client-credentials',
        ),
      ),
    ),
    'path_params' =>
    array (
      'tokenTypePath' => 'token_type_path',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_log' =>
  array (
    'slug' => 'logto_get_log',
    'class' => 'LogtoGetLog',
    'method' => 'GET',
    'path' => '/api/logs/{id}',
    'operation_id' => 'GetLog',
    'summary' => 'Get log',
    'description' => 'Get log details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the log.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_logto_config' =>
  array (
    'slug' => 'logto_get_logto_config',
    'class' => 'LogtoGetLogtoConfig',
    'method' => 'GET',
    'path' => '/api/my-account/logto-configs',
    'operation_id' => 'GetLogtoConfig',
    'summary' => 'Get logto config',
    'description' => 'Retrieve the exposed portion of the current user\'s logto config. This includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_mfa_settings' =>
  array (
    'slug' => 'logto_get_mfa_settings',
    'class' => 'LogtoGetMfaSettings',
    'method' => 'GET',
    'path' => '/api/my-account/mfa-settings',
    'operation_id' => 'GetMfaSettings',
    'summary' => 'Get MFA settings',
    'description' => 'Get MFA settings for the user. This endpoint requires the Identities scope. Returns current MFA configuration preferences.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_mfa_verifications' =>
  array (
    'slug' => 'logto_get_mfa_verifications',
    'class' => 'LogtoGetMfaVerifications',
    'method' => 'GET',
    'path' => '/api/my-account/mfa-verifications',
    'operation_id' => 'GetMfaVerifications',
    'summary' => 'Get MFA verifications',
    'description' => 'Get MFA verifications for the user.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_new_user_counts' =>
  array (
    'slug' => 'logto_get_new_user_counts',
    'class' => 'LogtoGetNewUserCounts',
    'method' => 'GET',
    'path' => '/api/dashboard/users/new',
    'operation_id' => 'GetNewUserCounts',
    'summary' => 'Get new user count',
    'description' => 'Get new user count in the past 7 days.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_oidc_keys' =>
  array (
    'slug' => 'logto_get_oidc_keys',
    'class' => 'LogtoGetOidcKeys',
    'method' => 'GET',
    'path' => '/api/configs/oidc/{keyType}',
    'operation_id' => 'GetOidcKeys',
    'summary' => 'Get OIDC keys',
    'description' => 'Get OIDC signing keys by key type. The actual key will be redacted from the result.',
    'parameters' =>
    array (
      'key_type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Private keys are used to sign OIDC JWTs. Cookie keys are used to sign OIDC cookies. For clients, they do not need to know private keys to verify OIDC JWTs; they can use public keys from the JWKS endpoint instead.',
        'enum' =>
        array (
          0 => 'private-keys',
          1 => 'cookie-keys',
        ),
      ),
    ),
    'path_params' =>
    array (
      'keyType' => 'key_type',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_oidc_session_config' =>
  array (
    'slug' => 'logto_get_oidc_session_config',
    'class' => 'LogtoGetOidcSessionConfig',
    'method' => 'GET',
    'path' => '/api/configs/oidc/session',
    'operation_id' => 'GetOidcSessionConfig',
    'summary' => 'Get OIDC session config',
    'description' => 'Get the OIDC session configuration for the tenant.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_one_time_token' =>
  array (
    'slug' => 'logto_get_one_time_token',
    'class' => 'LogtoGetOneTimeToken',
    'method' => 'GET',
    'path' => '/api/one-time-tokens/{id}',
    'operation_id' => 'GetOneTimeToken',
    'summary' => 'Get one-time token by ID',
    'description' => 'Get a one-time token by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the one time token.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_organization' =>
  array (
    'slug' => 'logto_get_organization',
    'class' => 'LogtoGetOrganization',
    'method' => 'GET',
    'path' => '/api/organizations/{id}',
    'operation_id' => 'GetOrganization',
    'summary' => 'Get organization',
    'description' => 'Get organization details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_organization_invitation' =>
  array (
    'slug' => 'logto_get_organization_invitation',
    'class' => 'LogtoGetOrganizationInvitation',
    'method' => 'GET',
    'path' => '/api/organization-invitations/{id}',
    'operation_id' => 'GetOrganizationInvitation',
    'summary' => 'Get organization invitation',
    'description' => 'Get an organization invitation by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization invitation.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_organization_role' =>
  array (
    'slug' => 'logto_get_organization_role',
    'class' => 'LogtoGetOrganizationRole',
    'method' => 'GET',
    'path' => '/api/organization-roles/{id}',
    'operation_id' => 'GetOrganizationRole',
    'summary' => 'Get organization role',
    'description' => 'Get organization role details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_organization_scope' =>
  array (
    'slug' => 'logto_get_organization_scope',
    'class' => 'LogtoGetOrganizationScope',
    'method' => 'GET',
    'path' => '/api/organization-scopes/{id}',
    'operation_id' => 'GetOrganizationScope',
    'summary' => 'Get organization scope',
    'description' => 'Get organization scope details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization scope.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_profile' =>
  array (
    'slug' => 'logto_get_profile',
    'class' => 'LogtoGetProfile',
    'method' => 'GET',
    'path' => '/api/my-account',
    'operation_id' => 'GetProfile',
    'summary' => 'Get profile',
    'description' => 'Get profile for the user.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_resource' =>
  array (
    'slug' => 'logto_get_resource',
    'class' => 'LogtoGetResource',
    'method' => 'GET',
    'path' => '/api/resources/{id}',
    'operation_id' => 'GetResource',
    'summary' => 'Get API resource',
    'description' => 'Get an API resource details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_role' =>
  array (
    'slug' => 'logto_get_role',
    'class' => 'LogtoGetRole',
    'method' => 'GET',
    'path' => '/api/roles/{id}',
    'operation_id' => 'GetRole',
    'summary' => 'Get role',
    'description' => 'Get role details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_saml_application' =>
  array (
    'slug' => 'logto_get_saml_application',
    'class' => 'LogtoGetSamlApplication',
    'method' => 'GET',
    'path' => '/api/saml-applications/{id}',
    'operation_id' => 'GetSamlApplication',
    'summary' => 'Get SAML application',
    'description' => 'Get SAML application details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_saml_application_callback' =>
  array (
    'slug' => 'logto_get_saml_application_callback',
    'class' => 'LogtoGetSamlApplicationCallback',
    'method' => 'GET',
    'path' => '/api/saml-applications/{id}/callback',
    'operation_id' => 'GetSamlApplicationCallback',
    'summary' => 'SAML application callback',
    'description' => 'Handle the OIDC callback for SAML application and generate SAML response.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
      'code' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The authorization code from OIDC callback.',
      ),
      'state' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The state parameter from OIDC callback.',
      ),
      'redirect_uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The redirect URI for the callback.',
      ),
      'error' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `error`.',
      ),
      'error_description' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `error_description`.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'code' => 'code',
      'state' => 'state',
      'redirectUri' => 'redirect_uri',
      'error' => 'error',
      'error_description' => 'error_description',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_saml_authn' =>
  array (
    'slug' => 'logto_get_saml_authn',
    'class' => 'LogtoGetSamlAuthn',
    'method' => 'GET',
    'path' => '/api/saml/{id}/authn',
    'operation_id' => 'GetSamlAuthn',
    'summary' => 'Handle SAML authentication request (Redirect binding)',
    'description' => 'Process SAML authentication request using HTTP Redirect binding.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the SAML application.',
      ),
      'samlrequest' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The SAML request message.',
      ),
      'signature' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The signature of the request.',
      ),
      'sig_alg' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The signature algorithm.',
      ),
      'relay_state' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The relay state parameter.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'SAMLRequest' => 'samlrequest',
      'Signature' => 'signature',
      'SigAlg' => 'sig_alg',
      'RelayState' => 'relay_state',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_sessions' =>
  array (
    'slug' => 'logto_get_sessions',
    'class' => 'LogtoGetSessions',
    'method' => 'GET',
    'path' => '/api/my-account/sessions',
    'operation_id' => 'GetSessions',
    'summary' => 'Get all active sessions',
    'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available. A logto-verification-id in header is required for checking sensitive session details.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_sign_in_exp' =>
  array (
    'slug' => 'logto_get_sign_in_exp',
    'class' => 'LogtoGetSignInExp',
    'method' => 'GET',
    'path' => '/api/sign-in-exp',
    'operation_id' => 'GetSignInExp',
    'summary' => 'Get default sign-in experience settings',
    'description' => 'Get the default sign-in experience settings.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_sign_in_experience_config' =>
  array (
    'slug' => 'logto_get_sign_in_experience_config',
    'class' => 'LogtoGetSignInExperienceConfig',
    'method' => 'GET',
    'path' => '/api/.well-known/sign-in-exp',
    'operation_id' => 'GetSignInExperienceConfig',
    'summary' => 'Get full sign-in experience',
    'description' => 'Get the full sign-in experience configuration.',
    'parameters' =>
    array (
      'organization_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `organizationId`.',
      ),
      'app_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `appId`.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'organizationId' => 'organization_id',
      'appId' => 'app_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_sign_in_experience_phrases' =>
  array (
    'slug' => 'logto_get_sign_in_experience_phrases',
    'class' => 'LogtoGetSignInExperiencePhrases',
    'method' => 'GET',
    'path' => '/api/.well-known/phrases',
    'operation_id' => 'GetSignInExperiencePhrases',
    'summary' => 'Get localized phrases',
    'description' => 'Get localized phrases based on the specified language.',
    'parameters' =>
    array (
      'lng' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The language tag for localization.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'lng' => 'lng',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_social_identity_access_token' =>
  array (
    'slug' => 'logto_get_social_identity_access_token',
    'class' => 'LogtoGetSocialIdentityAccessToken',
    'method' => 'GET',
    'path' => '/api/my-account/identities/{target}/access-token',
    'operation_id' => 'GetSocialIdentityAccessToken',
    'summary' => 'Retrieve the access token issued by a third-party social provider',
    'description' => 'This API retrieves the access token issued by a third-party social provider for a given social target. Access is only available if token storage is enabled for the corresponding social connector. When a user authenticates through a social provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
    'parameters' =>
    array (
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
    ),
    'path_params' =>
    array (
      'target' => 'target',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_sso_connector' =>
  array (
    'slug' => 'logto_get_sso_connector',
    'class' => 'LogtoGetSsoConnector',
    'method' => 'GET',
    'path' => '/api/sso-connectors/{id}',
    'operation_id' => 'GetSsoConnector',
    'summary' => 'Get SSO connector',
    'description' => 'Get SSO connector data by ID. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the sso connector.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_status' =>
  array (
    'slug' => 'logto_get_status',
    'class' => 'LogtoGetStatus',
    'method' => 'GET',
    'path' => '/api/status',
    'operation_id' => 'GetStatus',
    'summary' => 'Health check',
    'description' => 'The traditional health check API. No authentication needed. > **Note** > Even if 204 is returned, it does not guarantee all the APIs are working properly since they may depend on additional resources or external services.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_swagger_json' =>
  array (
    'slug' => 'logto_get_swagger_json',
    'class' => 'LogtoGetSwaggerJson',
    'method' => 'GET',
    'path' => '/api/swagger.json',
    'operation_id' => 'GetSwaggerJson',
    'summary' => 'Get Swagger JSON',
    'description' => 'The endpoint for the current JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_system_application_config' =>
  array (
    'slug' => 'logto_get_system_application_config',
    'class' => 'LogtoGetSystemApplicationConfig',
    'method' => 'GET',
    'path' => '/api/systems/application',
    'operation_id' => 'GetSystemApplicationConfig',
    'summary' => 'Get the application constants',
    'description' => 'Get the application constants.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_total_user_count' =>
  array (
    'slug' => 'logto_get_total_user_count',
    'class' => 'LogtoGetTotalUserCount',
    'method' => 'GET',
    'path' => '/api/dashboard/users/total',
    'operation_id' => 'GetTotalUserCount',
    'summary' => 'Get total user count',
    'description' => 'Get total user count in the current tenant.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user' =>
  array (
    'slug' => 'logto_get_user',
    'class' => 'LogtoGetUser',
    'method' => 'GET',
    'path' => '/api/users/{userId}',
    'operation_id' => 'GetUser',
    'summary' => 'Get user',
    'description' => 'Get user data for the given ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'include_sso_identities' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), each user in the response will include a `ssoIdentities` property containing a list of SSO identities associated with the user.',
      ),
      'include_password_hash' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), the response will include the `passwordDigest` and `passwordAlgorithm` fields. These fields are omitted by default for security reasons.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'includeSsoIdentities' => 'include_sso_identities',
      'includePasswordHash' => 'include_password_hash',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user_asset_service_status' =>
  array (
    'slug' => 'logto_get_user_asset_service_status',
    'class' => 'LogtoGetUserAssetServiceStatus',
    'method' => 'GET',
    'path' => '/api/user-assets/service-status',
    'operation_id' => 'GetUserAssetServiceStatus',
    'summary' => 'Get service status',
    'description' => 'Get user assets service status.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user_has_password' =>
  array (
    'slug' => 'logto_get_user_has_password',
    'class' => 'LogtoGetUserHasPassword',
    'method' => 'GET',
    'path' => '/api/users/{userId}/has-password',
    'operation_id' => 'GetUserHasPassword',
    'summary' => 'Check if user has password',
    'description' => 'Check if the user with the given ID has a password set.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user_identity' =>
  array (
    'slug' => 'logto_get_user_identity',
    'class' => 'LogtoGetUserIdentity',
    'method' => 'GET',
    'path' => '/api/users/{userId}/identities/{target}',
    'operation_id' => 'GetUserIdentity',
    'summary' => 'Retrieve a user\'s social identity and associated token storage ',
    'description' => 'This API retrieves the social identity and its associated token set for the specified user from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding social connector.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
      'include_token_secret' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to include the token secret in the response. Defaults to false. Token storage must be supported and enabled by the connector to return the token secret.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'target' => 'target',
    ),
    'query_params' =>
    array (
      'includeTokenSecret' => 'include_token_secret',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user_session' =>
  array (
    'slug' => 'logto_get_user_session',
    'class' => 'LogtoGetUserSession',
    'method' => 'GET',
    'path' => '/api/users/{userId}/sessions/{sessionId}',
    'operation_id' => 'GetUserSession',
    'summary' => 'Get user active session',
    'description' => 'Retrieve a non-expired session for the user by session ID, including session metadata and interaction details when available.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'session_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the session.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'sessionId' => 'session_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_user_sso_identity' =>
  array (
    'slug' => 'logto_get_user_sso_identity',
    'class' => 'LogtoGetUserSsoIdentity',
    'method' => 'GET',
    'path' => '/api/users/{userId}/sso-identities/{ssoConnectorId}',
    'operation_id' => 'GetUserSsoIdentity',
    'summary' => 'Retrieve a user\'s enterprise SSO identity and associated token secret (if token storage is enabled)',
    'description' => 'This API retrieves the user\'s enterprise SSO identity and associated token set record from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding SSO connector.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'sso_connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the sso connector.',
      ),
      'include_token_secret' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to include the token secret in the response. Defaults to false. Token storage must be supported and enabled by the connector to return the token secret.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'ssoConnectorId' => 'sso_connector_id',
    ),
    'query_params' =>
    array (
      'includeTokenSecret' => 'include_token_secret',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_well_known_account_center' =>
  array (
    'slug' => 'logto_get_well_known_account_center',
    'class' => 'LogtoGetWellKnownAccountCenter',
    'method' => 'GET',
    'path' => '/api/.well-known/account-center',
    'operation_id' => 'GetWellKnownAccountCenter',
    'summary' => 'Get default account center',
    'description' => 'Get the default account center configuration.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_well_known_experience' =>
  array (
    'slug' => 'logto_get_well_known_experience',
    'class' => 'LogtoGetWellKnownExperience',
    'method' => 'GET',
    'path' => '/api/.well-known/experience',
    'operation_id' => 'GetWellKnownExperience',
    'summary' => 'Get full sign-in experience',
    'description' => 'Get the full sign-in experience configuration.',
    'parameters' =>
    array (
      'organization_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `organizationId`.',
      ),
      'app_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `appId`.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'organizationId' => 'organization_id',
      'appId' => 'app_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_well_known_experience_openapi_json' =>
  array (
    'slug' => 'logto_get_well_known_experience_openapi_json',
    'class' => 'LogtoGetWellKnownExperienceOpenapiJson',
    'method' => 'GET',
    'path' => '/api/.well-known/experience.openapi.json',
    'operation_id' => 'GetWellKnownExperienceOpenapiJson',
    'summary' => 'Get Experience API swagger JSON',
    'description' => 'The endpoint for the Experience API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_well_known_management_openapi_json' =>
  array (
    'slug' => 'logto_get_well_known_management_openapi_json',
    'class' => 'LogtoGetWellKnownManagementOpenapiJson',
    'method' => 'GET',
    'path' => '/api/.well-known/management.openapi.json',
    'operation_id' => 'GetWellKnownManagementOpenapiJson',
    'summary' => 'Get Management API swagger JSON',
    'description' => 'The endpoint for the Management API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_get_well_known_user_openapi_json' =>
  array (
    'slug' => 'logto_get_well_known_user_openapi_json',
    'class' => 'LogtoGetWellKnownUserOpenapiJson',
    'method' => 'GET',
    'path' => '/api/.well-known/user.openapi.json',
    'operation_id' => 'GetWellKnownUserOpenapiJson',
    'summary' => 'Get User API swagger JSON',
    'description' => 'The endpoint for the User API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_identify_user' =>
  array (
    'slug' => 'logto_identify_user',
    'class' => 'LogtoIdentifyUser',
    'method' => 'POST',
    'path' => '/api/experience/identification',
    'operation_id' => 'IdentifyUser',
    'summary' => 'Identify user for the current interaction',
    'description' => 'This API identifies the user based on the verificationId within the current experience interaction: - `SignIn` and `ForgotPassword` interactions: Verifies the user\'s identity using the provided `verificationId`. - `Register` interaction: Creates a new user account using the profile data from the current interaction. If a verificationId is provided, the profile data will first be updated with the verification record before creating the account. If not, the account is created directly from the sto',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_init_interaction' =>
  array (
    'slug' => 'logto_init_interaction',
    'class' => 'LogtoInitInteraction',
    'method' => 'PUT',
    'path' => '/api/experience',
    'operation_id' => 'InitInteraction',
    'summary' => 'Init new interaction',
    'description' => 'Init a new experience interaction with the given interaction type. Any existing interaction data will be cleared.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_list_application_organizations' =>
  array (
    'slug' => 'logto_list_application_organizations',
    'class' => 'LogtoListApplicationOrganizations',
    'method' => 'GET',
    'path' => '/api/applications/{id}/organizations',
    'operation_id' => 'ListApplicationOrganizations',
    'summary' => 'Get application organizations',
    'description' => 'Get the list of organizations that an application is associated with.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_application_protected_app_metadata_custom_domains' =>
  array (
    'slug' => 'logto_list_application_protected_app_metadata_custom_domains',
    'class' => 'LogtoListApplicationProtectedAppMetadataCustomDomains',
    'method' => 'GET',
    'path' => '/api/applications/{id}/protected-app-metadata/custom-domains',
    'operation_id' => 'ListApplicationProtectedAppMetadataCustomDomains',
    'summary' => 'Get application custom domains',
    'description' => 'Get custom domains of the specified application, the application type should be protected app.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_application_roles' =>
  array (
    'slug' => 'logto_list_application_roles',
    'class' => 'LogtoListApplicationRoles',
    'method' => 'GET',
    'path' => '/api/applications/{applicationId}/roles',
    'operation_id' => 'ListApplicationRoles',
    'summary' => 'Get application API resource roles',
    'description' => 'Get API resource roles assigned to the specified application with pagination.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_application_secrets' =>
  array (
    'slug' => 'logto_list_application_secrets',
    'class' => 'LogtoListApplicationSecrets',
    'method' => 'GET',
    'path' => '/api/applications/{id}/secrets',
    'operation_id' => 'ListApplicationSecrets',
    'summary' => 'Get application secrets',
    'description' => 'Get all the secrets for the application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_application_user_consent_organizations' =>
  array (
    'slug' => 'logto_list_application_user_consent_organizations',
    'class' => 'LogtoListApplicationUserConsentOrganizations',
    'method' => 'GET',
    'path' => '/api/applications/{id}/users/{userId}/consent-organizations',
    'operation_id' => 'ListApplicationUserConsentOrganizations',
    'summary' => 'List all the user consented organizations of a application',
    'description' => 'List all the user consented organizations for a application by application id and user id.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_application_user_consent_scopes' =>
  array (
    'slug' => 'logto_list_application_user_consent_scopes',
    'class' => 'LogtoListApplicationUserConsentScopes',
    'method' => 'GET',
    'path' => '/api/applications/{applicationId}/user-consent-scopes',
    'operation_id' => 'ListApplicationUserConsentScopes',
    'summary' => 'List all the user consent scopes of an application',
    'description' => 'List all the user consent scopes of an application by application id',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_applications' =>
  array (
    'slug' => 'logto_list_applications',
    'class' => 'LogtoListApplications',
    'method' => 'GET',
    'path' => '/api/applications',
    'operation_id' => 'ListApplications',
    'summary' => 'Get applications',
    'description' => 'Get applications that match the given query with pagination.',
    'parameters' =>
    array (
      'types' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'An array of application types to filter applications.',
      ),
      'exclude_role_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `excludeRoleId`.',
      ),
      'exclude_organization_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `excludeOrganizationId`.',
      ),
      'is_third_party' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `isThirdParty`.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'types' => 'types',
      'excludeRoleId' => 'exclude_role_id',
      'excludeOrganizationId' => 'exclude_organization_id',
      'isThirdParty' => 'is_third_party',
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_connector_factories' =>
  array (
    'slug' => 'logto_list_connector_factories',
    'class' => 'LogtoListConnectorFactories',
    'method' => 'GET',
    'path' => '/api/connector-factories',
    'operation_id' => 'ListConnectorFactories',
    'summary' => 'Get connector factories',
    'description' => 'Get all connector factories data available in Logto.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_connectors' =>
  array (
    'slug' => 'logto_list_connectors',
    'class' => 'LogtoListConnectors',
    'method' => 'GET',
    'path' => '/api/connectors',
    'operation_id' => 'ListConnectors',
    'summary' => 'Get connectors',
    'description' => 'Get all connectors in the current tenant.',
    'parameters' =>
    array (
      'target' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter connectors by target.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'target' => 'target',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_custom_phrases' =>
  array (
    'slug' => 'logto_list_custom_phrases',
    'class' => 'LogtoListCustomPhrases',
    'method' => 'GET',
    'path' => '/api/custom-phrases',
    'operation_id' => 'ListCustomPhrases',
    'summary' => 'Get all custom phrases',
    'description' => 'Get all custom phrases for all languages.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_custom_profile_fields' =>
  array (
    'slug' => 'logto_list_custom_profile_fields',
    'class' => 'LogtoListCustomProfileFields',
    'method' => 'GET',
    'path' => '/api/custom-profile-fields',
    'operation_id' => 'ListCustomProfileFields',
    'summary' => 'Get all custom profile fields',
    'description' => 'Get all custom profile fields.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_domains' =>
  array (
    'slug' => 'logto_list_domains',
    'class' => 'LogtoListDomains',
    'method' => 'GET',
    'path' => '/api/domains',
    'operation_id' => 'ListDomains',
    'summary' => 'Get domains',
    'description' => 'Get all of your custom domains.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_email_templates' =>
  array (
    'slug' => 'logto_list_email_templates',
    'class' => 'LogtoListEmailTemplates',
    'method' => 'GET',
    'path' => '/api/email-templates',
    'operation_id' => 'ListEmailTemplates',
    'summary' => 'Get email templates',
    'description' => 'Get the list of email templates.',
    'parameters' =>
    array (
      'language_tag' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The language tag of the email template, e.g., `en` or `fr`.',
      ),
      'template_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the email template, e.g. `SignIn` or `ForgotPassword`',
        'enum' =>
        array (
          0 => 'SignIn',
          1 => 'Register',
          2 => 'ForgotPassword',
          3 => 'OrganizationInvitation',
          4 => 'Generic',
          5 => 'UserPermissionValidation',
          6 => 'BindNewIdentifier',
          7 => 'MfaVerification',
          8 => 'BindMfa',
        ),
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'languageTag' => 'language_tag',
      'templateType' => 'template_type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_hook_recent_logs' =>
  array (
    'slug' => 'logto_list_hook_recent_logs',
    'class' => 'LogtoListHookRecentLogs',
    'method' => 'GET',
    'path' => '/api/hooks/{id}/recent-logs',
    'operation_id' => 'ListHookRecentLogs',
    'summary' => 'Get recent logs for a hook',
    'description' => 'Get recent logs that match the given query for the specified hook with pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
      'log_key' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The log key to filter logs.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'logKey' => 'log_key',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_hooks' =>
  array (
    'slug' => 'logto_list_hooks',
    'class' => 'LogtoListHooks',
    'method' => 'GET',
    'path' => '/api/hooks',
    'operation_id' => 'ListHooks',
    'summary' => 'Get hooks',
    'description' => 'Get a list of hooks with optional pagination.',
    'parameters' =>
    array (
      'include_execution_stats' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to include execution stats in the response.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'includeExecutionStats' => 'include_execution_stats',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_jwt_customizers' =>
  array (
    'slug' => 'logto_list_jwt_customizers',
    'class' => 'LogtoListJwtCustomizers',
    'method' => 'GET',
    'path' => '/api/configs/jwt-customizer',
    'operation_id' => 'ListJwtCustomizers',
    'summary' => 'Get all JWT customizers',
    'description' => 'Get all JWT customizers for the tenant.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_logs' =>
  array (
    'slug' => 'logto_list_logs',
    'class' => 'LogtoListLogs',
    'method' => 'GET',
    'path' => '/api/logs',
    'operation_id' => 'ListLogs',
    'summary' => 'Get logs',
    'description' => 'Get logs that match the given query with pagination.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter logs by user ID.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter logs by application ID.',
      ),
      'log_key' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter logs by log key.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'userId' => 'user_id',
      'applicationId' => 'application_id',
      'logKey' => 'log_key',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_one_time_tokens' =>
  array (
    'slug' => 'logto_list_one_time_tokens',
    'class' => 'LogtoListOneTimeTokens',
    'method' => 'GET',
    'path' => '/api/one-time-tokens',
    'operation_id' => 'ListOneTimeTokens',
    'summary' => 'Get one-time tokens',
    'description' => 'Get a list of one-time tokens, filtering by email and status, with optional pagination.',
    'parameters' =>
    array (
      'email' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter one-time tokens by email address.',
      ),
      'status' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter one-time tokens by status.',
        'enum' =>
        array (
          0 => 'active',
          1 => 'consumed',
          2 => 'revoked',
          3 => 'expired',
        ),
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'email' => 'email',
      'status' => 'status',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_application_roles' =>
  array (
    'slug' => 'logto_list_organization_application_roles',
    'class' => 'LogtoListOrganizationApplicationRoles',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
    'operation_id' => 'ListOrganizationApplicationRoles',
    'summary' => 'Get organization application roles',
    'description' => 'Get roles associated with the application in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_applications' =>
  array (
    'slug' => 'logto_list_organization_applications',
    'class' => 'LogtoListOrganizationApplications',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/applications',
    'operation_id' => 'ListOrganizationApplications',
    'summary' => 'Get organization applications',
    'description' => 'Get applications associated with the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `q`.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'q' => 'q',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_invitations' =>
  array (
    'slug' => 'logto_list_organization_invitations',
    'class' => 'LogtoListOrganizationInvitations',
    'method' => 'GET',
    'path' => '/api/organization-invitations',
    'operation_id' => 'ListOrganizationInvitations',
    'summary' => 'Get organization invitations',
    'description' => 'Get organization invitations.',
    'parameters' =>
    array (
      'organization_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `organizationId`.',
      ),
      'inviter_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `inviterId`.',
      ),
      'invitee' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `invitee`.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'organizationId' => 'organization_id',
      'inviterId' => 'inviter_id',
      'invitee' => 'invitee',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_jit_email_domains' =>
  array (
    'slug' => 'logto_list_organization_jit_email_domains',
    'class' => 'LogtoListOrganizationJitEmailDomains',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/jit/email-domains',
    'operation_id' => 'ListOrganizationJitEmailDomains',
    'summary' => 'Get organization JIT email domains',
    'description' => 'Get email domains for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_jit_roles' =>
  array (
    'slug' => 'logto_list_organization_jit_roles',
    'class' => 'LogtoListOrganizationJitRoles',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/jit/roles',
    'operation_id' => 'ListOrganizationJitRoles',
    'summary' => 'Get organization JIT default roles',
    'description' => 'Get organization roles that will be assigned to users during just-in-time provisioning.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_jit_sso_connectors' =>
  array (
    'slug' => 'logto_list_organization_jit_sso_connectors',
    'class' => 'LogtoListOrganizationJitSsoConnectors',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/jit/sso-connectors',
    'operation_id' => 'ListOrganizationJitSsoConnectors',
    'summary' => 'Get organization JIT SSO connectors',
    'description' => 'Get enterprise SSO connectors for just-in-time provisioning of users in the organization.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_role_resource_scopes' =>
  array (
    'slug' => 'logto_list_organization_role_resource_scopes',
    'class' => 'LogtoListOrganizationRoleResourceScopes',
    'method' => 'GET',
    'path' => '/api/organization-roles/{id}/resource-scopes',
    'operation_id' => 'ListOrganizationRoleResourceScopes',
    'summary' => 'Get organization role resource scopes',
    'description' => 'Get resource scopes that are assigned to the specified organization role with optional pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_role_scopes' =>
  array (
    'slug' => 'logto_list_organization_role_scopes',
    'class' => 'LogtoListOrganizationRoleScopes',
    'method' => 'GET',
    'path' => '/api/organization-roles/{id}/scopes',
    'operation_id' => 'ListOrganizationRoleScopes',
    'summary' => 'Get organization role scopes',
    'description' => 'Get organization scopes that are assigned to the specified organization role with optional pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_roles' =>
  array (
    'slug' => 'logto_list_organization_roles',
    'class' => 'LogtoListOrganizationRoles',
    'method' => 'GET',
    'path' => '/api/organization-roles',
    'operation_id' => 'ListOrganizationRoles',
    'summary' => 'Get organization roles',
    'description' => 'Get organization roles with pagination.',
    'parameters' =>
    array (
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `q`.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'q' => 'q',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_scopes' =>
  array (
    'slug' => 'logto_list_organization_scopes',
    'class' => 'LogtoListOrganizationScopes',
    'method' => 'GET',
    'path' => '/api/organization-scopes',
    'operation_id' => 'ListOrganizationScopes',
    'summary' => 'Get organization scopes',
    'description' => 'Get organization scopes that match with optional pagination.',
    'parameters' =>
    array (
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Logto query parameter `q`.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'q' => 'q',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_user_roles' =>
  array (
    'slug' => 'logto_list_organization_user_roles',
    'class' => 'LogtoListOrganizationUserRoles',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/users/{userId}/roles',
    'operation_id' => 'ListOrganizationUserRoles',
    'summary' => 'Get roles for a user in an organization',
    'description' => 'Get roles assigned to a user in the specified organization with pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_user_scopes' =>
  array (
    'slug' => 'logto_list_organization_user_scopes',
    'class' => 'LogtoListOrganizationUserScopes',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/users/{userId}/scopes',
    'operation_id' => 'ListOrganizationUserScopes',
    'summary' => 'Get scopes for a user in an organization tailored by the organization roles',
    'description' => 'Get scopes assigned to a user in the specified organization tailored by the organization roles. The scopes are derived from the organization roles assigned to the user.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organization_users' =>
  array (
    'slug' => 'logto_list_organization_users',
    'class' => 'LogtoListOrganizationUsers',
    'method' => 'GET',
    'path' => '/api/organizations/{id}/users',
    'operation_id' => 'ListOrganizationUsers',
    'summary' => 'Get organization user members',
    'description' => 'Get users that are members of the specified organization for the given query with pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The query to filter users. It will match multiple fields of users, including ID, name, username, email, and phone number. If not provided, all users will be returned.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'q' => 'q',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_organizations' =>
  array (
    'slug' => 'logto_list_organizations',
    'class' => 'LogtoListOrganizations',
    'method' => 'GET',
    'path' => '/api/organizations',
    'operation_id' => 'ListOrganizations',
    'summary' => 'Get organizations',
    'description' => 'Get organizations that match the given query with pagination.',
    'parameters' =>
    array (
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The query to filter organizations. It can be a partial ID or name. If not provided, all organizations will be returned.',
      ),
      'show_featured' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to show featured users in the organization. Featured users are randomly selected from the organization members. If not provided, `featuredUsers` will not be included in the response.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'q' => 'q',
      'showFeatured' => 'show_featured',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_resource_scopes' =>
  array (
    'slug' => 'logto_list_resource_scopes',
    'class' => 'LogtoListResourceScopes',
    'method' => 'GET',
    'path' => '/api/resources/{resourceId}/scopes',
    'operation_id' => 'ListResourceScopes',
    'summary' => 'Get API resource scopes',
    'description' => 'Get scopes (permissions) defined for an API resource.',
    'parameters' =>
    array (
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'resourceId' => 'resource_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_resources' =>
  array (
    'slug' => 'logto_list_resources',
    'class' => 'LogtoListResources',
    'method' => 'GET',
    'path' => '/api/resources',
    'operation_id' => 'ListResources',
    'summary' => 'Get API resources',
    'description' => 'Get API resources in the current tenant with pagination.',
    'parameters' =>
    array (
      'include_scopes' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), the scopes of each resource will be included in the response.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'includeScopes' => 'include_scopes',
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_role_applications' =>
  array (
    'slug' => 'logto_list_role_applications',
    'class' => 'LogtoListRoleApplications',
    'method' => 'GET',
    'path' => '/api/roles/{id}/applications',
    'operation_id' => 'ListRoleApplications',
    'summary' => 'Get role applications',
    'description' => 'Get applications that have the role assigned with pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_role_scopes' =>
  array (
    'slug' => 'logto_list_role_scopes',
    'class' => 'LogtoListRoleScopes',
    'method' => 'GET',
    'path' => '/api/roles/{id}/scopes',
    'operation_id' => 'ListRoleScopes',
    'summary' => 'Get role scopes',
    'description' => 'Get API resource scopes (permissions) linked with a role.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_role_users' =>
  array (
    'slug' => 'logto_list_role_users',
    'class' => 'LogtoListRoleUsers',
    'method' => 'GET',
    'path' => '/api/roles/{id}/users',
    'operation_id' => 'ListRoleUsers',
    'summary' => 'Get role users',
    'description' => 'Get users who have the role assigned with pagination.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_roles' =>
  array (
    'slug' => 'logto_list_roles',
    'class' => 'LogtoListRoles',
    'method' => 'GET',
    'path' => '/api/roles',
    'operation_id' => 'ListRoles',
    'summary' => 'Get roles',
    'description' => 'Get roles with filters and pagination.',
    'parameters' =>
    array (
      'exclude_user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Exclude roles assigned to a user.',
      ),
      'exclude_application_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Exclude roles assigned to an application.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by role type.',
        'enum' =>
        array (
          0 => 'User',
          1 => 'MachineToMachine',
        ),
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'excludeUserId' => 'exclude_user_id',
      'excludeApplicationId' => 'exclude_application_id',
      'type' => 'type',
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_saml_application_metadata' =>
  array (
    'slug' => 'logto_list_saml_application_metadata',
    'class' => 'LogtoListSamlApplicationMetadata',
    'method' => 'GET',
    'path' => '/api/saml-applications/{id}/metadata',
    'operation_id' => 'ListSamlApplicationMetadata',
    'summary' => 'Get SAML application metadata',
    'description' => 'Get the SAML metadata XML for the application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_saml_application_secrets' =>
  array (
    'slug' => 'logto_list_saml_application_secrets',
    'class' => 'LogtoListSamlApplicationSecrets',
    'method' => 'GET',
    'path' => '/api/saml-applications/{id}/secrets',
    'operation_id' => 'ListSamlApplicationSecrets',
    'summary' => 'List SAML application secrets',
    'description' => 'Get all signing certificates of the SAML application.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_sso_connector_providers' =>
  array (
    'slug' => 'logto_list_sso_connector_providers',
    'class' => 'LogtoListSsoConnectorProviders',
    'method' => 'GET',
    'path' => '/api/sso-connector-providers',
    'operation_id' => 'ListSsoConnectorProviders',
    'summary' => 'List all the supported SSO connector provider details',
    'description' => 'Get a complete list of supported SSO connector providers.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_sso_connectors' =>
  array (
    'slug' => 'logto_list_sso_connectors',
    'class' => 'LogtoListSsoConnectors',
    'method' => 'GET',
    'path' => '/api/sso-connectors',
    'operation_id' => 'ListSsoConnectors',
    'summary' => 'List SSO connectors',
    'description' => 'Get SSO connectors with pagination. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
    'parameters' =>
    array (
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_all_identities' =>
  array (
    'slug' => 'logto_list_user_all_identities',
    'class' => 'LogtoListUserAllIdentities',
    'method' => 'GET',
    'path' => '/api/users/{userId}/all-identities',
    'operation_id' => 'ListUserAllIdentities',
    'summary' => 'Retrieve social identities, enterprise SSO identities and associated token secret (if token storage is enabled) for a user',
    'description' => 'This API retrieves all identities (social and enterprise SSO) for a user, along with their associated token set records from the Logto Secret Vault. The token sets will only be available if token storage is enabled for the corresponding identity connector.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'include_token_secret' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to include the token secret in the response. Defaults to false. Token storage must be supported and enabled by the connector to return the token secret.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'includeTokenSecret' => 'include_token_secret',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_custom_data' =>
  array (
    'slug' => 'logto_list_user_custom_data',
    'class' => 'LogtoListUserCustomData',
    'method' => 'GET',
    'path' => '/api/users/{userId}/custom-data',
    'operation_id' => 'ListUserCustomData',
    'summary' => 'Get user custom data',
    'description' => 'Get custom data for the given user ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_grants' =>
  array (
    'slug' => 'logto_list_user_grants',
    'class' => 'LogtoListUserGrants',
    'method' => 'GET',
    'path' => '/api/users/{userId}/grants',
    'operation_id' => 'ListUserGrants',
    'summary' => 'Get user active grants',
    'description' => 'Retrieve all non-expired grants of the user. Optionally filter by application type via `appType`; when omitted, grants from all application types are returned.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'app_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Application type filter. Use \'thirdParty\' to list third-party app grants only, or \'firstParty\' to list first-party app grants only. If omitted, grants from all applications are returned.',
        'enum' =>
        array (
          0 => 'firstParty',
          1 => 'thirdParty',
        ),
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'appType' => 'app_type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_logto_configs' =>
  array (
    'slug' => 'logto_list_user_logto_configs',
    'class' => 'LogtoListUserLogtoConfigs',
    'method' => 'GET',
    'path' => '/api/users/{userId}/logto-configs',
    'operation_id' => 'ListUserLogtoConfigs',
    'summary' => 'Get user logto config',
    'description' => 'Retrieve the exposed portion of a user\'s logto config. Includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped).',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_mfa_verifications' =>
  array (
    'slug' => 'logto_list_user_mfa_verifications',
    'class' => 'LogtoListUserMfaVerifications',
    'method' => 'GET',
    'path' => '/api/users/{userId}/mfa-verifications',
    'operation_id' => 'ListUserMfaVerifications',
    'summary' => 'Get user\'s MFA verifications',
    'description' => 'Get a user\'s existing MFA verifications for a given user ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_organizations' =>
  array (
    'slug' => 'logto_list_user_organizations',
    'class' => 'LogtoListUserOrganizations',
    'method' => 'GET',
    'path' => '/api/users/{userId}/organizations',
    'operation_id' => 'ListUserOrganizations',
    'summary' => 'Get organizations for a user',
    'description' => 'Get all organizations that the user is a member of. In each organization object, the user\'s roles in that organization are included in the `organizationRoles` array.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_personal_access_tokens' =>
  array (
    'slug' => 'logto_list_user_personal_access_tokens',
    'class' => 'LogtoListUserPersonalAccessTokens',
    'method' => 'GET',
    'path' => '/api/users/{userId}/personal-access-tokens',
    'operation_id' => 'ListUserPersonalAccessTokens',
    'summary' => 'Get personal access tokens',
    'description' => 'Get all personal access tokens for the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_roles' =>
  array (
    'slug' => 'logto_list_user_roles',
    'class' => 'LogtoListUserRoles',
    'method' => 'GET',
    'path' => '/api/users/{userId}/roles',
    'operation_id' => 'ListUserRoles',
    'summary' => 'Get roles for user',
    'description' => 'Get API resource roles assigned to the user with pagination.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_user_sessions' =>
  array (
    'slug' => 'logto_list_user_sessions',
    'class' => 'LogtoListUserSessions',
    'method' => 'GET',
    'path' => '/api/users/{userId}/sessions',
    'operation_id' => 'ListUserSessions',
    'summary' => 'Get user active sessions',
    'description' => 'Retrieve all non-expired sessions for the user, including session metadata and interaction details when available.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_list_users' =>
  array (
    'slug' => 'logto_list_users',
    'class' => 'LogtoListUsers',
    'method' => 'GET',
    'path' => '/api/users',
    'operation_id' => 'ListUsers',
    'summary' => 'Get users',
    'description' => 'Get users with filters and pagination. Logto provides a very flexible way to query users. You can filter users by almost any fields with multiple modes. To learn more about the query syntax, please refer to [Advanced user search](https://docs.logto.io/docs/recipes/manage-users/advanced-user-search/).',
    'parameters' =>
    array (
      'page' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number (starts from 1).',
      ),
      'page_size' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Entries per page.',
      ),
      'search_params' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Search query parameters.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'page' => 'page',
      'page_size' => 'page_size',
      'search_params' => 'search_params',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'logto_mark_mfa_enabled' =>
  array (
    'slug' => 'logto_mark_mfa_enabled',
    'class' => 'LogtoMarkMfaEnabled',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa/mfa-enabled',
    'operation_id' => 'MarkMfaEnabled',
    'summary' => 'Mark MFA as enabled',
    'description' => 'Mark the user\'s MFA as enabled for the current interaction and persist in DB user configs upon successful submission.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_replace_application_roles' =>
  array (
    'slug' => 'logto_replace_application_roles',
    'class' => 'LogtoReplaceApplicationRoles',
    'method' => 'PUT',
    'path' => '/api/applications/{applicationId}/roles',
    'operation_id' => 'ReplaceApplicationRoles',
    'summary' => 'Update API resource roles for application',
    'description' => 'Update API resource roles assigned to the specified application. This will replace the existing API resource roles.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_application_sign_in_experience' =>
  array (
    'slug' => 'logto_replace_application_sign_in_experience',
    'class' => 'LogtoReplaceApplicationSignInExperience',
    'method' => 'PUT',
    'path' => '/api/applications/{applicationId}/sign-in-experience',
    'operation_id' => 'ReplaceApplicationSignInExperience',
    'summary' => 'Update application level sign-in experience',
    'description' => 'Update application level sign-in experience for the specified application. Create a new sign-in experience if it does not exist. - Only branding properties and terms links customization is supported for now. - Only third-party applications can be customized for now. - Application level sign-in experience customization is optional, if provided, it will override the default branding and terms links.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_application_user_consent_organizations' =>
  array (
    'slug' => 'logto_replace_application_user_consent_organizations',
    'class' => 'LogtoReplaceApplicationUserConsentOrganizations',
    'method' => 'PUT',
    'path' => '/api/applications/{id}/users/{userId}/consent-organizations',
    'operation_id' => 'ReplaceApplicationUserConsentOrganizations',
    'summary' => 'Grant a list of organization access of a user for a application',
    'description' => 'Grant a list of organization access of a user for a application by application id and user id. The user must be a member of all the organizations. Only third-party application needs to be granted access to organizations, all the other applications can request for all the organizations\' access by default.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_custom_phrase' =>
  array (
    'slug' => 'logto_replace_custom_phrase',
    'class' => 'LogtoReplaceCustomPhrase',
    'method' => 'PUT',
    'path' => '/api/custom-phrases/{languageTag}',
    'operation_id' => 'ReplaceCustomPhrase',
    'summary' => 'Upsert custom phrases',
    'description' => 'Upsert custom phrases for the specified language tag. Upsert means that if the custom phrases already exist, they will be updated. Otherwise, they will be created.',
    'parameters' =>
    array (
      'language_tag' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `languageTag`.',
        'enum' =>
        array (
          0 => 'af-ZA',
          1 => 'am-ET',
          2 => 'ar',
          3 => 'ar-AR',
          4 => 'as-IN',
          5 => 'az-AZ',
          6 => 'be-BY',
          7 => 'bg-BG',
          8 => 'bn-IN',
          9 => 'br-FR',
          10 => 'bs-BA',
          11 => 'ca-ES',
          12 => 'cb-IQ',
          13 => 'co-FR',
          14 => 'cs',
          15 => 'cs-CZ',
          16 => 'cx-PH',
          17 => 'cy-GB',
          18 => 'da-DK',
          19 => 'de',
          20 => 'de-DE',
          21 => 'el-GR',
          22 => 'en',
          23 => 'en-GB',
          24 => 'en-US',
          25 => 'eo-EO',
          26 => 'es',
          27 => 'es-ES',
          28 => 'es-419',
          29 => 'et-EE',
          30 => 'eu-ES',
          31 => 'fa-IR',
          32 => 'ff-NG',
          33 => 'fi',
          34 => 'fi-FI',
          35 => 'fo-FO',
          36 => 'fr',
          37 => 'fr-CA',
          38 => 'fr-FR',
          39 => 'fy-NL',
          40 => 'ga-IE',
          41 => 'gl-ES',
          42 => 'gn-PY',
          43 => 'gu-IN',
          44 => 'ha-NG',
          45 => 'he-IL',
          46 => 'hi-IN',
          47 => 'hr-HR',
          48 => 'ht-HT',
          49 => 'hu-HU',
          50 => 'hy-AM',
          51 => 'id-ID',
          52 => 'ik-US',
          53 => 'is-IS',
          54 => 'it',
          55 => 'it-IT',
          56 => 'iu-CA',
          57 => 'ja',
          58 => 'ja-JP',
          59 => 'ja-KS',
          60 => 'jv-ID',
          61 => 'ka-GE',
          62 => 'kk-KZ',
          63 => 'km-KH',
          64 => 'kn-IN',
          65 => 'ko',
          66 => 'ko-KR',
          67 => 'ku-TR',
          68 => 'ky-KG',
          69 => 'lo-LA',
          70 => 'lt-LT',
          71 => 'lv-LV',
          72 => 'mg-MG',
          73 => 'mk-MK',
          74 => 'ml-IN',
          75 => 'mn-MN',
          76 => 'mr-IN',
          77 => 'ms-MY',
          78 => 'mt-MT',
          79 => 'my-MM',
          80 => 'nb-NO',
          81 => 'ne-NP',
          82 => 'nl',
          83 => 'nl-BE',
          84 => 'nl-NL',
          85 => 'nn-NO',
          86 => 'or-IN',
          87 => 'pa-IN',
          88 => 'pl-PL',
          89 => 'ps-AF',
          90 => 'pt',
          91 => 'pt-BR',
          92 => 'pt-PT',
          93 => 'ro-RO',
          94 => 'ru',
          95 => 'ru-RU',
          96 => 'rw-RW',
          97 => 'sc-IT',
          98 => 'si-LK',
          99 => 'sk-SK',
          100 => 'sl-SI',
          101 => 'sn-ZW',
          102 => 'sq-AL',
          103 => 'sr-RS',
          104 => 'sv',
          105 => 'sv-SE',
          106 => 'sw-KE',
          107 => 'sy-SY',
          108 => 'sz-PL',
          109 => 'ta-IN',
          110 => 'te-IN',
          111 => 'tg-TJ',
          112 => 'th',
          113 => 'th-TH',
          114 => 'tl-PH',
          115 => 'tr',
          116 => 'tr-TR',
          117 => 'tt-RU',
          118 => 'tz-MA',
          119 => 'uk-UA',
          120 => 'ur-PK',
          121 => 'uz-UZ',
          122 => 'vi-VN',
          123 => 'zh',
          124 => 'zh-CN',
          125 => 'zh-HK',
          126 => 'zh-MO',
          127 => 'zh-TW',
          128 => 'zz-TR',
        ),
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'languageTag' => 'language_tag',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_email_templates' =>
  array (
    'slug' => 'logto_replace_email_templates',
    'class' => 'LogtoReplaceEmailTemplates',
    'method' => 'PUT',
    'path' => '/api/email-templates',
    'operation_id' => 'ReplaceEmailTemplates',
    'summary' => 'Replace email templates',
    'description' => 'Create or replace a list of email templates. If an email template with the same language tag and template type already exists, its details will be updated.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_one_time_token_status' =>
  array (
    'slug' => 'logto_replace_one_time_token_status',
    'class' => 'LogtoReplaceOneTimeTokenStatus',
    'method' => 'PUT',
    'path' => '/api/one-time-tokens/{id}/status',
    'operation_id' => 'ReplaceOneTimeTokenStatus',
    'summary' => 'Update one-time token status',
    'description' => 'Update the status of a one-time token by its ID. This can be used to mark the token as consumed or expired.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the one time token.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_application_roles' =>
  array (
    'slug' => 'logto_replace_organization_application_roles',
    'class' => 'LogtoReplaceOrganizationApplicationRoles',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
    'operation_id' => 'ReplaceOrganizationApplicationRoles',
    'summary' => 'Replace organization application roles',
    'description' => 'Replace all roles associated with the application in the organization with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_applications' =>
  array (
    'slug' => 'logto_replace_organization_applications',
    'class' => 'LogtoReplaceOrganizationApplications',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/applications',
    'operation_id' => 'ReplaceOrganizationApplications',
    'summary' => 'Replace organization applications',
    'description' => 'Replace all applications associated with the organization with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_invitation_status' =>
  array (
    'slug' => 'logto_replace_organization_invitation_status',
    'class' => 'LogtoReplaceOrganizationInvitationStatus',
    'method' => 'PUT',
    'path' => '/api/organization-invitations/{id}/status',
    'operation_id' => 'ReplaceOrganizationInvitationStatus',
    'summary' => 'Update organization invitation status',
    'description' => 'Update the status of an organization invitation by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization invitation.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_jit_email_domains' =>
  array (
    'slug' => 'logto_replace_organization_jit_email_domains',
    'class' => 'LogtoReplaceOrganizationJitEmailDomains',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/jit/email-domains',
    'operation_id' => 'ReplaceOrganizationJitEmailDomains',
    'summary' => 'Replace organization JIT email domains',
    'description' => 'Replace all just-in-time provisioning email domains for the organization with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_jit_roles' =>
  array (
    'slug' => 'logto_replace_organization_jit_roles',
    'class' => 'LogtoReplaceOrganizationJitRoles',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/jit/roles',
    'operation_id' => 'ReplaceOrganizationJitRoles',
    'summary' => 'Replace organization JIT default roles',
    'description' => 'Replace all organization roles that will be assigned to users during just-in-time provisioning with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_jit_sso_connectors' =>
  array (
    'slug' => 'logto_replace_organization_jit_sso_connectors',
    'class' => 'LogtoReplaceOrganizationJitSsoConnectors',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/jit/sso-connectors',
    'operation_id' => 'ReplaceOrganizationJitSsoConnectors',
    'summary' => 'Replace organization JIT SSO connectors',
    'description' => 'Replace all enterprise SSO connectors for just-in-time provisioning of users in the organization with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_role_resource_scopes' =>
  array (
    'slug' => 'logto_replace_organization_role_resource_scopes',
    'class' => 'LogtoReplaceOrganizationRoleResourceScopes',
    'method' => 'PUT',
    'path' => '/api/organization-roles/{id}/resource-scopes',
    'operation_id' => 'ReplaceOrganizationRoleResourceScopes',
    'summary' => 'Replace resource scopes for organization role',
    'description' => 'Replace all resource scopes that are assigned to the specified organization role with the given resource scopes. This effectively removes all existing organization scope assignments and replaces them with the new ones.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_role_scopes' =>
  array (
    'slug' => 'logto_replace_organization_role_scopes',
    'class' => 'LogtoReplaceOrganizationRoleScopes',
    'method' => 'PUT',
    'path' => '/api/organization-roles/{id}/scopes',
    'operation_id' => 'ReplaceOrganizationRoleScopes',
    'summary' => 'Replace organization scopes for organization role',
    'description' => 'Replace all organization scopes that are assigned to the specified organization role with the given organization scopes. This effectively removes all existing organization scope assignments and replaces them with the new ones.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_user_roles' =>
  array (
    'slug' => 'logto_replace_organization_user_roles',
    'class' => 'LogtoReplaceOrganizationUserRoles',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/users/{userId}/roles',
    'operation_id' => 'ReplaceOrganizationUserRoles',
    'summary' => 'Update roles for a user in an organization',
    'description' => 'Update roles assigned to a user in the specified organization with the provided data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_organization_users' =>
  array (
    'slug' => 'logto_replace_organization_users',
    'class' => 'LogtoReplaceOrganizationUsers',
    'method' => 'PUT',
    'path' => '/api/organizations/{id}/users',
    'operation_id' => 'ReplaceOrganizationUsers',
    'summary' => 'Replace organization user members',
    'description' => 'Replace all user members for the specified organization with the given users. This effectively removing all existing user memberships in the organization and adding the new users as members.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_user_identity' =>
  array (
    'slug' => 'logto_replace_user_identity',
    'class' => 'LogtoReplaceUserIdentity',
    'method' => 'PUT',
    'path' => '/api/users/{userId}/identities/{target}',
    'operation_id' => 'ReplaceUserIdentity',
    'summary' => 'Update social identity of user',
    'description' => 'Directly update a social identity of the user.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'target' => 'target',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_replace_user_roles' =>
  array (
    'slug' => 'logto_replace_user_roles',
    'class' => 'LogtoReplaceUserRoles',
    'method' => 'PUT',
    'path' => '/api/users/{userId}/roles',
    'operation_id' => 'ReplaceUserRoles',
    'summary' => 'Update roles for user',
    'description' => 'Update API resource roles assigned to the user. This will replace the existing roles.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_reset_user_password' =>
  array (
    'slug' => 'logto_reset_user_password',
    'class' => 'LogtoResetUserPassword',
    'method' => 'PUT',
    'path' => '/api/experience/profile/password',
    'operation_id' => 'ResetUserPassword',
    'summary' => 'Reset user password',
    'description' => 'Reset the user\'s password. (`ForgotPassword` interaction only)',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_rotate_oidc_keys' =>
  array (
    'slug' => 'logto_rotate_oidc_keys',
    'class' => 'LogtoRotateOidcKeys',
    'method' => 'POST',
    'path' => '/api/configs/oidc/{keyType}/rotate',
    'operation_id' => 'RotateOidcKeys',
    'summary' => 'Rotate OIDC keys',
    'description' => 'A new key will be generated and prepend to the list of keys. Only two recent keys will be kept. The oldest key will be automatically removed if there are more than two keys.',
    'parameters' =>
    array (
      'key_type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Private keys are used to sign OIDC JWTs. Cookie keys are used to sign OIDC cookies. For clients, they do not need to know private keys to verify OIDC JWTs; they can use public keys from the JWKS endpoint instead.',
        'enum' =>
        array (
          0 => 'private-keys',
          1 => 'cookie-keys',
        ),
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'keyType' => 'key_type',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_skip_mfa_binding_flow' =>
  array (
    'slug' => 'logto_skip_mfa_binding_flow',
    'class' => 'LogtoSkipMfaBindingFlow',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa/mfa-skipped',
    'operation_id' => 'SkipMfaBindingFlow',
    'summary' => 'Skip MFA binding flow',
    'description' => 'Skip MFA verification binding flow. If the MFA is enabled in the sign-in experience settings and marked as `UserControlled`, the user can skip the MFA verification binding flow by calling this API.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_skip_mfa_suggestion' =>
  array (
    'slug' => 'logto_skip_mfa_suggestion',
    'class' => 'LogtoSkipMfaSuggestion',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa/mfa-suggestion-skipped',
    'operation_id' => 'SkipMfaSuggestion',
    'summary' => 'Skip additional MFA suggestion',
    'description' => 'Mark the optional additional MFA binding suggestion as skipped for the current interaction. When multiple MFA factors are enabled and only an email/phone factor is configured, a suggestion to add another factor may be shown; this endpoint records the choice to skip.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_skip_passkey_binding' =>
  array (
    'slug' => 'logto_skip_passkey_binding',
    'class' => 'LogtoSkipPasskeyBinding',
    'method' => 'POST',
    'path' => '/api/experience/profile/mfa/passkey-skipped',
    'operation_id' => 'SkipPasskeyBinding',
    'summary' => 'Skip passkey binding',
    'description' => 'Skip passkey binding flow. The users can temporarily skip the passkey binding flow by calling this API during sign-up. On sign-in, the skip flag will be persisted to user config.',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_submit_interaction' =>
  array (
    'slug' => 'logto_submit_interaction',
    'class' => 'LogtoSubmitInteraction',
    'method' => 'POST',
    'path' => '/api/experience/submit',
    'operation_id' => 'SubmitInteraction',
    'summary' => 'Submit interaction',
    'description' => 'Submit the current interaction. - Submit the verified user identity to the OIDC provider for further authentication (SignIn and Register). - Update the user\'s profile data if any (SignIn and Register). - Reset the password and clear all the interaction records (ForgotPassword).',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_test_jwt_customizer' =>
  array (
    'slug' => 'logto_test_jwt_customizer',
    'class' => 'LogtoTestJwtCustomizer',
    'method' => 'POST',
    'path' => '/api/configs/jwt-customizer/test',
    'operation_id' => 'TestJwtCustomizer',
    'summary' => 'Test JWT customizer',
    'description' => 'Test the JWT customizer script with the given sample context and sample token payload.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_account_center_settings' =>
  array (
    'slug' => 'logto_update_account_center_settings',
    'class' => 'LogtoUpdateAccountCenterSettings',
    'method' => 'PATCH',
    'path' => '/api/account-center',
    'operation_id' => 'UpdateAccountCenterSettings',
    'summary' => 'Update account center settings',
    'description' => 'Update the account center settings with the provided settings.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_admin_console_config' =>
  array (
    'slug' => 'logto_update_admin_console_config',
    'class' => 'LogtoUpdateAdminConsoleConfig',
    'method' => 'PATCH',
    'path' => '/api/configs/admin-console',
    'operation_id' => 'UpdateAdminConsoleConfig',
    'summary' => 'Update admin console config',
    'description' => 'Update the global configuration object for Logto Console. This method performs a partial update.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_application' =>
  array (
    'slug' => 'logto_update_application',
    'class' => 'LogtoUpdateApplication',
    'method' => 'PATCH',
    'path' => '/api/applications/{id}',
    'operation_id' => 'UpdateApplication',
    'summary' => 'Update application',
    'description' => 'Update application details by ID with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_application_custom_data' =>
  array (
    'slug' => 'logto_update_application_custom_data',
    'class' => 'LogtoUpdateApplicationCustomData',
    'method' => 'PATCH',
    'path' => '/api/applications/{applicationId}/custom-data',
    'operation_id' => 'UpdateApplicationCustomData',
    'summary' => 'Update application custom data',
    'description' => 'Update the custom data of an application.',
    'parameters' =>
    array (
      'application_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'applicationId' => 'application_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_application_secret' =>
  array (
    'slug' => 'logto_update_application_secret',
    'class' => 'LogtoUpdateApplicationSecret',
    'method' => 'PATCH',
    'path' => '/api/applications/{id}/secrets/{name}',
    'operation_id' => 'UpdateApplicationSecret',
    'summary' => 'Update application secret',
    'description' => 'Update a secret for the application by name.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the application.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the secret.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_captcha_provider' =>
  array (
    'slug' => 'logto_update_captcha_provider',
    'class' => 'LogtoUpdateCaptchaProvider',
    'method' => 'PUT',
    'path' => '/api/captcha-provider',
    'operation_id' => 'UpdateCaptchaProvider',
    'summary' => 'Update captcha provider',
    'description' => 'Update the captcha provider with the provided settings.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_connector' =>
  array (
    'slug' => 'logto_update_connector',
    'class' => 'LogtoUpdateConnector',
    'method' => 'PATCH',
    'path' => '/api/connectors/{id}',
    'operation_id' => 'UpdateConnector',
    'summary' => 'Update connector',
    'description' => 'Update connector by ID with the given data. This methods performs a partial update.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_custom_profile_field_by_name' =>
  array (
    'slug' => 'logto_update_custom_profile_field_by_name',
    'class' => 'LogtoUpdateCustomProfileFieldByName',
    'method' => 'PUT',
    'path' => '/api/custom-profile-fields/{name}',
    'operation_id' => 'UpdateCustomProfileFieldByName',
    'summary' => 'Update a custom profile field by name',
    'description' => 'Update a custom profile field by name.',
    'parameters' =>
    array (
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `name`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_custom_profile_fields_sie_order' =>
  array (
    'slug' => 'logto_update_custom_profile_fields_sie_order',
    'class' => 'LogtoUpdateCustomProfileFieldsSieOrder',
    'method' => 'POST',
    'path' => '/api/custom-profile-fields/properties/sie-order',
    'operation_id' => 'UpdateCustomProfileFieldsSieOrder',
    'summary' => 'Update the display order of the custom profile fields in Sign-in Experience',
    'description' => 'Update the display order of the custom profile fields in Sign-in Experience.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_email_template_details' =>
  array (
    'slug' => 'logto_update_email_template_details',
    'class' => 'LogtoUpdateEmailTemplateDetails',
    'method' => 'PATCH',
    'path' => '/api/email-templates/{id}/details',
    'operation_id' => 'UpdateEmailTemplateDetails',
    'summary' => 'Update email template details',
    'description' => 'Update the details of an email template by its ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the email template.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_hook' =>
  array (
    'slug' => 'logto_update_hook',
    'class' => 'LogtoUpdateHook',
    'method' => 'PATCH',
    'path' => '/api/hooks/{id}',
    'operation_id' => 'UpdateHook',
    'summary' => 'Update hook',
    'description' => 'Update hook details by ID with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_hook_signing_key' =>
  array (
    'slug' => 'logto_update_hook_signing_key',
    'class' => 'LogtoUpdateHookSigningKey',
    'method' => 'PATCH',
    'path' => '/api/hooks/{id}/signing-key',
    'operation_id' => 'UpdateHookSigningKey',
    'summary' => 'Update signing key for a hook',
    'description' => 'Update the signing key for the specified hook.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the hook.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'logto_update_interaction_event' =>
  array (
    'slug' => 'logto_update_interaction_event',
    'class' => 'LogtoUpdateInteractionEvent',
    'method' => 'PUT',
    'path' => '/api/experience/interaction-event',
    'operation_id' => 'UpdateInteractionEvent',
    'summary' => 'Update interaction event',
    'description' => 'Update the current experience interaction event to the given event type. This API is used to switch the interaction event between `SignIn` and `Register`, while keeping all the verification records data.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_jwt_customizer' =>
  array (
    'slug' => 'logto_update_jwt_customizer',
    'class' => 'LogtoUpdateJwtCustomizer',
    'method' => 'PATCH',
    'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
    'operation_id' => 'UpdateJwtCustomizer',
    'summary' => 'Update JWT customizer',
    'description' => 'Update the JWT customizer for the given token type.',
    'parameters' =>
    array (
      'token_type_path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The token type to update a JWT customizer for.',
        'enum' =>
        array (
          0 => 'access-token',
          1 => 'client-credentials',
        ),
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'tokenTypePath' => 'token_type_path',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_logto_config' =>
  array (
    'slug' => 'logto_update_logto_config',
    'class' => 'LogtoUpdateLogtoConfig',
    'method' => 'PATCH',
    'path' => '/api/my-account/logto-configs',
    'operation_id' => 'UpdateLogtoConfig',
    'summary' => 'Update logto config',
    'description' => 'Update the exposed portion of the current user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_mfa_settings' =>
  array (
    'slug' => 'logto_update_mfa_settings',
    'class' => 'LogtoUpdateMfaSettings',
    'method' => 'PATCH',
    'path' => '/api/my-account/mfa-settings',
    'operation_id' => 'UpdateMfaSettings',
    'summary' => 'Update MFA settings',
    'description' => 'Update MFA settings for the user. This endpoint requires identity verification and the Identities scope. Controls whether MFA verification is required during sign-in when the user has MFA configured.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_mfa_verification_name' =>
  array (
    'slug' => 'logto_update_mfa_verification_name',
    'class' => 'LogtoUpdateMfaVerificationName',
    'method' => 'PATCH',
    'path' => '/api/my-account/mfa-verifications/{verificationId}/name',
    'operation_id' => 'UpdateMfaVerificationName',
    'summary' => 'Update a MFA verification name',
    'description' => 'Update a MFA verification name, a logto-verification-id in header is required for checking sensitive permissions. Only WebAuthn is supported for now.',
    'parameters' =>
    array (
      'verification_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the verification.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'verificationId' => 'verification_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_oidc_session_config' =>
  array (
    'slug' => 'logto_update_oidc_session_config',
    'class' => 'LogtoUpdateOidcSessionConfig',
    'method' => 'PATCH',
    'path' => '/api/configs/oidc/session',
    'operation_id' => 'UpdateOidcSessionConfig',
    'summary' => 'Update OIDC session config',
    'description' => 'Update the OIDC session configuration for the tenant. This method performs a partial update. If the configuration does not exist, it will be created.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_organization' =>
  array (
    'slug' => 'logto_update_organization',
    'class' => 'LogtoUpdateOrganization',
    'method' => 'PATCH',
    'path' => '/api/organizations/{id}',
    'operation_id' => 'UpdateOrganization',
    'summary' => 'Update organization',
    'description' => 'Update organization details by ID with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_organization_role' =>
  array (
    'slug' => 'logto_update_organization_role',
    'class' => 'LogtoUpdateOrganizationRole',
    'method' => 'PATCH',
    'path' => '/api/organization-roles/{id}',
    'operation_id' => 'UpdateOrganizationRole',
    'summary' => 'Update organization role',
    'description' => 'Update organization role details by ID with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_organization_scope' =>
  array (
    'slug' => 'logto_update_organization_scope',
    'class' => 'LogtoUpdateOrganizationScope',
    'method' => 'PATCH',
    'path' => '/api/organization-scopes/{id}',
    'operation_id' => 'UpdateOrganizationScope',
    'summary' => 'Update organization scope',
    'description' => 'Update organization scope details by ID with the given data.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the organization scope.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_other_profile' =>
  array (
    'slug' => 'logto_update_other_profile',
    'class' => 'LogtoUpdateOtherProfile',
    'method' => 'PATCH',
    'path' => '/api/my-account/profile',
    'operation_id' => 'UpdateOtherProfile',
    'summary' => 'Update other profile',
    'description' => 'Update other profile for the user, only the fields that are passed in will be updated, to update the address, the user must have the address scope.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_password' =>
  array (
    'slug' => 'logto_update_password',
    'class' => 'LogtoUpdatePassword',
    'method' => 'POST',
    'path' => '/api/my-account/password',
    'operation_id' => 'UpdatePassword',
    'summary' => 'Update password',
    'description' => 'Update password for the user, a logto-verification-id in header is required for checking sensitive permissions.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_personal_access_token_name' =>
  array (
    'slug' => 'logto_update_personal_access_token_name',
    'class' => 'LogtoUpdatePersonalAccessTokenName',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/personal-access-tokens',
    'operation_id' => 'UpdatePersonalAccessTokenName',
    'summary' => 'Update personal access token',
    'description' => 'Update a token for the user by name.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_primary_email' =>
  array (
    'slug' => 'logto_update_primary_email',
    'class' => 'LogtoUpdatePrimaryEmail',
    'method' => 'POST',
    'path' => '/api/my-account/primary-email',
    'operation_id' => 'UpdatePrimaryEmail',
    'summary' => 'Update primary email',
    'description' => 'Update primary email for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new email ownership verification.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_primary_phone' =>
  array (
    'slug' => 'logto_update_primary_phone',
    'class' => 'LogtoUpdatePrimaryPhone',
    'method' => 'POST',
    'path' => '/api/my-account/primary-phone',
    'operation_id' => 'UpdatePrimaryPhone',
    'summary' => 'Update primary phone',
    'description' => 'Update primary phone for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new phone ownership verification.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_profile' =>
  array (
    'slug' => 'logto_update_profile',
    'class' => 'LogtoUpdateProfile',
    'method' => 'PATCH',
    'path' => '/api/my-account',
    'operation_id' => 'UpdateProfile',
    'summary' => 'Update profile',
    'description' => 'Update profile for the user, only the fields that are passed in will be updated. Updating or deleting username requires a logto-verification-id header for checking sensitive permissions. Removing any sign-in identifier, including username, is rejected if it would remove the user\'s last identifier.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_resource' =>
  array (
    'slug' => 'logto_update_resource',
    'class' => 'LogtoUpdateResource',
    'method' => 'PATCH',
    'path' => '/api/resources/{id}',
    'operation_id' => 'UpdateResource',
    'summary' => 'Update API resource',
    'description' => 'Update an API resource details by ID with the given data. This method performs a partial update.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_resource_is_default' =>
  array (
    'slug' => 'logto_update_resource_is_default',
    'class' => 'LogtoUpdateResourceIsDefault',
    'method' => 'PATCH',
    'path' => '/api/resources/{id}/is-default',
    'operation_id' => 'UpdateResourceIsDefault',
    'summary' => 'Set API resource as default',
    'description' => 'Set an API resource as the default resource for the current tenant. Each tenant can have only one default API resource. If an API resource is set as default, the previously set default API resource will be set as non-default. See [this section](https://docs.logto.io/docs/references/resources/#default-api) for more information.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_resource_scope' =>
  array (
    'slug' => 'logto_update_resource_scope',
    'class' => 'LogtoUpdateResourceScope',
    'method' => 'PATCH',
    'path' => '/api/resources/{resourceId}/scopes/{scopeId}',
    'operation_id' => 'UpdateResourceScope',
    'summary' => 'Update API resource scope',
    'description' => 'Update an API resource scope (permission) for the given resource. This method performs a partial update.',
    'parameters' =>
    array (
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the resource.',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the scope.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'resourceId' => 'resource_id',
      'scopeId' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_role' =>
  array (
    'slug' => 'logto_update_role',
    'class' => 'LogtoUpdateRole',
    'method' => 'PATCH',
    'path' => '/api/roles/{id}',
    'operation_id' => 'UpdateRole',
    'summary' => 'Update role',
    'description' => 'Update role details. This method performs a partial update.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the role.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_saml_application' =>
  array (
    'slug' => 'logto_update_saml_application',
    'class' => 'LogtoUpdateSamlApplication',
    'method' => 'PATCH',
    'path' => '/api/saml-applications/{id}',
    'operation_id' => 'UpdateSamlApplication',
    'summary' => 'Update SAML application',
    'description' => 'Update SAML application details by ID.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_saml_application_secret' =>
  array (
    'slug' => 'logto_update_saml_application_secret',
    'class' => 'LogtoUpdateSamlApplicationSecret',
    'method' => 'PATCH',
    'path' => '/api/saml-applications/{id}/secrets/{secretId}',
    'operation_id' => 'UpdateSamlApplicationSecret',
    'summary' => 'Update SAML application secret',
    'description' => 'Update the status of a signing certificate.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the saml application.',
      ),
      'secret_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the secret.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
      'secretId' => 'secret_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_sign_in_exp' =>
  array (
    'slug' => 'logto_update_sign_in_exp',
    'class' => 'LogtoUpdateSignInExp',
    'method' => 'PATCH',
    'path' => '/api/sign-in-exp',
    'operation_id' => 'UpdateSignInExp',
    'summary' => 'Update default sign-in experience settings',
    'description' => 'Update the default sign-in experience settings with the provided data.',
    'parameters' =>
    array (
      'remove_unused_demo_social_connector' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Whether to remove unused demo social connectors. (These demo social connectors are only used during cloud user onboarding)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'removeUnusedDemoSocialConnector' => 'remove_unused_demo_social_connector',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_social_identity_access_token_by_verification_id' =>
  array (
    'slug' => 'logto_update_social_identity_access_token_by_verification_id',
    'class' => 'LogtoUpdateSocialIdentityAccessTokenByVerificationId',
    'method' => 'PUT',
    'path' => '/api/my-account/identities/{target}/access-token',
    'operation_id' => 'UpdateSocialIdentityAccessTokenByVerificationId',
    'summary' => 'Update the access token for a social identity by verification ID',
    'description' => 'This API updates the token storage for a social identity by a given social verification ID. It is used to fetch a new access token from the social provider and store it securely in Logto.',
    'parameters' =>
    array (
      'target' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Logto path parameter `target`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'target' => 'target',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_sso_connector' =>
  array (
    'slug' => 'logto_update_sso_connector',
    'class' => 'LogtoUpdateSsoConnector',
    'method' => 'PATCH',
    'path' => '/api/sso-connectors/{id}',
    'operation_id' => 'UpdateSsoConnector',
    'summary' => 'Update SSO connector',
    'description' => 'Update an SSO connector by ID. This method performs a partial update.',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the sso connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user' =>
  array (
    'slug' => 'logto_update_user',
    'class' => 'LogtoUpdateUser',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}',
    'operation_id' => 'UpdateUser',
    'summary' => 'Update user',
    'description' => 'Update user data for the given ID. This method performs a partial update.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_custom_data' =>
  array (
    'slug' => 'logto_update_user_custom_data',
    'class' => 'LogtoUpdateUserCustomData',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/custom-data',
    'operation_id' => 'UpdateUserCustomData',
    'summary' => 'Update user custom data',
    'description' => 'Update custom data for the given user ID. This method performs a partial update of the custom data object.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_is_suspended' =>
  array (
    'slug' => 'logto_update_user_is_suspended',
    'class' => 'LogtoUpdateUserIsSuspended',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/is-suspended',
    'operation_id' => 'UpdateUserIsSuspended',
    'summary' => 'Update user suspension status',
    'description' => 'Update user suspension status for the given ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_logto_configs' =>
  array (
    'slug' => 'logto_update_user_logto_configs',
    'class' => 'LogtoUpdateUserLogtoConfigs',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/logto-configs',
    'operation_id' => 'UpdateUserLogtoConfigs',
    'summary' => 'Update user logto config',
    'description' => 'Update the exposed portion of a user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped). All fields are optional - only provided fields will be updated.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_password' =>
  array (
    'slug' => 'logto_update_user_password',
    'class' => 'LogtoUpdateUserPassword',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/password',
    'operation_id' => 'UpdateUserPassword',
    'summary' => 'Update user password',
    'description' => 'Update user password for the given ID.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_personal_access_token' =>
  array (
    'slug' => 'logto_update_user_personal_access_token',
    'class' => 'LogtoUpdateUserPersonalAccessToken',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/personal-access-tokens/{name}',
    'operation_id' => 'UpdateUserPersonalAccessToken',
    'summary' => 'Update personal access token',
    'description' => 'Update a token for the user by name using the legacy path parameter. Deprecated: use the PATCH /personal-access-tokens endpoint instead to avoid url name encoding issues.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The current name of the token.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
      'name' => 'name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_update_user_profile' =>
  array (
    'slug' => 'logto_update_user_profile',
    'class' => 'LogtoUpdateUserProfile',
    'method' => 'PATCH',
    'path' => '/api/users/{userId}/profile',
    'operation_id' => 'UpdateUserProfile',
    'summary' => 'Update user profile',
    'description' => 'Update profile for the given user ID. This method performs a partial update of the profile object.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_upload_custom_ui_assets' =>
  array (
    'slug' => 'logto_upload_custom_ui_assets',
    'class' => 'LogtoUploadCustomUiAssets',
    'method' => 'POST',
    'path' => '/api/sign-in-exp/default/custom-ui-assets',
    'operation_id' => 'UploadCustomUiAssets',
    'summary' => 'Upload custom UI assets',
    'description' => 'Upload a zip file containing custom web assets such as HTML, CSS, and JavaScript files, then replace the default sign-in experience with the custom UI assets.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'multipart/form-data',
    'type' => 'write',
  ),
  'logto_upsert_id_token_config' =>
  array (
    'slug' => 'logto_upsert_id_token_config',
    'class' => 'LogtoUpsertIdTokenConfig',
    'method' => 'PUT',
    'path' => '/api/configs/id-token',
    'operation_id' => 'UpsertIdTokenConfig',
    'summary' => 'Upsert ID token claims configuration',
    'description' => 'Create or update the ID token extended claims configuration for the tenant. This controls which extended claims are included in ID tokens when the corresponding scopes are requested.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_upsert_jwt_customizer' =>
  array (
    'slug' => 'logto_upsert_jwt_customizer',
    'class' => 'LogtoUpsertJwtCustomizer',
    'method' => 'PUT',
    'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
    'operation_id' => 'UpsertJwtCustomizer',
    'summary' => 'Create or update JWT customizer',
    'description' => 'Create or update a JWT customizer for the given token type.',
    'parameters' =>
    array (
      'token_type_path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The token type to create a JWT customizer for.',
        'enum' =>
        array (
          0 => 'access-token',
          1 => 'client-credentials',
        ),
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'tokenTypePath' => 'token_type_path',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_backup_code' =>
  array (
    'slug' => 'logto_verify_backup_code',
    'class' => 'LogtoVerifyBackupCode',
    'method' => 'POST',
    'path' => '/api/experience/verification/backup-code/verify',
    'operation_id' => 'VerifyBackupCode',
    'summary' => 'Verify backup code',
    'description' => 'Create a new BackupCode verification record and verify the provided backup code against the user\'s backup codes. The verification record will be marked as verified if the code is correct.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_enterprise_sso_verification' =>
  array (
    'slug' => 'logto_verify_enterprise_sso_verification',
    'class' => 'LogtoVerifyEnterpriseSsoVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/sso/{connectorId}/verify',
    'operation_id' => 'VerifyEnterpriseSsoVerification',
    'summary' => 'Verify enterprise SSO verification',
    'description' => 'Verify the SSO authorization response data and get the user\'s identity from the SSO provider.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_mfa_verification_code' =>
  array (
    'slug' => 'logto_verify_mfa_verification_code',
    'class' => 'LogtoVerifyMfaVerificationCode',
    'method' => 'POST',
    'path' => '/api/experience/verification/mfa-verification-code/verify',
    'operation_id' => 'VerifyMfaVerificationCode',
    'summary' => 'Verify MFA verification code',
    'description' => 'Verify the provided MFA verification code. The verification code must have been sent using the MFA verification code endpoint. This endpoint verifies the code against the user\'s bound identifier and marks the verification as complete if successful.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_one_time_token' =>
  array (
    'slug' => 'logto_verify_one_time_token',
    'class' => 'LogtoVerifyOneTimeToken',
    'method' => 'POST',
    'path' => '/api/one-time-tokens/verify',
    'operation_id' => 'VerifyOneTimeToken',
    'summary' => 'Verify one-time token',
    'description' => 'Verify a one-time token associated with an email address. If the token is valid and not expired, it will be marked as consumed.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_one_time_token_verification' =>
  array (
    'slug' => 'logto_verify_one_time_token_verification',
    'class' => 'LogtoVerifyOneTimeTokenVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/one-time-token/verify',
    'operation_id' => 'VerifyOneTimeTokenVerification',
    'summary' => 'Verify one-time token',
    'description' => 'Verify the provided one-time token against the user\'s email. If successful, the verification record will be marked as verified.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_sign_in_passkey_authentication' =>
  array (
    'slug' => 'logto_verify_sign_in_passkey_authentication',
    'class' => 'LogtoVerifySignInPasskeyAuthentication',
    'method' => 'POST',
    'path' => '/api/experience/verification/sign-in-passkey/authentication/verify',
    'operation_id' => 'VerifySignInPasskeyAuthentication',
    'summary' => 'Verify passkey sign-in WebAuthn authentication',
    'description' => 'Verify the passkey sign-in WebAuthn authentication response against the stored authentication challenge. When `verificationId` is provided, it verifies against the challenge generated by the identifier-based authentication endpoint. When omitted, it verifies against the preflight authentication options stored in the interaction. Upon successful verification, the verification record will be marked as verified and the user will be resolved by the credential if not provided earlier.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_social_verification' =>
  array (
    'slug' => 'logto_verify_social_verification',
    'class' => 'LogtoVerifySocialVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/social/{connectorId}/verify',
    'operation_id' => 'VerifySocialVerification',
    'summary' => 'Verify social verification',
    'description' => 'Verify the social authorization response data and get the user\'s identity data from the social provider.',
    'parameters' =>
    array (
      'connector_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the connector.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'connectorId' => 'connector_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_totp_verification' =>
  array (
    'slug' => 'logto_verify_totp_verification',
    'class' => 'LogtoVerifyTotpVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/totp/verify',
    'operation_id' => 'VerifyTotpVerification',
    'summary' => 'Verify TOTP verification',
    'description' => 'Verifies the provided TOTP code against the new created TOTP secret or the existing TOTP secret. If a verificationId is provided, this API will verify the code against the TOTP secret that is associated with the verification record. Otherwise, a new TOTP verification record will be created and verified against the user\'s existing TOTP secret.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_user_password' =>
  array (
    'slug' => 'logto_verify_user_password',
    'class' => 'LogtoVerifyUserPassword',
    'method' => 'POST',
    'path' => '/api/users/{userId}/password/verify',
    'operation_id' => 'VerifyUserPassword',
    'summary' => 'Verify user password',
    'description' => 'Test if the given password matches the user\'s password.',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_verification_by_social' =>
  array (
    'slug' => 'logto_verify_verification_by_social',
    'class' => 'LogtoVerifyVerificationBySocial',
    'method' => 'POST',
    'path' => '/api/verifications/social/verify',
    'operation_id' => 'VerifyVerificationBySocial',
    'summary' => 'Verify a social verification record',
    'description' => 'Verify a social verification record by callback connector data, and save the user information to the record.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_verification_by_verification_code' =>
  array (
    'slug' => 'logto_verify_verification_by_verification_code',
    'class' => 'LogtoVerifyVerificationByVerificationCode',
    'method' => 'POST',
    'path' => '/api/verifications/verification-code/verify',
    'operation_id' => 'VerifyVerificationByVerificationCode',
    'summary' => 'Verify verification code',
    'description' => 'Verify the provided verification code against the identifier. If successful, the verification record will be marked as verified.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_verification_code' =>
  array (
    'slug' => 'logto_verify_verification_code',
    'class' => 'LogtoVerifyVerificationCode',
    'method' => 'POST',
    'path' => '/api/verification-codes/verify',
    'operation_id' => 'VerifyVerificationCode',
    'summary' => 'Verify a verification code',
    'description' => 'Verify a verification code for a specified identifier. if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_verification_code_verification' =>
  array (
    'slug' => 'logto_verify_verification_code_verification',
    'class' => 'LogtoVerifyVerificationCodeVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/verification-code/verify',
    'operation_id' => 'VerifyVerificationCodeVerification',
    'summary' => 'Verify verification code',
    'description' => 'Verify the provided verification code against the user\'s identifier. If successful, the verification record will be marked as verified.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_web_authn_authentication_verification' =>
  array (
    'slug' => 'logto_verify_web_authn_authentication_verification',
    'class' => 'LogtoVerifyWebAuthnAuthenticationVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/web-authn/authentication/verify',
    'operation_id' => 'VerifyWebAuthnAuthenticationVerification',
    'summary' => 'Verify WebAuthn authentication verification',
    'description' => 'Verifies the WebAuthn authentication response against the user\'s authentication challenge. Upon successful verification, the verification record will be marked as verified.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_web_authn_registration' =>
  array (
    'slug' => 'logto_verify_web_authn_registration',
    'class' => 'LogtoVerifyWebAuthnRegistration',
    'method' => 'POST',
    'path' => '/api/verifications/web-authn/registration/verify',
    'operation_id' => 'VerifyWebAuthnRegistration',
    'summary' => 'Verify WebAuthn registration',
    'description' => 'Verify the WebAuthn registration by the user\'s response.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'logto_verify_web_authn_registration_verification' =>
  array (
    'slug' => 'logto_verify_web_authn_registration_verification',
    'class' => 'LogtoVerifyWebAuthnRegistrationVerification',
    'method' => 'POST',
    'path' => '/api/experience/verification/web-authn/registration/verify',
    'operation_id' => 'VerifyWebAuthnRegistrationVerification',
    'summary' => 'Verify WebAuthn registration verification',
    'description' => 'Verify the WebAuthn registration response against the user\'s WebAuthn registration challenge. If the response is valid, the WebAuthn registration record will be marked as verified.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
);
    }
}
