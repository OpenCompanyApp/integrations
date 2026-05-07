<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a ticketing project configuration.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations.
 */
class FireHydrantCreateTicketingProjectConfig extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_ticketing_project_config';
    protected const DESCRIPTION = 'Create a ticketing project configuration

Official FireHydrant endpoint: POST /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations

Creates configuration for a ticketing project';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
