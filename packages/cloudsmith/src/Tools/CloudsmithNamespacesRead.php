<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific namespace that the user belongs to..
 *
 * Maps to the official Cloudsmith endpoint get /namespaces/{slug}/.
 */
class CloudsmithNamespacesRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_namespaces_read';
    protected const DESCRIPTION = 'Get a specific namespace that the user belongs to.

Official Cloudsmith endpoint: GET /namespaces/{slug}/

Get a specific namespace that the user belongs to.';
    protected const PARAMETERS = array (
  'slug' => array (
  'type' => 'string',
  'description' => 'slug parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{slug}/';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
