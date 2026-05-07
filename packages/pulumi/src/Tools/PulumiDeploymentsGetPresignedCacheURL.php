<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPresignedCacheURL.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache/url.
 */
class PulumiDeploymentsGetPresignedCacheURL extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_presigned_cache_url';
    protected const DESCRIPTION = 'GetPresignedCacheURL

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache/url

Returns a presigned URL for saving or restoring the Pulumi Deployments dependency cache. The cache stores build artifacts and dependencies between deployment runs to speed up execution. The request body must specify a method (PUT to upload a cache archive, or GET to download one) and a non-empty cache key identifying the cached content. The returned presigned URL can be used directly for the corresponding HTTP operation against the object store without additional authentication.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache/url';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
