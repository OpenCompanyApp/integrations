<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateWorkflow Workflows V2.
 *
 * Maps to the official incident.io endpoint post /v2/workflows.
 */
class IncidentIoWorkflowsV2CreateWorkflow extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_workflows_v2_create_workflow';
    protected const DESCRIPTION = 'CreateWorkflow Workflows V2

Official incident.io endpoint: POST /v2/workflows

Create a new workflow';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/workflows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
