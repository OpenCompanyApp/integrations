<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a ticketing project configuration.
 *
 * Maps to the official FireHydrant endpoint delete /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations/{config_id}.
 */
class FireHydrantDeleteTicketingProjectConfig extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_ticketing_project_config';
    protected const DESCRIPTION = 'Archive a ticketing project configuration

Official FireHydrant endpoint: DELETE /v1/ticketing/projects/{ticketing_project_id}/provider_project_configurations/{config_id}

Archive configuration for a ticketing project';
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
    protected const METHOD = 'delete';
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
