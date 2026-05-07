<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Add projects to a collection.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/collections/{collection_id}/relationships/projects.
 */
class SnykUpdateCollectionWithProjects extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_collection_with_projects';
    protected const DESCRIPTION = 'Add projects to a collection

Official Snyk endpoint: POST /orgs/{org_id}/collections/{collection_id}/relationships/projects

Add projects to a collection by specifying an array of project ids #### Required permissions - `Edit Collections (org.collection.edit)`';
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
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/collections/{collection_id}/relationships/projects';
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
