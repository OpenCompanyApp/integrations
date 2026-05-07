<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete license key for this account by license key name.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteLicenseKey.
 */
class AvalaraDeleteLicenseKey extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_license_key';
}