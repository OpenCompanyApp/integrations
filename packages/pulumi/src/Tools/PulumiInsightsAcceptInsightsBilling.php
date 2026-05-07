<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AcceptInsightsBilling.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/insightstrial/accept.
 */
class PulumiInsightsAcceptInsightsBilling extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_accept_insights_billing';
    protected const DESCRIPTION = 'AcceptInsightsBilling

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/insightstrial/accept

Accepts Insights billing charges for the specified organization, enabling metered billing for resource discovery.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/insightstrial/accept';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
