<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List certificates linked to a vendor.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertificatesForVendor.
 */
class AvalaraListCertificatesForVendor extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_certificates_for_vendor';
}