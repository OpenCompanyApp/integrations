<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get list of available organizations.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations.
 */
class ClickHouseCloudOrganizationGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_get_list';
    protected const DESCRIPTION = 'Get list of available organizations

Official ClickHouse Cloud endpoint: GET /v1/organizations

Returns a list with a single organization associated with the API key in the request.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
