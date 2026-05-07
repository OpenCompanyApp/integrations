<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported entity use codes.
 *
 * Executes the official Avalara AvaTax REST API operation ListEntityUseCodes.
 */
class AvalaraListEntityUseCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_entity_use_codes';
}