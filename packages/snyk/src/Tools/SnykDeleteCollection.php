<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a collection.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/collections/{collection_id}.
 */
class SnykDeleteCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_collection';
    protected const DESCRIPTION = 'Delete a collection

Official Snyk endpoint: DELETE /orgs/{org_id}/collections/{collection_id}

Delete a collection #### Required permissions - `Delete Collections (org.collection.delete)`';
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
    protected const METHOD = 'delete';
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
