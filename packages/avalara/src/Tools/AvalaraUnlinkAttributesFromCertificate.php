<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Unlink attributes from a certificate.
 *
 * Executes the official Avalara AvaTax REST API operation UnlinkAttributesFromCertificate.
 */
class AvalaraUnlinkAttributesFromCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_unlink_attributes_from_certificate';
}