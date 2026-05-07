<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PollDeploymentsQueue.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/deployments/poll.
 */
class PulumiDeploymentsPollDeploymentsQueue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_poll_deployments_queue';
    protected const DESCRIPTION = 'PollDeploymentsQueue

Official Pulumi Cloud endpoint: GET /api/deployments/poll

Polls the Pulumi Deployments queue for available work to execute. This endpoint is used by self-hosted deployment agents running in agent pools to pick up queued deployment jobs. Returns 200 with the next available deployment\'s workflow definition if work is available, or 204 No Content if the queue is empty. Agents should poll this endpoint repeatedly. Authenticated using an agent pool secret rather than a user access token.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/deployments/poll';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
