<?php

namespace OpenCompany\Integrations\Render2;

/**
 * Official Render OpenAPI operation metadata.
 *
 * Generated from Render's ReadMe OpenAPI registry render-public-api-1.json.
 */
final class RenderOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'render_list_blueprints' =>
  array (
    'slug' => 'render_list_blueprints',
    'class' => 'RenderListBlueprints',
    'type' => 'read',
    'name' => 'List Blueprints',
    'description' => 'List Blueprints for the specified workspaces. If no workspaces are provided, returns all Blueprints the API key has access to.',
    'operation_id' => 'list-blueprints',
    'method' => 'GET',
    'path' => '/blueprints',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_validate_blueprint' =>
  array (
    'slug' => 'render_validate_blueprint',
    'class' => 'RenderValidateBlueprint',
    'type' => 'write',
    'name' => 'Validate Blueprint',
    'description' => 'Validate a `render.yaml` Blueprint file without creating or modifying any resources. This endpoint checks the syntax and structure of the Blueprint, validates that all required fields are present, and returns a plan indicating the resources that would be created. Requests to this endpoint use `Content-Type: multipart/form-data`. The provided Blueprint file cannot exceed 10MB in size.',
    'operation_id' => 'validate-blueprint',
    'method' => 'POST',
    'path' => '/blueprints/validate',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'multipart/form-data',
      ),
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_update_workspace_member' =>
  array (
    'slug' => 'render_update_workspace_member',
    'class' => 'RenderUpdateWorkspaceMember',
    'type' => 'write',
    'name' => 'Update workspace member role',
    'description' => 'Update the role of an existing workspace member.',
    'operation_id' => 'update-workspace-member',
    'method' => 'PATCH',
    'path' => '/owners/{ownerId}/members/{userId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return resources for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the user (Render object ID with a `usr-` prefix).',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_remove_workspace_member' =>
  array (
    'slug' => 'render_remove_workspace_member',
    'class' => 'RenderRemoveWorkspaceMember',
    'type' => 'write',
    'name' => 'Remove workspace member',
    'description' => 'Remove a user from the specified workspace.',
    'operation_id' => 'remove-workspace-member',
    'method' => 'DELETE',
    'path' => '/owners/{ownerId}/members/{userId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return resources for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'userId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the user (Render object ID with a `usr-` prefix).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_blueprint' =>
  array (
    'slug' => 'render_retrieve_blueprint',
    'class' => 'RenderRetrieveBlueprint',
    'type' => 'read',
    'name' => 'Retrieve Blueprint',
    'description' => 'Retrieve the Blueprint with the provided ID.',
    'operation_id' => 'retrieve-blueprint',
    'method' => 'GET',
    'path' => '/blueprints/{blueprintId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'blueprintId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the Blueprint',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_blueprint' =>
  array (
    'slug' => 'render_update_blueprint',
    'class' => 'RenderUpdateBlueprint',
    'type' => 'write',
    'name' => 'Update Blueprint',
    'description' => 'Update the Blueprint with the provided ID.',
    'operation_id' => 'update-blueprint',
    'method' => 'PATCH',
    'path' => '/blueprints/{blueprintId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'blueprintId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the Blueprint',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_disconnect_blueprint' =>
  array (
    'slug' => 'render_disconnect_blueprint',
    'class' => 'RenderDisconnectBlueprint',
    'type' => 'write',
    'name' => 'Disconnect Blueprint',
    'description' => 'Disconnect the Blueprint with the provided ID. Disconnecting a Blueprint stops automatic resource syncing via the associated `render.yaml` file. It does not _delete_ any services or other resources that were managed by the blueprint.',
    'operation_id' => 'disconnect-blueprint',
    'method' => 'DELETE',
    'path' => '/blueprints/{blueprintId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'blueprintId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the Blueprint',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_blueprint_syncs' =>
  array (
    'slug' => 'render_list_blueprint_syncs',
    'class' => 'RenderListBlueprintSyncs',
    'type' => 'read',
    'name' => 'List Blueprint syncs',
    'description' => 'List syncs for the Blueprint with the provided ID.',
    'operation_id' => 'list-blueprint-syncs',
    'method' => 'GET',
    'path' => '/blueprints/{blueprintId}/syncs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_disks' =>
  array (
    'slug' => 'render_list_disks',
    'class' => 'RenderListDisks',
    'type' => 'read',
    'name' => 'List disks',
    'description' => 'List persistent disks matching the provided filters. If no filters are provided, returns all disks you have permissions to view.',
    'operation_id' => 'list-disks',
    'method' => 'GET',
    'path' => '/disks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'diskId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by disk IDs',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'serviceId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources by service ID',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_add_disk' =>
  array (
    'slug' => 'render_add_disk',
    'class' => 'RenderAddDisk',
    'type' => 'write',
    'name' => 'Add disk',
    'description' => 'Attach a persistent disk to a web service, private service, or background worker. The service must be redeployed for the disk to be attached.',
    'operation_id' => 'add-disk',
    'method' => 'POST',
    'path' => '/disks',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_disk' =>
  array (
    'slug' => 'render_retrieve_disk',
    'class' => 'RenderRetrieveDisk',
    'type' => 'read',
    'name' => 'Retrieve disk',
    'description' => 'Retrieve the persistent disk with the provided ID.',
    'operation_id' => 'retrieve-disk',
    'method' => 'GET',
    'path' => '/disks/{diskId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'diskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the disk',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_disk' =>
  array (
    'slug' => 'render_update_disk',
    'class' => 'RenderUpdateDisk',
    'type' => 'write',
    'name' => 'Update disk',
    'description' => 'Update the persistent disk with the provided ID. The disk\'s associated service must be deployed and active for updates to take effect. When resizing a disk, the new size must be greater than the current size.',
    'operation_id' => 'update-disk',
    'method' => 'PATCH',
    'path' => '/disks/{diskId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'diskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the disk',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_disk' =>
  array (
    'slug' => 'render_delete_disk',
    'class' => 'RenderDeleteDisk',
    'type' => 'write',
    'name' => 'Delete disk',
    'description' => 'Delete a persistent disk attached to a service. **All data on the disk will be lost.** The disk\'s associated service will immediately lose access to it.',
    'operation_id' => 'delete-disk',
    'method' => 'DELETE',
    'path' => '/disks/{diskId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'diskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the disk',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_snapshots' =>
  array (
    'slug' => 'render_list_snapshots',
    'class' => 'RenderListSnapshots',
    'type' => 'read',
    'name' => 'List snapshots',
    'description' => 'List snapshots for the persistent disk with the provided ID. Each snapshot is a point-in-time copy of the disk\'s data.',
    'operation_id' => 'list-snapshots',
    'method' => 'GET',
    'path' => '/disks/{diskId}/snapshots',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'diskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the disk',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_restore_snapshot' =>
  array (
    'slug' => 'render_restore_snapshot',
    'class' => 'RenderRestoreSnapshot',
    'type' => 'write',
    'name' => 'Restore snapshot',
    'description' => 'Restore a persistent disk to an available snapshot. **This operation is irreversible.** It will overwrite the current disk data. It might also trigger a service deploy. Snapshot keys returned from the [List snapshots](https://api-docs.render.com/reference/list-snapshots) endpoint expire after 24 hours. If a snapshot key has expired, query the endpoint again for a new key.',
    'operation_id' => 'restore-snapshot',
    'method' => 'POST',
    'path' => '/disks/{diskId}/snapshots/restore',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'diskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the disk',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_current_user' =>
  array (
    'slug' => 'render_get_current_user',
    'class' => 'RenderGetCurrentUser',
    'type' => 'read',
    'name' => 'Get the authenticated user',
    'description' => 'Retrieve the user associated with the provided API key.',
    'operation_id' => 'get-user',
    'method' => 'GET',
    'path' => '/users',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'render_list_owners' =>
  array (
    'slug' => 'render_list_owners',
    'class' => 'RenderListOwners',
    'type' => 'read',
    'name' => 'List workspaces',
    'description' => 'List the workspaces that your API key has access to, optionally filtered by name or owner email address.',
    'operation_id' => 'list-owners',
    'method' => 'GET',
    'path' => '/owners',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Only return workspaces with one of the provided names. Only exact matches are returned.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'email',
        'in' => 'query',
        'required' => false,
        'description' => 'Only return workspaces owned by one of the provided email addresses.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_owner' =>
  array (
    'slug' => 'render_retrieve_owner',
    'class' => 'RenderRetrieveOwner',
    'type' => 'read',
    'name' => 'Retrieve workspace',
    'description' => 'Retrieve the workspace with the provided ID. Workspace IDs start with `tea-`. If you provide a user ID (starts with `own-`), this endpoint returns the user\'s default workspace.',
    'operation_id' => 'retrieve-owner',
    'method' => 'GET',
    'path' => '/owners/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the user or team',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_owner_members' =>
  array (
    'slug' => 'render_retrieve_owner_members',
    'class' => 'RenderRetrieveOwnerMembers',
    'type' => 'read',
    'name' => 'List workspace members',
    'description' => 'Retrieves the list of users belonging to the workspace with the provided ID.',
    'operation_id' => 'retrieve-owner-members',
    'method' => 'GET',
    'path' => '/owners/{ownerId}/members',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the team',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_owner_audit_logs' =>
  array (
    'slug' => 'render_list_owner_audit_logs',
    'class' => 'RenderListOwnerAuditLogs',
    'type' => 'read',
    'name' => 'List workspace audit logs',
    'description' => 'Retrieve audit logs for a specific workspace with optional filtering and pagination.',
    'operation_id' => 'list-owner-audit-logs',
    'method' => 'GET',
    'path' => '/owners/{ownerId}/audit-logs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return resources for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Start time for filtering audit logs (ISO 8601 format)',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'End time for filtering audit logs (ISO 8601 format)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'direction',
        'in' => 'query',
        'required' => false,
        'description' => 'The direction to query logs for. Backward will return most recent logs first. Forward will start with the oldest logs in the time range.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of audit log items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_organization_audit_logs' =>
  array (
    'slug' => 'render_list_organization_audit_logs',
    'class' => 'RenderListOrganizationAuditLogs',
    'type' => 'read',
    'name' => 'List organization audit logs',
    'description' => 'Retrieve audit logs for a specific organization with optional filtering and pagination.',
    'operation_id' => 'list-organization-audit-logs',
    'method' => 'GET',
    'path' => '/organizations/{orgId}/audit-logs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'orgId',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the organization',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Start time for filtering audit logs (ISO 8601 format)',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'End time for filtering audit logs (ISO 8601 format)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'direction',
        'in' => 'query',
        'required' => false,
        'description' => 'The direction to query logs for. Backward will return most recent logs first. Forward will start with the oldest logs in the time range.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of audit log items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_owner_notification_settings' =>
  array (
    'slug' => 'render_retrieve_owner_notification_settings',
    'class' => 'RenderRetrieveOwnerNotificationSettings',
    'type' => 'read',
    'name' => 'Retrieve notification settings',
    'description' => 'Retrieve notification settings for the owner with the provided ID. Note that you provide an owner ID to this endpoint, not the ID for a particular resource.',
    'operation_id' => 'retrieve-owner-notification-settings',
    'method' => 'GET',
    'path' => '/notification-settings/owners/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return resources for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_patch_owner_notification_settings' =>
  array (
    'slug' => 'render_patch_owner_notification_settings',
    'class' => 'RenderPatchOwnerNotificationSettings',
    'type' => 'write',
    'name' => 'Update notification settings',
    'description' => 'Update notification settings for the owner with the provided ID.',
    'operation_id' => 'patch-owner-notification-settings',
    'method' => 'PATCH',
    'path' => '/notification-settings/owners/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return resources for',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_notification_overrides' =>
  array (
    'slug' => 'render_list_notification_overrides',
    'class' => 'RenderListNotificationOverrides',
    'type' => 'read',
    'name' => 'List notification overrides',
    'description' => 'List notification overrides matching the provided filters. If no filters are provided, returns all notification overrides for all workspaces the user belongs to.',
    'operation_id' => 'list-notification-overrides',
    'method' => 'GET',
    'path' => '/notification-settings/overrides',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'serviceId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources by service ID',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_service_notification_overrides' =>
  array (
    'slug' => 'render_retrieve_service_notification_overrides',
    'class' => 'RenderRetrieveServiceNotificationOverrides',
    'type' => 'read',
    'name' => 'Retrieve notification override',
    'description' => 'Retrieve the notification override for the service with the provided ID. Note that you provide a service ID to this endpoint, not the ID for a particular override.',
    'operation_id' => 'retrieve-service-notification-overrides',
    'method' => 'GET',
    'path' => '/notification-settings/overrides/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_patch_service_notification_overrides' =>
  array (
    'slug' => 'render_patch_service_notification_overrides',
    'class' => 'RenderPatchServiceNotificationOverrides',
    'type' => 'write',
    'name' => 'Update notification override',
    'description' => 'Update the notification override for the service with the provided ID.',
    'operation_id' => 'patch-service-notification-overrides',
    'method' => 'PATCH',
    'path' => '/notification-settings/overrides/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_registry_credentials' =>
  array (
    'slug' => 'render_list_registry_credentials',
    'class' => 'RenderListRegistryCredentials',
    'type' => 'read',
    'name' => 'List registry credentials',
    'description' => 'List registry credentials matching the provided filters. If no filters are provided, returns all registry credentials you have permissions to view.',
    'operation_id' => 'list-registry-credentials',
    'method' => 'GET',
    'path' => '/registrycredentials',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the name of a credential',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the username of a credential',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the registry type for the credential',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for services created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for services created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for services updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for services updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_registry_credential' =>
  array (
    'slug' => 'render_create_registry_credential',
    'class' => 'RenderCreateRegistryCredential',
    'type' => 'write',
    'name' => 'Create registry credential',
    'description' => 'Create a new registry credential.',
    'operation_id' => 'create-registry-credential',
    'method' => 'POST',
    'path' => '/registrycredentials',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_registry_credential' =>
  array (
    'slug' => 'render_retrieve_registry_credential',
    'class' => 'RenderRetrieveRegistryCredential',
    'type' => 'read',
    'name' => 'Retrieve registry credential',
    'description' => 'Retrieve the registry credential with the provided ID.',
    'operation_id' => 'retrieve-registry-credential',
    'method' => 'GET',
    'path' => '/registrycredentials/{registryCredentialId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'registryCredentialId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the registry credential',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_registry_credential' =>
  array (
    'slug' => 'render_update_registry_credential',
    'class' => 'RenderUpdateRegistryCredential',
    'type' => 'write',
    'name' => 'Update registry credential',
    'description' => 'Update the registry credential with the provided ID. Services that use this credential must be redeployed to use updated values.',
    'operation_id' => 'update-registry-credential',
    'method' => 'PATCH',
    'path' => '/registrycredentials/{registryCredentialId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'registryCredentialId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the registry credential',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_registry_credential' =>
  array (
    'slug' => 'render_delete_registry_credential',
    'class' => 'RenderDeleteRegistryCredential',
    'type' => 'write',
    'name' => 'Delete registry credential',
    'description' => 'Delete the registry credential with the provided ID.',
    'operation_id' => 'delete-registry-credential',
    'method' => 'DELETE',
    'path' => '/registrycredentials/{registryCredentialId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'registryCredentialId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the registry credential',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_services' =>
  array (
    'slug' => 'render_list_services',
    'class' => 'RenderListServices',
    'type' => 'read',
    'name' => 'List services',
    'description' => 'List services matching the provided filters. If no filters are provided, returns all services you have permissions to view.',
    'operation_id' => 'list-services',
    'method' => 'GET',
    'path' => '/services',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for types of services',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'env',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for environments (runtimes) of services (deprecated; use `runtime` instead)',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'region',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by resource region',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'suspended',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources based on whether they\'re suspended or not suspended',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      11 =>
      array (
        'name' => 'includePreviews',
        'in' => 'query',
        'required' => false,
        'description' => 'Include previews in the response',
        'schema_type' => 'boolean',
      ),
      12 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      13 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_service' =>
  array (
    'slug' => 'render_create_service',
    'class' => 'RenderCreateService',
    'type' => 'write',
    'name' => 'Create service',
    'description' => 'Creates a new Render service in the specified workspace with the specified configuration.',
    'operation_id' => 'create-service',
    'method' => 'POST',
    'path' => '/services',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_service' =>
  array (
    'slug' => 'render_get_service',
    'class' => 'RenderGetService',
    'type' => 'read',
    'name' => 'Retrieve service',
    'description' => 'Retrieve the service with the provided ID.',
    'operation_id' => 'retrieve-service',
    'method' => 'GET',
    'path' => '/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_service' =>
  array (
    'slug' => 'render_update_service',
    'class' => 'RenderUpdateService',
    'type' => 'write',
    'name' => 'Update service',
    'description' => 'Update the service with the provided ID.',
    'operation_id' => 'update-service',
    'method' => 'PATCH',
    'path' => '/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_service' =>
  array (
    'slug' => 'render_delete_service',
    'class' => 'RenderDeleteService',
    'type' => 'write',
    'name' => 'Delete service',
    'description' => 'Delete the service with the provided ID.',
    'operation_id' => 'delete-service',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_purge_cache' =>
  array (
    'slug' => 'render_purge_cache',
    'class' => 'RenderPurgeCache',
    'type' => 'write',
    'name' => 'Purge Web Service Cache',
    'description' => 'Trigger cache purge for the web service if caching is enabled.',
    'operation_id' => 'purge-cache',
    'method' => 'POST',
    'path' => '/services/{serviceId}/cache/purge',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'content_types' =>
      array (
      ),
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_deploys' =>
  array (
    'slug' => 'render_list_deploys',
    'class' => 'RenderListDeploys',
    'type' => 'read',
    'name' => 'List deploys',
    'description' => 'List deploys matching the provided filters. If no filters are provided, all deploys for the service are returned.',
    'operation_id' => 'list-deploys',
    'method' => 'GET',
    'path' => '/services/{serviceId}/deploys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys with the specified statuses',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'finishedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys finished before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'finishedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for deploys finished after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_deploy' =>
  array (
    'slug' => 'render_create_deploy',
    'class' => 'RenderCreateDeploy',
    'type' => 'write',
    'name' => 'Trigger deploy',
    'description' => 'Trigger a deploy for the service with the provided ID.',
    'operation_id' => 'create-deploy',
    'method' => 'POST',
    'path' => '/services/{serviceId}/deploys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_deploy' =>
  array (
    'slug' => 'render_get_deploy',
    'class' => 'RenderGetDeploy',
    'type' => 'read',
    'name' => 'Retrieve deploy',
    'description' => 'Retrieve the details of a particular deploy for a particular service.',
    'operation_id' => 'retrieve-deploy',
    'method' => 'GET',
    'path' => '/services/{serviceId}/deploys/{deployId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the deploy',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_cancel_deploy' =>
  array (
    'slug' => 'render_cancel_deploy',
    'class' => 'RenderCancelDeploy',
    'type' => 'write',
    'name' => 'Cancel deploy',
    'description' => 'Cancel an in-progress deploy for a service. Not supported for cron jobs.',
    'operation_id' => 'cancel-deploy',
    'method' => 'POST',
    'path' => '/services/{serviceId}/deploys/{deployId}/cancel',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'deployId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the deploy',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_rollback_deploy' =>
  array (
    'slug' => 'render_rollback_deploy',
    'class' => 'RenderRollbackDeploy',
    'type' => 'write',
    'name' => 'Roll back deploy',
    'description' => 'Trigger a rollback to a previous deploy of the specified service. Triggering a rollback with this endpoint does not disable autodeploys for the service. This means an autodeploy might restore changes you had intentionally rolled back. You can toggle autodeploys for your service with the [Update service](https://api-docs.render.com/reference/update-service) endpoint or in the Render Dashboard.',
    'operation_id' => 'rollback-deploy',
    'method' => 'POST',
    'path' => '/services/{serviceId}/rollback',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_env_vars_for_service' =>
  array (
    'slug' => 'render_get_env_vars_for_service',
    'class' => 'RenderGetEnvVarsForService',
    'type' => 'read',
    'name' => 'List environment variables',
    'description' => 'List all environment variables for the service with the provided ID.',
    'operation_id' => 'get-env-vars-for-service',
    'method' => 'GET',
    'path' => '/services/{serviceId}/env-vars',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_env_vars_for_service' =>
  array (
    'slug' => 'render_update_env_vars_for_service',
    'class' => 'RenderUpdateEnvVarsForService',
    'type' => 'write',
    'name' => 'Update environment variables',
    'description' => 'Replace all environment variables for a service with the provided list of environment variables.',
    'operation_id' => 'update-env-vars-for-service',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/env-vars',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_env_var' =>
  array (
    'slug' => 'render_retrieve_env_var',
    'class' => 'RenderRetrieveEnvVar',
    'type' => 'read',
    'name' => 'Retrieve environment variable',
    'description' => 'Retrieve a particular environment variable for a particular service. This only applies to environment variables set directly on the service, not to environment variables in a linked environment group.',
    'operation_id' => 'retrieve-env-var',
    'method' => 'GET',
    'path' => '/services/{serviceId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_env_var' =>
  array (
    'slug' => 'render_update_env_var',
    'class' => 'RenderUpdateEnvVar',
    'type' => 'write',
    'name' => 'Add or update environment variable',
    'description' => 'Add or update a particular environment variable for a particular service. This only applies to environment variables set directly on the service, not to environment variables in a linked environment group.',
    'operation_id' => 'update-env-var',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_env_var' =>
  array (
    'slug' => 'render_delete_env_var',
    'class' => 'RenderDeleteEnvVar',
    'type' => 'write',
    'name' => 'Delete environment variable',
    'description' => 'Delete a particular environment variable from a particular service. This only applies to environment variables set directly on the service, not to environment variables in a linked environment group.',
    'operation_id' => 'delete-env-var',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_secret_files_for_service' =>
  array (
    'slug' => 'render_list_secret_files_for_service',
    'class' => 'RenderListSecretFilesForService',
    'type' => 'read',
    'name' => 'List secret files',
    'description' => 'List all secret files for the service with the provided ID.',
    'operation_id' => 'list-secret-files-for-service',
    'method' => 'GET',
    'path' => '/services/{serviceId}/secret-files',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_secret_files_for_service' =>
  array (
    'slug' => 'render_update_secret_files_for_service',
    'class' => 'RenderUpdateSecretFilesForService',
    'type' => 'write',
    'name' => 'Update secret files',
    'description' => 'Replace all secret files for a service with the provided list of secret files. **Any of the service\'s existing secret files not included in this request will be deleted.** This only applies to secret files set directly on the service, not to secret files in a linked environment group.',
    'operation_id' => 'update-secret-files-for-service',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/secret-files',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_secret_file' =>
  array (
    'slug' => 'render_retrieve_secret_file',
    'class' => 'RenderRetrieveSecretFile',
    'type' => 'read',
    'name' => 'Retrieve secret file',
    'description' => 'Retrieve a particular secret file for a particular service. This only applies to secret files set directly on the service, not to secret files in a linked environment group.',
    'operation_id' => 'retrieve-secret-file',
    'method' => 'GET',
    'path' => '/services/{serviceId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'The file name of the secret file',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_add_or_update_secret_file' =>
  array (
    'slug' => 'render_add_or_update_secret_file',
    'class' => 'RenderAddOrUpdateSecretFile',
    'type' => 'write',
    'name' => 'Add or update secret file',
    'description' => 'Add or update a particular secret file for a particular service. This only applies to secret files set directly on the service, not to secret files in a linked environment group.',
    'operation_id' => 'add-or-update-secret-file',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'The file name of the secret file',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_secret_file' =>
  array (
    'slug' => 'render_delete_secret_file',
    'class' => 'RenderDeleteSecretFile',
    'type' => 'write',
    'name' => 'Delete secret file',
    'description' => 'Delete a particular secret file from a particular service. This only applies to secret files set directly on the service, not to secret files in a linked environment group.',
    'operation_id' => 'delete-secret-file',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'The file name of the secret file',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_events' =>
  array (
    'slug' => 'render_list_events',
    'class' => 'RenderListEvents',
    'type' => 'read',
    'name' => 'List events',
    'description' => 'List recent events that occurred for the service with the provided ID.',
    'operation_id' => 'list-events',
    'method' => 'GET',
    'path' => '/services/{serviceId}/events',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'The type of event to filter to',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_headers' =>
  array (
    'slug' => 'render_list_headers',
    'class' => 'RenderListHeaders',
    'type' => 'read',
    'name' => 'List header rules',
    'description' => 'List a particular service\'s response header rules that match the provided filters. If no filters are provided, all rules for the service are returned.',
    'operation_id' => 'list-headers',
    'method' => 'GET',
    'path' => '/services/{serviceId}/headers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for specific paths that headers apply to',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for header names',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'value',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for header values',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_add_headers' =>
  array (
    'slug' => 'render_add_headers',
    'class' => 'RenderAddHeaders',
    'type' => 'write',
    'name' => 'Add header rule',
    'description' => 'Add a response header rule to the service with the provided ID.',
    'operation_id' => 'add-headers',
    'method' => 'POST',
    'path' => '/services/{serviceId}/headers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_update_headers' =>
  array (
    'slug' => 'render_update_headers',
    'class' => 'RenderUpdateHeaders',
    'type' => 'write',
    'name' => 'Replace header rules',
    'description' => 'Replace all header rules for a particular service with the provided list. **This deletes all existing header rules for the service that aren\'t included in the request.**',
    'operation_id' => 'update-headers',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/headers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_header' =>
  array (
    'slug' => 'render_delete_header',
    'class' => 'RenderDeleteHeader',
    'type' => 'write',
    'name' => 'Delete header rule',
    'description' => 'Delete a particular response header rule for a particular service.',
    'operation_id' => 'delete-header',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/headers/{headerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'headerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The id of the header',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_routes' =>
  array (
    'slug' => 'render_list_routes',
    'class' => 'RenderListRoutes',
    'type' => 'read',
    'name' => 'List redirect/rewrite rules',
    'description' => 'List a particular service\'s redirect/rewrite rules that match the provided filters. If no filters are provided, all rules for the service are returned.',
    'operation_id' => 'list-routes',
    'method' => 'GET',
    'path' => '/services/{serviceId}/routes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the type of route rule',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'source',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the source path of the route',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'destination',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the destination path of the route',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_add_route' =>
  array (
    'slug' => 'render_add_route',
    'class' => 'RenderAddRoute',
    'type' => 'write',
    'name' => 'Add redirect/rewrite rules',
    'description' => 'Add redirect/rewrite rules to the service with the provided ID.',
    'operation_id' => 'add-route',
    'method' => 'POST',
    'path' => '/services/{serviceId}/routes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_patch_route' =>
  array (
    'slug' => 'render_patch_route',
    'class' => 'RenderPatchRoute',
    'type' => 'write',
    'name' => 'Update redirect/rewrite rule priority',
    'description' => 'Update the priority for a particular redirect/rewrite rule. To apply redirect/rewrite rules to an incoming request, Render starts from the rule with priority `0` and applies the first encountered rule that matches the request\'s path (if any). Render increments the priority of other rules by `1` as necessary to make space for the updated rule.',
    'operation_id' => 'patch-route',
    'method' => 'PATCH',
    'path' => '/services/{serviceId}/routes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_put_routes' =>
  array (
    'slug' => 'render_put_routes',
    'class' => 'RenderPutRoutes',
    'type' => 'write',
    'name' => 'Update redirect/rewrite rules',
    'description' => 'Replace all redirect/rewrite rules for a particular service with the provided list. **This deletes all existing redirect/rewrite rules for the service that aren\'t included in the request.** Rule priority is assigned according to list order (the first rule in the list has the highest priority).',
    'operation_id' => 'put-routes',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/routes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_route' =>
  array (
    'slug' => 'render_delete_route',
    'class' => 'RenderDeleteRoute',
    'type' => 'write',
    'name' => 'Delete redirect/rewrite rule',
    'description' => 'Delete a particular redirect/rewrite rule for a particular service.',
    'operation_id' => 'delete-route',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/routes/{routeId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'routeId',
        'in' => 'path',
        'required' => true,
        'description' => 'The id of the route',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_custom_domains' =>
  array (
    'slug' => 'render_list_custom_domains',
    'class' => 'RenderListCustomDomains',
    'type' => 'read',
    'name' => 'List custom domains',
    'description' => 'List a particular service\'s custom domains that match the provided filters. If no filters are provided, all custom domains for the service are returned.',
    'operation_id' => 'list-custom-domains',
    'method' => 'GET',
    'path' => '/services/{serviceId}/custom-domains',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the names of custom domain',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'domainType',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for domain type',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'verificationStatus',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for domain verification status (`verified` or `unverified`)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for custom domains created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for custom domains created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_custom_domain' =>
  array (
    'slug' => 'render_create_custom_domain',
    'class' => 'RenderCreateCustomDomain',
    'type' => 'write',
    'name' => 'Add custom domain',
    'description' => 'Add a custom domain to the service with the provided ID.',
    'operation_id' => 'create-custom-domain',
    'method' => 'POST',
    'path' => '/services/{serviceId}/custom-domains',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_custom_domain' =>
  array (
    'slug' => 'render_retrieve_custom_domain',
    'class' => 'RenderRetrieveCustomDomain',
    'type' => 'read',
    'name' => 'Retrieve custom domain',
    'description' => 'Retrieve a particular custom domain for a particular service.',
    'operation_id' => 'retrieve-custom-domain',
    'method' => 'GET',
    'path' => '/services/{serviceId}/custom-domains/{customDomainIdOrName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'customDomainIdOrName',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID or name of the custom domain',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_delete_custom_domain' =>
  array (
    'slug' => 'render_delete_custom_domain',
    'class' => 'RenderDeleteCustomDomain',
    'type' => 'write',
    'name' => 'Delete custom domain',
    'description' => 'Delete a custom domain for a service given the service id and custom domain id or name.',
    'operation_id' => 'delete-custom-domain',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/custom-domains/{customDomainIdOrName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'customDomainIdOrName',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID or name of the custom domain',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_refresh_custom_domain' =>
  array (
    'slug' => 'render_refresh_custom_domain',
    'class' => 'RenderRefreshCustomDomain',
    'type' => 'write',
    'name' => 'Verify DNS configuration',
    'description' => 'Verify the DNS configuration for a custom domain.',
    'operation_id' => 'refresh-custom-domain',
    'method' => 'POST',
    'path' => '/services/{serviceId}/custom-domains/{customDomainIdOrName}/verify',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'customDomainIdOrName',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID or name of the custom domain',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_suspend_service' =>
  array (
    'slug' => 'render_suspend_service',
    'class' => 'RenderSuspendService',
    'type' => 'write',
    'name' => 'Suspend service',
    'description' => 'Suspend the service with the provided ID.',
    'operation_id' => 'suspend-service',
    'method' => 'POST',
    'path' => '/services/{serviceId}/suspend',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_resume_service' =>
  array (
    'slug' => 'render_resume_service',
    'class' => 'RenderResumeService',
    'type' => 'write',
    'name' => 'Resume service',
    'description' => 'Resume the service with the provided ID (if it\'s currently suspended).',
    'operation_id' => 'resume-service',
    'method' => 'POST',
    'path' => '/services/{serviceId}/resume',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_restart_service' =>
  array (
    'slug' => 'render_restart_service',
    'class' => 'RenderRestartService',
    'type' => 'write',
    'name' => 'Restart service',
    'description' => 'Restart the service with the provided ID. Not supported for cron jobs.',
    'operation_id' => 'restart-service',
    'method' => 'POST',
    'path' => '/services/{serviceId}/restart',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_scale_service' =>
  array (
    'slug' => 'render_scale_service',
    'class' => 'RenderScaleService',
    'type' => 'write',
    'name' => 'Scale instance count',
    'description' => '[Scale](https://render.com/docs/scaling#manual-scaling) the service with the provided ID to a fixed number of instances. Render ignores this value as long as autoscaling is enabled for the service.',
    'operation_id' => 'scale-service',
    'method' => 'POST',
    'path' => '/services/{serviceId}/scale',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_autoscale_service' =>
  array (
    'slug' => 'render_autoscale_service',
    'class' => 'RenderAutoscaleService',
    'type' => 'write',
    'name' => 'Update autoscaling config',
    'description' => 'Update the [autoscaling](https://render.com/docs/scaling#autoscaling) config for the service with the provided ID.',
    'operation_id' => 'autoscale-service',
    'method' => 'PUT',
    'path' => '/services/{serviceId}/autoscaling',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_autoscaling_config' =>
  array (
    'slug' => 'render_delete_autoscaling_config',
    'class' => 'RenderDeleteAutoscalingConfig',
    'type' => 'write',
    'name' => 'Delete autoscaling config',
    'description' => 'Delete the autoscaling config for a service given the service id.',
    'operation_id' => 'delete-autoscaling-config',
    'method' => 'DELETE',
    'path' => '/services/{serviceId}/autoscaling',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_preview_service' =>
  array (
    'slug' => 'render_preview_service',
    'class' => 'RenderPreviewService',
    'type' => 'write',
    'name' => 'Create service preview (image-backed)',
    'description' => 'Create a preview instance for an image-backed service. The preview uses the settings of the base service (referenced by `serviceId`), except settings overridden via provided parameters. View all active previews from your service\'s Previews tab in the Render Dashboard. Note that you can\'t create previews for Git-backed services using the Render API.',
    'operation_id' => 'preview-service',
    'method' => 'POST',
    'path' => '/services/{serviceId}/preview',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_jobs' =>
  array (
    'slug' => 'render_list_jobs',
    'class' => 'RenderListJobs',
    'type' => 'read',
    'name' => 'List jobs',
    'description' => 'List jobs for the provided service that match the provided filters. If no filters are provided, all jobs for the service are returned.',
    'operation_id' => 'list-job',
    'method' => 'GET',
    'path' => '/services/{serviceId}/jobs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for the status of the job (`pending`, `running`, `succeeded`, `failed`, or `canceled`)',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'startedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs started before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'startedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs started after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'finishedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs finished before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'finishedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for jobs finished after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_post_job' =>
  array (
    'slug' => 'render_post_job',
    'class' => 'RenderPostJob',
    'type' => 'write',
    'name' => 'Create job',
    'description' => 'Create a one-off job using the provided service. For details, see [One-Off Jobs](https://render.com/docs/one-off-jobs).',
    'operation_id' => 'post-job',
    'method' => 'POST',
    'path' => '/services/{serviceId}/jobs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_job' =>
  array (
    'slug' => 'render_retrieve_job',
    'class' => 'RenderRetrieveJob',
    'type' => 'read',
    'name' => 'Retrieve job',
    'description' => 'Retrieve the details of a particular one-off job for a particular service.',
    'operation_id' => 'retrieve-job',
    'method' => 'GET',
    'path' => '/services/{serviceId}/jobs/{jobId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'jobId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the job',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_cancel_job' =>
  array (
    'slug' => 'render_cancel_job',
    'class' => 'RenderCancelJob',
    'type' => 'write',
    'name' => 'Cancel running job',
    'description' => 'Cancel a particular one-off job for a particular service.',
    'operation_id' => 'cancel-job',
    'method' => 'POST',
    'path' => '/services/{serviceId}/jobs/{jobId}/cancel',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_instances' =>
  array (
    'slug' => 'render_list_instances',
    'class' => 'RenderListInstances',
    'type' => 'read',
    'name' => 'List instances',
    'description' => 'List instances for the provided service.',
    'operation_id' => 'list-instances',
    'method' => 'GET',
    'path' => '/services/{serviceId}/instances',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_run_cron_job' =>
  array (
    'slug' => 'render_run_cron_job',
    'class' => 'RenderRunCronJob',
    'type' => 'write',
    'name' => 'Trigger cron job run',
    'description' => 'Trigger a run for a cron job and cancel any active runs.',
    'operation_id' => 'run-cron-job',
    'method' => 'POST',
    'path' => '/cron-jobs/{cronJobId}/runs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cronJobId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the cron job',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_cancel_cron_job_run' =>
  array (
    'slug' => 'render_cancel_cron_job_run',
    'class' => 'RenderCancelCronJobRun',
    'type' => 'write',
    'name' => 'Cancel running cron job',
    'description' => 'Cancel a currently running cron job.',
    'operation_id' => 'cancel-cron-job-run',
    'method' => 'DELETE',
    'path' => '/cron-jobs/{cronJobId}/runs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cronJobId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the cron job',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_event' =>
  array (
    'slug' => 'render_retrieve_event',
    'class' => 'RenderRetrieveEvent',
    'type' => 'read',
    'name' => 'Retrieve event',
    'description' => 'Retrieve the details of a particular event',
    'operation_id' => 'retrieve-event',
    'method' => 'GET',
    'path' => '/events/{eventId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'eventId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the event',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_logs' =>
  array (
    'slug' => 'render_list_logs',
    'class' => 'RenderListLogs',
    'type' => 'read',
    'name' => 'List logs',
    'description' => 'List logs matching the provided filters. Logs are paginated by start and end timestamps. There are more logs to fetch if `hasMore` is true in the response. Provide the `nextStartTime` and `nextEndTime` timestamps as the `startTime` and `endTime` query parameters to fetch the next page of logs. You can query for logs across multiple resources, but all resources must be in the same region and bel...',
    'operation_id' => 'list-logs',
    'method' => 'GET',
    'path' => '/logs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => true,
        'description' => 'The ID of the workspace to return logs for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'direction',
        'in' => 'query',
        'required' => false,
        'description' => 'The direction to query logs for. Backward will return most recent logs first. Forward will start with the oldest logs in the time range.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter logs by their resource. A resource is the id of a server, cronjob, job, postgres, redis, or workflow.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by the instance they were emitted from. An instance is the id of a specific running server.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their host. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'statusCode',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their status code. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'method',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their requests method. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'task',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task(s)',
        'schema_type' => 'array',
      ),
      10 =>
      array (
        'name' => 'taskRun',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task run id(s)',
        'schema_type' => 'array',
      ),
      11 =>
      array (
        'name' => 'level',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their severity level. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      12 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their type. Types include `app` for application logs, `request` for request logs, and `build` for build logs. You can find the full set of types available for a query by using the `GET /logs/values` endpoint.',
        'schema_type' => 'array',
      ),
      13 =>
      array (
        'name' => 'text',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by the text of the logs. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      14 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their path. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      15 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_subscribe_logs' =>
  array (
    'slug' => 'render_subscribe_logs',
    'class' => 'RenderSubscribeLogs',
    'type' => 'read',
    'name' => 'Subscribe to new logs',
    'description' => 'Open a websocket connection to subscribe to logs matching the provided filters. Logs are streamed in real-time as they are generated. You can query for logs across multiple resources, but all resources must be in the same region and belong to the same owner.',
    'operation_id' => 'subscribe-logs',
    'method' => 'GET',
    'path' => '/logs/subscribe',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => true,
        'description' => 'The ID of the workspace to return logs for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'direction',
        'in' => 'query',
        'required' => false,
        'description' => 'The direction to query logs for. Backward will return most recent logs first. Forward will start with the oldest logs in the time range.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter logs by their resource. A resource is the id of a server, cronjob, job, postgres, redis, or workflow.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by the instance they were emitted from. An instance is the id of a specific running server.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their host. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'statusCode',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their status code. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'method',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their requests method. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'task',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task(s)',
        'schema_type' => 'array',
      ),
      10 =>
      array (
        'name' => 'taskRun',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task run id(s)',
        'schema_type' => 'array',
      ),
      11 =>
      array (
        'name' => 'level',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their severity level. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      12 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their type. Types include `app` for application logs, `request` for request logs, and `build` for build logs. You can find the full set of types available for a query by using the `GET /logs/values` endpoint.',
        'schema_type' => 'array',
      ),
      13 =>
      array (
        'name' => 'text',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by the text of the logs. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      14 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their path. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      15 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_logs_values' =>
  array (
    'slug' => 'render_list_logs_values',
    'class' => 'RenderListLogsValues',
    'type' => 'read',
    'name' => 'List log label values',
    'description' => 'List all values for a given log label in the logs matching the provided filters.',
    'operation_id' => 'list-logs-values',
    'method' => 'GET',
    'path' => '/logs/values',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => true,
        'description' => 'The ID of the workspace to return log label values for',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'label',
        'in' => 'query',
        'required' => true,
        'description' => 'The label to query logs for',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'direction',
        'in' => 'query',
        'required' => false,
        'description' => 'The direction to query logs for. Backward will return most recent logs first. Forward will start with the oldest logs in the time range.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter logs by their resource. A resource is the id of a server, cronjob, job, postgres, redis, or workflow.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by the instance they were emitted from. An instance is the id of a specific running server.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their host. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'statusCode',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their status code. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'method',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their requests method. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      10 =>
      array (
        'name' => 'task',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task(s)',
        'schema_type' => 'array',
      ),
      11 =>
      array (
        'name' => 'taskRun',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their task run id(s)',
        'schema_type' => 'array',
      ),
      12 =>
      array (
        'name' => 'level',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their severity level. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      13 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter logs by their type. Types include `app` for application logs, `request` for request logs, and `build` for build logs. You can find the full set of types available for a query by using the `GET /logs/values` endpoint.',
        'schema_type' => 'array',
      ),
      14 =>
      array (
        'name' => 'text',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by the text of the logs. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      15 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter request logs by their path. [Wildcards and regex](https://render.com/docs/logging#wildcards-and-regular-expressions) are supported.',
        'schema_type' => 'array',
      ),
      16 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_owner_log_stream' =>
  array (
    'slug' => 'render_get_owner_log_stream',
    'class' => 'RenderGetOwnerLogStream',
    'type' => 'read',
    'name' => 'Retrieve log stream',
    'description' => 'Returns log stream information for the specified workspace.',
    'operation_id' => 'get-owner-log-stream',
    'method' => 'GET',
    'path' => '/logs/streams/owner/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return log stream information for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_owner_log_stream' =>
  array (
    'slug' => 'render_update_owner_log_stream',
    'class' => 'RenderUpdateOwnerLogStream',
    'type' => 'write',
    'name' => 'Update log stream',
    'description' => 'Updates log stream information for the specified workspace. All logs for resources owned by this workspace will be sent to this log stream unless overridden by individual resources.',
    'operation_id' => 'update-owner-log-stream',
    'method' => 'PUT',
    'path' => '/logs/streams/owner/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to update log stream information for',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_owner_log_stream' =>
  array (
    'slug' => 'render_delete_owner_log_stream',
    'class' => 'RenderDeleteOwnerLogStream',
    'type' => 'write',
    'name' => 'Delete log stream',
    'description' => 'Removes the log stream for the specified workspace.',
    'operation_id' => 'delete-owner-log-stream',
    'method' => 'DELETE',
    'path' => '/logs/streams/owner/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to delete the log stream for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_resource_log_streams' =>
  array (
    'slug' => 'render_list_resource_log_streams',
    'class' => 'RenderListResourceLogStreams',
    'type' => 'read',
    'name' => 'List log stream overrides',
    'description' => 'Lists log stream overrides for the provided workspace that match the provided filters. These overrides take precedence over the workspace\'s default log stream.',
    'operation_id' => 'list-resource-log-streams',
    'method' => 'GET',
    'path' => '/logs/streams/resource',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'logStreamId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter log streams by their id.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'resourceId',
        'in' => 'query',
        'required' => false,
        'description' => 'IDs of resources (server, cron job, postgres, or redis) to filter by',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'setting',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter log streams by their setting.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_resource_log_stream' =>
  array (
    'slug' => 'render_get_resource_log_stream',
    'class' => 'RenderGetResourceLogStream',
    'type' => 'read',
    'name' => 'Retrieve log stream override',
    'description' => 'Returns log stream override information for the specified resource. A log stream override takes precedence over a workspace\'s default log stream.',
    'operation_id' => 'get-resource-log-stream',
    'method' => 'GET',
    'path' => '/logs/streams/resource/{resourceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resourceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the resource (server, cron job, postgres, or redis) to return log stream override information for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_resource_log_stream' =>
  array (
    'slug' => 'render_update_resource_log_stream',
    'class' => 'RenderUpdateResourceLogStream',
    'type' => 'write',
    'name' => 'Update log stream override',
    'description' => 'Updates log stream override information for the specified resource. A log stream override takes precedence over a workspace\'s default log stream.',
    'operation_id' => 'update-resource-log-stream',
    'method' => 'PUT',
    'path' => '/logs/streams/resource/{resourceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resourceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the resource (server, cron job, postgres, or redis) to update log stream override information for',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_resource_log_stream' =>
  array (
    'slug' => 'render_delete_resource_log_stream',
    'class' => 'RenderDeleteResourceLogStream',
    'type' => 'write',
    'name' => 'Delete log stream override',
    'description' => 'Removes the log stream override for the specified resource. After deletion, the resource will use the workspace\'s default log stream setting.',
    'operation_id' => 'delete-resource-log-stream',
    'method' => 'DELETE',
    'path' => '/logs/streams/resource/{resourceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resourceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the resource (server, cron job, postgres, or redis) whose log streams should be returned',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_owner_metrics_stream' =>
  array (
    'slug' => 'render_get_owner_metrics_stream',
    'class' => 'RenderGetOwnerMetricsStream',
    'type' => 'read',
    'name' => 'Retrieve metrics stream',
    'description' => 'Returns metrics stream information for the specified workspace.',
    'operation_id' => 'getOwnerMetricsStream',
    'method' => 'GET',
    'path' => '/metrics-stream/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return metrics stream information for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_upsert_owner_metrics_stream' =>
  array (
    'slug' => 'render_upsert_owner_metrics_stream',
    'class' => 'RenderUpsertOwnerMetricsStream',
    'type' => 'write',
    'name' => 'Create or update metrics stream',
    'description' => 'Creates or updates the metrics stream for the specified workspace.',
    'operation_id' => 'upsertOwnerMetricsStream',
    'method' => 'PUT',
    'path' => '/metrics-stream/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return metrics stream information for',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_owner_metrics_stream' =>
  array (
    'slug' => 'render_delete_owner_metrics_stream',
    'class' => 'RenderDeleteOwnerMetricsStream',
    'type' => 'write',
    'name' => 'Delete metrics stream',
    'description' => 'Deletes the metrics stream for the specified workspace.',
    'operation_id' => 'deleteOwnerMetricsStream',
    'method' => 'DELETE',
    'path' => '/metrics-stream/{ownerId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workspace to return metrics stream information for',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_cpu' =>
  array (
    'slug' => 'render_get_cpu',
    'class' => 'RenderGetCpu',
    'type' => 'read',
    'name' => 'Get CPU usage',
    'description' => 'Get CPU usage for one or more resources.',
    'operation_id' => 'get-cpu',
    'method' => 'GET',
    'path' => '/metrics/cpu',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'aggregationMethod',
        'in' => 'query',
        'required' => false,
        'description' => 'The aggregation method to apply to multiple time series',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_cpu_limit' =>
  array (
    'slug' => 'render_get_cpu_limit',
    'class' => 'RenderGetCpuLimit',
    'type' => 'read',
    'name' => 'Get CPU limit',
    'description' => 'Get the CPU limit for one or more resources.',
    'operation_id' => 'get-cpu-limit',
    'method' => 'GET',
    'path' => '/metrics/cpu-limit',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_cpu_target' =>
  array (
    'slug' => 'render_get_cpu_target',
    'class' => 'RenderGetCpuTarget',
    'type' => 'read',
    'name' => 'Get CPU target',
    'description' => 'Get CPU target for one or more resources.',
    'operation_id' => 'get-cpu-target',
    'method' => 'GET',
    'path' => '/metrics/cpu-target',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_memory' =>
  array (
    'slug' => 'render_get_memory',
    'class' => 'RenderGetMemory',
    'type' => 'read',
    'name' => 'Get memory usage',
    'description' => 'Get memory usage for one or more resources.',
    'operation_id' => 'get-memory',
    'method' => 'GET',
    'path' => '/metrics/memory',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_memory_limit' =>
  array (
    'slug' => 'render_get_memory_limit',
    'class' => 'RenderGetMemoryLimit',
    'type' => 'read',
    'name' => 'Get memory limit',
    'description' => 'Get the memory limit for one or more resources.',
    'operation_id' => 'get-memory-limit',
    'method' => 'GET',
    'path' => '/metrics/memory-limit',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_memory_target' =>
  array (
    'slug' => 'render_get_memory_target',
    'class' => 'RenderGetMemoryTarget',
    'type' => 'read',
    'name' => 'Get memory target',
    'description' => 'Get memory target for one or more resources.',
    'operation_id' => 'get-memory-target',
    'method' => 'GET',
    'path' => '/metrics/memory-target',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'instance',
        'in' => 'query',
        'required' => false,
        'description' => 'Instance ID to query. When multiple instance ID query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_http_requests' =>
  array (
    'slug' => 'render_get_http_requests',
    'class' => 'RenderGetHttpRequests',
    'type' => 'read',
    'name' => 'Get HTTP request count',
    'description' => 'Get the HTTP request count for one or more resources.',
    'operation_id' => 'get-http-requests',
    'method' => 'GET',
    'path' => '/metrics/http-requests',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'The hosts of HTTP requests to filter to. When multiple host query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'The paths of HTTP requests to filter to. When multiple path query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'aggregateBy',
        'in' => 'query',
        'required' => false,
        'description' => 'The field to aggregate by',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_http_latency' =>
  array (
    'slug' => 'render_get_http_latency',
    'class' => 'RenderGetHttpLatency',
    'type' => 'read',
    'name' => 'Get HTTP latency',
    'description' => 'Get HTTP latency metrics for one or more resources.',
    'operation_id' => 'get-http-latency',
    'method' => 'GET',
    'path' => '/metrics/http-latency',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'The hosts of HTTP requests to filter to. When multiple host query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'The paths of HTTP requests to filter to. When multiple path query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'quantile',
        'in' => 'query',
        'required' => false,
        'description' => 'The quantile of latencies to fetch. When multiple quantile query params are provided, they are ORed together',
        'schema_type' => 'number',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_bandwidth' =>
  array (
    'slug' => 'render_get_bandwidth',
    'class' => 'RenderGetBandwidth',
    'type' => 'read',
    'name' => 'Get bandwidth usage',
    'description' => 'Get bandwidth usage for one or more resources.',
    'operation_id' => 'get-bandwidth',
    'method' => 'GET',
    'path' => '/metrics/bandwidth',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_bandwidth_sources' =>
  array (
    'slug' => 'render_get_bandwidth_sources',
    'class' => 'RenderGetBandwidthSources',
    'type' => 'read',
    'name' => 'Get bandwidth usage breakdown by traffic source',
    'description' => 'Get bandwidth usage for one or more resources broken down by traffic source (HTTP, WebSocket, NAT, PrivateLink). Returns hourly data points with traffic source breakdown. Traffic source data is available from March 9, 2025 onwards. Queries for earlier dates will return a 400 Bad Request error.',
    'operation_id' => 'get-bandwidth-sources',
    'method' => 'GET',
    'path' => '/metrics/bandwidth-sources',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_disk_usage' =>
  array (
    'slug' => 'render_get_disk_usage',
    'class' => 'RenderGetDiskUsage',
    'type' => 'read',
    'name' => 'Get disk usage',
    'description' => 'Get persistent disk usage for one or more resources.',
    'operation_id' => 'get-disk-usage',
    'method' => 'GET',
    'path' => '/metrics/disk-usage',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_disk_capacity' =>
  array (
    'slug' => 'render_get_disk_capacity',
    'class' => 'RenderGetDiskCapacity',
    'type' => 'read',
    'name' => 'Get disk capacity',
    'description' => 'Get persistent disk capacity for one or more resources.',
    'operation_id' => 'get-disk-capacity',
    'method' => 'GET',
    'path' => '/metrics/disk-capacity',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_instance_count' =>
  array (
    'slug' => 'render_get_instance_count',
    'class' => 'RenderGetInstanceCount',
    'type' => 'read',
    'name' => 'Get instance count',
    'description' => 'Get the instance count for one or more resources.',
    'operation_id' => 'get-instance-count',
    'method' => 'GET',
    'path' => '/metrics/instance-count',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources can be service ids, Postgres ids, or Redis ids',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_active_connections' =>
  array (
    'slug' => 'render_get_active_connections',
    'class' => 'RenderGetActiveConnections',
    'type' => 'read',
    'name' => 'Get active connection count',
    'description' => 'Get the number of active connections for one or more Postgres databases or Redis instances.',
    'operation_id' => 'get-active-connections',
    'method' => 'GET',
    'path' => '/metrics/active-connections',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Resource ID to query. When multiple resource query params are provided, they are ORed together. Resources Postgres ids or Redis ids',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_replication_lag' =>
  array (
    'slug' => 'render_get_replication_lag',
    'class' => 'RenderGetReplicationLag',
    'type' => 'read',
    'name' => 'Get replica lag',
    'description' => 'Get seconds of replica lag of a Postgres replica.',
    'operation_id' => 'get-replication-lag',
    'method' => 'GET',
    'path' => '/metrics/replication-lag',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Postgres ID to query. When multiple resource query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_application_filter_values' =>
  array (
    'slug' => 'render_list_application_filter_values',
    'class' => 'RenderListApplicationFilterValues',
    'type' => 'read',
    'name' => 'List queryable instance values',
    'description' => 'List instance values to filter by for one or more resources.',
    'operation_id' => 'list-application-filter-values',
    'method' => 'GET',
    'path' => '/metrics/filters/application',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_http_filter_values' =>
  array (
    'slug' => 'render_list_http_filter_values',
    'class' => 'RenderListHttpFilterValues',
    'type' => 'read',
    'name' => 'List queryable status codes and host values',
    'description' => 'List status codes and host values to filter by for one or more resources.',
    'operation_id' => 'list-http-filter-values',
    'method' => 'GET',
    'path' => '/metrics/filters/http',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'The hosts of HTTP requests to filter to. When multiple host query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'statusCode',
        'in' => 'query',
        'required' => false,
        'description' => 'The status codes of HTTP requests to filter to. When multiple status code query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_path_filter_values' =>
  array (
    'slug' => 'render_list_path_filter_values',
    'class' => 'RenderListPathFilterValues',
    'type' => 'read',
    'name' => 'List queryable paths',
    'description' => 'The path suggestions are based on the most recent 5000 log lines as filtered by the provided filters',
    'operation_id' => 'list-path-filter-values',
    'method' => 'GET',
    'path' => '/metrics/filters/path',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Service ID to query. When multiple service ids are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'service',
        'in' => 'query',
        'required' => false,
        'description' => 'This parameter is deprecated. Please use `resource` instead',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'host',
        'in' => 'query',
        'required' => false,
        'description' => 'The hosts of HTTP requests to filter to. When multiple host query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'statusCode',
        'in' => 'query',
        'required' => false,
        'description' => 'The status codes of HTTP requests to filter to. When multiple status code query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'The paths of HTTP requests to filter to. When multiple path query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_task_runs_queued' =>
  array (
    'slug' => 'render_get_task_runs_queued',
    'class' => 'RenderGetTaskRunsQueued',
    'type' => 'read',
    'name' => 'Get task runs queued count',
    'description' => 'Get the total number of task runs queued for one or more tasks.',
    'operation_id' => 'get-task-runs-queued',
    'method' => 'GET',
    'path' => '/metrics/task-runs-queued',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Task ID to query. When multiple task IDs are provided, they are ORed together',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_task_runs_completed' =>
  array (
    'slug' => 'render_get_task_runs_completed',
    'class' => 'RenderGetTaskRunsCompleted',
    'type' => 'read',
    'name' => 'Get task runs completed count',
    'description' => 'Get the total number of task runs completed for one or more tasks. Optionally filter by state (succeeded/failed) or aggregate by state.',
    'operation_id' => 'get-task-runs-completed',
    'method' => 'GET',
    'path' => '/metrics/task-runs-completed',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'startTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of start of time range to return. Defaults to `now() - 1 hour`.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endTime',
        'in' => 'query',
        'required' => false,
        'description' => 'Epoch/Unix timestamp of end of time range to return. Defaults to `now()`.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resolutionSeconds',
        'in' => 'query',
        'required' => false,
        'description' => 'The resolution of the returned data',
        'schema_type' => 'number',
      ),
      3 =>
      array (
        'name' => 'resource',
        'in' => 'query',
        'required' => false,
        'description' => 'Task ID to query. When multiple task IDs are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'state',
        'in' => 'query',
        'required' => false,
        'description' => 'The state of task runs to filter to. When multiple state query params are provided, they are ORed together',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'aggregateBy',
        'in' => 'query',
        'required' => false,
        'description' => 'The field to aggregate by',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_key_value' =>
  array (
    'slug' => 'render_list_key_value',
    'class' => 'RenderListKeyValue',
    'type' => 'read',
    'name' => 'List Key Value instances',
    'description' => 'List Key Value instances matching the provided filters. If no filters are provided, all Key Value instances are returned.',
    'operation_id' => 'list-key-value',
    'method' => 'GET',
    'path' => '/key-value',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'region',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by resource region',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_key_value' =>
  array (
    'slug' => 'render_create_key_value',
    'class' => 'RenderCreateKeyValue',
    'type' => 'write',
    'name' => 'Create Key Value instance',
    'description' => 'Create a new Key Value instance.',
    'operation_id' => 'create-key-value',
    'method' => 'POST',
    'path' => '/key-value',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_key_value' =>
  array (
    'slug' => 'render_retrieve_key_value',
    'class' => 'RenderRetrieveKeyValue',
    'type' => 'read',
    'name' => 'Retrieve Key Value instance',
    'description' => 'Retrieve a Key Value instance by ID.',
    'operation_id' => 'retrieve-key-value',
    'method' => 'GET',
    'path' => '/key-value/{keyValueId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_key_value' =>
  array (
    'slug' => 'render_update_key_value',
    'class' => 'RenderUpdateKeyValue',
    'type' => 'write',
    'name' => 'Update Key Value instance',
    'description' => 'Update a Key Value instance by ID.',
    'operation_id' => 'update-key-value',
    'method' => 'PATCH',
    'path' => '/key-value/{keyValueId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_key_value' =>
  array (
    'slug' => 'render_delete_key_value',
    'class' => 'RenderDeleteKeyValue',
    'type' => 'write',
    'name' => 'Delete Key Value instance',
    'description' => 'Delete a Key Value instance by ID.',
    'operation_id' => 'delete-key-value',
    'method' => 'DELETE',
    'path' => '/key-value/{keyValueId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_key_value_connection_info' =>
  array (
    'slug' => 'render_retrieve_key_value_connection_info',
    'class' => 'RenderRetrieveKeyValueConnectionInfo',
    'type' => 'read',
    'name' => 'Retrieve Key Value connection info',
    'description' => 'Retrieve connection info for a Key Value instance by ID. Connection info includes sensitive information.',
    'operation_id' => 'retrieve-key-value-connection-info',
    'method' => 'GET',
    'path' => '/key-value/{keyValueId}/connection-info',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_suspend_key_value' =>
  array (
    'slug' => 'render_suspend_key_value',
    'class' => 'RenderSuspendKeyValue',
    'type' => 'write',
    'name' => 'Suspend Key Value instance',
    'description' => 'Suspend a Key Value instance by ID.',
    'operation_id' => 'suspend-key-value',
    'method' => 'POST',
    'path' => '/key-value/{keyValueId}/suspend',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_resume_key_value' =>
  array (
    'slug' => 'render_resume_key_value',
    'class' => 'RenderResumeKeyValue',
    'type' => 'write',
    'name' => 'Resume Key Value instance',
    'description' => 'Resume a Key Value instance by ID.',
    'operation_id' => 'resume-key-value',
    'method' => 'POST',
    'path' => '/key-value/{keyValueId}/resume',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyValueId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_redis' =>
  array (
    'slug' => 'render_list_redis',
    'class' => 'RenderListRedis',
    'type' => 'read',
    'name' => 'List Redis instances',
    'description' => 'List Redis instances matching the provided filters. If no filters are provided, all Redis instances are returned. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'list-redis',
    'method' => 'GET',
    'path' => '/redis',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'region',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by resource region',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_redis' =>
  array (
    'slug' => 'render_create_redis',
    'class' => 'RenderCreateRedis',
    'type' => 'write',
    'name' => 'Create Redis instance',
    'description' => 'Create a new Redis instance. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'create-redis',
    'method' => 'POST',
    'path' => '/redis',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_redis' =>
  array (
    'slug' => 'render_retrieve_redis',
    'class' => 'RenderRetrieveRedis',
    'type' => 'read',
    'name' => 'Retrieve Redis instance',
    'description' => 'Retrieve a Redis instance by ID. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'retrieve-redis',
    'method' => 'GET',
    'path' => '/redis/{redisId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'redisId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_redis' =>
  array (
    'slug' => 'render_update_redis',
    'class' => 'RenderUpdateRedis',
    'type' => 'write',
    'name' => 'Update Redis instance',
    'description' => 'Update a Redis instance by ID. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'update-redis',
    'method' => 'PATCH',
    'path' => '/redis/{redisId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'redisId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_redis' =>
  array (
    'slug' => 'render_delete_redis',
    'class' => 'RenderDeleteRedis',
    'type' => 'write',
    'name' => 'Delete Redis instance',
    'description' => 'Delete a Redis instance by ID. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'delete-redis',
    'method' => 'DELETE',
    'path' => '/redis/{redisId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'redisId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_redis_connection_info' =>
  array (
    'slug' => 'render_retrieve_redis_connection_info',
    'class' => 'RenderRetrieveRedisConnectionInfo',
    'type' => 'read',
    'name' => 'Retrieve Redis connection info',
    'description' => 'Retrieve connection info for a Redis instance by ID. Connection info includes sensitive information. This API is deprecated in favor of the Key Value API.',
    'operation_id' => 'retrieve-redis-connection-info',
    'method' => 'GET',
    'path' => '/redis/{redisId}/connection-info',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'redisId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_postgres' =>
  array (
    'slug' => 'render_list_postgres',
    'class' => 'RenderListPostgres',
    'type' => 'read',
    'name' => 'List Postgres instances',
    'description' => 'List Postgres instances matching the provided filters. If no filters are provided, all Postgres instances are returned.',
    'operation_id' => 'list-postgres',
    'method' => 'GET',
    'path' => '/postgres',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'region',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by resource region',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'suspended',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources based on whether they\'re suspended or not suspended',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'includeReplicas',
        'in' => 'query',
        'required' => false,
        'description' => 'Include replicas in the response',
        'schema_type' => 'boolean',
      ),
      10 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_postgres' =>
  array (
    'slug' => 'render_create_postgres',
    'class' => 'RenderCreatePostgres',
    'type' => 'write',
    'name' => 'Create Postgres instance',
    'description' => 'Create a new Postgres instance.',
    'operation_id' => 'create-postgres',
    'method' => 'POST',
    'path' => '/postgres',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_postgres' =>
  array (
    'slug' => 'render_retrieve_postgres',
    'class' => 'RenderRetrievePostgres',
    'type' => 'read',
    'name' => 'Retrieve Postgres instance',
    'description' => 'Retrieve a Postgres instance by ID.',
    'operation_id' => 'retrieve-postgres',
    'method' => 'GET',
    'path' => '/postgres/{postgresId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_postgres' =>
  array (
    'slug' => 'render_update_postgres',
    'class' => 'RenderUpdatePostgres',
    'type' => 'write',
    'name' => 'Update Postgres instance',
    'description' => 'Update a Postgres instance by ID.',
    'operation_id' => 'update-postgres',
    'method' => 'PATCH',
    'path' => '/postgres/{postgresId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_postgres' =>
  array (
    'slug' => 'render_delete_postgres',
    'class' => 'RenderDeletePostgres',
    'type' => 'write',
    'name' => 'Delete Postgres instance',
    'description' => 'Delete a Postgres instance by ID. This operation is irreversible, and all data will be lost.',
    'operation_id' => 'delete-postgres',
    'method' => 'DELETE',
    'path' => '/postgres/{postgresId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_postgres_connection_info' =>
  array (
    'slug' => 'render_retrieve_postgres_connection_info',
    'class' => 'RenderRetrievePostgresConnectionInfo',
    'type' => 'read',
    'name' => 'Retrieve Postgres connection info',
    'description' => 'Retrieve connection info for a Postgres instance by ID. Connection info includes sensitive information.',
    'operation_id' => 'retrieve-postgres-connection-info',
    'method' => 'GET',
    'path' => '/postgres/{postgresId}/connection-info',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_postgres_recovery_info' =>
  array (
    'slug' => 'render_retrieve_postgres_recovery_info',
    'class' => 'RenderRetrievePostgresRecoveryInfo',
    'type' => 'read',
    'name' => 'Retrieve point-in-time recovery status',
    'description' => 'Retrieve information on the availability of Postgres point-in-time recovery for a Postgres instance by ID.',
    'operation_id' => 'retrieve-postgres-recovery-info',
    'method' => 'GET',
    'path' => '/postgres/{postgresId}/recovery',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_recover_postgres' =>
  array (
    'slug' => 'render_recover_postgres',
    'class' => 'RenderRecoverPostgres',
    'type' => 'write',
    'name' => 'Trigger point-in-time recovery',
    'description' => 'Trigger [point-in-time recovery](https://render.com/docs/postgresql-backups) on the Postgres instance with the provided ID.',
    'operation_id' => 'recover-postgres',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/recovery',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_suspend_postgres' =>
  array (
    'slug' => 'render_suspend_postgres',
    'class' => 'RenderSuspendPostgres',
    'type' => 'write',
    'name' => 'Suspend Postgres instance',
    'description' => 'Suspend a Postgres instance by ID.',
    'operation_id' => 'suspend-postgres',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/suspend',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_resume_postgres' =>
  array (
    'slug' => 'render_resume_postgres',
    'class' => 'RenderResumePostgres',
    'type' => 'write',
    'name' => 'Resume Postgres instance',
    'description' => 'Resume a Postgres instance by ID.',
    'operation_id' => 'resume-postgres',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/resume',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_restart_postgres' =>
  array (
    'slug' => 'render_restart_postgres',
    'class' => 'RenderRestartPostgres',
    'type' => 'write',
    'name' => 'Restart Postgres instance',
    'description' => 'Restart a Postgres instance by ID.',
    'operation_id' => 'restart-postgres',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/restart',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_failover_postgres' =>
  array (
    'slug' => 'render_failover_postgres',
    'class' => 'RenderFailoverPostgres',
    'type' => 'write',
    'name' => 'Failover Postgres instance',
    'description' => 'Failover a [highly available Postgres](https://render.com/docs/postgresql-high-availability) instance.',
    'operation_id' => 'failover-postgres',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/failover',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_postgres_export' =>
  array (
    'slug' => 'render_list_postgres_export',
    'class' => 'RenderListPostgresExport',
    'type' => 'read',
    'name' => 'List Postgres exports',
    'description' => 'List [exports](https://render.com/docs/postgresql-backups#logical-backups) for a Postgres instance by ID. Returns a URL to download the export.',
    'operation_id' => 'list-postgres-export',
    'method' => 'GET',
    'path' => '/postgres/{postgresId}/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_postgres_export' =>
  array (
    'slug' => 'render_create_postgres_export',
    'class' => 'RenderCreatePostgresExport',
    'type' => 'write',
    'name' => 'Create Postgres export',
    'description' => 'Create an [export](https://render.com/docs/postgresql-backups#logical-backups) of a Postgres instance by ID.',
    'operation_id' => 'create-postgres-export',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/export',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_postgres_users' =>
  array (
    'slug' => 'render_list_postgres_users',
    'class' => 'RenderListPostgresUsers',
    'type' => 'read',
    'name' => 'List PostgreSQL Users',
    'description' => 'List PostgreSQL users for the Render Postgres instance with the provided ID.',
    'operation_id' => 'list-postgres-users',
    'method' => 'GET',
    'path' => '/postgres/{postgresId}/credentials',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_postgres_user' =>
  array (
    'slug' => 'render_create_postgres_user',
    'class' => 'RenderCreatePostgresUser',
    'type' => 'write',
    'name' => 'Create PostgreSQL User',
    'description' => 'Create a new PostgreSQL user for the Render Postgres instance with the provided ID. This becomes the database\'s new "default" user.',
    'operation_id' => 'create-postgres-user',
    'method' => 'POST',
    'path' => '/postgres/{postgresId}/credentials',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_postgres_user' =>
  array (
    'slug' => 'render_delete_postgres_user',
    'class' => 'RenderDeletePostgresUser',
    'type' => 'write',
    'name' => 'Delete PostgreSQL User',
    'description' => 'Delete a PostgreSQL user from the Render Postgres instance with the provided ID.',
    'operation_id' => 'delete-postgres-user',
    'method' => 'DELETE',
    'path' => '/postgres/{postgresId}/credentials/{username}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'postgresId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_projects' =>
  array (
    'slug' => 'render_list_projects',
    'class' => 'RenderListProjects',
    'type' => 'read',
    'name' => 'List projects',
    'description' => 'List projects matching the provided filters. If no filters are provided, all projects are returned.',
    'operation_id' => 'list-projects',
    'method' => 'GET',
    'path' => '/projects',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_project' =>
  array (
    'slug' => 'render_create_project',
    'class' => 'RenderCreateProject',
    'type' => 'write',
    'name' => 'Create project',
    'description' => 'Create a new project.',
    'operation_id' => 'create-project',
    'method' => 'POST',
    'path' => '/projects',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_project' =>
  array (
    'slug' => 'render_retrieve_project',
    'class' => 'RenderRetrieveProject',
    'type' => 'read',
    'name' => 'Retrieve Project',
    'description' => 'Retrieve the project with the provided ID.',
    'operation_id' => 'retrieve-project',
    'method' => 'GET',
    'path' => '/projects/{projectId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'projectId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_project' =>
  array (
    'slug' => 'render_update_project',
    'class' => 'RenderUpdateProject',
    'type' => 'write',
    'name' => 'Update project',
    'description' => 'Update the details of a project. To update the details of a particular _environment_ in the project, instead use the [Update environment](https://api-docs.render.com/reference/update-environment) endpoint.',
    'operation_id' => 'update-project',
    'method' => 'PATCH',
    'path' => '/projects/{projectId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'projectId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_project' =>
  array (
    'slug' => 'render_delete_project',
    'class' => 'RenderDeleteProject',
    'type' => 'write',
    'name' => 'Delete project',
    'description' => 'Delete the project with the provided ID. Requires _all_ of the project\'s environments to be empty (i.e., they must contain no services or other resources). Otherwise, deletion fails with a `409` response. To delete a non-empty project, do one of the following: - First move or delete all contained services and other resources. - Delete the project in the [Render Dashboard](https://dashboard.rend...',
    'operation_id' => 'delete-project',
    'method' => 'DELETE',
    'path' => '/projects/{projectId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'projectId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_environment' =>
  array (
    'slug' => 'render_create_environment',
    'class' => 'RenderCreateEnvironment',
    'type' => 'write',
    'name' => 'Create environment',
    'description' => 'Create a new environment belonging to the project with the provided ID.',
    'operation_id' => 'create-environment',
    'method' => 'POST',
    'path' => '/environments',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_environments' =>
  array (
    'slug' => 'render_list_environments',
    'class' => 'RenderListEnvironments',
    'type' => 'read',
    'name' => 'List environments',
    'description' => 'List a particular project\'s environments matching the provided filters. If no filters are provided, all environments are returned.',
    'operation_id' => 'list-environments',
    'method' => 'GET',
    'path' => '/environments',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'projectId',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter for resources that belong to a project',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_environment' =>
  array (
    'slug' => 'render_retrieve_environment',
    'class' => 'RenderRetrieveEnvironment',
    'type' => 'read',
    'name' => 'Retrieve environment',
    'description' => 'Retrieve the environment with the provided ID.',
    'operation_id' => 'retrieve-environment',
    'method' => 'GET',
    'path' => '/environments/{environmentId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'environmentId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_environment' =>
  array (
    'slug' => 'render_update_environment',
    'class' => 'RenderUpdateEnvironment',
    'type' => 'write',
    'name' => 'Update environment',
    'description' => 'Update the details of the environment with the provided ID.',
    'operation_id' => 'update-environment',
    'method' => 'PATCH',
    'path' => '/environments/{environmentId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'environmentId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_environment' =>
  array (
    'slug' => 'render_delete_environment',
    'class' => 'RenderDeleteEnvironment',
    'type' => 'write',
    'name' => 'Delete environment',
    'description' => 'Delete the environment with the provided ID. Requires the environment to be empty (i.e., it must contain no services or other resources). Otherwise, deletion fails with a `409` response. To delete a non-empty environment, do one of the following: - First move or delete all contained services and other resources. - Delete the environment in the [Render Dashboard](https://dashboard.render.com).',
    'operation_id' => 'delete-environment',
    'method' => 'DELETE',
    'path' => '/environments/{environmentId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'environmentId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_add_resources_to_environment' =>
  array (
    'slug' => 'render_add_resources_to_environment',
    'class' => 'RenderAddResourcesToEnvironment',
    'type' => 'write',
    'name' => 'Add resources to environment',
    'description' => 'Add resources to the environment with the provided ID.',
    'operation_id' => 'add-resources-to-environment',
    'method' => 'POST',
    'path' => '/environments/{environmentId}/resources',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'environmentId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_remove_resources_from_environment' =>
  array (
    'slug' => 'render_remove_resources_from_environment',
    'class' => 'RenderRemoveResourcesFromEnvironment',
    'type' => 'write',
    'name' => 'Remove resources from environment',
    'description' => 'Remove resources from the environment with the provided ID.',
    'operation_id' => 'remove-resources-from-environment',
    'method' => 'DELETE',
    'path' => '/environments/{environmentId}/resources',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'environmentId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resourceIds',
        'in' => 'query',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_env_groups' =>
  array (
    'slug' => 'render_list_env_groups',
    'class' => 'RenderListEnvGroups',
    'type' => 'read',
    'name' => 'List environment groups',
    'description' => 'List environment groups matching the provided filters. If no filters are provided, all environment groups are returned.',
    'operation_id' => 'list-env-groups',
    'method' => 'GET',
    'path' => '/env-groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'createdBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'createdAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources created after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'updatedBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated before a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'updatedAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources updated after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_env_group' =>
  array (
    'slug' => 'render_create_env_group',
    'class' => 'RenderCreateEnvGroup',
    'type' => 'write',
    'name' => 'Create environment group',
    'description' => 'Create a new environment group.',
    'operation_id' => 'create-env-group',
    'method' => 'POST',
    'path' => '/env-groups',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_retrieve_env_group' =>
  array (
    'slug' => 'render_retrieve_env_group',
    'class' => 'RenderRetrieveEnvGroup',
    'type' => 'read',
    'name' => 'Retrieve environment group',
    'description' => 'Retrieve an environment group by ID.',
    'operation_id' => 'retrieve-env-group',
    'method' => 'GET',
    'path' => '/env-groups/{envGroupId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_env_group' =>
  array (
    'slug' => 'render_update_env_group',
    'class' => 'RenderUpdateEnvGroup',
    'type' => 'write',
    'name' => 'Update environment group',
    'description' => 'Update the attributes of an environment group.',
    'operation_id' => 'update-env-group',
    'method' => 'PATCH',
    'path' => '/env-groups/{envGroupId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_env_group' =>
  array (
    'slug' => 'render_delete_env_group',
    'class' => 'RenderDeleteEnvGroup',
    'type' => 'write',
    'name' => 'Delete environment group',
    'description' => 'Delete the environment group with the provided ID, including all environment variables and secret files it contains.',
    'operation_id' => 'delete-env-group',
    'method' => 'DELETE',
    'path' => '/env-groups/{envGroupId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_link_service_to_env_group' =>
  array (
    'slug' => 'render_link_service_to_env_group',
    'class' => 'RenderLinkServiceToEnvGroup',
    'type' => 'write',
    'name' => 'Link service',
    'description' => 'Link a particular service to a particular environment group. The linked service will have access to the environment variables and secret files in the group.',
    'operation_id' => 'link-service-to-env-group',
    'method' => 'POST',
    'path' => '/env-groups/{envGroupId}/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_unlink_service_from_env_group' =>
  array (
    'slug' => 'render_unlink_service_from_env_group',
    'class' => 'RenderUnlinkServiceFromEnvGroup',
    'type' => 'write',
    'name' => 'Unlink service',
    'description' => 'Unlink a particular service from a particular environment group. The service will lose access to the environment variables and secret files in the group.',
    'operation_id' => 'unlink-service-from-env-group',
    'method' => 'DELETE',
    'path' => '/env-groups/{envGroupId}/services/{serviceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'serviceId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_env_group_env_var' =>
  array (
    'slug' => 'render_retrieve_env_group_env_var',
    'class' => 'RenderRetrieveEnvGroupEnvVar',
    'type' => 'read',
    'name' => 'Retrieve environment variable',
    'description' => 'Retrieve a particular environment variable in a particular environment group.',
    'operation_id' => 'retrieve-env-group-env-var',
    'method' => 'GET',
    'path' => '/env-groups/{envGroupId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_env_group_env_var' =>
  array (
    'slug' => 'render_update_env_group_env_var',
    'class' => 'RenderUpdateEnvGroupEnvVar',
    'type' => 'write',
    'name' => 'Add or update environment variable',
    'description' => 'Add or update a particular environment variable in a particular environment group.',
    'operation_id' => 'update-env-group-env-var',
    'method' => 'PUT',
    'path' => '/env-groups/{envGroupId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_env_group_env_var' =>
  array (
    'slug' => 'render_delete_env_group_env_var',
    'class' => 'RenderDeleteEnvGroupEnvVar',
    'type' => 'write',
    'name' => 'Remove environment variable',
    'description' => 'Remove a particular environment variable from a particular environment group.',
    'operation_id' => 'delete-env-group-env-var',
    'method' => 'DELETE',
    'path' => '/env-groups/{envGroupId}/env-vars/{envVarKey}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'envVarKey',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the environment variable',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_env_group_secret_file' =>
  array (
    'slug' => 'render_retrieve_env_group_secret_file',
    'class' => 'RenderRetrieveEnvGroupSecretFile',
    'type' => 'read',
    'name' => 'Retrieve secret file',
    'description' => 'Retrieve a particular secret file in a particular environment group.',
    'operation_id' => 'retrieve-env-group-secret-file',
    'method' => 'GET',
    'path' => '/env-groups/{envGroupId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the secret file',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_env_group_secret_file' =>
  array (
    'slug' => 'render_update_env_group_secret_file',
    'class' => 'RenderUpdateEnvGroupSecretFile',
    'type' => 'write',
    'name' => 'Add or update secret file',
    'description' => 'Add or update a particular secret file in an particular environment group.',
    'operation_id' => 'update-env-group-secret-file',
    'method' => 'PUT',
    'path' => '/env-groups/{envGroupId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_env_group_secret_file' =>
  array (
    'slug' => 'render_delete_env_group_secret_file',
    'class' => 'RenderDeleteEnvGroupSecretFile',
    'type' => 'write',
    'name' => 'Remove secret file',
    'description' => 'Remove a particular secret file from a particular environment group.',
    'operation_id' => 'delete-env-group-secret-file',
    'method' => 'DELETE',
    'path' => '/env-groups/{envGroupId}/secret-files/{secretFileName}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'envGroupId',
        'in' => 'path',
        'required' => true,
        'description' => 'Filter for resources that belong to an environment group',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'secretFileName',
        'in' => 'path',
        'required' => true,
        'description' => 'The name of the secret file',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_maintenance' =>
  array (
    'slug' => 'render_list_maintenance',
    'class' => 'RenderListMaintenance',
    'type' => 'read',
    'name' => 'List maintenance runs',
    'description' => 'List scheduled and/or recent maintenance runs for specified resources.',
    'operation_id' => 'list-maintenance',
    'method' => 'GET',
    'path' => '/maintenance',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resourceId',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'state',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_maintenance' =>
  array (
    'slug' => 'render_retrieve_maintenance',
    'class' => 'RenderRetrieveMaintenance',
    'type' => 'read',
    'name' => 'Retrieve maintenance run',
    'description' => 'Retrieve the maintenance run with the provided ID.',
    'operation_id' => 'retrieve-maintenance',
    'method' => 'GET',
    'path' => '/maintenance/{maintenanceRunParam}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'maintenanceRunParam',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Render API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_maintenance' =>
  array (
    'slug' => 'render_update_maintenance',
    'class' => 'RenderUpdateMaintenance',
    'type' => 'write',
    'name' => 'Update maintenance run',
    'description' => 'Update the maintenance run with the provided ID. Updates from this endpoint are asynchronous. To check your update\'s status, use the [Retrieve maintenance run](https://api-docs.render.com/reference/retrieve-maintenance) endpoint.',
    'operation_id' => 'update-maintenance',
    'method' => 'PATCH',
    'path' => '/maintenance/{maintenanceRunParam}',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_trigger_maintenance' =>
  array (
    'slug' => 'render_trigger_maintenance',
    'class' => 'RenderTriggerMaintenance',
    'type' => 'write',
    'name' => 'Trigger maintenance run',
    'description' => 'Trigger the scheduled maintenance run with the provided ID. Triggering maintenance is asynchronous. To check whether maintenance has started, use the [Retrieve maintenance run](https://api-docs.render.com/reference/retrieve-maintenance) endpoint. As maintenance progresses, the run\'s `state` will change from `scheduled` to other values, such as `in_progress` and `succeeded`.',
    'operation_id' => 'trigger-maintenance',
    'method' => 'POST',
    'path' => '/maintenance/{maintenanceRunParam}/trigger',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'render_create_webhook' =>
  array (
    'slug' => 'render_create_webhook',
    'class' => 'RenderCreateWebhook',
    'type' => 'write',
    'name' => 'Create a webhook',
    'description' => 'Create a new webhook.',
    'operation_id' => 'create-webhook',
    'method' => 'POST',
    'path' => '/webhooks',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_list_webhooks' =>
  array (
    'slug' => 'render_list_webhooks',
    'class' => 'RenderListWebhooks',
    'type' => 'read',
    'name' => 'List webhooks',
    'description' => 'List webhooks',
    'operation_id' => 'list-webhooks',
    'method' => 'GET',
    'path' => '/webhooks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_retrieve_webhook' =>
  array (
    'slug' => 'render_retrieve_webhook',
    'class' => 'RenderRetrieveWebhook',
    'type' => 'read',
    'name' => 'Retrieve a webhook',
    'description' => 'Retrieve the webhook with the provided ID',
    'operation_id' => 'retrieve-webhook',
    'method' => 'GET',
    'path' => '/webhooks/{webhookId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'webhookId',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier for the webhook',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_webhook' =>
  array (
    'slug' => 'render_update_webhook',
    'class' => 'RenderUpdateWebhook',
    'type' => 'write',
    'name' => 'Update a webhook',
    'description' => 'Update the webhook with the provided ID.',
    'operation_id' => 'update-webhook',
    'method' => 'PATCH',
    'path' => '/webhooks/{webhookId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'webhookId',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier for the webhook',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_webhook' =>
  array (
    'slug' => 'render_delete_webhook',
    'class' => 'RenderDeleteWebhook',
    'type' => 'write',
    'name' => 'Delete a webhook',
    'description' => 'Delete the webhook with the provided ID.',
    'operation_id' => 'delete-webhook',
    'method' => 'DELETE',
    'path' => '/webhooks/{webhookId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'webhookId',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier for the webhook',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_webhook_events' =>
  array (
    'slug' => 'render_list_webhook_events',
    'class' => 'RenderListWebhookEvents',
    'type' => 'read',
    'name' => 'List webhook events',
    'description' => 'Retrieve a list of events that have been sent to this webhook, with optional filtering by timestamp.',
    'operation_id' => 'list-webhook-events',
    'method' => 'GET',
    'path' => '/webhooks/{webhookId}/events',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sentBefore',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter events sent before this time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sentAfter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources sent after a certain time (specified as an ISO 8601 timestamp)',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_workflows' =>
  array (
    'slug' => 'render_list_workflows',
    'class' => 'RenderListWorkflows',
    'type' => 'read',
    'name' => 'List workflows',
    'description' => 'List workflows that match the provided filters. If no filters are provided, all workflows accessible by the authenticated user are returned.',
    'operation_id' => 'listWorkflows',
    'method' => 'GET',
    'path' => '/workflows',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter by name',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'workflowID',
        'in' => 'query',
        'required' => false,
        'description' => 'The IDs of the workflows to return resources for',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'environmentId',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter for resources that belong to an environment',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_workflow' =>
  array (
    'slug' => 'render_create_workflow',
    'class' => 'RenderCreateWorkflow',
    'type' => 'write',
    'name' => 'Create a workflow',
    'description' => 'Create a new workflow service with the specified configuration.',
    'operation_id' => 'createWorkflow',
    'method' => 'POST',
    'path' => '/workflows',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_workflow' =>
  array (
    'slug' => 'render_get_workflow',
    'class' => 'RenderGetWorkflow',
    'type' => 'read',
    'name' => 'Retrieve workflow',
    'description' => 'Retrieve the workflow service with the provided ID.',
    'operation_id' => 'getWorkflow',
    'method' => 'GET',
    'path' => '/workflows/{workflowId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workflowId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workflow',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_update_workflow' =>
  array (
    'slug' => 'render_update_workflow',
    'class' => 'RenderUpdateWorkflow',
    'type' => 'write',
    'name' => 'Update workflow',
    'description' => 'Update the workflow service with the provided ID.',
    'operation_id' => 'updateWorkflow',
    'method' => 'PATCH',
    'path' => '/workflows/{workflowId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workflowId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workflow',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_delete_workflow' =>
  array (
    'slug' => 'render_delete_workflow',
    'class' => 'RenderDeleteWorkflow',
    'type' => 'write',
    'name' => 'Delete workflow',
    'description' => 'Delete the workflow service with the provided ID.',
    'operation_id' => 'deleteWorkflow',
    'method' => 'DELETE',
    'path' => '/workflows/{workflowId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workflowId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workflow',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_workflow_versions' =>
  array (
    'slug' => 'render_list_workflow_versions',
    'class' => 'RenderListWorkflowVersions',
    'type' => 'read',
    'name' => 'List workflow versions',
    'description' => 'List known versions of the workflow service with the provided ID.',
    'operation_id' => 'listWorkflowVersions',
    'method' => 'GET',
    'path' => '/workflowversions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'workflowID',
        'in' => 'query',
        'required' => false,
        'description' => 'The IDs of the workflows to return resources for',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'workflowVersionId',
        'in' => 'query',
        'required' => false,
        'description' => 'The IDs of the workflow versions to return resources for',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_workflow_version' =>
  array (
    'slug' => 'render_create_workflow_version',
    'class' => 'RenderCreateWorkflowVersion',
    'type' => 'write',
    'name' => 'Deploy a workflow version',
    'description' => 'Creates and deploys a new version of a workflow.',
    'operation_id' => 'createWorkflowVersion',
    'method' => 'POST',
    'path' => '/workflowversions',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_get_workflow_version' =>
  array (
    'slug' => 'render_get_workflow_version',
    'class' => 'RenderGetWorkflowVersion',
    'type' => 'read',
    'name' => 'Retrieve workflow version',
    'description' => 'Retrieve the specific workflow service version with the provided ID.',
    'operation_id' => 'getWorkflowVersion',
    'method' => 'GET',
    'path' => '/workflowversions/{workflowVersionId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workflowVersionId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the workflow version',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_tasks' =>
  array (
    'slug' => 'render_list_tasks',
    'class' => 'RenderListTasks',
    'type' => 'read',
    'name' => 'List tasks',
    'description' => 'List workflow tasks that match the provided filters. If no filters are provided, all task definitions accessible by the authenticated user are returned.',
    'operation_id' => 'listTasks',
    'method' => 'GET',
    'path' => '/tasks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'taskSlug',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of task slugs in the format workflow-slug/task-name. An optional version can be appended (workflow-slug/task-name:version). If no version is provided, the latest version is used.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'workflowVersionId',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of workflow version IDs',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'workflowId',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of workflow IDs',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_task' =>
  array (
    'slug' => 'render_get_task',
    'class' => 'RenderGetTask',
    'type' => 'read',
    'name' => 'Retrieve task',
    'description' => 'Retrieve the workflow task with the provided ID.',
    'operation_id' => 'getTask',
    'method' => 'GET',
    'path' => '/tasks/{taskId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'taskId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the task',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_list_task_runs' =>
  array (
    'slug' => 'render_list_task_runs',
    'class' => 'RenderListTaskRuns',
    'type' => 'read',
    'name' => 'List task runs',
    'description' => 'List task runs that match the provided filters. If no filters are provided, all task runs accessible by the authenticated user are returned.',
    'operation_id' => 'listTaskRuns',
    'method' => 'GET',
    'path' => '/task-runs',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'description' => 'The position in the result list to start from when fetching paginated results. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of items to return. For details, see [Pagination](https://api-docs.render.com/reference/pagination).',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'taskSlug',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of task slugs in the format workflow-slug/task-name. An optional version can be appended (workflow-slug/task-name:version). If no version is provided, the latest version is used.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'rootTaskRunId',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of root task run IDs to filter on',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'ownerId',
        'in' => 'query',
        'required' => false,
        'description' => 'The ID of the workspaces to return resources for',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'workflowVersionId',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of workflow version IDs',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'workflowId',
        'in' => 'query',
        'required' => false,
        'description' => 'An array of workflow IDs',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_create_task' =>
  array (
    'slug' => 'render_create_task',
    'class' => 'RenderCreateTask',
    'type' => 'write',
    'name' => 'Run task',
    'description' => 'Kicks off a run of the workflow task with the provided ID, passing the provided input data.',
    'operation_id' => 'createTask',
    'method' => 'POST',
    'path' => '/task-runs',
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
      'description' => 'Execute the Render API operation.',
    ),
  ),
  'render_stream_task_runs_events' =>
  array (
    'slug' => 'render_stream_task_runs_events',
    'class' => 'RenderStreamTaskRunsEvents',
    'type' => 'read',
    'name' => 'Stream realtime events (SSE)',
    'description' => 'Establishes a unidirectional event stream. The server sends events as lines formatted per the SSE spec. Clients SHOULD set `Accept: text/event-stream` and keep the connection open.',
    'operation_id' => 'streamTaskRunsEvents',
    'method' => 'GET',
    'path' => '/task-runs/events',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'taskRunIds',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter to a subset of task run IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'Accept',
        'in' => 'header',
        'required' => false,
        'description' => 'Must be `text/event-stream`.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_get_task_run' =>
  array (
    'slug' => 'render_get_task_run',
    'class' => 'RenderGetTaskRun',
    'type' => 'read',
    'name' => 'Retrieve task run',
    'description' => 'Retrieve the workflow task run with the provided ID.',
    'operation_id' => 'getTaskRun',
    'method' => 'GET',
    'path' => '/task-runs/{taskRunId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'taskRunId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the task run',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'render_cancel_task_run' =>
  array (
    'slug' => 'render_cancel_task_run',
    'class' => 'RenderCancelTaskRun',
    'type' => 'write',
    'name' => 'Cancel task run',
    'description' => 'Cancel a running task run with the provided ID.',
    'operation_id' => 'cancelTaskRun',
    'method' => 'DELETE',
    'path' => '/task-runs/{taskRunId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'taskRunId',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the task run',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
);
    }
}
