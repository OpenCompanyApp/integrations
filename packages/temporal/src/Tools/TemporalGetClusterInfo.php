<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get cluster info.
 *
 * Maps to the official Temporal endpoint get /api/v1/cluster-info.
 */
class TemporalGetClusterInfo extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_cluster_info';
    protected const DESCRIPTION = 'Get cluster info

Official Temporal endpoint: GET /api/v1/cluster-info

GetClusterInfo returns information about temporal cluster';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/cluster-info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
