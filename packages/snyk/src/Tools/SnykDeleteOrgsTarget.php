<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete target by target ID.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/targets/{target_id}.
 */
class SnykDeleteOrgsTarget extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_orgs_target';
    protected const DESCRIPTION = 'Delete target by target ID

Official Snyk endpoint: DELETE /orgs/{org_id}/targets/{target_id}

Delete the specified target. #### Required permissions - `Remove Projects (org.project.delete)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org to delete',
  ),
  'target_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `target_id` from the official Snyk API operation. The id of the target to delete',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/targets/{target_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'target_id' => 'target_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
