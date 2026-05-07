<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve one XBRL frame across reporting entities.
 */
class SecEdgarFrames extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_frames';
    protected const DESCRIPTION = 'Retrieve an XBRL frame for one taxonomy tag, unit, and calendar period.';
    protected const METHOD = 'frames';
    protected const REQUIRED = ['taxonomy', 'tag', 'unit', 'period'];
    protected const PARAMETERS = [
        'taxonomy' => ['type' => 'string', 'required' => true, 'description' => 'Taxonomy such as us-gaap, ifrs-full, dei, or srt.'],
        'tag' => ['type' => 'string', 'required' => true, 'description' => 'XBRL tag such as AccountsPayableCurrent.'],
        'unit' => ['type' => 'string', 'required' => true, 'description' => 'Unit such as USD, shares, pure, or USD-per-shares.'],
        'period' => ['type' => 'string', 'required' => true, 'description' => 'Frame period such as CY2019, CY2019Q1, or CY2019Q1I.'],
    ];
}
