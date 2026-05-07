<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ResumeOrgDeployments.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/deployments/resume.
 */
class PulumiDeploymentsResumeOrgDeployments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_resume_org_deployments';
    protected const DESCRIPTION = 'ResumeOrgDeployments

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/deployments/resume

Resumes Pulumi Deployments executions for an organization that was previously paused via PauseOrgDeployments. Any queued deployments that accumulated while the organization was paused will begin processing according to the organization\'s concurrency limits. Requires organization administrator permissions.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/deployments/resume';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
