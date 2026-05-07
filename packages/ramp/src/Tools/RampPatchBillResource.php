<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a bill.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/bills/{bill_id}.
 */
class RampPatchBillResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_bill_resource';
    protected const DESCRIPTION = 'Update a bill

Official Ramp endpoint: PATCH /developer/v1/bills/{bill_id}

Only approved bills can be updated.';
    protected const PARAMETERS = array (
  'bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bill_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/bills/{bill_id}';
    protected const PATH_PARAMS = array (
  'bill_id' => 'bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
