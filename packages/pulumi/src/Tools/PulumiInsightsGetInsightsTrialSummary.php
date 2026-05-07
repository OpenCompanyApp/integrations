<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetInsightsTrialSummary.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/insightstrial/summary.
 */
class PulumiInsightsGetInsightsTrialSummary extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_insights_trial_summary';
    protected const DESCRIPTION = 'GetInsightsTrialSummary

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/insightstrial/summary

Returns a summary of the organization\'s Insights trial usage, including resource counts and remaining trial capacity.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/insightstrial/summary';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
