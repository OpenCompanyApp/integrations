<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * List files in a GitBook space.
 */
class GitBookListFiles extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_list_files';
    protected const DESCRIPTION = 'List all files in a GitBook space.';
    protected const METHOD = 'listFiles';

    public function parameters(): array
    {
        return GitBookParameters::space() + GitBookParameters::pagination() + ['metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.']];
    }
}
