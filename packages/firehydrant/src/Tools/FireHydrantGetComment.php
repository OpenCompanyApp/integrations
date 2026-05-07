<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a conversation comment.
 *
 * Maps to the official FireHydrant endpoint get /v1/conversations/{conversation_id}/comments/{comment_id}.
 */
class FireHydrantGetComment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_comment';
    protected const DESCRIPTION = 'Get a conversation comment

Official FireHydrant endpoint: GET /v1/conversations/{conversation_id}/comments/{comment_id}

Retrieves a single comment by ID';
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
    protected const METHOD = 'get';
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
