<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Link customers to a certificate.
 *
 * Executes the official Avalara AvaTax REST API operation LinkCustomersToCertificate.
 */
class AvalaraLinkCustomersToCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_link_customers_to_certificate';
}