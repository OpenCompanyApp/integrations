<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get audit information about a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AuditTransaction.
 */
class AvalaraAuditTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_audit_transaction';
}