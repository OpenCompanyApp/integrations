<?php

namespace OpenCompany\Integrations\OpenSsfScorecard\Tools;

/**
 * Retrieve a published OpenSSF Scorecard result for a repository.
 */
class OpenSsfScorecardResult extends AbstractOpenSsfScorecardTool
{
    protected const NAME = 'openssf_scorecard_result';
    protected const DESCRIPTION = 'Retrieve a published OpenSSF Scorecard result for a repository. Pass uri or platform, org, and repo.';
    protected const METHOD = 'result';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => false, 'description' => 'Repository URI such as github.com/ossf/scorecard.'],
        'platform' => ['type' => 'string', 'required' => false, 'description' => 'VCS platform, usually github.com.'],
        'org' => ['type' => 'string', 'required' => false, 'description' => 'Repository owner or organization.'],
        'repo' => ['type' => 'string', 'required' => false, 'description' => 'Repository name.'],
        'commit' => ['type' => 'string', 'required' => false, 'description' => 'Optional 40-character commit hash.'],
    ];
}
