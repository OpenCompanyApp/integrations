<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * SAML ACS endpoint (social).
 *
 * Maps to POST /api/authn/saml/{connectorId} in the official Logto OpenAPI source.
 */
class LogtoAssertSaml extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assert_saml',
  'class' => 'LogtoAssertSaml',
  'method' => 'POST',
  'path' => '/api/authn/saml/{connectorId}',
  'operation_id' => 'AssertSaml',
  'summary' => 'SAML ACS endpoint (social)',
  'description' => 'The Assertion Consumer Service (ACS) endpoint for Simple Assertion Markup Language (SAML) social connectors. SAML social connectors are deprecated. Use the SSO SAML connector instead.',
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
