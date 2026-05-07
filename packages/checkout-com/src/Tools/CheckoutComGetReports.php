<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get all reports.
 *
 * Maps to the official Checkout.com endpoint GET /reports.
 */
class CheckoutComGetReports extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_reports';
    protected const DESCRIPTION = 'Returns the list of reports and their details.

Official Checkout.com endpoint: GET /reports.';
    protected const PARAMETERS = [
        'created_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filters reports to those created on or after the specified timestamp, in UTC. <br/>Format – ISO 8601 code',
        ],
        'created_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filters reports to those created before the specified timestamp, in UTC. <br/>Format – ISO 8601 code',
        ],
        'entity_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filters reports to those created for the specified entity. <br/>Sub-entity IDs are not supported.',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of results you want to include per page. </br> For example, if there are 50 results and you set limit=10, you receive 5 pages each containing 10 results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A token used to paginate multiple pages of results.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/reports';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'created_after' => 'created_after',
        'created_before' => 'created_before',
        'entity_id' => 'entity_id',
        'limit' => 'limit',
        'pagination_token' => 'pagination_token',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
