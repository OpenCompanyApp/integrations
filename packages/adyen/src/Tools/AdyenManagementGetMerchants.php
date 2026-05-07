<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of merchant accounts.
 *
 * Executes the official Adyen management API operation get-merchants.
 */
class AdyenManagementGetMerchants extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants';
}
