<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an order.
 *
 * Executes the official Adyen management API operation post-companies-companyId-terminalOrders.
 */
class AdyenManagementPostCompaniesCompanyIdTerminalOrders extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_terminal_orders';
}
