<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * List pages in a GitBook space.
 */
class GitBookListPages extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_list_pages';
    protected const DESCRIPTION = 'List all pages in a GitBook space current content revision.';
    protected const METHOD = 'listPages';

    public function parameters(): array
    {
        return GitBookParameters::space() + ['metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.']];
    }
}
