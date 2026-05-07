<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get a ReadMe guide page by slug.
 */
class ReadMeGetGuide extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_guide';
    protected const DESCRIPTION = 'Get a ReadMe guide page by slug.';
    protected const METHOD = 'getGuide';

    public function parameters(): array
    {
        return ReadMeParameters::slug('Guide page slug.');
    }
}
