<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all license keys for this account.
 *
 * Executes the official Avalara AvaTax REST API operation GetLicenseKeys.
 */
class AvalaraGetLicenseKeys extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_license_keys';
}