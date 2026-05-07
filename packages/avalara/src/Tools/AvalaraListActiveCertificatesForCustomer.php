<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieves a list of active certificates for a specified customer within a company..
 *
 * Executes the official Avalara AvaTax REST API operation ListActiveCertificatesForCustomer.
 */
class AvalaraListActiveCertificatesForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_active_certificates_for_customer';
}