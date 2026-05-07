<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a webhook.
 *
 * Maps to the official FireHydrant endpoint post /v1/webhooks.
 */
class FireHydrantCreateWebhook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_webhook';
    protected const DESCRIPTION = 'Create a webhook

Official FireHydrant endpoint: POST /v1/webhooks

Create a new webhook';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
