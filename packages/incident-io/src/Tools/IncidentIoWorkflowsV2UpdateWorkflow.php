<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateWorkflow Workflows V2.
 *
 * Maps to the official incident.io endpoint put /v2/workflows/{id}.
 */
class IncidentIoWorkflowsV2UpdateWorkflow extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_workflows_v2_update_workflow';
    protected const DESCRIPTION = 'UpdateWorkflow Workflows V2

Official incident.io endpoint: PUT /v2/workflows/{id}

Updates a workflow';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the workflow to update',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
