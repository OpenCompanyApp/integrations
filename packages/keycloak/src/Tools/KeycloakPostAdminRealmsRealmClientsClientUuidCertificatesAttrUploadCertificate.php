<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Upload only certificate, not private key.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload-certificate in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUploadCertificate extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload_certificate',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUploadCertificate',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload-certificate',
  'summary' => 'Upload only certificate, not private key',
  'description' => 'Upload only certificate, not private key.',
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
