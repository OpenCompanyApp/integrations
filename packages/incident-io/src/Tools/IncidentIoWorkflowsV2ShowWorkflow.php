<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowWorkflow Workflows V2.
 *
 * Maps to the official incident.io endpoint get /v2/workflows/{id}.
 */
class IncidentIoWorkflowsV2ShowWorkflow extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_workflows_v2_show_workflow';
    protected const DESCRIPTION = 'ShowWorkflow Workflows V2

Official incident.io endpoint: GET /v2/workflows/{id}

Show a workflow by ID';
    protected const PARAMETERS = array (
  'skip_step_upgrades' =>
  array (
    'type' => 'boolean',
    'description' => 'Skips workflow step upgrades, when the parameters for an existing workflow step change',
  ),
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the workflow',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/workflows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'skip_step_upgrades' => 'skip_step_upgrades',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
