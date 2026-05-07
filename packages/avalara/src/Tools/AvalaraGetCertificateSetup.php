<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Check a company's exemption certificate status..
 *
 * Executes the official Avalara AvaTax REST API operation GetCertificateSetup.
 */
class AvalaraGetCertificateSetup extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_certificate_setup';
}