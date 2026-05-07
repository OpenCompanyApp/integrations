<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List data planes for the current organization.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/data-planes.
 */
class LangSmithGetV1PlatformOrgsCurrentDataPlanes extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_data_planes';
    protected const DESCRIPTION = 'List data planes for the current organization

Official endpoint: GET /v1/platform/orgs/current/data-planes
Returns up to 50 data planes owned by the caller\'s organization. Sorted status priority (active first), then newest first. Requires BYOC to be enabled for the org.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/data-planes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
