<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List emails opted out of receipt integrations.
 *
 * Maps to the official Ramp endpoint get /developer/v1/receipt-integrations/opt-out.
 */
class RampGetReceiptIntegrationOptedOutEmailsListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_receipt_integration_opted_out_emails_list_resource';
    protected const DESCRIPTION = 'List emails opted out of receipt integrations

Official Ramp endpoint: GET /developer/v1/receipt-integrations/opt-out';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/receipt-integrations/opt-out';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
