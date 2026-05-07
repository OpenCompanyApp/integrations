<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Quota usage for a given namespace..
 *
 * Maps to the official Cloudsmith endpoint get /quota/{owner}/.
 */
class CloudsmithQuotaRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_quota_read';
    protected const DESCRIPTION = 'Quota usage for a given namespace.

Official Cloudsmith endpoint: GET /quota/{owner}/

Quota usage for a given namespace.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/quota/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
