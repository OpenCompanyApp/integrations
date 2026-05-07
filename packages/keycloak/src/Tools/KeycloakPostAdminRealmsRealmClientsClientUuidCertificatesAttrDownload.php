<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get a keystore file for the client, containing private key and public certificate.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/download in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrDownload extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_download',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrDownload',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/download',
  'summary' => 'Get a keystore file for the client, containing private key and public certificate',
  'description' => 'Get a keystore file for the client, containing private key and public certificate.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
