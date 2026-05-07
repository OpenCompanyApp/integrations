<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Suggest paper query completions.
 */
class SemanticScholarAutocompletePapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_autocomplete_papers';
    protected const DESCRIPTION = 'Suggest Semantic Scholar paper query completions using /graph/v1/paper/autocomplete.';
    protected const PATH = 'paper/autocomplete';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Partial paper search query.'],
    ];
}
