<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete Certificate Custom Fields.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCertificateCustomFields.
 */
class AvalaraDeleteCertificateCustomFields extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_certificate_custom_fields';
}