<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Search payments.
 *
 * Maps to the official Checkout.com endpoint POST /payments/search.
 */
class CheckoutComSearch extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_search';
    protected const DESCRIPTION = 'Beta Search and filter through your payment data to retrieve payments that match your query. If a search returns more results than the value specified in `limit`, additional results are returned in a new page. A link to the next page of results is returned in the response\'s `_links.next.href` field. For more information on search syntax, see the Search and filter payments documentation.

Official Checkout.com endpoint: POST /payments/search.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/search';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
