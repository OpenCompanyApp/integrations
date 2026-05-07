<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific supported package format..
 *
 * Maps to the official Cloudsmith endpoint get /formats/{slug}/.
 */
class CloudsmithFormatsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_formats_read';
    protected const DESCRIPTION = 'Get a specific supported package format.

Official Cloudsmith endpoint: GET /formats/{slug}/

Get a specific supported package format.';
    protected const PARAMETERS = array (
  'slug' => array (
  'type' => 'string',
  'description' => 'slug parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/formats/{slug}/';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
