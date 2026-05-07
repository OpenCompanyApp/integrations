<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a draft bill.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bills/drafts/{draft_bill_id}.
 */
class RampGetDraftBillResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_draft_bill_resource';
    protected const DESCRIPTION = 'Fetch a draft bill

Official Ramp endpoint: GET /developer/v1/bills/drafts/{draft_bill_id}';
    protected const PARAMETERS = array (
  'draft_bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `draft_bill_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/bills/drafts/{draft_bill_id}';
    protected const PATH_PARAMS = array (
  'draft_bill_id' => 'draft_bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
