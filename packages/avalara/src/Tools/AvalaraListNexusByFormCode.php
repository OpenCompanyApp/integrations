<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List nexus related to a tax form.
 *
 * Executes the official Avalara AvaTax REST API operation ListNexusByFormCode.
 */
class AvalaraListNexusByFormCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus_by_form_code';
}