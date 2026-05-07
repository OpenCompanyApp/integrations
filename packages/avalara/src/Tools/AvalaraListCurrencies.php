<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all ISO 4217 currencies supported by AvaTax..
 *
 * Executes the official Avalara AvaTax REST API operation ListCurrencies.
 */
class AvalaraListCurrencies extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_currencies';
}