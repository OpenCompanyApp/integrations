<?php

namespace OpenCompany\Integrations\Retell;

/**
 * Legacy alias for the canonical Retell AI service provider.
 *
 * Loading this package registers the maintained `retell-ai` integration instead
 * of a duplicate `retell` catalog entry.
 */
class RetellServiceProvider extends \OpenCompany\Integrations\RetellAI\RetellAIServiceProvider
{
}
