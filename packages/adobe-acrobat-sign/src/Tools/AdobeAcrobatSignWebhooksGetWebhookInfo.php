<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the details of a webhook.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /webhooks/{webhookId}.
 */
class AdobeAcrobatSignWebhooksGetWebhookInfo extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_webhooks_get_webhook_info';
    protected const DESCRIPTION = 'Retrieves the details of a webhook.

Official Adobe Acrobat Sign endpoint: GET /webhooks/{webhookId}

Retrieves the details of a webhook.';
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
  'if_none_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Pass the value of the e-tag header obtained from the previous response to the same request to get a RESOURCE_NOT_MODIFIED(304) if the resource hasn\'t changed.',
  ),
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks/{webhookId}';
    protected const PATH_PARAMS = array (
  'webhookId' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-None-Match' => 'if_none_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
