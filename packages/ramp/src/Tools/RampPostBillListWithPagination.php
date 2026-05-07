<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a bill.
 *
 * Maps to the official Ramp endpoint post /developer/v1/bills.
 */
class RampPostBillListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_post_bill_list_with_pagination';
    protected const DESCRIPTION = 'Create a bill

Official Ramp endpoint: POST /developer/v1/bills

Batch payments cannot be created in the API.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/bills';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
