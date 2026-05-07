<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Cancel an order.
 *
 * Executes the official Adyen management API operation post-companies-companyId-terminalOrders-orderId-cancel.
 */
class AdyenManagementPostCompaniesCompanyIdTerminalOrdersOrderIdCancel extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_terminal_orders_order_id_cancel';
}
