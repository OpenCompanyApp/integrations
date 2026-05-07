<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request setup of exemption certificates for this company..
 *
 * Executes the official Avalara AvaTax REST API operation RequestCertificateSetup.
 */
class AvalaraRequestCertificateSetup extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_request_certificate_setup';
}