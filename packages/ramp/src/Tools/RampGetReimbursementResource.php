<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a reimbursement.
 *
 * Maps to the official Ramp endpoint get /developer/v1/reimbursements/{reimbursement_id}.
 */
class RampGetReimbursementResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_reimbursement_resource';
    protected const DESCRIPTION = 'Fetch a reimbursement

Official Ramp endpoint: GET /developer/v1/reimbursements/{reimbursement_id}';
    protected const PARAMETERS = array (
  'reimbursement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `reimbursement_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/reimbursements/{reimbursement_id}';
    protected const PATH_PARAMS = array (
  'reimbursement_id' => 'reimbursement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
