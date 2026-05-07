<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all attributes applied to this certificate.
 *
 * Executes the official Avalara AvaTax REST API operation ListAttributesForCertificate.
 */
class AvalaraListAttributesForCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_attributes_for_certificate';
}