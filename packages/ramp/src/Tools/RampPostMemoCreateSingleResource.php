<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload a new memo for a transaction.
 *
 * Maps to the official Ramp endpoint post /developer/v1/memos/{transaction_id}.
 */
class RampPostMemoCreateSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_memo_create_single_resource';
    protected const DESCRIPTION = 'Upload a new memo for a transaction

Official Ramp endpoint: POST /developer/v1/memos/{transaction_id}';
    protected const PARAMETERS = array (
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transaction_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/memos/{transaction_id}';
    protected const PATH_PARAMS = array (
  'transaction_id' => 'transaction_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
