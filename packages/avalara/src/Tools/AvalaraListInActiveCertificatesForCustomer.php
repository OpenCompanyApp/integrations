<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieves a list of inactive certificates for a specified customer within a company..
 *
 * Executes the official Avalara AvaTax REST API operation ListInActiveCertificatesForCustomer.
 */
class AvalaraListInActiveCertificatesForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_in_active_certificates_for_customer';
}