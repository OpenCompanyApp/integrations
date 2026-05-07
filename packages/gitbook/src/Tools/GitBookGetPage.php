<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get one GitBook page by ID.
 */
class GitBookGetPage extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_page';
    protected const DESCRIPTION = 'Get one GitBook page by ID, optionally as markdown.';
    protected const METHOD = 'getPage';

    public function parameters(): array
    {
        return GitBookParameters::page();
    }
}
