<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Identity Provider Connection Test Results With Id.
 *
 * Maps to GET /api/identity-provider/test in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIdentityProviderConnectionTestResultsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_identity_provider_connection_test_results_with_id',
  'class' => 'FusionAuthRetrieveIdentityProviderConnectionTestResultsWithId',
  'method' => 'GET',
  'path' => '/api/identity-provider/test',
  'operation_id' => 'retrieveIdentityProviderConnectionTestResultsWithId',
  'summary' => 'retrieve Identity Provider Connection Test Results With Id',
  'description' => 'Retrieves the results for an identity provider connection test.',
  'parameters' =>
  array (
    'connection_test_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The connection test id to retrieve results for.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'connectionTestId' => 'connection_test_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
