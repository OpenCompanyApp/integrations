<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a draft bill.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/bills/drafts/{draft_bill_id}.
 */
class RampPatchDraftBillResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_draft_bill_resource';
    protected const DESCRIPTION = 'Update a draft bill

Official Ramp endpoint: PATCH /developer/v1/bills/drafts/{draft_bill_id}';
    protected const PARAMETERS = array (
  'draft_bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `draft_bill_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/bills/drafts/{draft_bill_id}';
    protected const PATH_PARAMS = array (
  'draft_bill_id' => 'draft_bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
