<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidInstallationProvidersProviderId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_installation_providers_provider_id',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidInstallationProvidersProviderId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}.',
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
    'provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `providerId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'providerId' => 'provider_id',
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
