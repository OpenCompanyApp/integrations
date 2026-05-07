<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve audit history for an account..
 *
 * Executes the official Avalara AvaTax REST API operation AuditAccount.
 */
class AvalaraAuditAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_audit_account';
}