<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of the AvaFile Forms available.
 *
 * Executes the official Avalara AvaTax REST API operation ListAvaFileForms.
 */
class AvalaraListAvaFileForms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_ava_file_forms';
}