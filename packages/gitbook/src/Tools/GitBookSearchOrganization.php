<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Search across a GitBook organization.
 */
class GitBookSearchOrganization extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_search_organization';
    protected const DESCRIPTION = 'Search across a GitBook organization.';
    protected const METHOD = 'searchOrganization';

    public function parameters(): array
    {
        return GitBookParameters::search(true);
    }
}
