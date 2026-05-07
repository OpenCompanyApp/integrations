<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create inbound field map for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps.
 */
class FireHydrantCreateInboundFieldMap extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_inbound_field_map';
    protected const DESCRIPTION = 'Create inbound field map for a ticketing project

Official FireHydrant endpoint: POST /v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps

Creates inbound field map for a ticketing project';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/inbound_field_maps';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
