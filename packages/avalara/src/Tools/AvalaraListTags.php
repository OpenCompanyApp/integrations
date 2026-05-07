<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list all tags supported by avalara.
 *
 * Executes the official Avalara AvaTax REST API operation ListTags.
 */
class AvalaraListTags extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tags';
}