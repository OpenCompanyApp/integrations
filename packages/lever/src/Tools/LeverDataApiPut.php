<?php

namespace OpenCompany\Integrations\Lever\Tools;

/**
 * Call a safe relative Lever Data API path with PUT.
 */
class LeverDataApiPut extends AbstractLeverDataTool
{
    protected const TOOL_NAME = 'lever_data_api_put';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Lever Data API path with PUT. Official Lever Data API endpoint: PUT {path}.';
    protected const METHOD = 'PUT';
    protected const PATH = '';
    protected const PATH_KEYS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'include',
  3 => 'expand',
  4 => 'perform_as',
  5 => 'created_at_start',
  6 => 'created_at_end',
  7 => 'updated_at_start',
  8 => 'updated_at_end',
  9 => 'stage_id',
  10 => 'posting_id',
  11 => 'contact_id',
  12 => 'email',
  13 => 'origin',
  14 => 'confidentiality',
  15 => 'archived',
  16 => 'requisition_code',
  17 => 'status',
  18 => 'state',
  19 => 'distributionChannel',
  20 => 'country_code',
  21 => 'parse',
  22 => 'perform_as_posting_owner',
);
    protected const PARAMETERS = array (
  'path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Relative Lever Data API path, for example /users.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: limit.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: offset.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: include.',
  ),
  'expand' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: expand.',
  ),
  'perform_as' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: perform_as.',
  ),
  'created_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: created_at_start.',
  ),
  'created_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: created_at_end.',
  ),
  'updated_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: updated_at_start.',
  ),
  'updated_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: updated_at_end.',
  ),
  'stage_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: stage_id.',
  ),
  'posting_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: posting_id.',
  ),
  'contact_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: contact_id.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: email.',
  ),
  'origin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: origin.',
  ),
  'confidentiality' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: confidentiality.',
  ),
  'archived' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: archived.',
  ),
  'requisition_code' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: requisition_code.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: status.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: state.',
  ),
  'distributionChannel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: distributionChannel.',
  ),
  'country_code' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: country_code.',
  ),
  'parse' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: parse.',
  ),
  'perform_as_posting_owner' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lever query parameter: perform_as_posting_owner.',
  ),
  'params' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional Lever query parameters.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body for the Lever endpoint.',
  ),
);
    protected const DYNAMIC_PATH = true;
}
