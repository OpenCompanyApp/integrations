<?php

namespace OpenCompany\Integrations\OpenSsfScorecard\Tools;

/**
 * Retrieve the OpenSSF Scorecard badge SVG for a repository.
 */
class OpenSsfScorecardBadge extends AbstractOpenSsfScorecardTool
{
    protected const NAME = 'openssf_scorecard_badge';
    protected const DESCRIPTION = 'Retrieve the OpenSSF Scorecard badge SVG for a repository.';
    protected const METHOD = 'badge';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => false, 'description' => 'Repository URI such as github.com/ossf/scorecard.'],
        'platform' => ['type' => 'string', 'required' => false, 'description' => 'VCS platform, usually github.com.'],
        'org' => ['type' => 'string', 'required' => false, 'description' => 'Repository owner or organization.'],
        'repo' => ['type' => 'string', 'required' => false, 'description' => 'Repository name.'],
        'style' => ['type' => 'string', 'required' => false, 'description' => 'Badge style.', 'enum' => ['plastic', 'flat', 'flat-square', 'for-the-badge', 'social']],
    ];
}
