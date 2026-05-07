<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update an order.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-terminalOrders-orderId.
 */
class AdyenManagementPatchCompaniesCompanyIdTerminalOrdersOrderId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_terminal_orders_order_id';
}
