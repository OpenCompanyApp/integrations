<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Form Field Placement.
 *
 * Maps to the official Rootly endpoint delete /v1/form_field_placements/{id}.
 */
class RootlyDeleteFormFieldPlacement extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_field_placement';
    protected const DESCRIPTION = 'Delete a Form Field Placement

Official Rootly endpoint: DELETE /v1/form_field_placements/{id}

Delete a specific form_field_placement by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
