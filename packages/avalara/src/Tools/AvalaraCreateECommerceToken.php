<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new ecommerce token..
 *
 * Executes the official Avalara AvaTax REST API operation CreateECommerceToken.
 */
class AvalaraCreateECommerceToken extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_e_commerce_token';
}