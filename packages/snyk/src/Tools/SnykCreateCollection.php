<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a collection.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/collections.
 */
class SnykCreateCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_collection';
    protected const DESCRIPTION = 'Create a collection

Official Snyk endpoint: POST /orgs/{org_id}/collections

Create a collection #### Required permissions - `Create Collections (org.collection.create)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/collections';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
