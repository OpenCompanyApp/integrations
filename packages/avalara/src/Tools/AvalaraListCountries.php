<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all ISO 3166 countries.
 *
 * Executes the official Avalara AvaTax REST API operation ListCountries.
 */
class AvalaraListCountries extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_countries';
}