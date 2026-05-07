<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve premium classification for a company's item based on its ItemCode and SystemCode..
 *
 * Executes the official Avalara AvaTax REST API operation GetPremiumClassification.
 */
class AvalaraGetPremiumClassification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_premium_classification';
}