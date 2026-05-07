<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * View for viewing/listing distributions..
 *
 * Maps to the official Cloudsmith endpoint get /distros/{slug}/.
 */
class CloudsmithDistrosRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_distros_read';
    protected const DESCRIPTION = 'View for viewing/listing distributions.

Official Cloudsmith endpoint: GET /distros/{slug}/

View for viewing/listing distributions.';
    protected const PARAMETERS = array (
  'slug' => array (
  'type' => 'string',
  'description' => 'slug parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/distros/{slug}/';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
