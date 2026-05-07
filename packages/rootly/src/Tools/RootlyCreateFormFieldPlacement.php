<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Form Field Placement.
 *
 * Maps to the official Rootly endpoint post /v1/form_fields/{form_field_id}/placements.
 */
class RootlyCreateFormFieldPlacement extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_form_field_placement';
    protected const DESCRIPTION = 'Creates a Form Field Placement

Official Rootly endpoint: POST /v1/form_fields/{form_field_id}/placements

Creates a new form_field_placement from provided data';
    protected const PARAMETERS = array (
  'form_field_id' =>
  array (
    'type' => 'string',
    'description' => 'form_field_id parameter.',
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
    protected const PATH = '/v1/form_fields/{form_field_id}/placements';
    protected const PATH_PARAMS = array (
  'form_field_id' => 'form_field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
