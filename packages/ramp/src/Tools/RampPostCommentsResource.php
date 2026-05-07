<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a comment on an object's discussion thread.
 *
 * Maps to the official Ramp endpoint post /developer/v1/comments/{object_type}/{object_id}.
 */
class RampPostCommentsResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_comments_resource';
    protected const DESCRIPTION = 'Create a comment on an object\'s discussion thread

Official Ramp endpoint: POST /developer/v1/comments/{object_type}/{object_id}

Requires `{resource_name}:write` scope and may require additional access. See `object_type` description for more information.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/comments/{object_type}/{object_id}';
    protected const PATH_PARAMS = array (
  'object_type' => 'object_type',
  'object_id' => 'object_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
