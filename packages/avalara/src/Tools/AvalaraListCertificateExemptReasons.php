<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List the certificate exempt reasons defined by a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertificateExemptReasons.
 */
class AvalaraListCertificateExemptReasons extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_certificate_exempt_reasons';
}