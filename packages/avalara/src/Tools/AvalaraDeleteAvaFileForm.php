<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single AvaFileForm.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteAvaFileForm.
 */
class AvalaraDeleteAvaFileForm extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_ava_file_form';
}