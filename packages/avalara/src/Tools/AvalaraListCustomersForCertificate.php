<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List customers linked to this certificate.
 *
 * Executes the official Avalara AvaTax REST API operation ListCustomersForCertificate.
 */
class AvalaraListCustomersForCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_customers_for_certificate';
}