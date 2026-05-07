<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Remove projects from a collection.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/collections/{collection_id}/relationships/projects.
 */
class SnykDeleteProjectsCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_projects_collection';
    protected const DESCRIPTION = 'Remove projects from a collection

Official Snyk endpoint: DELETE /orgs/{org_id}/collections/{collection_id}/relationships/projects

Remove projects from a collection by specifying an array of project ids #### Required permissions - `Edit Collections (org.collection.edit)`';
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
    protected const METHOD = 'delete';
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
