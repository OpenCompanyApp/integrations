<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Run Destination Setup Tests.
 *
 * Maps to the official Fivetran endpoint post /v1/destinations/{destinationId}/test.
 */
class FivetranRunDestinationSetupTests extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_run_destination_setup_tests';
    protected const DESCRIPTION = 'Run Destination Setup Tests

Official Fivetran endpoint: POST /v1/destinations/{destinationId}/test

Runs the setup tests for an existing destination within your Fivetran account.';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Fivetran API operation. The unique identifier for the destination within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/destinations/{destinationId}/test';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
