<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Run Group Log Service Setup Tests.
 *
 * Maps to the official Fivetran endpoint post /v1/external-logging/{logId}/test.
 */
class FivetranRunSetupTestsLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_run_setup_tests_log_service';
    protected const DESCRIPTION = 'Run Group Log Service Setup Tests

Official Fivetran endpoint: POST /v1/external-logging/{logId}/test

Runs the setup tests for an existing group-level [logging service](/docs/logs/external-logs) within your Fivetran account.';
    protected const PARAMETERS = array (
  'log_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `logId` from the official Fivetran API operation. The unique identifier for the log service within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/external-logging/{logId}/test';
    protected const PATH_PARAMS = array (
  'logId' => 'log_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
