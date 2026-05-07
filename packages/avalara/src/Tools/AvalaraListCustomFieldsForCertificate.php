<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve Certificate Custom Fields.
 *
 * Executes the official Avalara AvaTax REST API operation ListCustomFieldsForCertificate.
 */
class AvalaraListCustomFieldsForCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_custom_fields_for_certificate';
}