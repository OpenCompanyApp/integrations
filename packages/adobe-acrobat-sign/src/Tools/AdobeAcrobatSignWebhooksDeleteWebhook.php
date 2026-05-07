<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Deletes a webhook.
 *
 * Maps to the official Adobe Acrobat Sign endpoint delete /webhooks/{webhookId}.
 */
class AdobeAcrobatSignWebhooksDeleteWebhook extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_webhooks_delete_webhook';
    protected const DESCRIPTION = 'Deletes a webhook.

Official Adobe Acrobat Sign endpoint: DELETE /webhooks/{webhookId}

Deletes a webhook.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'x_on_behalf_of_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email in the format userid:{userId} OR email:{email}. of the user that has shared his/her account',
  ),
  'if_match' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
  ),
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/webhooks/{webhookId}';
    protected const PATH_PARAMS = array (
  'webhookId' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-Match' => 'if_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
