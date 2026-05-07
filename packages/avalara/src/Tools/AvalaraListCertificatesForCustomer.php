<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List certificates linked to a customer.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertificatesForCustomer.
 */
class AvalaraListCertificatesForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_certificates_for_customer';
}