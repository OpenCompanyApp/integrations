<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single contact.
 *
 * Executes the official Avalara AvaTax REST API operation GetContact.
 */
class AvalaraGetContact extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_contact';
}