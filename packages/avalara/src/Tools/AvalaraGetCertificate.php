<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single certificate.
 *
 * Executes the official Avalara AvaTax REST API operation GetCertificate.
 */
class AvalaraGetCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_certificate';
}