<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Bulk upload GL accounts.
 *
 * Executes the official Avalara AvaTax REST API operation BulkUploadGLAccounts.
 */
class AvalaraBulkUploadGLAccounts extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_bulk_upload_gl_accounts';
}