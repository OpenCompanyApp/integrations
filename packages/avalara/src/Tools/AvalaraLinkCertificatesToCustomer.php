<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Link certificates to a customer.
 *
 * Executes the official Avalara AvaTax REST API operation LinkCertificatesToCustomer.
 */
class AvalaraLinkCertificatesToCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_link_certificates_to_customer';
}