<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all vendor certificates for a company.
 *
 * Executes the official Avalara AvaTax REST API operation QueryVendorCertificates.
 */
class AvalaraQueryVendorCertificates extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_vendor_certificates';
}