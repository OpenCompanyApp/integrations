<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * List datasets in a Semantic Scholar release.
 */
class SemanticScholarGetDatasetRelease extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_dataset_release';
    protected const DESCRIPTION = 'List datasets available in a Semantic Scholar dataset release.';
    protected const SERVICE_METHOD = 'datasetsGet';
    protected const PATH = 'release/{release_id}';
    protected const PATH_PARAMS = ['release_id'];
    protected const PARAMETERS = [
        'release_id' => ['type' => 'string', 'required' => true, 'description' => 'Release ID.'],
    ];
}
