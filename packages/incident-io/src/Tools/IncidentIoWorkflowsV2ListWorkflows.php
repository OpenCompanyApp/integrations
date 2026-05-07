<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListWorkflows Workflows V2.
 *
 * Maps to the official incident.io endpoint get /v2/workflows.
 */
class IncidentIoWorkflowsV2ListWorkflows extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_workflows_v2_list_workflows';
    protected const DESCRIPTION = 'ListWorkflows Workflows V2

Official incident.io endpoint: GET /v2/workflows

List all workflows';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/workflows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
