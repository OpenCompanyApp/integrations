<?php

namespace OpenCompany\Integrations\CockroachDb;

/**
 * Official CockroachDB Cloud OpenAPI operation metadata.
 *
 * Generated from CockroachDB Cloud's published OpenAPI document.
 */
final class CockroachDbOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'cockroachdb_get_groups' =>
  array (
    'slug' => 'cockroachdb_get_groups',
    'class' => 'CockroachDbGetGroups',
    'type' => 'read',
    'name' => 'List groups',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetGroups',
    'method' => 'GET',
    'path' => '/api/scim/v2/Groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'count',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of resources to return. If omitted, defaults to 20. If set to 0, the response will contain no resources but will include metadata such as `totalResults`, complying with [RFC 7644, Section 3.4.2.4: Pagination](https://datatracker.ietf.org/doc/html/rfc7644#section-3.4.2.4).',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'startIndex',
        'in' => 'query',
        'required' => false,
        'description' => 'The 1-based index of the first resource to return in the response. If omitted or less than 1, defaults to 1. This behavior complies with [RFC 7644, Section 3.4.2.4: Pagination](https://datatracker.ietf.org/doc/html/rfc7644#section-3.4.2.4).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_group' =>
  array (
    'slug' => 'cockroachdb_create_group',
    'class' => 'CockroachDbCreateGroup',
    'type' => 'write',
    'name' => 'Create a group',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_CreateGroup',
    'method' => 'POST',
    'path' => '/api/scim/v2/Groups',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_search_groups' =>
  array (
    'slug' => 'cockroachdb_search_groups',
    'class' => 'CockroachDbSearchGroups',
    'type' => 'write',
    'name' => 'Search groups',
    'description' => 'Similar to GetGroups however search parameters are passed via the POST body. See https://www.rfc-editor.org/rfc/rfc7644.html#section-3.4.3 for more details. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_SearchGroups',
    'method' => 'POST',
    'path' => '/api/scim/v2/Groups/.search',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_groups2' =>
  array (
    'slug' => 'cockroachdb_get_groups2',
    'class' => 'CockroachDbGetGroups2',
    'type' => 'write',
    'name' => 'Search groups (Deprecated)',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetGroups2',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Groups/.search',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_group' =>
  array (
    'slug' => 'cockroachdb_get_group',
    'class' => 'CockroachDbGetGroup',
    'type' => 'read',
    'name' => 'Get a group by ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetGroup',
    'method' => 'GET',
    'path' => '/api/scim/v2/Groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_group' =>
  array (
    'slug' => 'cockroachdb_update_group',
    'class' => 'CockroachDbUpdateGroup',
    'type' => 'write',
    'name' => 'Update a group by supplying all values of the user object',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateGroup',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_patch_group' =>
  array (
    'slug' => 'cockroachdb_patch_group',
    'class' => 'CockroachDbPatchGroup',
    'type' => 'write',
    'name' => 'Patch a group by supplying partial updates',
    'description' => 'Apply a sequence of operations to modify attributes of a SCIM Group resource. Supports \'add\', \'remove\', and \'replace\' operations per RFC 7644 Section 3.5.2. Operations are applied atomically - if any operation fails, no changes are applied. The request body must include the \'schemas\' field set to \'urn:ietf:params:scim:api:messages:2.0:PatchOp\'. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_PatchGroup',
    'method' => 'PATCH',
    'path' => '/api/scim/v2/Groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_group' =>
  array (
    'slug' => 'cockroachdb_delete_group',
    'class' => 'CockroachDbDeleteGroup',
    'type' => 'write',
    'name' => 'Delete a group based on ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteGroup',
    'method' => 'DELETE',
    'path' => '/api/scim/v2/Groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_search_group' =>
  array (
    'slug' => 'cockroachdb_search_group',
    'class' => 'CockroachDbSearchGroup',
    'type' => 'write',
    'name' => 'Search a group by ID',
    'description' => 'Similar to GetGroup however search parameters are passed via the POST body. See https://www.rfc-editor.org/rfc/rfc7644.html#section-3.4.3 for more details. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_SearchGroup',
    'method' => 'POST',
    'path' => '/api/scim/v2/Groups/{id}/.search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_group2' =>
  array (
    'slug' => 'cockroachdb_get_group2',
    'class' => 'CockroachDbGetGroup2',
    'type' => 'write',
    'name' => 'Search a group by ID (Deprecated)',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetGroup2',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Groups/{id}/.search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_resource_types' =>
  array (
    'slug' => 'cockroachdb_get_resource_types',
    'class' => 'CockroachDbGetResourceTypes',
    'type' => 'read',
    'name' => 'List the SCIM resource types',
    'description' => 'This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_GetResourceTypes',
    'method' => 'GET',
    'path' => '/api/scim/v2/ResourceTypes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_resource_type' =>
  array (
    'slug' => 'cockroachdb_get_resource_type',
    'class' => 'CockroachDbGetResourceType',
    'type' => 'read',
    'name' => 'Get a SCIM resource type by ID',
    'description' => 'This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_GetResourceType',
    'method' => 'GET',
    'path' => '/api/scim/v2/ResourceTypes/{resourceId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resourceId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_schemas' =>
  array (
    'slug' => 'cockroachdb_get_schemas',
    'class' => 'CockroachDbGetSchemas',
    'type' => 'read',
    'name' => 'List the SCIM schemas',
    'description' => 'This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_GetSchemas',
    'method' => 'GET',
    'path' => '/api/scim/v2/Schemas',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_schema' =>
  array (
    'slug' => 'cockroachdb_get_schema',
    'class' => 'CockroachDbGetSchema',
    'type' => 'read',
    'name' => 'Get a SCIM schema by ID',
    'description' => 'This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_GetSchema',
    'method' => 'GET',
    'path' => '/api/scim/v2/Schemas/{schemaId}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'schemaId',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_service_provider_config' =>
  array (
    'slug' => 'cockroachdb_get_service_provider_config',
    'class' => 'CockroachDbGetServiceProviderConfig',
    'type' => 'read',
    'name' => 'Return the SCIM Service Provider configuration',
    'description' => 'This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_GetServiceProviderConfig',
    'method' => 'GET',
    'path' => '/api/scim/v2/ServiceProviderConfig',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_users' =>
  array (
    'slug' => 'cockroachdb_get_users',
    'class' => 'CockroachDbGetUsers',
    'type' => 'read',
    'name' => 'List Users',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetUsers',
    'method' => 'GET',
    'path' => '/api/scim/v2/Users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'count',
        'in' => 'query',
        'required' => false,
        'description' => 'The maximum number of resources to return. If omitted, defaults to 20. If set to 0, the response will contain no resources but will include metadata such as `totalResults`, complying with [RFC 7644, Section 3.4.2.4: Pagination](https://datatracker.ietf.org/doc/html/rfc7644#section-3.4.2.4).',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'startIndex',
        'in' => 'query',
        'required' => false,
        'description' => 'The 1-based index of the first resource to return in the response. If omitted or less than 1, defaults to 1. This behavior complies with [RFC 7644, Section 3.4.2.4: Pagination](https://datatracker.ietf.org/doc/html/rfc7644#section-3.4.2.4).',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_user' =>
  array (
    'slug' => 'cockroachdb_create_user',
    'class' => 'CockroachDbCreateUser',
    'type' => 'write',
    'name' => 'Create a user',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_CreateUser',
    'method' => 'POST',
    'path' => '/api/scim/v2/Users',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_search_users' =>
  array (
    'slug' => 'cockroachdb_search_users',
    'class' => 'CockroachDbSearchUsers',
    'type' => 'write',
    'name' => 'Search Users',
    'description' => 'Similar to GetUsers however search parameters are passed via the POST body. See https://www.rfc-editor.org/rfc/rfc7644.html#section-3.4.3 for more details. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_SearchUsers',
    'method' => 'POST',
    'path' => '/api/scim/v2/Users/.search',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_users2' =>
  array (
    'slug' => 'cockroachdb_get_users2',
    'class' => 'CockroachDbGetUsers2',
    'type' => 'write',
    'name' => 'Search User (Deprecated)',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetUsers2',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Users/.search',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_user' =>
  array (
    'slug' => 'cockroachdb_get_user',
    'class' => 'CockroachDbGetUser',
    'type' => 'read',
    'name' => 'Get a user by ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetUser',
    'method' => 'GET',
    'path' => '/api/scim/v2/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'attributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'excludedAttributes',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_user' =>
  array (
    'slug' => 'cockroachdb_update_user',
    'class' => 'CockroachDbUpdateUser',
    'type' => 'write',
    'name' => 'Update a user by supplying all values of the user object',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateUser',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_patch_user' =>
  array (
    'slug' => 'cockroachdb_patch_user',
    'class' => 'CockroachDbPatchUser',
    'type' => 'write',
    'name' => 'Patch a user by supplying partial updates',
    'description' => 'Apply a sequence of operations to modify attributes of a SCIM User resource. Supports \'add\', \'remove\', and \'replace\' operations per RFC 7644 Section 3.5.2. Operations are applied atomically - if any operation fails, no changes are applied. The request body must include the \'schemas\' field set to \'urn:ietf:params:scim:api:messages:2.0:PatchOp\'. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_PatchUser',
    'method' => 'PATCH',
    'path' => '/api/scim/v2/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_user' =>
  array (
    'slug' => 'cockroachdb_delete_user',
    'class' => 'CockroachDbDeleteUser',
    'type' => 'write',
    'name' => 'Delete a user based on ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteUser',
    'method' => 'DELETE',
    'path' => '/api/scim/v2/Users/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_search_user' =>
  array (
    'slug' => 'cockroachdb_search_user',
    'class' => 'CockroachDbSearchUser',
    'type' => 'write',
    'name' => 'Search for a user by ID',
    'description' => 'Similar to GetUser however search parameters are passed via the POST body. See https://www.rfc-editor.org/rfc/rfc7644.html#section-3.4.3 for more details. Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_SearchUser',
    'method' => 'POST',
    'path' => '/api/scim/v2/Users/{id}/.search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_user2' =>
  array (
    'slug' => 'cockroachdb_get_user2',
    'class' => 'CockroachDbGetUser2',
    'type' => 'write',
    'name' => 'Search for a user by ID (Deprecated)',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetUser2',
    'method' => 'PUT',
    'path' => '/api/scim/v2/Users/{id}/.search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_list_api_keys' =>
  array (
    'slug' => 'cockroachdb_list_api_keys',
    'class' => 'CockroachDbListApiKeys',
    'type' => 'read',
    'name' => 'List API Keys',
    'description' => 'Sort order: created_at Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_ListApiKeys',
    'method' => 'GET',
    'path' => '/api/v1/api-keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'service_account_id',
        'in' => 'query',
        'required' => false,
        'description' => 'Optional filter to limit the response to include only api keys for a specific service account.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_api_key' =>
  array (
    'slug' => 'cockroachdb_create_api_key',
    'class' => 'CockroachDbCreateApiKey',
    'type' => 'write',
    'name' => 'Create a new API Key',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_CreateApiKey',
    'method' => 'POST',
    'path' => '/api/v1/api-keys',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_api_key' =>
  array (
    'slug' => 'cockroachdb_get_api_key',
    'class' => 'CockroachDbGetApiKey',
    'type' => 'read',
    'name' => 'Get an API Key by ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_GetApiKey',
    'method' => 'GET',
    'path' => '/api/v1/api-keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'the ID of the api key.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_api_key' =>
  array (
    'slug' => 'cockroachdb_update_api_key',
    'class' => 'CockroachDbUpdateApiKey',
    'type' => 'write',
    'name' => 'Update an API Key',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateApiKey',
    'method' => 'PATCH',
    'path' => '/api/v1/api-keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the api key.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_api_key' =>
  array (
    'slug' => 'cockroachdb_delete_api_key',
    'class' => 'CockroachDbDeleteApiKey',
    'type' => 'write',
    'name' => 'Delete an API Key',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteApiKey',
    'method' => 'DELETE',
    'path' => '/api/v1/api-keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the api key.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_audit_logs' =>
  array (
    'slug' => 'cockroachdb_list_audit_logs',
    'class' => 'CockroachDbListAuditLogs',
    'type' => 'read',
    'name' => 'List audit logs',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_ListAuditLogs',
    'method' => 'GET',
    'path' => '/api/v1/auditlogevents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'starting_from',
        'in' => 'query',
        'required' => false,
        'description' => 'starting_from is the (exclusive) timestamp from which log entries will be returned in the response based on their created_at time, respecting the sort order specified in pagination. If unset, the default will be the current time if results are returned in descending order and the beginning of time if results are in ascending order.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sort_order',
        'in' => 'query',
        'required' => false,
        'description' => 'sort_order is the direction of pagination, with starting_from as the start point. If unset, the default is ascending order. - ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'limit is the number of entries requested in the response. Note that the response may still contain slightly more results, since the response will always contain every entry at a particular timestamp.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_major_cluster_versions' =>
  array (
    'slug' => 'cockroachdb_list_major_cluster_versions',
    'class' => 'CockroachDbListMajorClusterVersions',
    'type' => 'read',
    'name' => 'List available major cluster versions',
    'description' => 'Sort order: Version number descending This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_ListMajorClusterVersions',
    'method' => 'GET',
    'path' => '/api/v1/cluster-versions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_clusters' =>
  array (
    'slug' => 'cockroachdb_list_clusters',
    'class' => 'CockroachDbListClusters',
    'type' => 'read',
    'name' => 'List clusters in the organization',
    'description' => 'By default, clusters are sorted alphabetically by name in ascending A to Z order. To customize sorting, use the pagination.sort_by and pagination.sort_order query parameters. Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_ListClusters',
    'method' => 'GET',
    'path' => '/api/v1/clusters',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'show_inactive',
        'in' => 'query',
        'required' => false,
        'description' => 'If `true`, show clusters that have been deleted or failed to initialize. Note that inactive clusters will only be included if the requesting user has organization-scoped cluster read permissions.',
        'schema_type' => 'boolean',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'pagination.sort_by',
        'in' => 'query',
        'required' => false,
        'description' => '- NAME: Sort by cluster name. This is the default unless otherwise specified. - CREATED_AT: Sort by cluster created_at. - DELETED_AT: Sort by cluster deleted_at. Active clusters will be sorted by created_at.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_cluster' =>
  array (
    'slug' => 'cockroachdb_create_cluster',
    'class' => 'CockroachDbCreateCluster',
    'type' => 'write',
    'name' => 'Create and initialize a new cluster',
    'description' => 'Can be used by the following roles assigned at the organization or folder scope: - CLUSTER_ADMIN - CLUSTER_CREATOR',
    'operation_id' => 'CockroachCloud_CreateCluster',
    'method' => 'POST',
    'path' => '/api/v1/clusters',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_list_available_regions' =>
  array (
    'slug' => 'cockroachdb_list_available_regions',
    'class' => 'CockroachDbListAvailableRegions',
    'type' => 'read',
    'name' => 'List the regions available for new clusters and nodes',
    'description' => 'Sort order: Distance (based on client IP address) This endpoint may be used by any member of the organization.',
    'operation_id' => 'CockroachCloud_ListAvailableRegions',
    'method' => 'GET',
    'path' => '/api/v1/clusters/available-regions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'provider',
        'in' => 'query',
        'required' => false,
        'description' => 'Optional CloudProvider for filtering. - GCP: The Google Cloud Platform cloud provider. - AWS: The Amazon Web Services cloud provider. - AZURE: The Azure cloud provider.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'serverless',
        'in' => 'query',
        'required' => false,
        'description' => 'Optional filter to only show regions available for serverless clusters.',
        'schema_type' => 'boolean',
      ),
      2 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_cluster' =>
  array (
    'slug' => 'cockroachdb_get_cluster',
    'class' => 'CockroachDbGetCluster',
    'type' => 'read',
    'name' => 'Get extended information about a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_GetCluster',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_cluster' =>
  array (
    'slug' => 'cockroachdb_update_cluster',
    'class' => 'CockroachDbUpdateCluster',
    'type' => 'write',
    'name' => 'Scale, edit or upgrade a cluster',
    'description' => 'In addition to adding nodes and changing cluster fields, the PATCH Cluster endpoint can be used to upgrade the cluster version. A cluster can be upgraded when its `upgrade_status` field is equal to `UPGRADE_AVAILABLE`. The `/api/v1/cluster-versions` endpoint can be used to enumerate versions which are valid to upgrade to. To begin the upgrade, PATCH the desired version into `cockroach_version`. For example `{"cockroach_version": "v24.2"}`. Multi-node clusters will undergo a rolling upgrade and will remain available, but single-node clusters will be briefly unavailable while the upgrade takes place. Upgrades will be finalized automatically after 72 hours but can be manually finalized by sending a PATCH containing `{"upgrade_status": "FINALIZED"}` to this endpoint. Before the cluster is finalized, it can be rolled back by either sending a PATCH of the previous version via `cockroach_version` or sending a PATCH containing `{"upgrade_status": "ROLLBACK_RUNNING"}`. Version upgrade operations cannot be performed simultaneously with other update operations. Only one of `upgrade_status` or `cockroach_version` is allowed in the request. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateCluster',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_cluster' =>
  array (
    'slug' => 'cockroachdb_delete_cluster',
    'class' => 'CockroachDbDeleteCluster',
    'type' => 'write',
    'name' => 'Delete a cluster and all of its data',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteCluster',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_backups' =>
  array (
    'slug' => 'cockroachdb_list_backups',
    'class' => 'CockroachDbListBackups',
    'type' => 'read',
    'name' => 'List cluster backups',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListBackups',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/backups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The cluster associated with the backups being retrieved.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'start_time',
        'in' => 'query',
        'required' => false,
        'description' => 'The beginning of the time range (inclusive) used to search for backups.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'end_time',
        'in' => 'query',
        'required' => false,
        'description' => 'The end of the time range (exclusive) used to search for backups.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_backup_configuration' =>
  array (
    'slug' => 'cockroachdb_get_backup_configuration',
    'class' => 'CockroachDbGetBackupConfiguration',
    'type' => 'read',
    'name' => 'Get the backup configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetBackupConfiguration',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/backups-config',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The UUID of the cluster that this backup configuration belongs to.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_backup_configuration' =>
  array (
    'slug' => 'cockroachdb_update_backup_configuration',
    'class' => 'CockroachDbUpdateBackupConfiguration',
    'type' => 'write',
    'name' => 'Update the backup configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateBackupConfiguration',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/backups-config',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The UUID of the cluster that this backup configuration belongs to.',
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
      'description' => 'spec contains the information that is being updated for the given BackupConfiguration.',
    ),
  ),
  'cockroachdb_list_blackout_windows' =>
  array (
    'slug' => 'cockroachdb_list_blackout_windows',
    'class' => 'CockroachDbListBlackoutWindows',
    'type' => 'read',
    'name' => 'List all blackout windows for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListBlackoutWindows',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/blackout-windows',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_blackout_window' =>
  array (
    'slug' => 'cockroachdb_create_blackout_window',
    'class' => 'CockroachDbCreateBlackoutWindow',
    'type' => 'write',
    'name' => 'Create a blackout window for a cluster',
    'description' => 'Blackout windows are supported for ADVANCED clusters only. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_CreateBlackoutWindow',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/blackout-windows',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_blackout_window' =>
  array (
    'slug' => 'cockroachdb_get_blackout_window',
    'class' => 'CockroachDbGetBlackoutWindow',
    'type' => 'read',
    'name' => 'Get a blackout window by its ID for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetBlackoutWindow',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/blackout-windows/{blackout_window_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'blackout_window_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_blackout_window' =>
  array (
    'slug' => 'cockroachdb_update_blackout_window',
    'class' => 'CockroachDbUpdateBlackoutWindow',
    'type' => 'write',
    'name' => 'Update a blackout window for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateBlackoutWindow',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/blackout-windows/{blackout_window_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'blackout_window_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_blackout_window' =>
  array (
    'slug' => 'cockroachdb_delete_blackout_window',
    'class' => 'CockroachDbDeleteBlackoutWindow',
    'type' => 'write',
    'name' => 'Delete a blackout window for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteBlackoutWindow',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/blackout-windows/{blackout_window_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'blackout_window_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_client_c_a_cert' =>
  array (
    'slug' => 'cockroachdb_get_client_c_a_cert',
    'class' => 'CockroachDbGetClientCACert',
    'type' => 'read',
    'name' => 'Get Client CA Cert information for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetClientCACert',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/client-ca-cert',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_set_client_c_a_cert' =>
  array (
    'slug' => 'cockroachdb_set_client_c_a_cert',
    'class' => 'CockroachDbSetClientCACert',
    'type' => 'write',
    'name' => 'Set Client CA Cert for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_SetClientCACert',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/client-ca-cert',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_update_client_c_a_cert' =>
  array (
    'slug' => 'cockroachdb_update_client_c_a_cert',
    'class' => 'CockroachDbUpdateClientCACert',
    'type' => 'write',
    'name' => 'Update Client CA Cert for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateClientCACert',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/client-ca-cert',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_client_c_a_cert' =>
  array (
    'slug' => 'cockroachdb_delete_client_c_a_cert',
    'class' => 'CockroachDbDeleteClientCACert',
    'type' => 'write',
    'name' => 'Delete Client CA Cert for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteClientCACert',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/client-ca-cert',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_c_m_e_k_cluster_info' =>
  array (
    'slug' => 'cockroachdb_get_c_m_e_k_cluster_info',
    'class' => 'CockroachDbGetCMEKClusterInfo',
    'type' => 'read',
    'name' => 'Get CMEK-related information for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetCMEKClusterInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/cmek',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_enable_c_m_e_k_spec' =>
  array (
    'slug' => 'cockroachdb_enable_c_m_e_k_spec',
    'class' => 'CockroachDbEnableCMEKSpec',
    'type' => 'write',
    'name' => 'Enable CMEK for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EnableCMEKSpec',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/cmek',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_update_c_m_e_k_spec' =>
  array (
    'slug' => 'cockroachdb_update_c_m_e_k_spec',
    'class' => 'CockroachDbUpdateCMEKSpec',
    'type' => 'write',
    'name' => 'Enable or update the CMEK spec for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateCMEKSpec',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/cmek',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_update_c_m_e_k_status' =>
  array (
    'slug' => 'cockroachdb_update_c_m_e_k_status',
    'class' => 'CockroachDbUpdateCMEKStatus',
    'type' => 'write',
    'name' => 'Update the CMEK-related status for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateCMEKStatus',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/cmek',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_connection_string' =>
  array (
    'slug' => 'cockroachdb_get_connection_string',
    'class' => 'CockroachDbGetConnectionString',
    'type' => 'read',
    'name' => 'Get a formatted generic connection string for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_GetConnectionString',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/connection-string',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'database',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'sql_user',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'os',
        'in' => 'query',
        'required' => false,
        'description' => 'os indicates the target operating system, used with formatting the default SSL certificate path. Required only for dedicated clusters.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_databases' =>
  array (
    'slug' => 'cockroachdb_list_databases',
    'class' => 'CockroachDbListDatabases',
    'type' => 'read',
    'name' => 'List databases for a cluster',
    'description' => 'Sort order: Database name ascending Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_ListDatabases',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/databases',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_database' =>
  array (
    'slug' => 'cockroachdb_create_database',
    'class' => 'CockroachDbCreateDatabase',
    'type' => 'write',
    'name' => 'Create a new database',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_CreateDatabase',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/databases',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_edit_database2' =>
  array (
    'slug' => 'cockroachdb_edit_database2',
    'class' => 'CockroachDbEditDatabase2',
    'type' => 'write',
    'name' => 'Update a database',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EditDatabase2',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/databases',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_edit_database' =>
  array (
    'slug' => 'cockroachdb_edit_database',
    'class' => 'CockroachDbEditDatabase',
    'type' => 'write',
    'name' => 'Update a database',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EditDatabase',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/databases/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_database' =>
  array (
    'slug' => 'cockroachdb_delete_database',
    'class' => 'CockroachDbDeleteDatabase',
    'type' => 'write',
    'name' => 'Delete a database',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteDatabase',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/databases/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_cluster_disruption_info' =>
  array (
    'slug' => 'cockroachdb_get_cluster_disruption_info',
    'class' => 'CockroachDbGetClusterDisruptionInfo',
    'type' => 'read',
    'name' => 'Get disruption specifications for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetClusterDisruptionInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/disrupt',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the cluster we are requesting disruption information for.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_cluster_disruption' =>
  array (
    'slug' => 'cockroachdb_update_cluster_disruption',
    'class' => 'CockroachDbUpdateClusterDisruption',
    'type' => 'write',
    'name' => 'Update disruption specifications for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateClusterDisruption',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/disrupt',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id specifies the cluster for this request.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_log_export_info' =>
  array (
    'slug' => 'cockroachdb_get_log_export_info',
    'class' => 'CockroachDbGetLogExportInfo',
    'type' => 'read',
    'name' => 'Get the Log Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - METRICS_VIEWER',
    'operation_id' => 'CockroachCloud_GetLogExportInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/logexport',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_enable_log_export' =>
  array (
    'slug' => 'cockroachdb_enable_log_export',
    'class' => 'CockroachDbEnableLogExport',
    'type' => 'write',
    'name' => 'Create or update the Log Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EnableLogExport',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/logexport',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_log_export' =>
  array (
    'slug' => 'cockroachdb_delete_log_export',
    'class' => 'CockroachDbDeleteLogExport',
    'type' => 'write',
    'name' => 'Delete the Log Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteLogExport',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/logexport',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_maintenance_window' =>
  array (
    'slug' => 'cockroachdb_get_maintenance_window',
    'class' => 'CockroachDbGetMaintenanceWindow',
    'type' => 'read',
    'name' => 'Get the maintenance window for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetMaintenanceWindow',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/maintenance-window',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_set_maintenance_window' =>
  array (
    'slug' => 'cockroachdb_set_maintenance_window',
    'class' => 'CockroachDbSetMaintenanceWindow',
    'type' => 'write',
    'name' => 'Set the maintenance window for a cluster',
    'description' => 'Maintenance windows are supported for ADVANCED clusters. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_SetMaintenanceWindow',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/maintenance-window',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_maintenance_window' =>
  array (
    'slug' => 'cockroachdb_delete_maintenance_window',
    'class' => 'CockroachDbDeleteMaintenanceWindow',
    'type' => 'write',
    'name' => 'Delete the maintenance window for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteMaintenanceWindow',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/maintenance-window',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_cloud_watch_metric_export_info' =>
  array (
    'slug' => 'cockroachdb_get_cloud_watch_metric_export_info',
    'class' => 'CockroachDbGetCloudWatchMetricExportInfo',
    'type' => 'read',
    'name' => 'Get the CloudWatch Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - METRICS_VIEWER',
    'operation_id' => 'CockroachCloud_GetCloudWatchMetricExportInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/cloudwatch',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_enable_cloud_watch_metric_export' =>
  array (
    'slug' => 'cockroachdb_enable_cloud_watch_metric_export',
    'class' => 'CockroachDbEnableCloudWatchMetricExport',
    'type' => 'write',
    'name' => 'Create or update the CloudWatch Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EnableCloudWatchMetricExport',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/cloudwatch',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_cloud_watch_metric_export' =>
  array (
    'slug' => 'cockroachdb_delete_cloud_watch_metric_export',
    'class' => 'CockroachDbDeleteCloudWatchMetricExport',
    'type' => 'write',
    'name' => 'Delete the CloudWatch Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteCloudWatchMetricExport',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/cloudwatch',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_datadog_metric_export_info' =>
  array (
    'slug' => 'cockroachdb_get_datadog_metric_export_info',
    'class' => 'CockroachDbGetDatadogMetricExportInfo',
    'type' => 'read',
    'name' => 'Get the Datadog Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - METRICS_VIEWER',
    'operation_id' => 'CockroachCloud_GetDatadogMetricExportInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/datadog',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_enable_datadog_metric_export' =>
  array (
    'slug' => 'cockroachdb_enable_datadog_metric_export',
    'class' => 'CockroachDbEnableDatadogMetricExport',
    'type' => 'write',
    'name' => 'Create or update the Datadog Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EnableDatadogMetricExport',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/datadog',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_datadog_metric_export' =>
  array (
    'slug' => 'cockroachdb_delete_datadog_metric_export',
    'class' => 'CockroachDbDeleteDatadogMetricExport',
    'type' => 'write',
    'name' => 'Delete the Datadog Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteDatadogMetricExport',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/datadog',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_prometheus_metric_export_info' =>
  array (
    'slug' => 'cockroachdb_get_prometheus_metric_export_info',
    'class' => 'CockroachDbGetPrometheusMetricExportInfo',
    'type' => 'read',
    'name' => 'Get the Prometheus Metric Export configuration for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - METRICS_VIEWER',
    'operation_id' => 'CockroachCloud_GetPrometheusMetricExportInfo',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/prometheus',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_enable_prometheus_metric_export' =>
  array (
    'slug' => 'cockroachdb_enable_prometheus_metric_export',
    'class' => 'CockroachDbEnablePrometheusMetricExport',
    'type' => 'write',
    'name' => 'Enable Prometheus Metric Export for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EnablePrometheusMetricExport',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/prometheus',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_delete_prometheus_metric_export' =>
  array (
    'slug' => 'cockroachdb_delete_prometheus_metric_export',
    'class' => 'CockroachDbDeletePrometheusMetricExport',
    'type' => 'write',
    'name' => 'Disable Prometheus Metric Export for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeletePrometheusMetricExport',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/metricexport/prometheus',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_allowlist_entries' =>
  array (
    'slug' => 'cockroachdb_list_allowlist_entries',
    'class' => 'CockroachDbListAllowlistEntries',
    'type' => 'read',
    'name' => 'Get the IP allowlist and propagation status for a cluster',
    'description' => 'Sort order: CIDR address Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_ListAllowlistEntries',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/allowlist',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_add_allowlist_entry' =>
  array (
    'slug' => 'cockroachdb_add_allowlist_entry',
    'class' => 'CockroachDbAddAllowlistEntry',
    'type' => 'write',
    'name' => 'Add a new CIDR address to the IP allowlist',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_AddAllowlistEntry',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/allowlist',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_add_allowlist_entry2' =>
  array (
    'slug' => 'cockroachdb_add_allowlist_entry2',
    'class' => 'CockroachDbAddAllowlistEntry2',
    'type' => 'write',
    'name' => 'Add a new CIDR address to the IP allowlist',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_AddAllowlistEntry2',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/networking/allowlist/{cidr_ip}/{cidr_mask}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cidr_ip',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'cidr_mask',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'AllowlistEntry',
    ),
  ),
  'cockroachdb_update_allowlist_entry' =>
  array (
    'slug' => 'cockroachdb_update_allowlist_entry',
    'class' => 'CockroachDbUpdateAllowlistEntry',
    'type' => 'write',
    'name' => 'Update an IP allowlist entry',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateAllowlistEntry',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/networking/allowlist/{cidr_ip}/{cidr_mask}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cidr_ip',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'cidr_mask',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'AllowlistEntry',
    ),
  ),
  'cockroachdb_delete_allowlist_entry' =>
  array (
    'slug' => 'cockroachdb_delete_allowlist_entry',
    'class' => 'CockroachDbDeleteAllowlistEntry',
    'type' => 'write',
    'name' => 'Delete an IP allowlist entry',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteAllowlistEntry',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/networking/allowlist/{cidr_ip}/{cidr_mask}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'cidr_ip',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'cidr_mask',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_aws_endpoint_connections' =>
  array (
    'slug' => 'cockroachdb_list_aws_endpoint_connections',
    'class' => 'CockroachDbListAwsEndpointConnections',
    'type' => 'read',
    'name' => 'List all AwsEndpointConnections for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListAwsEndpointConnections',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/aws-endpoint-connections',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_set_aws_endpoint_connection_state' =>
  array (
    'slug' => 'cockroachdb_set_aws_endpoint_connection_state',
    'class' => 'CockroachDbSetAwsEndpointConnectionState',
    'type' => 'write',
    'name' => 'Set the AWS Endpoint Connection state',
    'description' => 'The "status" in the response does not reflect the latest post-update status, but rather the status before the state is transitioned. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_SetAwsEndpointConnectionState',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/networking/aws-endpoint-connections/{endpoint_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'description' => 'endpoint_id is the ID for the VPC endpoint on the customer\'s side.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_list_egress_private_endpoints' =>
  array (
    'slug' => 'cockroachdb_list_egress_private_endpoints',
    'class' => 'CockroachDbListEgressPrivateEndpoints',
    'type' => 'read',
    'name' => 'List egress private endpoints',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListEgressPrivateEndpoints',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB Cloud cluster whose egress private endpoints to list.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_egress_private_endpoint' =>
  array (
    'slug' => 'cockroachdb_create_egress_private_endpoint',
    'class' => 'CockroachDbCreateEgressPrivateEndpoint',
    'type' => 'write',
    'name' => 'Create an egress private endpoint',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_CreateEgressPrivateEndpoint',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the cluster to which this egress private endpoint applies.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_egress_private_endpoint' =>
  array (
    'slug' => 'cockroachdb_get_egress_private_endpoint',
    'class' => 'CockroachDbGetEgressPrivateEndpoint',
    'type' => 'read',
    'name' => 'Get egress private endpoint',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetEgressPrivateEndpoint',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB Cloud cluster owning the egress private endpoint.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the UUID value of the egress private endpoint in CockroachDB Cloud.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_egress_private_endpoint' =>
  array (
    'slug' => 'cockroachdb_update_egress_private_endpoint',
    'class' => 'CockroachDbUpdateEgressPrivateEndpoint',
    'type' => 'write',
    'name' => 'Update egress private endpoint.',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateEgressPrivateEndpoint',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB Cloud cluster owning the egress private endpoint.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the UUID value of the egress private endpoint in CockroachDB Cloud.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_egress_private_endpoint' =>
  array (
    'slug' => 'cockroachdb_delete_egress_private_endpoint',
    'class' => 'CockroachDbDeleteEgressPrivateEndpoint',
    'type' => 'write',
    'name' => 'Delete an egress private endpoint',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteEgressPrivateEndpoint',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB Cloud cluster owning the egress private endpoint.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the UUID value of the egress private endpoint in CockroachDB Cloud.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_egress_private_endpoint_domain_names' =>
  array (
    'slug' => 'cockroachdb_update_egress_private_endpoint_domain_names',
    'class' => 'CockroachDbUpdateEgressPrivateEndpointDomainNames',
    'type' => 'write',
    'name' => 'Update egress private endpoint domain names. This endpoint is deprecated in favor of PATCH /api/v1/clusters/{cluster_id}/networking/egress-private-endpoints/{id} and will be removed in a future version.',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_UpdateEgressPrivateEndpointDomainNames',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-private-endpoints/{id}/domain-names',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB Cloud cluster owning the egress private endpoint.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the UUID value of the egress private endpoint in CockroachDB Cloud.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_list_egress_rules' =>
  array (
    'slug' => 'cockroachdb_list_egress_rules',
    'class' => 'CockroachDbListEgressRules',
    'type' => 'read',
    'name' => 'List all egress rules associated with a cluster',
    'description' => 'Sort order: Name Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListEgressRules',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the CockroachDB cluster owning the set of returned egress rules.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_add_egress_rule' =>
  array (
    'slug' => 'cockroachdb_add_egress_rule',
    'class' => 'CockroachDbAddEgressRule',
    'type' => 'write',
    'name' => 'Add an egress rule',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_AddEgressRule',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the cluster to which this egress rule applies.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_set_egress_traffic_policy' =>
  array (
    'slug' => 'cockroachdb_set_egress_traffic_policy',
    'class' => 'CockroachDbSetEgressTrafficPolicy',
    'type' => 'write',
    'name' => 'Outbound traffic management',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_SetEgressTrafficPolicy',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules/egress-traffic-policy',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id identifies the cluster whose egress policy will be updated.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_egress_rule' =>
  array (
    'slug' => 'cockroachdb_get_egress_rule',
    'class' => 'CockroachDbGetEgressRule',
    'type' => 'read',
    'name' => 'Get an existing egress rule',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetEgressRule',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules/{rule_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id uniquely identifies the cluster owning the egress rule.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rule_id',
        'in' => 'path',
        'required' => true,
        'description' => 'rule_id is the UUID of an existing egress rule.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_edit_egress_rule' =>
  array (
    'slug' => 'cockroachdb_edit_egress_rule',
    'class' => 'CockroachDbEditEgressRule',
    'type' => 'write',
    'name' => 'Edit an existing egress rule',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_EditEgressRule',
    'method' => 'PATCH',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules/{rule_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id uniquely identifies the cluster owning the egress rule.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rule_id',
        'in' => 'path',
        'required' => true,
        'description' => 'rule_id is the UUID of an existing egress rule. This field is required.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_egress_rule' =>
  array (
    'slug' => 'cockroachdb_delete_egress_rule',
    'class' => 'CockroachDbDeleteEgressRule',
    'type' => 'write',
    'name' => 'Delete an existing egress rule',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeleteEgressRule',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/networking/egress-rules/{rule_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id uniquely identifies the cluster owning the egress rule.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rule_id',
        'in' => 'path',
        'required' => true,
        'description' => 'rule_id is the UUID of an existing egress rule. This field is required.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'idempotency_key',
        'in' => 'query',
        'required' => false,
        'description' => 'idempotency_key uniquely identifies this request. If not set, it will be set by the server.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_private_endpoint_connections' =>
  array (
    'slug' => 'cockroachdb_list_private_endpoint_connections',
    'class' => 'CockroachDbListPrivateEndpointConnections',
    'type' => 'read',
    'name' => 'List all connections to a cluster\'s private endpoint service.',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListPrivateEndpointConnections',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-connections',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_add_private_endpoint_connection' =>
  array (
    'slug' => 'cockroachdb_add_private_endpoint_connection',
    'class' => 'CockroachDbAddPrivateEndpointConnection',
    'type' => 'write',
    'name' => 'Add a connection to a cluster\'s private endpoint service.',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_AddPrivateEndpointConnection',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-connections',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the id of the cluster to which the private endpoint connection will be added.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_private_endpoint_connection' =>
  array (
    'slug' => 'cockroachdb_delete_private_endpoint_connection',
    'class' => 'CockroachDbDeletePrivateEndpointConnection',
    'type' => 'write',
    'name' => 'Delete a connection from a cluster\'s private endpoint service.',
    'description' => 'Remove a private endpoint from a service\'s trusted endpoints list. Caller should make sure to URL encode the endpoint_id before calling this method. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_DeletePrivateEndpointConnection',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-connections/{endpoint_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the id of the cluster from which the private endpoint connection will be removed.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'endpoint_id',
        'in' => 'path',
        'required' => true,
        'description' => 'endpoint_id is the id of the private endpoint associated with a cluster\'s private endpoint service.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_private_endpoint_services' =>
  array (
    'slug' => 'cockroachdb_list_private_endpoint_services',
    'class' => 'CockroachDbListPrivateEndpointServices',
    'type' => 'read',
    'name' => 'List all PrivateEndpointServices for a cluster',
    'description' => 'The internal_dns property from the regions field in the ListClusters response can be used to connect to PrivateEndpointServices. Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListPrivateEndpointServices',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-services',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_private_endpoint_services' =>
  array (
    'slug' => 'cockroachdb_create_private_endpoint_services',
    'class' => 'CockroachDbCreatePrivateEndpointServices',
    'type' => 'write',
    'name' => 'Create all PrivateEndpointServices for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_CreatePrivateEndpointServices',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-services',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_private_endpoint_trusted_owners' =>
  array (
    'slug' => 'cockroachdb_list_private_endpoint_trusted_owners',
    'class' => 'CockroachDbListPrivateEndpointTrustedOwners',
    'type' => 'read',
    'name' => 'List all private endpoint trusted owners for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListPrivateEndpointTrustedOwners',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-trusted-owners',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_add_private_endpoint_trusted_owner' =>
  array (
    'slug' => 'cockroachdb_add_private_endpoint_trusted_owner',
    'class' => 'CockroachDbAddPrivateEndpointTrustedOwner',
    'type' => 'write',
    'name' => 'Add a private endpoint trusted owner to a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_AddPrivateEndpointTrustedOwner',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-trusted-owners',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_private_endpoint_trusted_owner' =>
  array (
    'slug' => 'cockroachdb_get_private_endpoint_trusted_owner',
    'class' => 'CockroachDbGetPrivateEndpointTrustedOwner',
    'type' => 'read',
    'name' => 'Get a private endpoint trusted owner entry for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetPrivateEndpointTrustedOwner',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-trusted-owners/{owner_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'owner_id',
        'in' => 'path',
        'required' => true,
        'description' => 'owner_id corresponds to the UUID of the private endpoint trusted owner entry.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_remove_private_endpoint_trusted_owner' =>
  array (
    'slug' => 'cockroachdb_remove_private_endpoint_trusted_owner',
    'class' => 'CockroachDbRemovePrivateEndpointTrustedOwner',
    'type' => 'write',
    'name' => 'Remove a private endpoint trusted owner from a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_RemovePrivateEndpointTrustedOwner',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/networking/private-endpoint-trusted-owners/{owner_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'cluster_id is the ID for the cluster.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'owner_id',
        'in' => 'path',
        'required' => true,
        'description' => 'owner_id corresponds to the UUID of the private endpoint trusted owner entry.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_cluster_nodes' =>
  array (
    'slug' => 'cockroachdb_list_cluster_nodes',
    'class' => 'CockroachDbListClusterNodes',
    'type' => 'read',
    'name' => 'List nodes for a cluster',
    'description' => 'Sort order: Region name, node name Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_ListClusterNodes',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/nodes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'region_name',
        'in' => 'query',
        'required' => false,
        'description' => 'Optional filter to limit response to a single region.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_restores' =>
  array (
    'slug' => 'cockroachdb_list_restores',
    'class' => 'CockroachDbListRestores',
    'type' => 'read',
    'name' => 'List restore jobs',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_ListRestores',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/restores',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the cluster where the restores ran or are currently running.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'start_time',
        'in' => 'query',
        'required' => false,
        'description' => 'The beginning of the time range (inclusive) used to search for restores.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'end_time',
        'in' => 'query',
        'required' => false,
        'description' => 'The end of the time range (exclusive) used to search for restores.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_restore' =>
  array (
    'slug' => 'cockroachdb_get_restore',
    'class' => 'CockroachDbGetRestore',
    'type' => 'read',
    'name' => 'View a restore job',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetRestore',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/restores/{restore_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the cluster where the restore ran or is currently running.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'restore_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the restore.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_users' =>
  array (
    'slug' => 'cockroachdb_list_users',
    'class' => 'CockroachDbListUsers',
    'type' => 'read',
    'name' => 'List SQL users for a cluster',
    'description' => 'Sort order: Username Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_ListSQLUsers',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/sql-users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_s_q_l_user' =>
  array (
    'slug' => 'cockroachdb_create_s_q_l_user',
    'class' => 'CockroachDbCreateSQLUser',
    'type' => 'write',
    'name' => 'Create a new SQL user',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_CreateSQLUser',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{cluster_id}/sql-users',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_s_q_l_user' =>
  array (
    'slug' => 'cockroachdb_delete_s_q_l_user',
    'class' => 'CockroachDbDeleteSQLUser',
    'type' => 'write',
    'name' => 'Delete a SQL user',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteSQLUser',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{cluster_id}/sql-users/{name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_s_q_l_user_password' =>
  array (
    'slug' => 'cockroachdb_update_s_q_l_user_password',
    'class' => 'CockroachDbUpdateSQLUserPassword',
    'type' => 'write',
    'name' => 'Update a SQL user\'s password',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateSQLUserPassword',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/sql-users/{name}/password',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_cluster_version_deferral' =>
  array (
    'slug' => 'cockroachdb_get_cluster_version_deferral',
    'class' => 'CockroachDbGetClusterVersionDeferral',
    'type' => 'read',
    'name' => 'Get the version upgrade deferral policy for a cluster.',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_GetClusterVersionDeferral',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{cluster_id}/version-deferral',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_set_cluster_version_deferral' =>
  array (
    'slug' => 'cockroachdb_set_cluster_version_deferral',
    'class' => 'CockroachDbSetClusterVersionDeferral',
    'type' => 'write',
    'name' => 'Set the version upgrade deferral policy for a cluster',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_SetClusterVersionDeferral',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{cluster_id}/version-deferral',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_create_restore' =>
  array (
    'slug' => 'cockroachdb_create_restore',
    'class' => 'CockroachDbCreateRestore',
    'type' => 'write',
    'name' => 'Create a restore',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER',
    'operation_id' => 'CockroachCloud_CreateRestore',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{destination_cluster_id}/restores',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'destination_cluster_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the cluster where the backup will be restored.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_list_folders' =>
  array (
    'slug' => 'cockroachdb_list_folders',
    'class' => 'CockroachDbListFolders',
    'type' => 'read',
    'name' => 'List folders owned by an organization',
    'description' => 'Sort order: Folder name Can be used by the following roles assigned at the organization or folder scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - CLUSTER_CREATOR - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_ListFolders',
    'method' => 'GET',
    'path' => '/api/v1/folders',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'path',
        'in' => 'query',
        'required' => false,
        'description' => 'Optional filter to limit the response to include only results that match the given absolute path to that folder. Preceding and ending "/" are optional. For example /folder1/folder2, /folder1/folder2/, folder1/folder2, and folder1/folder2/ are all equivalent. If no matching folder is found, an empty list is returned. Because folder paths are passed via the query parameters, they must be URL-encoded.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_folder' =>
  array (
    'slug' => 'cockroachdb_create_folder',
    'class' => 'CockroachDbCreateFolder',
    'type' => 'write',
    'name' => 'Create a folder',
    'description' => 'Can be used by the following roles assigned at the organization or folder scope: - FOLDER_ADMIN',
    'operation_id' => 'CockroachCloud_CreateFolder',
    'method' => 'POST',
    'path' => '/api/v1/folders',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_folder' =>
  array (
    'slug' => 'cockroachdb_get_folder',
    'class' => 'CockroachDbGetFolder',
    'type' => 'read',
    'name' => 'Get folder info for a folder',
    'description' => 'Can be used by the following roles assigned at the organization or folder scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - CLUSTER_CREATOR - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_GetFolder',
    'method' => 'GET',
    'path' => '/api/v1/folders/{folder_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_folder' =>
  array (
    'slug' => 'cockroachdb_update_folder',
    'class' => 'CockroachDbUpdateFolder',
    'type' => 'write',
    'name' => 'Update a folder',
    'description' => 'Can be used by the following roles assigned at the organization or folder scope: - FOLDER_ADMIN - FOLDER_MOVER',
    'operation_id' => 'CockroachCloud_UpdateFolder',
    'method' => 'PATCH',
    'path' => '/api/v1/folders/{folder_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_folder' =>
  array (
    'slug' => 'cockroachdb_delete_folder',
    'class' => 'CockroachDbDeleteFolder',
    'type' => 'write',
    'name' => 'Delete a folder',
    'description' => 'Can be used by the following roles assigned at the organization or folder scope: - FOLDER_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteFolder',
    'method' => 'DELETE',
    'path' => '/api/v1/folders/{folder_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_folder_contents' =>
  array (
    'slug' => 'cockroachdb_list_folder_contents',
    'class' => 'CockroachDbListFolderContents',
    'type' => 'read',
    'name' => 'List contents of a folder',
    'description' => 'Set `folder_id` to \'root\' to list root level contents. Sort order: Folders sorted by name, followed by Clusters sorted by name. Can be used by the following roles assigned at the organization, folder or cluster scope: - ORG_ADMIN - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER - FOLDER_ADMIN - FOLDER_MOVER - METRICS_VIEWER - CLUSTER_MONITOR',
    'operation_id' => 'CockroachCloud_ListFolderContents',
    'method' => 'GET',
    'path' => '/api/v1/folders/{folder_id}/contents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_invoices' =>
  array (
    'slug' => 'cockroachdb_list_invoices',
    'class' => 'CockroachDbListInvoices',
    'type' => 'read',
    'name' => 'List invoices for a given organization',
    'description' => 'Sort order: invoice start date ascending Can be used by the following roles assigned at the organization scope: - BILLING_COORDINATOR - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_ListInvoices',
    'method' => 'GET',
    'path' => '/api/v1/invoices',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filters the response to only include invoices with the specified status. This will be sent as a query parameter on the GET request. If not specified, both Finalized and Draft invoices will be included.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'start_time',
        'in' => 'query',
        'required' => false,
        'description' => 'start_time filters the response to invoices whose billing period started at or after this time (inclusive). Must be in RFC3339 format (e.g., 2024-01-01T00:00:00Z). Defaults to organization creation time if omitted.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'end_time',
        'in' => 'query',
        'required' => false,
        'description' => 'end_time filters the response to invoices whose billing period ended at or before this time (exclusive). Must be in RFC3339 format (e.g., 2024-12-31T23:59:59Z). Defaults to current time if omitted.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_invoice' =>
  array (
    'slug' => 'cockroachdb_get_invoice',
    'class' => 'CockroachDbGetInvoice',
    'type' => 'read',
    'name' => 'Get a specific invoice for an organization',
    'description' => 'Can be used by the following roles assigned at the organization scope: - BILLING_COORDINATOR - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_GetInvoice',
    'method' => 'GET',
    'path' => '/api/v1/invoices/{invoice_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'invoice_id',
        'in' => 'path',
        'required' => true,
        'description' => 'invoice_id is the unique ID representing the invoice. invoice_id is used to retrieve a specific billing period\'s invoice.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_j_w_t_issuers' =>
  array (
    'slug' => 'cockroachdb_list_j_w_t_issuers',
    'class' => 'CockroachDbListJWTIssuers',
    'type' => 'read',
    'name' => 'List all JWT Issuers',
    'description' => 'Lists all the JWT Issuer configurations registered for the CockroachDB Cloud organization Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_ListJWTIssuers',
    'method' => 'GET',
    'path' => '/api/v1/jwt-issuers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_add_j_w_t_issuer' =>
  array (
    'slug' => 'cockroachdb_add_j_w_t_issuer',
    'class' => 'CockroachDbAddJWTIssuer',
    'type' => 'write',
    'name' => 'Add a JWT Issuer',
    'description' => 'Registers a JWT Issuer with the CockroachDB Cloud to allow verifying JWTs during API authentication Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_AddJWTIssuer',
    'method' => 'POST',
    'path' => '/api/v1/jwt-issuers',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_j_w_t_issuer' =>
  array (
    'slug' => 'cockroachdb_get_j_w_t_issuer',
    'class' => 'CockroachDbGetJWTIssuer',
    'type' => 'read',
    'name' => 'Get a JWT Issuer',
    'description' => 'Retrieves the JWT Issuer configuration Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_GetJWTIssuer',
    'method' => 'GET',
    'path' => '/api/v1/jwt-issuers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the JWT Issuer resource',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_j_w_t_issuer' =>
  array (
    'slug' => 'cockroachdb_update_j_w_t_issuer',
    'class' => 'CockroachDbUpdateJWTIssuer',
    'type' => 'write',
    'name' => 'Update a JWT Issuer',
    'description' => 'Updates the JWT Issuer configuration Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateJWTIssuer',
    'method' => 'PATCH',
    'path' => '/api/v1/jwt-issuers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the JWT Issuer resource',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_j_w_t_issuer' =>
  array (
    'slug' => 'cockroachdb_delete_j_w_t_issuer',
    'class' => 'CockroachDbDeleteJWTIssuer',
    'type' => 'write',
    'name' => 'Delete a JWT Issuer',
    'description' => 'Deletes the JWT Issuer configuration Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteJWTIssuer',
    'method' => 'DELETE',
    'path' => '/api/v1/jwt-issuers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the JWT Issuer resource',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_organization_info' =>
  array (
    'slug' => 'cockroachdb_get_organization_info',
    'class' => 'CockroachDbGetOrganizationInfo',
    'type' => 'read',
    'name' => 'Get information about the caller\'s organization',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - ORG_MEMBER',
    'operation_id' => 'CockroachCloud_GetOrganizationInfo',
    'method' => 'GET',
    'path' => '/api/v1/organization',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_physical_replication_streams' =>
  array (
    'slug' => 'cockroachdb_list_physical_replication_streams',
    'class' => 'CockroachDbListPhysicalReplicationStreams',
    'type' => 'read',
    'name' => 'List physical replication streams',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_ListPhysicalReplicationStreams',
    'method' => 'GET',
    'path' => '/api/v1/physical-replication-streams',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'primary_cluster_id',
        'in' => 'query',
        'required' => false,
        'description' => 'primary_cluster_id, if set, will cause only replication streams with this cluster as the primary to be returned.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'standby_cluster_id',
        'in' => 'query',
        'required' => false,
        'description' => 'standby_cluster_id, if set, will cause only replication streams with this cluster as the standby to be returned.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'cluster_id',
        'in' => 'query',
        'required' => false,
        'description' => 'cluster_id, if set, will cause replication streams with this cluster as the primary or the standby to be returned.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'show_completed',
        'in' => 'query',
        'required' => false,
        'description' => 'show_completed specifies whether or not replication streams in the completed state are shown.',
        'schema_type' => 'boolean',
      ),
      4 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      5 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      6 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_physical_replication_stream' =>
  array (
    'slug' => 'cockroachdb_create_physical_replication_stream',
    'class' => 'CockroachDbCreatePhysicalReplicationStream',
    'type' => 'write',
    'name' => 'Create a physical replication stream',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_CreatePhysicalReplicationStream',
    'method' => 'POST',
    'path' => '/api/v1/physical-replication-streams',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_physical_replication_stream' =>
  array (
    'slug' => 'cockroachdb_get_physical_replication_stream',
    'class' => 'CockroachDbGetPhysicalReplicationStream',
    'type' => 'read',
    'name' => 'Get a physical replication stream',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN - CLUSTER_OPERATOR_WRITER - CLUSTER_DEVELOPER',
    'operation_id' => 'CockroachCloud_GetPhysicalReplicationStream',
    'method' => 'GET',
    'path' => '/api/v1/physical-replication-streams/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the ID of the replication stream to get.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_physical_replication_stream' =>
  array (
    'slug' => 'cockroachdb_update_physical_replication_stream',
    'class' => 'CockroachDbUpdatePhysicalReplicationStream',
    'type' => 'write',
    'name' => 'Update a physical replication stream',
    'description' => 'Can be used by the following roles assigned at the organization, folder or cluster scope: - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_UpdatePhysicalReplicationStream',
    'method' => 'PATCH',
    'path' => '/api/v1/physical-replication-streams/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'id is the ID of the replication stream to update.',
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
      'description' => 'spec contains the information that is being updated for the given replication stream.',
    ),
  ),
  'cockroachdb_list_role_grants' =>
  array (
    'slug' => 'cockroachdb_list_role_grants',
    'class' => 'CockroachDbListRoleGrants',
    'type' => 'read',
    'name' => 'List all RoleGrants',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN - FOLDER_ADMIN',
    'operation_id' => 'CockroachCloud_ListRoleGrants',
    'method' => 'GET',
    'path' => '/api/v1/roles',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_all_roles_for_user' =>
  array (
    'slug' => 'cockroachdb_get_all_roles_for_user',
    'class' => 'CockroachDbGetAllRolesForUser',
    'type' => 'read',
    'name' => 'Get all Role Grants for a user',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN - FOLDER_ADMIN',
    'operation_id' => 'CockroachCloud_GetAllRolesForUser',
    'method' => 'GET',
    'path' => '/api/v1/roles/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_set_roles_for_user' =>
  array (
    'slug' => 'cockroachdb_set_roles_for_user',
    'class' => 'CockroachDbSetRolesForUser',
    'type' => 'write',
    'name' => 'Replace the roles for a user or service account with exactly those provided',
    'description' => 'Replace the entire role set for a user or service account by providing its user_id or service_account_id. Roles that will be removed or added as a result of this call must follow the CC rules for role assignment: https://www.cockroachlabs.com/docs/cockroachcloud/authorization#organization-user-roles',
    'operation_id' => 'CockroachCloud_SetRolesForUser',
    'method' => 'PUT',
    'path' => '/api/v1/roles/{user_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_add_user_to_role' =>
  array (
    'slug' => 'cockroachdb_add_user_to_role',
    'class' => 'CockroachDbAddUserToRole',
    'type' => 'write',
    'name' => 'Add a role to a user or service account',
    'description' => 'Add a single role to a user or service account by providing its user_id or service_account_id. Roles that will be added as a result of this call must follow the CC rules for role assignment: https://www.cockroachlabs.com/docs/cockroachcloud/authorization#organization-user-roles',
    'operation_id' => 'CockroachCloud_AddUserToRole',
    'method' => 'POST',
    'path' => '/api/v1/roles/{user_id}/{resource_type}/{resource_id}/{role_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resource_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resource_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_remove_user_from_role' =>
  array (
    'slug' => 'cockroachdb_remove_user_from_role',
    'class' => 'CockroachDbRemoveUserFromRole',
    'type' => 'write',
    'name' => 'Remove a role from a user or service account',
    'description' => 'Remove a single role from a user or service account by providing its user_id or service_account_id. Roles that will be removed as a result of this call must follow the CC rules for role assignment: https://www.cockroachlabs.com/docs/cockroachcloud/authorization#organization-user-roles',
    'operation_id' => 'CockroachCloud_RemoveUserFromRole',
    'method' => 'DELETE',
    'path' => '/api/v1/roles/{user_id}/{resource_type}/{resource_id}/{role_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'resource_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'resource_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'role_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_list_service_accounts' =>
  array (
    'slug' => 'cockroachdb_list_service_accounts',
    'class' => 'CockroachDbListServiceAccounts',
    'type' => 'read',
    'name' => 'List service accounts for an organization',
    'description' => 'Sort order: Service account name Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_ListServiceAccounts',
    'method' => 'GET',
    'path' => '/api/v1/service-accounts',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'pagination.page',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'pagination.limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'pagination.as_of_time',
        'in' => 'query',
        'required' => false,
        'description' => 'Execute the CockroachDB Cloud API operation.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'pagination.sort_order',
        'in' => 'query',
        'required' => false,
        'description' => '- ASC: Sort in ascending order. This is the default unless otherwise specified. - DESC: Sort in descending order.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_create_service_account' =>
  array (
    'slug' => 'cockroachdb_create_service_account',
    'class' => 'CockroachDbCreateServiceAccount',
    'type' => 'write',
    'name' => 'Create a service account',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_CreateServiceAccount',
    'method' => 'POST',
    'path' => '/api/v1/service-accounts',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_get_service_account' =>
  array (
    'slug' => 'cockroachdb_get_service_account',
    'class' => 'CockroachDbGetServiceAccount',
    'type' => 'read',
    'name' => 'Get a service account by ID',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN',
    'operation_id' => 'CockroachCloud_GetServiceAccount',
    'method' => 'GET',
    'path' => '/api/v1/service-accounts/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'The ID of the service account.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_update_service_account' =>
  array (
    'slug' => 'cockroachdb_update_service_account',
    'class' => 'CockroachDbUpdateServiceAccount',
    'type' => 'write',
    'name' => 'Update a service account',
    'description' => 'To manage roles associated with a service account after creation, pass the service_account_id instead of a user_id to any [Role Management endpoint](#tag--Role-Management). Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_UpdateServiceAccount',
    'method' => 'PATCH',
    'path' => '/api/v1/service-accounts/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the CockroachDB Cloud API operation.',
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
      'description' => 'Execute the CockroachDB Cloud API operation.',
    ),
  ),
  'cockroachdb_delete_service_account' =>
  array (
    'slug' => 'cockroachdb_delete_service_account',
    'class' => 'CockroachDbDeleteServiceAccount',
    'type' => 'write',
    'name' => 'Delete a service account',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN',
    'operation_id' => 'CockroachCloud_DeleteServiceAccount',
    'method' => 'DELETE',
    'path' => '/api/v1/service-accounts/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'the ID of the service account.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'cockroachdb_get_person_users_by_email' =>
  array (
    'slug' => 'cockroachdb_get_person_users_by_email',
    'class' => 'CockroachDbGetPersonUsersByEmail',
    'type' => 'read',
    'name' => 'Search person users by email address',
    'description' => 'Can be used by the following roles assigned at the organization scope: - ORG_ADMIN - CLUSTER_ADMIN - FOLDER_ADMIN',
    'operation_id' => 'CockroachCloud_GetPersonUsersByEmail',
    'method' => 'GET',
    'path' => '/api/v1/users/persons-by-email',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'email',
        'in' => 'query',
        'required' => true,
        'description' => 'an email address is required.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
);
    }
}