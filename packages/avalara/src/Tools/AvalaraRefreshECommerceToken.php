<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Refresh an eCommerce token..
 *
 * Executes the official Avalara AvaTax REST API operation RefreshECommerceToken.
 */
class AvalaraRefreshECommerceToken extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_refresh_e_commerce_token';
}