<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminals.
 *
 * Executes the official Adyen management API operation get-terminals.
 */
class AdyenManagementGetTerminals extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_terminals';
}
