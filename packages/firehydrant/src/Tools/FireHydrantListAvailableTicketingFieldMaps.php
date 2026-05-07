<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List available fields for ticket field mapping.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects/{ticketing_project_id}/field_maps/available_fields.
 */
class FireHydrantListAvailableTicketingFieldMaps extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_available_ticketing_field_maps';
    protected const DESCRIPTION = 'List available fields for ticket field mapping

Official FireHydrant endpoint: GET /v1/ticketing/projects/{ticketing_project_id}/field_maps/available_fields

Returns metadata for the fields that are available for field mapping.';
    protected const PARAMETERS = array (
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/field_maps/available_fields';
    protected const PATH_PARAMS = array (
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
