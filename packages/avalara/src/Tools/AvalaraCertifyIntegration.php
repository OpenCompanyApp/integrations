<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Checks whether the integration being used to set up this company and run transactions onto this company is compliant to all requirements..
 *
 * Executes the official Avalara AvaTax REST API operation CertifyIntegration.
 */
class AvalaraCertifyIntegration extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_certify_integration';
}