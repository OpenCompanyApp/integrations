<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get one category in a ReadMe branch section.
 */
class ReadMeGetCategory extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_category';
    protected const DESCRIPTION = 'Get a ReadMe category by title or URI-safe identifier.';
    protected const METHOD = 'getCategory';

    public function parameters(): array
    {
        return ReadMeParameters::category();
    }
}
