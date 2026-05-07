<?php

namespace OpenCompany\Integrations\Grafana;

/**
 * Official Grafana OpenAPI operation metadata.
 *
 * Generated from Grafana's public/openapi3.json in the official grafana/grafana repository.
 */
final class GrafanaOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'grafana_list_roles' =>
  array (
    'slug' => 'grafana_list_roles',
    'class' => 'GrafanaListRoles',
    'type' => 'read',
    'name' => 'Get all roles.',
    'description' => 'Gets all existing roles. The response contains all global and organization local roles, for the organization which user is signed in. You need to have a permission with action `roles:read` and scope `roles:*`. The `delegatable` flag reduces the set of roles to only those for which the signed-in user has permissions to assign.',
    'operation_id' => 'listRoles',
    'method' => 'GET',
    'path' => '/access-control/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'delegatable',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'includeHidden',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      2 =>
      array (
        'name' => 'targetOrgId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_role' =>
  array (
    'slug' => 'grafana_create_role',
    'class' => 'GrafanaCreateRole',
    'type' => 'write',
    'name' => 'Create a new custom role.',
    'description' => 'Creates a new custom role and maps given permissions to that role. Note that roles with the same prefix as Fixed Roles can\'t be created. You need to have a permission with action `roles:write` and scope `permissions:type:delegate`. `permissions:type:delegate` scope ensures that users can only create custom roles with the same, or a subset of permissions which the user has. For example, if a use...',
    'operation_id' => 'createRole',
    'method' => 'POST',
    'path' => '/access-control/roles',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_role' =>
  array (
    'slug' => 'grafana_delete_role',
    'class' => 'GrafanaDeleteRole',
    'type' => 'write',
    'name' => 'Delete a custom role.',
    'description' => 'Delete a role with the given UID, and it\'s permissions. If the role is assigned to a built-in role, the deletion operation will fail, unless force query param is set to true, and in that case all assignments will also be deleted. You need to have a permission with action `roles:delete` and scope `permissions:type:delegate`. `permissions:type:delegate` scope ensures that users can only delete a...',
    'operation_id' => 'deleteRole',
    'method' => 'DELETE',
    'path' => '/access-control/roles/{roleUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'force',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'global',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      2 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_role' =>
  array (
    'slug' => 'grafana_get_role',
    'class' => 'GrafanaGetRole',
    'type' => 'read',
    'name' => 'Get a role.',
    'description' => 'Get a role for the given UID. You need to have a permission with action `roles:read` and scope `roles:*`.',
    'operation_id' => 'getRole',
    'method' => 'GET',
    'path' => '/access-control/roles/{roleUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_role' =>
  array (
    'slug' => 'grafana_update_role',
    'class' => 'GrafanaUpdateRole',
    'type' => 'write',
    'name' => 'Update a custom role.',
    'description' => 'You need to have a permission with action `roles:write` and scope `permissions:type:delegate`. `permissions:type:delegate` scope ensures that users can only create custom roles with the same, or a subset of permissions which the user has.',
    'operation_id' => 'updateRole',
    'method' => 'PUT',
    'path' => '/access-control/roles/{roleUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_role_assignments' =>
  array (
    'slug' => 'grafana_get_role_assignments',
    'class' => 'GrafanaGetRoleAssignments',
    'type' => 'read',
    'name' => 'Get role assignments.',
    'description' => 'Get role assignments for the role with the given UID. Does not include role assignments mapped through group attribute sync. You need to have a permission with action `teams.roles:list` and scope `teams:id:*` and `users.roles:list` and scope `users:id:*`.',
    'operation_id' => 'getRoleAssignments',
    'method' => 'GET',
    'path' => '/access-control/roles/{roleUID}/assignments',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_set_role_assignments' =>
  array (
    'slug' => 'grafana_set_role_assignments',
    'class' => 'GrafanaSetRoleAssignments',
    'type' => 'write',
    'name' => 'Set role assignments.',
    'description' => 'Set role assignments for the role with the given UID. You need to have a permission with action `teams.roles:add` and `teams.roles:remove` and scope `permissions:type:delegate`, and `users.roles:add` and `users.roles:remove` and scope `permissions:type:delegate`.',
    'operation_id' => 'setRoleAssignments',
    'method' => 'PUT',
    'path' => '/access-control/roles/{roleUID}/assignments',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_access_control_status' =>
  array (
    'slug' => 'grafana_get_access_control_status',
    'class' => 'GrafanaGetAccessControlStatus',
    'type' => 'read',
    'name' => 'Get status.',
    'description' => 'Returns an indicator to check if fine-grained access control is enabled or not. You need to have a permission with action `status:accesscontrol` and scope `services:accesscontrol`.',
    'operation_id' => 'getAccessControlStatus',
    'method' => 'GET',
    'path' => '/access-control/status',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_list_teams_roles' =>
  array (
    'slug' => 'grafana_list_teams_roles',
    'class' => 'GrafanaListTeamsRoles',
    'type' => 'write',
    'name' => 'List roles assigned to multiple teams.',
    'description' => 'Lists the roles that have been directly assigned to the given teams. You need to have a permission with action `teams.roles:read` and scope `teams:id:*`.',
    'operation_id' => 'listTeamsRoles',
    'method' => 'POST',
    'path' => '/access-control/teams/roles/search',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_team_roles' =>
  array (
    'slug' => 'grafana_list_team_roles',
    'class' => 'GrafanaListTeamRoles',
    'type' => 'read',
    'name' => 'Get team roles.',
    'description' => 'You need to have a permission with action `teams.roles:read` and scope `teams:id:<team ID>`.',
    'operation_id' => 'listTeamRoles',
    'method' => 'GET',
    'path' => '/access-control/teams/{teamId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'targetOrgId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_team_role' =>
  array (
    'slug' => 'grafana_add_team_role',
    'class' => 'GrafanaAddTeamRole',
    'type' => 'write',
    'name' => 'Add team role.',
    'description' => 'You need to have a permission with action `teams.roles:add` and scope `permissions:type:delegate`.',
    'operation_id' => 'addTeamRole',
    'method' => 'POST',
    'path' => '/access-control/teams/{teamId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_team_roles' =>
  array (
    'slug' => 'grafana_set_team_roles',
    'class' => 'GrafanaSetTeamRoles',
    'type' => 'write',
    'name' => 'Update team role.',
    'description' => 'You need to have a permission with action `teams.roles:add` and `teams.roles:remove` and scope `permissions:type:delegate` for each.',
    'operation_id' => 'setTeamRoles',
    'method' => 'PUT',
    'path' => '/access-control/teams/{teamId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'targetOrgId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_remove_team_role' =>
  array (
    'slug' => 'grafana_remove_team_role',
    'class' => 'GrafanaRemoveTeamRole',
    'type' => 'write',
    'name' => 'Remove team role.',
    'description' => 'You need to have a permission with action `teams.roles:remove` and scope `permissions:type:delegate`.',
    'operation_id' => 'removeTeamRole',
    'method' => 'DELETE',
    'path' => '/access-control/teams/{teamId}/roles/{roleUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_list_users_roles' =>
  array (
    'slug' => 'grafana_list_users_roles',
    'class' => 'GrafanaListUsersRoles',
    'type' => 'write',
    'name' => 'List roles assigned to multiple users.',
    'description' => 'Lists the roles that have been directly assigned to the given users. The list does not include built-in roles (Viewer, Editor, Admin or Grafana Admin), and it does not include roles that have been inherited from a team. You need to have a permission with action `users.roles:read` and scope `users:id:*`.',
    'operation_id' => 'listUsersRoles',
    'method' => 'POST',
    'path' => '/access-control/users/roles/search',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_user_roles' =>
  array (
    'slug' => 'grafana_list_user_roles',
    'class' => 'GrafanaListUserRoles',
    'type' => 'read',
    'name' => 'List roles assigned to a user.',
    'description' => 'Lists the roles that have been directly assigned to a given user. The list does not include built-in roles (Viewer, Editor, Admin or Grafana Admin), and it does not include roles that have been inherited from a team. You need to have a permission with action `users.roles:read` and scope `users:id:<user ID>`.',
    'operation_id' => 'listUserRoles',
    'method' => 'GET',
    'path' => '/access-control/users/{userId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'includeHidden',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      2 =>
      array (
        'name' => 'targetOrgId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_user_role' =>
  array (
    'slug' => 'grafana_add_user_role',
    'class' => 'GrafanaAddUserRole',
    'type' => 'write',
    'name' => 'Add a user role assignment.',
    'description' => 'Assign a role to a specific user. For bulk updates consider Set user role assignments. You need to have a permission with action `users.roles:add` and scope `permissions:type:delegate`. `permissions:type:delegate` scope ensures that users can only assign roles which have same, or a subset of permissions which the user has. For example, if a user does not have required permissions for creating u...',
    'operation_id' => 'addUserRole',
    'method' => 'POST',
    'path' => '/access-control/users/{userId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_user_roles' =>
  array (
    'slug' => 'grafana_set_user_roles',
    'class' => 'GrafanaSetUserRoles',
    'type' => 'write',
    'name' => 'Set user role assignments.',
    'description' => 'Update the user\'s role assignments to match the provided set of UIDs. This will remove any assigned roles that aren\'t in the request and add roles that are in the set but are not already assigned to the user. Roles mapped through group attribute sync are not impacted. If you want to add or remove a single role, consider using Add a user role assignment or Remove a user role assignment instead...',
    'operation_id' => 'setUserRoles',
    'method' => 'PUT',
    'path' => '/access-control/users/{userId}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'targetOrgId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_remove_user_role' =>
  array (
    'slug' => 'grafana_remove_user_role',
    'class' => 'GrafanaRemoveUserRole',
    'type' => 'write',
    'name' => 'Remove a user role assignment.',
    'description' => 'Revoke a role from a user. For bulk updates consider Set user role assignments. You need to have a permission with action `users.roles:remove` and scope `permissions:type:delegate`. `permissions:type:delegate` scope ensures that users can only unassign roles which have same, or a subset of permissions which the user has. For example, if a user does not have required permissions for creating use...',
    'operation_id' => 'removeUserRole',
    'method' => 'DELETE',
    'path' => '/access-control/users/{userId}/roles/{roleUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'global',
        'in' => 'query',
        'required' => false,
        'description' => 'A flag indicating if the assignment is global or not. If set to false, the default org ID of the authenticated user will be used from the request to remove assignment.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'roleUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_resource_description' =>
  array (
    'slug' => 'grafana_get_resource_description',
    'class' => 'GrafanaGetResourceDescription',
    'type' => 'read',
    'name' => 'Get a description of a resource\'s access control properties.',
    'description' => 'Get a description of a resource\'s access control properties. (GET /access-control/{resource}/description).',
    'operation_id' => 'getResourceDescription',
    'method' => 'GET',
    'path' => '/access-control/{resource}/description',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_resource_permissions' =>
  array (
    'slug' => 'grafana_get_resource_permissions',
    'class' => 'GrafanaGetResourcePermissions',
    'type' => 'read',
    'name' => 'Get permissions for a resource.',
    'description' => 'Get permissions for a resource. (GET /access-control/{resource}/{resourceID}).',
    'operation_id' => 'getResourcePermissions',
    'method' => 'GET',
    'path' => '/access-control/{resource}/{resourceID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_set_resource_permissions' =>
  array (
    'slug' => 'grafana_set_resource_permissions',
    'class' => 'GrafanaSetResourcePermissions',
    'type' => 'write',
    'name' => 'Set resource permissions.',
    'description' => 'Assigns permissions for a resource by a given type (`:resource`) and `:resourceID` to one or many assignment types. Allowed resources are `datasources`, `teams`, `dashboards`, `folders`, and `serviceaccounts`. Refer to the `/access-control/{resource}/description` endpoint for allowed Permissions.',
    'operation_id' => 'setResourcePermissions',
    'method' => 'POST',
    'path' => '/access-control/{resource}/{resourceID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_resource_permissions_for_built_in_role' =>
  array (
    'slug' => 'grafana_set_resource_permissions_for_built_in_role',
    'class' => 'GrafanaSetResourcePermissionsForBuiltInRole',
    'type' => 'write',
    'name' => 'Set resource permissions for a built-in role.',
    'description' => 'Assigns permissions for a resource by a given type (`:resource`) and `:resourceID` to a built-in role. Allowed resources are `datasources`, `teams`, `dashboards`, `folders`, and `serviceaccounts`. Refer to the `/access-control/{resource}/description` endpoint for allowed Permissions.',
    'operation_id' => 'setResourcePermissionsForBuiltInRole',
    'method' => 'POST',
    'path' => '/access-control/{resource}/{resourceID}/builtInRoles/{builtInRole}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'builtInRole',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_resource_permissions_for_team' =>
  array (
    'slug' => 'grafana_set_resource_permissions_for_team',
    'class' => 'GrafanaSetResourcePermissionsForTeam',
    'type' => 'write',
    'name' => 'Set resource permissions for a team.',
    'description' => 'Assigns permissions for a resource by a given type (`:resource`) and `:resourceID` to a team. Allowed resources are `datasources`, `teams`, `dashboards`, `folders`, and `serviceaccounts`. Refer to the `/access-control/{resource}/description` endpoint for allowed Permissions.',
    'operation_id' => 'setResourcePermissionsForTeam',
    'method' => 'POST',
    'path' => '/access-control/{resource}/{resourceID}/teams/{teamID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'teamID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_resource_permissions_for_user' =>
  array (
    'slug' => 'grafana_set_resource_permissions_for_user',
    'class' => 'GrafanaSetResourcePermissionsForUser',
    'type' => 'write',
    'name' => 'Set resource permissions for a user.',
    'description' => 'Assigns permissions for a resource by a given type (`:resource`) and `:resourceID` to a user or a service account. Allowed resources are `datasources`, `teams`, `dashboards`, `folders`, and `serviceaccounts`. Refer to the `/access-control/{resource}/description` endpoint for allowed Permissions.',
    'operation_id' => 'setResourcePermissionsForUser',
    'method' => 'POST',
    'path' => '/access-control/{resource}/{resourceID}/users/{userID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'userID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_sync_status' =>
  array (
    'slug' => 'grafana_get_sync_status',
    'class' => 'GrafanaGetSyncStatus',
    'type' => 'read',
    'name' => 'Returns the current state of the LDAP background sync integration.',
    'description' => 'You need to have a permission with action `ldap.status:read`.',
    'operation_id' => 'getSyncStatus',
    'method' => 'GET',
    'path' => '/admin/ldap-sync-status',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_reload_l_d_a_p_cfg' =>
  array (
    'slug' => 'grafana_reload_l_d_a_p_cfg',
    'class' => 'GrafanaReloadLDAPCfg',
    'type' => 'write',
    'name' => 'Reloads the LDAP configuration.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `ldap.config:reload`.',
    'operation_id' => 'reloadLDAPCfg',
    'method' => 'POST',
    'path' => '/admin/ldap/reload',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_l_d_a_p_status' =>
  array (
    'slug' => 'grafana_get_l_d_a_p_status',
    'class' => 'GrafanaGetLDAPStatus',
    'type' => 'read',
    'name' => 'Attempts to connect to all the configured LDAP servers and returns information on whenever they\'r...',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `ldap.status:read`.',
    'operation_id' => 'getLDAPStatus',
    'method' => 'GET',
    'path' => '/admin/ldap/status',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_post_sync_user_with_l_d_a_p' =>
  array (
    'slug' => 'grafana_post_sync_user_with_l_d_a_p',
    'class' => 'GrafanaPostSyncUserWithLDAP',
    'type' => 'write',
    'name' => 'Enables a single Grafana user to be synchronized against LDAP.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `ldap.user:sync`.',
    'operation_id' => 'postSyncUserWithLDAP',
    'method' => 'POST',
    'path' => '/admin/ldap/sync/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_user_from_l_d_a_p' =>
  array (
    'slug' => 'grafana_get_user_from_l_d_a_p',
    'class' => 'GrafanaGetUserFromLDAP',
    'type' => 'read',
    'name' => 'Finds an user based on a username in LDAP. This helps illustrate how would the particular user be...',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `ldap.user:read`.',
    'operation_id' => 'getUserFromLDAP',
    'method' => 'GET',
    'path' => '/admin/ldap/{user_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_provisioning_reload_access_control' =>
  array (
    'slug' => 'grafana_admin_provisioning_reload_access_control',
    'class' => 'GrafanaAdminProvisioningReloadAccessControl',
    'type' => 'write',
    'name' => 'You need to have a permission with action `provisioning:reload` with scope `provisioners:accessco...',
    'description' => 'You need to have a permission with action `provisioning:reload` with scope `provisioners:accessco... (POST /admin/provisioning/access-control/reload).',
    'operation_id' => 'adminProvisioningReloadAccessControl',
    'method' => 'POST',
    'path' => '/admin/provisioning/access-control/reload',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_provisioning_reload_dashboards' =>
  array (
    'slug' => 'grafana_admin_provisioning_reload_dashboards',
    'class' => 'GrafanaAdminProvisioningReloadDashboards',
    'type' => 'write',
    'name' => 'Reload dashboard provisioning configurations.',
    'description' => 'Reloads the provisioning config files for dashboards again. It won\'t return until the new provisioned entities are already stored in the database. In case of dashboards, it will stop polling for changes in dashboard files and then restart it with new configurations after returning. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission...',
    'operation_id' => 'adminProvisioningReloadDashboards',
    'method' => 'POST',
    'path' => '/admin/provisioning/dashboards/reload',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_provisioning_reload_datasources' =>
  array (
    'slug' => 'grafana_admin_provisioning_reload_datasources',
    'class' => 'GrafanaAdminProvisioningReloadDatasources',
    'type' => 'write',
    'name' => 'Reload datasource provisioning configurations.',
    'description' => 'Reloads the provisioning config files for datasources again. It won\'t return until the new provisioned entities are already stored in the database. In case of dashboards, it will stop polling for changes in dashboard files and then restart it with new configurations after returning. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission...',
    'operation_id' => 'adminProvisioningReloadDatasources',
    'method' => 'POST',
    'path' => '/admin/provisioning/datasources/reload',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_provisioning_reload_plugins' =>
  array (
    'slug' => 'grafana_admin_provisioning_reload_plugins',
    'class' => 'GrafanaAdminProvisioningReloadPlugins',
    'type' => 'write',
    'name' => 'Reload plugin provisioning configurations.',
    'description' => 'Reloads the provisioning config files for plugins again. It won\'t return until the new provisioned entities are already stored in the database. In case of dashboards, it will stop polling for changes in dashboard files and then restart it with new configurations after returning. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission wit...',
    'operation_id' => 'adminProvisioningReloadPlugins',
    'method' => 'POST',
    'path' => '/admin/provisioning/plugins/reload',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_get_settings' =>
  array (
    'slug' => 'grafana_admin_get_settings',
    'class' => 'GrafanaAdminGetSettings',
    'type' => 'read',
    'name' => 'Fetch settings.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `settings:read` and scopes: `settings:*`, `settings:auth.saml:` and `settings:auth.saml:enabled` (property level).',
    'operation_id' => 'adminGetSettings',
    'method' => 'GET',
    'path' => '/admin/settings',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_get_stats' =>
  array (
    'slug' => 'grafana_admin_get_stats',
    'class' => 'GrafanaAdminGetStats',
    'type' => 'read',
    'name' => 'Fetch Grafana Stats.',
    'description' => 'Only works with Basic Authentication (username and password). See introduction for an explanation. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `server:stats:read`.',
    'operation_id' => 'adminGetStats',
    'method' => 'GET',
    'path' => '/admin/stats',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_create_user' =>
  array (
    'slug' => 'grafana_admin_create_user',
    'class' => 'GrafanaAdminCreateUser',
    'type' => 'write',
    'name' => 'Create new user.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users:create`. Note that OrgId is an optional parameter that can be used to assign a new user to a different organization when `auto_assign_org` is set to `true`.',
    'operation_id' => 'adminCreateUser',
    'method' => 'POST',
    'path' => '/admin/users',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_admin_delete_user' =>
  array (
    'slug' => 'grafana_admin_delete_user',
    'class' => 'GrafanaAdminDeleteUser',
    'type' => 'write',
    'name' => 'Delete global User.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users:delete` and scope `global.users:*`.',
    'operation_id' => 'adminDeleteUser',
    'method' => 'DELETE',
    'path' => '/admin/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_get_user_auth_tokens' =>
  array (
    'slug' => 'grafana_admin_get_user_auth_tokens',
    'class' => 'GrafanaAdminGetUserAuthTokens',
    'type' => 'read',
    'name' => 'Return a list of all auth tokens (devices) that the user currently have logged in from.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.authtoken:list` and scope `global.users:*`.',
    'operation_id' => 'adminGetUserAuthTokens',
    'method' => 'GET',
    'path' => '/admin/users/{user_id}/auth-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_disable_user' =>
  array (
    'slug' => 'grafana_admin_disable_user',
    'class' => 'GrafanaAdminDisableUser',
    'type' => 'write',
    'name' => 'Disable user.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users:disable` and scope `global.users:1` (userIDScope).',
    'operation_id' => 'adminDisableUser',
    'method' => 'POST',
    'path' => '/admin/users/{user_id}/disable',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_enable_user' =>
  array (
    'slug' => 'grafana_admin_enable_user',
    'class' => 'GrafanaAdminEnableUser',
    'type' => 'write',
    'name' => 'Enable user.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users:enable` and scope `global.users:1` (userIDScope).',
    'operation_id' => 'adminEnableUser',
    'method' => 'POST',
    'path' => '/admin/users/{user_id}/enable',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_logout_user' =>
  array (
    'slug' => 'grafana_admin_logout_user',
    'class' => 'GrafanaAdminLogoutUser',
    'type' => 'write',
    'name' => 'Logout user revokes all auth tokens (devices) for the user. User of issued auth tokens (devices)...',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.logout` and scope `global.users:*`.',
    'operation_id' => 'adminLogoutUser',
    'method' => 'POST',
    'path' => '/admin/users/{user_id}/logout',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_admin_update_user_password' =>
  array (
    'slug' => 'grafana_admin_update_user_password',
    'class' => 'GrafanaAdminUpdateUserPassword',
    'type' => 'write',
    'name' => 'Set password for user.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.password:update` and scope `global.users:*`.',
    'operation_id' => 'adminUpdateUserPassword',
    'method' => 'PUT',
    'path' => '/admin/users/{user_id}/password',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_admin_update_user_permissions' =>
  array (
    'slug' => 'grafana_admin_update_user_permissions',
    'class' => 'GrafanaAdminUpdateUserPermissions',
    'type' => 'write',
    'name' => 'Set permissions for user.',
    'description' => 'Only works with Basic Authentication (username and password). See introduction for an explanation. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.permissions:update` and scope `global.users:*`.',
    'operation_id' => 'adminUpdateUserPermissions',
    'method' => 'PUT',
    'path' => '/admin/users/{user_id}/permissions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_user_quota' =>
  array (
    'slug' => 'grafana_get_user_quota',
    'class' => 'GrafanaGetUserQuota',
    'type' => 'read',
    'name' => 'Fetch user quota.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.quotas:list` and scope `global.users:1` (userIDScope).',
    'operation_id' => 'getUserQuota',
    'method' => 'GET',
    'path' => '/admin/users/{user_id}/quotas',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_user_quota' =>
  array (
    'slug' => 'grafana_update_user_quota',
    'class' => 'GrafanaUpdateUserQuota',
    'type' => 'write',
    'name' => 'Update user quota.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.quotas:update` and scope `global.users:1` (userIDScope).',
    'operation_id' => 'updateUserQuota',
    'method' => 'PUT',
    'path' => '/admin/users/{user_id}/quotas/{quota_target}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'quota_target',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_admin_revoke_user_auth_token' =>
  array (
    'slug' => 'grafana_admin_revoke_user_auth_token',
    'class' => 'GrafanaAdminRevokeUserAuthToken',
    'type' => 'write',
    'name' => 'Revoke auth token for user.',
    'description' => 'Revokes the given auth token (device) for the user. User of issued auth token (device) will no longer be logged in and will be required to authenticate again upon next activity. If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `users.authtoken:update` and scope `global.users:*`.',
    'operation_id' => 'adminRevokeUserAuthToken',
    'method' => 'POST',
    'path' => '/admin/users/{user_id}/revoke-auth-token',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_annotations' =>
  array (
    'slug' => 'grafana_get_annotations',
    'class' => 'GrafanaGetAnnotations',
    'type' => 'read',
    'name' => 'Find Annotations.',
    'description' => 'Starting in Grafana v6.4 regions annotations are now returned in one entity that now includes the timeEnd property.',
    'operation_id' => 'getAnnotations',
    'method' => 'GET',
    'path' => '/annotations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations created after specific epoch datetime in milliseconds.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations created before specific epoch datetime in milliseconds.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'userId',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit response to annotations created by specific user.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'alertId',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations for a specified alert rule by its ID. deprecated: AlertID is deprecated and will be removed in future versions. Please use AlertUID instead.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'alertUID',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations for a specified alert rule by its UID.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'dashboardId',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations that are scoped to a specific dashboard',
        'schema_type' => 'integer',
      ),
      6 =>
      array (
        'name' => 'dashboardUID',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations that are scoped to a specific dashboard',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'panelId',
        'in' => 'query',
        'required' => false,
        'description' => 'Find annotations that are scoped to a specific panel',
        'schema_type' => 'integer',
      ),
      8 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Max limit for results returned.',
        'schema_type' => 'integer',
      ),
      9 =>
      array (
        'name' => 'tags',
        'in' => 'query',
        'required' => false,
        'description' => 'Use this to filter organization annotations. Organization annotations are annotations from an annotation data source that are not connected specifically to a dashboard or panel. You can filter by multiple tags.',
        'schema_type' => 'array',
      ),
      10 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Return alerts or user created annotations',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'matchAny',
        'in' => 'query',
        'required' => false,
        'description' => 'Match any or all tags',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_post_annotation' =>
  array (
    'slug' => 'grafana_post_annotation',
    'class' => 'GrafanaPostAnnotation',
    'type' => 'write',
    'name' => 'Create Annotation.',
    'description' => 'Creates an annotation in the Grafana database. The dashboardId and panelId fields are optional. If they are not specified then an organization annotation is created and can be queried in any dashboard that adds the Grafana annotations data source. When creating a region annotation include the timeEnd property. The format for `time` and `timeEnd` should be epoch numbers in millisecond resolution...',
    'operation_id' => 'postAnnotation',
    'method' => 'POST',
    'path' => '/annotations',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_post_graphite_annotation' =>
  array (
    'slug' => 'grafana_post_graphite_annotation',
    'class' => 'GrafanaPostGraphiteAnnotation',
    'type' => 'write',
    'name' => 'Create Annotation in Graphite format.',
    'description' => 'Creates an annotation by using Graphite-compatible event format. The `when` and `data` fields are optional. If `when` is not specified then the current time will be used as annotation\'s timestamp. The `tags` field can also be in prior to Graphite `0.10.0` format (string with multiple tags being separated by a space).',
    'operation_id' => 'postGraphiteAnnotation',
    'method' => 'POST',
    'path' => '/annotations/graphite',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_mass_delete_annotations' =>
  array (
    'slug' => 'grafana_mass_delete_annotations',
    'class' => 'GrafanaMassDeleteAnnotations',
    'type' => 'write',
    'name' => 'Delete multiple annotations.',
    'description' => 'Delete multiple annotations. (POST /annotations/mass-delete).',
    'operation_id' => 'massDeleteAnnotations',
    'method' => 'POST',
    'path' => '/annotations/mass-delete',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_annotation_tags' =>
  array (
    'slug' => 'grafana_get_annotation_tags',
    'class' => 'GrafanaGetAnnotationTags',
    'type' => 'read',
    'name' => 'Find Annotations Tags.',
    'description' => 'Find all the event tags created in the annotations.',
    'operation_id' => 'getAnnotationTags',
    'method' => 'GET',
    'path' => '/annotations/tags',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'tag',
        'in' => 'query',
        'required' => false,
        'description' => 'Tag is a string that you can use to filter tags.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Max limit for results returned.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_annotation_by_i_d' =>
  array (
    'slug' => 'grafana_delete_annotation_by_i_d',
    'class' => 'GrafanaDeleteAnnotationByID',
    'type' => 'write',
    'name' => 'Delete Annotation By ID.',
    'description' => 'Deletes the annotation that matches the specified ID.',
    'operation_id' => 'deleteAnnotationByID',
    'method' => 'DELETE',
    'path' => '/annotations/{annotation_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'annotation_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_annotation_by_i_d' =>
  array (
    'slug' => 'grafana_get_annotation_by_i_d',
    'class' => 'GrafanaGetAnnotationByID',
    'type' => 'read',
    'name' => 'Get Annotation by ID.',
    'description' => 'Get Annotation by ID. (GET /annotations/{annotation_id}).',
    'operation_id' => 'getAnnotationByID',
    'method' => 'GET',
    'path' => '/annotations/{annotation_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'annotation_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_patch_annotation' =>
  array (
    'slug' => 'grafana_patch_annotation',
    'class' => 'GrafanaPatchAnnotation',
    'type' => 'write',
    'name' => 'Patch Annotation.',
    'description' => 'Updates one or more properties of an annotation that matches the specified ID. This operation currently supports updating of the `text`, `tags`, `time` and `timeEnd` properties. This is available in Grafana 6.0.0-beta2 and above.',
    'operation_id' => 'patchAnnotation',
    'method' => 'PATCH',
    'path' => '/annotations/{annotation_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'annotation_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_annotation' =>
  array (
    'slug' => 'grafana_update_annotation',
    'class' => 'GrafanaUpdateAnnotation',
    'type' => 'write',
    'name' => 'Update Annotation.',
    'description' => 'Updates all properties of an annotation that matches the specified id. To only update certain property, consider using the Patch Annotation operation.',
    'operation_id' => 'updateAnnotation',
    'method' => 'PUT',
    'path' => '/annotations/{annotation_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'annotation_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_devices' =>
  array (
    'slug' => 'grafana_list_devices',
    'class' => 'GrafanaListDevices',
    'type' => 'read',
    'name' => 'Lists all devices within the last 30 days',
    'description' => 'Lists all devices within the last 30 days (GET /anonymous/devices).',
    'operation_id' => 'listDevices',
    'method' => 'GET',
    'path' => '/anonymous/devices',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_search_devices' =>
  array (
    'slug' => 'grafana_search_devices',
    'class' => 'GrafanaSearchDevices',
    'type' => 'read',
    'name' => 'Lists all devices within the last 30 days',
    'description' => 'Lists all devices within the last 30 days (GET /anonymous/search).',
    'operation_id' => 'SearchDevices',
    'method' => 'GET',
    'path' => '/anonymous/search',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_session_list' =>
  array (
    'slug' => 'grafana_get_session_list',
    'class' => 'GrafanaGetSessionList',
    'type' => 'read',
    'name' => 'Get a list of all cloud migration sessions that have been created.',
    'description' => 'Get a list of all cloud migration sessions that have been created. (GET /cloudmigration/migration).',
    'operation_id' => 'getSessionList',
    'method' => 'GET',
    'path' => '/cloudmigration/migration',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_session' =>
  array (
    'slug' => 'grafana_create_session',
    'class' => 'GrafanaCreateSession',
    'type' => 'write',
    'name' => 'Create a migration session.',
    'description' => 'Create a migration session. (POST /cloudmigration/migration).',
    'operation_id' => 'createSession',
    'method' => 'POST',
    'path' => '/cloudmigration/migration',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_session' =>
  array (
    'slug' => 'grafana_delete_session',
    'class' => 'GrafanaDeleteSession',
    'type' => 'write',
    'name' => 'Delete a migration session by its uid.',
    'description' => 'Delete a migration session by its uid. (DELETE /cloudmigration/migration/{uid}).',
    'operation_id' => 'deleteSession',
    'method' => 'DELETE',
    'path' => '/cloudmigration/migration/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a migration session',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_session' =>
  array (
    'slug' => 'grafana_get_session',
    'class' => 'GrafanaGetSession',
    'type' => 'read',
    'name' => 'Get a cloud migration session by its uid.',
    'description' => 'Get a cloud migration session by its uid. (GET /cloudmigration/migration/{uid}).',
    'operation_id' => 'getSession',
    'method' => 'GET',
    'path' => '/cloudmigration/migration/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a migration session',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_snapshot' =>
  array (
    'slug' => 'grafana_create_snapshot',
    'class' => 'GrafanaCreateSnapshot',
    'type' => 'write',
    'name' => 'Trigger the creation of an instance snapshot associated with the provided session.',
    'description' => 'If the snapshot initialization is successful, the snapshot uid is returned.',
    'operation_id' => 'createSnapshot',
    'method' => 'POST',
    'path' => '/cloudmigration/migration/{uid}/snapshot',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a session',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_snapshot' =>
  array (
    'slug' => 'grafana_get_snapshot',
    'class' => 'GrafanaGetSnapshot',
    'type' => 'read',
    'name' => 'Get metadata about a snapshot, including where it is in its processing and final results.',
    'description' => 'Get metadata about a snapshot, including where it is in its processing and final results. (GET /cloudmigration/migration/{uid}/snapshot/{snapshotUid}).',
    'operation_id' => 'getSnapshot',
    'method' => 'GET',
    'path' => '/cloudmigration/migration/{uid}/snapshot/{snapshotUid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resultPage',
        'in' => 'query',
        'required' => false,
        'description' => 'ResultPage is used for pagination with ResultLimit',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'resultLimit',
        'in' => 'query',
        'required' => false,
        'description' => 'Max limit for snapshot results returned.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'resultSortColumn',
        'in' => 'query',
        'required' => false,
        'description' => 'ResultSortColumn can be used to override the default system sort. Valid values are "name", "resource_type", and "status".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'resultSortOrder',
        'in' => 'query',
        'required' => false,
        'description' => 'ResultSortOrder is used with ResultSortColumn. Valid values are ASC and DESC.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'errorsOnly',
        'in' => 'query',
        'required' => false,
        'description' => 'ErrorsOnly is used to only return resources with error statuses',
        'schema_type' => 'boolean',
      ),
      5 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Session UID of a session',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'snapshotUid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a snapshot',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_cancel_snapshot' =>
  array (
    'slug' => 'grafana_cancel_snapshot',
    'class' => 'GrafanaCancelSnapshot',
    'type' => 'write',
    'name' => 'Cancel a snapshot, wherever it is in its processing chain.',
    'description' => 'TODO: Implement',
    'operation_id' => 'cancelSnapshot',
    'method' => 'POST',
    'path' => '/cloudmigration/migration/{uid}/snapshot/{snapshotUid}/cancel',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Session UID of a session',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'snapshotUid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a snapshot',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_upload_snapshot' =>
  array (
    'slug' => 'grafana_upload_snapshot',
    'class' => 'GrafanaUploadSnapshot',
    'type' => 'write',
    'name' => 'Upload a snapshot to the Grafana Migration Service for processing.',
    'description' => 'Upload a snapshot to the Grafana Migration Service for processing. (POST /cloudmigration/migration/{uid}/snapshot/{snapshotUid}/upload).',
    'operation_id' => 'uploadSnapshot',
    'method' => 'POST',
    'path' => '/cloudmigration/migration/{uid}/snapshot/{snapshotUid}/upload',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Session UID of a session',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'snapshotUid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a snapshot',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_shapshot_list' =>
  array (
    'slug' => 'grafana_get_shapshot_list',
    'class' => 'GrafanaGetShapshotList',
    'type' => 'read',
    'name' => 'Get a list of snapshots for a session.',
    'description' => 'Get a list of snapshots for a session. (GET /cloudmigration/migration/{uid}/snapshots).',
    'operation_id' => 'getShapshotList',
    'method' => 'GET',
    'path' => '/cloudmigration/migration/{uid}/snapshots',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page is used for pagination with limit',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Max limit for results returned.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Session UID of a session',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort with value latest to return results sorted in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_resource_dependencies' =>
  array (
    'slug' => 'grafana_get_resource_dependencies',
    'class' => 'GrafanaGetResourceDependencies',
    'type' => 'read',
    'name' => 'Get the resource dependencies graph for the current set of migratable resources.',
    'description' => 'Get the resource dependencies graph for the current set of migratable resources. (GET /cloudmigration/resources/dependencies).',
    'operation_id' => 'getResourceDependencies',
    'method' => 'GET',
    'path' => '/cloudmigration/resources/dependencies',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_cloud_migration_token' =>
  array (
    'slug' => 'grafana_get_cloud_migration_token',
    'class' => 'GrafanaGetCloudMigrationToken',
    'type' => 'read',
    'name' => 'Fetch the cloud migration token if it exists.',
    'description' => 'Fetch the cloud migration token if it exists. (GET /cloudmigration/token).',
    'operation_id' => 'getCloudMigrationToken',
    'method' => 'GET',
    'path' => '/cloudmigration/token',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_cloud_migration_token' =>
  array (
    'slug' => 'grafana_create_cloud_migration_token',
    'class' => 'GrafanaCreateCloudMigrationToken',
    'type' => 'write',
    'name' => 'Create gcom access token.',
    'description' => 'Create gcom access token. (POST /cloudmigration/token).',
    'operation_id' => 'createCloudMigrationToken',
    'method' => 'POST',
    'path' => '/cloudmigration/token',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_cloud_migration_token' =>
  array (
    'slug' => 'grafana_delete_cloud_migration_token',
    'class' => 'GrafanaDeleteCloudMigrationToken',
    'type' => 'write',
    'name' => 'Deletes a cloud migration token.',
    'description' => 'Deletes a cloud migration token. (DELETE /cloudmigration/token/{uid}).',
    'operation_id' => 'deleteCloudMigrationToken',
    'method' => 'DELETE',
    'path' => '/cloudmigration/token/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'UID of a cloud migration token',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_get_rules' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_get_rules',
    'class' => 'GrafanaRouteConvertPrometheusCortexGetRules',
    'type' => 'read',
    'name' => 'Gets all Grafana-managed alert rules that were imported from Prometheus-compatible sources, group...',
    'description' => 'Gets all Grafana-managed alert rules that were imported from Prometheus-compatible sources, group... (GET /convert/api/prom/rules).',
    'operation_id' => 'RouteConvertPrometheusCortexGetRules',
    'method' => 'GET',
    'path' => '/convert/api/prom/rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_post_rule_groups' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_post_rule_groups',
    'class' => 'GrafanaRouteConvertPrometheusCortexPostRuleGroups',
    'type' => 'write',
    'name' => 'Converts the submitted rule groups into Grafana-Managed Rules.',
    'description' => 'Converts the submitted rule groups into Grafana-Managed Rules. (POST /convert/api/prom/rules).',
    'operation_id' => 'RouteConvertPrometheusCortexPostRuleGroups',
    'method' => 'POST',
    'path' => '/convert/api/prom/rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_delete_namespace' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_delete_namespace',
    'class' => 'GrafanaRouteConvertPrometheusCortexDeleteNamespace',
    'type' => 'write',
    'name' => 'Deletes all rule groups that were imported from Prometheus-compatible sources within the specifie...',
    'description' => 'Deletes all rule groups that were imported from Prometheus-compatible sources within the specifie... (DELETE /convert/api/prom/rules/{NamespaceTitle}).',
    'operation_id' => 'RouteConvertPrometheusCortexDeleteNamespace',
    'method' => 'DELETE',
    'path' => '/convert/api/prom/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_get_namespace' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_get_namespace',
    'class' => 'GrafanaRouteConvertPrometheusCortexGetNamespace',
    'type' => 'read',
    'name' => 'Gets Grafana-managed alert rules that were imported from Prometheus-compatible sources for a spec...',
    'description' => 'Gets Grafana-managed alert rules that were imported from Prometheus-compatible sources for a spec... (GET /convert/api/prom/rules/{NamespaceTitle}).',
    'operation_id' => 'RouteConvertPrometheusCortexGetNamespace',
    'method' => 'GET',
    'path' => '/convert/api/prom/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_post_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_post_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusCortexPostRuleGroup',
    'type' => 'write',
    'name' => 'Converts a Prometheus rule group into a Grafana rule group and creates or updates it within the s...',
    'description' => 'If the group already exists and was not imported from a Prometheus-compatible source initially, it will not be replaced and an error will be returned.',
    'operation_id' => 'RouteConvertPrometheusCortexPostRuleGroup',
    'method' => 'POST',
    'path' => '/convert/api/prom/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'x-grafana-alerting-datasource-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'x-grafana-alerting-recording-rules-paused',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'x-grafana-alerting-alert-rules-paused',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      4 =>
      array (
        'name' => 'x-grafana-alerting-target-datasource-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'x-grafana-alerting-folder-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'x-grafana-alerting-notification-settings',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/yaml',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_convert_prometheus_cortex_delete_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_delete_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusCortexDeleteRuleGroup',
    'type' => 'write',
    'name' => 'Deletes a specific rule group if it was imported from a Prometheus-compatible source.',
    'description' => 'Deletes a specific rule group if it was imported from a Prometheus-compatible source. (DELETE /convert/api/prom/rules/{NamespaceTitle}/{Group}).',
    'operation_id' => 'RouteConvertPrometheusCortexDeleteRuleGroup',
    'method' => 'DELETE',
    'path' => '/convert/api/prom/rules/{NamespaceTitle}/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_cortex_get_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_cortex_get_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusCortexGetRuleGroup',
    'type' => 'read',
    'name' => 'Gets a single rule group in Prometheus-compatible format if it was imported from a Prometheus-com...',
    'description' => 'Gets a single rule group in Prometheus-compatible format if it was imported from a Prometheus-com... (GET /convert/api/prom/rules/{NamespaceTitle}/{Group}).',
    'operation_id' => 'RouteConvertPrometheusCortexGetRuleGroup',
    'method' => 'GET',
    'path' => '/convert/api/prom/rules/{NamespaceTitle}/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_get_rules' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_get_rules',
    'class' => 'GrafanaRouteConvertPrometheusGetRules',
    'type' => 'read',
    'name' => 'Gets all Grafana-managed alert rules that were imported from Prometheus-compatible sources, group...',
    'description' => 'Gets all Grafana-managed alert rules that were imported from Prometheus-compatible sources, group... (GET /convert/prometheus/config/v1/rules).',
    'operation_id' => 'RouteConvertPrometheusGetRules',
    'method' => 'GET',
    'path' => '/convert/prometheus/config/v1/rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_post_rule_groups' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_post_rule_groups',
    'class' => 'GrafanaRouteConvertPrometheusPostRuleGroups',
    'type' => 'write',
    'name' => 'Converts the submitted rule groups into Grafana-Managed Rules.',
    'description' => 'Converts the submitted rule groups into Grafana-Managed Rules. (POST /convert/prometheus/config/v1/rules).',
    'operation_id' => 'RouteConvertPrometheusPostRuleGroups',
    'method' => 'POST',
    'path' => '/convert/prometheus/config/v1/rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_delete_namespace' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_delete_namespace',
    'class' => 'GrafanaRouteConvertPrometheusDeleteNamespace',
    'type' => 'write',
    'name' => 'Deletes all rule groups that were imported from Prometheus-compatible sources within the specifie...',
    'description' => 'Deletes all rule groups that were imported from Prometheus-compatible sources within the specifie... (DELETE /convert/prometheus/config/v1/rules/{NamespaceTitle}).',
    'operation_id' => 'RouteConvertPrometheusDeleteNamespace',
    'method' => 'DELETE',
    'path' => '/convert/prometheus/config/v1/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_get_namespace' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_get_namespace',
    'class' => 'GrafanaRouteConvertPrometheusGetNamespace',
    'type' => 'read',
    'name' => 'Gets Grafana-managed alert rules that were imported from Prometheus-compatible sources for a spec...',
    'description' => 'Gets Grafana-managed alert rules that were imported from Prometheus-compatible sources for a spec... (GET /convert/prometheus/config/v1/rules/{NamespaceTitle}).',
    'operation_id' => 'RouteConvertPrometheusGetNamespace',
    'method' => 'GET',
    'path' => '/convert/prometheus/config/v1/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_post_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_post_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusPostRuleGroup',
    'type' => 'write',
    'name' => 'Converts a Prometheus rule group into a Grafana rule group and creates or updates it within the s...',
    'description' => 'If the group already exists and was not imported from a Prometheus-compatible source initially, it will not be replaced and an error will be returned.',
    'operation_id' => 'RouteConvertPrometheusPostRuleGroup',
    'method' => 'POST',
    'path' => '/convert/prometheus/config/v1/rules/{NamespaceTitle}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'x-grafana-alerting-datasource-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'x-grafana-alerting-recording-rules-paused',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'x-grafana-alerting-alert-rules-paused',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      4 =>
      array (
        'name' => 'x-grafana-alerting-target-datasource-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'x-grafana-alerting-folder-uid',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'x-grafana-alerting-notification-settings',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/yaml',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_convert_prometheus_delete_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_delete_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusDeleteRuleGroup',
    'type' => 'write',
    'name' => 'Deletes a specific rule group if it was imported from a Prometheus-compatible source.',
    'description' => 'Deletes a specific rule group if it was imported from a Prometheus-compatible source. (DELETE /convert/prometheus/config/v1/rules/{NamespaceTitle}/{Group}).',
    'operation_id' => 'RouteConvertPrometheusDeleteRuleGroup',
    'method' => 'DELETE',
    'path' => '/convert/prometheus/config/v1/rules/{NamespaceTitle}/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_convert_prometheus_get_rule_group' =>
  array (
    'slug' => 'grafana_route_convert_prometheus_get_rule_group',
    'class' => 'GrafanaRouteConvertPrometheusGetRuleGroup',
    'type' => 'read',
    'name' => 'Gets a single rule group in Prometheus-compatible format if it was imported from a Prometheus-com...',
    'description' => 'Gets a single rule group in Prometheus-compatible format if it was imported from a Prometheus-com... (GET /convert/prometheus/config/v1/rules/{NamespaceTitle}/{Group}).',
    'operation_id' => 'RouteConvertPrometheusGetRuleGroup',
    'method' => 'GET',
    'path' => '/convert/prometheus/config/v1/rules/{NamespaceTitle}/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'NamespaceTitle',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_search_dashboard_snapshots' =>
  array (
    'slug' => 'grafana_search_dashboard_snapshots',
    'class' => 'GrafanaSearchDashboardSnapshots',
    'type' => 'read',
    'name' => 'List snapshots.',
    'description' => 'List snapshots. (GET /dashboard/snapshots).',
    'operation_id' => 'searchDashboardSnapshots',
    'method' => 'GET',
    'path' => '/dashboard/snapshots',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'Search Query',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the number of returned results',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_dashboard' =>
  array (
    'slug' => 'grafana_create_dashboard',
    'class' => 'GrafanaCreateDashboard',
    'type' => 'write',
    'name' => 'Create / Update dashboard',
    'description' => 'Creates a new dashboard or updates an existing dashboard. Note: This endpoint is not intended for creating folders, use `POST /api/folders` for that. Use: /apis/dashboards.grafana.app/v1/namespaces/{ns}/dashboards',
    'operation_id' => 'postDashboard',
    'method' => 'POST',
    'path' => '/dashboards/db',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_home_dashboard' =>
  array (
    'slug' => 'grafana_get_home_dashboard',
    'class' => 'GrafanaGetHomeDashboard',
    'type' => 'read',
    'name' => 'getHomeDashboard',
    'description' => 'NOTE: the home dashboard is configured in preferences. This API will be removed in G13',
    'operation_id' => 'getHomeDashboard',
    'method' => 'GET',
    'path' => '/dashboards/home',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_import_dashboard' =>
  array (
    'slug' => 'grafana_import_dashboard',
    'class' => 'GrafanaImportDashboard',
    'type' => 'write',
    'name' => 'Import dashboard.',
    'description' => 'Import dashboard. (POST /dashboards/import).',
    'operation_id' => 'importDashboard',
    'method' => 'POST',
    'path' => '/dashboards/import',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_interpolate_dashboard' =>
  array (
    'slug' => 'grafana_interpolate_dashboard',
    'class' => 'GrafanaInterpolateDashboard',
    'type' => 'write',
    'name' => 'Interpolate dashboard. This is an experimental endpoint under dashboardLibrary or suggestedDashbo...',
    'description' => 'Interpolate dashboard. This is an experimental endpoint under dashboardLibrary or suggestedDashbo... (POST /dashboards/interpolate).',
    'operation_id' => 'interpolateDashboard',
    'method' => 'POST',
    'path' => '/dashboards/interpolate',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_list_public_dashboards' =>
  array (
    'slug' => 'grafana_list_public_dashboards',
    'class' => 'GrafanaListPublicDashboards',
    'type' => 'read',
    'name' => 'listPublicDashboards',
    'description' => 'Get list of public dashboards',
    'operation_id' => 'listPublicDashboards',
    'method' => 'GET',
    'path' => '/dashboards/public-dashboards',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_dashboard_tags' =>
  array (
    'slug' => 'grafana_get_dashboard_tags',
    'class' => 'GrafanaGetDashboardTags',
    'type' => 'read',
    'name' => 'Get all dashboards tags of an organization.',
    'description' => 'Get all dashboards tags of an organization. (GET /dashboards/tags).',
    'operation_id' => 'getDashboardTags',
    'method' => 'GET',
    'path' => '/dashboards/tags',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_public_dashboard' =>
  array (
    'slug' => 'grafana_get_public_dashboard',
    'class' => 'GrafanaGetPublicDashboard',
    'type' => 'read',
    'name' => 'getPublicDashboard',
    'description' => 'Get public dashboard by dashboardUid',
    'operation_id' => 'getPublicDashboard',
    'method' => 'GET',
    'path' => '/dashboards/uid/{dashboardUid}/public-dashboards',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboardUid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_public_dashboard' =>
  array (
    'slug' => 'grafana_create_public_dashboard',
    'class' => 'GrafanaCreatePublicDashboard',
    'type' => 'write',
    'name' => 'createPublicDashboard',
    'description' => 'Create public dashboard for a dashboard',
    'operation_id' => 'createPublicDashboard',
    'method' => 'POST',
    'path' => '/dashboards/uid/{dashboardUid}/public-dashboards',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboardUid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_public_dashboard' =>
  array (
    'slug' => 'grafana_delete_public_dashboard',
    'class' => 'GrafanaDeletePublicDashboard',
    'type' => 'write',
    'name' => 'deletePublicDashboard',
    'description' => 'Delete public dashboard for a dashboard',
    'operation_id' => 'deletePublicDashboard',
    'method' => 'DELETE',
    'path' => '/dashboards/uid/{dashboardUid}/public-dashboards/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboardUid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_public_dashboard' =>
  array (
    'slug' => 'grafana_update_public_dashboard',
    'class' => 'GrafanaUpdatePublicDashboard',
    'type' => 'write',
    'name' => 'updatePublicDashboard',
    'description' => 'Update public dashboard for a dashboard',
    'operation_id' => 'updatePublicDashboard',
    'method' => 'PATCH',
    'path' => '/dashboards/uid/{dashboardUid}/public-dashboards/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboardUid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_dashboard_by_u_i_d' =>
  array (
    'slug' => 'grafana_delete_dashboard_by_u_i_d',
    'class' => 'GrafanaDeleteDashboardByUID',
    'type' => 'write',
    'name' => 'Delete dashboard by uid.',
    'description' => 'Will delete the dashboard given the specified unique identifier (uid). Use: /apis/dashboards.grafana.app/v1/namespaces/{ns}/dashboards/{uid}',
    'operation_id' => 'deleteDashboardByUID',
    'method' => 'DELETE',
    'path' => '/dashboards/uid/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_dashboard' =>
  array (
    'slug' => 'grafana_get_dashboard',
    'class' => 'GrafanaGetDashboard',
    'type' => 'read',
    'name' => 'Get dashboard by uid.',
    'description' => 'Optional query parameter `apiVersion` selects the Kubernetes API version used to load the dashboard first (for example `v1beta1`). If that request fails, the default version is used instead. When omitted, only the default is used. Will return the dashboard given the dashboard unique identifier (uid). Use: /apis/dashboards.grafana.app/v1/namespaces/{ns}/dashboards/{uid}',
    'operation_id' => 'getDashboardByUID',
    'method' => 'GET',
    'path' => '/dashboards/uid/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_dashboard_permissions_list_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_dashboard_permissions_list_by_u_i_d',
    'class' => 'GrafanaGetDashboardPermissionsListByUID',
    'type' => 'read',
    'name' => 'Gets all existing permissions for the given dashboard.',
    'description' => 'Use: /apis/dashboards.grafana.app/v1/namespaces/{ns}/dashboards/{uid}/access',
    'operation_id' => 'getDashboardPermissionsListByUID',
    'method' => 'GET',
    'path' => '/dashboards/uid/{uid}/permissions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_dashboard_permissions_by_u_i_d' =>
  array (
    'slug' => 'grafana_update_dashboard_permissions_by_u_i_d',
    'class' => 'GrafanaUpdateDashboardPermissionsByUID',
    'type' => 'write',
    'name' => 'Updates permissions for a dashboard.',
    'description' => 'This operation will remove existing permissions if they\'re not included in the request.',
    'operation_id' => 'updateDashboardPermissionsByUID',
    'method' => 'POST',
    'path' => '/dashboards/uid/{uid}/permissions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_restore_dashboard_version_by_u_i_d' =>
  array (
    'slug' => 'grafana_restore_dashboard_version_by_u_i_d',
    'class' => 'GrafanaRestoreDashboardVersionByUID',
    'type' => 'write',
    'name' => 'Restore a dashboard to a given dashboard version using UID.',
    'description' => 'This API will be removed when /apis/dashboards.grafana.app/v1 is released. You can restore a dashboard by reading it from history, then creating it again.',
    'operation_id' => 'restoreDashboardVersionByUID',
    'method' => 'POST',
    'path' => '/dashboards/uid/{uid}/restore',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_dashboard_versions_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_dashboard_versions_by_u_i_d',
    'class' => 'GrafanaGetDashboardVersionsByUID',
    'type' => 'read',
    'name' => 'Gets all existing versions for the dashboard using UID.',
    'description' => 'Gets all existing versions for the dashboard using UID. (GET /dashboards/uid/{uid}/versions).',
    'operation_id' => 'getDashboardVersionsByUID',
    'method' => 'GET',
    'path' => '/dashboards/uid/{uid}/versions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of results to return',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'start',
        'in' => 'query',
        'required' => false,
        'description' => 'Version to start from when returning queries',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_dashboard_version_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_dashboard_version_by_u_i_d',
    'class' => 'GrafanaGetDashboardVersionByUID',
    'type' => 'read',
    'name' => 'Get a specific dashboard version using UID.',
    'description' => 'Get a specific dashboard version using UID. (GET /dashboards/uid/{uid}/versions/{DashboardVersionID}).',
    'operation_id' => 'getDashboardVersionByUID',
    'method' => 'GET',
    'path' => '/dashboards/uid/{uid}/versions/{DashboardVersionID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'DashboardVersionID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_list_datasources' =>
  array (
    'slug' => 'grafana_list_datasources',
    'class' => 'GrafanaListDatasources',
    'type' => 'read',
    'name' => 'Get all data sources.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:read` and scope: `datasources:*`.',
    'operation_id' => 'getDataSources',
    'method' => 'GET',
    'path' => '/datasources',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_add_data_source' =>
  array (
    'slug' => 'grafana_add_data_source',
    'class' => 'GrafanaAddDataSource',
    'type' => 'write',
    'name' => 'Create a data source.',
    'description' => 'By defining `password` and `basicAuthPassword` under secureJsonData property Grafana encrypts them securely as an encrypted blob in the database. The response then lists the encrypted fields under secureJsonFields. If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:create`',
    'operation_id' => 'addDataSource',
    'method' => 'POST',
    'path' => '/datasources',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_correlations' =>
  array (
    'slug' => 'grafana_get_correlations',
    'class' => 'GrafanaGetCorrelations',
    'type' => 'read',
    'name' => 'Gets all correlations.',
    'description' => 'Gets all correlations. (GET /datasources/correlations).',
    'operation_id' => 'getCorrelations',
    'method' => 'GET',
    'path' => '/datasources/correlations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the maximum number of correlations to return per page',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page index for starting fetching correlations',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'sourceUID',
        'in' => 'query',
        'required' => false,
        'description' => 'Source datasource UID filter to be applied to correlations',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_data_source_id_by_name' =>
  array (
    'slug' => 'grafana_get_data_source_id_by_name',
    'class' => 'GrafanaGetDataSourceIdByName',
    'type' => 'read',
    'name' => 'Get data source Id by Name. This function will be removed in the future.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:read` and scopes: `datasources:*`, `datasources:name:*` and `datasources:name:test_datasource` (single data source).',
    'operation_id' => 'getDataSourceIdByName',
    'method' => 'GET',
    'path' => '/datasources/id/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_data_source_by_name' =>
  array (
    'slug' => 'grafana_delete_data_source_by_name',
    'class' => 'GrafanaDeleteDataSourceByName',
    'type' => 'write',
    'name' => 'Delete an existing data source by name. This function will be removed in the future.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:delete` and scopes: `datasources:*`, `datasources:name:*` and `datasources:name:test_datasource` (single data source).',
    'operation_id' => 'deleteDataSourceByName',
    'method' => 'DELETE',
    'path' => '/datasources/name/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_data_source_by_name' =>
  array (
    'slug' => 'grafana_get_data_source_by_name',
    'class' => 'GrafanaGetDataSourceByName',
    'type' => 'read',
    'name' => 'Get a single data source by Name. This function will be removed in the future.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:read` and scopes: `datasources:*`, `datasources:name:*` and `datasources:name:test_datasource` (single data source).',
    'operation_id' => 'getDataSourceByName',
    'method' => 'GET',
    'path' => '/datasources/name/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_datasource_proxy_d_e_l_e_t_e_by_u_i_dcalls' =>
  array (
    'slug' => 'grafana_datasource_proxy_d_e_l_e_t_e_by_u_i_dcalls',
    'class' => 'GrafanaDatasourceProxyDELETEByUIDcalls',
    'type' => 'write',
    'name' => 'Data source proxy DELETE calls.',
    'description' => 'Proxies all calls to the actual data source.',
    'operation_id' => 'datasourceProxyDELETEByUIDcalls',
    'method' => 'DELETE',
    'path' => '/datasources/proxy/uid/{uid}/{datasource_proxy_route}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'datasource_proxy_route',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_datasource_proxy_g_e_t_by_u_i_dcalls' =>
  array (
    'slug' => 'grafana_datasource_proxy_g_e_t_by_u_i_dcalls',
    'class' => 'GrafanaDatasourceProxyGETByUIDcalls',
    'type' => 'read',
    'name' => 'Data source proxy GET calls.',
    'description' => 'Proxies all calls to the actual data source.',
    'operation_id' => 'datasourceProxyGETByUIDcalls',
    'method' => 'GET',
    'path' => '/datasources/proxy/uid/{uid}/{datasource_proxy_route}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'datasource_proxy_route',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_datasource_proxy_p_o_s_t_by_u_i_dcalls' =>
  array (
    'slug' => 'grafana_datasource_proxy_p_o_s_t_by_u_i_dcalls',
    'class' => 'GrafanaDatasourceProxyPOSTByUIDcalls',
    'type' => 'write',
    'name' => 'Data source proxy POST calls.',
    'description' => 'Proxies all calls to the actual data source. The data source should support POST methods for the specific path and role as defined',
    'operation_id' => 'datasourceProxyPOSTByUIDcalls',
    'method' => 'POST',
    'path' => '/datasources/proxy/uid/{uid}/{datasource_proxy_route}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'datasource_proxy_route',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_correlations_by_source_u_i_d' =>
  array (
    'slug' => 'grafana_get_correlations_by_source_u_i_d',
    'class' => 'GrafanaGetCorrelationsBySourceUID',
    'type' => 'read',
    'name' => 'Gets all correlations originating from the given data source.',
    'description' => 'Gets all correlations originating from the given data source. (GET /datasources/uid/{sourceUID}/correlations).',
    'operation_id' => 'getCorrelationsBySourceUID',
    'method' => 'GET',
    'path' => '/datasources/uid/{sourceUID}/correlations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_correlation' =>
  array (
    'slug' => 'grafana_create_correlation',
    'class' => 'GrafanaCreateCorrelation',
    'type' => 'write',
    'name' => 'Add correlation.',
    'description' => 'Add correlation. (POST /datasources/uid/{sourceUID}/correlations).',
    'operation_id' => 'createCorrelation',
    'method' => 'POST',
    'path' => '/datasources/uid/{sourceUID}/correlations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_correlation' =>
  array (
    'slug' => 'grafana_get_correlation',
    'class' => 'GrafanaGetCorrelation',
    'type' => 'read',
    'name' => 'Gets a correlation.',
    'description' => 'Gets a correlation. (GET /datasources/uid/{sourceUID}/correlations/{correlationUID}).',
    'operation_id' => 'getCorrelation',
    'method' => 'GET',
    'path' => '/datasources/uid/{sourceUID}/correlations/{correlationUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'correlationUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_correlation' =>
  array (
    'slug' => 'grafana_update_correlation',
    'class' => 'GrafanaUpdateCorrelation',
    'type' => 'write',
    'name' => 'Updates a correlation.',
    'description' => 'Updates a correlation. (PATCH /datasources/uid/{sourceUID}/correlations/{correlationUID}).',
    'operation_id' => 'updateCorrelation',
    'method' => 'PATCH',
    'path' => '/datasources/uid/{sourceUID}/correlations/{correlationUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'correlationUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_data_source_by_u_i_d' =>
  array (
    'slug' => 'grafana_delete_data_source_by_u_i_d',
    'class' => 'GrafanaDeleteDataSourceByUID',
    'type' => 'write',
    'name' => 'Delete an existing data source by UID.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:delete` and scopes: `datasources:*`, `datasources:uid:*` and `datasources:uid:kLtEtcRGk` (single data source).',
    'operation_id' => 'deleteDataSourceByUID',
    'method' => 'DELETE',
    'path' => '/datasources/uid/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_data_source_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_data_source_by_u_i_d',
    'class' => 'GrafanaGetDataSourceByUID',
    'type' => 'read',
    'name' => 'Get a single data source by UID.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:read` and scopes: `datasources:*`, `datasources:uid:*` and `datasources:uid:kLtEtcRGk` (single data source).',
    'operation_id' => 'getDataSourceByUID',
    'method' => 'GET',
    'path' => '/datasources/uid/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_data_source_by_u_i_d' =>
  array (
    'slug' => 'grafana_update_data_source_by_u_i_d',
    'class' => 'GrafanaUpdateDataSourceByUID',
    'type' => 'write',
    'name' => 'Update an existing data source.',
    'description' => 'Similar to creating a data source, `password` and `basicAuthPassword` should be defined under secureJsonData in order to be stored securely as an encrypted blob in the database. Then, the encrypted fields are listed under secureJsonFields section in the response. If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `dataso...',
    'operation_id' => 'updateDataSourceByUID',
    'method' => 'PUT',
    'path' => '/datasources/uid/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_correlation' =>
  array (
    'slug' => 'grafana_delete_correlation',
    'class' => 'GrafanaDeleteCorrelation',
    'type' => 'write',
    'name' => 'Delete a correlation.',
    'description' => 'Delete a correlation. (DELETE /datasources/uid/{uid}/correlations/{correlationUID}).',
    'operation_id' => 'deleteCorrelation',
    'method' => 'DELETE',
    'path' => '/datasources/uid/{uid}/correlations/{correlationUID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'correlationUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_check_datasource_health_with_u_i_d' =>
  array (
    'slug' => 'grafana_check_datasource_health_with_u_i_d',
    'class' => 'GrafanaCheckDatasourceHealthWithUID',
    'type' => 'read',
    'name' => 'Sends a health check request to the plugin datasource identified by the UID.',
    'description' => 'Sends a health check request to the plugin datasource identified by the UID. (GET /datasources/uid/{uid}/health).',
    'operation_id' => 'checkDatasourceHealthWithUID',
    'method' => 'GET',
    'path' => '/datasources/uid/{uid}/health',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_team_l_b_a_c_rules_api' =>
  array (
    'slug' => 'grafana_get_team_l_b_a_c_rules_api',
    'class' => 'GrafanaGetTeamLBACRulesApi',
    'type' => 'read',
    'name' => 'Retrieves LBAC rules for a team.',
    'description' => 'Retrieves LBAC rules for a team. (GET /datasources/uid/{uid}/lbac/teams).',
    'operation_id' => 'getTeamLBACRulesApi',
    'method' => 'GET',
    'path' => '/datasources/uid/{uid}/lbac/teams',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_team_l_b_a_c_rules_api' =>
  array (
    'slug' => 'grafana_update_team_l_b_a_c_rules_api',
    'class' => 'GrafanaUpdateTeamLBACRulesApi',
    'type' => 'write',
    'name' => 'Updates LBAC rules for a team.',
    'description' => 'Updates LBAC rules for a team. (PUT /datasources/uid/{uid}/lbac/teams).',
    'operation_id' => 'updateTeamLBACRulesApi',
    'method' => 'PUT',
    'path' => '/datasources/uid/{uid}/lbac/teams',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_call_datasource_resource_with_u_i_d' =>
  array (
    'slug' => 'grafana_call_datasource_resource_with_u_i_d',
    'class' => 'GrafanaCallDatasourceResourceWithUID',
    'type' => 'read',
    'name' => 'Fetch data source resources.',
    'description' => 'Fetch data source resources. (GET /datasources/uid/{uid}/resources/{datasource_proxy_route}).',
    'operation_id' => 'callDatasourceResourceWithUID',
    'method' => 'GET',
    'path' => '/datasources/uid/{uid}/resources/{datasource_proxy_route}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'datasource_proxy_route',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_data_source_cache_config' =>
  array (
    'slug' => 'grafana_get_data_source_cache_config',
    'class' => 'GrafanaGetDataSourceCacheConfig',
    'type' => 'read',
    'name' => 'getDataSourceCacheConfig',
    'description' => 'get cache config for a single data source',
    'operation_id' => 'getDataSourceCacheConfig',
    'method' => 'GET',
    'path' => '/datasources/{dataSourceUID}/cache',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dataSourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'dataSourceType',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_set_data_source_cache_config' =>
  array (
    'slug' => 'grafana_set_data_source_cache_config',
    'class' => 'GrafanaSetDataSourceCacheConfig',
    'type' => 'write',
    'name' => 'setDataSourceCacheConfig',
    'description' => 'set cache config for a single data source',
    'operation_id' => 'setDataSourceCacheConfig',
    'method' => 'POST',
    'path' => '/datasources/{dataSourceUID}/cache',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dataSourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'dataSourceType',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_clean_data_source_cache' =>
  array (
    'slug' => 'grafana_clean_data_source_cache',
    'class' => 'GrafanaCleanDataSourceCache',
    'type' => 'write',
    'name' => 'cleanDataSourceCache',
    'description' => 'clean cache for a single data source',
    'operation_id' => 'cleanDataSourceCache',
    'method' => 'POST',
    'path' => '/datasources/{dataSourceUID}/cache/clean',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dataSourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_disable_data_source_cache' =>
  array (
    'slug' => 'grafana_disable_data_source_cache',
    'class' => 'GrafanaDisableDataSourceCache',
    'type' => 'write',
    'name' => 'disableDataSourceCache',
    'description' => 'disable cache for a single data source',
    'operation_id' => 'disableDataSourceCache',
    'method' => 'POST',
    'path' => '/datasources/{dataSourceUID}/cache/disable',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dataSourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'dataSourceType',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_enable_data_source_cache' =>
  array (
    'slug' => 'grafana_enable_data_source_cache',
    'class' => 'GrafanaEnableDataSourceCache',
    'type' => 'write',
    'name' => 'enableDataSourceCache',
    'description' => 'enable cache for a single data source',
    'operation_id' => 'enableDataSourceCache',
    'method' => 'POST',
    'path' => '/datasources/{dataSourceUID}/cache/enable',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dataSourceUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'dataSourceType',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_query_metrics_with_expressions' =>
  array (
    'slug' => 'grafana_query_metrics_with_expressions',
    'class' => 'GrafanaQueryMetricsWithExpressions',
    'type' => 'write',
    'name' => 'DataSource query metrics with expressions.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `datasources:query`.',
    'operation_id' => 'queryMetricsWithExpressions',
    'method' => 'POST',
    'path' => '/ds/query',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_folders' =>
  array (
    'slug' => 'grafana_get_folders',
    'class' => 'GrafanaGetFolders',
    'type' => 'read',
    'name' => 'Get all folders.',
    'description' => 'It returns all folders that the authenticated user has permission to view. If nested folders are enabled, it expects an additional query parameter with the parent folder UID and returns the immediate subfolders that the authenticated user has permission to view. If the parameter is not supplied then it returns immediate subfolders under the root that the authenticated user has permission to vie...',
    'operation_id' => 'getFolders',
    'method' => 'GET',
    'path' => '/folders',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the maximum number of folders to return',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page index for starting fetching folders',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'parentUid',
        'in' => 'query',
        'required' => false,
        'description' => 'The parent folder UID',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'permission',
        'in' => 'query',
        'required' => false,
        'description' => 'Set to `Edit` to return folders that the user can edit',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_folder' =>
  array (
    'slug' => 'grafana_create_folder',
    'class' => 'GrafanaCreateFolder',
    'type' => 'write',
    'name' => 'Create folder.',
    'description' => 'If nested folders are enabled then it additionally expects the parent folder UID. Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}',
    'operation_id' => 'createFolder',
    'method' => 'POST',
    'path' => '/folders',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_folder' =>
  array (
    'slug' => 'grafana_delete_folder',
    'class' => 'GrafanaDeleteFolder',
    'type' => 'write',
    'name' => 'Delete folder.',
    'description' => 'Deletes an existing folder identified by UID along with all dashboards (and their alerts) stored in the folder. This operation cannot be reverted. If nested folders are enabled then it also deletes all the subfolders. Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}',
    'operation_id' => 'deleteFolder',
    'method' => 'DELETE',
    'path' => '/folders/{folder_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'forceDeleteRules',
        'in' => 'query',
        'required' => false,
        'description' => 'If `true` any Grafana 8 Alerts under this folder will be deleted. Set to `false` so that the request will fail if the folder contains any Grafana 8 Alerts.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_folder_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_folder_by_u_i_d',
    'class' => 'GrafanaGetFolderByUID',
    'type' => 'read',
    'name' => 'Get folder by uid.',
    'description' => 'Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}',
    'operation_id' => 'getFolderByUID',
    'method' => 'GET',
    'path' => '/folders/{folder_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_folder' =>
  array (
    'slug' => 'grafana_update_folder',
    'class' => 'GrafanaUpdateFolder',
    'type' => 'write',
    'name' => 'Update folder.',
    'description' => 'Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}',
    'operation_id' => 'updateFolder',
    'method' => 'PUT',
    'path' => '/folders/{folder_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'To change the unique identifier (uid), provide another one. To overwrite an existing folder with newer version, set `overwrite` to `true`. Provide the current version to safelly update the folder: if the provided version differs from the stored one the request will fail, unless `overwrite` is `true`.',
    ),
  ),
  'grafana_get_folder_descendant_counts' =>
  array (
    'slug' => 'grafana_get_folder_descendant_counts',
    'class' => 'GrafanaGetFolderDescendantCounts',
    'type' => 'read',
    'name' => 'Gets the count of each descendant of a folder by kind. The folder is identified by UID.',
    'description' => 'Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}',
    'operation_id' => 'getFolderDescendantCounts',
    'method' => 'GET',
    'path' => '/folders/{folder_uid}/counts',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_move_folder' =>
  array (
    'slug' => 'grafana_move_folder',
    'class' => 'GrafanaMoveFolder',
    'type' => 'write',
    'name' => 'Move folder.',
    'description' => 'Use: /apis/folder.grafana.app/v1/namespaces/{ns}/folders/{folder_uid}, Changing the parent folder annotation',
    'operation_id' => 'moveFolder',
    'method' => 'POST',
    'path' => '/folders/{folder_uid}/move',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_folder_permission_list' =>
  array (
    'slug' => 'grafana_get_folder_permission_list',
    'class' => 'GrafanaGetFolderPermissionList',
    'type' => 'read',
    'name' => 'Gets all existing permissions for the folder with the given `uid`.',
    'description' => 'Gets all existing permissions for the folder with the given `uid`. (GET /folders/{folder_uid}/permissions).',
    'operation_id' => 'getFolderPermissionList',
    'method' => 'GET',
    'path' => '/folders/{folder_uid}/permissions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_folder_permissions' =>
  array (
    'slug' => 'grafana_update_folder_permissions',
    'class' => 'GrafanaUpdateFolderPermissions',
    'type' => 'write',
    'name' => 'Updates permissions for a folder. This operation will remove existing permissions if they\'re not...',
    'description' => 'Updates permissions for a folder. This operation will remove existing permissions if they\'re not... (POST /folders/{folder_uid}/permissions).',
    'operation_id' => 'updateFolderPermissions',
    'method' => 'POST',
    'path' => '/folders/{folder_uid}/permissions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_mapped_groups' =>
  array (
    'slug' => 'grafana_get_mapped_groups',
    'class' => 'GrafanaGetMappedGroups',
    'type' => 'read',
    'name' => 'List groups that have mappings set. This endpoint is behind the feature flag `groupAttributeSync`...',
    'description' => 'List groups that have mappings set. This endpoint is behind the feature flag `groupAttributeSync`... (GET /groupsync/groups).',
    'operation_id' => 'getMappedGroups',
    'method' => 'GET',
    'path' => '/groupsync/groups',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_group_mappings' =>
  array (
    'slug' => 'grafana_delete_group_mappings',
    'class' => 'GrafanaDeleteGroupMappings',
    'type' => 'write',
    'name' => 'Delete mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is...',
    'description' => 'Delete mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is... (DELETE /groupsync/groups/{group_id}).',
    'operation_id' => 'deleteGroupMappings',
    'method' => 'DELETE',
    'path' => '/groupsync/groups/{group_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'group_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_group_mappings' =>
  array (
    'slug' => 'grafana_create_group_mappings',
    'class' => 'GrafanaCreateGroupMappings',
    'type' => 'write',
    'name' => 'Create mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is...',
    'description' => 'Create mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is... (POST /groupsync/groups/{group_id}).',
    'operation_id' => 'createGroupMappings',
    'method' => 'POST',
    'path' => '/groupsync/groups/{group_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'group_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_group_mappings' =>
  array (
    'slug' => 'grafana_update_group_mappings',
    'class' => 'GrafanaUpdateGroupMappings',
    'type' => 'write',
    'name' => 'Update mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is...',
    'description' => 'Update mappings for a group. This endpoint is behind the feature flag `groupAttributeSync` and is... (PUT /groupsync/groups/{group_id}).',
    'operation_id' => 'updateGroupMappings',
    'method' => 'PUT',
    'path' => '/groupsync/groups/{group_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'group_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_group_roles' =>
  array (
    'slug' => 'grafana_get_group_roles',
    'class' => 'GrafanaGetGroupRoles',
    'type' => 'read',
    'name' => 'Get roles mapped to a group. This endpoint is behind the feature flag `groupAttributeSync` and is...',
    'description' => 'Get roles mapped to a group. This endpoint is behind the feature flag `groupAttributeSync` and is... (GET /groupsync/groups/{group_id}/roles).',
    'operation_id' => 'getGroupRoles',
    'method' => 'GET',
    'path' => '/groupsync/groups/{group_id}/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'group_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_health' =>
  array (
    'slug' => 'grafana_get_health',
    'class' => 'GrafanaGetHealth',
    'type' => 'read',
    'name' => 'getHealth',
    'description' => 'apiHealthHandler will return ok if Grafana\'s web server is running and it can access the database. If the database cannot be accessed it will return http status code 503.',
    'operation_id' => 'getHealth',
    'method' => 'GET',
    'path' => '/health',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_library_elements' =>
  array (
    'slug' => 'grafana_get_library_elements',
    'class' => 'GrafanaGetLibraryElements',
    'type' => 'read',
    'name' => 'Get all library elements.',
    'description' => 'Returns a list of all library elements the authenticated user has permission to view. Use the `perPage` query parameter to control the maximum number of library elements returned; the default limit is `100`. You can also use the `page` query parameter to fetch library elements from any page other than the first one.',
    'operation_id' => 'getLibraryElements',
    'method' => 'GET',
    'path' => '/library-elements',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'searchString',
        'in' => 'query',
        'required' => false,
        'description' => 'Part of the name or description searched for.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'description' => 'Kind of element to search for.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'sortDirection',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort order of elements.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'typeFilter',
        'in' => 'query',
        'required' => false,
        'description' => 'A comma separated list of types to filter the elements by',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'excludeUid',
        'in' => 'query',
        'required' => false,
        'description' => 'Element UID to exclude from search results.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'folderFilter',
        'in' => 'query',
        'required' => false,
        'description' => 'A comma separated list of folder ID(s) to filter the elements by. Deprecated: Use FolderFilterUIDs instead.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'folderFilterUIDs',
        'in' => 'query',
        'required' => false,
        'description' => 'A comma separated list of folder UID(s) to filter the elements by.',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'perPage',
        'in' => 'query',
        'required' => false,
        'description' => 'The number of results per page.',
        'schema_type' => 'integer',
      ),
      8 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'The page for a set of records, given that only perPage records are returned at a time. Numbering starts at 1.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_library_element' =>
  array (
    'slug' => 'grafana_create_library_element',
    'class' => 'GrafanaCreateLibraryElement',
    'type' => 'write',
    'name' => 'Create library element.',
    'description' => 'Creates a new library element.',
    'operation_id' => 'createLibraryElement',
    'method' => 'POST',
    'path' => '/library-elements',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_library_element_by_name' =>
  array (
    'slug' => 'grafana_get_library_element_by_name',
    'class' => 'GrafanaGetLibraryElementByName',
    'type' => 'read',
    'name' => 'Get library element by name.',
    'description' => 'Returns a library element with the given name.',
    'operation_id' => 'getLibraryElementByName',
    'method' => 'GET',
    'path' => '/library-elements/name/{library_element_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'library_element_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_library_element_by_u_i_d' =>
  array (
    'slug' => 'grafana_delete_library_element_by_u_i_d',
    'class' => 'GrafanaDeleteLibraryElementByUID',
    'type' => 'write',
    'name' => 'Delete library element.',
    'description' => 'Deletes an existing library element as specified by the UID. This operation cannot be reverted. You cannot delete a library element that is connected. This operation cannot be reverted.',
    'operation_id' => 'deleteLibraryElementByUID',
    'method' => 'DELETE',
    'path' => '/library-elements/{library_element_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'library_element_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_library_element_by_u_i_d' =>
  array (
    'slug' => 'grafana_get_library_element_by_u_i_d',
    'class' => 'GrafanaGetLibraryElementByUID',
    'type' => 'read',
    'name' => 'Get library element by UID.',
    'description' => 'Returns a library element with the given UID.',
    'operation_id' => 'getLibraryElementByUID',
    'method' => 'GET',
    'path' => '/library-elements/{library_element_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'library_element_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_library_element' =>
  array (
    'slug' => 'grafana_update_library_element',
    'class' => 'GrafanaUpdateLibraryElement',
    'type' => 'write',
    'name' => 'Update library element.',
    'description' => 'Updates an existing library element identified by uid.',
    'operation_id' => 'updateLibraryElement',
    'method' => 'PATCH',
    'path' => '/library-elements/{library_element_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'library_element_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_library_element_connections' =>
  array (
    'slug' => 'grafana_get_library_element_connections',
    'class' => 'GrafanaGetLibraryElementConnections',
    'type' => 'read',
    'name' => 'Get library element connections.',
    'description' => 'Returns a list of connections for a library element based on the UID specified.',
    'operation_id' => 'getLibraryElementConnections',
    'method' => 'GET',
    'path' => '/library-elements/{library_element_uid}/connections/',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'library_element_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_status' =>
  array (
    'slug' => 'grafana_get_status',
    'class' => 'GrafanaGetStatus',
    'type' => 'read',
    'name' => 'Check license availability.',
    'description' => 'Check license availability. (GET /licensing/check).',
    'operation_id' => 'getStatus',
    'method' => 'GET',
    'path' => '/licensing/check',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_custom_permissions_report' =>
  array (
    'slug' => 'grafana_get_custom_permissions_report',
    'class' => 'GrafanaGetCustomPermissionsReport',
    'type' => 'read',
    'name' => 'Get custom permissions report.',
    'description' => 'You need to have a permission with action `licensing.reports:read`.',
    'operation_id' => 'getCustomPermissionsReport',
    'method' => 'GET',
    'path' => '/licensing/custom-permissions',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_custom_permissions_c_s_v' =>
  array (
    'slug' => 'grafana_get_custom_permissions_c_s_v',
    'class' => 'GrafanaGetCustomPermissionsCSV',
    'type' => 'read',
    'name' => 'Get custom permissions report in CSV format.',
    'description' => 'You need to have a permission with action `licensing.reports:read`.',
    'operation_id' => 'getCustomPermissionsCSV',
    'method' => 'GET',
    'path' => '/licensing/custom-permissions-csv',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_refresh_license_stats' =>
  array (
    'slug' => 'grafana_refresh_license_stats',
    'class' => 'GrafanaRefreshLicenseStats',
    'type' => 'read',
    'name' => 'Refresh license stats.',
    'description' => 'You need to have a permission with action `licensing:read`.',
    'operation_id' => 'refreshLicenseStats',
    'method' => 'GET',
    'path' => '/licensing/refresh-stats',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_license_token' =>
  array (
    'slug' => 'grafana_delete_license_token',
    'class' => 'GrafanaDeleteLicenseToken',
    'type' => 'write',
    'name' => 'Remove license from database.',
    'description' => 'Removes the license stored in the Grafana database. Available in Grafana Enterprise v7.4+. You need to have a permission with action `licensing:delete`.',
    'operation_id' => 'deleteLicenseToken',
    'method' => 'DELETE',
    'path' => '/licensing/token',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_license_token' =>
  array (
    'slug' => 'grafana_get_license_token',
    'class' => 'GrafanaGetLicenseToken',
    'type' => 'read',
    'name' => 'Get license token.',
    'description' => 'You need to have a permission with action `licensing:read`.',
    'operation_id' => 'getLicenseToken',
    'method' => 'GET',
    'path' => '/licensing/token',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_post_license_token' =>
  array (
    'slug' => 'grafana_post_license_token',
    'class' => 'GrafanaPostLicenseToken',
    'type' => 'write',
    'name' => 'Create license token.',
    'description' => 'You need to have a permission with action `licensing:write`.',
    'operation_id' => 'postLicenseToken',
    'method' => 'POST',
    'path' => '/licensing/token',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_post_renew_license_token' =>
  array (
    'slug' => 'grafana_post_renew_license_token',
    'class' => 'GrafanaPostRenewLicenseToken',
    'type' => 'write',
    'name' => 'Manually force license refresh.',
    'description' => 'Manually ask license issuer for a new token. Available in Grafana Enterprise v7.4+. You need to have a permission with action `licensing:write`.',
    'operation_id' => 'postRenewLicenseToken',
    'method' => 'POST',
    'path' => '/licensing/token/renew',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_s_a_m_l_logout' =>
  array (
    'slug' => 'grafana_get_s_a_m_l_logout',
    'class' => 'GrafanaGetSAMLLogout',
    'type' => 'read',
    'name' => 'GetLogout initiates single logout process.',
    'description' => 'GetLogout initiates single logout process. (GET /logout/saml).',
    'operation_id' => 'getSAMLLogout',
    'method' => 'GET',
    'path' => '/logout/saml',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_current_org' =>
  array (
    'slug' => 'grafana_get_current_org',
    'class' => 'GrafanaGetCurrentOrg',
    'type' => 'read',
    'name' => 'Get current Organization.',
    'description' => 'Get current Organization. (GET /org).',
    'operation_id' => 'getCurrentOrg',
    'method' => 'GET',
    'path' => '/org',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_update_current_org' =>
  array (
    'slug' => 'grafana_update_current_org',
    'class' => 'GrafanaUpdateCurrentOrg',
    'type' => 'write',
    'name' => 'Update current Organization.',
    'description' => 'Update current Organization. (PUT /org).',
    'operation_id' => 'updateCurrentOrg',
    'method' => 'PUT',
    'path' => '/org',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_current_org_address' =>
  array (
    'slug' => 'grafana_update_current_org_address',
    'class' => 'GrafanaUpdateCurrentOrgAddress',
    'type' => 'write',
    'name' => 'Update current Organization\'s address.',
    'description' => 'Update current Organization\'s address. (PUT /org/address).',
    'operation_id' => 'updateCurrentOrgAddress',
    'method' => 'PUT',
    'path' => '/org/address',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_pending_org_invites' =>
  array (
    'slug' => 'grafana_get_pending_org_invites',
    'class' => 'GrafanaGetPendingOrgInvites',
    'type' => 'read',
    'name' => 'Get pending invites.',
    'description' => 'Get pending invites. (GET /org/invites).',
    'operation_id' => 'getPendingOrgInvites',
    'method' => 'GET',
    'path' => '/org/invites',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_add_org_invite' =>
  array (
    'slug' => 'grafana_add_org_invite',
    'class' => 'GrafanaAddOrgInvite',
    'type' => 'write',
    'name' => 'Add invite.',
    'description' => 'Add invite. (POST /org/invites).',
    'operation_id' => 'addOrgInvite',
    'method' => 'POST',
    'path' => '/org/invites',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_revoke_invite' =>
  array (
    'slug' => 'grafana_revoke_invite',
    'class' => 'GrafanaRevokeInvite',
    'type' => 'write',
    'name' => 'Revoke invite.',
    'description' => 'Revoke invite. (DELETE /org/invites/{invitation_code}/revoke).',
    'operation_id' => 'revokeInvite',
    'method' => 'DELETE',
    'path' => '/org/invites/{invitation_code}/revoke',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'invitation_code',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_org_preferences' =>
  array (
    'slug' => 'grafana_get_org_preferences',
    'class' => 'GrafanaGetOrgPreferences',
    'type' => 'read',
    'name' => 'Get Current Org Prefs.',
    'description' => 'Get Current Org Prefs. (GET /org/preferences).',
    'operation_id' => 'getOrgPreferences',
    'method' => 'GET',
    'path' => '/org/preferences',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_patch_org_preferences' =>
  array (
    'slug' => 'grafana_patch_org_preferences',
    'class' => 'GrafanaPatchOrgPreferences',
    'type' => 'write',
    'name' => 'Patch Current Org Prefs.',
    'description' => 'Patch Current Org Prefs. (PATCH /org/preferences).',
    'operation_id' => 'patchOrgPreferences',
    'method' => 'PATCH',
    'path' => '/org/preferences',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_org_preferences' =>
  array (
    'slug' => 'grafana_update_org_preferences',
    'class' => 'GrafanaUpdateOrgPreferences',
    'type' => 'write',
    'name' => 'Update Current Org Prefs.',
    'description' => 'Update Current Org Prefs. (PUT /org/preferences).',
    'operation_id' => 'updateOrgPreferences',
    'method' => 'PUT',
    'path' => '/org/preferences',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_current_org_quota' =>
  array (
    'slug' => 'grafana_get_current_org_quota',
    'class' => 'GrafanaGetCurrentOrgQuota',
    'type' => 'read',
    'name' => 'Fetch Organization quota.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `orgs.quotas:read` and scope `org:id:1` (orgIDScope).',
    'operation_id' => 'getCurrentOrgQuota',
    'method' => 'GET',
    'path' => '/org/quotas',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_org_users_for_current_org' =>
  array (
    'slug' => 'grafana_get_org_users_for_current_org',
    'class' => 'GrafanaGetOrgUsersForCurrentOrg',
    'type' => 'read',
    'name' => 'Get all users within the current organization.',
    'description' => 'Returns all org users within the current organization. Accessible to users with org admin role. If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:read` with scope `users:*`.',
    'operation_id' => 'getOrgUsersForCurrentOrg',
    'method' => 'GET',
    'path' => '/org/users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_org_user_to_current_org' =>
  array (
    'slug' => 'grafana_add_org_user_to_current_org',
    'class' => 'GrafanaAddOrgUserToCurrentOrg',
    'type' => 'write',
    'name' => 'Add a new user to the current organization.',
    'description' => 'Adds a global user to the current organization. If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:add` with scope `users:*`.',
    'operation_id' => 'addOrgUserToCurrentOrg',
    'method' => 'POST',
    'path' => '/org/users',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_org_users_for_current_org_lookup' =>
  array (
    'slug' => 'grafana_get_org_users_for_current_org_lookup',
    'class' => 'GrafanaGetOrgUsersForCurrentOrgLookup',
    'type' => 'read',
    'name' => 'Get all users within the current organization (lookup)',
    'description' => 'Returns all org users within the current organization, but with less detailed information. Accessible to users with org admin role, admin in any folder or admin of any team. Mainly used by Grafana UI for providing list of users when adding team members and when editing folder/dashboard permissions.',
    'operation_id' => 'getOrgUsersForCurrentOrgLookup',
    'method' => 'GET',
    'path' => '/org/users/lookup',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_remove_org_user_for_current_org' =>
  array (
    'slug' => 'grafana_remove_org_user_for_current_org',
    'class' => 'GrafanaRemoveOrgUserForCurrentOrg',
    'type' => 'write',
    'name' => 'Delete user in current organization.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:remove` with scope `users:*`.',
    'operation_id' => 'removeOrgUserForCurrentOrg',
    'method' => 'DELETE',
    'path' => '/org/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_org_user_for_current_org' =>
  array (
    'slug' => 'grafana_update_org_user_for_current_org',
    'class' => 'GrafanaUpdateOrgUserForCurrentOrg',
    'type' => 'write',
    'name' => 'Updates the given user.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users.role:update` with scope `users:*`.',
    'operation_id' => 'updateOrgUserForCurrentOrg',
    'method' => 'PATCH',
    'path' => '/org/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_search_orgs' =>
  array (
    'slug' => 'grafana_search_orgs',
    'class' => 'GrafanaSearchOrgs',
    'type' => 'read',
    'name' => 'Search all Organizations.',
    'description' => 'Search all Organizations. (GET /orgs).',
    'operation_id' => 'searchOrgs',
    'method' => 'GET',
    'path' => '/orgs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'perpage',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items per page The totalCount field in the response can be used for pagination list E.g. if totalCount is equal to 100 teams and the perpage parameter is set to 10 then there are 10 pages of teams.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'If set it will return results where the query value is contained in the name field. Query values with spaces need to be URL encoded.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_org' =>
  array (
    'slug' => 'grafana_create_org',
    'class' => 'GrafanaCreateOrg',
    'type' => 'write',
    'name' => 'Create Organization.',
    'description' => 'Only works if [users.allow_org_create](https://grafana.com/docs/grafana/latest/administration/configuration/#allow_org_create) is set.',
    'operation_id' => 'createOrg',
    'method' => 'POST',
    'path' => '/orgs',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_org_by_name' =>
  array (
    'slug' => 'grafana_get_org_by_name',
    'class' => 'GrafanaGetOrgByName',
    'type' => 'read',
    'name' => 'Get Organization by Name.',
    'description' => 'Get Organization by Name. (GET /orgs/name/{org_name}).',
    'operation_id' => 'getOrgByName',
    'method' => 'GET',
    'path' => '/orgs/name/{org_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_org_by_i_d' =>
  array (
    'slug' => 'grafana_delete_org_by_i_d',
    'class' => 'GrafanaDeleteOrgByID',
    'type' => 'write',
    'name' => 'Delete Organization.',
    'description' => 'Delete Organization. (DELETE /orgs/{org_id}).',
    'operation_id' => 'deleteOrgByID',
    'method' => 'DELETE',
    'path' => '/orgs/{org_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_org_by_i_d' =>
  array (
    'slug' => 'grafana_get_org_by_i_d',
    'class' => 'GrafanaGetOrgByID',
    'type' => 'read',
    'name' => 'Get Organization by ID.',
    'description' => 'Get Organization by ID. (GET /orgs/{org_id}).',
    'operation_id' => 'getOrgByID',
    'method' => 'GET',
    'path' => '/orgs/{org_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_org' =>
  array (
    'slug' => 'grafana_update_org',
    'class' => 'GrafanaUpdateOrg',
    'type' => 'write',
    'name' => 'Update Organization.',
    'description' => 'Update Organization. (PUT /orgs/{org_id}).',
    'operation_id' => 'updateOrg',
    'method' => 'PUT',
    'path' => '/orgs/{org_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_org_address' =>
  array (
    'slug' => 'grafana_update_org_address',
    'class' => 'GrafanaUpdateOrgAddress',
    'type' => 'write',
    'name' => 'Update Organization\'s address.',
    'description' => 'Update Organization\'s address. (PUT /orgs/{org_id}/address).',
    'operation_id' => 'updateOrgAddress',
    'method' => 'PUT',
    'path' => '/orgs/{org_id}/address',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_org_quota' =>
  array (
    'slug' => 'grafana_get_org_quota',
    'class' => 'GrafanaGetOrgQuota',
    'type' => 'read',
    'name' => 'Fetch Organization quota.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `orgs.quotas:read` and scope `org:id:1` (orgIDScope).',
    'operation_id' => 'getOrgQuota',
    'method' => 'GET',
    'path' => '/orgs/{org_id}/quotas',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_org_quota' =>
  array (
    'slug' => 'grafana_update_org_quota',
    'class' => 'GrafanaUpdateOrgQuota',
    'type' => 'write',
    'name' => 'Update user quota.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled, you need to have a permission with action `orgs.quotas:write` and scope `org:id:1` (orgIDScope).',
    'operation_id' => 'updateOrgQuota',
    'method' => 'PUT',
    'path' => '/orgs/{org_id}/quotas/{quota_target}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'quota_target',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_org_users' =>
  array (
    'slug' => 'grafana_get_org_users',
    'class' => 'GrafanaGetOrgUsers',
    'type' => 'read',
    'name' => 'Get Users in Organization.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:read` with scope `users:*`.',
    'operation_id' => 'getOrgUsers',
    'method' => 'GET',
    'path' => '/orgs/{org_id}/users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_org_user' =>
  array (
    'slug' => 'grafana_add_org_user',
    'class' => 'GrafanaAddOrgUser',
    'type' => 'write',
    'name' => 'Add a new user to the current organization.',
    'description' => 'Adds a global user to the current organization. If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:add` with scope `users:*`.',
    'operation_id' => 'addOrgUser',
    'method' => 'POST',
    'path' => '/orgs/{org_id}/users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_search_org_users' =>
  array (
    'slug' => 'grafana_search_org_users',
    'class' => 'GrafanaSearchOrgUsers',
    'type' => 'read',
    'name' => 'Search Users in Organization.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:read` with scope `users:*`.',
    'operation_id' => 'searchOrgUsers',
    'method' => 'GET',
    'path' => '/orgs/{org_id}/users/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_remove_org_user' =>
  array (
    'slug' => 'grafana_remove_org_user',
    'class' => 'GrafanaRemoveOrgUser',
    'type' => 'write',
    'name' => 'Delete user in current organization.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users:remove` with scope `users:*`.',
    'operation_id' => 'removeOrgUser',
    'method' => 'DELETE',
    'path' => '/orgs/{org_id}/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_org_user' =>
  array (
    'slug' => 'grafana_update_org_user',
    'class' => 'GrafanaUpdateOrgUser',
    'type' => 'write',
    'name' => 'Update Users in Organization.',
    'description' => 'If you are running Grafana Enterprise and have Fine-grained access control enabled you need to have a permission with action: `org.users.role:update` with scope `users:*`.',
    'operation_id' => 'updateOrgUser',
    'method' => 'PATCH',
    'path' => '/orgs/{org_id}/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_search_playlists' =>
  array (
    'slug' => 'grafana_search_playlists',
    'class' => 'GrafanaSearchPlaylists',
    'type' => 'read',
    'name' => 'Get playlists.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1).',
    'operation_id' => 'searchPlaylists',
    'method' => 'GET',
    'path' => '/playlists',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'in:limit',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_playlist' =>
  array (
    'slug' => 'grafana_create_playlist',
    'class' => 'GrafanaCreatePlaylist',
    'type' => 'write',
    'name' => 'Create playlist.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1).',
    'operation_id' => 'createPlaylist',
    'method' => 'POST',
    'path' => '/playlists',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_playlist' =>
  array (
    'slug' => 'grafana_delete_playlist',
    'class' => 'GrafanaDeletePlaylist',
    'type' => 'write',
    'name' => 'Delete playlist.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1).',
    'operation_id' => 'deletePlaylist',
    'method' => 'DELETE',
    'path' => '/playlists/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_playlist' =>
  array (
    'slug' => 'grafana_get_playlist',
    'class' => 'GrafanaGetPlaylist',
    'type' => 'read',
    'name' => 'Get playlist.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1).',
    'operation_id' => 'getPlaylist',
    'method' => 'GET',
    'path' => '/playlists/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_playlist' =>
  array (
    'slug' => 'grafana_update_playlist',
    'class' => 'GrafanaUpdatePlaylist',
    'type' => 'write',
    'name' => 'Update playlist.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1).',
    'operation_id' => 'updatePlaylist',
    'method' => 'PUT',
    'path' => '/playlists/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_playlist_items' =>
  array (
    'slug' => 'grafana_get_playlist_items',
    'class' => 'GrafanaGetPlaylistItems',
    'type' => 'read',
    'name' => 'Get playlist items.',
    'description' => 'Please refer to [new API](?api=playlist.grafana.app-v1) instead (items are included in the playlist spec).',
    'operation_id' => 'getPlaylistItems',
    'method' => 'GET',
    'path' => '/playlists/{uid}/items',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_view_public_dashboard' =>
  array (
    'slug' => 'grafana_view_public_dashboard',
    'class' => 'GrafanaViewPublicDashboard',
    'type' => 'read',
    'name' => 'viewPublicDashboard',
    'description' => 'Get public dashboard for view',
    'operation_id' => 'viewPublicDashboard',
    'method' => 'GET',
    'path' => '/public/dashboards/{accessToken}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'accessToken',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_public_annotations' =>
  array (
    'slug' => 'grafana_get_public_annotations',
    'class' => 'GrafanaGetPublicAnnotations',
    'type' => 'read',
    'name' => 'getPublicAnnotations',
    'description' => 'Get annotations for a public dashboard',
    'operation_id' => 'getPublicAnnotations',
    'method' => 'GET',
    'path' => '/public/dashboards/{accessToken}/annotations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'accessToken',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_query_public_dashboard' =>
  array (
    'slug' => 'grafana_query_public_dashboard',
    'class' => 'GrafanaQueryPublicDashboard',
    'type' => 'write',
    'name' => 'queryPublicDashboard',
    'description' => 'Get results for a given panel on a public dashboard',
    'operation_id' => 'queryPublicDashboard',
    'method' => 'POST',
    'path' => '/public/dashboards/{accessToken}/panels/{panelId}/query',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'accessToken',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'panelId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_search_queries' =>
  array (
    'slug' => 'grafana_search_queries',
    'class' => 'GrafanaSearchQueries',
    'type' => 'read',
    'name' => 'Query history search.',
    'description' => 'Returns a list of queries in the query history that matches the search criteria. Query history search supports pagination. Use the `limit` parameter to control the maximum number of queries returned; the default limit is 100. You can also use the `page` query parameter to fetch queries from any page other than the first one.',
    'operation_id' => 'searchQueries',
    'method' => 'GET',
    'path' => '/query-history',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'datasourceUid',
        'in' => 'query',
        'required' => false,
        'description' => 'List of data source UIDs to search for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'searchString',
        'in' => 'query',
        'required' => false,
        'description' => 'Text inside query or comments that is searched for',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'onlyStarred',
        'in' => 'query',
        'required' => false,
        'description' => 'Flag indicating if only starred queries should be returned',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort method',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Use this parameter to access hits beyond limit. Numbering starts at 1. limit param acts as page size.',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the number of returned results',
        'schema_type' => 'integer',
      ),
      6 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => false,
        'description' => 'From range for the query history search',
        'schema_type' => 'integer',
      ),
      7 =>
      array (
        'name' => 'to',
        'in' => 'query',
        'required' => false,
        'description' => 'To range for the query history search',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_query' =>
  array (
    'slug' => 'grafana_create_query',
    'class' => 'GrafanaCreateQuery',
    'type' => 'write',
    'name' => 'Add query to query history.',
    'description' => 'Adds new query to query history.',
    'operation_id' => 'createQuery',
    'method' => 'POST',
    'path' => '/query-history',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_unstar_query' =>
  array (
    'slug' => 'grafana_unstar_query',
    'class' => 'GrafanaUnstarQuery',
    'type' => 'write',
    'name' => 'Remove star to query in query history.',
    'description' => 'Removes star from query in query history as specified by the UID.',
    'operation_id' => 'unstarQuery',
    'method' => 'DELETE',
    'path' => '/query-history/star/{query_history_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query_history_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_star_query' =>
  array (
    'slug' => 'grafana_star_query',
    'class' => 'GrafanaStarQuery',
    'type' => 'write',
    'name' => 'Add star to query in query history.',
    'description' => 'Adds star to query in query history as specified by the UID.',
    'operation_id' => 'starQuery',
    'method' => 'POST',
    'path' => '/query-history/star/{query_history_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query_history_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_query' =>
  array (
    'slug' => 'grafana_delete_query',
    'class' => 'GrafanaDeleteQuery',
    'type' => 'write',
    'name' => 'Delete query in query history.',
    'description' => 'Deletes an existing query in query history as specified by the UID. This operation cannot be reverted.',
    'operation_id' => 'deleteQuery',
    'method' => 'DELETE',
    'path' => '/query-history/{query_history_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query_history_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_patch_query_comment' =>
  array (
    'slug' => 'grafana_patch_query_comment',
    'class' => 'GrafanaPatchQueryComment',
    'type' => 'write',
    'name' => 'Update comment for query in query history.',
    'description' => 'Updates comment for query in query history as specified by the UID.',
    'operation_id' => 'patchQueryComment',
    'method' => 'PATCH',
    'path' => '/query-history/{query_history_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query_history_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_recording_rules' =>
  array (
    'slug' => 'grafana_list_recording_rules',
    'class' => 'GrafanaListRecordingRules',
    'type' => 'read',
    'name' => 'Lists all rules in the database: active or deleted.',
    'description' => 'Lists all rules in the database: active or deleted. (GET /recording-rules).',
    'operation_id' => 'listRecordingRules',
    'method' => 'GET',
    'path' => '/recording-rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_recording_rule' =>
  array (
    'slug' => 'grafana_create_recording_rule',
    'class' => 'GrafanaCreateRecordingRule',
    'type' => 'write',
    'name' => 'Create a recording rule that is then registered and started.',
    'description' => 'Create a recording rule that is then registered and started. (POST /recording-rules).',
    'operation_id' => 'createRecordingRule',
    'method' => 'POST',
    'path' => '/recording-rules',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_recording_rule' =>
  array (
    'slug' => 'grafana_update_recording_rule',
    'class' => 'GrafanaUpdateRecordingRule',
    'type' => 'write',
    'name' => 'Update the active status of a rule.',
    'description' => 'Update the active status of a rule. (PUT /recording-rules).',
    'operation_id' => 'updateRecordingRule',
    'method' => 'PUT',
    'path' => '/recording-rules',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_test_create_recording_rule' =>
  array (
    'slug' => 'grafana_test_create_recording_rule',
    'class' => 'GrafanaTestCreateRecordingRule',
    'type' => 'write',
    'name' => 'Test a recording rule.',
    'description' => 'Test a recording rule. (POST /recording-rules/test).',
    'operation_id' => 'testCreateRecordingRule',
    'method' => 'POST',
    'path' => '/recording-rules/test',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_recording_rule_write_target' =>
  array (
    'slug' => 'grafana_delete_recording_rule_write_target',
    'class' => 'GrafanaDeleteRecordingRuleWriteTarget',
    'type' => 'write',
    'name' => 'Delete the remote write target.',
    'description' => 'Delete the remote write target. (DELETE /recording-rules/writer).',
    'operation_id' => 'deleteRecordingRuleWriteTarget',
    'method' => 'DELETE',
    'path' => '/recording-rules/writer',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_recording_rule_write_target' =>
  array (
    'slug' => 'grafana_get_recording_rule_write_target',
    'class' => 'GrafanaGetRecordingRuleWriteTarget',
    'type' => 'read',
    'name' => 'Return the prometheus remote write target.',
    'description' => 'Return the prometheus remote write target. (GET /recording-rules/writer).',
    'operation_id' => 'getRecordingRuleWriteTarget',
    'method' => 'GET',
    'path' => '/recording-rules/writer',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_recording_rule_write_target' =>
  array (
    'slug' => 'grafana_create_recording_rule_write_target',
    'class' => 'GrafanaCreateRecordingRuleWriteTarget',
    'type' => 'write',
    'name' => 'Create a remote write target.',
    'description' => 'It returns a 422 if there is not an existing prometheus data source configured.',
    'operation_id' => 'createRecordingRuleWriteTarget',
    'method' => 'POST',
    'path' => '/recording-rules/writer',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_recording_rule' =>
  array (
    'slug' => 'grafana_delete_recording_rule',
    'class' => 'GrafanaDeleteRecordingRule',
    'type' => 'write',
    'name' => 'Delete removes the rule from the registry and stops it.',
    'description' => 'Delete removes the rule from the registry and stops it. (DELETE /recording-rules/{recordingRuleID}).',
    'operation_id' => 'deleteRecordingRule',
    'method' => 'DELETE',
    'path' => '/recording-rules/{recordingRuleID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'recordingRuleID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_reports' =>
  array (
    'slug' => 'grafana_get_reports',
    'class' => 'GrafanaGetReports',
    'type' => 'read',
    'name' => 'List reports.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports:read` with scope `reports:*`.',
    'operation_id' => 'getReports',
    'method' => 'GET',
    'path' => '/reports',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_report' =>
  array (
    'slug' => 'grafana_create_report',
    'class' => 'GrafanaCreateReport',
    'type' => 'write',
    'name' => 'Create a report.',
    'description' => 'Available to org admins only and with a valid license. You need to have a permission with action `reports.admin:create`.',
    'operation_id' => 'createReport',
    'method' => 'POST',
    'path' => '/reports',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_reports_by_dashboard_u_i_d' =>
  array (
    'slug' => 'grafana_get_reports_by_dashboard_u_i_d',
    'class' => 'GrafanaGetReportsByDashboardUID',
    'type' => 'read',
    'name' => 'List reports by dashboard uid.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports:read` with scope `reports:*`.',
    'operation_id' => 'getReportsByDashboardUID',
    'method' => 'GET',
    'path' => '/reports/dashboards/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_send_report' =>
  array (
    'slug' => 'grafana_send_report',
    'class' => 'GrafanaSendReport',
    'type' => 'write',
    'name' => 'Send a report.',
    'description' => 'Generate and send a report. This API waits for the report to be generated before returning. We recommend that you set the client\'s timeout to at least 60 seconds. Available to org admins only and with a valid license. Only available in Grafana Enterprise v7.0+. This API endpoint is experimental and may be deprecated in a future release. On deprecation, a migration strategy will be provided and...',
    'operation_id' => 'sendReport',
    'method' => 'POST',
    'path' => '/reports/email',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_settings_image' =>
  array (
    'slug' => 'grafana_get_settings_image',
    'class' => 'GrafanaGetSettingsImage',
    'type' => 'read',
    'name' => 'Get custom branding report image.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports.settings:read`.',
    'operation_id' => 'getSettingsImage',
    'method' => 'GET',
    'path' => '/reports/images/:image',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_render_report_c_s_vs' =>
  array (
    'slug' => 'grafana_render_report_c_s_vs',
    'class' => 'GrafanaRenderReportCSVs',
    'type' => 'read',
    'name' => 'Download a CSV report.',
    'description' => 'Available to all users and with a valid license.',
    'operation_id' => 'renderReportCSVs',
    'method' => 'GET',
    'path' => '/reports/render/csvs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboards',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'title',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_render_report_p_d_fs' =>
  array (
    'slug' => 'grafana_render_report_p_d_fs',
    'class' => 'GrafanaRenderReportPDFs',
    'type' => 'read',
    'name' => 'Render report for multiple dashboards.',
    'description' => 'Available to all users and with a valid license.',
    'operation_id' => 'renderReportPDFs',
    'method' => 'GET',
    'path' => '/reports/render/pdfs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboards',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'orientation',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'layout',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'title',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'scaleFactor',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'includeTables',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_report_settings' =>
  array (
    'slug' => 'grafana_get_report_settings',
    'class' => 'GrafanaGetReportSettings',
    'type' => 'read',
    'name' => 'Get report settings.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports.settings:read`x.',
    'operation_id' => 'getReportSettings',
    'method' => 'GET',
    'path' => '/reports/settings',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_save_report_settings' =>
  array (
    'slug' => 'grafana_save_report_settings',
    'class' => 'GrafanaSaveReportSettings',
    'type' => 'write',
    'name' => 'Save settings.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports.settings:write`xx.',
    'operation_id' => 'saveReportSettings',
    'method' => 'POST',
    'path' => '/reports/settings',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_send_test_email' =>
  array (
    'slug' => 'grafana_send_test_email',
    'class' => 'GrafanaSendTestEmail',
    'type' => 'write',
    'name' => 'Send test report via email.',
    'description' => 'Available to org admins only and with a valid license. You need to have a permission with action `reports:send`.',
    'operation_id' => 'sendTestEmail',
    'method' => 'POST',
    'path' => '/reports/test-email',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_report' =>
  array (
    'slug' => 'grafana_delete_report',
    'class' => 'GrafanaDeleteReport',
    'type' => 'write',
    'name' => 'Delete a report.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports.delete` with scope `reports:id:<report ID>`. Requesting reports using the internal id will stop workgin in the future Use the reporting apiserver to manage reports. See: /apis/reporting.grafana.app/',
    'operation_id' => 'deleteReport',
    'method' => 'DELETE',
    'path' => '/reports/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_report' =>
  array (
    'slug' => 'grafana_get_report',
    'class' => 'GrafanaGetReport',
    'type' => 'read',
    'name' => 'Get a report.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports:read` with scope `reports:id:<report ID>`. Requesting reports using the internal id will stop workgin in the future Use the reporting apiserver to manage reports. See: /apis/reporting.grafana.app/',
    'operation_id' => 'getReport',
    'method' => 'GET',
    'path' => '/reports/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_report' =>
  array (
    'slug' => 'grafana_update_report',
    'class' => 'GrafanaUpdateReport',
    'type' => 'write',
    'name' => 'Update a report.',
    'description' => 'Available to org admins only and with a valid or expired license. You need to have a permission with action `reports.admin:write` with scope `reports:id:<report ID>`. Requesting reports using the internal id will stop workgin in the future Use the reporting apiserver to manage reports. See: /apis/reporting.grafana.app/',
    'operation_id' => 'updateReport',
    'method' => 'PUT',
    'path' => '/reports/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_post_a_c_s' =>
  array (
    'slug' => 'grafana_post_a_c_s',
    'class' => 'GrafanaPostACS',
    'type' => 'write',
    'name' => 'It performs Assertion Consumer Service (ACS).',
    'description' => 'It performs Assertion Consumer Service (ACS). (POST /saml/acs).',
    'operation_id' => 'postACS',
    'method' => 'POST',
    'path' => '/saml/acs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'RelayState',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_metadata' =>
  array (
    'slug' => 'grafana_get_metadata',
    'class' => 'GrafanaGetMetadata',
    'type' => 'read',
    'name' => 'It exposes the SP (Grafana\'s) metadata for the IdP\'s consumption.',
    'description' => 'It exposes the SP (Grafana\'s) metadata for the IdP\'s consumption. (GET /saml/metadata).',
    'operation_id' => 'getMetadata',
    'method' => 'GET',
    'path' => '/saml/metadata',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_s_l_o' =>
  array (
    'slug' => 'grafana_get_s_l_o',
    'class' => 'GrafanaGetSLO',
    'type' => 'read',
    'name' => 'It performs Single Logout (SLO) callback.',
    'description' => 'There might be two possible requests: 1. Logout response (callback) when Grafana initiates single logout and IdP returns response to logout request. 2. Logout request when another SP initiates single logout and IdP sends logout request to the Grafana, or in case of IdP-initiated logout.',
    'operation_id' => 'getSLO',
    'method' => 'GET',
    'path' => '/saml/slo',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_post_s_l_o' =>
  array (
    'slug' => 'grafana_post_s_l_o',
    'class' => 'GrafanaPostSLO',
    'type' => 'write',
    'name' => 'It performs Single Logout (SLO) callback.',
    'description' => 'There might be two possible requests: 1. Logout response (callback) when Grafana initiates single logout and IdP returns response to logout request. 2. Logout request when another SP initiates single logout and IdP sends logout request to the Grafana, or in case of IdP-initiated logout.',
    'operation_id' => 'postSLO',
    'method' => 'POST',
    'path' => '/saml/slo',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'SAMLRequest',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'SAMLResponse',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_list_dashboards' =>
  array (
    'slug' => 'grafana_list_dashboards',
    'class' => 'GrafanaListDashboards',
    'type' => 'read',
    'name' => 'search',
    'description' => 'search (GET /search).',
    'operation_id' => 'search',
    'method' => 'GET',
    'path' => '/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'Search Query',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'tag',
        'in' => 'query',
        'required' => false,
        'description' => 'List of tags to search for',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Type to search for, dash-folder or dash-db',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'dashboardIds',
        'in' => 'query',
        'required' => false,
        'description' => 'List of dashboard id\'s to search for This is deprecated: users should use the `dashboardUIDs` query parameter instead',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'dashboardUIDs',
        'in' => 'query',
        'required' => false,
        'description' => 'List of dashboard uid\'s to search for',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'folderIds',
        'in' => 'query',
        'required' => false,
        'description' => 'List of folder id\'s to search in for dashboards If it\'s `0` then it will query for the top level folders This is deprecated: users should use the `folderUIDs` query parameter instead',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'folderUIDs',
        'in' => 'query',
        'required' => false,
        'description' => 'List of folder UID\'s to search in for dashboards If it\'s an empty string then it will query for the top level folders',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'starred',
        'in' => 'query',
        'required' => false,
        'description' => 'Flag indicating if only starred Dashboards should be returned',
        'schema_type' => 'boolean',
      ),
      8 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the number of returned results (max 5000)',
        'schema_type' => 'integer',
      ),
      9 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Use this parameter to access hits beyond limit. Numbering starts at 1. limit param acts as page size. Only available in Grafana v6.2+.',
        'schema_type' => 'integer',
      ),
      10 =>
      array (
        'name' => 'permission',
        'in' => 'query',
        'required' => false,
        'description' => 'Set to `Edit` to return dashboards/folders that the user can edit',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort method; for listing all the possible sort methods use the search sorting endpoint.',
        'schema_type' => 'string',
      ),
      12 =>
      array (
        'name' => 'deleted',
        'in' => 'query',
        'required' => false,
        'description' => 'Flag indicating if only soft deleted Dashboards should be returned',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_list_sort_options' =>
  array (
    'slug' => 'grafana_list_sort_options',
    'class' => 'GrafanaListSortOptions',
    'type' => 'read',
    'name' => 'List search sorting options.',
    'description' => 'List search sorting options. (GET /search/sorting).',
    'operation_id' => 'listSortOptions',
    'method' => 'GET',
    'path' => '/search/sorting',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_service_account' =>
  array (
    'slug' => 'grafana_create_service_account',
    'class' => 'GrafanaCreateServiceAccount',
    'type' => 'write',
    'name' => 'Create service account',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:write` scope: `serviceaccounts:*` Requires basic authentication and that the authenticated user is a Grafana Admin.',
    'operation_id' => 'createServiceAccount',
    'method' => 'POST',
    'path' => '/serviceaccounts',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_search_org_service_accounts_with_paging' =>
  array (
    'slug' => 'grafana_search_org_service_accounts_with_paging',
    'class' => 'GrafanaSearchOrgServiceAccountsWithPaging',
    'type' => 'read',
    'name' => 'Search service accounts with paging',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:read` scope: `serviceaccounts:*`',
    'operation_id' => 'searchOrgServiceAccountsWithPaging',
    'method' => 'GET',
    'path' => '/serviceaccounts/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'Disabled',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'expiredTokens',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      2 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'It will return results where the query value is contained in one of the name. Query values with spaces need to be URL encoded.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'perpage',
        'in' => 'query',
        'required' => false,
        'description' => 'The default value is 1000.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'The default value is 1.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_service_account' =>
  array (
    'slug' => 'grafana_delete_service_account',
    'class' => 'GrafanaDeleteServiceAccount',
    'type' => 'write',
    'name' => 'Delete service account',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:delete` scope: `serviceaccounts:id:1` (single service account)',
    'operation_id' => 'deleteServiceAccount',
    'method' => 'DELETE',
    'path' => '/serviceaccounts/{serviceAccountId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_retrieve_service_account' =>
  array (
    'slug' => 'grafana_retrieve_service_account',
    'class' => 'GrafanaRetrieveServiceAccount',
    'type' => 'read',
    'name' => 'Get single serviceaccount by Id',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:read` scope: `serviceaccounts:id:1` (single service account)',
    'operation_id' => 'retrieveServiceAccount',
    'method' => 'GET',
    'path' => '/serviceaccounts/{serviceAccountId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_service_account' =>
  array (
    'slug' => 'grafana_update_service_account',
    'class' => 'GrafanaUpdateServiceAccount',
    'type' => 'write',
    'name' => 'Update service account',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:write` scope: `serviceaccounts:id:1` (single service account)',
    'operation_id' => 'updateServiceAccount',
    'method' => 'PATCH',
    'path' => '/serviceaccounts/{serviceAccountId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_tokens' =>
  array (
    'slug' => 'grafana_list_tokens',
    'class' => 'GrafanaListTokens',
    'type' => 'read',
    'name' => 'Get service account tokens',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:read` scope: `global:serviceaccounts:id:1` (single service account) Requires basic authentication and that the authenticated user is a Grafana Admin.',
    'operation_id' => 'listTokens',
    'method' => 'GET',
    'path' => '/serviceaccounts/{serviceAccountId}/tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_token' =>
  array (
    'slug' => 'grafana_create_token',
    'class' => 'GrafanaCreateToken',
    'type' => 'write',
    'name' => 'CreateNewToken adds a token to a service account',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:write` scope: `serviceaccounts:id:1` (single service account)',
    'operation_id' => 'createToken',
    'method' => 'POST',
    'path' => '/serviceaccounts/{serviceAccountId}/tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_token' =>
  array (
    'slug' => 'grafana_delete_token',
    'class' => 'GrafanaDeleteToken',
    'type' => 'write',
    'name' => 'DeleteToken deletes service account tokens',
    'description' => 'Required permissions (See note in the [introduction](https://grafana.com/docs/grafana/latest/developers/http_api/serviceaccount/#service-account-api) for an explanation): action: `serviceaccounts:write` scope: `serviceaccounts:id:1` (single service account) Requires basic authentication and that the authenticated user is a Grafana Admin.',
    'operation_id' => 'deleteToken',
    'method' => 'DELETE',
    'path' => '/serviceaccounts/{serviceAccountId}/tokens/{tokenId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'tokenId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'serviceAccountId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_retrieve_j_w_k_s' =>
  array (
    'slug' => 'grafana_retrieve_j_w_k_s',
    'class' => 'GrafanaRetrieveJWKS',
    'type' => 'read',
    'name' => 'Get JSON Web Key Set (JWKS) with all the keys that can be used to verify tokens (public keys)',
    'description' => 'Required permissions None',
    'operation_id' => 'retrieveJWKS',
    'method' => 'GET',
    'path' => '/signing-keys/keys',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_sharing_options' =>
  array (
    'slug' => 'grafana_get_sharing_options',
    'class' => 'GrafanaGetSharingOptions',
    'type' => 'read',
    'name' => 'Get snapshot sharing settings.',
    'description' => 'Get snapshot sharing settings. (GET /snapshot/shared-options).',
    'operation_id' => 'getSharingOptions',
    'method' => 'GET',
    'path' => '/snapshot/shared-options',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_create_dashboard_snapshot' =>
  array (
    'slug' => 'grafana_create_dashboard_snapshot',
    'class' => 'GrafanaCreateDashboardSnapshot',
    'type' => 'write',
    'name' => 'When creating a snapshot using the API, you have to provide the full dashboard payload including...',
    'description' => 'Snapshot public mode should be enabled or authentication is required.',
    'operation_id' => 'createDashboardSnapshot',
    'method' => 'POST',
    'path' => '/snapshots',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_delete_dashboard_snapshot_by_delete_key' =>
  array (
    'slug' => 'grafana_delete_dashboard_snapshot_by_delete_key',
    'class' => 'GrafanaDeleteDashboardSnapshotByDeleteKey',
    'type' => 'read',
    'name' => 'Delete Snapshot by deleteKey.',
    'description' => 'Snapshot public mode should be enabled or authentication is required.',
    'operation_id' => 'deleteDashboardSnapshotByDeleteKey',
    'method' => 'GET',
    'path' => '/snapshots-delete/{deleteKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deleteKey',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_dashboard_snapshot' =>
  array (
    'slug' => 'grafana_delete_dashboard_snapshot',
    'class' => 'GrafanaDeleteDashboardSnapshot',
    'type' => 'write',
    'name' => 'Delete Snapshot by Key.',
    'description' => 'Delete Snapshot by Key. (DELETE /snapshots/{key}).',
    'operation_id' => 'deleteDashboardSnapshot',
    'method' => 'DELETE',
    'path' => '/snapshots/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_dashboard_snapshot' =>
  array (
    'slug' => 'grafana_get_dashboard_snapshot',
    'class' => 'GrafanaGetDashboardSnapshot',
    'type' => 'read',
    'name' => 'Get Snapshot by Key.',
    'description' => 'Get Snapshot by Key. (GET /snapshots/{key}).',
    'operation_id' => 'getDashboardSnapshot',
    'method' => 'GET',
    'path' => '/snapshots/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_create_team' =>
  array (
    'slug' => 'grafana_create_team',
    'class' => 'GrafanaCreateTeam',
    'type' => 'write',
    'name' => 'Add Team.',
    'description' => 'Add Team. (POST /teams).',
    'operation_id' => 'createTeam',
    'method' => 'POST',
    'path' => '/teams',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_teams' =>
  array (
    'slug' => 'grafana_list_teams',
    'class' => 'GrafanaListTeams',
    'type' => 'read',
    'name' => 'Team Search With Paging.',
    'description' => 'Team Search With Paging. (GET /teams/search).',
    'operation_id' => 'searchTeams',
    'method' => 'GET',
    'path' => '/teams/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'perpage',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items per page The totalCount field in the response can be used for pagination list E.g. if totalCount is equal to 100 teams and the perpage parameter is set to 10 then there are 10 pages of teams.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'If set it will return results where the query value is contained in the name field. Query values with spaces need to be URL encoded.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'accesscontrol',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
      5 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_remove_team_group_api_query' =>
  array (
    'slug' => 'grafana_remove_team_group_api_query',
    'class' => 'GrafanaRemoveTeamGroupApiQuery',
    'type' => 'write',
    'name' => 'Remove External Group.',
    'description' => 'Remove External Group. (DELETE /teams/{teamId}/groups).',
    'operation_id' => 'removeTeamGroupApiQuery',
    'method' => 'DELETE',
    'path' => '/teams/{teamId}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'groupId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_team_groups_api' =>
  array (
    'slug' => 'grafana_get_team_groups_api',
    'class' => 'GrafanaGetTeamGroupsApi',
    'type' => 'read',
    'name' => 'Get External Groups.',
    'description' => 'Get External Groups. (GET /teams/{teamId}/groups).',
    'operation_id' => 'getTeamGroupsApi',
    'method' => 'GET',
    'path' => '/teams/{teamId}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_team_group_api' =>
  array (
    'slug' => 'grafana_add_team_group_api',
    'class' => 'GrafanaAddTeamGroupApi',
    'type' => 'write',
    'name' => 'Add External Group.',
    'description' => 'Add External Group. (POST /teams/{teamId}/groups).',
    'operation_id' => 'addTeamGroupApi',
    'method' => 'POST',
    'path' => '/teams/{teamId}/groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_search_team_groups' =>
  array (
    'slug' => 'grafana_search_team_groups',
    'class' => 'GrafanaSearchTeamGroups',
    'type' => 'read',
    'name' => 'Search for team groups with optional filtering and pagination.',
    'description' => 'Search for team groups with optional filtering and pagination. (GET /teams/{teamId}/groups/search).',
    'operation_id' => 'searchTeamGroups',
    'method' => 'GET',
    'path' => '/teams/{teamId}/groups/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'teamId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'perpage',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of items per page',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'query',
        'in' => 'query',
        'required' => false,
        'description' => 'If set it will return results where the query value is contained in the name field. Query values with spaces need to be URL encoded.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by exact name match',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_delete_team_by_i_d' =>
  array (
    'slug' => 'grafana_delete_team_by_i_d',
    'class' => 'GrafanaDeleteTeamByID',
    'type' => 'write',
    'name' => 'Delete Team By ID.',
    'description' => 'Delete Team By ID. (DELETE /teams/{team_id}).',
    'operation_id' => 'deleteTeamByID',
    'method' => 'DELETE',
    'path' => '/teams/{team_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_team_by_i_d' =>
  array (
    'slug' => 'grafana_get_team_by_i_d',
    'class' => 'GrafanaGetTeamByID',
    'type' => 'read',
    'name' => 'Get Team By ID.',
    'description' => 'Get Team By ID. (GET /teams/{team_id}).',
    'operation_id' => 'getTeamByID',
    'method' => 'GET',
    'path' => '/teams/{team_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'accesscontrol',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_team' =>
  array (
    'slug' => 'grafana_update_team',
    'class' => 'GrafanaUpdateTeam',
    'type' => 'write',
    'name' => 'Update Team.',
    'description' => 'Update Team. (PUT /teams/{team_id}).',
    'operation_id' => 'updateTeam',
    'method' => 'PUT',
    'path' => '/teams/{team_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_team_members' =>
  array (
    'slug' => 'grafana_get_team_members',
    'class' => 'GrafanaGetTeamMembers',
    'type' => 'read',
    'name' => 'Get Team Members.',
    'description' => 'Get Team Members. (GET /teams/{team_id}/members).',
    'operation_id' => 'getTeamMembers',
    'method' => 'GET',
    'path' => '/teams/{team_id}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_add_team_member' =>
  array (
    'slug' => 'grafana_add_team_member',
    'class' => 'GrafanaAddTeamMember',
    'type' => 'write',
    'name' => 'Add Team Member.',
    'description' => 'Add Team Member. (POST /teams/{team_id}/members).',
    'operation_id' => 'addTeamMember',
    'method' => 'POST',
    'path' => '/teams/{team_id}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_set_team_memberships' =>
  array (
    'slug' => 'grafana_set_team_memberships',
    'class' => 'GrafanaSetTeamMemberships',
    'type' => 'write',
    'name' => 'Set team memberships.',
    'description' => 'Takes user emails, and updates team members and admins to the provided lists of users. Any current team members and admins not in the provided lists will be removed.',
    'operation_id' => 'setTeamMemberships',
    'method' => 'PUT',
    'path' => '/teams/{team_id}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_remove_team_member' =>
  array (
    'slug' => 'grafana_remove_team_member',
    'class' => 'GrafanaRemoveTeamMember',
    'type' => 'write',
    'name' => 'Remove Member From Team.',
    'description' => 'Remove Member From Team. (DELETE /teams/{team_id}/members/{user_id}).',
    'operation_id' => 'removeTeamMember',
    'method' => 'DELETE',
    'path' => '/teams/{team_id}/members/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_team_member' =>
  array (
    'slug' => 'grafana_update_team_member',
    'class' => 'GrafanaUpdateTeamMember',
    'type' => 'write',
    'name' => 'Update Team Member.',
    'description' => 'Update Team Member. (PUT /teams/{team_id}/members/{user_id}).',
    'operation_id' => 'updateTeamMember',
    'method' => 'PUT',
    'path' => '/teams/{team_id}/members/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_team_preferences' =>
  array (
    'slug' => 'grafana_get_team_preferences',
    'class' => 'GrafanaGetTeamPreferences',
    'type' => 'read',
    'name' => 'Get Team Preferences.',
    'description' => 'Get Team Preferences. (GET /teams/{team_id}/preferences).',
    'operation_id' => 'getTeamPreferences',
    'method' => 'GET',
    'path' => '/teams/{team_id}/preferences',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_team_preferences' =>
  array (
    'slug' => 'grafana_update_team_preferences',
    'class' => 'GrafanaUpdateTeamPreferences',
    'type' => 'write',
    'name' => 'Update Team Preferences.',
    'description' => 'Update Team Preferences. (PUT /teams/{team_id}/preferences).',
    'operation_id' => 'updateTeamPreferences',
    'method' => 'PUT',
    'path' => '/teams/{team_id}/preferences',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'team_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_current_user' =>
  array (
    'slug' => 'grafana_get_current_user',
    'class' => 'GrafanaGetCurrentUser',
    'type' => 'read',
    'name' => 'getSignedInUser',
    'description' => 'Get (current authenticated user)',
    'operation_id' => 'getSignedInUser',
    'method' => 'GET',
    'path' => '/user',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_update_signed_in_user' =>
  array (
    'slug' => 'grafana_update_signed_in_user',
    'class' => 'GrafanaUpdateSignedInUser',
    'type' => 'write',
    'name' => 'Update signed in User.',
    'description' => 'Update signed in User. (PUT /user).',
    'operation_id' => 'updateSignedInUser',
    'method' => 'PUT',
    'path' => '/user',
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
      'description' => 'To change the email, name, login, theme, provide another one.',
    ),
  ),
  'grafana_get_user_auth_tokens' =>
  array (
    'slug' => 'grafana_get_user_auth_tokens',
    'class' => 'GrafanaGetUserAuthTokens',
    'type' => 'read',
    'name' => 'Auth tokens of the actual User.',
    'description' => 'Return a list of all auth tokens (devices) that the actual user currently have logged in from.',
    'operation_id' => 'getUserAuthTokens',
    'method' => 'GET',
    'path' => '/user/auth-tokens',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_update_user_email' =>
  array (
    'slug' => 'grafana_update_user_email',
    'class' => 'GrafanaUpdateUserEmail',
    'type' => 'read',
    'name' => 'Update user email.',
    'description' => 'Update the email of user given a verification code.',
    'operation_id' => 'updateUserEmail',
    'method' => 'GET',
    'path' => '/user/email/update',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_clear_help_flags' =>
  array (
    'slug' => 'grafana_clear_help_flags',
    'class' => 'GrafanaClearHelpFlags',
    'type' => 'read',
    'name' => 'Clear user help flag.',
    'description' => 'Clear user help flag. (GET /user/helpflags/clear).',
    'operation_id' => 'clearHelpFlags',
    'method' => 'GET',
    'path' => '/user/helpflags/clear',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_set_help_flag' =>
  array (
    'slug' => 'grafana_set_help_flag',
    'class' => 'GrafanaSetHelpFlag',
    'type' => 'write',
    'name' => 'Set user help flag.',
    'description' => 'Set user help flag. (PUT /user/helpflags/{flag_id}).',
    'operation_id' => 'setHelpFlag',
    'method' => 'PUT',
    'path' => '/user/helpflags/{flag_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'flag_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_signed_in_user_org_list' =>
  array (
    'slug' => 'grafana_get_signed_in_user_org_list',
    'class' => 'GrafanaGetSignedInUserOrgList',
    'type' => 'read',
    'name' => 'Organizations of the actual User.',
    'description' => 'Return a list of all organizations of the current user.',
    'operation_id' => 'getSignedInUserOrgList',
    'method' => 'GET',
    'path' => '/user/orgs',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_change_user_password' =>
  array (
    'slug' => 'grafana_change_user_password',
    'class' => 'GrafanaChangeUserPassword',
    'type' => 'write',
    'name' => 'Change Password.',
    'description' => 'Changes the password for the user.',
    'operation_id' => 'changeUserPassword',
    'method' => 'PUT',
    'path' => '/user/password',
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
      'description' => 'To change the email, name, login, theme, provide another one.',
    ),
  ),
  'grafana_get_user_preferences' =>
  array (
    'slug' => 'grafana_get_user_preferences',
    'class' => 'GrafanaGetUserPreferences',
    'type' => 'read',
    'name' => 'Get user preferences.',
    'description' => 'Get user preferences. (GET /user/preferences).',
    'operation_id' => 'getUserPreferences',
    'method' => 'GET',
    'path' => '/user/preferences',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_patch_user_preferences' =>
  array (
    'slug' => 'grafana_patch_user_preferences',
    'class' => 'GrafanaPatchUserPreferences',
    'type' => 'write',
    'name' => 'Patch user preferences.',
    'description' => 'Patch user preferences. (PATCH /user/preferences).',
    'operation_id' => 'patchUserPreferences',
    'method' => 'PATCH',
    'path' => '/user/preferences',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_user_preferences' =>
  array (
    'slug' => 'grafana_update_user_preferences',
    'class' => 'GrafanaUpdateUserPreferences',
    'type' => 'write',
    'name' => 'Update user preferences.',
    'description' => 'Omitting a key (`theme`, `homeDashboardUID`, `timezone`) will cause the current value to be replaced with the system default value.',
    'operation_id' => 'updateUserPreferences',
    'method' => 'PUT',
    'path' => '/user/preferences',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_get_user_quotas' =>
  array (
    'slug' => 'grafana_get_user_quotas',
    'class' => 'GrafanaGetUserQuotas',
    'type' => 'read',
    'name' => 'Fetch user quota.',
    'description' => 'Fetch user quota. (GET /user/quotas).',
    'operation_id' => 'getUserQuotas',
    'method' => 'GET',
    'path' => '/user/quotas',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_revoke_user_auth_token' =>
  array (
    'slug' => 'grafana_revoke_user_auth_token',
    'class' => 'GrafanaRevokeUserAuthToken',
    'type' => 'write',
    'name' => 'Revoke an auth token of the actual User.',
    'description' => 'Revokes the given auth token (device) for the actual user. User of issued auth token (device) will no longer be logged in and will be required to authenticate again upon next activity.',
    'operation_id' => 'revokeUserAuthToken',
    'method' => 'POST',
    'path' => '/user/revoke-auth-token',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_unstar_dashboard_by_u_i_d' =>
  array (
    'slug' => 'grafana_unstar_dashboard_by_u_i_d',
    'class' => 'GrafanaUnstarDashboardByUID',
    'type' => 'write',
    'name' => 'Unstar a dashboard.',
    'description' => 'Deletes the starring of the given Dashboard for the actual user.',
    'operation_id' => 'unstarDashboardByUID',
    'method' => 'DELETE',
    'path' => '/user/stars/dashboard/uid/{dashboard_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboard_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_star_dashboard_by_u_i_d' =>
  array (
    'slug' => 'grafana_star_dashboard_by_u_i_d',
    'class' => 'GrafanaStarDashboardByUID',
    'type' => 'write',
    'name' => 'Star a dashboard.',
    'description' => 'Stars the given Dashboard for the actual user.',
    'operation_id' => 'starDashboardByUID',
    'method' => 'POST',
    'path' => '/user/stars/dashboard/uid/{dashboard_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dashboard_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_signed_in_user_team_list' =>
  array (
    'slug' => 'grafana_get_signed_in_user_team_list',
    'class' => 'GrafanaGetSignedInUserTeamList',
    'type' => 'read',
    'name' => 'Teams that the actual User is member of.',
    'description' => 'Return a list of all teams that the current user is member of.',
    'operation_id' => 'getSignedInUserTeamList',
    'method' => 'GET',
    'path' => '/user/teams',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_user_set_using_org' =>
  array (
    'slug' => 'grafana_user_set_using_org',
    'class' => 'GrafanaUserSetUsingOrg',
    'type' => 'write',
    'name' => 'Switch user context for signed in user.',
    'description' => 'Switch user context to the given organization.',
    'operation_id' => 'userSetUsingOrg',
    'method' => 'POST',
    'path' => '/user/using/{org_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_search_users' =>
  array (
    'slug' => 'grafana_search_users',
    'class' => 'GrafanaSearchUsers',
    'type' => 'read',
    'name' => 'Get users.',
    'description' => 'Returns all users that the authenticated user has permission to view, admin permission required.',
    'operation_id' => 'searchUsers',
    'method' => 'GET',
    'path' => '/users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'perpage',
        'in' => 'query',
        'required' => false,
        'description' => 'Limit the maximum number of users to return per page',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page index for starting fetching users',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_user_by_login_or_email' =>
  array (
    'slug' => 'grafana_get_user_by_login_or_email',
    'class' => 'GrafanaGetUserByLoginOrEmail',
    'type' => 'read',
    'name' => 'Get user by login or email.',
    'description' => 'Get user by login or email. (GET /users/lookup).',
    'operation_id' => 'getUserByLoginOrEmail',
    'method' => 'GET',
    'path' => '/users/lookup',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'loginOrEmail',
        'in' => 'query',
        'required' => true,
        'description' => 'loginOrEmail of the user',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_search_users_with_paging' =>
  array (
    'slug' => 'grafana_search_users_with_paging',
    'class' => 'GrafanaSearchUsersWithPaging',
    'type' => 'read',
    'name' => 'Get users with paging.',
    'description' => 'Get users with paging. (GET /users/search).',
    'operation_id' => 'searchUsersWithPaging',
    'method' => 'GET',
    'path' => '/users/search',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_get_user_by_i_d' =>
  array (
    'slug' => 'grafana_get_user_by_i_d',
    'class' => 'GrafanaGetUserByID',
    'type' => 'read',
    'name' => 'Get user by id.',
    'description' => 'Get user by id. (GET /users/{user_id}).',
    'operation_id' => 'getUserByID',
    'method' => 'GET',
    'path' => '/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_update_user' =>
  array (
    'slug' => 'grafana_update_user',
    'class' => 'GrafanaUpdateUser',
    'type' => 'write',
    'name' => 'Update user.',
    'description' => 'Update the user identified by id.',
    'operation_id' => 'updateUser',
    'method' => 'PUT',
    'path' => '/users/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'To change the email, name, login, theme, provide another one.',
    ),
  ),
  'grafana_get_user_org_list' =>
  array (
    'slug' => 'grafana_get_user_org_list',
    'class' => 'GrafanaGetUserOrgList',
    'type' => 'read',
    'name' => 'Get organizations for user.',
    'description' => 'Get organizations for user identified by id.',
    'operation_id' => 'getUserOrgList',
    'method' => 'GET',
    'path' => '/users/{user_id}/orgs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_user_teams' =>
  array (
    'slug' => 'grafana_get_user_teams',
    'class' => 'GrafanaGetUserTeams',
    'type' => 'read',
    'name' => 'Get teams for user.',
    'description' => 'Get teams for user identified by id.',
    'operation_id' => 'getUserTeams',
    'method' => 'GET',
    'path' => '/users/{user_id}/teams',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_list_alerts' =>
  array (
    'slug' => 'grafana_list_alerts',
    'class' => 'GrafanaListAlerts',
    'type' => 'read',
    'name' => 'Get all the alert rules.',
    'description' => 'Get all the alert rules. (GET /v1/provisioning/alert-rules).',
    'operation_id' => 'RouteGetAlertRules',
    'method' => 'GET',
    'path' => '/v1/provisioning/alert-rules',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_post_alert_rule' =>
  array (
    'slug' => 'grafana_route_post_alert_rule',
    'class' => 'GrafanaRoutePostAlertRule',
    'type' => 'write',
    'name' => 'Create a new alert rule.',
    'description' => 'Create a new alert rule. (POST /v1/provisioning/alert-rules).',
    'operation_id' => 'RoutePostAlertRule',
    'method' => 'POST',
    'path' => '/v1/provisioning/alert-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_get_alert_rules_export' =>
  array (
    'slug' => 'grafana_route_get_alert_rules_export',
    'class' => 'GrafanaRouteGetAlertRulesExport',
    'type' => 'read',
    'name' => 'Export all alert rules in provisioning file format.',
    'description' => 'Export all alert rules in provisioning file format. (GET /v1/provisioning/alert-rules/export).',
    'operation_id' => 'RouteGetAlertRulesExport',
    'method' => 'GET',
    'path' => '/v1/provisioning/alert-rules/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'folderUid',
        'in' => 'query',
        'required' => false,
        'description' => 'UIDs of folders from which to export rules',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'description' => 'Name of group of rules to export. Must be specified only together with a single folder UID',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'ruleUid',
        'in' => 'query',
        'required' => false,
        'description' => 'UID of alert rule to export. If specified, parameters folderUid and group must be empty.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_delete_alert_rule' =>
  array (
    'slug' => 'grafana_route_delete_alert_rule',
    'class' => 'GrafanaRouteDeleteAlertRule',
    'type' => 'write',
    'name' => 'Delete a specific alert rule by UID.',
    'description' => 'Delete a specific alert rule by UID. (DELETE /v1/provisioning/alert-rules/{UID}).',
    'operation_id' => 'RouteDeleteAlertRule',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/alert-rules/{UID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'Alert rule UID',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_alert_rule' =>
  array (
    'slug' => 'grafana_route_get_alert_rule',
    'class' => 'GrafanaRouteGetAlertRule',
    'type' => 'read',
    'name' => 'Get a specific alert rule by UID.',
    'description' => 'Get a specific alert rule by UID. (GET /v1/provisioning/alert-rules/{UID}).',
    'operation_id' => 'RouteGetAlertRule',
    'method' => 'GET',
    'path' => '/v1/provisioning/alert-rules/{UID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'Alert rule UID',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_alert_rule' =>
  array (
    'slug' => 'grafana_route_put_alert_rule',
    'class' => 'GrafanaRoutePutAlertRule',
    'type' => 'write',
    'name' => 'Update an existing alert rule.',
    'description' => 'Update an existing alert rule. (PUT /v1/provisioning/alert-rules/{UID}).',
    'operation_id' => 'RoutePutAlertRule',
    'method' => 'PUT',
    'path' => '/v1/provisioning/alert-rules/{UID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'Alert rule UID',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_get_alert_rule_export' =>
  array (
    'slug' => 'grafana_route_get_alert_rule_export',
    'class' => 'GrafanaRouteGetAlertRuleExport',
    'type' => 'read',
    'name' => 'Export an alert rule in provisioning file format.',
    'description' => 'Export an alert rule in provisioning file format. (GET /v1/provisioning/alert-rules/{UID}/export).',
    'operation_id' => 'RouteGetAlertRuleExport',
    'method' => 'GET',
    'path' => '/v1/provisioning/alert-rules/{UID}/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'Alert rule UID',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_contactpoints' =>
  array (
    'slug' => 'grafana_route_get_contactpoints',
    'class' => 'GrafanaRouteGetContactpoints',
    'type' => 'read',
    'name' => 'Get all the contact points.',
    'description' => 'Get all the contact points. (GET /v1/provisioning/contact-points).',
    'operation_id' => 'RouteGetContactpoints',
    'method' => 'GET',
    'path' => '/v1/provisioning/contact-points',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_post_contactpoints' =>
  array (
    'slug' => 'grafana_route_post_contactpoints',
    'class' => 'GrafanaRoutePostContactpoints',
    'type' => 'write',
    'name' => 'Create a contact point.',
    'description' => 'Create a contact point. (POST /v1/provisioning/contact-points).',
    'operation_id' => 'RoutePostContactpoints',
    'method' => 'POST',
    'path' => '/v1/provisioning/contact-points',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_get_contactpoints_export' =>
  array (
    'slug' => 'grafana_route_get_contactpoints_export',
    'class' => 'GrafanaRouteGetContactpointsExport',
    'type' => 'read',
    'name' => 'Export all contact points in provisioning file format.',
    'description' => 'Export all contact points in provisioning file format. (GET /v1/provisioning/contact-points/export).',
    'operation_id' => 'RouteGetContactpointsExport',
    'method' => 'GET',
    'path' => '/v1/provisioning/contact-points/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'decrypt',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether any contained secure settings should be decrypted or left redacted. Redacted settings will contain RedactedValue instead. Currently, only org admin can view decrypted secure settings.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_delete_contactpoints' =>
  array (
    'slug' => 'grafana_route_delete_contactpoints',
    'class' => 'GrafanaRouteDeleteContactpoints',
    'type' => 'write',
    'name' => 'Delete a contact point.',
    'description' => 'Delete a contact point. (DELETE /v1/provisioning/contact-points/{UID}).',
    'operation_id' => 'RouteDeleteContactpoints',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/contact-points/{UID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'UID is the contact point unique identifier',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_contactpoint' =>
  array (
    'slug' => 'grafana_route_put_contactpoint',
    'class' => 'GrafanaRoutePutContactpoint',
    'type' => 'write',
    'name' => 'Update an existing contact point.',
    'description' => 'Update an existing contact point. (PUT /v1/provisioning/contact-points/{UID}).',
    'operation_id' => 'RoutePutContactpoint',
    'method' => 'PUT',
    'path' => '/v1/provisioning/contact-points/{UID}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'UID',
        'in' => 'path',
        'required' => true,
        'description' => 'UID is the contact point unique identifier',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_delete_alert_rule_group' =>
  array (
    'slug' => 'grafana_route_delete_alert_rule_group',
    'class' => 'GrafanaRouteDeleteAlertRuleGroup',
    'type' => 'write',
    'name' => 'RouteDeleteAlertRuleGroup',
    'description' => 'Delete rule group',
    'operation_id' => 'RouteDeleteAlertRuleGroup',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/folder/{FolderUID}/rule-groups/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'FolderUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_alert_rule_group' =>
  array (
    'slug' => 'grafana_route_get_alert_rule_group',
    'class' => 'GrafanaRouteGetAlertRuleGroup',
    'type' => 'read',
    'name' => 'Get a rule group.',
    'description' => 'Get a rule group. (GET /v1/provisioning/folder/{FolderUID}/rule-groups/{Group}).',
    'operation_id' => 'RouteGetAlertRuleGroup',
    'method' => 'GET',
    'path' => '/v1/provisioning/folder/{FolderUID}/rule-groups/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'FolderUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_alert_rule_group' =>
  array (
    'slug' => 'grafana_route_put_alert_rule_group',
    'class' => 'GrafanaRoutePutAlertRuleGroup',
    'type' => 'write',
    'name' => 'Create or update alert rule group.',
    'description' => 'Create or update alert rule group. (PUT /v1/provisioning/folder/{FolderUID}/rule-groups/{Group}).',
    'operation_id' => 'RoutePutAlertRuleGroup',
    'method' => 'PUT',
    'path' => '/v1/provisioning/folder/{FolderUID}/rule-groups/{Group}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'FolderUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_get_alert_rule_group_export' =>
  array (
    'slug' => 'grafana_route_get_alert_rule_group_export',
    'class' => 'GrafanaRouteGetAlertRuleGroupExport',
    'type' => 'read',
    'name' => 'Export an alert rule group in provisioning file format.',
    'description' => 'Export an alert rule group in provisioning file format. (GET /v1/provisioning/folder/{FolderUID}/rule-groups/{Group}/export).',
    'operation_id' => 'RouteGetAlertRuleGroupExport',
    'method' => 'GET',
    'path' => '/v1/provisioning/folder/{FolderUID}/rule-groups/{Group}/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'FolderUID',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'Group',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_mute_timings' =>
  array (
    'slug' => 'grafana_route_get_mute_timings',
    'class' => 'GrafanaRouteGetMuteTimings',
    'type' => 'read',
    'name' => 'Get all the mute timings.',
    'description' => 'Get all the mute timings. (GET /v1/provisioning/mute-timings).',
    'operation_id' => 'RouteGetMuteTimings',
    'method' => 'GET',
    'path' => '/v1/provisioning/mute-timings',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_post_mute_timing' =>
  array (
    'slug' => 'grafana_route_post_mute_timing',
    'class' => 'GrafanaRoutePostMuteTiming',
    'type' => 'write',
    'name' => 'Create a new mute timing.',
    'description' => 'Create a new mute timing. (POST /v1/provisioning/mute-timings).',
    'operation_id' => 'RoutePostMuteTiming',
    'method' => 'POST',
    'path' => '/v1/provisioning/mute-timings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_export_mute_timings' =>
  array (
    'slug' => 'grafana_route_export_mute_timings',
    'class' => 'GrafanaRouteExportMuteTimings',
    'type' => 'read',
    'name' => 'Export all mute timings in provisioning format.',
    'description' => 'Export all mute timings in provisioning format. (GET /v1/provisioning/mute-timings/export).',
    'operation_id' => 'RouteExportMuteTimings',
    'method' => 'GET',
    'path' => '/v1/provisioning/mute-timings/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_delete_mute_timing' =>
  array (
    'slug' => 'grafana_route_delete_mute_timing',
    'class' => 'GrafanaRouteDeleteMuteTiming',
    'type' => 'write',
    'name' => 'Delete a mute timing.',
    'description' => 'Delete a mute timing. (DELETE /v1/provisioning/mute-timings/{name}).',
    'operation_id' => 'RouteDeleteMuteTiming',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/mute-timings/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Mute timing name',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'description' => 'Version of mute timing to use for optimistic concurrency. Leave empty to disable validation',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_mute_timing' =>
  array (
    'slug' => 'grafana_route_get_mute_timing',
    'class' => 'GrafanaRouteGetMuteTiming',
    'type' => 'read',
    'name' => 'Get a mute timing.',
    'description' => 'Get a mute timing. (GET /v1/provisioning/mute-timings/{name}).',
    'operation_id' => 'RouteGetMuteTiming',
    'method' => 'GET',
    'path' => '/v1/provisioning/mute-timings/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Mute timing name',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_mute_timing' =>
  array (
    'slug' => 'grafana_route_put_mute_timing',
    'class' => 'GrafanaRoutePutMuteTiming',
    'type' => 'write',
    'name' => 'Replace an existing mute timing.',
    'description' => 'Replace an existing mute timing. (PUT /v1/provisioning/mute-timings/{name}).',
    'operation_id' => 'RoutePutMuteTiming',
    'method' => 'PUT',
    'path' => '/v1/provisioning/mute-timings/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Mute timing name',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_route_export_mute_timing' =>
  array (
    'slug' => 'grafana_route_export_mute_timing',
    'class' => 'GrafanaRouteExportMuteTiming',
    'type' => 'read',
    'name' => 'Export a mute timing in provisioning format.',
    'description' => 'Export a mute timing in provisioning format. (GET /v1/provisioning/mute-timings/{name}/export).',
    'operation_id' => 'RouteExportMuteTiming',
    'method' => 'GET',
    'path' => '/v1/provisioning/mute-timings/{name}/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'description' => 'Whether to initiate a download of the file or not.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'format',
        'in' => 'query',
        'required' => false,
        'description' => 'Format of the downloaded file. Supported yaml, json or hcl. Accept header can also be used, but the query parameter will take precedence.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Mute timing name',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_reset_policy_tree' =>
  array (
    'slug' => 'grafana_route_reset_policy_tree',
    'class' => 'GrafanaRouteResetPolicyTree',
    'type' => 'write',
    'name' => 'Clears the notification policy tree.',
    'description' => 'Clears the notification policy tree. (DELETE /v1/provisioning/policies).',
    'operation_id' => 'RouteResetPolicyTree',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/policies',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_policy_tree' =>
  array (
    'slug' => 'grafana_route_get_policy_tree',
    'class' => 'GrafanaRouteGetPolicyTree',
    'type' => 'read',
    'name' => 'Get the notification policy tree.',
    'description' => 'Get the notification policy tree. (GET /v1/provisioning/policies).',
    'operation_id' => 'RouteGetPolicyTree',
    'method' => 'GET',
    'path' => '/v1/provisioning/policies',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_policy_tree' =>
  array (
    'slug' => 'grafana_route_put_policy_tree',
    'class' => 'GrafanaRoutePutPolicyTree',
    'type' => 'write',
    'name' => 'Sets the notification policy tree.',
    'description' => 'Sets the notification policy tree. (PUT /v1/provisioning/policies).',
    'operation_id' => 'RoutePutPolicyTree',
    'method' => 'PUT',
    'path' => '/v1/provisioning/policies',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'The new notification routing tree to use',
    ),
  ),
  'grafana_route_get_policy_tree_export' =>
  array (
    'slug' => 'grafana_route_get_policy_tree_export',
    'class' => 'GrafanaRouteGetPolicyTreeExport',
    'type' => 'read',
    'name' => 'Export the notification policy tree in provisioning file format.',
    'description' => 'Export the notification policy tree in provisioning file format. (GET /v1/provisioning/policies/export).',
    'operation_id' => 'RouteGetPolicyTreeExport',
    'method' => 'GET',
    'path' => '/v1/provisioning/policies/export',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_templates' =>
  array (
    'slug' => 'grafana_route_get_templates',
    'class' => 'GrafanaRouteGetTemplates',
    'type' => 'read',
    'name' => 'Get all notification template groups.',
    'description' => 'Get all notification template groups. (GET /v1/provisioning/templates).',
    'operation_id' => 'RouteGetTemplates',
    'method' => 'GET',
    'path' => '/v1/provisioning/templates',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_route_delete_template' =>
  array (
    'slug' => 'grafana_route_delete_template',
    'class' => 'GrafanaRouteDeleteTemplate',
    'type' => 'write',
    'name' => 'Delete a notification template group.',
    'description' => 'Delete a notification template group. (DELETE /v1/provisioning/templates/{name}).',
    'operation_id' => 'RouteDeleteTemplate',
    'method' => 'DELETE',
    'path' => '/v1/provisioning/templates/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Template group name',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'description' => 'Version of template to use for optimistic concurrency. Leave empty to disable validation',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_get_template' =>
  array (
    'slug' => 'grafana_route_get_template',
    'class' => 'GrafanaRouteGetTemplate',
    'type' => 'read',
    'name' => 'Get a notification template group.',
    'description' => 'Get a notification template group. (GET /v1/provisioning/templates/{name}).',
    'operation_id' => 'RouteGetTemplate',
    'method' => 'GET',
    'path' => '/v1/provisioning/templates/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Template group name',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_route_put_template' =>
  array (
    'slug' => 'grafana_route_put_template',
    'class' => 'GrafanaRoutePutTemplate',
    'type' => 'write',
    'name' => 'Updates an existing notification template group.',
    'description' => 'Updates an existing notification template group. (PUT /v1/provisioning/templates/{name}).',
    'operation_id' => 'RoutePutTemplate',
    'method' => 'PUT',
    'path' => '/v1/provisioning/templates/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Template group name',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'X-Disable-Provenance',
        'in' => 'header',
        'required' => false,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_list_all_providers_settings' =>
  array (
    'slug' => 'grafana_list_all_providers_settings',
    'class' => 'GrafanaListAllProvidersSettings',
    'type' => 'read',
    'name' => 'List all SSO Settings entries',
    'description' => 'You need to have a permission with action `settings:read` with scope `settings:auth.<provider>:*`.',
    'operation_id' => 'listAllProvidersSettings',
    'method' => 'GET',
    'path' => '/v1/sso-settings',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'grafana_remove_provider_settings' =>
  array (
    'slug' => 'grafana_remove_provider_settings',
    'class' => 'GrafanaRemoveProviderSettings',
    'type' => 'write',
    'name' => 'Remove SSO Settings',
    'description' => 'Removes the SSO Settings for a provider. You need to have a permission with action `settings:write` and scope `settings:auth.<provider>:*`.',
    'operation_id' => 'removeProviderSettings',
    'method' => 'DELETE',
    'path' => '/v1/sso-settings/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_get_provider_settings' =>
  array (
    'slug' => 'grafana_get_provider_settings',
    'class' => 'GrafanaGetProviderSettings',
    'type' => 'read',
    'name' => 'Get an SSO Settings entry by Key',
    'description' => 'You need to have a permission with action `settings:read` with scope `settings:auth.<provider>:*`.',
    'operation_id' => 'getProviderSettings',
    'method' => 'GET',
    'path' => '/v1/sso-settings/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'grafana_patch_provider_settings' =>
  array (
    'slug' => 'grafana_patch_provider_settings',
    'class' => 'GrafanaPatchProviderSettings',
    'type' => 'write',
    'name' => 'Patch SSO Settings',
    'description' => 'Partially updates the SSO Settings for a provider. Only provided fields are updated. You need to have a permission with action `settings:write` and scope `settings:auth.<provider>:*`.',
    'operation_id' => 'patchProviderSettings',
    'method' => 'PATCH',
    'path' => '/v1/sso-settings/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
  'grafana_update_provider_settings' =>
  array (
    'slug' => 'grafana_update_provider_settings',
    'class' => 'GrafanaUpdateProviderSettings',
    'type' => 'write',
    'name' => 'Update SSO Settings',
    'description' => 'Inserts or updates the SSO Settings for a provider. You need to have a permission with action `settings:write` and scope `settings:auth.<provider>:*`.',
    'operation_id' => 'updateProviderSettings',
    'method' => 'PUT',
    'path' => '/v1/sso-settings/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Grafana API operation.',
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
      'description' => 'Execute the Grafana API operation.',
    ),
  ),
);
    }
}
