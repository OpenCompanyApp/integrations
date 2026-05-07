<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Recipients.
 *
 * Maps to the official Plaid endpoint get /fdx/recipients.
 */
class PlaidGetRecipients extends AbstractPlaidTool
{
    protected const NAME = 'plaid_get_recipients';
    protected const DESCRIPTION = 'Get Recipients

Official Plaid endpoint: GET /fdx/recipients

Returns a list of Recipients';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/fdx/recipients';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}