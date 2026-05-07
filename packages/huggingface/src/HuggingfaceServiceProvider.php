<?php

namespace OpenCompany\Integrations\Huggingface;

/**
 * Legacy alias for the canonical Hugging Face service provider.
 *
 * Loading this package registers the maintained `hugging-face` integration
 * instead of a duplicate `huggingface` catalog entry.
 */
class HuggingfaceServiceProvider extends \OpenCompany\Integrations\HuggingFace\HuggingFaceServiceProvider
{
}
