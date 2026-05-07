<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a merchant account.
 *
 * Executes the official Adyen management API operation post-merchants.
 */
class AdyenManagementPostMerchants extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants';
}
