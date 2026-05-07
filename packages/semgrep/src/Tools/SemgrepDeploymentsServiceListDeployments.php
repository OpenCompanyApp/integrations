<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List deployments.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments.
 */
class SemgrepDeploymentsServiceListDeployments extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_deployments_service_list_deployments';
    protected const DESCRIPTION = 'List deployments

Official Semgrep Web API endpoint: GET /api/v1/deployments

Request the deployments your auth can access.

Currently available auth scope does not extend over more than one deployment. This endpoint returns the single deployment your token can access. The endpoint additionally returns links to related resources available on this API.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
