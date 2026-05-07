<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov API and data version information.
 */
class ClinicalTrialsGovVersion extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_version';
    protected const DESCRIPTION = 'Retrieve ClinicalTrials.gov API version and dataTimestamp to confirm data refresh freshness.';
    protected const METHOD = 'version';
}
