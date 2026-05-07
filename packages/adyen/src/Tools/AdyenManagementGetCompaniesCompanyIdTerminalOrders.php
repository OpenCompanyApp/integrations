<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of orders.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalOrders.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalOrders extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_orders';
}
