<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov field value statistics.
 */
class ClinicalTrialsGovFieldValuesStats extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_field_values_stats';
    protected const DESCRIPTION = 'Retrieve value statistics for ClinicalTrials.gov study leaf fields, optionally filtered by field types or fields.';
    protected const METHOD = 'fieldValuesStats';
    protected const PARAMETERS = [
        'types' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Field stat types such as ENUM, BOOLEAN, INTEGER, or NUMBER.', 'items' => ['type' => 'string']],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Piece names or field paths of leaf fields.', 'items' => ['type' => 'string']],
    ];
}
