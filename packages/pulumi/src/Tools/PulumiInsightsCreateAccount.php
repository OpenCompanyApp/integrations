<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateAccount.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}.
 */
class PulumiInsightsCreateAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_create_account';
    protected const DESCRIPTION = 'CreateAccount

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}

Creates a new Insights account. An Insights account represents a cloud provider account (e.g., AWS, Azure, OCI) configured for resource discovery.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'account_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accountName` from the official Pulumi Cloud API operation. The Insights account name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
