<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Remove an email from receipt integration opt-out list.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/receipt-integrations/opt-out/{mailbox_opted_out_email_uuid}.
 */
class RampDeleteReceiptIntegrationOptedOutEmailsDeleteResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_receipt_integration_opted_out_emails_delete_resource';
    protected const DESCRIPTION = 'Remove an email from receipt integration opt-out list

Official Ramp endpoint: DELETE /developer/v1/receipt-integrations/opt-out/{mailbox_opted_out_email_uuid}

Successful request will opt-in email to receipt integrations.';
    protected const PARAMETERS = array (
  'mailbox_opted_out_email_uuid' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `mailbox_opted_out_email_uuid` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/receipt-integrations/opt-out/{mailbox_opted_out_email_uuid}';
    protected const PATH_PARAMS = array (
  'mailbox_opted_out_email_uuid' => 'mailbox_opted_out_email_uuid',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
