<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve license key by license key name.
 *
 * Executes the official Avalara AvaTax REST API operation GetLicenseKey.
 */
class AvalaraGetLicenseKey extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_license_key';
}