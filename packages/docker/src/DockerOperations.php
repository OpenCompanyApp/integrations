<?php

namespace OpenCompany\Integrations\Docker;

/**
 * Official Docker Hub OpenAPI operation metadata.
 *
 * Generated from Docker's published Hub API OpenAPI document.
 */
final class DockerOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'docker_post_users_login' =>
  array (
    'slug' => 'docker_post_users_login',
    'class' => 'DockerPostUsersLogin',
    'type' => 'write',
    'name' => 'Create an authentication token',
    'description' => 'Creates and returns a bearer token in JWT format that you can use to authenticate with Docker Hub APIs. The returned token is used in the HTTP Authorization header like `Authorization: Bearer {TOKEN}`. _**As of September 16, 2024, this route requires a personal access token (PAT) instead of a password if your organization has SSO enforced.**_ <div style="background-color:rgb(255, 165, 0, .25); padding:5px; border-radius:4px"> <strong>Deprecated</strong>: Use [<a href="#tag/authentication-api/operation/AuthCreateAccessToken">Create access token</a>] instead. </div>',
    'operation_id' => 'PostUsersLogin',
    'method' => 'POST',
    'path' => '/v2/users/login',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Login details.',
    ),
  ),
  'docker_post_users2_f_a_login' =>
  array (
    'slug' => 'docker_post_users2_f_a_login',
    'class' => 'DockerPostUsers2FALogin',
    'type' => 'write',
    'name' => 'Second factor authentication',
    'description' => 'When a user has two-factor authentication (2FA) enabled, this is the second call to perform after `/v2/users/login` call. Creates and returns a bearer token in JWT format that you can use to authenticate with Docker Hub APIs. The returned token is used in the HTTP Authorization header like `Authorization: Bearer {TOKEN}`. Most Docker Hub APIs require this token either to consume or to get detailed information. For example, to list images in a private repository.',
    'operation_id' => 'PostUsers2FALogin',
    'method' => 'POST',
    'path' => '/v2/users/2fa-login',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Login details.',
    ),
  ),
  'docker_auth_create_access_token' =>
  array (
    'slug' => 'docker_auth_create_access_token',
    'class' => 'DockerAuthCreateAccessToken',
    'type' => 'write',
    'name' => 'Create access token',
    'description' => 'Creates and returns a short-lived access token in JWT format for use as a bearer when calling Docker APIs. If successful, the access token returned should be used in the HTTP Authorization header like `Authorization: Bearer {access_token}`. _**If your organization has SSO enforced, you must use a personal access token (PAT) instead of a password.**_',
    'operation_id' => 'AuthCreateAccessToken',
    'method' => 'POST',
    'path' => '/v2/auth/token',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_access_tokens' =>
  array (
    'slug' => 'docker_get_v2_access_tokens',
    'class' => 'DockerGetV2AccessTokens',
    'type' => 'read',
    'name' => 'List personal access tokens',
    'description' => 'Returns a paginated list of personal access tokens.',
    'operation_id' => 'get_v2/access-tokens',
    'method' => 'GET',
    'path' => '/v2/access-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'number',
      ),
      1 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'number',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_access_tokens' =>
  array (
    'slug' => 'docker_post_v2_access_tokens',
    'class' => 'DockerPostV2AccessTokens',
    'type' => 'write',
    'name' => 'Create personal access token',
    'description' => 'Creates and returns a personal access token.',
    'operation_id' => 'post_v2/access-tokens',
    'method' => 'POST',
    'path' => '/v2/access-tokens',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_access_tokens_by_uuid' =>
  array (
    'slug' => 'docker_get_v2_access_tokens_by_uuid',
    'class' => 'DockerGetV2AccessTokensByUuid',
    'type' => 'read',
    'name' => 'Get personal access token',
    'description' => 'Returns a personal access token by UUID.',
    'operation_id' => 'get_v2/access-tokens/by_uuid',
    'method' => 'GET',
    'path' => '/v2/access-tokens/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_patch_v2_access_tokens_by_uuid' =>
  array (
    'slug' => 'docker_patch_v2_access_tokens_by_uuid',
    'class' => 'DockerPatchV2AccessTokensByUuid',
    'type' => 'write',
    'name' => 'Update personal access token',
    'description' => 'Updates a personal access token partially. You can either update the token\'s label or enable/disable it.',
    'operation_id' => 'patch_v2/access-tokens/by_uuid',
    'method' => 'PATCH',
    'path' => '/v2/access-tokens/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_delete_v2_access_tokens_by_uuid' =>
  array (
    'slug' => 'docker_delete_v2_access_tokens_by_uuid',
    'class' => 'DockerDeleteV2AccessTokensByUuid',
    'type' => 'write',
    'name' => 'Delete personal access token',
    'description' => 'Deletes a personal access token permanently. This cannot be undone.',
    'operation_id' => 'delete_v2/access-tokens/by_uuid',
    'method' => 'DELETE',
    'path' => '/v2/access-tokens/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_audit_logs_list_audit_actions' =>
  array (
    'slug' => 'docker_audit_logs_list_audit_actions',
    'class' => 'DockerAuditLogsListAuditActions',
    'type' => 'read',
    'name' => 'List audit log actions',
    'description' => 'List audit log actions for a namespace to be used as a filter for querying audit log events. <span class="oat"></span>',
    'operation_id' => 'AuditLogs_ListAuditActions',
    'method' => 'GET',
    'path' => '/v2/auditlogs/{account}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'account',
        'in' => 'path',
        'required' => true,
        'description' => 'Namespace to query audit log actions for.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_audit_logs_list_audit_logs' =>
  array (
    'slug' => 'docker_audit_logs_list_audit_logs',
    'class' => 'DockerAuditLogsListAuditLogs',
    'type' => 'read',
    'name' => 'List audit log events',
    'description' => 'List audit log events for a given namespace. <span class="oat"></span>',
    'operation_id' => 'AuditLogs_ListAuditLogs',
    'method' => 'GET',
    'path' => '/v2/auditlogs/{account}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'account',
        'in' => 'path',
        'required' => true,
        'description' => 'Namespace to query audit logs for.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'action',
        'in' => 'query',
        'required' => false,
        'description' => 'action name one of ["repo.tag.push", ...]. Optional parameter to filter specific audit log actions.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'name. Optional parameter to filter audit log events to a specific name. For repository events, this is the name of the repository. For organization events, this is the name of the organization. For team member events, this is the username of the team member.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'actor',
        'in' => 'query',
        'required' => false,
        'description' => 'actor name. Optional parameter to filter audit log events to the specific user who triggered the event.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => false,
        'description' => 'Start of the time window you wish to query audit events for.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => false,
        'description' => 'End of the time window you wish to query audit events for.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'page - specify page number. Page number to get.',
        'schema_type' => 'integer',
      ),
      7 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'page_size - specify page size. Number of events to return per page.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_name_settings' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_name_settings',
    'class' => 'DockerGetV2OrgsByNameSettings',
    'type' => 'read',
    'name' => 'Get organization settings',
    'description' => 'Returns organization settings by name.',
    'operation_id' => 'get_v2/orgs/by_name/settings',
    'method' => 'GET',
    'path' => '/v2/orgs/{name}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_put_v2_orgs_by_name_settings' =>
  array (
    'slug' => 'docker_put_v2_orgs_by_name_settings',
    'class' => 'DockerPutV2OrgsByNameSettings',
    'type' => 'write',
    'name' => 'Update organization settings',
    'description' => 'Updates an organization\'s settings. Some settings are only used when the organization is on a business subscription. ***Only users with administrative privileges for the organization (owner role) can modify these settings.*** The following settings are only used on a business subscription: - `restricted_images`',
    'operation_id' => 'put_v2/orgs/by_name/settings',
    'method' => 'PUT',
    'path' => '/v2/orgs/{name}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_orgs_by_name_access_tokens' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_name_access_tokens',
    'class' => 'DockerGetV2OrgsByNameAccessTokens',
    'type' => 'read',
    'name' => 'List access tokens',
    'description' => 'List access tokens for an organization.',
    'operation_id' => 'get_v2/orgs/by_name/access-tokens',
    'method' => 'GET',
    'path' => '/v2/orgs/{name}/access-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'number',
      ),
      1 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'number',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_orgs_by_name_access_tokens' =>
  array (
    'slug' => 'docker_post_v2_orgs_by_name_access_tokens',
    'class' => 'DockerPostV2OrgsByNameAccessTokens',
    'type' => 'write',
    'name' => 'Create access token',
    'description' => 'Create an access token for an organization.',
    'operation_id' => 'post_v2/orgs/by_name/access-tokens',
    'method' => 'POST',
    'path' => '/v2/orgs/{name}/access-tokens',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_orgs_by_org_name_access_tokens_by_access_token_id' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_access_tokens_by_access_token_id',
    'class' => 'DockerGetV2OrgsByOrgNameAccessTokensByAccessTokenId',
    'type' => 'read',
    'name' => 'Get access token',
    'description' => 'Get details of a specific access token for an organization.',
    'operation_id' => 'get_v2/orgs/by_org_name/access-tokens/by_access_token_id',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/access-tokens/{access_token_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'access_token_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the access token to retrieve',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_patch_v2_orgs_by_org_name_access_tokens_by_access_token_id' =>
  array (
    'slug' => 'docker_patch_v2_orgs_by_org_name_access_tokens_by_access_token_id',
    'class' => 'DockerPatchV2OrgsByOrgNameAccessTokensByAccessTokenId',
    'type' => 'write',
    'name' => 'Update access token',
    'description' => 'Update a specific access token for an organization.',
    'operation_id' => 'patch_v2/orgs/by_org_name/access-tokens/by_access_token_id',
    'method' => 'PATCH',
    'path' => '/v2/orgs/{org_name}/access-tokens/{access_token_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'access_token_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the access token to retrieve',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_delete_v2_orgs_by_org_name_access_tokens_by_access_token_id' =>
  array (
    'slug' => 'docker_delete_v2_orgs_by_org_name_access_tokens_by_access_token_id',
    'class' => 'DockerDeleteV2OrgsByOrgNameAccessTokensByAccessTokenId',
    'type' => 'write',
    'name' => 'Delete access token',
    'description' => 'Delete a specific access token for an organization. This action cannot be undone.',
    'operation_id' => 'delete_v2/orgs/by_org_name/access-tokens/by_access_token_id',
    'method' => 'DELETE',
    'path' => '/v2/orgs/{org_name}/access-tokens/{access_token_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'access_token_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the access token to retrieve',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_list_tags' =>
  array (
    'slug' => 'docker_list_tags',
    'class' => 'DockerListTags',
    'type' => 'read',
    'name' => 'List repository tags',
    'description' => 'List repository tags (GET /v2/namespaces/{namespace}/repositories/{repository}/tags).',
    'operation_id' => 'ListRepositoryTags',
    'method' => 'GET',
    'path' => '/v2/namespaces/{namespace}/repositories/{repository}/tags',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to get. Defaults to 1.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items to get per page. Defaults to 10. Max of 100.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_tag' =>
  array (
    'slug' => 'docker_get_tag',
    'class' => 'DockerGetTag',
    'type' => 'read',
    'name' => 'Read repository tag',
    'description' => 'Read repository tag (GET /v2/namespaces/{namespace}/repositories/{repository}/tags/{tag}).',
    'operation_id' => 'GetRepositoryTag',
    'method' => 'GET',
    'path' => '/v2/namespaces/{namespace}/repositories/{repository}/tags/{tag}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'tag',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_update_repository_immutable_tags' =>
  array (
    'slug' => 'docker_update_repository_immutable_tags',
    'class' => 'DockerUpdateRepositoryImmutableTags',
    'type' => 'write',
    'name' => 'Update repository immutable tags',
    'description' => 'Updates the immutable tags configuration for this repository. **Only users with administrative privileges for the repository can modify these settings.**',
    'operation_id' => 'UpdateRepositoryImmutableTags',
    'method' => 'PATCH',
    'path' => '/v2/namespaces/{namespace}/repositories/{repository}/immutabletags',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_verify_repository_immutable_tags' =>
  array (
    'slug' => 'docker_verify_repository_immutable_tags',
    'class' => 'DockerVerifyRepositoryImmutableTags',
    'type' => 'write',
    'name' => 'Verify repository immutable tags',
    'description' => 'Validates the immutable tags regex pass in parameter and returns a list of tags matching it in this repository. **Only users with administrative privileges for the repository call this endpoint.**',
    'operation_id' => 'VerifyRepositoryImmutableTags',
    'method' => 'POST',
    'path' => '/v2/namespaces/{namespace}/repositories/{repository}/immutabletags/verify',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_create_repository_group' =>
  array (
    'slug' => 'docker_create_repository_group',
    'class' => 'DockerCreateRepositoryGroup',
    'type' => 'write',
    'name' => 'Assign a group (Team) to a repository for access',
    'description' => 'Assign a group (Team) to a repository for access (POST /v2/repositories/{namespace}/{repository}/groups).',
    'operation_id' => 'CreateRepositoryGroup',
    'method' => 'POST',
    'path' => '/v2/repositories/{namespace}/{repository}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_list_repositories' =>
  array (
    'slug' => 'docker_list_repositories',
    'class' => 'DockerListRepositories',
    'type' => 'read',
    'name' => 'List repositories in a namespace',
    'description' => 'Returns a list of repositories within the specified namespace (organization or user). Public repositories are accessible to everyone, while private repositories require appropriate authentication and permissions.',
    'operation_id' => 'listNamespaceRepositories',
    'method' => 'GET',
    'path' => '/v2/namespaces/{namespace}/repositories',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to get. Defaults to 1.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of repositories to get per page. Defaults to 10. Max of 100.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter repositories by name (partial match).',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'ordering',
        'in' => 'query',
        'required' => false,
        'description' => 'Order repositories by the specified field. Prefix with \'-\' for descending order. Available options: - `name` / `-name`: Repository name (ascending/descending) - `last_updated` / `-last_updated`: Last update time (ascending/descending) - `pull_count` / `-pull_count`: Number of pulls (ascending/descending)',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_create_repository' =>
  array (
    'slug' => 'docker_create_repository',
    'class' => 'DockerCreateRepository',
    'type' => 'write',
    'name' => 'Create a new repository',
    'description' => 'Creates a new repository within the specified namespace. The repository will be created with the provided metadata including name, description, and privacy settings.',
    'operation_id' => 'CreateRepository',
    'method' => 'POST',
    'path' => '/v2/namespaces/{namespace}/repositories',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_repository' =>
  array (
    'slug' => 'docker_get_repository',
    'class' => 'DockerGetRepository',
    'type' => 'read',
    'name' => 'Get repository in a namespace',
    'description' => 'Returns a repository within the specified namespace (organization or user). Public repositories are accessible to everyone, while private repositories require appropriate authentication and permissions.',
    'operation_id' => 'GetRepository',
    'method' => 'GET',
    'path' => '/v2/namespaces/{namespace}/repositories/{repository}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'namespace',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'repository',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_org_name_members' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_members',
    'class' => 'DockerGetV2OrgsByOrgNameMembers',
    'type' => 'read',
    'name' => 'List org members',
    'description' => 'Returns a list of members for an organization. _The following fields are only visible to orgs with insights enabled._ - `last_logged_in_at` - `last_seen_at` - `last_desktop_version` To make visible, please see [View Insights for organization users](https://docs.docker.com/admin/insights/#view-insights-for-organization-users). <span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/members',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'description' => 'Search term.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number (starts on 1).',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items (rows) per page.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'invites',
        'in' => 'query',
        'required' => false,
        'description' => 'Include invites in the response.',
        'schema_type' => 'boolean',
      ),
      5 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'role',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_org_name_members_export' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_members_export',
    'class' => 'DockerGetV2OrgsByOrgNameMembersExport',
    'type' => 'read',
    'name' => 'Export org members CSV',
    'description' => 'Export members of an organization as a CSV <span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/members/export',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/members/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_put_v2_orgs_by_org_name_members_by_username' =>
  array (
    'slug' => 'docker_put_v2_orgs_by_org_name_members_by_username',
    'class' => 'DockerPutV2OrgsByOrgNameMembersByUsername',
    'type' => 'write',
    'name' => 'Update org member (role)',
    'description' => 'Updates the role of a member in the organization. ***Only users in the "owners" group of the organization can use this endpoint.*** <span class="oat"></span>',
    'operation_id' => 'put_v2/orgs/by_org_name/members/by_username',
    'method' => 'PUT',
    'path' => '/v2/orgs/{org_name}/members/{username}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'path',
        'required' => true,
        'description' => 'Username, identifier for the user (namespace, DockerID).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_delete_v2_orgs_by_org_name_members_by_username' =>
  array (
    'slug' => 'docker_delete_v2_orgs_by_org_name_members_by_username',
    'class' => 'DockerDeleteV2OrgsByOrgNameMembersByUsername',
    'type' => 'write',
    'name' => 'Remove member from org',
    'description' => 'Removes the member from the org, ie. all groups in the org, unless they\'re the last owner <span class="oat"></span>',
    'operation_id' => 'delete_v2/orgs/by_org_name/members/by_username',
    'method' => 'DELETE',
    'path' => '/v2/orgs/{org_name}/members/{username}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'path',
        'required' => true,
        'description' => 'Username, identifier for the user (namespace, DockerID).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_org_name_invites' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_invites',
    'class' => 'DockerGetV2OrgsByOrgNameInvites',
    'type' => 'read',
    'name' => 'List org invites',
    'description' => 'Return all pending invites for a given org, only team owners can call this endpoint <span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/invites',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/invites',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_org_name_groups' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_groups',
    'class' => 'DockerGetV2OrgsByOrgNameGroups',
    'type' => 'read',
    'name' => 'Get groups of an organization',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/groups',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number (starts on 1).',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items (rows) per page.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'username',
        'in' => 'query',
        'required' => false,
        'description' => 'Get groups for the specified username in the organization.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'description' => 'Get groups for the specified group in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_orgs_by_org_name_groups' =>
  array (
    'slug' => 'docker_post_v2_orgs_by_org_name_groups',
    'class' => 'DockerPostV2OrgsByOrgNameGroups',
    'type' => 'write',
    'name' => 'Create a new group',
    'description' => 'Create a new group within an organization. <span class="oat"></span>',
    'operation_id' => 'post_v2/orgs/by_org_name/groups',
    'method' => 'POST',
    'path' => '/v2/orgs/{org_name}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_orgs_by_org_name_groups_by_group_name' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_groups_by_group_name',
    'class' => 'DockerGetV2OrgsByOrgNameGroupsByGroupName',
    'type' => 'read',
    'name' => 'Get a group of an organization',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/groups/by_group_name',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_put_v2_orgs_by_org_name_groups_by_group_name' =>
  array (
    'slug' => 'docker_put_v2_orgs_by_org_name_groups_by_group_name',
    'class' => 'DockerPutV2OrgsByOrgNameGroupsByGroupName',
    'type' => 'write',
    'name' => 'Update the details for an organization group',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'put_v2/orgs/by_org_name/groups/by_group_name',
    'method' => 'PUT',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_patch_v2_orgs_by_org_name_groups_by_group_name' =>
  array (
    'slug' => 'docker_patch_v2_orgs_by_org_name_groups_by_group_name',
    'class' => 'DockerPatchV2OrgsByOrgNameGroupsByGroupName',
    'type' => 'write',
    'name' => 'Update some details for an organization group',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'patch_v2/orgs/by_org_name/groups/by_group_name',
    'method' => 'PATCH',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_delete_v2_orgs_by_org_name_groups_by_group_name' =>
  array (
    'slug' => 'docker_delete_v2_orgs_by_org_name_groups_by_group_name',
    'class' => 'DockerDeleteV2OrgsByOrgNameGroupsByGroupName',
    'type' => 'write',
    'name' => 'Delete an organization group',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'delete_v2/orgs/by_org_name/groups/by_group_name',
    'method' => 'DELETE',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_orgs_by_org_name_groups_by_group_name_members' =>
  array (
    'slug' => 'docker_get_v2_orgs_by_org_name_groups_by_group_name_members',
    'class' => 'DockerGetV2OrgsByOrgNameGroupsByGroupNameMembers',
    'type' => 'read',
    'name' => 'List members of a group',
    'description' => 'List the members (users) that are in a group. If user is owner of the org or has otherwise elevated permissions, they can search by email and the result will also contain emails. <span class="oat"></span>',
    'operation_id' => 'get_v2/orgs/by_org_name/groups/by_group_name/members',
    'method' => 'GET',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number (starts on 1).',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items (rows) per page.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'description' => 'Search members by username, full_name or email.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_orgs_by_org_name_groups_by_group_name_members' =>
  array (
    'slug' => 'docker_post_v2_orgs_by_org_name_groups_by_group_name_members',
    'class' => 'DockerPostV2OrgsByOrgNameGroupsByGroupNameMembers',
    'type' => 'write',
    'name' => 'Add a member to a group',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'post_v2/orgs/by_org_name/groups/by_group_name/members',
    'method' => 'POST',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_delete_v2_orgs_by_org_name_groups_by_group_name_members_by_username' =>
  array (
    'slug' => 'docker_delete_v2_orgs_by_org_name_groups_by_group_name_members_by_username',
    'class' => 'DockerDeleteV2OrgsByOrgNameGroupsByGroupNameMembersByUsername',
    'type' => 'write',
    'name' => 'Remove a user from a group',
    'description' => '<span class="oat"></span>',
    'operation_id' => 'delete_v2/orgs/by_org_name/groups/by_group_name/members/by_username',
    'method' => 'DELETE',
    'path' => '/v2/orgs/{org_name}/groups/{group_name}/members/{username}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the organization (namespace).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'group_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Name of the group (team) in the organization.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'username',
        'in' => 'path',
        'required' => true,
        'description' => 'Username, identifier for the user (namespace, DockerID).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_delete_v2_invites_by_id' =>
  array (
    'slug' => 'docker_delete_v2_invites_by_id',
    'class' => 'DockerDeleteV2InvitesById',
    'type' => 'write',
    'name' => 'Cancel an invite',
    'description' => 'Mark the invite as cancelled so it doesn\'t show up on the list of pending invites <span class="oat"></span>',
    'operation_id' => 'delete_v2/invites/by_id',
    'method' => 'DELETE',
    'path' => '/v2/invites/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_patch_v2_invites_by_id_resend' =>
  array (
    'slug' => 'docker_patch_v2_invites_by_id_resend',
    'class' => 'DockerPatchV2InvitesByIdResend',
    'type' => 'write',
    'name' => 'Resend an invite',
    'description' => 'Resend a pending invite to the user, any org owner can resend an invite <span class="oat"></span>',
    'operation_id' => 'patch_v2/invites/by_id/resend',
    'method' => 'PATCH',
    'path' => '/v2/invites/{id}/resend',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_invites_bulk' =>
  array (
    'slug' => 'docker_post_v2_invites_bulk',
    'class' => 'DockerPostV2InvitesBulk',
    'type' => 'write',
    'name' => 'Bulk create invites',
    'description' => 'Create multiple invites by emails or DockerIDs. Only a team owner can create invites. <span class="oat"></span>',
    'operation_id' => 'post_v2/invites/bulk',
    'method' => 'POST',
    'path' => '/v2/invites/bulk',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Analytics-Client-Feature',
        'in' => 'header',
        'required' => false,
        'description' => 'Optional string that indicates the feature used to submit the bulk invites (e.g.\'file\', \'web\')',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_scim_2_0_service_provider_config' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_service_provider_config',
    'class' => 'DockerGetV2Scim20ServiceProviderConfig',
    'type' => 'read',
    'name' => 'Get service provider config',
    'description' => 'Returns a service provider config for Docker\'s configuration.',
    'operation_id' => 'get_v2/scim/2.0/ServiceProviderConfig',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/ServiceProviderConfig',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_scim_2_0_resource_types' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_resource_types',
    'class' => 'DockerGetV2Scim20ResourceTypes',
    'type' => 'read',
    'name' => 'List resource types',
    'description' => 'Returns all resource types supported for the SCIM configuration.',
    'operation_id' => 'get_v2/scim/2.0/ResourceTypes',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/ResourceTypes',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_scim_2_0_resource_types_by_name' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_resource_types_by_name',
    'class' => 'DockerGetV2Scim20ResourceTypesByName',
    'type' => 'read',
    'name' => 'Get a resource type',
    'description' => 'Returns a resource type by name.',
    'operation_id' => 'get_v2/scim/2.0/ResourceTypes/by_name',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/ResourceTypes/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_scim_2_0_schemas' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_schemas',
    'class' => 'DockerGetV2Scim20Schemas',
    'type' => 'read',
    'name' => 'List schemas',
    'description' => 'Returns all schemas supported for the SCIM configuration.',
    'operation_id' => 'get_v2/scim/2.0/Schemas',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/Schemas',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_scim_2_0_schemas_by_id' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_schemas_by_id',
    'class' => 'DockerGetV2Scim20SchemasById',
    'type' => 'read',
    'name' => 'Get a schema',
    'description' => 'Returns a schema by ID.',
    'operation_id' => 'get_v2/scim/2.0/Schemas/by_id',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/Schemas/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_get_v2_scim_2_0_users' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_users',
    'class' => 'DockerGetV2Scim20Users',
    'type' => 'read',
    'name' => 'List users',
    'description' => 'Returns paginated users for an organization. Use `startIndex` and `count` query parameters to receive paginated results. **Sorting:** Sorting allows you to specify the order in which resources are returned by specifying a combination of `sortBy` and `sortOrder` query parameters. The `sortBy` parameter specifies the attribute whose value will be used to order the returned responses. The `sortOrder` parameter defines the order in which the `sortBy` parameter is applied. Allowed values are "ascending" and "descending". **Filtering:** You can request a subset of resources by specifying the `filter` query parameter containing a filter expression. Attribute names and attribute operators used in filters are case insensitive. The filter parameter must contain at least one valid expression. Each expression must contain an attribute name followed by an attribute operator and an optional value. Supported operators are listed below. - `eq` equal - `ne` not equal - `co` contains - `sw` starts with - `and` Logical "and" - `or` Logical "or" - `not` "Not" function - `()` Precedence grouping',
    'operation_id' => 'get_v2/scim/2.0/Users',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/Users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startIndex',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'count',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Comma delimited list of attributes to limit to in the response.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'sortOrder',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Docker Hub API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'sortBy',
        'in' => 'query',
        'required' => false,
        'description' => 'User attribute to sort by.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_post_v2_scim_2_0_users' =>
  array (
    'slug' => 'docker_post_v2_scim_2_0_users',
    'class' => 'DockerPostV2Scim20Users',
    'type' => 'write',
    'name' => 'Create user',
    'description' => 'Creates a user. If the user already exists by email, they are assigned to the organization on the "company" team.',
    'operation_id' => 'post_v2/scim/2.0/Users',
    'method' => 'POST',
    'path' => '/v2/scim/2.0/Users',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/scim+json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
  'docker_get_v2_scim_2_0_users_by_id' =>
  array (
    'slug' => 'docker_get_v2_scim_2_0_users_by_id',
    'class' => 'DockerGetV2Scim20UsersById',
    'type' => 'read',
    'name' => 'Get a user',
    'description' => 'Returns a user by ID.',
    'operation_id' => 'get_v2/scim/2.0/Users/by_id',
    'method' => 'GET',
    'path' => '/v2/scim/2.0/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The user ID.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'docker_put_v2_scim_2_0_users_by_id' =>
  array (
    'slug' => 'docker_put_v2_scim_2_0_users_by_id',
    'class' => 'DockerPutV2Scim20UsersById',
    'type' => 'write',
    'name' => 'Update a user',
    'description' => 'Updates a user. This route is used to change the user\'s name, activate, and deactivate the user.',
    'operation_id' => 'put_v2/scim/2.0/Users/by_id',
    'method' => 'PUT',
    'path' => '/v2/scim/2.0/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The user ID.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/scim+json',
      ),
      'description' => 'Execute the Docker Hub API operation.',
    ),
  ),
);
    }
}
