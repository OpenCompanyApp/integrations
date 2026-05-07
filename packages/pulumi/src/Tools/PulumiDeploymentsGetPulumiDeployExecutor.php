<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPulumiDeployExecutor.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/deployments/executor.
 */
class PulumiDeploymentsGetPulumiDeployExecutor extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_pulumi_deploy_executor';
    protected const DESCRIPTION = 'GetPulumiDeployExecutor

Official Pulumi Cloud endpoint: GET /api/deployments/executor

Streams the Linux/AMD64 Pulumi Deployments executor binary to the requester. The executor is the component that runs inside a deployment container and executes the actual Pulumi operations. The binary is retrieved from the Docker image/filesystem and proxied through the service to control access. This API is for internal use by workflow runners and requires valid credentials.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/deployments/executor';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
