<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a reaction from a conversation comment.
 *
 * Maps to the official FireHydrant endpoint delete /v1/conversations/{conversation_id}/comments/{comment_id}/reactions/{reaction_id}.
 */
class FireHydrantDeleteCommentReaction extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_comment_reaction';
    protected const DESCRIPTION = 'Delete a reaction from a conversation comment

Official FireHydrant endpoint: DELETE /v1/conversations/{conversation_id}/comments/{comment_id}/reactions/{reaction_id}

Archive a reaction';
    protected const PARAMETERS = array (
  'reaction_id' =>
  array (
    'type' => 'string',
    'description' => 'reaction_id parameter.',
    'required' => true,
  ),
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/conversations/{conversation_id}/comments/{comment_id}/reactions/{reaction_id}';
    protected const PATH_PARAMS = array (
  'reaction_id' => 'reaction_id',
  'conversation_id' => 'conversation_id',
  'comment_id' => 'comment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
