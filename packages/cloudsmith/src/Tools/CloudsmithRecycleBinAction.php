<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Recycle bin action.
 *
 * Maps to the official Cloudsmith endpoint post /recycle-bin/{owner}/action/.
 */
class CloudsmithRecycleBinAction extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_recycle_bin_action';
    protected const DESCRIPTION = 'Recycle bin action

Official Cloudsmith endpoint: POST /recycle-bin/{owner}/action/

Perform actions on soft-deleted packages in the recycle bin. Supported actions: permanently delete (hard delete), restore. Returns a list of successfully actioned packages and any packages that failed with error details.';
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
    protected const PATH = '/recycle-bin/{owner}/action/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
