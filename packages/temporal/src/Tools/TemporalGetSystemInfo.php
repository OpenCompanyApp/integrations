<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get system info.
 *
 * Maps to the official Temporal endpoint get /api/v1/system-info.
 */
class TemporalGetSystemInfo extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_system_info';
    protected const DESCRIPTION = 'Get system info

Official Temporal endpoint: GET /api/v1/system-info

GetSystemInfo returns information about the system.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/system-info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
