<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single contact.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteContact.
 */
class AvalaraDeleteContact extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_contact';
}