<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single AvaFileForm.
 *
 * Executes the official Avalara AvaTax REST API operation GetAvaFileForm.
 */
class AvalaraGetAvaFileForm extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_ava_file_form';
}