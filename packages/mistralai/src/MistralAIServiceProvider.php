<?php

namespace OpenCompany\Integrations\MistralAI;

use OpenCompany\Integrations\Mistral\MistralServiceProvider;

/**
 * Legacy compatibility alias for the canonical Mistral AI service provider.
 *
 * Hosts requiring the old package now register the canonical `mistral` provider.
 */
class MistralAIServiceProvider extends MistralServiceProvider
{
}
