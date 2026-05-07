<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List files uploaded to Mistral.
 */
class MistralListFiles extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_files';
    protected const DESCRIPTION = 'List files uploaded to Mistral.';
    protected const PATH = '/v1/files';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional file list query parameters such as purpose, page, or page_size.']];
}
