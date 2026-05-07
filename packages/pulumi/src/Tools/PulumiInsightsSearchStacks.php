<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SearchStacks.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/stacks/search.
 */
class PulumiInsightsSearchStacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_search_stacks';
    protected const DESCRIPTION = 'SearchStacks

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/stacks/search

Returns a combined view of IaC-managed stacks and discovered stacks.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/console/orgs/{orgName}/stacks/search';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
