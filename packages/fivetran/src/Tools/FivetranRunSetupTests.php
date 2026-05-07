<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Run Connection Setup Tests.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/test.
 */
class FivetranRunSetupTests extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_run_setup_tests';
    protected const DESCRIPTION = 'Run Connection Setup Tests

Official Fivetran endpoint: POST /v1/connections/{connectionId}/test

Runs the setup tests for an existing connection within your Fivetran account. Use this parameter to test the connection without making any configuration changes. You can optionally include `trust_certificates` or `trust_fingerprints` parameters to automatically approve certificates or fingerprints during the test run.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
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
    protected const PATH = '/v1/connections/{connectionId}/test';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
