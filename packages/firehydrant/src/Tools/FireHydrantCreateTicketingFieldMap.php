<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a field mapping for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/projects/{ticketing_project_id}/field_maps.
 */
class FireHydrantCreateTicketingFieldMap extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_ticketing_field_map';
    protected const DESCRIPTION = 'Create a field mapping for a ticketing project

Official FireHydrant endpoint: POST /v1/ticketing/projects/{ticketing_project_id}/field_maps

Creates field map for a ticketing project';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/field_maps';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
