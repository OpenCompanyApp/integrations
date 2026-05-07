<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * List soft-deleted packages in recycle bin.
 *
 * Maps to the official Cloudsmith endpoint get /recycle-bin/{owner}/.
 */
class CloudsmithRecycleBinList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_recycle_bin_list';
    protected const DESCRIPTION = 'List soft-deleted packages in recycle bin

Official Cloudsmith endpoint: GET /recycle-bin/{owner}/

Retrieve all soft-deleted packages in the workspace. Optionally filter by repository using the \'repository\' query parameter.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
  'repository' => array (
  'type' => 'string',
  'description' => 'Filter packages by repository slug',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/recycle-bin/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'repository' => 'repository',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
