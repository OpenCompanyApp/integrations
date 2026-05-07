<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get configuration for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations/{config_id}.
 */
class FireHydrantGetTicketingProjectConfig extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ticketing_project_config';
    protected const DESCRIPTION = 'Get configuration for a ticketing project

Official FireHydrant endpoint: GET /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations/{config_id}

Retrieve configuration for a ticketing project';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
  'config_id' =>
  array (
    'type' => 'string',
    'description' => 'config_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations/{config_id}';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
  'config_id' => 'config_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
