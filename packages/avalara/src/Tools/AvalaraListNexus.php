<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported nexus for all countries and regions..
 *
 * Executes the official Avalara AvaTax REST API operation ListNexus.
 */
class AvalaraListNexus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_nexus';
}