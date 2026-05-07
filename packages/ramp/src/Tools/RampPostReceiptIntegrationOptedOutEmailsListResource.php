<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Add a new email to receipt integrations opt-out list.
 *
 * Maps to the official Ramp endpoint post /developer/v1/receipt-integrations/opt-out.
 */
class RampPostReceiptIntegrationOptedOutEmailsListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_receipt_integration_opted_out_emails_list_resource';
    protected const DESCRIPTION = 'Add a new email to receipt integrations opt-out list

Official Ramp endpoint: POST /developer/v1/receipt-integrations/opt-out';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/receipt-integrations/opt-out';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
