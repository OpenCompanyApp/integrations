<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List webhooks.
 *
 * Maps to the official GoCardless endpoint GET /webhooks.
 */
class GoCardlessListWebhook extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_webhook';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your webhooks.

Official GoCardless endpoint: GET /webhooks.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
