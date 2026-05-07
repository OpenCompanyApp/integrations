<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Edit a collection.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/collections/{collection_id}.
 */
class SnykUpdateCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_collection';
    protected const DESCRIPTION = 'Edit a collection

Official Snyk endpoint: PATCH /orgs/{org_id}/collections/{collection_id}

Edit a collection #### Required permissions - `Edit Collections (org.collection.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
