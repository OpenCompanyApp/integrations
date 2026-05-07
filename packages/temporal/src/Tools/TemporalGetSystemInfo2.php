<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get system info.
 *
 * Maps to the official Temporal endpoint get /system-info.
 */
class TemporalGetSystemInfo2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_system_info_2';
    protected const DESCRIPTION = 'Get system info

Official Temporal endpoint: GET /system-info

GetSystemInfo returns information about the system.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/system-info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
