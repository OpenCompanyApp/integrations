<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete key.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/keys/{keyId}.
 */
class ClickHouseCloudOpenapiKeyDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_openapi_key_delete';
    protected const DESCRIPTION = 'Delete key

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/keys/{keyId}

Deletes API key. Only a key not used to authenticate the active request can be deleted.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the key.',
    'required' => true,
  ),
  'key_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the key to delete.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/organizations/{organizationId}/keys/{keyId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'keyId' => 'key_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
