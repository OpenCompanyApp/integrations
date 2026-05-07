<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get a ReadMe API reference page by slug.
 */
class ReadMeGetReference extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_reference';
    protected const DESCRIPTION = 'Get a ReadMe API reference page by slug.';
    protected const METHOD = 'getReference';

    public function parameters(): array
    {
        return ReadMeParameters::slug('API reference page slug.');
    }
}
