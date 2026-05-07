<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a conversation comment.
 *
 * Maps to the official FireHydrant endpoint delete /v1/conversations/{conversation_id}/comments/{comment_id}.
 */
class FireHydrantDeleteComment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_comment';
    protected const DESCRIPTION = 'Archive a conversation comment

Official FireHydrant endpoint: DELETE /v1/conversations/{conversation_id}/comments/{comment_id}

Archive a comment';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/conversations/{conversation_id}/comments/{comment_id}';
    protected const PATH_PARAMS = array (
  'comment_id' => 'comment_id',
  'conversation_id' => 'conversation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
