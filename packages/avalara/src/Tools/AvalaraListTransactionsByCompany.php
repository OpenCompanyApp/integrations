<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all transactions.
 *
 * Executes the official Avalara AvaTax REST API operation ListTransactionsByCompany.
 */
class AvalaraListTransactionsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_transactions_by_company';
}