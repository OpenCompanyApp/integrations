<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Form Set Condition.
 *
 * Maps to the official Rootly endpoint delete /v1/form_field_placement_conditions/{id}.
 */
class RootlyDeleteFormFieldPlacementCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_field_placement_condition';
    protected const DESCRIPTION = 'Delete a Form Set Condition

Official Rootly endpoint: DELETE /v1/form_field_placement_conditions/{id}

Delete a specific form_field_placement_condition by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/form_field_placement_conditions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
