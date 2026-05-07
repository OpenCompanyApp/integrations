<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get key info.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/certificates/{attr} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidCertificatesAttr extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_certificates_attr',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidCertificatesAttr',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}',
  'summary' => 'Get key info',
  'description' => 'Get key info.',
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
    'attr' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `attr`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'attr' => 'attr',
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
);
}
