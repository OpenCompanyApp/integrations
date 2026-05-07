<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Form Set Condition.
 *
 * Maps to the official Rootly endpoint post /v1/form_field_placements/{form_field_placement_id}/conditions.
 */
class RootlyCreateFormFieldPlacementCondition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_form_field_placement_condition';
    protected const DESCRIPTION = 'Creates a Form Set Condition

Official Rootly endpoint: POST /v1/form_field_placements/{form_field_placement_id}/conditions

Creates a new form_field_placement_condition from provided data';
    protected const PARAMETERS = array (
  'form_field_placement_id' =>
  array (
    'type' => 'string',
    'description' => 'form_field_placement_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/form_field_placements/{form_field_placement_id}/conditions';
    protected const PATH_PARAMS = array (
  'form_field_placement_id' => 'form_field_placement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
