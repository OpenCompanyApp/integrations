<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Unlink customers from a certificate.
 *
 * Executes the official Avalara AvaTax REST API operation UnlinkCustomersFromCertificate.
 */
class AvalaraUnlinkCustomersFromCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_unlink_customers_from_certificate';
}