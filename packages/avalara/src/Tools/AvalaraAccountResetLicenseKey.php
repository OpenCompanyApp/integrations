<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Reset this account's license key.
 *
 * Executes the official Avalara AvaTax REST API operation AccountResetLicenseKey.
 */
class AvalaraAccountResetLicenseKey extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_account_reset_license_key';
}