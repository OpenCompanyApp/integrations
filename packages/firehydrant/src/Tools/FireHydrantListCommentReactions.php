<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List reactions for a conversation comment.
 *
 * Maps to the official FireHydrant endpoint get /v1/conversations/{conversation_id}/comments/{comment_id}/reactions.
 */
class FireHydrantListCommentReactions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_comment_reactions';
    protected const DESCRIPTION = 'List reactions for a conversation comment

Official FireHydrant endpoint: GET /v1/conversations/{conversation_id}/comments/{comment_id}/reactions

List all of the reactions that have been added to a comment';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/conversations/{conversation_id}/comments/{comment_id}/reactions';
    protected const PATH_PARAMS = array (
  'conversation_id' => 'conversation_id',
  'comment_id' => 'comment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
