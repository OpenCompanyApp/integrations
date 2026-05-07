<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of stores.
 *
 * Executes the official Adyen management API operation get-stores.
 */
class AdyenManagementGetStores extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_stores';
}
