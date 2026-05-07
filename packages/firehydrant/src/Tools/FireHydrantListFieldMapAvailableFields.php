<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List available fields for field mapping.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/field_maps/{field_map_id}/available_fields.
 */
class FireHydrantListFieldMapAvailableFields extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_field_map_available_fields';
    protected const DESCRIPTION = 'List available fields for field mapping

Official FireHydrant endpoint: GET /v1/integrations/field_maps/{field_map_id}/available_fields

Get a description of the fields to which data can be mapped';
    protected const PARAMETERS = array (
  'field_map_id' =>
  array (
    'type' => 'string',
    'description' => 'field_map_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/field_maps/{field_map_id}/available_fields';
    protected const PATH_PARAMS = array (
  'field_map_id' => 'field_map_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
