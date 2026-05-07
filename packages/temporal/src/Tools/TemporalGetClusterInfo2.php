<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get cluster info.
 *
 * Maps to the official Temporal endpoint get /cluster.
 */
class TemporalGetClusterInfo2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_cluster_info_2';
    protected const DESCRIPTION = 'Get cluster info

Official Temporal endpoint: GET /cluster

GetClusterInfo returns information about temporal cluster';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/cluster';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
