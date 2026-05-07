<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyWorkflow Workflows V2.
 *
 * Maps to the official incident.io endpoint delete /v2/workflows/{id}.
 */
class IncidentIoWorkflowsV2DestroyWorkflow extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_workflows_v2_destroy_workflow';
    protected const DESCRIPTION = 'DestroyWorkflow Workflows V2

Official incident.io endpoint: DELETE /v2/workflows/{id}

Archives a workflow';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the workflow',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
