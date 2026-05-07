<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Bulk action.
 *
 * Maps to the official Cloudsmith endpoint post /bulk-action/{owner}/.
 */
class CloudsmithBulkAction extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_bulk_action';
    protected const DESCRIPTION = 'Bulk action

Official Cloudsmith endpoint: POST /bulk-action/{owner}/

Perform bulk operations on multiple packages within a repository or across all accessible repositories. If \'repository\' is provided, actions are limited to that repository. If \'repository\' is omitted, actions are performed across all repositories the user has access to within the workspace. Returns a list of successfully actioned packages and any packages that failed with error details.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/bulk-action/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
