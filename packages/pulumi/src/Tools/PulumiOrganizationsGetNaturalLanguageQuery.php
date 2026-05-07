<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetNaturalLanguageQuery.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/search/resources/parse.
 */
class PulumiOrganizationsGetNaturalLanguageQuery extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_natural_language_query';
    protected const DESCRIPTION = 'GetNaturalLanguageQuery

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/search/resources/parse

GetNaturalLanguageQuery converts a natural language query into a structured Pulumi search query using AI. For example, converts \'show me all S3 buckets in production\' into a proper search syntax.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `query` from the official Pulumi Cloud API operation. Search query string',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/search/resources/parse';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
