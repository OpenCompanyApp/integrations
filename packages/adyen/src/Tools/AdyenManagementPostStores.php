<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a store.
 *
 * Executes the official Adyen management API operation post-stores.
 */
class AdyenManagementPostStores extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_stores';
}
