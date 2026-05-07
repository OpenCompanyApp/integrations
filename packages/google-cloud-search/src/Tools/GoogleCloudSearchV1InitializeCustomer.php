<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * V1 Initialize Customer.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1:initializeCustomer.
 */
class GoogleCloudSearchV1InitializeCustomer extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_v1_initialize_customer';
    protected const DESCRIPTION = 'V1 Initialize Customer

Official Google Cloud Search endpoint: POST /v1:initializeCustomer
Enables `third party` support in Google Cloud Search.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Google Cloud Search `InitializeCustomerRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1:initializeCustomer';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
