<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a ticketing project.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects/{ticketing_project_id}.
 */
class FireHydrantGetTicketingProject extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ticketing_project';
    protected const DESCRIPTION = 'Get a ticketing project

Official FireHydrant endpoint: GET /v1/ticketing/projects/{ticketing_project_id}

Retrieve a single ticketing project by ID';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
