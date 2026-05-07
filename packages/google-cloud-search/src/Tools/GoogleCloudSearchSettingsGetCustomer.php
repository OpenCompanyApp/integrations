<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Get Customer.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/settings/customer.
 */
class GoogleCloudSearchSettingsGetCustomer extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_get_customer';
    protected const DESCRIPTION = 'Settings Get Customer

Official Google Cloud Search endpoint: GET /v1/settings/customer
Get customer settings.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/settings/customer';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
