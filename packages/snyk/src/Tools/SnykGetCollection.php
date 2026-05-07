<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a collection.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/collections/{collection_id}.
 */
class SnykGetCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_collection';
    protected const DESCRIPTION = 'Get a collection

Official Snyk endpoint: GET /orgs/{org_id}/collections/{collection_id}

Get a collection #### Required permissions - `View Collections (org.collection.read)`';
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
  'collection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `collection_id` from the official Snyk API operation. Unique identifier for a collection',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/collections/{collection_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'collection_id' => 'collection_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
