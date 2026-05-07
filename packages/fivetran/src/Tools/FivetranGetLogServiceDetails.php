<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Group Log Service Details.
 *
 * Maps to the official Fivetran endpoint get /v1/external-logging/{logId}.
 */
class FivetranGetLogServiceDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_log_service_details';
    protected const DESCRIPTION = 'Retrieve Group Log Service Details

Official Fivetran endpoint: GET /v1/external-logging/{logId}

Returns a group-level [logging service](/docs/logs/external-logs) object if a valid identifier was provided.';
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
    protected const METHOD = 'get';
    protected const PATH = '/v1/external-logging/{logId}';
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
