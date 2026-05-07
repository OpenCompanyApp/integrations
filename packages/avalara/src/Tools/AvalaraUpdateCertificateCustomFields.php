<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update Certificate Custom Fields.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCertificateCustomFields.
 */
class AvalaraUpdateCertificateCustomFields extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_certificate_custom_fields';
}