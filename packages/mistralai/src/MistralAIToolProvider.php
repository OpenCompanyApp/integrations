<?php

namespace OpenCompany\Integrations\MistralAI;

use OpenCompany\Integrations\Mistral\MistralToolProvider;

/**
 * Legacy compatibility alias for the canonical Mistral AI tool provider.
 *
 * The broad `mistral` package owns discovery metadata, Ruby script docs, and tools.
 */
class MistralAIToolProvider extends MistralToolProvider
{
}
