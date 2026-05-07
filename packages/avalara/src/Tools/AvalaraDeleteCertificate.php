<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Revoke and delete a certificate.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCertificate.
 */
class AvalaraDeleteCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_certificate';
}