<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List all global metadata templates.
 *
 * Executes the official Box API operation get_metadata_templates_global.
 */
class BoxGetMetadataTemplatesGlobal extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_metadata_templates_global';
}
