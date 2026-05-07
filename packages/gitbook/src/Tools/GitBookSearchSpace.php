<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Search content in a GitBook space.
 */
class GitBookSearchSpace extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_search_space';
    protected const DESCRIPTION = 'Search content in a GitBook space.';
    protected const METHOD = 'searchSpace';

    public function parameters(): array
    {
        return GitBookParameters::search();
    }
}
