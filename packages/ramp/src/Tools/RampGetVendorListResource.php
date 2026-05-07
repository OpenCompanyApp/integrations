<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List vendors.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors.
 */
class RampGetVendorListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_list_resource';
    protected const DESCRIPTION = 'List vendors

Official Ramp endpoint: GET /developer/v1/vendors';
    protected const PARAMETERS = array (
  'external_vendor_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_vendor_id` from the official Ramp API operation.',
  ),
  'merchant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `merchant_id` from the official Ramp API operation.',
  ),
  'accounting_vendor_remote_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `accounting_vendor_remote_ids` from the official Ramp API operation.',
  ),
  'vendor_tracking_category_option_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `vendor_tracking_category_option_ids` from the official Ramp API operation.',
  ),
  'sk_category_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `sk_category_ids` from the official Ramp API operation.',
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
  'from_updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_updated_at` from the official Ramp API operation.',
  ),
  'to_updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_updated_at` from the official Ramp API operation.',
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
  'vendor_owner_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `vendor_owner_id` from the official Ramp API operation.',
  ),
  'include_subsidiary' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_subsidiary` from the official Ramp API operation.',
  ),
  'is_active' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_active` from the official Ramp API operation.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'external_vendor_id' => 'external_vendor_id',
  'merchant_id' => 'merchant_id',
  'accounting_vendor_remote_ids' => 'accounting_vendor_remote_ids',
  'vendor_tracking_category_option_ids' => 'vendor_tracking_category_option_ids',
  'sk_category_ids' => 'sk_category_ids',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'from_updated_at' => 'from_updated_at',
  'to_updated_at' => 'to_updated_at',
  'start' => 'start',
  'page_size' => 'page_size',
  'vendor_owner_id' => 'vendor_owner_id',
  'include_subsidiary' => 'include_subsidiary',
  'is_active' => 'is_active',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
