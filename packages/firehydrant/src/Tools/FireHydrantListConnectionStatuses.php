<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get integration connection status.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/statuses.
 */
class FireHydrantListConnectionStatuses extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_connection_statuses';
    protected const DESCRIPTION = 'Get integration connection status

Official FireHydrant endpoint: GET /v1/integrations/statuses

Retrieve overall integration connection status';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/statuses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
