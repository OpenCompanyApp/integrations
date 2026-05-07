<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PauseOrgDeployments.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/deployments/pause.
 */
class PulumiDeploymentsPauseOrgDeployments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_pause_org_deployments';
    protected const DESCRIPTION = 'PauseOrgDeployments

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/deployments/pause

Pauses all future Pulumi Deployments executions across an entire organization. While paused, new deployments can still be queued and currently executing deployments will continue to run to completion. However, queued deployments will not be picked up for execution until deployments are resumed. This provides a safety mechanism to temporarily halt all deployment activity across the organization, for example during maintenance windows or incident response. Requires organization administrator permissions. Use the ResumeOrgDeployments endpoint to resume processing.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/deployments/pause';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
