<?php

namespace OpenCompany\Integrations\OpenSsfScorecard\Tools;

/**
 * Retrieve one check from a published OpenSSF Scorecard result.
 */
class OpenSsfScorecardCheck extends AbstractOpenSsfScorecardTool
{
    protected const NAME = 'openssf_scorecard_check';
    protected const DESCRIPTION = 'Retrieve one named check from a published OpenSSF Scorecard result.';
    protected const METHOD = 'check';
    protected const REQUIRED = ['check'];
    protected const PARAMETERS = [
        'check' => ['type' => 'string', 'required' => true, 'description' => 'Check name such as Maintained, Security-Policy, or Code-Review.'],
        'uri' => ['type' => 'string', 'required' => false, 'description' => 'Repository URI such as github.com/ossf/scorecard.'],
        'platform' => ['type' => 'string', 'required' => false, 'description' => 'VCS platform, usually github.com.'],
        'org' => ['type' => 'string', 'required' => false, 'description' => 'Repository owner or organization.'],
        'repo' => ['type' => 'string', 'required' => false, 'description' => 'Repository name.'],
        'commit' => ['type' => 'string', 'required' => false, 'description' => 'Optional 40-character commit hash.'],
    ];
}
