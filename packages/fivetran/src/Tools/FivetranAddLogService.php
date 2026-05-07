<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Group Log Service.
 *
 * Maps to the official Fivetran endpoint post /v1/external-logging.
 */
class FivetranAddLogService extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_log_service';
    protected const DESCRIPTION = 'Create a Group Log Service

Official Fivetran endpoint: POST /v1/external-logging

Creates a new group-level [logging service](/docs/logs/external-logs) within a specified group in your Fivetran account.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/external-logging';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
