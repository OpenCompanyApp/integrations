<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Form Field Placement.
 *
 * Maps to the official Rootly endpoint get /v1/form_field_placements/{id}.
 */
class RootlyGetFormFieldPlacement extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_form_field_placement';
    protected const DESCRIPTION = 'Retrieves a Form Field Placement

Official Rootly endpoint: GET /v1/form_field_placements/{id}

Retrieves a specific form_field_placement by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_field_placements/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
