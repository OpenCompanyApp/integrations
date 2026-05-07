<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Scim V2 Serviceproviderconfig.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/ServiceProviderConfig.
 */
class DbtCloudV3RetrieveScimV2Serviceproviderconfig extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_scim_v2_serviceproviderconfig';
    protected const DESCRIPTION = 'Retrieve Scim V2 Serviceproviderconfig

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/ServiceProviderConfig

Get the SCIM Service Provider Config';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/ServiceProviderConfig';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
