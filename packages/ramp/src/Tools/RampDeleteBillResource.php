<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Archive a bill.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/bills/{bill_id}.
 */
class RampDeleteBillResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_bill_resource';
    protected const DESCRIPTION = 'Archive a bill

Official Ramp endpoint: DELETE /developer/v1/bills/{bill_id}

This is a destructive action. Associated inflight payments will be cancelled if possible or any attached one-time-card will be terminated. Paid bills and bills belonging to a batch payment cannot be deleted.';
    protected const PARAMETERS = array (
  'bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bill_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/bills/{bill_id}';
    protected const PATH_PARAMS = array (
  'bill_id' => 'bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
