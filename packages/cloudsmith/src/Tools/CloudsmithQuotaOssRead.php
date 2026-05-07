<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Open-source Quota usage for a given namespace..
 *
 * Maps to the official Cloudsmith endpoint get /quota/oss/{owner}/.
 */
class CloudsmithQuotaOssRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_quota_oss_read';
    protected const DESCRIPTION = 'Open-source Quota usage for a given namespace.

Official Cloudsmith endpoint: GET /quota/oss/{owner}/

Open-source Quota usage for a given namespace.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/quota/oss/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
