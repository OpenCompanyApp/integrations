<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List options for a given custom accounting field.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/field-options.
 */
class RampGetCustomFieldOptionListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_custom_field_option_list_resource';
    protected const DESCRIPTION = 'List options for a given custom accounting field

Official Ramp endpoint: GET /developer/v1/accounting/field-options';
    protected const PARAMETERS = array (
  'remote_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `remote_id` from the official Ramp API operation.',
  ),
  'is_active' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_active` from the official Ramp API operation.',
  ),
  'code' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `code` from the official Ramp API operation.',
  ),
  'visibility' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `visibility` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'HIDDEN',
      1 => 'VISIBLE',
    ),
  ),
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `field_id` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/field-options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'remote_id' => 'remote_id',
  'is_active' => 'is_active',
  'code' => 'code',
  'visibility' => 'visibility',
  'accounting_connection_id' => 'accounting_connection_id',
  'field_id' => 'field_id',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
