<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get initial application configuration.
 *
 * Maps to the official FireHydrant endpoint get /v1/bootstrap.
 */
class FireHydrantGetBootstrap extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_bootstrap';
    protected const DESCRIPTION = 'Get initial application configuration

Official FireHydrant endpoint: GET /v1/bootstrap

Get initial application configuration';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/bootstrap';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
