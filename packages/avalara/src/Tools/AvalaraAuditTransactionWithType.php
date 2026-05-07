<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get audit information about a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AuditTransactionWithType.
 */
class AvalaraAuditTransactionWithType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_audit_transaction_with_type';
}