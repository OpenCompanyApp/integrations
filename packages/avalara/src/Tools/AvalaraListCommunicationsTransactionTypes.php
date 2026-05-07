<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of communications transactiontypes.
 *
 * Executes the official Avalara AvaTax REST API operation ListCommunicationsTransactionTypes.
 */
class AvalaraListCommunicationsTransactionTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_communications_transaction_types';
}