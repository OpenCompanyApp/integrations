<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Verify a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation VerifyMultiDocumentTransaction.
 */
class AvalaraVerifyMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_verify_multi_document_transaction';
}