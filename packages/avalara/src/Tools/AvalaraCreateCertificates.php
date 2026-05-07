<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create certificates for this company.
 *
 * Executes the official Avalara AvaTax REST API operation CreateCertificates.
 */
class AvalaraCreateCertificates extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_certificates';
}