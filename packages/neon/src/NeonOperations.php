<?php

namespace OpenCompany\Integrations\Neon;

/**
 * Generated metadata for official Neon OpenAPI operations.
 *
 * Source: https://neon.com/api_spec/release/v2.json
 */
class NeonOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'neon_get_project_advisor_security_issues' =>
  array (
    'slug' => 'neon_get_project_advisor_security_issues',
    'class' => 'NeonGetProjectAdvisorSecurityIssues',
    'method' => 'GET',
    'path' => '/projects/{project_id}/advisors',
    'operation_id' => 'getProjectAdvisorSecurityIssues',
    'name' => 'Get advisor issues',
    'description' => 'Analyzes the database for security and performance issues. Returns a list of issues categorized by severity ERROR, WARN, INFO. Requires read access to the project and Data API enabled.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Branch ID to analyze. If not specified, the project\'s default branch is used.',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Database name to analyze. Required if branch has multiple databases.',
      ),
      3 =>
      array (
        'name' => 'category',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter issues by category',
      ),
      4 =>
      array (
        'name' => 'min_severity',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Minimum severity level to include. For example, WARN returns WARN and ERROR issues, excluding INFO.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_api_keys' =>
  array (
    'slug' => 'neon_list_api_keys',
    'class' => 'NeonListApiKeys',
    'method' => 'GET',
    'path' => '/api_keys',
    'operation_id' => 'listApiKeys',
    'name' => 'List API keys',
    'description' => 'Retrieves the API keys for your Neon account. The response does not include API key tokens. A token is only provided when creating an API key. API keys can also be managed in the Neon Console. For more information, see Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'neon_create_api_key' =>
  array (
    'slug' => 'neon_create_api_key',
    'class' => 'NeonCreateApiKey',
    'method' => 'POST',
    'path' => '/api_keys',
    'operation_id' => 'createApiKey',
    'name' => 'Create API key',
    'description' => 'Creates an API key. The keyname is a user-specified name for the key. This method returns an id and key. The key is a randomly generated, 64-bit token required to access the Neon API. API keys can also be managed in the Neon Console. See Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_revoke_api_key' =>
  array (
    'slug' => 'neon_revoke_api_key',
    'class' => 'NeonRevokeApiKey',
    'method' => 'DELETE',
    'path' => '/api_keys/{key_id}',
    'operation_id' => 'revokeApiKey',
    'name' => 'Revoke API key',
    'description' => 'Revokes the specified API key. An API key that is no longer needed can be revoked. This action cannot be reversed. You can obtain keyid values by listing the API keys for your Neon account. API keys can also be managed in the Neon Console. See Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The API key ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project_operation' =>
  array (
    'slug' => 'neon_get_project_operation',
    'class' => 'NeonGetProjectOperation',
    'method' => 'GET',
    'path' => '/projects/{project_id}/operations/{operation_id}',
    'operation_id' => 'getProjectOperation',
    'name' => 'Retrieve operation details',
    'description' => 'Retrieves details for the specified operation. An operation is an action performed on a Neon project resource. You can obtain a projectid by listing the projects for your Neon account. You can obtain a operationid by listing operations for the project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'operation_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The operation ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_projects' =>
  array (
    'slug' => 'neon_list_projects',
    'class' => 'NeonListProjects',
    'method' => 'GET',
    'path' => '/projects',
    'operation_id' => 'listProjects',
    'name' => 'List projects',
    'description' => 'Retrieves a list of projects for an organization. You may need to specify an orgid parameter depending on your API key type. For more information, see Manage projectshttps://neon.tech/docs/manage/projects/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the cursor value from the previous response to retrieve the next batch of projects.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify a value from 1 to 400 to limit number of projects in the response.',
      ),
      2 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Search by project name or id. You can specify partial name or id values to filter results.',
      ),
      3 =>
      array (
        'name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Search for projects by orgid.',
      ),
      4 =>
      array (
        'name' => 'timeout',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify an explicit timeout in milliseconds to limit response delay. After timing out, the incomplete list of project data fetched so far will be returned. Projects still being fetched when the timeout occurred are listed in the "unavailable" attribute of the response. If not specified, an implicit implementation defined timeout is chosen with the same behaviour as above',
      ),
      5 =>
      array (
        'name' => 'recoverable',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Show only deleted projects within the recovery window.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project' =>
  array (
    'slug' => 'neon_create_project',
    'class' => 'NeonCreateProject',
    'method' => 'POST',
    'path' => '/projects',
    'operation_id' => 'createProject',
    'name' => 'Create project',
    'description' => 'Creates a Neon project within an organization. You may need to specify an orgid parameter depending on your API key type. Plan limits define how many projects you can create. For more information, see Manage projectshttps://neon.tech/docs/manage/projects/. You can specify a region and Postgres version in the request body. Neon currently supports PostgreSQL 14, 15, 16, and 17. For supported regions and regionid values, see Regionshttps://neon.tech/docs/introduction/regions/.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_shared_projects' =>
  array (
    'slug' => 'neon_list_shared_projects',
    'class' => 'NeonListSharedProjects',
    'method' => 'GET',
    'path' => '/projects/shared',
    'operation_id' => 'listSharedProjects',
    'name' => 'List shared projects',
    'description' => 'Retrieves a list of projects shared with your Neon account. For more information, see Manage projectshttps://neon.tech/docs/manage/projects/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the cursor value from the previous response to get the next batch of projects.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify a value from 1 to 400 to limit number of projects in the response.',
      ),
      2 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Search query by name or id.',
      ),
      3 =>
      array (
        'name' => 'timeout',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify an explicit timeout in milliseconds to limit response delay. After timing out, the incomplete list of project data fetched so far will be returned. Projects still being fetched when the timeout occurred are listed in the "unavailable" attribute of the response. If not specified, an implicit implementation defined timeout is chosen with the same behaviour as above',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project' =>
  array (
    'slug' => 'neon_get_project',
    'class' => 'NeonGetProject',
    'method' => 'GET',
    'path' => '/projects/{project_id}',
    'operation_id' => 'getProject',
    'name' => 'Retrieve project details',
    'description' => 'Retrieves information about the specified project. You can obtain a projectid by listing the projects for an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_project' =>
  array (
    'slug' => 'neon_update_project',
    'class' => 'NeonUpdateProject',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}',
    'operation_id' => 'updateProject',
    'name' => 'Update project',
    'description' => 'Updates the specified project. You can obtain a projectid by listing the projects for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_project' =>
  array (
    'slug' => 'neon_delete_project',
    'class' => 'NeonDeleteProject',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}',
    'operation_id' => 'deleteProject',
    'name' => 'Delete project',
    'description' => 'Deletes the specified project. You can obtain a projectid by listing the projects for your Neon account. Deleting a project is a permanent action. Deleting a project also deletes endpoints, branches, databases, and users that belong to the project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_recover_project' =>
  array (
    'slug' => 'neon_recover_project',
    'class' => 'NeonRecoverProject',
    'method' => 'POST',
    'path' => '/projects/{project_id}/recover',
    'operation_id' => 'recoverProject',
    'name' => 'Recover a deleted project',
    'description' => 'Recovers a deleted project during the deletion grace period. You can obtain a projectid by listing the projects for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_project_operations' =>
  array (
    'slug' => 'neon_list_project_operations',
    'class' => 'NeonListProjectOperations',
    'method' => 'GET',
    'path' => '/projects/{project_id}/operations',
    'operation_id' => 'listProjectOperations',
    'name' => 'List operations',
    'description' => 'Retrieves a list of operations for the specified Neon project. You can obtain a projectid by listing the projects for your Neon account. The number of operations returned can be large. To paginate the response, issue an initial request with a limit value. Then, add the cursor value that was returned in the response to the next request. Operations older than 6 months may be deleted from our systems. If you need more history than that, you should store your own history.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the cursor value from the previous response to get the next batch of operations',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify a value from 1 to 1000 to limit number of operations in the response',
      ),
      2 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_project_permissions' =>
  array (
    'slug' => 'neon_list_project_permissions',
    'class' => 'NeonListProjectPermissions',
    'method' => 'GET',
    'path' => '/projects/{project_id}/permissions',
    'operation_id' => 'listProjectPermissions',
    'name' => 'List project access',
    'description' => 'Retrieves details about users who have access to the project, including the permission id, the granted-to email address, and the date project access was granted.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_grant_permission_to_project' =>
  array (
    'slug' => 'neon_grant_permission_to_project',
    'class' => 'NeonGrantPermissionToProject',
    'method' => 'POST',
    'path' => '/projects/{project_id}/permissions',
    'operation_id' => 'grantPermissionToProject',
    'name' => 'Grant project access',
    'description' => 'Grants project access to the account associated with the specified email address',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_revoke_permission_from_project' =>
  array (
    'slug' => 'neon_revoke_permission_from_project',
    'class' => 'NeonRevokePermissionFromProject',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/permissions/{permission_id}',
    'operation_id' => 'revokePermissionFromProject',
    'name' => 'Revoke project access',
    'description' => 'Revokes project access from the user associated with the specified permission id. You can retrieve a user\'s permission id by listing project access.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'permission_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_available_preload_libraries' =>
  array (
    'slug' => 'neon_get_available_preload_libraries',
    'class' => 'NeonGetAvailablePreloadLibraries',
    'method' => 'GET',
    'path' => '/projects/{project_id}/available_preload_libraries',
    'operation_id' => 'getAvailablePreloadLibraries',
    'name' => 'Return available shared preload libraries',
    'description' => 'Return available shared preload libraries',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_transfer_request' =>
  array (
    'slug' => 'neon_create_project_transfer_request',
    'class' => 'NeonCreateProjectTransferRequest',
    'method' => 'POST',
    'path' => '/projects/{project_id}/transfer_requests',
    'operation_id' => 'createProjectTransferRequest',
    'name' => 'Create a project transfer request',
    'description' => 'Creates a transfer request for the specified project. A transfer request allows the project to be transferred to another account or organization. The request has an expiration time after which it can no longer be used. To accept/claim the transfer request, the recipient user/organization must call the /projects/{projectid}/transferrequests/{requestid} API endpoint, or visit https://console.neon.tech/app/claim?p={projectid}&tr={requestid}&ru={redirecturl} in the Neon Console. The ru parameter is optional and can be used to redirect the user after accepting the transfer request.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_accept_project_transfer_request' =>
  array (
    'slug' => 'neon_accept_project_transfer_request',
    'class' => 'NeonAcceptProjectTransferRequest',
    'method' => 'PUT',
    'path' => '/projects/{project_id}/transfer_requests/{request_id}',
    'operation_id' => 'acceptProjectTransferRequest',
    'name' => 'Accept a project transfer request',
    'description' => 'Accepts a transfer request for the specified project, transferring it to the specified organization or user. If orgid is not passed, the project will be transferred to the current user or organization account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'request_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project transfer request ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_project_j_w_k_s' =>
  array (
    'slug' => 'neon_get_project_j_w_k_s',
    'class' => 'NeonGetProjectJWKS',
    'method' => 'GET',
    'path' => '/projects/{project_id}/jwks',
    'operation_id' => 'getProjectJWKS',
    'name' => 'List JWKS URLs',
    'description' => 'Returns the JWKS URLs available for verifying JWTs used as the authentication mechanism for the specified project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_add_project_j_w_k_s' =>
  array (
    'slug' => 'neon_add_project_j_w_k_s',
    'class' => 'NeonAddProjectJWKS',
    'method' => 'POST',
    'path' => '/projects/{project_id}/jwks',
    'operation_id' => 'addProjectJWKS',
    'name' => 'Add JWKS URL',
    'description' => 'Add a new JWKS URL to a project, such that it can be used for verifying JWTs used as the authentication mechanism for the specified project. The URL must be a valid HTTPS URL that returns a JSON Web Key Set. The providername field allows you to specify which authentication provider you\'re using e.g., Clerk, Auth0, AWS Cognito, etc.. The branchid can be used to specify on which branches the JWKS URL will be accepted. If not specified, then it will work on any branch. The rolenames can be used to specify for which roles the JWKS URL will be accepted. If not specified, then default roles will be used authenticator, authenticated and anonymous. The jwtaudience can be used to specify which "aud" values should be accepted by Neon in the JWTs that are used for authentication.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_project_j_w_k_s' =>
  array (
    'slug' => 'neon_delete_project_j_w_k_s',
    'class' => 'NeonDeleteProjectJWKS',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/jwks/{jwks_id}',
    'operation_id' => 'deleteProjectJWKS',
    'name' => 'Delete JWKS URL',
    'description' => 'Deletes a JWKS URL from the specified project',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'jwks_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The JWKS ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_branch_data_a_p_i' =>
  array (
    'slug' => 'neon_create_project_branch_data_a_p_i',
    'class' => 'NeonCreateProjectBranchDataAPI',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/data-api/{database_name}',
    'operation_id' => 'createProjectBranchDataAPI',
    'name' => 'Create Neon Data API',
    'description' => 'Creates a new instance of Neon Data API in the specified branch. You can obtain the projectid and branchid by listing the projects and branches for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_update_project_branch_data_a_p_i' =>
  array (
    'slug' => 'neon_update_project_branch_data_a_p_i',
    'class' => 'NeonUpdateProjectBranchDataAPI',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/data-api/{database_name}',
    'operation_id' => 'updateProjectBranchDataAPI',
    'name' => 'Update Neon Data API',
    'description' => 'Updates the Neon Data API configuration for the specified branch. You can optionally provide settings to update the Data API configuration. The schema cache is always refreshed as part of this operation. You can obtain the projectid and branchid by listing the projects and branches for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_project_branch_data_a_p_i' =>
  array (
    'slug' => 'neon_delete_project_branch_data_a_p_i',
    'class' => 'NeonDeleteProjectBranchDataAPI',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/data-api/{database_name}',
    'operation_id' => 'deleteProjectBranchDataAPI',
    'name' => 'Delete Neon Data API',
    'description' => 'Deletes the Neon Data API for the specified branch. You can obtain the projectid and branchid by listing the projects and branches for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project_branch_data_a_p_i' =>
  array (
    'slug' => 'neon_get_project_branch_data_a_p_i',
    'class' => 'NeonGetProjectBranchDataAPI',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/data-api/{database_name}',
    'operation_id' => 'getProjectBranchDataAPI',
    'name' => 'Get Neon Data API',
    'description' => 'Retrieves the Neon Data API for the specified branch.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_neon_auth_integration' =>
  array (
    'slug' => 'neon_create_neon_auth_integration',
    'class' => 'NeonCreateNeonAuthIntegration',
    'method' => 'POST',
    'path' => '/projects/auth/create',
    'operation_id' => 'createNeonAuthIntegration',
    'name' => 'Create Neon Auth integration',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth instead. Creates a project on a third-party authentication provider\'s platform for use with Neon Auth. Use this endpoint if the frontend integration flow can\'t be used.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth' =>
  array (
    'slug' => 'neon_get_neon_auth',
    'class' => 'NeonGetNeonAuth',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth',
    'operation_id' => 'getNeonAuth',
    'name' => 'Get details of Neon Auth for the branch',
    'description' => '/ Fetches the details of the Neon Auth for the specified branch. You can obtain the projectid and branchid by listing the projects and branches for your Neon account.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_neon_auth' =>
  array (
    'slug' => 'neon_create_neon_auth',
    'class' => 'NeonCreateNeonAuth',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth',
    'operation_id' => 'createNeonAuth',
    'name' => 'Enable Neon Auth for the branch',
    'description' => 'Enables Neon Auth integrationfor the branch. You can obtain the projectid and branchid by listing the projects and branches for your Neon account.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_disable_neon_auth' =>
  array (
    'slug' => 'neon_disable_neon_auth',
    'class' => 'NeonDisableNeonAuth',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth',
    'operation_id' => 'disableNeonAuth',
    'name' => 'Disables Neon Auth for the branch',
    'description' => 'Disables Neon Auth for the branch',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_neon_auth_redirect_u_r_i_whitelist_domains' =>
  array (
    'slug' => 'neon_list_neon_auth_redirect_u_r_i_whitelist_domains',
    'class' => 'NeonListNeonAuthRedirectURIWhitelistDomains',
    'method' => 'GET',
    'path' => '/projects/{project_id}/auth/domains',
    'operation_id' => 'listNeonAuthRedirectURIWhitelistDomains',
    'name' => 'List domains in redirecturi whitelist',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/domains instead. Lists the domains in the redirecturi whitelist for the specified project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_add_neon_auth_domain_to_redirect_u_r_i_whitelist' =>
  array (
    'slug' => 'neon_add_neon_auth_domain_to_redirect_u_r_i_whitelist',
    'class' => 'NeonAddNeonAuthDomainToRedirectURIWhitelist',
    'method' => 'POST',
    'path' => '/projects/{project_id}/auth/domains',
    'operation_id' => 'addNeonAuthDomainToRedirectURIWhitelist',
    'name' => 'Add domain to redirecturi whitelist',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/domains instead. Adds a domain to the redirecturi whitelist for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_neon_auth_domain_from_redirect_u_r_i_whitelist' =>
  array (
    'slug' => 'neon_delete_neon_auth_domain_from_redirect_u_r_i_whitelist',
    'class' => 'NeonDeleteNeonAuthDomainFromRedirectURIWhitelist',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/auth/domains',
    'operation_id' => 'deleteNeonAuthDomainFromRedirectURIWhitelist',
    'name' => 'Delete domain from redirecturi whitelist',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/domains instead. Deletes a domain from the redirecturi whitelist for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_branch_neon_auth_trusted_domains' =>
  array (
    'slug' => 'neon_list_branch_neon_auth_trusted_domains',
    'class' => 'NeonListBranchNeonAuthTrustedDomains',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/domains',
    'operation_id' => 'listBranchNeonAuthTrustedDomains',
    'name' => 'List domains in redirecturi whitelist',
    'description' => 'Lists the domains in the redirecturi whitelist for the specified project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_add_branch_neon_auth_trusted_domain' =>
  array (
    'slug' => 'neon_add_branch_neon_auth_trusted_domain',
    'class' => 'NeonAddBranchNeonAuthTrustedDomain',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/domains',
    'operation_id' => 'addBranchNeonAuthTrustedDomain',
    'name' => 'Add domain to redirecturi whitelist',
    'description' => 'Adds a domain to the redirecturi whitelist for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_branch_neon_auth_trusted_domain' =>
  array (
    'slug' => 'neon_delete_branch_neon_auth_trusted_domain',
    'class' => 'NeonDeleteBranchNeonAuthTrustedDomain',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/domains',
    'operation_id' => 'deleteBranchNeonAuthTrustedDomain',
    'name' => 'Delete domain from redirecturi whitelist',
    'description' => 'Deletes a domain from the redirecturi whitelist for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_create_neon_auth_provider_s_d_k_keys' =>
  array (
    'slug' => 'neon_create_neon_auth_provider_s_d_k_keys',
    'class' => 'NeonCreateNeonAuthProviderSDKKeys',
    'method' => 'POST',
    'path' => '/projects/auth/keys',
    'operation_id' => 'createNeonAuthProviderSDKKeys',
    'name' => 'Create Auth Provider SDK keys',
    'description' => 'Generates SDK or API Keys for the auth provider. These might be called different things depending on the auth provider you\'re using, but are generally used for setting up the frontend and backend SDKs.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_create_neon_auth_new_user' =>
  array (
    'slug' => 'neon_create_neon_auth_new_user',
    'class' => 'NeonCreateNeonAuthNewUser',
    'method' => 'POST',
    'path' => '/projects/auth/user',
    'operation_id' => 'createNeonAuthNewUser',
    'name' => 'Create new auth user',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/users instead. Creates a new user in Neon Auth. The user will be created in your neonauth.userssync table and automatically propagated to your auth project, whether Neon-managed or provider-owned.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_create_branch_neon_auth_new_user' =>
  array (
    'slug' => 'neon_create_branch_neon_auth_new_user',
    'class' => 'NeonCreateBranchNeonAuthNewUser',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/users',
    'operation_id' => 'createBranchNeonAuthNewUser',
    'name' => 'Create new auth user',
    'description' => 'Creates a new user in Neon Auth.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_branch_neon_auth_user' =>
  array (
    'slug' => 'neon_delete_branch_neon_auth_user',
    'class' => 'NeonDeleteBranchNeonAuthUser',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/users/{auth_user_id}',
    'operation_id' => 'deleteBranchNeonAuthUser',
    'name' => 'Delete auth user',
    'description' => 'Deletes the auth user for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'auth_user_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon user ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_user_role' =>
  array (
    'slug' => 'neon_update_neon_auth_user_role',
    'class' => 'NeonUpdateNeonAuthUserRole',
    'method' => 'PUT',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/users/{auth_user_id}/role',
    'operation_id' => 'updateNeonAuthUserRole',
    'name' => 'Update auth user role',
    'description' => 'Updates the role of an auth user for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'auth_user_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon user ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_neon_auth_user' =>
  array (
    'slug' => 'neon_delete_neon_auth_user',
    'class' => 'NeonDeleteNeonAuthUser',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/auth/users/{auth_user_id}',
    'operation_id' => 'deleteNeonAuthUser',
    'name' => 'Delete auth user',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/users/{authuserid} instead. Deletes the auth user for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'auth_user_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon user ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_transfer_neon_auth_provider_project' =>
  array (
    'slug' => 'neon_transfer_neon_auth_provider_project',
    'class' => 'NeonTransferNeonAuthProviderProject',
    'method' => 'POST',
    'path' => '/projects/auth/transfer_ownership',
    'operation_id' => 'transferNeonAuthProviderProject',
    'name' => 'Transfer Neon-managed auth project to your own account',
    'description' => 'Transfer ownership of your Neon-managed auth project to your own auth provider account.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_neon_auth_integrations' =>
  array (
    'slug' => 'neon_list_neon_auth_integrations',
    'class' => 'NeonListNeonAuthIntegrations',
    'method' => 'GET',
    'path' => '/projects/{project_id}/auth/integrations',
    'operation_id' => 'listNeonAuthIntegrations',
    'name' => 'Lists active integrations with auth providers',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth instead.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_neon_auth_oauth_providers' =>
  array (
    'slug' => 'neon_list_neon_auth_oauth_providers',
    'class' => 'NeonListNeonAuthOauthProviders',
    'method' => 'GET',
    'path' => '/projects/{project_id}/auth/oauth_providers',
    'operation_id' => 'listNeonAuthOauthProviders',
    'name' => 'List OAuth providers',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/oauthproviders instead. Lists the OAuth providers for the specified project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_add_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_add_neon_auth_oauth_provider',
    'class' => 'NeonAddNeonAuthOauthProvider',
    'method' => 'POST',
    'path' => '/projects/{project_id}/auth/oauth_providers',
    'operation_id' => 'addNeonAuthOauthProvider',
    'name' => 'Add a OAuth provider',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/oauthproviders instead. Adds a OAuth provider to the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_branch_neon_auth_oauth_providers' =>
  array (
    'slug' => 'neon_list_branch_neon_auth_oauth_providers',
    'class' => 'NeonListBranchNeonAuthOauthProviders',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/oauth_providers',
    'operation_id' => 'listBranchNeonAuthOauthProviders',
    'name' => 'List OAuth providers for neon auth for a branch',
    'description' => 'Lists the OAuth providers for the specified project and branch.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_add_branch_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_add_branch_neon_auth_oauth_provider',
    'class' => 'NeonAddBranchNeonAuthOauthProvider',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/oauth_providers',
    'operation_id' => 'addBranchNeonAuthOauthProvider',
    'name' => 'Add a OAuth provider',
    'description' => 'Adds a OAuth provider to the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_update_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_update_neon_auth_oauth_provider',
    'class' => 'NeonUpdateNeonAuthOauthProvider',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/auth/oauth_providers/{oauth_provider_id}',
    'operation_id' => 'updateNeonAuthOauthProvider',
    'name' => 'Update OAuth provider',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/oauthproviders/{oauthproviderid} instead. Updates a OAuth provider for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'oauth_provider_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The OAuth provider ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_delete_neon_auth_oauth_provider',
    'class' => 'NeonDeleteNeonAuthOauthProvider',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/auth/oauth_providers/{oauth_provider_id}',
    'operation_id' => 'deleteNeonAuthOauthProvider',
    'name' => 'Delete OAuth provider',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/oauthproviders/{oauthproviderid} instead. Deletes a OAuth provider from the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'oauth_provider_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The OAuth provider ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_branch_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_update_branch_neon_auth_oauth_provider',
    'class' => 'NeonUpdateBranchNeonAuthOauthProvider',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/oauth_providers/{oauth_provider_id}',
    'operation_id' => 'updateBranchNeonAuthOauthProvider',
    'name' => 'Update OAuth provider',
    'description' => 'Updates a OAuth provider for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'oauth_provider_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The OAuth provider ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_branch_neon_auth_oauth_provider' =>
  array (
    'slug' => 'neon_delete_branch_neon_auth_oauth_provider',
    'class' => 'NeonDeleteBranchNeonAuthOauthProvider',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/oauth_providers/{oauth_provider_id}',
    'operation_id' => 'deleteBranchNeonAuthOauthProvider',
    'name' => 'Delete OAuth provider',
    'description' => 'Deletes a OAuth provider from the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
      2 =>
      array (
        'name' => 'oauth_provider_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The OAuth provider ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_neon_auth_email_server' =>
  array (
    'slug' => 'neon_get_neon_auth_email_server',
    'class' => 'NeonGetNeonAuthEmailServer',
    'method' => 'GET',
    'path' => '/projects/{project_id}/auth/email_server',
    'operation_id' => 'getNeonAuthEmailServer',
    'name' => 'Get email server configuration',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/emailprovider instead. Gets the email server configuration for the specified project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_email_server' =>
  array (
    'slug' => 'neon_update_neon_auth_email_server',
    'class' => 'NeonUpdateNeonAuthEmailServer',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/auth/email_server',
    'operation_id' => 'updateNeonAuthEmailServer',
    'name' => 'Update email server configuration',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth/emailprovider instead. Updates the email server configuration for the specified project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_send_neon_auth_test_email' =>
  array (
    'slug' => 'neon_send_neon_auth_test_email',
    'class' => 'NeonSendNeonAuthTestEmail',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/send_test_email',
    'operation_id' => 'sendNeonAuthTestEmail',
    'name' => 'Send test email',
    'description' => 'Sends a test email to the specified email address.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth_email_and_password_config' =>
  array (
    'slug' => 'neon_get_neon_auth_email_and_password_config',
    'class' => 'NeonGetNeonAuthEmailAndPasswordConfig',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/email_and_password',
    'operation_id' => 'getNeonAuthEmailAndPasswordConfig',
    'name' => 'Get email and password configuration',
    'description' => 'Gets the email and password authentication configuration for Neon Auth',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_email_and_password_config' =>
  array (
    'slug' => 'neon_update_neon_auth_email_and_password_config',
    'class' => 'NeonUpdateNeonAuthEmailAndPasswordConfig',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/email_and_password',
    'operation_id' => 'updateNeonAuthEmailAndPasswordConfig',
    'name' => 'Update email and password configuration',
    'description' => 'Updates the email and password authentication configuration for Neon Auth',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth_email_provider' =>
  array (
    'slug' => 'neon_get_neon_auth_email_provider',
    'class' => 'NeonGetNeonAuthEmailProvider',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/email_provider',
    'operation_id' => 'getNeonAuthEmailProvider',
    'name' => 'Get email provider configuration',
    'description' => 'Gets the email provider configuration for the specified branch.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_email_provider' =>
  array (
    'slug' => 'neon_update_neon_auth_email_provider',
    'class' => 'NeonUpdateNeonAuthEmailProvider',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/email_provider',
    'operation_id' => 'updateNeonAuthEmailProvider',
    'name' => 'Update email provider configuration',
    'description' => 'Updates the email provider configuration for the specified branch.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_neon_auth_integration' =>
  array (
    'slug' => 'neon_delete_neon_auth_integration',
    'class' => 'NeonDeleteNeonAuthIntegration',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/auth/integration/{auth_provider}',
    'operation_id' => 'deleteNeonAuthIntegration',
    'name' => 'Delete integration with auth provider',
    'description' => 'DEPRECATED, use /projects/{projectid}/branches/{branchid}/auth instead.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'auth_provider',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The authentication provider name',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_connection_u_r_i' =>
  array (
    'slug' => 'neon_get_connection_u_r_i',
    'class' => 'NeonGetConnectionURI',
    'method' => 'GET',
    'path' => '/projects/{project_id}/connection_uri',
    'operation_id' => 'getConnectionURI',
    'name' => 'Retrieve connection URI',
    'description' => 'Retrieves a connection URI for the specified database. You can obtain a projectid by listing the projects for your Neon account. You can obtain the databasename by listing the databases for a branch. You can obtain a rolename by listing the roles for a branch.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The branch ID. Defaults to your project\'s default branchid if not specified.',
      ),
      2 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The endpoint ID. Defaults to the read-write endpointid associated with the branchid if not specified.',
      ),
      3 =>
      array (
        'name' => 'database_name',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
      4 =>
      array (
        'name' => 'role_name',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The role name',
      ),
      5 =>
      array (
        'name' => 'pooled',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Adds the -pooler option to the connection URI when set to true, creating a pooled connection URI.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_neon_auth_allow_localhost' =>
  array (
    'slug' => 'neon_get_neon_auth_allow_localhost',
    'class' => 'NeonGetNeonAuthAllowLocalhost',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/allow_localhost',
    'operation_id' => 'getNeonAuthAllowLocalhost',
    'name' => 'Get allow localhost',
    'description' => 'Get the allow localhost configuration for the specified branch.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_allow_localhost' =>
  array (
    'slug' => 'neon_update_neon_auth_allow_localhost',
    'class' => 'NeonUpdateNeonAuthAllowLocalhost',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/allow_localhost',
    'operation_id' => 'updateNeonAuthAllowLocalhost',
    'name' => 'Update allow localhost',
    'description' => 'Updates the allow localhost configuration for the specified branch.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth_plugin_configs' =>
  array (
    'slug' => 'neon_get_neon_auth_plugin_configs',
    'class' => 'NeonGetNeonAuthPluginConfigs',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/plugins',
    'operation_id' => 'getNeonAuthPluginConfigs',
    'name' => 'Get all plugin configurations',
    'description' => 'Returns all plugin configurations for Neon Auth in a single response. This endpoint aggregates organization, email provider, email and password, OAuth providers, and localhost settings.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_organization_plugin' =>
  array (
    'slug' => 'neon_update_neon_auth_organization_plugin',
    'class' => 'NeonUpdateNeonAuthOrganizationPlugin',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/plugins/organization',
    'operation_id' => 'updateNeonAuthOrganizationPlugin',
    'name' => 'Update organization plugin configuration',
    'description' => 'Updates the organization plugin configuration for Neon Auth. The organization plugin enables multi-tenant organization support.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_update_neon_auth_config' =>
  array (
    'slug' => 'neon_update_neon_auth_config',
    'class' => 'NeonUpdateNeonAuthConfig',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/config',
    'operation_id' => 'updateNeonAuthConfig',
    'name' => 'Update auth configuration',
    'description' => 'Updates the auth configuration for the branch. Currently supports updating the application name used in auth emails.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_update_neon_auth_magic_link_plugin' =>
  array (
    'slug' => 'neon_update_neon_auth_magic_link_plugin',
    'class' => 'NeonUpdateNeonAuthMagicLinkPlugin',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/plugins/magic-link',
    'operation_id' => 'updateNeonAuthMagicLinkPlugin',
    'name' => 'Update magic link plugin configuration',
    'description' => 'Updates the magic link plugin configuration for Neon Auth. The magic link plugin enables passwordless authentication via email magic links.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth_phone_number_plugin' =>
  array (
    'slug' => 'neon_get_neon_auth_phone_number_plugin',
    'class' => 'NeonGetNeonAuthPhoneNumberPlugin',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/plugins/phone-number',
    'operation_id' => 'getNeonAuthPhoneNumberPlugin',
    'name' => 'Get phone number plugin configuration',
    'description' => 'Returns the phone number plugin configuration for Neon Auth. The phone number plugin enables phone-based OTP authentication.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_phone_number_plugin' =>
  array (
    'slug' => 'neon_update_neon_auth_phone_number_plugin',
    'class' => 'NeonUpdateNeonAuthPhoneNumberPlugin',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/plugins/phone-number',
    'operation_id' => 'updateNeonAuthPhoneNumberPlugin',
    'name' => 'Update phone number plugin configuration',
    'description' => 'Updates the phone number plugin configuration for Neon Auth. Only the fields provided in the request body are updated; omitted fields retain their current values. The phone number plugin enables phone-based OTP authentication. OTP codes are delivered via the send.otp webhook event with deliverypreference: "sms". A webhook must be configured with the send.otp event enabled for SMS delivery to work.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_neon_auth_webhook_config' =>
  array (
    'slug' => 'neon_get_neon_auth_webhook_config',
    'class' => 'NeonGetNeonAuthWebhookConfig',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/webhooks',
    'operation_id' => 'getNeonAuthWebhookConfig',
    'name' => 'Get webhook configuration for Neon Auth',
    'description' => 'Returns the webhook configuration for Neon Auth.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_neon_auth_webhook_config' =>
  array (
    'slug' => 'neon_update_neon_auth_webhook_config',
    'class' => 'NeonUpdateNeonAuthWebhookConfig',
    'method' => 'PUT',
    'path' => '/projects/{project_id}/branches/{branch_id}/auth/webhooks',
    'operation_id' => 'updateNeonAuthWebhookConfig',
    'name' => 'Update webhook configuration for Neon Auth',
    'description' => 'Updates the webhook configuration for Neon Auth on a specific branch.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_create_project_branch' =>
  array (
    'slug' => 'neon_create_project_branch',
    'class' => 'NeonCreateProjectBranch',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches',
    'operation_id' => 'createProjectBranch',
    'name' => 'Create branch',
    'description' => 'Creates a branch in the specified project. You can obtain a projectid by listing the projects for your Neon account. This method does not require a request body, but you can specify one to create a compute endpoint for the branch or to select a non-default parent branch. By default, the branch is created from the project\'s default branch with no compute endpoint, and the branch name is auto-generated. To access the branch, you must add an endpoint object. A readwrite endpoint allows you to perform read and write operations on the branch. Each branch supports one read-write endpoint and multiple read-only endpoints. For related information, see Manage brancheshttps://neon.tech/docs/manage/branches/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_branches' =>
  array (
    'slug' => 'neon_list_branches',
    'class' => 'NeonListBranches',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches',
    'operation_id' => 'listProjectBranches',
    'name' => 'List branches',
    'description' => 'Retrieves a list of branches for the specified project. You can obtain a projectid by listing the projects for your Neon account. Each Neon project has a root branch named main. A branchid value has a br- prefix. A project may contain child branches that were branched from main or from another branch. A parent branch is identified by the parentid value, which is the id of the parent branch. For related information, see Manage brancheshttps://neon.tech/docs/manage/branches/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Search by branch name or id. You can specify partial name or id values to filter results.',
      ),
      2 =>
      array (
        'name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Sort the branches by sortfield. If not provided, branches will be sorted by updatedat descending order',
      ),
      3 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A cursor to use in pagination. A cursor defines your place in the data list. Include response.pagination.next in subsequent API calls to fetch next page of the list.',
      ),
      4 =>
      array (
        'name' => 'sort_order',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Defines the sorting order of entities.',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The maximum number of records to be returned in the response',
      ),
      6 =>
      array (
        'name' => 'include_deleted',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If true, return recoverable deleted branches too soft-deleted within the recovery window. If false or not provided, return only active non-deleted branches. This parameter is part of the Branch Recovery feature, which is in preview and not available to all users.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_branch_anonymized' =>
  array (
    'slug' => 'neon_create_project_branch_anonymized',
    'class' => 'NeonCreateProjectBranchAnonymized',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branch_anonymized',
    'operation_id' => 'createProjectBranchAnonymized',
    'name' => 'Create anonymized branch',
    'description' => 'Creates a new branch with anonymized data using PostgreSQL Anonymizer for static masking. This allows developers to work with masked production data. Optionally, provide maskingrules to set initial masking rules for the branch and startanonymization to automatically start anonymization after creation. This combines functionality of updating masking rules and starting anonymization into the branch creation request. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_count_project_branches' =>
  array (
    'slug' => 'neon_count_project_branches',
    'class' => 'NeonCountProjectBranches',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/count',
    'operation_id' => 'countProjectBranches',
    'name' => 'Retrieve number of branches',
    'description' => 'Retrieves the total number of branches in the specified project. You can obtain a projectid by listing the projects for your Neon account.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Count branches matching the name in search query',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_branch' =>
  array (
    'slug' => 'neon_get_branch',
    'class' => 'NeonGetBranch',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}',
    'operation_id' => 'getProjectBranch',
    'name' => 'Retrieve branch details',
    'description' => 'Retrieves information about the specified branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain a branchid by listing the project\'s branches. A branchid value has a br- prefix. Each Neon project is initially created with a root and default branch named main. A project can contain one or more branches. A parent branch is identified by a parentid value, which is the id of the parent branch. For related information, see Manage brancheshttps://neon.tech/docs/manage/branches/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_delete_project_branch' =>
  array (
    'slug' => 'neon_delete_project_branch',
    'class' => 'NeonDeleteProjectBranch',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}',
    'operation_id' => 'deleteProjectBranch',
    'name' => 'Delete branch',
    'description' => 'Deletes the specified branch from a project, and places all compute endpoints into an idle state, breaking existing client connections. You can obtain a projectid by listing the projects for your Neon account. You can obtain a branchid by listing the project\'s branches. For related information, see Manage brancheshttps://neon.tech/docs/manage/branches/. When a successful response status is received, the compute endpoints are still active, and the branch is not yet deleted from storage. The deletion occurs after all operations finish. You cannot delete a project\'s root or default branch, and you cannot delete a branch that has a child branch. A project must have at least one branch. By default, deleted branches can be recovered within a 7-day grace period. Use the harddelete parameter to permanently delete the branch immediately without a recovery window. Soft delete and branch recovery are in preview and not available to all users.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'hard_delete',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If true, the branch is permanently deleted immediately without a recovery window. If false default, the branch can be recovered within 7 days via the recover endpoint. This parameter is part of the Branch Recovery feature, which is in preview and not available to all users.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_project_branch' =>
  array (
    'slug' => 'neon_update_project_branch',
    'class' => 'NeonUpdateProjectBranch',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}',
    'operation_id' => 'updateProjectBranch',
    'name' => 'Update branch',
    'description' => 'Updates the specified branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For more information, see Manage brancheshttps://neon.tech/docs/manage/branches/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_restore_project_branch' =>
  array (
    'slug' => 'neon_restore_project_branch',
    'class' => 'NeonRestoreProjectBranch',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/restore',
    'operation_id' => 'restoreProjectBranch',
    'name' => 'Restore branch',
    'description' => 'Restores a branch to an earlier state in its own or another branch\'s history',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_project_branch_schema' =>
  array (
    'slug' => 'neon_get_project_branch_schema',
    'class' => 'NeonGetProjectBranchSchema',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/schema',
    'operation_id' => 'getProjectBranchSchema',
    'name' => 'Retrieve database schema',
    'description' => 'Retrieves the schema from the specified database. The lsn and timestamp values cannot be specified at the same time. If both are omitted, the database schema is retrieved from database\'s head.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'db_name',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Name of the database for which the schema is retrieved',
      ),
      3 =>
      array (
        'name' => 'lsn',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The Log Sequence Number LSN for which the schema is retrieved',
      ),
      4 =>
      array (
        'name' => 'timestamp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The point in time for which the schema is retrieved',
      ),
      5 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The format of the schema to retrieve. Possible values: - sql default - json',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project_branch_schema_comparison' =>
  array (
    'slug' => 'neon_get_project_branch_schema_comparison',
    'class' => 'NeonGetProjectBranchSchemaComparison',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/compare_schema',
    'operation_id' => 'getProjectBranchSchemaComparison',
    'name' => 'Compare database schema',
    'description' => 'Compares the schema from the specified database with another branch\'s schema.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'base_branch_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The branch ID to compare the schema with',
      ),
      3 =>
      array (
        'name' => 'db_name',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Name of the database for which the schema is retrieved',
      ),
      4 =>
      array (
        'name' => 'lsn',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The Log Sequence Number LSN for which the schema is retrieved',
      ),
      5 =>
      array (
        'name' => 'timestamp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The point in time for which the schema is retrieved',
      ),
      6 =>
      array (
        'name' => 'base_lsn',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The Log Sequence Number LSN for the base branch schema',
      ),
      7 =>
      array (
        'name' => 'base_timestamp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The point in time for the base branch schema',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_masking_rules' =>
  array (
    'slug' => 'neon_get_masking_rules',
    'class' => 'NeonGetMaskingRules',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/masking_rules',
    'operation_id' => 'getMaskingRules',
    'name' => 'Get masking rules',
    'description' => 'Retrieves the masking rules for the specified anonymized branch. Masking rules define how sensitive data should be anonymized using PostgreSQL Anonymizer. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. Note: This endpoint is currently in Beta.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_masking_rules' =>
  array (
    'slug' => 'neon_update_masking_rules',
    'class' => 'NeonUpdateMaskingRules',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/masking_rules',
    'operation_id' => 'updateMaskingRules',
    'name' => 'Update masking rules',
    'description' => 'Updates the masking rules for the specified anonymized branch. Masking rules define how sensitive data should be anonymized using PostgreSQL Anonymizer. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_anonymized_branch_status' =>
  array (
    'slug' => 'neon_get_anonymized_branch_status',
    'class' => 'NeonGetAnonymizedBranchStatus',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/anonymized_status',
    'operation_id' => 'getAnonymizedBranchStatus',
    'name' => 'Get anonymized branch status',
    'description' => 'Retrieves the current status of an anonymized branch, including its state and progress information. This endpoint allows you to monitor the anonymization process from initialization through completion. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. Only anonymized branches will have status information available. Note: This endpoint is currently in Beta.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_start_anonymization' =>
  array (
    'slug' => 'neon_start_anonymization',
    'class' => 'NeonStartAnonymization',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/anonymize',
    'operation_id' => 'startAnonymization',
    'name' => 'Start anonymization',
    'description' => 'Starts the anonymization process for an anonymized branch that is in the initialized, error, or anonymized state. This will apply all defined masking rules to anonymize sensitive data in the branch databases. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. The branch must be an anonymized branch to start anonymization. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_set_default_project_branch' =>
  array (
    'slug' => 'neon_set_default_project_branch',
    'class' => 'NeonSetDefaultProjectBranch',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/set_as_default',
    'operation_id' => 'setDefaultProjectBranch',
    'name' => 'Set branch as default',
    'description' => 'Sets the specified branch as the project\'s default branch. The default designation is automatically removed from the previous default branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For more information, see Manage brancheshttps://neon.tech/docs/manage/branches/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_recover_project_branch' =>
  array (
    'slug' => 'neon_recover_project_branch',
    'class' => 'NeonRecoverProjectBranch',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/recover',
    'operation_id' => 'recoverProjectBranch',
    'name' => 'Recover a deleted branch',
    'description' => 'Recovers a deleted branch during the deletion grace period 7 days. The branch must have been soft deleted and not yet permanently deleted. Recovery restores the branch and its endpoints to an idle state. Connection strings remain valid after recovery. TTL branches become non-TTL branches after recovery. This endpoint is in preview and not available to all users.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_finalize_restore_branch' =>
  array (
    'slug' => 'neon_finalize_restore_branch',
    'class' => 'NeonFinalizeRestoreBranch',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/finalize_restore',
    'operation_id' => 'finalizeRestoreBranch',
    'name' => 'Finalize restore',
    'description' => 'Finalize the restore operation for a branch created from a snapshot. This operation updates the branch so it functions as the original branch it replaced. This includes: - Reassigning any computes from the original branch to the restored branch this will restart the computes - Renaming the restored branch to the original branch\'s name - Renaming the original branch so it no longer uses the original name This operation only applies to branches created using the restoreSnapshot endpoint with finalizerestore: false. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_project_branch_endpoints' =>
  array (
    'slug' => 'neon_list_project_branch_endpoints',
    'class' => 'NeonListProjectBranchEndpoints',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/endpoints',
    'operation_id' => 'listProjectBranchEndpoints',
    'name' => 'List branch endpoints',
    'description' => 'Retrieves a list of compute endpoints for the specified branch. Neon permits only one read-write compute endpoint per branch. A branch can have multiple read-only compute endpoints. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_databases' =>
  array (
    'slug' => 'neon_list_databases',
    'class' => 'NeonListDatabases',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/databases',
    'operation_id' => 'listProjectBranchDatabases',
    'name' => 'List databases',
    'description' => 'Retrieves a list of databases for the specified branch. A branch can have multiple databases. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For related information, see Manage databaseshttps://neon.tech/docs/manage/databases/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_branch_database' =>
  array (
    'slug' => 'neon_create_project_branch_database',
    'class' => 'NeonCreateProjectBranchDatabase',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/databases',
    'operation_id' => 'createProjectBranchDatabase',
    'name' => 'Create database',
    'description' => 'Creates a database in the specified branch. A branch can have multiple databases. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For related information, see Manage databaseshttps://neon.tech/docs/manage/databases/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_project_branch_database' =>
  array (
    'slug' => 'neon_get_project_branch_database',
    'class' => 'NeonGetProjectBranchDatabase',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/databases/{database_name}',
    'operation_id' => 'getProjectBranchDatabase',
    'name' => 'Retrieve database details',
    'description' => 'Retrieves information about the specified database. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid and databasename by listing the branch\'s databases. For related information, see Manage databaseshttps://neon.tech/docs/manage/databases/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_project_branch_database' =>
  array (
    'slug' => 'neon_update_project_branch_database',
    'class' => 'NeonUpdateProjectBranchDatabase',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/branches/{branch_id}/databases/{database_name}',
    'operation_id' => 'updateProjectBranchDatabase',
    'name' => 'Update database',
    'description' => 'Updates the specified database in the branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid and databasename by listing the branch\'s databases. For related information, see Manage databaseshttps://neon.tech/docs/manage/databases/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_project_branch_database' =>
  array (
    'slug' => 'neon_delete_project_branch_database',
    'class' => 'NeonDeleteProjectBranchDatabase',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/databases/{database_name}',
    'operation_id' => 'deleteProjectBranchDatabase',
    'name' => 'Delete database',
    'description' => 'Deletes the specified database from the branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid and databasename by listing the branch\'s databases. For related information, see Manage databaseshttps://neon.tech/docs/manage/databases/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'database_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The database name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_project_branch_roles' =>
  array (
    'slug' => 'neon_list_project_branch_roles',
    'class' => 'NeonListProjectBranchRoles',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles',
    'operation_id' => 'listProjectBranchRoles',
    'name' => 'List roles',
    'description' => 'Retrieves a list of Postgres roles from the specified branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_branch_role' =>
  array (
    'slug' => 'neon_create_project_branch_role',
    'class' => 'NeonCreateProjectBranchRole',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles',
    'operation_id' => 'createProjectBranchRole',
    'name' => 'Create role',
    'description' => 'Creates a Postgres role in the specified branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/. Connections established to the active compute endpoint will be dropped. If the compute endpoint is idle, the endpoint becomes active for a short period of time and is suspended afterward.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_project_branch_role' =>
  array (
    'slug' => 'neon_get_project_branch_role',
    'class' => 'NeonGetProjectBranchRole',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles/{role_name}',
    'operation_id' => 'getProjectBranchRole',
    'name' => 'Retrieve role details',
    'description' => 'Retrieves details about the specified role. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. You can obtain the rolename by listing the roles for a branch. In Neon, the terms "role" and "user" are synonymous. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The role name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_delete_project_branch_role' =>
  array (
    'slug' => 'neon_delete_project_branch_role',
    'class' => 'NeonDeleteProjectBranchRole',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles/{role_name}',
    'operation_id' => 'deleteProjectBranchRole',
    'name' => 'Delete role',
    'description' => 'Deletes the specified Postgres role from the branch. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. You can obtain the rolename by listing the roles for a branch. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The role name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project_branch_role_password' =>
  array (
    'slug' => 'neon_get_project_branch_role_password',
    'class' => 'NeonGetProjectBranchRolePassword',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles/{role_name}/reveal_password',
    'operation_id' => 'getProjectBranchRolePassword',
    'name' => 'Retrieve role password',
    'description' => 'Retrieves the password for the specified Postgres role, if possible. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. You can obtain the rolename by listing the roles for a branch. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The role name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_reset_project_branch_role_password' =>
  array (
    'slug' => 'neon_reset_project_branch_role_password',
    'class' => 'NeonResetProjectBranchRolePassword',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/roles/{role_name}/reset_password',
    'operation_id' => 'resetProjectBranchRolePassword',
    'name' => 'Reset role password',
    'description' => 'Resets the password for the specified Postgres role. Returns a new password and operations. The new password is ready to use when the last operation finishes. The old password remains valid until last operation finishes. Connections to the compute endpoint are dropped. If idle, the compute endpoint becomes active for a short period of time. You can obtain a projectid by listing the projects for your Neon account. You can obtain the branchid by listing the project\'s branches. You can obtain the rolename by listing the roles for a branch. For related information, see Manage roleshttps://neon.tech/docs/manage/roles/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The role name',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_project_v_p_c_endpoints' =>
  array (
    'slug' => 'neon_list_project_v_p_c_endpoints',
    'class' => 'NeonListProjectVPCEndpoints',
    'method' => 'GET',
    'path' => '/projects/{project_id}/vpc_endpoints',
    'operation_id' => 'listProjectVPCEndpoints',
    'name' => 'List VPC endpoint restrictions',
    'description' => 'Lists VPC endpoint restrictions for the specified Neon project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_assign_project_v_p_c_endpoint' =>
  array (
    'slug' => 'neon_assign_project_v_p_c_endpoint',
    'class' => 'NeonAssignProjectVPCEndpoint',
    'method' => 'POST',
    'path' => '/projects/{project_id}/vpc_endpoints/{vpc_endpoint_id}',
    'operation_id' => 'assignProjectVPCEndpoint',
    'name' => 'Set VPC endpoint restriction',
    'description' => 'Sets or updates a VPC endpoint restriction for a Neon project. When a VPC endpoint restriction is set, the project only accepts connections from the specified VPC. A VPC endpoint can be set as a restriction only after it is assigned to the parent organization of the Neon project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'vpc_endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The VPC endpoint ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_project_v_p_c_endpoint' =>
  array (
    'slug' => 'neon_delete_project_v_p_c_endpoint',
    'class' => 'NeonDeleteProjectVPCEndpoint',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/vpc_endpoints/{vpc_endpoint_id}',
    'operation_id' => 'deleteProjectVPCEndpoint',
    'name' => 'Delete VPC endpoint restriction',
    'description' => 'Removes the specified VPC endpoint restriction from a Neon project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'vpc_endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The VPC endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_project_endpoint' =>
  array (
    'slug' => 'neon_create_project_endpoint',
    'class' => 'NeonCreateProjectEndpoint',
    'method' => 'POST',
    'path' => '/projects/{project_id}/endpoints',
    'operation_id' => 'createProjectEndpoint',
    'name' => 'Create compute endpoint',
    'description' => 'Creates a compute endpoint for the specified branch. An endpoint is a Neon compute instance. There is a maximum of one read-write compute endpoint per branch. If the specified branch already has a read-write compute endpoint, the operation fails. A branch can have multiple read-only compute endpoints. You can obtain a projectid by listing the projects for your Neon account. You can obtain branchid by listing the project\'s branches. A branchid has a br- prefix. For supported regions and regionid values, see Regionshttps://neon.tech/docs/introduction/regions/. For more information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_project_endpoints' =>
  array (
    'slug' => 'neon_list_project_endpoints',
    'class' => 'NeonListProjectEndpoints',
    'method' => 'GET',
    'path' => '/projects/{project_id}/endpoints',
    'operation_id' => 'listProjectEndpoints',
    'name' => 'List compute endpoints',
    'description' => 'Retrieves a list of compute endpoints for the specified project. A compute endpoint is a Neon compute instance. You can obtain a projectid by listing the projects for your Neon account. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_project_endpoint' =>
  array (
    'slug' => 'neon_get_project_endpoint',
    'class' => 'NeonGetProjectEndpoint',
    'method' => 'GET',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}',
    'operation_id' => 'getProjectEndpoint',
    'name' => 'Retrieve compute endpoint details',
    'description' => 'Retrieves information about the specified compute endpoint. A compute endpoint is a Neon compute instance. You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_delete_project_endpoint' =>
  array (
    'slug' => 'neon_delete_project_endpoint',
    'class' => 'NeonDeleteProjectEndpoint',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}',
    'operation_id' => 'deleteProjectEndpoint',
    'name' => 'Delete compute endpoint',
    'description' => 'Delete the specified compute endpoint. A compute endpoint is a Neon compute instance. Deleting a compute endpoint drops existing network connections to the compute endpoint. The deletion is completed when last operation in the chain finishes successfully. You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_project_endpoint' =>
  array (
    'slug' => 'neon_update_project_endpoint',
    'class' => 'NeonUpdateProjectEndpoint',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}',
    'operation_id' => 'updateProjectEndpoint',
    'name' => 'Update compute endpoint',
    'description' => 'Updates the specified compute endpoint. You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid and branchid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. A branchid has a br- prefix. For more information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/. If the returned list of operations is not empty, the compute endpoint is not ready to use. The client must wait for the last operation to finish before using the compute endpoint. If the compute endpoint was idle before the update, it becomes active for a short period of time, and the control plane suspends it again after the update.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_start_project_endpoint' =>
  array (
    'slug' => 'neon_start_project_endpoint',
    'class' => 'NeonStartProjectEndpoint',
    'method' => 'POST',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}/start',
    'operation_id' => 'startProjectEndpoint',
    'name' => 'Start compute endpoint',
    'description' => 'Starts a compute endpoint. The compute endpoint is ready to use after the last operation in chain finishes successfully. You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_suspend_project_endpoint' =>
  array (
    'slug' => 'neon_suspend_project_endpoint',
    'class' => 'NeonSuspendProjectEndpoint',
    'method' => 'POST',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}/suspend',
    'operation_id' => 'suspendProjectEndpoint',
    'name' => 'Suspend compute endpoint',
    'description' => 'Suspend the specified compute endpoint You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_restart_project_endpoint' =>
  array (
    'slug' => 'neon_restart_project_endpoint',
    'class' => 'NeonRestartProjectEndpoint',
    'method' => 'POST',
    'path' => '/projects/{project_id}/endpoints/{endpoint_id}/restart',
    'operation_id' => 'restartProjectEndpoint',
    'name' => 'Restart compute endpoint',
    'description' => 'Restart the specified compute endpoint: suspend immediately followed by start operations. You can obtain a projectid by listing the projects for your Neon account. You can obtain an endpointid by listing your project\'s compute endpoints. An endpointid has an ep- prefix. For information about compute endpoints, see Manage computeshttps://neon.tech/docs/manage/endpoints/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_consumption_history_per_account' =>
  array (
    'slug' => 'neon_get_consumption_history_per_account',
    'class' => 'NeonGetConsumptionHistoryPerAccount',
    'method' => 'GET',
    'path' => '/consumption_history/account',
    'operation_id' => 'getConsumptionHistoryPerAccount',
    'name' => 'Retrieve account consumption metrics legacy plans',
    'description' => 'Retrieves consumption metrics for Scale and Enterprise plan accounts, and for legacy Scale, Business, and Enterprise plan accounts. Consumption history begins at the time the account was upgraded to a supported plan. Deprecated: This endpoint will be removed on June 1, 2026.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the start date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the past year. The consumption history is available starting from March 1, 2024, at 00:00:00 UTC.',
      ),
      1 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the end date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the past year.',
      ),
      2 =>
      array (
        'name' => 'granularity',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the granularity of consumption metrics. Hourly, daily, and monthly metrics are available for the last 168 hours, 60 days, and 1 year, respectively.',
      ),
      3 =>
      array (
        'name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the organization for which the consumption metrics should be returned. If this parameter is not provided, the endpoint will return the metrics for the authenticated user\'s account.',
      ),
      4 =>
      array (
        'name' => 'include_v1_metrics',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'The field is deprecated. Please use metrics instead. If metrics is specified, this field is ignored. Include metrics utilized in previous pricing models. - datastoragebyteshour: The sum of the maximum observed storage values for each hour for each project, which never decreases.',
      ),
      5 =>
      array (
        'name' => 'metrics',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Specify a list of metrics to include in the response. If omitted, activetime, computetime, writtendata, syntheticstoragesize are returned. Possible values: - activetimeseconds - computetimeseconds - writtendatabytes - syntheticstoragesizebytes - datastoragebyteshour A list of metrics can be specified as an array of parameter values or as a comma-separated list in a single parameter value. - As an array of parameter values: metrics=cpuseconds&metrics=rambytes - As a comma-separated list in a single parameter value: metrics=cpuseconds,rambytes',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_consumption_history_per_project' =>
  array (
    'slug' => 'neon_get_consumption_history_per_project',
    'class' => 'NeonGetConsumptionHistoryPerProject',
    'method' => 'GET',
    'path' => '/consumption_history/projects',
    'operation_id' => 'getConsumptionHistoryPerProject',
    'name' => 'Retrieve project consumption metrics legacy plans',
    'description' => 'Retrieves consumption metrics for Scale, Business, and Enterprise plan projects. History begins at the time of upgrade. Results are ordered by time in ascending order oldest to newest. Issuing a call to this API does not wake a project\'s compute endpoint.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the cursor value from the previous response to get the next batch of projects.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify a value from 1 to 100 to limit number of projects in the response.',
      ),
      2 =>
      array (
        'name' => 'project_ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Specify a list of project IDs to filter the response. If omitted, the response will contain all projects. A list of project IDs can be specified as an array of parameter values or as a comma-separated list in a single parameter value. - As an array of parameter values: projectids=cold-poetry-09157238%20&projectids=quiet-snow-71788278 - As a comma-separated list in a single parameter value: projectids=cold-poetry-09157238,quiet-snow-71788278',
      ),
      3 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the start date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the last year. The consumption history is available starting from March 1, 2024, at 00:00:00 UTC.',
      ),
      4 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the end date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the last year.',
      ),
      5 =>
      array (
        'name' => 'granularity',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the granularity of consumption metrics. Hourly, daily, and monthly metrics are available for the last 168 hours, 60 days, and 1 year, respectively.',
      ),
      6 =>
      array (
        'name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the organization for which the project consumption metrics should be returned. If this parameter is not provided, the endpoint will return the metrics for the authenticated user\'s projects.',
      ),
      7 =>
      array (
        'name' => 'include_v1_metrics',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'The field is deprecated. Please use metrics instead. If metrics is specified, this field is ignored. Include metrics utilized in previous pricing models. - datastoragebyteshour: The sum of the maximum observed storage values for each hour, which never decreases.',
      ),
      8 =>
      array (
        'name' => 'metrics',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Specify a list of metrics to include in the response. If omitted, activetime, computetime, writtendata, syntheticstoragesize are returned. Possible values: - activetimeseconds - computetimeseconds - writtendatabytes - syntheticstoragesizebytes - datastoragebyteshour - logicalsizebytes - logicalsizebyteshour A list of metrics can be specified as an array of parameter values or as a comma-separated list in a single parameter value. - As an array of parameter values: metrics=cpuseconds&metrics=rambytes - As a comma-separated list in a single parameter value: metrics=cpuseconds,rambytes',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_consumption_history_per_project_v2' =>
  array (
    'slug' => 'neon_get_consumption_history_per_project_v2',
    'class' => 'NeonGetConsumptionHistoryPerProjectV2',
    'method' => 'GET',
    'path' => '/consumption_history/v2/projects',
    'operation_id' => 'getConsumptionHistoryPerProjectV2',
    'name' => 'Retrieve project consumption metrics',
    'description' => 'Retrieves consumption metrics for Launch, Scale, Agent, and Enterprise plan projects. History begins at the time of upgrade. Results are ordered by time in ascending order oldest to newest. Issuing a call to this API does not wake a project\'s compute endpoint.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Specify the cursor value from the previous response to get the next batch of projects.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Specify a value from 1 to 100 to limit number of projects in the response.',
      ),
      2 =>
      array (
        'name' => 'project_ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Specify a list of project IDs to filter the response. If omitted, the response will contain all projects. A list of project IDs can be specified as an array of parameter values or as a comma-separated list in a single parameter value. - As an array of parameter values: projectids=cold-poetry-09157238%20&projectids=quiet-snow-71788278 - As a comma-separated list in a single parameter value: projectids=cold-poetry-09157238,quiet-snow-71788278',
      ),
      3 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the start date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the last year. The consumption history is available starting from March 1, 2024, at 00:00:00 UTC.',
      ),
      4 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the end date-time for the consumption period. The date-time value is rounded according to the specified granularity. For example, 2024-03-15T15:30:00Z for daily granularity will be rounded to 2024-03-15T00:00:00Z. The specified date-time value must respect the specified granularity: - For hourly, consumption metrics are limited to the last 168 hours. - For daily, consumption metrics are limited to the last 60 days. - For monthly, consumption metrics are limited to the last year.',
      ),
      5 =>
      array (
        'name' => 'granularity',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the granularity of consumption metrics. Hourly, daily, and monthly metrics are available for the last 168 hours, 60 days, and 1 year, respectively.',
      ),
      6 =>
      array (
        'name' => 'org_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Specify the organization for which the project consumption metrics should be returned. If this parameter is not provided, the endpoint will return the metrics for the authenticated user\'s projects.',
      ),
      7 =>
      array (
        'name' => 'metrics',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'array',
        'description' => 'Specify a list of metrics to include in the response. Possible values: - computeunitseconds - rootbranchbytesmonth - childbranchbytesmonth - instantrestorebytesmonth - publicnetworktransferbytes - privatenetworktransferbytes - extrabranchesmonth - snapshotstoragebytesmonth A list of metrics can be specified as an array of parameter values or as a comma-separated list in a single parameter value. - As an array of parameter values: metrics=computeunitseconds&metrics=extrabranchesmonth - As a comma-separated list in a single parameter value: metrics=computeunitseconds,extrabranchesmonth',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization' =>
  array (
    'slug' => 'neon_get_organization',
    'class' => 'NeonGetOrganization',
    'method' => 'GET',
    'path' => '/organizations/{org_id}',
    'operation_id' => 'getOrganization',
    'name' => 'Retrieve organization details',
    'description' => 'Retrieves information about the specified organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_org_api_keys' =>
  array (
    'slug' => 'neon_list_org_api_keys',
    'class' => 'NeonListOrgApiKeys',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/api_keys',
    'operation_id' => 'listOrgApiKeys',
    'name' => 'List organization API keys',
    'description' => 'Retrieves the API keys for the specified organization. The response does not include API key tokens. A token is only provided when creating an API key. API keys can also be managed in the Neon Console. For more information, see Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_org_api_key' =>
  array (
    'slug' => 'neon_create_org_api_key',
    'class' => 'NeonCreateOrgApiKey',
    'method' => 'POST',
    'path' => '/organizations/{org_id}/api_keys',
    'operation_id' => 'createOrgApiKey',
    'name' => 'Create organization API key',
    'description' => 'Creates an API key for the specified organization. The keyname is a user-specified name for the key. This method returns an id and key. The key is a randomly generated, 64-bit token required to access the Neon API. API keys can also be managed in the Neon Console. See Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_revoke_org_api_key' =>
  array (
    'slug' => 'neon_revoke_org_api_key',
    'class' => 'NeonRevokeOrgApiKey',
    'method' => 'DELETE',
    'path' => '/organizations/{org_id}/api_keys/{key_id}',
    'operation_id' => 'revokeOrgApiKey',
    'name' => 'Revoke organization API key',
    'description' => 'Revokes the specified organization API key. An API key that is no longer needed can be revoked. This action cannot be reversed. You can obtain keyid values by listing the API keys for an organization. API keys can also be managed in the Neon Console. See Manage API keyshttps://neon.tech/docs/manage/api-keys/.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'key_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The API key ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization_spending_limit' =>
  array (
    'slug' => 'neon_get_organization_spending_limit',
    'class' => 'NeonGetOrganizationSpendingLimit',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/billing/spending_limit',
    'operation_id' => 'getOrganizationSpendingLimit',
    'name' => 'Retrieve the organization\'s monthly spending limit',
    'description' => 'Returns the configured spending limit for a V3 paid organization. spendinglimitcents: null indicates that no limit is currently set. Available to organization members with read access on Launch and Scale plans only.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_set_organization_spending_limit' =>
  array (
    'slug' => 'neon_set_organization_spending_limit',
    'class' => 'NeonSetOrganizationSpendingLimit',
    'method' => 'PUT',
    'path' => '/organizations/{org_id}/billing/spending_limit',
    'operation_id' => 'setOrganizationSpendingLimit',
    'name' => 'Set the organization\'s monthly spending limit',
    'description' => 'Sets the spending limit for a V3 paid organization. To remove a previously configured limit, send a DELETE request to this endpoint. When a limit is configured, email notifications are sent at 80% and 100% of the limit. Computes are not suspended by this feature. Available to organization admins on Launch and Scale plans only.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_organization_spending_limit' =>
  array (
    'slug' => 'neon_delete_organization_spending_limit',
    'class' => 'NeonDeleteOrganizationSpendingLimit',
    'method' => 'DELETE',
    'path' => '/organizations/{org_id}/billing/spending_limit',
    'operation_id' => 'deleteOrganizationSpendingLimit',
    'name' => 'Clear the organization\'s monthly spending limit',
    'description' => 'Removes a previously configured spending limit for a V3 paid organization. Idempotent deleting an already-unset limit still succeeds. Available to organization admins on Launch and Scale plans only.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization_members' =>
  array (
    'slug' => 'neon_get_organization_members',
    'class' => 'NeonGetOrganizationMembers',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/members',
    'operation_id' => 'getOrganizationMembers',
    'name' => 'Retrieve organization members details',
    'description' => 'Retrieves a paginated list of members for the specified organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Sort the members by the specified field. Defaults to joinedat.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A cursor to use in pagination. A cursor defines your place in the data list. Include response.pagination.next in subsequent API calls to fetch next page of the list.',
      ),
      3 =>
      array (
        'name' => 'sort_order',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Defines the sorting order of entities.',
      ),
      4 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The maximum number of members to return in the response',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization_member' =>
  array (
    'slug' => 'neon_get_organization_member',
    'class' => 'NeonGetOrganizationMember',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/members/{member_id}',
    'operation_id' => 'getOrganizationMember',
    'name' => 'Retrieve organization member details',
    'description' => 'Retrieves information about the specified organization member.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'member_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization member ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_organization_member' =>
  array (
    'slug' => 'neon_update_organization_member',
    'class' => 'NeonUpdateOrganizationMember',
    'method' => 'PATCH',
    'path' => '/organizations/{org_id}/members/{member_id}',
    'operation_id' => 'updateOrganizationMember',
    'name' => 'Update role for organization member',
    'description' => 'Only an admin can perform this action.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'member_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization member ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_remove_organization_member' =>
  array (
    'slug' => 'neon_remove_organization_member',
    'class' => 'NeonRemoveOrganizationMember',
    'method' => 'DELETE',
    'path' => '/organizations/{org_id}/members/{member_id}',
    'operation_id' => 'removeOrganizationMember',
    'name' => 'Remove member from the organization',
    'description' => 'Remove member from the organization. Only an admin of the organization can perform this action. If another admin is being removed, it will not be allows in case it is the only admin left in the organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'member_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization member ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization_invitations' =>
  array (
    'slug' => 'neon_get_organization_invitations',
    'class' => 'NeonGetOrganizationInvitations',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/invitations',
    'operation_id' => 'getOrganizationInvitations',
    'name' => 'Retrieve organization invitation details',
    'description' => 'Retrieves information about extended invitations for the specified organization',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_create_organization_invitations' =>
  array (
    'slug' => 'neon_create_organization_invitations',
    'class' => 'NeonCreateOrganizationInvitations',
    'method' => 'POST',
    'path' => '/organizations/{org_id}/invitations',
    'operation_id' => 'createOrganizationInvitations',
    'name' => 'Create organization invitations',
    'description' => 'Creates invitations for a specific organization. If the invited user has an existing account, they automatically join as a member. If they don\'t yet have an account, they are invited to create one, after which they become a member. Each invited user receives an email notification.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_transfer_projects_from_org_to_org' =>
  array (
    'slug' => 'neon_transfer_projects_from_org_to_org',
    'class' => 'NeonTransferProjectsFromOrgToOrg',
    'method' => 'POST',
    'path' => '/organizations/{source_org_id}/projects/transfer',
    'operation_id' => 'transferProjectsFromOrgToOrg',
    'name' => 'Transfer projects between organizations',
    'description' => 'Transfers selected projects, identified by their IDs, from your organization to another specified organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'source_org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID source org, which currently owns the project',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_list_organization_v_p_c_endpoints_all_regions' =>
  array (
    'slug' => 'neon_list_organization_v_p_c_endpoints_all_regions',
    'class' => 'NeonListOrganizationVPCEndpointsAllRegions',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/vpc/vpc_endpoints',
    'operation_id' => 'listOrganizationVPCEndpointsAllRegions',
    'name' => 'List VPC endpoints across all regions',
    'description' => 'Retrieves the list of VPC endpoints for the specified Neon organization across all regions.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_organization_v_p_c_endpoints' =>
  array (
    'slug' => 'neon_list_organization_v_p_c_endpoints',
    'class' => 'NeonListOrganizationVPCEndpoints',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/vpc/region/{region_id}/vpc_endpoints',
    'operation_id' => 'listOrganizationVPCEndpoints',
    'name' => 'List VPC endpoints',
    'description' => 'Retrieves the list of VPC endpoints for the specified Neon organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'region_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon region ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_organization_v_p_c_endpoint_details' =>
  array (
    'slug' => 'neon_get_organization_v_p_c_endpoint_details',
    'class' => 'NeonGetOrganizationVPCEndpointDetails',
    'method' => 'GET',
    'path' => '/organizations/{org_id}/vpc/region/{region_id}/vpc_endpoints/{vpc_endpoint_id}',
    'operation_id' => 'getOrganizationVPCEndpointDetails',
    'name' => 'Retrieve VPC endpoint details',
    'description' => 'Retrieves the current state and configuration details of a specified VPC endpoint.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'region_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon region ID. Azure regions are currently not supported.',
      ),
      2 =>
      array (
        'name' => 'vpc_endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The VPC endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_assign_organization_v_p_c_endpoint' =>
  array (
    'slug' => 'neon_assign_organization_v_p_c_endpoint',
    'class' => 'NeonAssignOrganizationVPCEndpoint',
    'method' => 'POST',
    'path' => '/organizations/{org_id}/vpc/region/{region_id}/vpc_endpoints/{vpc_endpoint_id}',
    'operation_id' => 'assignOrganizationVPCEndpoint',
    'name' => 'Assign or update VPC endpoint',
    'description' => 'Assigns a VPC endpoint to a Neon organization or updates its existing assignment.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'region_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon region ID. Azure regions are currently not supported.',
      ),
      2 =>
      array (
        'name' => 'vpc_endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The VPC endpoint ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_delete_organization_v_p_c_endpoint' =>
  array (
    'slug' => 'neon_delete_organization_v_p_c_endpoint',
    'class' => 'NeonDeleteOrganizationVPCEndpoint',
    'method' => 'DELETE',
    'path' => '/organizations/{org_id}/vpc/region/{region_id}/vpc_endpoints/{vpc_endpoint_id}',
    'operation_id' => 'deleteOrganizationVPCEndpoint',
    'name' => 'Delete VPC endpoint',
    'description' => 'Deletes the VPC endpoint from the specified Neon organization. If you delete a VPC endpoint from a Neon organization, that VPC endpoint cannot be added back to the Neon organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon organization ID',
      ),
      1 =>
      array (
        'name' => 'region_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon region ID. Azure regions are currently not supported.',
      ),
      2 =>
      array (
        'name' => 'vpc_endpoint_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The VPC endpoint ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_active_regions' =>
  array (
    'slug' => 'neon_get_active_regions',
    'class' => 'NeonGetActiveRegions',
    'method' => 'GET',
    'path' => '/regions',
    'operation_id' => 'getActiveRegions',
    'name' => 'List supported regions',
    'description' => 'Lists supported Neon regions. Note: Not all regions are available to all organizations. Pass the orgid parameter to get an accurate list of regions available to your organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Organization ID. When provided, returns only regions available to this organization. Recommended for accurate region availability.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_get_current_user' =>
  array (
    'slug' => 'neon_get_current_user',
    'class' => 'NeonGetCurrentUser',
    'method' => 'GET',
    'path' => '/users/me',
    'operation_id' => 'getCurrentUserInfo',
    'name' => 'Retrieve current user details',
    'description' => 'Retrieves information about the current Neon user account.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'neon_get_current_user_organizations' =>
  array (
    'slug' => 'neon_get_current_user_organizations',
    'class' => 'NeonGetCurrentUserOrganizations',
    'method' => 'GET',
    'path' => '/users/me/organizations',
    'operation_id' => 'getCurrentUserOrganizations',
    'name' => 'Retrieve current user organizations list',
    'description' => 'Retrieves information about the current Neon user\'s organizations',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'neon_transfer_projects_from_user_to_org' =>
  array (
    'slug' => 'neon_transfer_projects_from_user_to_org',
    'class' => 'NeonTransferProjectsFromUserToOrg',
    'method' => 'POST',
    'path' => '/users/me/projects/transfer',
    'operation_id' => 'transferProjectsFromUserToOrg',
    'name' => 'Transfer projects from personal account to organization',
    'description' => 'Transfers selected projects, identified by their IDs, from your personal account to a specified organization.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_auth_details' =>
  array (
    'slug' => 'neon_get_auth_details',
    'class' => 'NeonGetAuthDetails',
    'method' => 'GET',
    'path' => '/auth',
    'operation_id' => 'getAuthDetails',
    'name' => 'Get request authentication details',
    'description' => 'Returns auth information about the passed credentials. It can refer to an API key, Bearer token or OAuth session.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'neon_create_snapshot' =>
  array (
    'slug' => 'neon_create_snapshot',
    'class' => 'NeonCreateSnapshot',
    'method' => 'POST',
    'path' => '/projects/{project_id}/branches/{branch_id}/snapshot',
    'operation_id' => 'createSnapshot',
    'name' => 'Create snapshot',
    'description' => 'Create a snapshot from the specified branch using the provided parameters. This endpoint may initiate an asynchronous operation. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
      2 =>
      array (
        'name' => 'lsn',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The target Log Sequence Number LSN to take the snapshot from. Must fall within the restore window. Cannot be used with timestamp',
      ),
      3 =>
      array (
        'name' => 'timestamp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The target timestamp for the snapshot. Must fall within the restore window. Use ISO 8601 format e.g. 2025-08-05T22:00:00Z. Cannot be used with lsn.',
      ),
      4 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A name for the snapshot.',
      ),
      5 =>
      array (
        'name' => 'expires_at',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The time at which the snapshot will be automatically deleted. Use ISO 8601 format e.g. 2025-08-05T22:00:00Z.',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_list_snapshots' =>
  array (
    'slug' => 'neon_list_snapshots',
    'class' => 'NeonListSnapshots',
    'method' => 'GET',
    'path' => '/projects/{project_id}/snapshots',
    'operation_id' => 'listSnapshots',
    'name' => 'List project snapshots',
    'description' => 'List the snapshots for the specified project. Note: This endpoint is currently in Beta.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_delete_snapshot' =>
  array (
    'slug' => 'neon_delete_snapshot',
    'class' => 'NeonDeleteSnapshot',
    'method' => 'DELETE',
    'path' => '/projects/{project_id}/snapshots/{snapshot_id}',
    'operation_id' => 'deleteSnapshot',
    'name' => 'Delete snapshot',
    'description' => 'Delete the specified snapshot. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'snapshot_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The snapshot ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_update_snapshot' =>
  array (
    'slug' => 'neon_update_snapshot',
    'class' => 'NeonUpdateSnapshot',
    'method' => 'PATCH',
    'path' => '/projects/{project_id}/snapshots/{snapshot_id}',
    'operation_id' => 'updateSnapshot',
    'name' => 'Update snapshot',
    'description' => 'Update the specified snapshot. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'snapshot_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The snapshot ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_restore_snapshot' =>
  array (
    'slug' => 'neon_restore_snapshot',
    'class' => 'NeonRestoreSnapshot',
    'method' => 'POST',
    'path' => '/projects/{project_id}/snapshots/{snapshot_id}/restore',
    'operation_id' => 'restoreSnapshot',
    'name' => 'Restore snapshot',
    'description' => 'Restore the specified snapshot to a new branch and optionally finalize the restore operation. Note: This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'snapshot_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The snapshot ID',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'DEPRECATED. Use the name field in the request body instead. A name for the newly restored branch. If omitted, a default name will be generated.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
  'neon_get_snapshot_schedule' =>
  array (
    'slug' => 'neon_get_snapshot_schedule',
    'class' => 'NeonGetSnapshotSchedule',
    'method' => 'GET',
    'path' => '/projects/{project_id}/branches/{branch_id}/backup_schedule',
    'operation_id' => 'getSnapshotSchedule',
    'name' => 'View backup schedule',
    'description' => 'View the backup schedule for the specified branch. Note: This endpoint is currently in Beta.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'neon_set_snapshot_schedule' =>
  array (
    'slug' => 'neon_set_snapshot_schedule',
    'class' => 'NeonSetSnapshotSchedule',
    'method' => 'PUT',
    'path' => '/projects/{project_id}/branches/{branch_id}/backup_schedule',
    'operation_id' => 'setSnapshotSchedule',
    'name' => 'Update backup schedule',
    'description' => 'Update the backup schedule for the specified branch. Note : This endpoint is currently in Beta.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Neon project ID',
      ),
      1 =>
      array (
        'name' => 'branch_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The branch ID',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the Neon API operation.',
    ),
  ),
);
    }
}
