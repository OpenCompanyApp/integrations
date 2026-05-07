<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get download links for a Semantic Scholar dataset.
 */
class SemanticScholarGetDataset extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_dataset';
    protected const DESCRIPTION = 'Get download links for a dataset in a Semantic Scholar release.';
    protected const SERVICE_METHOD = 'datasetsGet';
    protected const PATH = 'release/{release_id}/dataset/{dataset_name}';
    protected const PATH_PARAMS = ['release_id', 'dataset_name'];
    protected const PARAMETERS = [
        'release_id' => ['type' => 'string', 'required' => true, 'description' => 'Release ID.'],
        'dataset_name' => ['type' => 'string', 'required' => true, 'description' => 'Dataset name.'],
    ];
}
