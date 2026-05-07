<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List inbound field maps for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps.
 */
class FireHydrantListInboundFieldMaps extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_inbound_field_maps';
    protected const DESCRIPTION = 'List inbound field maps for a ticketing project

Official FireHydrant endpoint: GET /v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps

List all inbound field maps for a ticketing project';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'ticket_type' =>
  array (
    'type' => 'string',
    'description' => 'Filter by ticket type. Values: incident, follow_up',
    'enum' =>
    array (
      0 => 'incident',
      1 => 'follow_up',
    ),
  ),
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'ticket_type' => 'ticket_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
