<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List valid certificates for a location.
 *
 * Executes the official Avalara AvaTax REST API operation ListValidCertificatesForCustomer.
 */
class AvalaraListValidCertificatesForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_valid_certificates_for_customer';
}