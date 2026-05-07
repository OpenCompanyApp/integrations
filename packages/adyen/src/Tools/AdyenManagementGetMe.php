<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get API credential details.
 *
 * Executes the official Adyen management API operation get-me.
 */
class AdyenManagementGetMe extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_me';
}
