<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of company accounts.
 *
 * Executes the official Adyen management API operation get-companies.
 */
class AdyenManagementGetCompanies extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies';
}
