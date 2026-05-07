<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get an order.
 *
 * Executes the official Adyen management API operation get-companies-companyId-terminalOrders-orderId.
 */
class AdyenManagementGetCompaniesCompanyIdTerminalOrdersOrderId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_terminal_orders_order_id';
}
