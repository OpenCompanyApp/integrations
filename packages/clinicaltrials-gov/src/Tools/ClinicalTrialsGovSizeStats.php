<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov study JSON size statistics.
 */
class ClinicalTrialsGovSizeStats extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_size_stats';
    protected const DESCRIPTION = 'Retrieve ClinicalTrials.gov study JSON gzip and raw size statistics.';
    protected const METHOD = 'sizeStats';
}
