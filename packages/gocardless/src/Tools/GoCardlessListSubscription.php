<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List subscriptions.
 *
 * Maps to the official GoCardless endpoint GET /subscriptions.
 */
class GoCardlessListSubscription extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_subscription';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your subscriptions. Please note if the subscriptions are related to customers who have been removed, they will not be shown in the response.

Official GoCardless endpoint: GET /subscriptions.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/subscriptions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
