<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Creates a webhook.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /webhooks.
 */
class AdobeAcrobatSignWebhooksCreateWebhook extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_webhooks_create_webhook';
    protected const DESCRIPTION = 'Creates a webhook.

Official Adobe Acrobat Sign endpoint: POST /webhooks

Creates a webhook.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information about the webhook that you want to create',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
