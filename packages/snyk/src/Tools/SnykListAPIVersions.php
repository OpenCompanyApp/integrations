<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * listAPIVersions.
 *
 * Maps to the official Snyk endpoint get /openapi.
 */
class SnykListAPIVersions extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_apiversions';
    protected const DESCRIPTION = 'listAPIVersions

Official Snyk endpoint: GET /openapi

List available versions of OpenAPI specification';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/openapi';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
