<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a reaction for a conversation comment.
 *
 * Maps to the official FireHydrant endpoint post /v1/conversations/{conversation_id}/comments/{comment_id}/reactions.
 */
class FireHydrantCreateCommentReaction extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_comment_reaction';
    protected const DESCRIPTION = 'Create a reaction for a conversation comment

Official FireHydrant endpoint: POST /v1/conversations/{conversation_id}/comments/{comment_id}/reactions

Create a reaction on a comment';
    protected const PARAMETERS = array (
  'conversation_id' =>
  array (
    'type' => 'string',
    'description' => 'conversation_id parameter.',
    'required' => true,
  ),
  'comment_id' =>
  array (
    'type' => 'string',
    'description' => 'comment_id parameter.',
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
    protected const PATH = '/v1/conversations/{conversation_id}/comments/{comment_id}/reactions';
    protected const PATH_PARAMS = array (
  'conversation_id' => 'conversation_id',
  'comment_id' => 'comment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
