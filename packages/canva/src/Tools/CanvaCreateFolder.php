<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Creates a folder in one of the following locations: - The top level of a Canva user's (using the ID root), - The user's Uploads folder (using the ID uploads), - Another folder (using the parent folder's ID).
 */
class CanvaCreateFolder extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_create_folder';
}
