<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all customs duty programs recognized by AvaTax.
 *
 * Executes the official Avalara AvaTax REST API operation ListPreferredPrograms.
 */
class AvalaraListPreferredPrograms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_preferred_programs';
}