<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a conversation comment.
 *
 * Maps to the official FireHydrant endpoint post /v1/conversations/{conversation_id}/comments.
 */
class FireHydrantCreateComment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_comment';
    protected const DESCRIPTION = 'Create a conversation comment

Official FireHydrant endpoint: POST /v1/conversations/{conversation_id}/comments

Creates a comment for a project';
    protected const PARAMETERS = array (
  'conversation_id' =>
  array (
    'type' => 'string',
    'description' => 'conversation_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/conversations/{conversation_id}/comments';
    protected const PATH_PARAMS = array (
  'conversation_id' => 'conversation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
