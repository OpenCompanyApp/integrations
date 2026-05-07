<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Unlink certificates from a customer.
 *
 * Executes the official Avalara AvaTax REST API operation UnlinkCertificatesFromCustomer.
 */
class AvalaraUnlinkCertificatesFromCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_unlink_certificates_from_customer';
}