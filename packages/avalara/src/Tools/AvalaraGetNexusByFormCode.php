<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List company nexus related to a tax form.
 *
 * Executes the official Avalara AvaTax REST API operation GetNexusByFormCode.
 */
class AvalaraGetNexusByFormCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_nexus_by_form_code';
}