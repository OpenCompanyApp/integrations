<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get file version legal hold.
 *
 * Executes the official Box API operation get_file_version_legal_holds_id.
 */
class BoxGetFileVersionLegalHoldsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_file_version_legal_holds_id';
}
