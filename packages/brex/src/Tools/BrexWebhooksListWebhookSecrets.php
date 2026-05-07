<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Webhook Secrets.
 *
 * Maps to the official Brex endpoint get /v1/webhooks/secrets.
 */
class BrexWebhooksListWebhookSecrets extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_list_webhook_secrets';
    protected const DESCRIPTION = 'List Webhook Secrets

Official Brex endpoint: GET /v1/webhooks/secrets

This endpoint returns a set of webhook signing secrets used to validate the webhook. Usually only one key will be returned in the response. After key rotation, this endpoint will return two keys: the new key, and the key that will be revoked soon. There will also be two signatures in the \'Webhook-Signature\' request header. Your application should use all keys available to validate the webhook request. If validation passes for any of the keys returned, the webhook payload is valid.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/secrets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
