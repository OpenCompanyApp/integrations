<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create license key for this account.
 *
 * Executes the official Avalara AvaTax REST API operation CreateLicenseKey.
 */
class AvalaraCreateLicenseKey extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_license_key';
}