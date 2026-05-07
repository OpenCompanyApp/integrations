<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieves a list of custom fields for a specified customer within a company..
 *
 * Executes the official Avalara AvaTax REST API operation ListCustomFieldsForCustomer.
 */
class AvalaraListCustomFieldsForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_custom_fields_for_customer';
}