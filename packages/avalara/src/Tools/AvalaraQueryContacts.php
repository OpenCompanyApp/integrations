<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all contacts.
 *
 * Executes the official Avalara AvaTax REST API operation QueryContacts.
 */
class AvalaraQueryContacts extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_contacts';
}