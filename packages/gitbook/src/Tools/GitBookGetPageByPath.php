<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get one GitBook page by path.
 */
class GitBookGetPageByPath extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_page_by_path';
    protected const DESCRIPTION = 'Get one GitBook page by path, optionally as markdown.';
    protected const METHOD = 'getPageByPath';

    public function parameters(): array
    {
        return GitBookParameters::pagePath();
    }
}
