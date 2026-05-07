<?php

namespace OpenCompany\Integrations\OpenSsfScorecard\Tools;

/**
 * Build the public OpenSSF Scorecard viewer URL for a repository.
 */
class OpenSsfScorecardViewerUrl extends AbstractOpenSsfScorecardTool
{
    protected const NAME = 'openssf_scorecard_viewer_url';
    protected const DESCRIPTION = 'Build the public OpenSSF Scorecard viewer URL for a repository.';
    protected const METHOD = 'viewerUrl';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => false, 'description' => 'Repository URI such as github.com/ossf/scorecard.'],
        'platform' => ['type' => 'string', 'required' => false, 'description' => 'VCS platform, usually github.com.'],
        'org' => ['type' => 'string', 'required' => false, 'description' => 'Repository owner or organization.'],
        'repo' => ['type' => 'string', 'required' => false, 'description' => 'Repository name.'],
    ];
}
