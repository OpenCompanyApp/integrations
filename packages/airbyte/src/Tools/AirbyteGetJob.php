<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Job status and details.
 *
 * Maps to the official Airbyte endpoint get /jobs/{jobId}.
 */
class AirbyteGetJob extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_job';
    protected const DESCRIPTION = 'Get Job status and details

Official Airbyte endpoint: GET /jobs/{jobId}';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `jobId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/jobs/{jobId}';
    protected const PATH_PARAMS = array (
  'jobId' => 'job_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
