<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List top level HS Code Sections..
 *
 * Executes the official Avalara AvaTax REST API operation ListCrossBorderSections.
 */
class AvalaraListCrossBorderSections extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_cross_border_sections';
}