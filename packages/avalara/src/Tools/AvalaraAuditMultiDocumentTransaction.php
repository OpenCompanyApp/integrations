<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get audit information about a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AuditMultiDocumentTransaction.
 */
class AvalaraAuditMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_audit_multi_document_transaction';
}