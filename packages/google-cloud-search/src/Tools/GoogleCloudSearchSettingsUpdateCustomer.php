<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Update Customer.
 *
 * Maps to the official Google Cloud Search endpoint PATCH /v1/settings/customer.
 */
class GoogleCloudSearchSettingsUpdateCustomer extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_update_customer';
    protected const DESCRIPTION = 'Settings Update Customer

Official Google Cloud Search endpoint: PATCH /v1/settings/customer
Update customer settings.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `CustomerSettings` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/settings/customer';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}
