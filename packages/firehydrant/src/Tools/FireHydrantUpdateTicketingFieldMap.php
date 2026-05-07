<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a field map for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint patch /v1/ticketing/projects/{ticketing_project_id}/field_maps/{map_id}.
 */
class FireHydrantUpdateTicketingFieldMap extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_ticketing_field_map';
    protected const DESCRIPTION = 'Update a field map for a ticketing project

Official FireHydrant endpoint: PATCH /v1/ticketing/projects/{ticketing_project_id}/field_maps/{map_id}

Update field map for a ticketing project';
    protected const PARAMETERS = array (
  'map_id' =>
  array (
    'type' => 'string',
    'description' => 'map_id parameter.',
    'required' => true,
  ),
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/field_maps/{map_id}';
    protected const PATH_PARAMS = array (
  'map_id' => 'map_id',
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
