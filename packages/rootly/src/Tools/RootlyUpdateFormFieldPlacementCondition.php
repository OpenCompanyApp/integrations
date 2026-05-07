<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Form Set Condition.
 *
 * Maps to the official Rootly endpoint put /v1/form_field_placement_conditions/{id}.
 */
class RootlyUpdateFormFieldPlacementCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_form_field_placement_condition';
    protected const DESCRIPTION = 'Update a Form Set Condition

Official Rootly endpoint: PUT /v1/form_field_placement_conditions/{id}

Update a specific form_field_placement_condition by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/form_field_placement_conditions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
