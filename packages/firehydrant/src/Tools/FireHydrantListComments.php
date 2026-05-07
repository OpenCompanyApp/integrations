<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List comments for a conversation.
 *
 * Maps to the official FireHydrant endpoint get /v1/conversations/{conversation_id}/comments.
 */
class FireHydrantListComments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_comments';
    protected const DESCRIPTION = 'List comments for a conversation

Official FireHydrant endpoint: GET /v1/conversations/{conversation_id}/comments

List all of the comments that have been added to the organization';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'description' => 'An ISO8601 timestamp that allows filtering for comments posted before the provided time.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An ISO8601 timestamp that allows filtering for comments posted after the provided time.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'Allows sorting comments by the time they were posted, ascending or descending.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'conversation_id' =>
  array (
    'type' => 'string',
    'description' => 'conversation_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/conversations/{conversation_id}/comments';
    protected const PATH_PARAMS = array (
  'conversation_id' => 'conversation_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
