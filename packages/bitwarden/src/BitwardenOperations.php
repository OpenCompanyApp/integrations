<?php

namespace OpenCompany\Integrations\Bitwarden;

/**
 * Official Bitwarden Public API operation metadata.
 *
 * Generated from the OAS3 payload published on Bitwarden's official API page.
 */
class BitwardenOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'bitwarden_collections_get' =>
  array (
    'slug' => 'bitwarden_collections_get',
    'class' => 'BitwardenCollectionsGet',
    'method' => 'GET',
    'path' => '/public/collections/{id}',
    'operation_id' => 'Collections_Get',
    'name' => 'Retrieve a collection.',
    'description' => 'Retrieves the details of an existing collection. You need only supply the unique collection identifier that was returned upon collection creation.',
    'type' => 'read',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the collection to be retrieved.',
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
  ),
  'bitwarden_collections_put' =>
  array (
    'slug' => 'bitwarden_collections_put',
    'class' => 'BitwardenCollectionsPut',
    'method' => 'PUT',
    'path' => '/public/collections/{id}',
    'operation_id' => 'Collections_Put',
    'name' => 'Update a collection.',
    'description' => 'Updates the specified collection object. If a property is not provided, the value of the existing property will be reset.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the collection to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_collections_delete' =>
  array (
    'slug' => 'bitwarden_collections_delete',
    'class' => 'BitwardenCollectionsDelete',
    'method' => 'DELETE',
    'path' => '/public/collections/{id}',
    'operation_id' => 'Collections_Delete',
    'name' => 'Delete a collection.',
    'description' => 'Permanently deletes a collection. This cannot be undone.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the collection to be deleted.',
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
  ),
  'bitwarden_collections_list' =>
  array (
    'slug' => 'bitwarden_collections_list',
    'class' => 'BitwardenCollectionsList',
    'method' => 'GET',
    'path' => '/public/collections',
    'operation_id' => 'Collections_List',
    'name' => 'List all collections.',
    'description' => 'Returns a list of your organization\'s collections. Collection objects listed in this call do not include information about their associated groups.',
    'type' => 'read',
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
  ),
  'bitwarden_events_list' =>
  array (
    'slug' => 'bitwarden_events_list',
    'class' => 'BitwardenEventsList',
    'method' => 'GET',
    'path' => '/public/events',
    'operation_id' => 'Events_List',
    'name' => 'List all events.',
    'description' => 'Returns a filtered list of your organization\'s event logs, paged by a continuation token. If no filters are provided, it will return the last 30 days of event for the organization.',
    'type' => 'read',
    'parameters' =>
    array (
      'start' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The start date. Must be less than the end date.',
      ),
      'end' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The end date. Must be greater than the start date.',
      ),
      'acting_user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the user that performed the event.',
      ),
      'item_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the related item that the event describes.',
      ),
      'secret_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the related secret that the event describes.',
      ),
      'project_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the related project that the event describes.',
      ),
      'continuation_token' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A cursor for use in pagination.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'start' => 'start',
      'end' => 'end',
      'actingUserId' => 'acting_user_id',
      'itemId' => 'item_id',
      'secretId' => 'secret_id',
      'projectId' => 'project_id',
      'continuationToken' => 'continuation_token',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'bitwarden_groups_get' =>
  array (
    'slug' => 'bitwarden_groups_get',
    'class' => 'BitwardenGroupsGet',
    'method' => 'GET',
    'path' => '/public/groups/{id}',
    'operation_id' => 'Groups_Get',
    'name' => 'Retrieve a group.',
    'description' => 'Retrieves the details of an existing group. You need only supply the unique group identifier that was returned upon group creation.',
    'type' => 'read',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the group to be retrieved.',
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
  ),
  'bitwarden_groups_put' =>
  array (
    'slug' => 'bitwarden_groups_put',
    'class' => 'BitwardenGroupsPut',
    'method' => 'PUT',
    'path' => '/public/groups/{id}',
    'operation_id' => 'Groups_Put',
    'name' => 'Update a group.',
    'description' => 'Updates the specified group object. If a property is not provided, the value of the existing property will be reset.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the group to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_groups_delete' =>
  array (
    'slug' => 'bitwarden_groups_delete',
    'class' => 'BitwardenGroupsDelete',
    'method' => 'DELETE',
    'path' => '/public/groups/{id}',
    'operation_id' => 'Groups_Delete',
    'name' => 'Delete a group.',
    'description' => 'Permanently deletes a group. This cannot be undone.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the group to be deleted.',
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
  ),
  'bitwarden_groups_get_member_ids' =>
  array (
    'slug' => 'bitwarden_groups_get_member_ids',
    'class' => 'BitwardenGroupsGetMemberIds',
    'method' => 'GET',
    'path' => '/public/groups/{id}/member-ids',
    'operation_id' => 'Groups_GetMemberIds',
    'name' => 'Retrieve a groups\'s member ids',
    'description' => 'Retrieves the unique identifiers for all members that are associated with this group. You need only supply the unique group identifier that was returned upon group creation.',
    'type' => 'read',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the group to be retrieved.',
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
  ),
  'bitwarden_groups_put_member_ids' =>
  array (
    'slug' => 'bitwarden_groups_put_member_ids',
    'class' => 'BitwardenGroupsPutMemberIds',
    'method' => 'PUT',
    'path' => '/public/groups/{id}/member-ids',
    'operation_id' => 'Groups_PutMemberIds',
    'name' => 'Update a group\'s members.',
    'description' => 'Updates the specified group\'s member associations.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the group to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_groups_list' =>
  array (
    'slug' => 'bitwarden_groups_list',
    'class' => 'BitwardenGroupsList',
    'method' => 'GET',
    'path' => '/public/groups',
    'operation_id' => 'Groups_List',
    'name' => 'List all groups.',
    'description' => 'Returns a list of your organization\'s groups. Group objects listed in this call include information about their associated collections.',
    'type' => 'read',
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
  ),
  'bitwarden_groups_post' =>
  array (
    'slug' => 'bitwarden_groups_post',
    'class' => 'BitwardenGroupsPost',
    'method' => 'POST',
    'path' => '/public/groups',
    'operation_id' => 'Groups_Post',
    'name' => 'Create a group.',
    'description' => 'Creates a new group object.',
    'type' => 'write',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_members_get' =>
  array (
    'slug' => 'bitwarden_members_get',
    'class' => 'BitwardenMembersGet',
    'method' => 'GET',
    'path' => '/public/members/{id}',
    'operation_id' => 'Members_Get',
    'name' => 'Retrieve a member.',
    'description' => 'Retrieves the details of an existing member of the organization. You need only supply the unique member identifier that was returned upon member creation.',
    'type' => 'read',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be retrieved.',
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
  ),
  'bitwarden_members_put' =>
  array (
    'slug' => 'bitwarden_members_put',
    'class' => 'BitwardenMembersPut',
    'method' => 'PUT',
    'path' => '/public/members/{id}',
    'operation_id' => 'Members_Put',
    'name' => 'Update a member.',
    'description' => 'Updates the specified member object. If a property is not provided, the value of the existing property will be reset.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_members_remove' =>
  array (
    'slug' => 'bitwarden_members_remove',
    'class' => 'BitwardenMembersRemove',
    'method' => 'DELETE',
    'path' => '/public/members/{id}',
    'operation_id' => 'Members_Remove',
    'name' => 'Remove a member.',
    'description' => 'Removes a member from the organization. This cannot be undone. The user account will still remain.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be removed.',
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
  ),
  'bitwarden_members_get_group_ids' =>
  array (
    'slug' => 'bitwarden_members_get_group_ids',
    'class' => 'BitwardenMembersGetGroupIds',
    'method' => 'GET',
    'path' => '/public/members/{id}/group-ids',
    'operation_id' => 'Members_GetGroupIds',
    'name' => 'Retrieve a member\'s group ids',
    'description' => 'Retrieves the unique identifiers for all groups that are associated with this member. You need only supply the unique member identifier that was returned upon member creation.',
    'type' => 'read',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be retrieved.',
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
  ),
  'bitwarden_members_put_group_ids' =>
  array (
    'slug' => 'bitwarden_members_put_group_ids',
    'class' => 'BitwardenMembersPutGroupIds',
    'method' => 'PUT',
    'path' => '/public/members/{id}/group-ids',
    'operation_id' => 'Members_PutGroupIds',
    'name' => 'Update a member\'s groups.',
    'description' => 'Updates the specified member\'s group associations.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_members_list' =>
  array (
    'slug' => 'bitwarden_members_list',
    'class' => 'BitwardenMembersList',
    'method' => 'GET',
    'path' => '/public/members',
    'operation_id' => 'Members_List',
    'name' => 'List all members.',
    'description' => 'Returns a list of your organization\'s members. Member objects listed in this call include information about their associated collections.',
    'type' => 'read',
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
  ),
  'bitwarden_members_post' =>
  array (
    'slug' => 'bitwarden_members_post',
    'class' => 'BitwardenMembersPost',
    'method' => 'POST',
    'path' => '/public/members',
    'operation_id' => 'Members_Post',
    'name' => 'Create a member.',
    'description' => 'Creates a new member object by inviting a user to the organization.',
    'type' => 'write',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_members_post_reinvite' =>
  array (
    'slug' => 'bitwarden_members_post_reinvite',
    'class' => 'BitwardenMembersPostReinvite',
    'method' => 'POST',
    'path' => '/public/members/{id}/reinvite',
    'operation_id' => 'Members_PostReinvite',
    'name' => 'Re-invite a member.',
    'description' => 'Re-sends the invitation email to an organization member.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to re-invite.',
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
  ),
  'bitwarden_members_revoke' =>
  array (
    'slug' => 'bitwarden_members_revoke',
    'class' => 'BitwardenMembersRevoke',
    'method' => 'POST',
    'path' => '/public/members/{id}/revoke',
    'operation_id' => 'Members_Revoke',
    'name' => 'Revoke a member\'s access to an organization.',
    'description' => 'Revoke a member\'s access to an organization.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the member to be revoked.',
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
  ),
  'bitwarden_members_restore' =>
  array (
    'slug' => 'bitwarden_members_restore',
    'class' => 'BitwardenMembersRestore',
    'method' => 'POST',
    'path' => '/public/members/{id}/restore',
    'operation_id' => 'Members_Restore',
    'name' => 'Restore a member.',
    'description' => 'Restores a previously revoked member of the organization.',
    'type' => 'write',
    'parameters' =>
    array (
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the member to be restored.',
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
  ),
  'bitwarden_organization_get_subscription' =>
  array (
    'slug' => 'bitwarden_organization_get_subscription',
    'class' => 'BitwardenOrganizationGetSubscription',
    'method' => 'GET',
    'path' => '/public/organization/subscription',
    'operation_id' => 'Organization_GetSubscription',
    'name' => 'Retrieves the subscription details for the current organization.',
    'description' => 'Retrieves the subscription details for the current organization.',
    'type' => 'read',
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
  ),
  'bitwarden_organization_post_subscription' =>
  array (
    'slug' => 'bitwarden_organization_post_subscription',
    'class' => 'BitwardenOrganizationPostSubscription',
    'method' => 'PUT',
    'path' => '/public/organization/subscription',
    'operation_id' => 'Organization_PostSubscription',
    'name' => 'Update the organization\'s current subscription for Password Manager and/or Secrets Manager.',
    'description' => 'Update the organization\'s current subscription for Password Manager and/or Secrets Manager.',
    'type' => 'write',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_organization_import' =>
  array (
    'slug' => 'bitwarden_organization_import',
    'class' => 'BitwardenOrganizationImport',
    'method' => 'POST',
    'path' => '/public/organization/import',
    'operation_id' => 'Organization_Import',
    'name' => 'Import members and groups.',
    'description' => 'Import members and groups from an external system.',
    'type' => 'write',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
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
  ),
  'bitwarden_policies_get' =>
  array (
    'slug' => 'bitwarden_policies_get',
    'class' => 'BitwardenPoliciesGet',
    'method' => 'GET',
    'path' => '/public/policies/{type}',
    'operation_id' => 'Policies_Get',
    'name' => 'Retrieve a policy.',
    'description' => 'Retrieves the details of a policy.',
    'type' => 'read',
    'parameters' =>
    array (
      'type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The type of policy to be retrieved.',
      ),
    ),
    'path_params' =>
    array (
      'type' => 'type',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'bitwarden_policies_put' =>
  array (
    'slug' => 'bitwarden_policies_put',
    'class' => 'BitwardenPoliciesPut',
    'method' => 'PUT',
    'path' => '/public/policies/{type}',
    'operation_id' => 'Policies_Put',
    'name' => 'Update a policy.',
    'description' => 'Updates the specified policy. If a property is not provided, the value of the existing property will be reset.',
    'type' => 'write',
    'parameters' =>
    array (
      'type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The type of policy to be updated.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
      ),
    ),
    'path_params' =>
    array (
      'type' => 'type',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'bitwarden_policies_list' =>
  array (
    'slug' => 'bitwarden_policies_list',
    'class' => 'BitwardenPoliciesList',
    'method' => 'GET',
    'path' => '/public/policies',
    'operation_id' => 'Policies_List',
    'name' => 'List all policies.',
    'description' => 'Returns a list of your organization\'s policies.',
    'type' => 'read',
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
  ),
);
    }
}
