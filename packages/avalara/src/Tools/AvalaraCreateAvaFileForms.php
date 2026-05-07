<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new AvaFileForm.
 *
 * Executes the official Avalara AvaTax REST API operation CreateAvaFileForms.
 */
class AvalaraCreateAvaFileForms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_ava_file_forms';
}