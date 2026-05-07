<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov list field size statistics.
 */
class ClinicalTrialsGovFieldSizesStats extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_field_sizes_stats';
    protected const DESCRIPTION = 'Retrieve size statistics for ClinicalTrials.gov list and array fields.';
    protected const METHOD = 'fieldSizesStats';
    protected const PARAMETERS = [
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Piece names or field paths of list fields.', 'items' => ['type' => 'string']],
    ];
}
