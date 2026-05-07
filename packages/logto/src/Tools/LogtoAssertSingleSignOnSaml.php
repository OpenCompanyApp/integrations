<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * SAML ACS endpoint (SSO).
 *
 * Maps to POST /api/authn/single-sign-on/saml/{connectorId} in the official Logto OpenAPI source.
 */
class LogtoAssertSingleSignOnSaml extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assert_single_sign_on_saml',
  'class' => 'LogtoAssertSingleSignOnSaml',
  'method' => 'POST',
  'path' => '/api/authn/single-sign-on/saml/{connectorId}',
  'operation_id' => 'AssertSingleSignOnSaml',
  'summary' => 'SAML ACS endpoint (SSO)',
  'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) single sign-on (SSO) connectors. This endpoint is used to complete the SAML SSO authentication flow. It receives the SAML assertion response from the identity provider (IdP) and redirects the user to complete the authentication flow.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'connectorId' => 'connector_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
