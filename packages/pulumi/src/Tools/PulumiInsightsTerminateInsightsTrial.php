<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * TerminateInsightsTrial.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/insightstrial/deny.
 */
class PulumiInsightsTerminateInsightsTrial extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_terminate_insights_trial';
    protected const DESCRIPTION = 'TerminateInsightsTrial

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/insightstrial/deny

Terminates the Insights trial for the organization and removes all associated accounts.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/insightstrial/deny';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
