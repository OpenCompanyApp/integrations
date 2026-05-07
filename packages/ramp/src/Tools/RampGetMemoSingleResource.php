<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a transaction memo.
 *
 * Maps to the official Ramp endpoint get /developer/v1/memos/{transaction_id}.
 */
class RampGetMemoSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_memo_single_resource';
    protected const DESCRIPTION = 'Fetch a transaction memo

Official Ramp endpoint: GET /developer/v1/memos/{transaction_id}';
    protected const PARAMETERS = array (
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transaction_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/memos/{transaction_id}';
    protected const PATH_PARAMS = array (
  'transaction_id' => 'transaction_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
