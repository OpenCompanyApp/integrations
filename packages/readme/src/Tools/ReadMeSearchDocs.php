<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Search ReadMe documentation using the documented legacy search endpoint.
 */
class ReadMeSearchDocs extends AbstractReadMeTool
{
    protected const NAME = 'readme_search_docs';
    protected const DESCRIPTION = 'Search ReadMe docs. Optionally pass version for the legacy x-readme-version header.';
    protected const METHOD = 'searchDocs';

    public function parameters(): array
    {
        return ReadMeParameters::search();
    }
}
