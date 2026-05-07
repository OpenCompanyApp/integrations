<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a conversation comment.
 *
 * Maps to the official FireHydrant endpoint patch /v1/conversations/{conversation_id}/comments/{comment_id}.
 */
class FireHydrantUpdateComment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_comment';
    protected const DESCRIPTION = 'Update a conversation comment

Official FireHydrant endpoint: PATCH /v1/conversations/{conversation_id}/comments/{comment_id}

Update a comment\'s attributes';
    protected const PARAMETERS = array (
  'comment_id' =>
  array (
    'type' => 'string',
    'description' => 'comment_id parameter.',
    'required' => true,
  ),
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/conversations/{conversation_id}/comments/{comment_id}';
    protected const PATH_PARAMS = array (
  'comment_id' => 'comment_id',
  'conversation_id' => 'conversation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
