<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List vendor credits by vendor.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors/{vendor_id}/credits.
 */
class RampGetVendorCreditsList extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_credits_list';
    protected const DESCRIPTION = 'List vendor credits by vendor

Official Ramp endpoint: GET /developer/v1/vendors/{vendor_id}/credits';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'from_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_created_at` from the official Ramp API operation.',
  ),
  'to_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_created_at` from the official Ramp API operation.',
  ),
  'from_accounting_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_accounting_date` from the official Ramp API operation.',
  ),
  'to_accounting_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_accounting_date` from the official Ramp API operation.',
  ),
  'include_fully_used' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_fully_used` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/vendors/{vendor_id}/credits';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'from_accounting_date' => 'from_accounting_date',
  'to_accounting_date' => 'to_accounting_date',
  'include_fully_used' => 'include_fully_used',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
