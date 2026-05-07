<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Cancel a running Job.
 *
 * Maps to the official Airbyte endpoint delete /jobs/{jobId}.
 */
class AirbyteCancelJob extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_cancel_job';
    protected const DESCRIPTION = 'Cancel a running Job

Official Airbyte endpoint: DELETE /jobs/{jobId}';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `jobId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
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
