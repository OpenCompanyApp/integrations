<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Push the client's revocation policy to its admin URL If the client has an admin URL, push revocation policy to it.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/push-revocation in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidPushRevocation extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_push_revocation',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidPushRevocation',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/push-revocation',
  'summary' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it',
  'description' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'id of client (not client-id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
);
}
