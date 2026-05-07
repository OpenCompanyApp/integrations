<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * List organizations visible to the GitBook token.
 */
class GitBookListOrganizations extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_list_organizations';
    protected const DESCRIPTION = 'List GitBook organizations visible to the authenticated token.';
    protected const METHOD = 'listOrganizations';

    public function parameters(): array
    {
        return GitBookParameters::pagination();
    }
}
