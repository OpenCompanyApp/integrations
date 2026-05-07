<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation.
 *
 * Maps to POST /admin/realms/{realm}/identity-provider/upload-certificate in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmIdentityProviderUploadCertificate extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_identity_provider_upload_certificate',
  'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderUploadCertificate',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/identity-provider/upload-certificate',
  'summary' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation',
  'description' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
