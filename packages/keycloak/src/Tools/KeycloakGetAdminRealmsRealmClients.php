<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get clients belonging to the realm.
 *
 * Maps to GET /admin/realms/{realm}/clients in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClients extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients',
  'class' => 'KeycloakGetAdminRealmsRealmClients',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients',
  'summary' => 'Get clients belonging to the realm',
  'description' => 'If a client can’t be retrieved from the storage due to a problem with the underlying storage, it is silently removed from the returned list. This ensures that concurrent modifications to the list don’t prevent callers from retrieving this list.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'filter by clientId',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'the first result',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'the max results to return',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `q`.',
    ),
    'search' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'whether this is a search query or a getClientById query',
    ),
    'viewable_only' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'filter clients that cannot be viewed in full by admin',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'clientId' => 'client_id',
    'first' => 'first',
    'max' => 'max',
    'q' => 'q',
    'search' => 'search',
    'viewableOnly' => 'viewable_only',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
