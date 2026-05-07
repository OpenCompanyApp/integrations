<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List comments on an object's discussion thread.
 *
 * Maps to the official Ramp endpoint get /developer/v1/comments/{object_type}/{object_id}.
 */
class RampGetCommentsResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_comments_resource';
    protected const DESCRIPTION = 'List comments on an object\'s discussion thread

Official Ramp endpoint: GET /developer/v1/comments/{object_type}/{object_id}

Requires `{resource_name}:read` scope and may require additional access. See `object_type` description for more information.';
    protected const PARAMETERS = array (
  'object_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object_type` from the official Ramp API operation.',
  ),
  'object_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object_id` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/comments/{object_type}/{object_id}';
    protected const PATH_PARAMS = array (
  'object_type' => 'object_type',
  'object_id' => 'object_id',
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
