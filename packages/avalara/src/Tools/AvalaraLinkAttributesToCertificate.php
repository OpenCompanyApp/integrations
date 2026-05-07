<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Link attributes to a certificate.
 *
 * Executes the official Avalara AvaTax REST API operation LinkAttributesToCertificate.
 */
class AvalaraLinkAttributesToCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_link_attributes_to_certificate';
}