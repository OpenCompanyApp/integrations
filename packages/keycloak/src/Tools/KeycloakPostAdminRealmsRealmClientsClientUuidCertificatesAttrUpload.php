<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Upload certificate and eventually private key.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUpload extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUpload',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload',
  'summary' => 'Upload certificate and eventually private key',
  'description' => 'Upload certificate and eventually private key.',
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
  'type' => 'write',
);
}
