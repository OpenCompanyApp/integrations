<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single certificate.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCertificate.
 */
class AvalaraUpdateCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_certificate';
}