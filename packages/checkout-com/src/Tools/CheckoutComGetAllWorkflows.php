<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get all workflows.
 *
 * Maps to the official Checkout.com endpoint GET /workflows.
 */
class CheckoutComGetAllWorkflows extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_all_workflows';
    protected const DESCRIPTION = 'Get all workflows

Official Checkout.com endpoint: GET /workflows.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
