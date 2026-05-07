<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI;

/**
 * Legacy alias for the canonical Microsoft Power BI service provider.
 *
 * Loading this package registers the maintained `powerbi` integration instead
 * of a duplicate `microsoft_powerbi` catalog entry.
 */
class PowerBIServiceProvider extends \OpenCompany\Integrations\PowerBi\PowerBiServiceProvider
{
}
