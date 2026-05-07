<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new contact.
 *
 * Executes the official Avalara AvaTax REST API operation CreateContacts.
 */
class AvalaraCreateContacts extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_contacts';
}