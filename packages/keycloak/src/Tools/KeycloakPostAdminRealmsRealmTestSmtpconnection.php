<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Test SMTP connection with current logged in user.
 *
 * Maps to POST /admin/realms/{realm}/testSMTPConnection in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmTestSmtpconnection extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_test_smtpconnection',
  'class' => 'KeycloakPostAdminRealmsRealmTestSmtpconnection',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/testSMTPConnection',
  'summary' => 'Test SMTP connection with current logged in user',
  'description' => 'Test SMTP connection with current logged in user.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
