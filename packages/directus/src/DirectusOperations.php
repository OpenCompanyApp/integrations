<?php

namespace OpenCompany\Integrations\Directus;

/**
 * Generated metadata for official Directus OpenAPI operations.
 *
 * Source: https://unpkg.com/@directus/specs@13.0.0/dist/openapi.json
 */
class DirectusOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'directus_get_activities' =>
  array (
    'slug' => 'directus_get_activities',
    'class' => 'DirectusGetActivities',
    'method' => 'GET',
    'path' => '/activity',
    'operation_id' => 'getActivities',
    'name' => 'List Activity Actions',
    'description' => 'Returns a list of activity actions.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_activity' =>
  array (
    'slug' => 'directus_get_activity',
    'class' => 'DirectusGetActivity',
    'method' => 'GET',
    'path' => '/activity/{id}',
    'operation_id' => 'getActivity',
    'name' => 'Retrieve an Activity Action',
    'description' => 'Retrieves the details of an existing activity action. Provide the primary key of the activity action and Directus will return the corresponding information.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_asset' =>
  array (
    'slug' => 'directus_get_asset',
    'class' => 'DirectusGetAsset',
    'method' => 'GET',
    'path' => '/assets/{id}',
    'operation_id' => 'getAsset',
    'name' => 'Get an Asset',
    'description' => 'Image typed files can be dynamically resized and transformed to fit any need.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the file.',
      ),
      1 =>
      array (
        'name' => 'key',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The key of the asset size configured in settings.',
      ),
      2 =>
      array (
        'name' => 'transforms',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A JSON array of image transformations',
      ),
      3 =>
      array (
        'name' => 'download',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Download the asset to your computer',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_login' =>
  array (
    'slug' => 'directus_login',
    'class' => 'DirectusLogin',
    'method' => 'POST',
    'path' => '/auth/login',
    'operation_id' => 'login',
    'name' => 'Retrieve a Temporary Access Token',
    'description' => 'Retrieve a Temporary Access Token',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_refresh' =>
  array (
    'slug' => 'directus_refresh',
    'class' => 'DirectusRefresh',
    'method' => 'POST',
    'path' => '/auth/refresh',
    'operation_id' => 'refresh',
    'name' => 'Refresh Token',
    'description' => 'Refresh a Temporary Access Token.',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_logout' =>
  array (
    'slug' => 'directus_logout',
    'class' => 'DirectusLogout',
    'method' => 'POST',
    'path' => '/auth/logout',
    'operation_id' => 'logout',
    'name' => 'Log Out',
    'description' => 'Log Out',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_password_request' =>
  array (
    'slug' => 'directus_password_request',
    'class' => 'DirectusPasswordRequest',
    'method' => 'POST',
    'path' => '/auth/password/request',
    'operation_id' => 'passwordRequest',
    'name' => 'Request a Password Reset',
    'description' => 'Request that a password reset email be sent. This does not apply to users authenticated through external providers OAuth, SAML, LDAP, etc..',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_password_reset' =>
  array (
    'slug' => 'directus_password_reset',
    'class' => 'DirectusPasswordReset',
    'method' => 'POST',
    'path' => '/auth/password/reset',
    'operation_id' => 'passwordReset',
    'name' => 'Reset a Password',
    'description' => 'The request a password reset endpoint sends an email with a link to the admin app which in turn uses this endpoint to allow the user to reset their password.',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_oauth' =>
  array (
    'slug' => 'directus_oauth',
    'class' => 'DirectusOauth',
    'method' => 'GET',
    'path' => '/auth/oauth',
    'operation_id' => 'oauth',
    'name' => 'List OAuth Providers',
    'description' => 'List configured OAuth providers.',
    'type' => 'read',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_oauth_provider' =>
  array (
    'slug' => 'directus_oauth_provider',
    'class' => 'DirectusOauthProvider',
    'method' => 'GET',
    'path' => '/auth/oauth/{provider}',
    'operation_id' => 'oauthProvider',
    'name' => 'Authenticated using an OAuth provider',
    'description' => 'Start OAuth flow using the specified provider',
    'type' => 'read',
    'auth_required' => false,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'provider',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Key of the activated OAuth provider.',
      ),
      1 =>
      array (
        'name' => 'redirect',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Where to redirect on successful login. If set the authentication details are set inside cookies otherwise a JSON is returned.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_list_items' =>
  array (
    'slug' => 'directus_list_items',
    'class' => 'DirectusListItems',
    'method' => 'GET',
    'path' => '/items/{collection}',
    'operation_id' => 'getItems',
    'name' => 'List Items',
    'description' => 'List the items.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      5 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      6 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      7 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_item' =>
  array (
    'slug' => 'directus_create_item',
    'class' => 'DirectusCreateItem',
    'method' => 'POST',
    'path' => '/items/{collection}',
    'operation_id' => 'createItem',
    'name' => 'Create an Item',
    'description' => 'Create a new item.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_items' =>
  array (
    'slug' => 'directus_update_items',
    'class' => 'DirectusUpdateItems',
    'method' => 'PATCH',
    'path' => '/items/{collection}',
    'operation_id' => 'updateItems',
    'name' => 'Update Multiple Items',
    'description' => 'Update multiple items at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      5 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      6 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      7 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_delete_items' =>
  array (
    'slug' => 'directus_delete_items',
    'class' => 'DirectusDeleteItems',
    'method' => 'DELETE',
    'path' => '/items/{collection}',
    'operation_id' => 'deleteItems',
    'name' => 'Delete Multiple Items',
    'description' => 'Delete multiple existing items.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_item' =>
  array (
    'slug' => 'directus_get_item',
    'class' => 'DirectusGetItem',
    'method' => 'GET',
    'path' => '/items/{collection}/{id}',
    'operation_id' => 'getItem',
    'name' => 'Retrieve an Item',
    'description' => 'Retrieve a single item by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Index of the item.',
      ),
      2 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Retrieve an item\'s state from a specific Content Version. The value corresponds to the "key" of the Content Version.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_item' =>
  array (
    'slug' => 'directus_update_item',
    'class' => 'DirectusUpdateItem',
    'method' => 'PATCH',
    'path' => '/items/{collection}/{id}',
    'operation_id' => 'updateItem',
    'name' => 'Update an Item',
    'description' => 'Update an existing item.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Index of the item.',
      ),
      2 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_item' =>
  array (
    'slug' => 'directus_delete_item',
    'class' => 'DirectusDeleteItem',
    'method' => 'DELETE',
    'path' => '/items/{collection}/{id}',
    'operation_id' => 'deleteItem',
    'name' => 'Delete an Item',
    'description' => 'Delete an existing item.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection of which you want to retrieve the items from.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Index of the item.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_presets' =>
  array (
    'slug' => 'directus_get_presets',
    'class' => 'DirectusGetPresets',
    'method' => 'GET',
    'path' => '/presets',
    'operation_id' => 'getPresets',
    'name' => 'List Presets',
    'description' => 'List the presets.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_preset' =>
  array (
    'slug' => 'directus_create_preset',
    'class' => 'DirectusCreatePreset',
    'method' => 'POST',
    'path' => '/presets',
    'operation_id' => 'createPreset',
    'name' => 'Create a Preset',
    'description' => 'Create a new preset.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_presets' =>
  array (
    'slug' => 'directus_update_presets',
    'class' => 'DirectusUpdatePresets',
    'method' => 'PATCH',
    'path' => '/presets',
    'operation_id' => 'updatePresets',
    'name' => 'Update Multiple Presets',
    'description' => 'Update multiple presets at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_presets' =>
  array (
    'slug' => 'directus_delete_presets',
    'class' => 'DirectusDeletePresets',
    'method' => 'DELETE',
    'path' => '/presets',
    'operation_id' => 'deletePresets',
    'name' => 'Delete Multiple Presets',
    'description' => 'Delete multiple existing presets.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_preset' =>
  array (
    'slug' => 'directus_get_preset',
    'class' => 'DirectusGetPreset',
    'method' => 'GET',
    'path' => '/presets/{id}',
    'operation_id' => 'getPreset',
    'name' => 'Retrieve a Preset',
    'description' => 'Retrieve a single preset by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_preset' =>
  array (
    'slug' => 'directus_update_preset',
    'class' => 'DirectusUpdatePreset',
    'method' => 'PATCH',
    'path' => '/presets/{id}',
    'operation_id' => 'updatePreset',
    'name' => 'Update a Preset',
    'description' => 'Update an existing preset.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_preset' =>
  array (
    'slug' => 'directus_delete_preset',
    'class' => 'DirectusDeletePreset',
    'method' => 'DELETE',
    'path' => '/presets/{id}',
    'operation_id' => 'deletePreset',
    'name' => 'Delete a Preset',
    'description' => 'Delete an existing preset.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_list_collections' =>
  array (
    'slug' => 'directus_list_collections',
    'class' => 'DirectusListCollections',
    'method' => 'GET',
    'path' => '/collections',
    'operation_id' => 'getCollections',
    'name' => 'List Collections',
    'description' => 'Returns a list of the collections available in the project.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_collection' =>
  array (
    'slug' => 'directus_create_collection',
    'class' => 'DirectusCreateCollection',
    'method' => 'POST',
    'path' => '/collections',
    'operation_id' => 'createCollection',
    'name' => 'Create a Collection',
    'description' => 'Create a new collection in Directus.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_collection' =>
  array (
    'slug' => 'directus_get_collection',
    'class' => 'DirectusGetCollection',
    'method' => 'GET',
    'path' => '/collections/{id}',
    'operation_id' => 'getCollection',
    'name' => 'Retrieve a Collection',
    'description' => 'Retrieves the details of a single collection.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_collection' =>
  array (
    'slug' => 'directus_update_collection',
    'class' => 'DirectusUpdateCollection',
    'method' => 'PATCH',
    'path' => '/collections/{id}',
    'operation_id' => 'updateCollection',
    'name' => 'Update a Collection',
    'description' => 'Update an existing collection.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_collection' =>
  array (
    'slug' => 'directus_delete_collection',
    'class' => 'DirectusDeleteCollection',
    'method' => 'DELETE',
    'path' => '/collections/{id}',
    'operation_id' => 'deleteCollection',
    'name' => 'Delete a Collection',
    'description' => 'Delete an existing collection. Warning: This will delete the whole collection, including the items within. Proceed with caution.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_comments' =>
  array (
    'slug' => 'directus_get_comments',
    'class' => 'DirectusGetComments',
    'method' => 'GET',
    'path' => '/comments',
    'operation_id' => 'getComments',
    'name' => 'List Comments',
    'description' => 'List the comments.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_comment' =>
  array (
    'slug' => 'directus_create_comment',
    'class' => 'DirectusCreateComment',
    'method' => 'POST',
    'path' => '/comments',
    'operation_id' => 'createComment',
    'name' => 'Create a Comment',
    'description' => 'Create a new comment.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_comments' =>
  array (
    'slug' => 'directus_update_comments',
    'class' => 'DirectusUpdateComments',
    'method' => 'PATCH',
    'path' => '/comments',
    'operation_id' => 'updateComments',
    'name' => 'Update Multiple Comments',
    'description' => 'Update multiple comments at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_comments' =>
  array (
    'slug' => 'directus_delete_comments',
    'class' => 'DirectusDeleteComments',
    'method' => 'DELETE',
    'path' => '/comments',
    'operation_id' => 'deleteComments',
    'name' => 'Delete Multiple Comments',
    'description' => 'Delete multiple existing comments.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_comment' =>
  array (
    'slug' => 'directus_get_comment',
    'class' => 'DirectusGetComment',
    'method' => 'GET',
    'path' => '/comments/{id}',
    'operation_id' => 'getComment',
    'name' => 'Retrieve a Comment',
    'description' => 'Retrieve a single comment by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_comment' =>
  array (
    'slug' => 'directus_update_comment',
    'class' => 'DirectusUpdateComment',
    'method' => 'PATCH',
    'path' => '/comments/{id}',
    'operation_id' => 'updateComment',
    'name' => 'Update a Comment',
    'description' => 'Update an existing comment.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_comment' =>
  array (
    'slug' => 'directus_delete_comment',
    'class' => 'DirectusDeleteComment',
    'method' => 'DELETE',
    'path' => '/comments/{id}',
    'operation_id' => 'deleteComment',
    'name' => 'Delete a Comment',
    'description' => 'Delete an existing comment.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_list_extensions' =>
  array (
    'slug' => 'directus_list_extensions',
    'class' => 'DirectusListExtensions',
    'method' => 'GET',
    'path' => '/extensions',
    'operation_id' => 'listExtensions',
    'name' => 'List Extensions',
    'description' => 'List the installed extensions and their configuration in the project.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_update_extensions' =>
  array (
    'slug' => 'directus_update_extensions',
    'class' => 'DirectusUpdateExtensions',
    'method' => 'PATCH',
    'path' => '/extensions/{name}',
    'operation_id' => 'updateExtensions',
    'name' => 'Update an Extension',
    'description' => 'Update an existing extension.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_extension_bundle' =>
  array (
    'slug' => 'directus_update_extension_bundle',
    'class' => 'DirectusUpdateExtensionBundle',
    'method' => 'PATCH',
    'path' => '/extensions/{bundle}/{name}',
    'operation_id' => 'updateExtensionBundle',
    'name' => 'Update an Extension',
    'description' => 'Update an existing extension.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'bundle',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_fields' =>
  array (
    'slug' => 'directus_get_fields',
    'class' => 'DirectusGetFields',
    'method' => 'GET',
    'path' => '/fields',
    'operation_id' => 'getFields',
    'name' => 'List All Fields',
    'description' => 'Returns a list of the fields available in the project.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_collection_fields' =>
  array (
    'slug' => 'directus_get_collection_fields',
    'class' => 'DirectusGetCollectionFields',
    'method' => 'GET',
    'path' => '/fields/{collection}',
    'operation_id' => 'getCollectionFields',
    'name' => 'List Fields in Collection',
    'description' => 'Returns a list of the fields available in the given collection.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection the item resides in.',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_field' =>
  array (
    'slug' => 'directus_create_field',
    'class' => 'DirectusCreateField',
    'method' => 'POST',
    'path' => '/fields/{collection}',
    'operation_id' => 'createField',
    'name' => 'Create Field in Collection',
    'description' => 'Create a new field in a given collection.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection the item resides in.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_collection_field' =>
  array (
    'slug' => 'directus_get_collection_field',
    'class' => 'DirectusGetCollectionField',
    'method' => 'GET',
    'path' => '/fields/{collection}/{id}',
    'operation_id' => 'getCollectionField',
    'name' => 'Retrieve a Field',
    'description' => 'Retrieves the details of a single field in a given collection.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection the item resides in.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the field.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_field' =>
  array (
    'slug' => 'directus_update_field',
    'class' => 'DirectusUpdateField',
    'method' => 'PATCH',
    'path' => '/fields/{collection}/{id}',
    'operation_id' => 'updateField',
    'name' => 'Update a Field',
    'description' => 'Update an existing field.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection the item resides in.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the field.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_field' =>
  array (
    'slug' => 'directus_delete_field',
    'class' => 'DirectusDeleteField',
    'method' => 'DELETE',
    'path' => '/fields/{collection}/{id}',
    'operation_id' => 'deleteField',
    'name' => 'Delete a Field',
    'description' => 'Delete an existing field.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the collection the item resides in.',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier of the field.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_files' =>
  array (
    'slug' => 'directus_get_files',
    'class' => 'DirectusGetFiles',
    'method' => 'GET',
    'path' => '/files',
    'operation_id' => 'getFiles',
    'name' => 'List Files',
    'description' => 'List the files.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      4 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      5 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      6 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_file' =>
  array (
    'slug' => 'directus_create_file',
    'class' => 'DirectusCreateFile',
    'method' => 'POST',
    'path' => '/files',
    'operation_id' => 'createFile',
    'name' => 'Create a File',
    'description' => 'Create a new file',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_files' =>
  array (
    'slug' => 'directus_update_files',
    'class' => 'DirectusUpdateFiles',
    'method' => 'PATCH',
    'path' => '/files',
    'operation_id' => 'updateFiles',
    'name' => 'Update Multiple Files',
    'description' => 'Update multiple files at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_files' =>
  array (
    'slug' => 'directus_delete_files',
    'class' => 'DirectusDeleteFiles',
    'method' => 'DELETE',
    'path' => '/files',
    'operation_id' => 'deleteFiles',
    'name' => 'Delete Multiple Files',
    'description' => 'Delete multiple existing files.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_file' =>
  array (
    'slug' => 'directus_get_file',
    'class' => 'DirectusGetFile',
    'method' => 'GET',
    'path' => '/files/{id}',
    'operation_id' => 'getFile',
    'name' => 'Retrieve a Files',
    'description' => 'Retrieve a single file by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_file' =>
  array (
    'slug' => 'directus_update_file',
    'class' => 'DirectusUpdateFile',
    'method' => 'PATCH',
    'path' => '/files/{id}',
    'operation_id' => 'updateFile',
    'name' => 'Update a File',
    'description' => 'Update an existing file, and/or replace it\'s file contents.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'multipart/data',
        1 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_file' =>
  array (
    'slug' => 'directus_delete_file',
    'class' => 'DirectusDeleteFile',
    'method' => 'DELETE',
    'path' => '/files/{id}',
    'operation_id' => 'deleteFile',
    'name' => 'Delete a File',
    'description' => 'Delete an existing file.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_flows' =>
  array (
    'slug' => 'directus_get_flows',
    'class' => 'DirectusGetFlows',
    'method' => 'GET',
    'path' => '/flows',
    'operation_id' => 'getFlows',
    'name' => 'List Flows',
    'description' => 'Get all flows.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_create_flow' =>
  array (
    'slug' => 'directus_create_flow',
    'class' => 'DirectusCreateFlow',
    'method' => 'POST',
    'path' => '/flows',
    'operation_id' => 'createFlow',
    'name' => 'Create a Flow',
    'description' => 'Create a new flow.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_flows' =>
  array (
    'slug' => 'directus_update_flows',
    'class' => 'DirectusUpdateFlows',
    'method' => 'PATCH',
    'path' => '/flows',
    'operation_id' => 'updateFlows',
    'name' => 'Update Multiple Flows',
    'description' => 'Update multiple flows at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_flows' =>
  array (
    'slug' => 'directus_delete_flows',
    'class' => 'DirectusDeleteFlows',
    'method' => 'DELETE',
    'path' => '/flows',
    'operation_id' => 'deleteFlows',
    'name' => 'Delete Multiple Flows',
    'description' => 'Delete multiple existing flows.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_flow' =>
  array (
    'slug' => 'directus_get_flow',
    'class' => 'DirectusGetFlow',
    'method' => 'GET',
    'path' => '/flows/{id}',
    'operation_id' => 'getFlow',
    'name' => 'Retrieve a Flow',
    'description' => 'Retrieve a single flow by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_flow' =>
  array (
    'slug' => 'directus_update_flow',
    'class' => 'DirectusUpdateFlow',
    'method' => 'PATCH',
    'path' => '/flows/{id}',
    'operation_id' => 'updateFlow',
    'name' => 'Update a Flow',
    'description' => 'Update an existing flow',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_flow' =>
  array (
    'slug' => 'directus_delete_flow',
    'class' => 'DirectusDeleteFlow',
    'method' => 'DELETE',
    'path' => '/flows/{id}',
    'operation_id' => 'deleteFlow',
    'name' => 'Delete a Flow',
    'description' => 'Delete an existing flow',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_folders' =>
  array (
    'slug' => 'directus_get_folders',
    'class' => 'DirectusGetFolders',
    'method' => 'GET',
    'path' => '/folders',
    'operation_id' => 'getFolders',
    'name' => 'List Folders',
    'description' => 'List the folders.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      4 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      5 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      6 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_folder' =>
  array (
    'slug' => 'directus_create_folder',
    'class' => 'DirectusCreateFolder',
    'method' => 'POST',
    'path' => '/folders',
    'operation_id' => 'createFolder',
    'name' => 'Create a Folder',
    'description' => 'Create a new folder.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_folders' =>
  array (
    'slug' => 'directus_update_folders',
    'class' => 'DirectusUpdateFolders',
    'method' => 'PATCH',
    'path' => '/folders',
    'operation_id' => 'updateFolders',
    'name' => 'Update Multiple Folders',
    'description' => 'Update multiple folders at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_folders' =>
  array (
    'slug' => 'directus_delete_folders',
    'class' => 'DirectusDeleteFolders',
    'method' => 'DELETE',
    'path' => '/folders',
    'operation_id' => 'deleteFolders',
    'name' => 'Delete Multiple Folders',
    'description' => 'Delete multiple existing folders.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_folder' =>
  array (
    'slug' => 'directus_get_folder',
    'class' => 'DirectusGetFolder',
    'method' => 'GET',
    'path' => '/folders/{id}',
    'operation_id' => 'getFolder',
    'name' => 'Retrieve a Folder',
    'description' => 'Retrieve a single folder by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_folder' =>
  array (
    'slug' => 'directus_update_folder',
    'class' => 'DirectusUpdateFolder',
    'method' => 'PATCH',
    'path' => '/folders/{id}',
    'operation_id' => 'updateFolder',
    'name' => 'Update a Folder',
    'description' => 'Update an existing folder',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_folder' =>
  array (
    'slug' => 'directus_delete_folder',
    'class' => 'DirectusDeleteFolder',
    'method' => 'DELETE',
    'path' => '/folders/{id}',
    'operation_id' => 'deleteFolder',
    'name' => 'Delete a Folder',
    'description' => 'Delete an existing folder',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_operations' =>
  array (
    'slug' => 'directus_get_operations',
    'class' => 'DirectusGetOperations',
    'method' => 'GET',
    'path' => '/operations',
    'operation_id' => 'getOperations',
    'name' => 'List Operations',
    'description' => 'Get all operations.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_create_operation' =>
  array (
    'slug' => 'directus_create_operation',
    'class' => 'DirectusCreateOperation',
    'method' => 'POST',
    'path' => '/operations',
    'operation_id' => 'createOperation',
    'name' => 'Create an Operation',
    'description' => 'Create a new operation.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_operations' =>
  array (
    'slug' => 'directus_update_operations',
    'class' => 'DirectusUpdateOperations',
    'method' => 'PATCH',
    'path' => '/operations',
    'operation_id' => 'updateOperations',
    'name' => 'Update Multiple Operations',
    'description' => 'Update multiple operations at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_operations' =>
  array (
    'slug' => 'directus_delete_operations',
    'class' => 'DirectusDeleteOperations',
    'method' => 'DELETE',
    'path' => '/operations',
    'operation_id' => 'deleteOperations',
    'name' => 'Delete Multiple Operations',
    'description' => 'Delete multiple existing operations.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_operation' =>
  array (
    'slug' => 'directus_get_operation',
    'class' => 'DirectusGetOperation',
    'method' => 'GET',
    'path' => '/operations/{id}',
    'operation_id' => 'getOperation',
    'name' => 'Retrieve an Operation',
    'description' => 'Retrieve a single operation by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_operation' =>
  array (
    'slug' => 'directus_update_operation',
    'class' => 'DirectusUpdateOperation',
    'method' => 'PATCH',
    'path' => '/operations/{id}',
    'operation_id' => 'updateOperation',
    'name' => 'Update an Operation',
    'description' => 'Update an existing operation',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_operation' =>
  array (
    'slug' => 'directus_delete_operation',
    'class' => 'DirectusDeleteOperation',
    'method' => 'DELETE',
    'path' => '/operations/{id}',
    'operation_id' => 'deleteOperation',
    'name' => 'Delete an Operation',
    'description' => 'Delete an existing operation',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_permissions' =>
  array (
    'slug' => 'directus_get_permissions',
    'class' => 'DirectusGetPermissions',
    'method' => 'GET',
    'path' => '/permissions',
    'operation_id' => 'getPermissions',
    'name' => 'List Permissions',
    'description' => 'List all permissions.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_permission' =>
  array (
    'slug' => 'directus_create_permission',
    'class' => 'DirectusCreatePermission',
    'method' => 'POST',
    'path' => '/permissions',
    'operation_id' => 'createPermission',
    'name' => 'Create a Permission',
    'description' => 'Create a new permission.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_permissions' =>
  array (
    'slug' => 'directus_update_permissions',
    'class' => 'DirectusUpdatePermissions',
    'method' => 'PATCH',
    'path' => '/permissions',
    'operation_id' => 'updatePermissions',
    'name' => 'Update Multiple Permissions',
    'description' => 'Update multiple permissions at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_permissions' =>
  array (
    'slug' => 'directus_delete_permissions',
    'class' => 'DirectusDeletePermissions',
    'method' => 'DELETE',
    'path' => '/permissions',
    'operation_id' => 'deletePermissions',
    'name' => 'Delete Multiple Permissions',
    'description' => 'Delete multiple existing permissions.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_my_permissions' =>
  array (
    'slug' => 'directus_get_my_permissions',
    'class' => 'DirectusGetMyPermissions',
    'method' => 'GET',
    'path' => '/permissions/me',
    'operation_id' => 'getMyPermissions',
    'name' => 'List My Permissions',
    'description' => 'List the permissions that apply to the current user.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_permission' =>
  array (
    'slug' => 'directus_get_permission',
    'class' => 'DirectusGetPermission',
    'method' => 'GET',
    'path' => '/permissions/{id}',
    'operation_id' => 'getPermission',
    'name' => 'Retrieve a Permission',
    'description' => 'Retrieve a single permissions object by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_permission' =>
  array (
    'slug' => 'directus_update_permission',
    'class' => 'DirectusUpdatePermission',
    'method' => 'PATCH',
    'path' => '/permissions/{id}',
    'operation_id' => 'updatePermission',
    'name' => 'Update a Permission',
    'description' => 'Update an existing permission',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_permission' =>
  array (
    'slug' => 'directus_delete_permission',
    'class' => 'DirectusDeletePermission',
    'method' => 'DELETE',
    'path' => '/permissions/{id}',
    'operation_id' => 'deletePermission',
    'name' => 'Delete a Permission',
    'description' => 'Delete an existing permission',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_relations' =>
  array (
    'slug' => 'directus_get_relations',
    'class' => 'DirectusGetRelations',
    'method' => 'GET',
    'path' => '/relations',
    'operation_id' => 'getRelations',
    'name' => 'List Relations',
    'description' => 'List the relations.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_relation' =>
  array (
    'slug' => 'directus_create_relation',
    'class' => 'DirectusCreateRelation',
    'method' => 'POST',
    'path' => '/relations',
    'operation_id' => 'createRelation',
    'name' => 'Create a Relation',
    'description' => 'Create a new relation.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_relation' =>
  array (
    'slug' => 'directus_get_relation',
    'class' => 'DirectusGetRelation',
    'method' => 'GET',
    'path' => '/relations/{id}',
    'operation_id' => 'getRelation',
    'name' => 'Retrieve a Relation',
    'description' => 'Retrieve a single relation by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_relation' =>
  array (
    'slug' => 'directus_update_relation',
    'class' => 'DirectusUpdateRelation',
    'method' => 'PATCH',
    'path' => '/relations/{id}',
    'operation_id' => 'updateRelation',
    'name' => 'Update a Relation',
    'description' => 'Update an existing relation',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_relation' =>
  array (
    'slug' => 'directus_delete_relation',
    'class' => 'DirectusDeleteRelation',
    'method' => 'DELETE',
    'path' => '/relations/{id}',
    'operation_id' => 'deleteRelation',
    'name' => 'Delete a Relation',
    'description' => 'Delete an existing relation.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_revisions' =>
  array (
    'slug' => 'directus_get_revisions',
    'class' => 'DirectusGetRevisions',
    'method' => 'GET',
    'path' => '/revisions',
    'operation_id' => 'getRevisions',
    'name' => 'List Revisions',
    'description' => 'List the revisions.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_revision' =>
  array (
    'slug' => 'directus_get_revision',
    'class' => 'DirectusGetRevision',
    'method' => 'GET',
    'path' => '/revisions/{id}',
    'operation_id' => 'getRevision',
    'name' => 'Retrieve a Revision',
    'description' => 'Retrieve a single revision by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Index',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_roles' =>
  array (
    'slug' => 'directus_get_roles',
    'class' => 'DirectusGetRoles',
    'method' => 'GET',
    'path' => '/roles',
    'operation_id' => 'getRoles',
    'name' => 'List Roles',
    'description' => 'List the roles.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
      7 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_role' =>
  array (
    'slug' => 'directus_create_role',
    'class' => 'DirectusCreateRole',
    'method' => 'POST',
    'path' => '/roles',
    'operation_id' => 'createRole',
    'name' => 'Create a Role',
    'description' => 'Create a new role.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_roles' =>
  array (
    'slug' => 'directus_update_roles',
    'class' => 'DirectusUpdateRoles',
    'method' => 'PATCH',
    'path' => '/roles',
    'operation_id' => 'updateRoles',
    'name' => 'Update Multiple Roles',
    'description' => 'Update multiple roles at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_roles' =>
  array (
    'slug' => 'directus_delete_roles',
    'class' => 'DirectusDeleteRoles',
    'method' => 'DELETE',
    'path' => '/roles',
    'operation_id' => 'deleteRoles',
    'name' => 'Delete Multiple Roles',
    'description' => 'Delete multiple existing roles.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_role' =>
  array (
    'slug' => 'directus_get_role',
    'class' => 'DirectusGetRole',
    'method' => 'GET',
    'path' => '/roles/{id}',
    'operation_id' => 'getRole',
    'name' => 'Retrieve a Role',
    'description' => 'Retrieve a single role by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_role' =>
  array (
    'slug' => 'directus_update_role',
    'class' => 'DirectusUpdateRole',
    'method' => 'PATCH',
    'path' => '/roles/{id}',
    'operation_id' => 'updateRole',
    'name' => 'Update a Role',
    'description' => 'Update an existing role',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_role' =>
  array (
    'slug' => 'directus_delete_role',
    'class' => 'DirectusDeleteRole',
    'method' => 'DELETE',
    'path' => '/roles/{id}',
    'operation_id' => 'deleteRole',
    'name' => 'Delete a Role',
    'description' => 'Delete an existing role',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_schema_snapshot' =>
  array (
    'slug' => 'directus_schema_snapshot',
    'class' => 'DirectusSchemaSnapshot',
    'method' => 'GET',
    'path' => '/schema/snapshot',
    'operation_id' => 'schemaSnapshot',
    'name' => 'Retrieve Schema Snapshot',
    'description' => 'Retrieve the current schema. This endpoint is only available to admin users.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'export',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Saves the API response to a file. Accepts one of "csv", "csvutf8", "json", "xml", "yaml".',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_schema_apply' =>
  array (
    'slug' => 'directus_schema_apply',
    'class' => 'DirectusSchemaApply',
    'method' => 'POST',
    'path' => '/schema/apply',
    'operation_id' => 'schemaApply',
    'name' => 'Apply Schema Difference',
    'description' => 'Update the instance\'s schema by passing the diff previously retrieved via /schema/diff endpoint in the JSON request body or a JSON/YAML file. This endpoint is only available to admin users.',
    'type' => 'write',
    'auth_required' => true,
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
        1 => 'multipart/form-data',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_schema_diff' =>
  array (
    'slug' => 'directus_schema_diff',
    'class' => 'DirectusSchemaDiff',
    'method' => 'POST',
    'path' => '/schema/diff',
    'operation_id' => 'schemaDiff',
    'name' => 'Retrieve Schema Difference',
    'description' => 'Compare the current instance\'s schema against the schema snapshot in JSON request body or a JSON/YAML file and retrieve the difference. This endpoint is only available to admin users.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'force',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Bypass version and database vendor restrictions.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'multipart/form-data',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_server_info' =>
  array (
    'slug' => 'directus_server_info',
    'class' => 'DirectusServerInfo',
    'method' => 'GET',
    'path' => '/server/info',
    'operation_id' => 'serverInfo',
    'name' => 'System Info',
    'description' => 'Perform a system status check and return the options.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'super_admin_token',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The first time you create a project, the provided token will be saved and required for subsequent project installs. It can also be found and configured in /config/api.json on your server.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_ping' =>
  array (
    'slug' => 'directus_ping',
    'class' => 'DirectusPing',
    'method' => 'GET',
    'path' => '/server/ping',
    'operation_id' => 'ping',
    'name' => 'Ping',
    'description' => 'Ping, pong. Ping.. pong.',
    'type' => 'read',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_settings' =>
  array (
    'slug' => 'directus_get_settings',
    'class' => 'DirectusGetSettings',
    'method' => 'GET',
    'path' => '/settings',
    'operation_id' => 'getSettings',
    'name' => 'Retrieve Settings',
    'description' => 'List the settings.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      1 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Cursor for use in pagination. Often used in combination with limit.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_setting' =>
  array (
    'slug' => 'directus_update_setting',
    'class' => 'DirectusUpdateSetting',
    'method' => 'PATCH',
    'path' => '/settings',
    'operation_id' => 'updateSetting',
    'name' => 'Update Settings',
    'description' => 'Update the settings',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_users' =>
  array (
    'slug' => 'directus_get_users',
    'class' => 'DirectusGetUsers',
    'method' => 'GET',
    'path' => '/users',
    'operation_id' => 'getUsers',
    'name' => 'List Users',
    'description' => 'List the users.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_user' =>
  array (
    'slug' => 'directus_create_user',
    'class' => 'DirectusCreateUser',
    'method' => 'POST',
    'path' => '/users',
    'operation_id' => 'createUser',
    'name' => 'Create a User',
    'description' => 'Create a new user.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_users' =>
  array (
    'slug' => 'directus_update_users',
    'class' => 'DirectusUpdateUsers',
    'method' => 'PATCH',
    'path' => '/users',
    'operation_id' => 'updateUsers',
    'name' => 'Update Multiple Users',
    'description' => 'Update multiple users at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_users' =>
  array (
    'slug' => 'directus_delete_users',
    'class' => 'DirectusDeleteUsers',
    'method' => 'DELETE',
    'path' => '/users',
    'operation_id' => 'deleteUsers',
    'name' => 'Delete Multiple Users',
    'description' => 'Delete multiple existing users.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_user' =>
  array (
    'slug' => 'directus_get_user',
    'class' => 'DirectusGetUser',
    'method' => 'GET',
    'path' => '/users/{id}',
    'operation_id' => 'getUser',
    'name' => 'Retrieve a User',
    'description' => 'Retrieve a single user by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_user' =>
  array (
    'slug' => 'directus_update_user',
    'class' => 'DirectusUpdateUser',
    'method' => 'PATCH',
    'path' => '/users/{id}',
    'operation_id' => 'updateUser',
    'name' => 'Update a User',
    'description' => 'Update an existing user',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_user' =>
  array (
    'slug' => 'directus_delete_user',
    'class' => 'DirectusDeleteUser',
    'method' => 'DELETE',
    'path' => '/users/{id}',
    'operation_id' => 'deleteUser',
    'name' => 'Delete a User',
    'description' => 'Delete an existing user',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_invite' =>
  array (
    'slug' => 'directus_invite',
    'class' => 'DirectusInvite',
    'method' => 'POST',
    'path' => '/users/invite',
    'operation_id' => 'invite',
    'name' => 'Invite Users',
    'description' => 'Invites one or more users to this project. It creates a user with an invited status, and then sends an email to the user with instructions on how to activate their account.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_accept_invite' =>
  array (
    'slug' => 'directus_accept_invite',
    'class' => 'DirectusAcceptInvite',
    'method' => 'POST',
    'path' => '/users/invite/accept',
    'operation_id' => 'acceptInvite',
    'name' => 'Accept User Invite',
    'description' => 'Accepts and enables an invited user using a JWT invitation token.',
    'type' => 'write',
    'auth_required' => true,
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_get_current_user' =>
  array (
    'slug' => 'directus_get_current_user',
    'class' => 'DirectusGetCurrentUser',
    'method' => 'GET',
    'path' => '/users/me',
    'operation_id' => 'getMe',
    'name' => 'Retrieve Current User',
    'description' => 'Retrieve the currently authenticated user.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_me' =>
  array (
    'slug' => 'directus_update_me',
    'class' => 'DirectusUpdateMe',
    'method' => 'PATCH',
    'path' => '/users/me',
    'operation_id' => 'updateMe',
    'name' => 'Update Current User',
    'description' => 'Update the currently authenticated user.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_update_last_used_page_me' =>
  array (
    'slug' => 'directus_update_last_used_page_me',
    'class' => 'DirectusUpdateLastUsedPageMe',
    'method' => 'PATCH',
    'path' => '/users/me/track/page',
    'operation_id' => 'updateLastUsedPageMe',
    'name' => 'Update Last Page',
    'description' => 'Updates the last used page field of the currently authenticated user. This is used internally to be able to open the Directus admin app from the last page you used.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_me_tfa_enable' =>
  array (
    'slug' => 'directus_me_tfa_enable',
    'class' => 'DirectusMeTfaEnable',
    'method' => 'POST',
    'path' => '/users/me/tfa/enable',
    'operation_id' => 'meTfaEnable',
    'name' => 'Enable 2FA',
    'description' => 'Enables two-factor authentication for the currently authenticated user.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_me_tfa_disable' =>
  array (
    'slug' => 'directus_me_tfa_disable',
    'class' => 'DirectusMeTfaDisable',
    'method' => 'POST',
    'path' => '/users/me/tfa/disable',
    'operation_id' => 'meTfaDisable',
    'name' => 'Disable 2FA',
    'description' => 'Disables two-factor authentication for the currently authenticated user.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_hash_generate' =>
  array (
    'slug' => 'directus_hash_generate',
    'class' => 'DirectusHashGenerate',
    'method' => 'POST',
    'path' => '/utils/hash/generate',
    'operation_id' => 'hash-generate',
    'name' => 'Hash a string',
    'description' => 'Generate a hash for a given string.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_hash_verify' =>
  array (
    'slug' => 'directus_hash_verify',
    'class' => 'DirectusHashVerify',
    'method' => 'POST',
    'path' => '/utils/hash/verify',
    'operation_id' => 'hash-verify',
    'name' => 'Hash a string',
    'description' => 'Generate a hash for a given string.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_sort' =>
  array (
    'slug' => 'directus_sort',
    'class' => 'DirectusSort',
    'method' => 'POST',
    'path' => '/utils/sort/{collection}',
    'operation_id' => 'sort',
    'name' => 'Sort Items',
    'description' => 'Re-sort items in collection based on start and to value of item',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection identifier',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_import' =>
  array (
    'slug' => 'directus_import',
    'class' => 'DirectusImport',
    'method' => 'POST',
    'path' => '/utils/import/{collection}',
    'operation_id' => 'import',
    'name' => 'Import Items',
    'description' => 'Import multiple records from a JSON or CSV file into a collection.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection identifier',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'multipart/form-data',
      ),
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_export' =>
  array (
    'slug' => 'directus_export',
    'class' => 'DirectusExport',
    'method' => 'POST',
    'path' => '/utils/export/{collection}',
    'operation_id' => 'export',
    'name' => 'Export Items',
    'description' => 'Export a larger data set to a file in the File Library',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collection',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Collection identifier',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_clear_cache' =>
  array (
    'slug' => 'directus_clear_cache',
    'class' => 'DirectusClearCache',
    'method' => 'POST',
    'path' => '/utils/cache/clear',
    'operation_id' => 'clear-cache',
    'name' => 'Clear Cache',
    'description' => 'Resets both the data and schema cache of Directus.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_random' =>
  array (
    'slug' => 'directus_random',
    'class' => 'DirectusRandom',
    'method' => 'GET',
    'path' => '/utils/random/string',
    'operation_id' => 'random',
    'name' => 'Get a Random String',
    'description' => 'Returns a random string of given length.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'length',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Length of the random string.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_get_content_versions' =>
  array (
    'slug' => 'directus_get_content_versions',
    'class' => 'DirectusGetContentVersions',
    'method' => 'GET',
    'path' => '/versions',
    'operation_id' => 'getContentVersions',
    'name' => 'List Content Versions',
    'description' => 'Get all Content Versions.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      3 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_create_content_version' =>
  array (
    'slug' => 'directus_create_content_version',
    'class' => 'DirectusCreateContentVersion',
    'method' => 'POST',
    'path' => '/versions',
    'operation_id' => 'createContentVersion',
    'name' => 'Create Multiple Content Versions',
    'description' => 'Create multiple new Content Versions.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_update_content_versions' =>
  array (
    'slug' => 'directus_update_content_versions',
    'class' => 'DirectusUpdateContentVersions',
    'method' => 'PATCH',
    'path' => '/versions',
    'operation_id' => 'updateContentVersions',
    'name' => 'Update Multiple Content Versions',
    'description' => 'Update multiple Content Versions at the same time.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'A limit on the number of objects that are returned.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'How many items to skip when fetching data.',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'How to sort the returned items. sort is a CSV of fields used to sort the fetched items. Sorting defaults to ascending ASC order but a minus sign - can be used to reverse this to descending DESC order. Fields are prioritized by their order in the CSV. You can also use a ? to sort randomly.',
      ),
      5 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Select items in collection by given conditions.',
      ),
      6 =>
      array (
        'name' => 'search',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter by items that contain the given search query in one of their fields.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_content_versions' =>
  array (
    'slug' => 'directus_delete_content_versions',
    'class' => 'DirectusDeleteContentVersions',
    'method' => 'DELETE',
    'path' => '/versions',
    'operation_id' => 'deleteContentVersions',
    'name' => 'Delete Multiple Content Versions',
    'description' => 'Delete multiple existing Content Versions.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'directus_get_content_version' =>
  array (
    'slug' => 'directus_get_content_version',
    'class' => 'DirectusGetContentVersion',
    'method' => 'GET',
    'path' => '/versions/{id}',
    'operation_id' => 'getContentVersion',
    'name' => 'Retrieve a Content Version',
    'description' => 'Retrieve a single Content Version by unique identifier.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_update_content_version' =>
  array (
    'slug' => 'directus_update_content_version',
    'class' => 'DirectusUpdateContentVersion',
    'method' => 'PATCH',
    'path' => '/versions/{id}',
    'operation_id' => 'updateContentVersion',
    'name' => 'Update a Content Version',
    'description' => 'Update an existing Content Version.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'Control what fields are being returned in the object.',
      ),
      2 =>
      array (
        'name' => 'meta',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'What metadata to return in the response.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_delete_content_version' =>
  array (
    'slug' => 'directus_delete_content_version',
    'class' => 'DirectusDeleteContentVersion',
    'method' => 'DELETE',
    'path' => '/versions/{id}',
    'operation_id' => 'deleteContentVersion',
    'name' => 'Delete a Content Version',
    'description' => 'Delete an existing Content Version.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_save_content_version' =>
  array (
    'slug' => 'directus_save_content_version',
    'class' => 'DirectusSaveContentVersion',
    'method' => 'POST',
    'path' => '/versions/{id}/save',
    'operation_id' => 'saveContentVersion',
    'name' => 'Save to a Content Version',
    'description' => 'Save item changes to an existing Content Version.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
  'directus_compare_content_version' =>
  array (
    'slug' => 'directus_compare_content_version',
    'class' => 'DirectusCompareContentVersion',
    'method' => 'GET',
    'path' => '/versions/{id}/compare',
    'operation_id' => 'compareContentVersion',
    'name' => 'Compare a Content Version',
    'description' => 'Compare an existing Content Version with the main version of the item.',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
      ),
    ),
    'request_body' => NULL,
  ),
  'directus_promote_content_version' =>
  array (
    'slug' => 'directus_promote_content_version',
    'class' => 'DirectusPromoteContentVersion',
    'method' => 'POST',
    'path' => '/versions/{id}/promote',
    'operation_id' => 'promoteContentVersion',
    'name' => 'Promote a Content Version',
    'description' => 'Pass the current hash of the main version of the item obtained from the compare endpoint along with an optional array of field names of which the values are to be promoted by default, all fields are selected.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier for the object.',
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
      'description' => 'Request body for the Directus API operation.',
    ),
  ),
);
    }
}
