<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single contact.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateContact.
 */
class AvalaraUpdateContact extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_contact';
}